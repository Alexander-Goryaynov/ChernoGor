<?php


namespace App\Validators;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserValidator
{
    public static function validate(Request $request): void
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|min:3|max:30',
                'password' => 'required|string',
                'new_password' => 'sometimes|string|min:3|max:30',
                'new_password_confirmation' => 'required_with:new_password|same:new_password|string'
            ]
        );
        if ($validator->fails()) {
            Log::warning(
                "Account data validation failed",
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

    public static function validateUsersListQuery(Request $request): void
    {
        $sortingTypeRegex = '/^(last_ordered_at|orders_count|average_sum):(asc|desc)$/';
        $validator = Validator::make(
            $request->all(),
            [
                'sort' => ['sometimes', 'string', "regex:$sortingTypeRegex"]
            ]
        );
        if ($validator->fails()) {
            Log::warning(
                "Users list query validation failed",
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
