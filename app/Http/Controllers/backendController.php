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


    public function userAdmin()

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
    public function getSubmitedForest()
    {
        $id = $_GET['id'];
        $types = DB::table('forests')
            ->select(
                'forests.id',
                'surname',
                'lastname',
                'phone',
                'price',
                'area',
                'email',
                'userid',
                'types.name as typeid',
                'ages.name as ageid',
            )
            ->leftJoin('types', 'forests.typeid', '=', 'types.id')
            ->leftjoin('ages', 'forests.ageid', '=', 'ages.id')
            ->where('forests.id', $id)
            ->get();

        return response()->json($types[0]);
    }
    public function deleteSubmitedForest($id)
    {

        DB::table('forests')->where('forests.id', $id)->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }


    public function deletePicture($id)
    {

        $url = DB::table('pics')->select('dir')->where('id', $id)->get();
        unlink($url[0]->dir);

        DB::table('pics')->where('pics.id', $id)->delete();

        return response()->json([
            'success' => 'Record deleted successfully!',
            'error' => $url[0]->dir
        ]);
    }


    public function deleteUser($id)
    {
        DB::table('role_user')->where('user_id', $id)->delete();
        DB::table('users')->where('users.id', $id)->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
    public function updateSubmitedForest(Request $request)
    {

        DB::table('forests')
            ->where('forests.id', $request->forestid)
            ->update(([
                'surname' => $request->surname, 'lastname' => $request->lastname, 'email' => $request->email,
                'phone' => $request->phone, 'price' => $request->price, 'area' => $request->area, 'typeid' => $request->type, 'ageid' => $request->age
            ]));
        return  redirect()->to('/adminpanel');
    }


    public function adminRegister(Request $request)
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

    public function getPictures($id)
    {
        
        $pictureCountRaw = backendController::getPictureCount(); 
        $picsForest_ID = -1;
        for($i = 0; $i < count($pictureCountRaw) ; $i++) {
            if ($pictureCountRaw[$i]->forest_id == $id) {
                $picsForest_ID = $i;
                break;
            }
        }
        if($picsForest_ID != -1)                                                                         
            $pictureCount = $pictureCountRaw[$picsForest_ID]->count;
        else
            $pictureCount = 0;
        $pics = DB::table('pics')
            ->select('dir','pics.id')
            ->where('forest_id', $id)
            ->get();
        return view('viewPhotos', ['pics' => $pics, 'pictureCount' => $pictureCount, 'id' =>$id]);
    }

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



    public function submitUserList(Request $request)
    {

        for ($i = 0; $i < count($request->userids); $i++) {

            DB::table('role_user')
                ->where('user_id', $request->userids[$i])
                ->update((['role_id' => $request->roleOptions[$i]]));
        }

        return redirect()->to('/users');
    }


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




    public function createForestConf()
    {

        $userRoles = [Auth::user()->name, Auth::user()->email];
        $config = backendController::getFOrestConf();
        return view('createForest', ['config' => $config, 'userRoles' => $userRoles]);
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



    public function addForestConf(Request $request)
    {

        $types = DB::table('types')
        ->select('value')
        ->where('id',$request->type)
        ->get();

        $age = DB::table('ages')
        ->select('value')
        ->where('id',$request->age)
        ->get();
          
        $lastPrice = $request->area*$types[0]->value*$age[0]->value;

        $values = [
            $request->surname, $request->lastname, $request->phone, $request->email,
            $request->area, $request->type, $request->age,  $lastPrice , Auth::id()
        ];

        DB::insert("insert into forests (surname, lastname, phone, email, area, typeid, ageid, price,userid)
          values (?,?,?,?,?,?,?,?,?)", $values);

        $forest_id = DB::getPdo()->lastInsertId();

        backendController::addPictures($request, $forest_id , False);

        if($lastPrice > $request->price)
            return view('idNumberAdd', ['forest_id'=> $forest_id]);
        else        
            return redirect()->to('/contacs?lastPrice='.$lastPrice);
    }


    public function forestIDnum(Request $request, $id)
    {
       
         DB::table('forests')
                ->where('id', $id)
                ->update((['idnum' => $request->idnum]));

        $lastPrice = DB::table('forests')
        ->select(
            'price')
        ->where('id',$id)
        ->get();

        return redirect()->to('/contacs?lastPrice='.$lastPrice[0]->price);
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

    public static function addPictures(Request $request, $id , $redirect)
    {

     $count = 1;

        if ($request->select_file != null) {
            foreach ($request->select_file as $key => $data) {
                $timeExtra = time() + $count;
                $imageName = $timeExtra . '.' . $data->extension();
                $data->move(public_path('images'),  $imageName);
                $dir = "images/" . $imageName;
                DB::insert("insert into pics (dir, forest_id)
             values (?,?)", [$dir, $id]);
                $count++;
            }
        }

        if($redirect)
        {
            $url = "slide-show/".$id;
            return redirect()->to($url);
        }

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
