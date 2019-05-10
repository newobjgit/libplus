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
        $user->roles()->detach();
        $user->attachRole($request->roles);
        return back()->withMessage('Користувач оновлен!');
    }

    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.user.index')->with([ 'users' =>$users, 'roles'=>$roles ]);
    }

    public function edit($id)
    {
        $user=User::find($id);
        $roles =Role::all();               
        
        return view('admin.user.edit',compact(['user','roles']));
    }

}
