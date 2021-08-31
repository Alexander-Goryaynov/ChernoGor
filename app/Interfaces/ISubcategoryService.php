<?php


namespace App\Interfaces;


use App\BindingModels\SubcategoryBindingModel;
use App\ViewModels\SubcategoriesSelectViewModel;

interface ISubcategoryService
{
    public function createSubcategory(SubcategoryBindingModel $model): void;
    public function getSubcategoriesListForSelect(int $categoryId): SubcategoriesSelectViewModel;
}
