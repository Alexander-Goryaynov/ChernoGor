<?php


namespace App\Interfaces;


use App\BindingModels\NotaryBindingModel;
use App\ViewModels\NotariesSelectViewModel;
use App\ViewModels\NotariesViewModel;

interface INotaryService
{
    public function createNotary(NotaryBindingModel $model): void;

    public function getNotariesListForSelect(): NotariesSelectViewModel;

    public function getNotariesList(?int $qualificationId, ?string $searchFio): NotariesViewModel;
}
