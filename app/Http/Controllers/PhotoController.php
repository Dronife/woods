<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoController extends Controller
{
    public static function add(Request $request, $id , $redirect)
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
            $url = "pictures/get/".$id;
            return redirect()->to($url);
        }

    }

    public function get($id)
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


    
    public function delete($id)
    {

        $url = DB::table('pics')->select('dir')->where('id', $id)->get();
        unlink($url[0]->dir);

        DB::table('pics')->where('pics.id', $id)->delete();

        return response()->json([
            'success' => 'Record deleted successfully!',
            'error' => $url[0]->dir
        ]);
    }

}
