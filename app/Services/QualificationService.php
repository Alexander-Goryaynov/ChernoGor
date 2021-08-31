<?php


namespace App\Services;


use App\Interfaces\IQualificationService;
use App\Models\Qualification;
use App\ViewModels\QualificationSelectViewModel;
use App\ViewModels\QualificationsSelectViewModel;

class QualificationService implements IQualificationService
{

    public function getQualificationsForSelect(): QualificationsSelectViewModel
    {
        $result = new QualificationsSelectViewModel();
        $qualifications = Qualification::all();
        $qualifications->each(
            function(Qualification $q) use ($result) {
                $result->qualifications[] = new QualificationSelectViewModel($q->id, $q->name);
            }
        );
        return $result;
    }
}
