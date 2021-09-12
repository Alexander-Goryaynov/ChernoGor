<?php


namespace App\Services;


use App\BindingModels\AccountBindingModel;
use App\Enums\Role;
use App\Interfaces\IUserService;
use App\Models\User;
use App\ViewModels\AccountsViewModel;
use App\ViewModels\AccountViewModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserService implements IUserService
{
    public function updateUser(int $id, AccountBindingModel $model): void
    {
        /** @var User $user */
        $user = User::query()->findOrFail($id);
        if (Hash::check($model->password, $user->password) == false) {
            throw new Exception("Wrong user's password");
        }
        $user->name = $model->name;
        if (isset($model->newPassword)) {
            $user->password = Hash::make($model->newPassword);
        }
        $user->save();
        Log::info(
            "Updated user",
            [
                'ip' => request()->ip(),
                'id' => $id,
                'newData' => $model
            ]
        );
    }

    public function getUsersList(?string $sortingColumn = null, ?string $sortingDirection = null): AccountsViewModel
    {
        $users = User::all();
        // Remove admin from the result
        $users = $users->filter(fn(User $u) => $u->role != Role::ADMIN()->getValue());
        $result = new AccountsViewModel();
        foreach ($users as $user) {
            $crb = Carbon::createFromTimeString($user->created_at);
            $createdAt = $crb->isoFormat('DD MMM Y HH:mm');
            $ordersCount = $user->orders()->count();
            $ordersAverageSum = ($ordersCount > 0) ? $user->orders()->average('price') : 0;
            $lastOrderedAt = '';
            if ($ordersCount > 0) {
                $lastOrderTimestamp = $user
                    ->orders()
                    ->orderByDesc('created_at')
                    ->first()
                    ->created_at;
                $crb = Carbon::createFromTimeString($lastOrderTimestamp);
                $lastOrderedAt = "{$crb->isoFormat('DD MMM Y HH:mm')} ({$crb->diffForHumans()})";
            }
            $result->accounts[] = new AccountViewModel(
                $user->email,
                $user->name,
                $createdAt,
                $ordersCount,
                $ordersAverageSum,
                $lastOrderedAt
            );
        }
        // Sorting
        if (isset($sortingColumn, $sortingDirection)) {
            $isDescending = ($sortingDirection == 'desc');
            if ($sortingColumn == 'last_ordered_at') {
                $result->accounts = collect($result->accounts)
                    ->sort($this->getLastOrderDateComparator($isDescending))
                    ->values()
                    ->toArray();
            } else {
                $result->accounts = collect($result->accounts)
                    ->sortBy($sortingColumn, SORT_REGULAR, $isDescending)
                    ->values()
                    ->toArray();
            }
        }
        return $result;
    }

    private function getLastOrderDateComparator(bool $isDescending): callable
    {
        return function(AccountViewModel $a, AccountViewModel $b) use ($isDescending): int {
            // Model without orders will always be in the end
            if ($a->last_ordered_at == '') {
                return 1;
            }
            if ($b->last_ordered_at == '') {
                return -1;
            }
            // Models with orders are compared as usual by last order date
            // Convert each model to Carbon instance of its last order datetime
            [$aCrb, $bCrb] = collect([$a, $b])->map(
                fn(AccountViewModel $model) => Carbon::createFromLocaleIsoFormat(
                    'DD MMM Y HH:mm',
                    config('app.locale'),
                    // Retrieve only datetime without human description
                    Str::of($model->last_ordered_at)->explode(' (')[0]
                )
            )->toArray();
            return ($isDescending) ? ($aCrb < $bCrb) : ($aCrb > $bCrb);
        };
    }
}
