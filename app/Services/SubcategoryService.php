<?php


namespace App\Services;


use App\BindingModels\SubcategoryBindingModel;
use App\Interfaces\ISubcategoryService;
use App\Models\Category;
use App\Models\Subcategory;
use App\ViewModels\SubcategoriesSelectViewModel;
use App\ViewModels\SubcategoryEditorViewModel;
use App\ViewModels\SubcategorySelectViewModel;
use Illuminate\Support\Facades\Log;

class SubcategoryService implements ISubcategoryService
{

    public function createSubcategory(SubcategoryBindingModel $model): void
    {
        $subcategory = new Subcategory();
        $subcategory->name = $model->name;
        $subcategory->price = $model->price;
        /**@var $category Category */
        $category = Category::query()->findOrFail($model->categoryId);
        $category->subcategories()->save($subcategory);
        Log::info(
            'Created new subcategory',
            ['id' => $subcategory->id]
        );
    }

    public function getSubcategoriesListForSelect(int $categoryId): SubcategoriesSelectViewModel
    {
        $result = new SubcategoriesSelectViewModel();
        $result->subcategories = Subcategory::query()->where(
            'category_id', '=', $categoryId
        )->get()->map(
            fn(Subcategory $sub) => new SubcategorySelectViewModel(
                $sub->id,
                $sub->name,
                $sub->price
            )
        )->toArray();
        return $result;
    }

    public function getSubcategoryForEditing(int $id): SubcategoryEditorViewModel
    {
        /**@var Subcategory $subcategory*/
        $subcategory = Subcategory::query()->findOrFail($id);
        return new SubcategoryEditorViewModel(
            $subcategory->name,
            $subcategory->price,
            $subcategory->category->id
        );
    }

    public function updateSubcategory(int $id, SubcategoryBindingModel $model): void
    {
        /**@var Subcategory $subcategory*/
        $subcategory = Subcategory::query()->findOrFail($id);
        $subcategory->name = $model->name;
        $subcategory->price = $model->price;
        $subcategory->category_id = $model->categoryId;
        $subcategory->save();
        Log::info(
            "Updated subcategory",
            [
                'ip' => request()->ip(),
                'id' => $id,
                'newData' => $model
            ]
        );
    }

    public function deleteSubcategory(int $id): void
    {
        // Also sets order.subcategory_id to null in database
        Subcategory::query()->findOrFail($id)->delete();
        Log::info(
            "Deleted subcategory",
            [
                'ip' => request()->ip(),
                'id' => $id
            ]
        );
    }
}
