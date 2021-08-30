<?php


namespace App\Services;


use App\CategoryBindingModel;
use App\Interfaces\ICategoryService;
use App\Models\Category;
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
}
