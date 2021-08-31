<?php


namespace App\Services;


use App\BindingModels\SubcategoryBindingModel;
use App\Interfaces\ISubcategoryService;
use App\Models\Category;
use App\Models\Subcategory;
use App\ViewModels\SubcategoriesSelectViewModel;
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
}
