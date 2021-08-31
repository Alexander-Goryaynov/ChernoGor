<?php


namespace App\Validators;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class SubcategoryValidator
{
    public static function validate(Request $request): void
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'price' => 'required|integer|min:1000',
                'category_id' => 'required|integer|min:0'
            ]
        );
        if ($validator->fails()) {
            Log::warning(
                'Subcategory validation failed',
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
