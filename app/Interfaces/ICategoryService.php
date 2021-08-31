<?php


namespace App\Interfaces;


use App\BindingModels\CategoryBindingModel;
use App\ViewModels\CategoriesSelectViewModel;
use App\ViewModels\CategoriesTreeViewModel;

interface ICategoryService
{
    public function createCategory(CategoryBindingModel $model): void;
    public function getTreeWithSubcategories(): CategoriesTreeViewModel;
    public function getCategoriesListForSelect(): CategoriesSelectViewModel;
}
