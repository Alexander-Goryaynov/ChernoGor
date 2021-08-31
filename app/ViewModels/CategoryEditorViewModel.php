<?php


namespace App\ViewModels;


class CategoryEditorViewModel
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
