<?php


namespace App;


class CategoryBindingModel
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
