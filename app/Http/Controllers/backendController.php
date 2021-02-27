<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth\ReigsterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Str;
use Illuminate\Support\Facades\DB;

class backendController extends Controller
{

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userCheck()
    {
        
        return redirect()->to('/userpanel');
    }

    public static function urole(){
        $role =Auth::user()->roles->pluck('name');
        return $role[0];
    }


    public function user()

    { 

        $role = backendController::urole();
        $selectQuery = ['forests.id','surname','lastname','phone','price','area','email','types.name as typeid','ages.name as ageid'];
        
        
            $rawsubmittedCount =  DB::table('forests')
        ->select(DB::raw("COUNT(*) as count"))
        ->get();

        
        $types = DB::table('forests')
            ->select(
                $selectQuery
                )
                ->leftJoin('types', 'forests.typeid', '=', 'types.id')
                ->leftjoin('ages', 'forests.ageid', '=', 'ages.id')
                ->get();
        if($role == 'user'){
        $types = DB::table('forests')
        ->select(
            $selectQuery
            )
            ->leftJoin('types', 'forests.typeid', '=', 'types.id')
            ->leftjoin('ages', 'forests.ageid', '=', 'ages.id')
            ->where('userid',Auth::user()->id)
            ->get();
            $rawsubmittedCount =  DB::table('forests')
            ->select(DB::raw("COUNT(*) as count"))
            ->where('userid',Auth::user()->id)
            ->get();
        }

        $pictureCount = backendController::getPictureCount(); 

        $config = backendController::getFOrestConf();

        return view('admin', ['types' => $types, 'config' => $config, 'pictureCount'=> $pictureCount,
         'submittedCount' =>$rawsubmittedCount[0]->count, 'role'=>$role]);
    }

    public static function getPictureCount()
    {
        $pictureCount =  DB::table('pics')
        ->select(
            DB::raw("COUNT(forest_id) as count"),
            'forest_id'
        )
        ->groupBy('forest_id')
        ->get();
        return $pictureCount;
    }
   

    public static function getFOrestConf()
    {
        $types = DB::table('types')
            ->select(
                'id',
                'name')
            ->get();
        $ages = DB::table('ages')
            ->select(
                'id',
                'name')
            ->get();

        return  [$types, $ages];
    }


    public function setUserRole($userid, $roleid)
    {
        DB::insert("insert into role_user (user_id, role_id)
          values (?,?)", [$userid, $roleid]);
    }


    public function config()
    {
        

        $ages =  DB::table('ages')
        ->select(
            DB::raw("COUNT(*) as count")
        )
        ->get();

        $types =  DB::table('types')
        ->select(
            DB::raw("COUNT(*) as count")
        )
        ->get();

        $roles =  DB::table('roles')
        ->select(
            DB::raw("COUNT(*) as count")
        )
        ->get();
        return view('config', ['agesCount'=>$ages[0]->count, 'typesCount'=>$types[0]->count, 'roleCount'=> $roles[0]->count]);
    }

    

    public static function role_userInsert($userid, $roleid)
    {
        DB::insert("insert into role_user (user_id,role_id) values (?,?)", [$userid,$roleid]);
    }


    public static function role_simple_user_id()
    {
        $roleSimpleUser =  DB::table('roles')->select('id')->where('name','user')->get();
        return $roleSimpleUser[0]->id;
    }



    public function configCreateDefaults(Request $request)
    {
        if($request->has('typeForm')){
             DB::insert("insert into types (name, value)
            values (?,?)", ["Boreal", 73]);
            DB::insert("insert into types (name, value)
            values (?,?)", ["Mixed", 62]);
            DB::insert("insert into types (name, value)
            values (?,?)", ["Temperate", 51]);
        }elseif($request->has('ageForm')){
             DB::insert("insert into ages (name, value)
            values (?,?)", ["Young", 25]);
            DB::insert("insert into ages (name, value)
            values (?,?)", ["Wise", 50]);
        }else
        {
            DB::insert("insert into roles (name)
            values (?)", ["admin"]);
            DB::insert("insert into roles (name)
            values (?)", ["user"]);

            $user =  DB::table('users')
            ->select( DB::raw("COUNT(*) as count"))->get();

            if($user[0]->count >0)
            {
                $userAll =  DB::table('users')->get();
                $roleSimpleUser =   backendController::role_simple_user_id();
                
                for($i=0; $i<count($userAll);$i++)
                {
                    backendController::role_userInsert($userAll[$i]->id,$roleSimpleUser);
                    
                }
            }

            
        }
       
        return redirect()->to('/configuration');
       

        
    }
}
