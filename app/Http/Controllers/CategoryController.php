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

    public function tree()
    {
        return response()->json($this->cService->getTreeWithSubcategories());
    }

    public function select()
    {
        return response()->json($this->cService->getCategoriesListForSelect());
    }

    public function edit(Request $request, int $id)
    {
        return response()->json($this->cService->getCategoryForEditing($id));
    }

    public function update(Request $request, int $id)
    {
        CategoryValidator::validate($request);
        $this->cService->updateCategory($id, new CategoryBindingModel($request->input('name')));
    }
}
