<?php

namespace App\Http\Controllers;

use App\BindingModels\AccountBindingModel;
use App\Interfaces\IUserService;
use App\Validators\UserValidator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    private IUserService $uService;

    public function __construct(IUserService $uService)
    {
        $this->uService = $uService;
    }

    public function update(Request $request)
    {
        UserValidator::validate($request);
        try {
            $this->uService->updateUser(
                $request->user()->id,
                new AccountBindingModel(
                    $request->input('name'),
                    $request->input('password'),
                    $request->input('new_password')
                )
            );
        } catch (Exception $ex) {
            Log::warning(
                "User update failed. Wrong password",
                [
                    'request' => [
                        'ip' => $request->ip(),
                        'user' => $request->user(),
                        'data' => $request->all()
                    ]
                ]
            );
            return response('', 401);
        }
    }
}
