<?php

namespace App\Http\Controllers;

use App\Interfaces\IQualificationService;

class QualificationController extends Controller
{
    private IQualificationService $qService;

    public function __construct(IQualificationService $qService)
    {
        $this->qService = $qService;
    }

    public function select()
    {
        return response()->json($this->qService->getQualificationsForSelect());
    }
}
