<?php


namespace App\Services;


use App\BindingModels\NotaryBindingModel;
use App\Enums\HourState;
use App\Helpers\ImageHelper;
use App\Interfaces\INotaryService;
use App\Models\Notary;
use App\Models\Qualification;
use Illuminate\Support\Facades\Log;

class NotaryService implements INotaryService
{
    public function createNotary(NotaryBindingModel $model): void
    {
        $this->removeScheduleForceRestrictions($model->schedule);
        $photoPath = ImageHelper::saveOnDisk($model->photo, 'notaries/', 500, 500);
        $notary = new Notary();
        $notary->fio = $model->fio;
        $notary->description = $model->description;
        $notary->photo_path = $photoPath;
        $notary->office_address = $model->officeAddress;
        $notary->schedule = json_encode($model->schedule);
        /**@var Qualification $qualification */
        $qualification = Qualification::query()->findOrFail($model->qualificationId);
        $qualification->notaries()->save($notary);
        $newId = $notary->id;
        Log::info(
            'Created new notary',
            [
                'id' => $newId,
                'data' => $model
            ]
        );
    }

    /** @param int[][] $schedule */
    private function removeScheduleForceRestrictions(array &$schedule): void
    {
        foreach ($schedule as &$day) {
            foreach ($day as &$hourState) {
                if ($hourState == HourState::FORCE_ACTIVE()->getValue()) {
                    $hourState = HourState::ACTIVE();
                }
            }
            unset($hourState);
        }
        unset($day);
    }
}
