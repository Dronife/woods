<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Type;
use App\Models\Age;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\backendController;

class ConfigurationController extends Controller
{

     

    public function config()
    {

        $ages =  Age::all()->count();
        $types =  Type::all()->count();
        $roles =  Role::all()->Count();
        return view('config', ['ages' => $ages, 'types' => $types, 'roles' => $roles]);
    }


    public function configCreateDefaults(Request $request)
    {
       
        if ($request->has('typeForm')) {

            Type::create(['name' => 'Boreal', 'value' => 73]);
            Type::create(['name' => 'Mixed', 'value' => 62]);
            Type::create(['name' => 'Temperate', 'value' => 51]);

        } elseif ($request->has('ageForm')) {

            Age::create(['name' => 'Young', 'value' => 25]);
            Age::create(['name' => 'Wise', 'value' => 50]);

        } else {

            Role::create(['name' => 'admin', 'color' => 'success']);
            Role::create(['name' => 'user', 'color' => 'light']);

            $user =  User::all()->count();

            if ($user > 0) {
                $userAll =  DB::table('users')->get();
                $roleSimpleUser =   backendController::get_role_id('user');

                for ($i = 0; $i < count($userAll); $i++) {
                    if($userAll[$i]->id != Auth::id())
                        backendController::role_userInsert($userAll[$i]->id, $roleSimpleUser);
                }
            }

           

        }

        return redirect()->to('/configuration');
    }
}
