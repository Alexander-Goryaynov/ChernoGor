<?php

namespace App\Http\Controllers;

use App\Interfaces\IScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private IScheduleService $sService;

    public function __construct(IScheduleService $sService)
    {
        $this->sService = $sService;
    }

    public function select(Request $request)
    {
        if ($request->missing('notary-id')) {
            return response('', 422);
        }
        return response()->json(
            $this->sService->getNotaryScheduleForSelect(
                $request->query('notary-id')
            )
        );
    }
}
