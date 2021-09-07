<?php


namespace App\Services;


use App\BindingModels\NotaryBindingModel;
use App\Enums\HourState;
use App\Helpers\ImageHelper;
use App\Interfaces\INotaryService;
use App\Models\Notary;
use App\Models\Qualification;
use App\Settings\Photo;
use App\ViewModels\NotariesSelectViewModel;
use App\ViewModels\NotariesViewModel;
use App\ViewModels\NotarySelectViewModel;
use App\ViewModels\NotaryViewModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NotaryService implements INotaryService
{
    public function createNotary(NotaryBindingModel $model): void
    {
        $this->removeScheduleForceRestrictions($model->schedule);
        $photoPath = ImageHelper::saveOnDisk($model->photo,
            'notaries/', Photo::WIDTH, Photo::HEIGHT);
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

    public function updateNotary(int $id, NotaryBindingModel $model): void
    {
        $this->removeScheduleForceRestrictions($model->schedule);
        /**@var Notary $notary*/
        $notary = Notary::query()->findOrFail($id);
        $notary->fio = $model->fio;
        $notary->description = $model->description;
        $notary->office_address = $model->officeAddress;
        $notary->qualification_id = $model->qualificationId;
        $notary->schedule = json_encode($model->schedule);
        if (isset($model->photo)) {
            Storage::delete($notary->photo_path);
            $notary->photo_path = ImageHelper::saveOnDisk($model->photo,
                'notaries/', Photo::WIDTH, Photo::HEIGHT);
        }
        $notary->save();
        Log::info(
            "Updated notary",
            [
                'ip' => request()->ip(),
                'id' => $id,
                'newData' => $model
            ]
        );
    }

    public function deleteNotary(int $id): void
    {
        // Also sets order.notary_id to null in database
        Notary::query()->findOrFail($id)->delete();
        Log::info(
            "Deleted notary",
            [
                'ip' => request()->ip(),
                'id' => $id
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
