<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($request->user()->role === $role) {
            return $next($request);
        } else {
            return response()->json(
                [
                    'error' => [
                        'message' => "У Вас нет прав доступа к запрашиваемому ресурсу",
                        'details' => 'Forbidden (wrong user role)'
                    ]
                ],
                403
            );
        }
    }
}
