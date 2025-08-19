<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use Carbon\Traits\ToStringFormat;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    //

    public function edit($id)
    {
        $permission = Permissions::findOrFail($id);
        $allowed = [];
        if ($permission->allowed) {
            $groups = explode(';', $permission->allowed);
            foreach ($groups as $group) {
                [$code, $actions] = explode(':', $group);
                $allowed[$code] = explode(',', $actions);
            }
        }
        //dd($allowed);
        return view('Admin.access.edit', compact('permission', 'allowed'));
    }
    public function store(Request $request)
    {
        //dd($request->all());
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

        return to_route('access.show')->with('Success', 'Permission Created successfully.');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'user_group' => 'required|string|max:255',
            'permission' => 'required|array',
            'allowed' => 'nullable|array',
        ]);

        $permission = collect($request->permission)->implode('-');

        $allowedActions = collect($request->allowed)->map(function ($actions, $perm) {
            return $perm . ':' . implode(',', $actions);
        })->implode(';');

        $data = Permissions::findOrFail($id);
        $data->update([
            'user_group' => $request->user_group,
            'permission' => $permission,
            'allowed' => $allowedActions,
            'updated_at' => now(),
        ]);

        return redirect()->route('access.show')->with('Success', 'Permission Updated successfully.');
    }


    public function destroy($id)
    {
        $data = Permissions::findOrFail($id);
        $data->delete();

        return back()->with('Error', 'Permission deleted successfully.');
    }
}
