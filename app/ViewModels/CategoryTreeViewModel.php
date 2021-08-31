<?php


namespace App\ViewModels;


class CategoryTreeViewModel
{
    public int $id;
    public string $name;
    /**@var SubcategoryTreeViewModel[]*/
    public array $subcategories;

    /** @param SubcategoryTreeViewModel[] $subcategories */
    public function __construct(int $id, string $name, array $subcategories)
    {
        $this->id = $id;
        $this->name = $name;
        $this->subcategories = $subcategories;
    }
}
