<?php


namespace App\Interfaces;


use App\BindingModels\NotaryBindingModel;
use App\ViewModels\NotariesSelectViewModel;
use App\ViewModels\NotariesViewModel;
use App\ViewModels\NotaryEditorViewModel;

interface INotaryService
{
    public function createNotary(NotaryBindingModel $model): void;

    public function getNotariesListForSelect(): NotariesSelectViewModel;

    public function getNotariesList(?int $qualificationId, ?string $searchFio): NotariesViewModel;

    public function getNotaryForEditing(int $id): NotaryEditorViewModel;

    public function updateNotary(int $id, NotaryBindingModel $model): void;

    public function deleteNotary(int $id): void;
}
