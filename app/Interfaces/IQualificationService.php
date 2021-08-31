<?php


namespace App\Interfaces;


use App\ViewModels\QualificationsSelectViewModel;

interface IQualificationService
{
    public function getQualificationsForSelect(): QualificationsSelectViewModel;
}
