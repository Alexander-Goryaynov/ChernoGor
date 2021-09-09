<?php


namespace App\Interfaces;


use App\BindingModels\OrderBindingModel;
use App\ViewModels\OrdersViewModel;

interface IOrderService
{
    public function createOrder(OrderBindingModel $model): void;

    public function cancelOrder(int $id): void;

    public function finishOrder(int $id): void;

    public function getOrdersList(?string $sortingColumn = null, ?string $sortingDirection = null): OrdersViewModel;
}
