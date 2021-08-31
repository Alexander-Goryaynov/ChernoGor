<?php


namespace App\BindingModels;


class SubcategoryBindingModel
{
    public string $name;
    public int $price;
    public int $categoryId;

    public function __construct(string $name, int $price, int $categoryId)
    {
        $this->name = $name;
        $this->price = $price;
        $this->categoryId = $categoryId;
    }
}
