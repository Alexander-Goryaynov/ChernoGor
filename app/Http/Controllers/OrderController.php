<?php

namespace App\Http\Controllers;

use App\BindingModels\OrderBindingModel;
use App\Interfaces\IOrderService;
use App\Validators\OrderValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    private IOrderService $oService;

    public function __construct(IOrderService $oService)
    {
        $this->oService = $oService;
    }

    public function store(Request $request)
    {
        OrderValidator::validateNewOrder($request);
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

    public function index(Request $request)
    {
        OrderValidator::validateOrderListQuery($request);
        if ($request->has('sort')) {
            [$column, $direction] = Str::of($request->query('sort'))->explode(':');
            return response()->json($this->oService->getOrdersList($column, $direction));
        } else {
            return response()->json($this->oService->getOrdersList());
        }
    }
}
