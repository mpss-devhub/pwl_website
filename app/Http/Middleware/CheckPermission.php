<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = Auth::user();
        $permissions = array_map('strtoupper', array_map('trim', explode('-', $user->permission->permission)));

        $permission = strtoupper(trim($permission));
        //dd($permissions, $permission);
        if (!in_array($permission, $permissions)) {
            return redirect()->route('admin.dashboard')
                ->with('Error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
