<?php


namespace App\Exceptions;


use App\BindingModels\OrderBindingModel;
use Exception;

class OrdersCollisionException extends Exception
{
    private OrderBindingModel $model;

    public function __construct(OrderBindingModel $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function context()
    {
        return [
            'ip' => request()->ip(),
            'user' => request()->user(),
            'data' => $this->model
        ];
    }

    public function render()
    {
        return response()->json([
            'message' => "Уже существует заказ к данному нотариусу на это время",
            'detail' => 'Order with same notary and datetime already exists'
        ], 422);
    }
}
