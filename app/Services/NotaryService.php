<?php


namespace App\Services;


use App\BindingModels\NotaryBindingModel;
use App\Enums\HourState;
use App\Helpers\ImageHelper;
use App\Interfaces\INotaryService;
use App\Models\Notary;
use App\Models\Qualification;
use App\ViewModels\NotariesSelectViewModel;
use App\ViewModels\NotariesViewModel;
use App\ViewModels\NotarySelectViewModel;
use App\ViewModels\NotaryViewModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NotaryService implements INotaryService
{
    public function createNotary(NotaryBindingModel $model): void
    {
        $this->removeScheduleForceRestrictions($model->schedule);
        $photoPath = ImageHelper::saveOnDisk($model->photo, 'notaries/', 240, 240);
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

    public function getNotariesListForSelect(): NotariesSelectViewModel
    {
        $result = new NotariesSelectViewModel();
        $result->notaries = Notary::query()
            ->get()
            ->map(
                fn(Notary $n) => new NotarySelectViewModel(
                    $n->id,
                    $n->fio,
                    $n->qualification->coefficient
                )
            )->toArray();
        return $result;
    }

    public function getNotariesList(?int $qualificationId, ?string $searchFio): NotariesViewModel
    {
        $result = new NotariesViewModel();
        $notaries = Notary::all();
        if (isset($qualificationId)) {
            $notaries = $notaries->filter(
                fn(Notary $n) => $n->qualification->id == $qualificationId
            );
        }
        if (isset($searchFio)) {
            $searchFio = Str::of($searchFio)->lower();
            $notaries = $notaries->filter(
                function(Notary $n) use ($searchFio) {
                    return Str::of($n->fio)->lower()->contains($searchFio);
                }
            );
        }
        $result->notaries = $notaries
            ->map(
                fn(Notary $n) => new NotaryViewModel(
                    $n->id,
                    $n->fio,
                    $n->description,
                    ImageHelper::loadFromDisk($n->photo_path),
                    $n->office_address,
                    $n->qualification->name
                )
            )->values()->toArray();
        return $result;
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
