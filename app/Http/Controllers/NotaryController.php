<?php

namespace App\Http\Controllers;

use App\BindingModels\NotaryBindingModel;
use App\Interfaces\INotaryService;
use App\Validators\NotaryValidator;
use Illuminate\Http\Request;

class NotaryController extends Controller
{
    private INotaryService $nService;

    public function __construct(INotaryService $nService)
    {
        $this->nService = $nService;
    }

    public function store(Request $request)
    {
        NotaryValidator::validate($request);
        $this->nService->createNotary(new NotaryBindingModel(
            $request->input('fio'),
            $request->input('description'),
            $request->input('photo'),
            $request->input('office_address'),
            $request->input('qualification_id'),
            $request->input('schedule')
        ));
        return response('', 201);
    }

    public function select()
    {
        return response()->json($this->nService->getNotariesListForSelect());
    }

    public function index(Request $request)
    {
        return response()->json(
            $this->nService->getNotariesList(
                $request->query('qualification-id'),
                $request->query('search-fio')
            ),
            200,
            [],
            JSON_UNESCAPED_SLASHES
        );
    }
}
