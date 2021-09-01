<?php


namespace App\ViewModels;


class SubcategoryEditorViewModel
{
    public string $name;
    public int $price;
    public int $category_id;

    public function __construct(string $name, int $price, int $category_id)
    {
        $this->name = $name;
        $this->price = $price;
        $this->category_id = $category_id;
    }
}
