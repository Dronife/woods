<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Type;
use App\Models\Age;
use App\Models\Pic;
use App\Models\Forest;
use App\Models\RoleUser;
use App\Models\Role;

class backendController extends Controller
{

   

    public static function urole(){
        
        return Auth::user()->roles->pluck('name')[0];
    }


    public function user()
    { 

        $role = backendController::urole();
        
        $submitedForests = ForestController::getSubmitions($role);
        $submittedCount =  ForestController::userSubmitedForestCount($role);
        
        $pictureCount = [];
        
        foreach ($submitedForests  as $key => $data)
            array_push($pictureCount, backendController::getPictureCount($data->id));
            

        $config = backendController::getFOrestConf();

        return view('admin', ['submitedForests' => $submitedForests, 'config' => $config, 'pictureCount'=> $pictureCount,
         'submittedCount' => $submittedCount , 'role'=>$role]);
    }


    public static function getPictureCount($id)
    {
        return Pic::where('forest_id',$id)->count();
    }
   

    public static function getFOrestConf()
    {
        $types = Type::get();
        $ages = Age::get();
        return  [$types, $ages];
    }

    public static function role_userInsert($userid, $roleid)
    {
        RoleUser::create(['user_id'=>$userid, 'role_id'=>$roleid]);
    }


    public static function get_role_id($role_name)
    {
        $role_id = Role::select('id')->where('name',$role_name)->get();
        return $role_id[0]->id;
    }



  
}
