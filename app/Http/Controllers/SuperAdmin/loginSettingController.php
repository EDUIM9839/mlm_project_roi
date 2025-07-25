<?php

namespace App\Http\Controllers\SuperAdmin;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Image;
class loginSettingController extends Controller
{
      
   public function background_login(Request $request)
    {  
      $login_image =  DB::table('login_image')->get();
       $login =DB::table('login_theme')->first();  
        // dd($login_theme);
        return view('superadmin.background_login',compact('login_image','login'));
    }    
      
      public function login_background(Request $request)
      { 
        //   dd($request->all());
      $data=array(
         'image'=>$request->image, 
         'image_id'=>$request->image_id,
         ); 
      DB::table('login_theme')->where('id', 1)->update($data);
     $request->session()->flash('success','Successfully Upload Login Side Background Theme');
     return redirect()->route('background_login');
    } 
    
     public function delete_login(Request $request)
{ 
    $id = $request->id; 
    $image = DB::table('login_image')->where('id', $id)->first();
    
    if ($image) { 
        $imagePath = public_path('assets/' . $image->image);
        
        if (file_exists($imagePath)) {
            unlink($imagePath);  
        } 
        DB::table('login_image')->where('id', $id)->delete(); 
        $request->session()->flash('success', 'Side Background theme has been successfully deleted.');
    } else { 
        $request->session()->flash('error', 'Image not found.');
    } 
    return redirect()->route('background_login');
}

 
     public function loginimage(Request $request)
    { 
      
        return view('superadmin.loginimage' );
    }    
    
      public function upload_image(Request $request){
  
         $imageName = 'login_'.time().'.'.$request->image->extension();
              $request->image->move(public_path('assets'), $imageName);
           
     $data=array(
        
         'image'=>$imageName,
         
         );
     DB::table('login_image')->insert($data);
      $request->session()->flash('success','Successfully Upload Login Side Background Theme');
         return redirect()->back();
}

 public function user_background(Request $request)
    { 
      $user_theme =  DB::table('login_image')->get();
       $login =DB::table('login_theme')->first();  
        return view('superadmin.user_background',compact('user_theme','login'));
    }    
      
      public function theme_login(Request $request)
      { 
         // dd($request->all());
       
          $data=array(
         'image'=>$request->image, 
         'image_id'=>$request->image_id,
         ); 
      DB::table('user_background')->where('id', 1)->update($data);
      
     $request->session()->flash('success','Successfully Upload Login Side Background Theme');
     return redirect()->route('user_background');
    } 

 public function register_background(Request $request)
    { 
      $login_theme =  DB::table('login_image')->get(); 
        return view('superadmin.register_background',compact('login_theme'));
    } 
    
  public function register_logins(Request $request)
    { 
        $data = array(
            'image' => $request->image,
        ); 
        DB::table('register_image')->where('id', 1)->update($data); 
        $request->session()->flash('success', 'Successfully Upload Login Side Background Theme'); 
        return redirect()->route('register_background');
    }
    
     public function forget_background(Request $request)
    { 
      $login_theme =  DB::table('login_image')->get(); 
        return view('superadmin.forget_background',compact('login_theme'));
    } 
    
     public function forgets(Request $request){ 
      $data=array(
         'image'=>$request->image, 
         ); 
      DB::table('forget_image')->where('id', 1)->update($data);
     $request->session()->flash('success','Successfully Upload Login Side Background Theme');
     return redirect()->route('forget_background');
    } 
  

public function admin_Images(Request $request)
{
    // Validate the request
    $request->validate([
        'count' => 'required|integer|min:1|max:10'  
    ]); 
    $imageCount = (int) $request->input('count');
    $data=array();
    $images = DB::table('login_image')->get();
    foreach($images as $images)
    {
        $obj=array(
            'number'=>$imageCount,
            'id'=>$images->id,
            'image'=>$images->image
            );
            array_push($data,$obj);
    }
    return response()->json($data);
}


  
   public function user_image(Request $request)
{
    // Validate the request
    $request->validate([
        'count' => 'required|integer|min:1|max:10'  
    ]); 
    $imageCount = (int) $request->input('count');
    $data=array();
    $images = DB::table('login_image')->get();
    foreach($images as $images)
    {
        $obj=array(
            'number'=>$imageCount,
            'id'=>$images->id,
            'image'=>$images->image
            );
            array_push($data,$obj);
    }
    return response()->json($data);
}

    
}










