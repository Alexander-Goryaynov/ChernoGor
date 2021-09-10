<?php

namespace App\Interfaces;

use App\ViewModels\ScheduleViewModel;

interface IScheduleService
{
    public function getNotaryScheduleForSelect(int $notaryId): ScheduleViewModel;
}
