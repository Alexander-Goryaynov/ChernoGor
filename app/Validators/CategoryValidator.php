<?php


namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class CategoryValidator
{
    public static function validate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string'
            ]
        );
        if ($validator->fails()) {
            Log::warning(
                'Category validation failed',
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
