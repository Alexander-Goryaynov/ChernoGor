<?php

namespace App\Http\Controllers;

use App\BindingModels\SubcategoryBindingModel;
use App\Interfaces\ISubcategoryService;
use App\Validators\SubcategoryValidator;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    private ISubcategoryService $sService;

    public function __construct(ISubcategoryService $sService)
    {
        $this->sService = $sService;
    }

    public function store(Request $request)
    {
        SubcategoryValidator::validate($request);
        $this->sService->createSubcategory(
            new SubcategoryBindingModel(
                $request->input('name'),
                $request->input('price'),
                $request->input('category_id')
            )
        );
    }
}
