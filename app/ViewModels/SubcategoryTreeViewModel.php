<?php


namespace App\ViewModels;


class SubcategoryTreeViewModel
{
    public int $id;
    public string $name;
    public int $price;

    public function __construct(int $id, string $name, int $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
}
