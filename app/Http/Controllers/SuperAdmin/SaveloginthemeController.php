<?php

namespace App\Http\Controllers\SuperAdmin;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Image;
class SaveloginthemeController extends Controller
{
      
   public function theme_login(Request $request)
      { 
          dd($request->all());
      $data=array(
         'image'=>$request->image, 
         ); 
      DB::table('user_background')->where('id', 1)->update($data);
     $request->session()->flash('success','Successfully Upload Login Side Background Theme');
     return redirect()->route('user_background');
    } 



}







