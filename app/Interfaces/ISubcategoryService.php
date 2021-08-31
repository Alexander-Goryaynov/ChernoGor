<?php


namespace App\Interfaces;


use App\BindingModels\SubcategoryBindingModel;

interface ISubcategoryService
{
    public function createSubcategory(SubcategoryBindingModel $model): void;
}
