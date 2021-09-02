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

    public function select(Request $request)
    {
        if ($request->missing('category-id')) {
            return response('', 422);
        }
        return response()->json(
            $this->sService->getSubcategoriesListForSelect(
                $request->query('category-id')
            )
        );
    }

    public function edit(int $id)
    {
        return response()->json($this->sService->getSubcategoryForEditing($id));
    }

    public function update(Request $request, int $id)
    {
        SubcategoryValidator::validate($request);
        $this->sService->updateSubcategory($id, new SubcategoryBindingModel(
            $request->input('name'),
            $request->input('price'),
            $request->input('category_id')
        ));
    }

    public function destroy(int $id)
    {
        $this->sService->deleteSubcategory($id);
    }
}
