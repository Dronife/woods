<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\backendController;
use App\Http\Requests\SubmitForestRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Forest;
use App\Models\Type;
use App\Models\Age;
use App\Models\Pic;

class ForestController extends Controller
{



    public static function getSubmitions($role)
    {
       
        $submitedForests = Forest::when($role == 'user', function($query){
            $query->where('userid',Auth::user()->id);
        })->select('forests.*','types.name as typeid','ages.name as ageid')
        ->leftjoin('types', 'forests.typeid', '=', 'types.id')
        ->leftjoin('ages', 'forests.ageid', '=', 'ages.id')
        ->get();

        return $submitedForests;
    }

    public static function userSubmitedForestCount($role){

        $submittedCount =  Forest::when($role == 'user', function($query){
            $query->where('userid',Auth::user()->id);
        })->count();

        return $submittedCount;

    }



    public function forestIDnum(Request $request, $id)
    {
       
        Forest::find($id)->update(['idnum' => $request->idnum]);
        $lastPrice = Forest::find($id)->value('price');

        return redirect()->to('/contacs?lastPrice='.$lastPrice);
    }

    public function create()
    {

        $userRoles = [Auth::user()->name, Auth::user()->email];
        $config = backendController::getFOrestConf();

        return view('createForest', ['config' => $config, 'userRoles' => $userRoles]);
    }

    public function submit(SubmitForestRequest $request)
    {
 
        $types_value = Type::find($request->typeid)->value('value');
        $age_value = Age::find($request->ageid)->value('value');
        $lastPrice = $request->area*$types_value*$age_value;
       
        Forest::create(['userid'=>Auth::id(),'price'=>$lastPrice]+$request->all());
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

        $types = Forest::where('forests.id', $id)
            ->leftJoin('types', 'forests.typeid', '=', 'types.id')
            ->leftjoin('ages', 'forests.ageid', '=', 'ages.id')
            ->get();

        return response()->json($types[0]);
    }
   

    public function update(SubmitForestRequest $request)
    {
        Forest::find($request->forestid)->update($request->all());
        return  redirect()->to('/userpanel');
    }


  
    public function delete($id)
    {
        $picture_count = Pic::where('forest_id', $id)->count();

        if($picture_count > 0){

            $picture_ids_to_delete = Pic::where('forest_id', $id)->get();
            foreach($picture_ids_to_delete as $key => $pictures)
            {
                PhotoController::delete($pictures->id);
            }

        }

        DB::table('forests')->where('forests.id', $id)->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
