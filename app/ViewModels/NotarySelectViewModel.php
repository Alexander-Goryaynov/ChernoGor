<?php


namespace App\ViewModels;


class NotarySelectViewModel
{
    public int $id;
    public string $fio;
    public float $coefficient;

    public function __construct(int $id, string $fio, float $coefficient)
    {
        $this->id = $id;
        $this->fio = $fio;
        $this->coefficient = $coefficient;
    }
}
