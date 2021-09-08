<?php


namespace App\Interfaces;


use App\BindingModels\OrderBindingModel;

interface IOrderService
{
    public function createOrder(OrderBindingModel $model): void;

    public function cancelOrder(int $id): void;

    public function finishOrder(int $id): void;
}
