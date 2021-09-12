<?php


namespace App\Services;


use App\BindingModels\OrderBindingModel;
use App\Enums\OrderStatus;
use App\Enums\Role;
use App\Exceptions\OrdersCollisionException;
use App\Exceptions\WrongOrderStatusException;
use App\Interfaces\IOrderService;
use App\Models\Notary;
use App\Models\Order;
use App\Models\Subcategory;
use App\Models\User;
use App\ViewModels\OrdersViewModel;
use App\ViewModels\OrderViewModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OrderService implements IOrderService
{
    public function createOrder(OrderBindingModel $model): void
    {
        $consultationDatetime = "{$model->consultationDate} {$model->consultationTime}";
        // TODO: локализацию получать из конфигов
        $carbon = Carbon::createFromLocaleIsoFormat('DD MMM Y HH:mm', 'ru_RU', $consultationDatetime);
        // Array for storing frozen values of related models (snapshot at the moment of order creation)
        $description = [];
        /** @var Subcategory $subcategory */
        $subcategory = Subcategory::query()->findOrFail($model->subcategoryId);
        $description['subcategory_name'] = $subcategory->name;
        /**@var Notary $notary */
        $notary = Notary::query()->findOrFail($model->notaryId);
        $description['notary_fio'] = $notary->fio;
        $description['address'] = $notary->office_address;
        $order = new Order();
        $order->description = json_encode($description);
        $order->price = $subcategory->price * $notary->qualification->coefficient;
        $order->status = OrderStatus::PROCESSING();
        $order->consultation_datetime = $carbon->toDateTimeString();
        // TODO заменить 1 на реальный id пользователя
        $order->user_id = 1; // request()->user()->id
        $order->subcategory_id = $model->subcategoryId;
        $order->notary_id = $model->notaryId;
        if ($this->anyOrderCollisions($order->notary_id, $order->consultation_datetime)) {
            throw new OrdersCollisionException($model);
        }
        $order->save();
        Log::info(
            "Created new order",
            [
                'ip' => request()->ip(),
                'newId' => $order->id,
                // TODO заменить null на реального пользователя
                'user' => null, //request()->user(),
                'newData' => $model
            ]
        );
    }

    public function cancelOrder(int $id): void
    {
        /**@var Order $order*/
        $order = Order::query()->findOrFail($id);
        if ($order->status !== OrderStatus::PROCESSING()->getValue()) {
            throw new WrongOrderStatusException(
                OrderStatus::from($order->status),
                OrderStatus::CANCELED()
            );
        }
        $order->status = OrderStatus::CANCELED();
        $order->save();
        Log::info(
            "Canceled order",
            [
                'ip' => request()->ip(),
                'user' => request()->user(),
                'id' => $id
            ]
        );
    }

    public function finishOrder(int $id): void
    {
        /**@var Order $order*/
        $order = Order::query()->findOrFail($id);
        if ($order->status !== OrderStatus::PROCESSING()->getValue()) {
            throw new WrongOrderStatusException(
                OrderStatus::from($order->status),
                OrderStatus::FINISHED()
            );
        }
        $order->status = OrderStatus::FINISHED();
        $order->save();
        Log::info(
            "Finished order",
            [
                'ip' => request()->ip(),
                'user' => request()->user(),
                'id' => $id
            ]
        );
    }

    public function getOrdersList(?string $sortingColumn = null, ?string $sortingDirection = null): OrdersViewModel
    {
        $orders = Order::all();
        // TODO раскомментировать фильтрацию заказов для юзера
        /*if (request()->user()->role == Role::USER()->getValue()) {
            $orders = $orders->filter(fn (Order $o) => $o->user->id == request()->user()->id);
        }*/
        if (isset($sortingColumn, $sortingDirection)) {
            $isDescending = ($sortingDirection == 'desc');
            $orders = $orders->sortBy($sortingColumn, SORT_REGULAR, $isDescending);
        }
        $result = new OrdersViewModel();
        foreach ($orders as $order) {
            $description = json_decode($order->description, true);
            $orderView = new OrderViewModel(
                $order->id,
                $description['subcategory_name'],
                $description['notary_fio'],
                $description['address'],
                Carbon::createFromTimeString($order->consultation_datetime)->isoFormat('D MMM Y H:mm'),
                $order->price,
                $order->status
            );
            // TODO раскомментировать добавление информации для админа
            /*if (request()->user()->role == Role::ADMIN()->getValue()) {
                $orderView->created_at = Carbon::createFromTimeString($order->created_at)
                    ->isoFormat('D MMM Y H:mm');
                $orderView->user_email = $order->user->email;
            }*/
            $result->orders[] = $orderView;
        }
        return $result;
    }

    private function anyOrderCollisions(int $notaryId, string $dateTime): bool
    {
        return Order::query()
                ->get()
                ->filter(
                    fn(Order $o) => $o->notary->id == $notaryId &&
                        $o->consultation_datetime == $dateTime &&
                        $o->status == OrderStatus::PROCESSING()->getValue()
                )->count() != 0;
    }
}
