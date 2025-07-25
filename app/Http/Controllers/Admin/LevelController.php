<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\level;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function level(){
        $data = DB::table('levels')->get();
        $result = compact('data');
        // dd($result); die;
        return view('admin.level')->with($result);
    }
    public function store_level(Request $request){
        foreach($request->level_first as $row){       
            $data = array(                  
                'commission'=>$request->commission,
                'commission_criteria'=>$request->commission_criteria,
                'level'=>$request->level,
                'level_first' =>$row,
                );
                DB::table('levels')->insert($data);
        }
        
        return redirect('admin/level');
    }
    function list()
    {
        $data = level::all();
        return view('level',['levels'=>$data]);
    }
    function level_delete($id)
    {
        $data= level::find($id);
        $data->delete();
        return redirect('admin/level');
    }
    public function updatelevel(Request $request)
    {
        $id = $request->id;
        $level_first = $request->input('level_first');
        $result=DB::table('levels')->where('id',$id)->get();
        $data = array(
            'level_first' =>$request->level,
            );
       $res=DB::table('levels')->where('id',$id)->update($data);
    //   print_r($res); die;
       if($res>0){
           echo 1;
       }else{
           echo 0; 
       }
    
}
}
