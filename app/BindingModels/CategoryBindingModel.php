<?php


namespace App\BindingModels;


class CategoryBindingModel
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
