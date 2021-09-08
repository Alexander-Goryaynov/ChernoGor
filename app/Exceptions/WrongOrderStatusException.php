<?php


namespace App\Exceptions;


use App\Enums\OrderStatus;
use Exception;

class WrongOrderStatusException extends Exception
{
    private OrderStatus $currentStatus;
    private OrderStatus $unreachableStatus;

    public function __construct(OrderStatus $currentStatus, OrderStatus $unreachableStatus)
    {
        parent::__construct();
        $this->currentStatus = $currentStatus;
        $this->unreachableStatus = $unreachableStatus;
    }

    public function context()
    {
        return [
            'ip' => request()->ip(),
            'user' => request()->user(),
            'currentStatus' => $this->currentStatus,
            'unreachableStatus' => $this->unreachableStatus
        ];
    }

    public function render()
    {
        return response()->json([
            'message' => "Невозможно перевести заказ из статуса {$this->currentStatus->getValue()} в статус {$this->unreachableStatus->getValue()}",
            'detail' => "Cannot change order status from {$this->currentStatus->getValue()} to {$this->unreachableStatus->getValue()}"
        ], 422);
    }
}
