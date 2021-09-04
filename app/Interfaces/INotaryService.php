<?php


namespace App\Interfaces;


use App\BindingModels\NotaryBindingModel;

interface INotaryService
{
    public function createNotary(NotaryBindingModel $model): void;
}
