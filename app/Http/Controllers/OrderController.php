<?php

namespace App\Http\Controllers;

use App\BindingModels\OrderBindingModel;
use App\Interfaces\IOrderService;
use App\Validators\OrderValidator;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private IOrderService $oService;

    public function __construct(IOrderService $oService)
    {
        $this->oService = $oService;
    }

    public function store(Request $request)
    {
        OrderValidator::validate($request);
        $this->oService->createOrder(new OrderBindingModel(
            $request->input('notary_id'),
            $request->input('subcategory_id'),
            $request->input('consultation_date'),
            $request->input('consultation_time')
        ));
        return response('', 201);
    }

    public function cancel(int $id)
    {
        $this->oService->cancelOrder($id);
    }

    public function finish(int $id)
    {
        $this->oService->finishOrder($id);
    }
}
