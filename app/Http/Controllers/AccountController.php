<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class AccountController extends Controller
{
    
    public function getAccount()
    {
        $user = auth()->user();
        return view('account', ['user' => $user]);
    }

    
    public function updateGeneralAccount(Request $request)
    {

        $current_password = Auth::User()->password;
        if (Hash::check($request['password'], $current_password)) {
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->email = $request->email;
            $obj_user->username =  $request->username;
            $obj_user->save();
            return redirect()->to('/account');
        } else {
            $this->validate($request, [

                'password' => ['required', 'string', 'min:4', 'confirmed'],
            ]);
        }
    }

    public function updatePasswordAccount(Request $request)
    {
        // dd($request->all());
        $current_password = Auth::User()->password;
        if (Hash::check($request['password1'], $current_password)) {
            if ($request->newpassword != $request->repeatpassword) {
                $this->validate($request, [

                    'repeatpassword' => ['required', 'string', 'min:4', 'confirmed'],
                ]);
            }

            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request['newpassword']);
            $obj_user->save();
            return redirect()->to('/account');
        } else {
            $this->validate($request, [

                'password1' => ['required', 'string', 'min:4', 'confirmed'],
            ]);
        }
    }
}
