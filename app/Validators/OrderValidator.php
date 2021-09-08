<?php


namespace App\Validators;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class OrderValidator
{
    public static function validate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'notary_id' => 'required|int|min:0',
                'subcategory_id' => 'required|int|min:0',
                'consultation_date' => ['required', 'string', 'regex:/[0-3][0-9]\s[а-я]{3}\s20[0-9]{2}/u'],
                'consultation_time' => ['required', 'string', 'regex:/[0-2][0-9]:[0-5][0-9]/']
            ]
        );
        if ($validator->fails()) {
            Log::warning(
                "Order data validation failed",
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
    }
}
