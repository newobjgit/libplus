<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Role;




class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index')->with('roles', $roles);
    }

    public function edit($id)
    {
        $role=Role::find($id);
        $permissions = Permission::all();
        $role_permissions = $role->permissions()->pluck('id','id')->toArray();
        return view('admin.role.edit',compact(['role','role_permissions','permissions']));
    }

    public function update(Request $request, $id)
    {
        $role=Role::find($id);
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        $role->permissions()->detach();
        foreach ($request->permission as $key => $value) {
            $role->attachPermission($value);            }

        return redirect()->route('role.index')->withMessage('Права оновленні');
    }
}
