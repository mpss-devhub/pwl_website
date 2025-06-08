<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use Carbon\Traits\ToStringFormat;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    //
    public function store(Request $request)
    {
        $permission = collect($request->permission)->implode('-');
        $allowedArray = $request->allowed;
        $allowedActions = collect($allowedArray)->map(function ($actions, $perm) {
            return $perm . ':' . implode(',', $actions);
        })->implode(';');
        //dd($permission , $allowedActions);
        Permissions::create([
            'user_group' => $request->user_group,
            'permission' => $permission,
            'allowed' => $allowedActions,
            'created_at' => now(),
        ]);

        return to_route('access.show');
    }
}
