<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return to_route('main.home');
        }

        return $next($request);
    }
}
