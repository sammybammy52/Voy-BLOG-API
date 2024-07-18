<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('token') !== 'vg@123') {
            return response()->json(['success' => false ,'error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

