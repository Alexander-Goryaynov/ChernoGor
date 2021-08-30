<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($request->user()->role === $role) {
            return $next($request);
        } else {
            Log::warning('Access denied (wrong user role)', [
                'ip' => $request->ip(),
                'route' => $request->fullUrl(),
                'user' => $request->user()
            ]);
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
