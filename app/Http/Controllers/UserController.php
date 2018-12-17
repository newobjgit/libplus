<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $roles = $request->roles;
        $user->roles()->detach();
        foreach ($roles as $role){
            $user->attachRole($role);
        }
        return back()->withMessage('Користувачі оновленні');
    }

    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.user.index')->with([ 'users' =>$users, 'roles'=>$roles ]);
    }

}
