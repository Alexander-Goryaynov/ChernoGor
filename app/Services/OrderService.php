<?php


namespace App\Services;


use App\BindingModels\OrderBindingModel;
use App\Enums\OrderStatus;
use App\Exceptions\OrdersCollisionException;
use App\Interfaces\IOrderService;
use App\Models\Notary;
use App\Models\Order;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OrderService implements IOrderService
{
    public function createOrder(OrderBindingModel $model): void
    {
        $consultationDatetime = "{$model->consultationDate} {$model->consultationTime}";
        $carbon = Carbon::createFromLocaleIsoFormat('DD MMMM Y HH:mm', 'ru_RU', $consultationDatetime);
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

    private function anyOrderCollisions(int $notaryId, string $dateTime): bool
    {
        return Order::query()
                ->get()
                ->filter(
                    fn(Order $o) => $o->notary_id == $notaryId &&
                        $o->consultation_datetime == $dateTime
                )->count() != 0;
    }
}
