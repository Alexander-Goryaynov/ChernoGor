<?php


namespace App\Interfaces;


use App\BindingModels\AccountBindingModel;
use App\ViewModels\AccountsViewModel;

interface IUserService
{
    public function updateUser(int $id, AccountBindingModel $model): void;

    public function getUsersList(?string $sortingColumn = null, ?string $sortingDirection = null): AccountsViewModel;
}
