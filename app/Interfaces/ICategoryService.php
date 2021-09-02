<?php


namespace App\Interfaces;


use App\BindingModels\CategoryBindingModel;
use App\ViewModels\CategoriesSelectViewModel;
use App\ViewModels\CategoriesTreeViewModel;
use App\ViewModels\CategoryEditorViewModel;

interface ICategoryService
{
    public function createCategory(CategoryBindingModel $model): void;

    public function getTreeWithSubcategories(): CategoriesTreeViewModel;

    public function getCategoriesListForSelect(): CategoriesSelectViewModel;

    public function getCategoryForEditing(int $id): CategoryEditorViewModel;

    public function updateCategory(int $id, CategoryBindingModel $model): void;

    public function deleteCategory(int $id): void;
}
