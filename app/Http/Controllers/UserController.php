<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SubmitNewUser;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;

class UserController extends Controller
{
    public function getUsers()
    {

        $users = DB::table('users')
        ->select('users.id',
        'users.name',
        'users.email',
        'roles.id as roleid',
        'roles.name as role',
        'roles.color as color')
        ->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
        ->leftjoin('roles', 'role_user.role_id', '=', 'roles.id')
        ->get();

        $useroles = RoleUser::select('role_user.*')
        ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
        ->get();

        $roles = Role::all();

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

    public function new_user(SubmitNewUser $request)
    {
        
        $newPassword = Hash::make($request['password']);

        $user = User::create(["password" => $newPassword]+$request->except(['SelectedRole']));
        
        RoleUser::create(['user_id'=>$user->id,'role_id' => $request['SelectedRole']]);


        return redirect()->to('/users');
    }



}
