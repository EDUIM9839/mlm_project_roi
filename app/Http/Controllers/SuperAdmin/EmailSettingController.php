<?php

namespace App\Http\Controllers\SuperAdmin;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Image;
class EmailSettingController extends Controller
{
   public function email_setting(Request $request)
    { 
        $email_setting=DB::table('email_theme')->get(); 
         
        return view('superadmin.email_setting',compact('email_setting'));
    } 
    //   public function email(Request $request)
    // { 
    //       $email = $request->input('email');
    //       $quote = $request->input('quote');
    //       $header = $request->input('header');
    //       $footer = $request->input('footer');
    //       $message = $request->input('message');
    //      $data = array("email" => $email, "message" => $message,"quote" => $quote,"header" => $header,"footer" => $footer);
    //     $email_setting=DB::table('email_theme')->insert($data);  
    //       $request->validate([
    //       'email'=>'required',
    //       'message'=>'required',
    //       'quote'=>'required',
    //       'header'=>'required',
    //       'footer'=>'required',
    //     ]);
    //     $request->session()->flash('success','Successfully send email');
    //     return view('superadmin.email_setting');
    // }
     public function email(Request $request){
     
      $id=$request->id;
      $data=[
         'email'=>$request->email,
         
         'quote'=>$request->quote,
         'header'=>$request->header,
         'footer'=>$request->footer,
         'contact'=>$request->contact,
         ];
      DB::table('email_theme')->update($data);
     $request->session()->flash('success','Successfully send email');
     return redirect()->route('email_setting');
    } 
}









