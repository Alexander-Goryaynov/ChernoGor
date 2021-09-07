<?php


namespace App\Interfaces;


use App\BindingModels\AccountBindingModel;

interface IUserService
{
    public function updateUser(int $id, AccountBindingModel $model): void;
}
