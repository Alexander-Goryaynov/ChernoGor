<?php

namespace App\Http\Controllers;

use App\BindingModels\CategoryBindingModel;
use App\Interfaces\ICategoryService;
use App\Validators\CategoryValidator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private ICategoryService $cService;

    public function __construct(ICategoryService $cService)
    {
        $this->cService = $cService;
    }

    public function store(Request $request)
    {
        CategoryValidator::validate($request);
        $this->cService->createCategory(
            new CategoryBindingModel(
                $request->input('name')
            )
        );
        return response('', 201);
    }
}
