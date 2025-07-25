<?php
 namespace App\Http\Controllers\SuperAdmin;
 use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class WebsiteSettingController extends Controller
{
    
 public function website_setting(){
     $website_setting = DB::table('website_setting')->get();
     //dd($website_setting);
 return view('superadmin.website_setting',compact('website_setting'));
    } 
    
     public function website_setting_save(Request $request){ 
       //dd($request->all())   ;
      $data=array(
         'header_color'=>$request->header_color,
         'sidebar_color'=>$request->sidebar_color, 
         ); 
      DB::table('website_setting')->where('id', 1)->update($data);
     $request->session()->flash('success','Successfully Upload Website Theme');
     return redirect()->route('website_setting');
    } 
}
