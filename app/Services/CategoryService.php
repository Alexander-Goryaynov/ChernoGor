<?php


namespace App\Services;


use App\BindingModels\CategoryBindingModel;
use App\Interfaces\ICategoryService;
use App\Models\Category;
use App\Models\Subcategory;
use App\ViewModels\CategoriesSelectViewModel;
use App\ViewModels\CategoriesTreeViewModel;
use App\ViewModels\CategoryEditorViewModel;
use App\ViewModels\CategorySelectViewModel;
use App\ViewModels\CategoryTreeViewModel;
use App\ViewModels\SubcategoryTreeViewModel;
use Illuminate\Support\Facades\Log;

class CategoryService implements ICategoryService
{

    public function createCategory(CategoryBindingModel $model): void
    {
        $category = new Category();
        $category->name = $model->name;
        $category->save();
        Log::info(
            'Created new category',
            ['id' => $category->id]
        );
    }

    public function getTreeWithSubcategories(): CategoriesTreeViewModel
    {
        $result = new CategoriesTreeViewModel();
        $categories = Category::all();
        foreach ($categories as $category) {
            $subcategories = [];
            $category->subcategories()->get()->map(
                function(Subcategory $subcat) use (&$subcategories) {
                    $subcategories[] = new SubcategoryTreeViewModel(
                        $subcat->id,
                        $subcat->name,
                        $subcat->price
                    );
                }
            );
            $result->categories[] = new CategoryTreeViewModel(
                $category->id,
                $category->name,
                $subcategories
            );
        }
        return $result;
    }

    public function getCategoriesListForSelect(): CategoriesSelectViewModel
    {
        $result = new CategoriesSelectViewModel();
        $result->categories = Category::all()
            ->map(fn (Category $cat) => new CategorySelectViewModel($cat->id, $cat->name))
            ->toArray();
        return $result;
    }

    public function getCategoryForEditing(int $id): CategoryEditorViewModel
    {
        /**@var Category $category*/
        $category = Category::query()->findOrFail($id);
        return new CategoryEditorViewModel($category->name);
    }

    public function updateCategory(int $id, CategoryBindingModel $model): void
    {
        /**@var Category $category*/
        $category = Category::query()->findOrFail($id);
        $category->name = $model->name;
        $category->save();
        Log::info(
            "Updated category",
            [
                'ip' => request()->ip(),
                'id' => $id,
                'newData' => $model
            ]
        );
    }
}
