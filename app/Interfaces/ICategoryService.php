<?php


namespace App\Interfaces;


use App\CategoryBindingModel;

interface ICategoryService
{
    public function createCategory(CategoryBindingModel $model): void;
}
