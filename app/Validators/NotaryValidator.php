<?php


namespace App\Validators;


use App\Enums\HourState;
use App\Settings\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class NotaryValidator
{
    public static function validate(Request $request): void
    {
        // TODO сделать фото необязательным при редактировании
        $fioPattern = '/^([а-яА-Я]+\s?){2,3}$/u';
        $baseImagePattern = "/^data:image\/(jpeg|png);base64,/";
        $validator = Validator::make(
            $request->all(),
            [
                'fio' => ['required', 'string', "regex:$fioPattern"],
                'description' => 'required|string|max:200',
                'photo' => ['required', 'string', "regex:$baseImagePattern"],
                'office_address' => 'required|string|max:200',
                'qualification_id' => 'required|integer|min:0',
                'schedule' => 'required|array'
            ]
        );
        if ($validator->fails()) {
            Log::warning(
                'Notary validation failed',
                [
                    'request' => [
                        'ip' => $request->ip(),
                        'user' => $request->user(),
                        'data' => $request->all()
                    ],
                    'failed rules' => $validator->errors()
                ]
            );
            Response::json($validator->errors(), 422)->send();
            exit();
        }
        if (static::validateSchedule($request->input('schedule')) == false) {
            Log::warning(
                'Notary schedule validation failed',
                [
                    'request' => [
                        'ip' => $request->ip(),
                        'user' => $request->user(),
                        'data' => $request->all()
                    ]
                ]
            );
            Response::json('Notary schedule validation failed', 422)->send();
            exit();
        }
    }

    /** @param int[][] $schedule */
    private static function validateSchedule(array $schedule): bool
    {
        if (count($schedule) !== Schedule::DAYS_COUNT) {
            return false;
        }
        foreach ($schedule as $day) {
            if (count($day) !== Schedule::HOURS_COUNT) {
                return false;
            }
            foreach ($day as $hourState) {
                if (HourState::isValid($hourState) == false) {
                    return false;
                }
            }
        }
        return true;
    }
}
