<?php


namespace App\Interfaces;


use App\BindingModels\SubcategoryBindingModel;
use App\ViewModels\SubcategoriesSelectViewModel;
use App\ViewModels\SubcategoryEditorViewModel;

interface ISubcategoryService
{
    public function createSubcategory(SubcategoryBindingModel $model): void;

    public function getSubcategoriesListForSelect(int $categoryId): SubcategoriesSelectViewModel;

    public function getSubcategoryForEditing(int $id): SubcategoryEditorViewModel;

    public function updateSubcategory(int $id, SubcategoryBindingModel $model): void;

    public function deleteSubcategory(int $id): void;
}
