<?php


namespace App\Interfaces;


use App\BindingModels\CategoryBindingModel;

interface ICategoryService
{
    public function createCategory(CategoryBindingModel $model): void;
}
