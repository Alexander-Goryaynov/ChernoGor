<?php


namespace App\Services;


use App\BindingModels\AccountBindingModel;
use App\Interfaces\IUserService;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

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
}
