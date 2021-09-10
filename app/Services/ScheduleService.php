<?php


namespace App\Services;

use App\Enums\HourState;
use App\Enums\OrderStatus;
use App\Interfaces\IScheduleService;
use App\Models\Notary;
use App\Models\Order;
use App\Settings\Schedule;
use App\ViewModels\ScheduleDayViewModel;
use App\ViewModels\ScheduleViewModel;
use Carbon\Carbon;

class ScheduleService implements IScheduleService
{
    public function getNotaryScheduleForSelect(int $notaryId): ScheduleViewModel
    {
        /**@var Notary $notary */
        $notary = Notary::query()->findOrFail($notaryId);
        // FIXME изменить тип schedule на string, убрать каст
        $schedule = json_decode((string)$notary->schedule, true);
        // 2D-Array for grouping results by date
        $result = [];
        $dateTime = Carbon::now()->startOfHour();
        // For every day of future week (this day and next 6 days)
        $lastDay = $dateTime->day + 7;
        for ($curDay = $dateTime->day; $curDay < $lastDay; $curDay++) {
            // If user came too late or current day is Sunday
            if ($dateTime->dayOfWeekIso == 7 || $dateTime->hour >= Schedule::MAX_HOUR) {
                // Go to the next day's morning
                $dateTime->day++;
                $dateTime->hour = Schedule::MIN_HOUR - 1;
                continue;
            }
            $dateTime->hour = ($dateTime->hour < Schedule::MIN_HOUR) ?
                // If the user came too early, search from min hour
                Schedule::MIN_HOUR :
                // else search from the next hour
                $dateTime->hour + 1;
            // For every future hour of this day
            for ($curHour = $dateTime->hour; $curHour <= Schedule::MAX_HOUR; $curHour++) {
                $scheduleRow = $dateTime->dayOfWeekIso - 1;
                $scheduleCol = $dateTime->hour - Schedule::MIN_HOUR;
                // If notary is active at the current hour
                if ($schedule[$scheduleRow][$scheduleCol] == HourState::ACTIVE()->getValue()) {
                    // and if notary doesn't have any orders at current hour
                    $isFree = Order::query()
                            ->get()
                            ->filter(
                                fn(Order $o) => $o->status == OrderStatus::PROCESSING()->getValue() &&
                                    $o->consultation_datetime == $dateTime->toDateTimeString() &&
                                    $o->notary->id == $notaryId
                            )->count() == 0;
                    if ($isFree) {
                        $date = $dateTime->isoFormat('DD MMM Y');
                        $time = $dateTime->isoFormat('HH:mm');
                        $result[$date][] = $time;
                    }
                }
                // Go to the next hour
                $dateTime->hour++;
            }
            // Go to the morning of the next day
            $dateTime->hour = Schedule::MIN_HOUR - 1;
            $dateTime->day++;
        }
        return $this->convertToScheduleViewModel($result);
    }

    /** @param string[][] $schedule */
    private function convertToScheduleViewModel(array $schedule): ScheduleViewModel
    {
        $result = new ScheduleViewModel();
        foreach ($schedule as $date => $times) {
            $dayModel = new ScheduleDayViewModel($date, $times);
            $result->dates[] = $dayModel;
        }
        return $result;
    }
}
