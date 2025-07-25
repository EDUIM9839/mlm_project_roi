<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Models\NotificationMessage;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;


use App\Models\User;

class MessageController extends Controller{
  public function messages(Request $request){
      $allUser=DB::table('user')->get();
      $allMsg=DB::table('messages')->get();
    //   dd($allMsg);
    return view('admin.messages.messages',compact('allUser','allMsg'));
  }
  
   public function messagesPost(Request $request){
    //   dd($request->all());
    //   $request->validate([
    //       'userid'=>'required',
    //       'message'=>'required',
    //       ]);
    if($request->users == 'all'){
         $data=DB::table('user')->get();
    foreach($data as $key=>$d){
          $data=[
              'userid'=>$request->users,
              'message'=>$request->message,
              'status'=>'unseen',
              'msg_id'=>rand(000,999),
              'created_at'=>date('Y-m-d H:i:s'),
              'updated_at'=>date('Y-m-d H:i:s'),
              ] ;
           
          DB::table('messages')->insert($data);
    }
    }
    else{
           $data=[
              'userid'=>$request->users,
              'message'=>$request->message,
              'status'=>'unseen',
              'msg_id'=>rand(000,999),
              'created_at'=>date('Y-m-d H:i:s'),
              'updated_at'=>date('Y-m-d H:i:s'),
              ] ;
          
          DB::table('messages')->insert($data);
    }
    
   
    return redirect()->back();
  }
  
public function delete($id)
{
    $deleted = DB::table('messages')->where('id', $id)->delete();
    if ($deleted){
        return redirect()->back()->with('success',"Message deleted successfully");
    } 
}


    }

?>