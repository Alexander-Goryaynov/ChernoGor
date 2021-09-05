<?php


namespace App\Interfaces;


use App\BindingModels\NotaryBindingModel;
use App\ViewModels\NotariesSelectViewModel;

interface INotaryService
{
    public function createNotary(NotaryBindingModel $model): void;

    public function getNotariesListForSelect(): NotariesSelectViewModel;
}
