<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\backendController;
use Illuminate\Support\Facades\Auth;

class ForestController extends Controller
{
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

    public function create()
    {

        $userRoles = [Auth::user()->name, Auth::user()->email];
        $config = backendController::getFOrestConf();
        return view('createForest', ['config' => $config, 'userRoles' => $userRoles]);
    }

    public function submit(Request $request)
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

        PhotoController::add($request, $forest_id , False);

        if($lastPrice > $request->price)
            return view('idNumberAdd', ['forest_id'=> $forest_id]);
        else        
            return redirect()->to('/contacs?lastPrice='.$lastPrice);
    }

    public function get()
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
   

    public function update(Request $request)
    {

        DB::table('forests')
            ->where('forests.id', $request->forestid)
            ->update(([
                'surname' => $request->surname, 'lastname' => $request->lastname, 'email' => $request->email,
                'phone' => $request->phone, 'price' => $request->price, 'area' => $request->area, 'typeid' => $request->type, 'ageid' => $request->age
            ]));
        return  redirect()->to('/adminpanel');
    }

  
    public function delete($id)
    {

        DB::table('forests')->where('forests.id', $id)->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
