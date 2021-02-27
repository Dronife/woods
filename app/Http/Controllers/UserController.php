<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers()
    {

        $users = DB::table('users')
            ->select('id', 'name', 'email')
            ->get();

        $useroles = DB::table('role_user')
            ->select('roles.name', 'user_id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->get();

        $useroles = DB::table('role_user')
            ->select('roles.id', 'roles.name', 'user_id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->get();

        $roles = DB::table('roles')
            ->get();
        return view('userList', ['users' => $users, 'useroles' => $useroles, 'roles' => $roles]);
    }

    
    public function delete_user($id)
    {
        DB::table('role_user')->where('user_id', $id)->delete();
        DB::table('users')->where('users.id', $id)->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function submit_updated(Request $request)
    {

        for ($i = 0; $i < count($request->userids); $i++) {

            DB::table('role_user')
                ->where('user_id', $request->userids[$i])
                ->update((['role_id' => $request->roleOptions[$i]]));
        }

        return redirect()->to('/users');
    }

    public function new_user(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'SelectedRole' => ['required'],
        ]);
        $newPassword = Hash::make($request['password']);
        DB::insert("insert into users (name, username, email, password)
          values (?,?,?,?)", [$request['name'], $request['username'], $request['email'], $newPassword]);



        $user_id = DB::getPdo()->lastInsertId();

        DB::insert("insert into role_user (user_id, role_id)
          values (?,?)", [$user_id, $request['SelectedRole']]);

        return redirect()->to('/users');
    }



}
