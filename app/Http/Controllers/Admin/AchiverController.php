<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rank_achiver;
use App\Models\User;
use App\Models\reward_vip;
use Illuminate\Support\Facades\DB;
class AchiverController extends Controller
{
    //
    public function rank_achivers(){
        $data = rank_achiver::all();
       
        return view("admin/rank_achivers",compact('data'));
    }
    public function achivers_count(Request $request){
    //   $data = DB::table('user')->select('referal', DB::raw("COUNT('*') As total"))->groupBy('referal')->get();
   // $target = DB::table('reward_vip')->get('target');
    }
   public function achivers_message(Request $request){
        $data = User::all();
        $userid=$request->id;
        $res=DB::table('user')->where('userid' , $userid)->get();
        // dd($res); die;
        
        
        if(!empty($res['0']->email)){
             return ($res['0']->email);
        }
    }
    
    
} 
