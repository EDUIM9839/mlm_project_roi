<?php

namespace App\Http\Controllers\SuperAdmin;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class WelcomeLetterController extends Controller
{
 
 
  public function welcome_letter_setting_page(){
     $welcomeletter = DB::table('welcome_letter_images')
    ->join('welcome_letter_setting', 'welcome_letter_images.content_id', '=', 'welcome_letter_setting.id')
    ->select('welcome_letter_images.*', 'welcome_letter_setting.*', 'welcome_letter_images.id')  
    ->orderBy('welcome_letter_images.id', 'desc')
    ->get();

    $defaultApplied = true;
    foreach($welcomeletter as $letter){
        $image = "public/" . $letter->image;
        if(Storage::exists($image)){
            $letter->image = url('storage/app/public/' . $letter->image);
        }
        
        if($letter->is_applied == 1){
            $defaultApplied = false;
        }
    }
       
       
        return view('superadmin.welcome_letter_setting',[
            'welcomeletter' => $welcomeletter,
            'defaultApplied' => $defaultApplied
            ]);
    }
        
        
        
      public function welcome_letter_save(Request $request){ 
          
          $validated = $request->validate([
                'image' => 'required|image|max:5120'
              ]);
          
          if(request()->has('image')){
                $imagePath = request()->file('image')->store('themes', 'public');
                $validated['image'] = $imagePath;
            }else{
                $validated['image'] = null;
            }  
         DB::table('welcome_letter_images')->insert(['image'=>$validated['image'], 'content_id' => 1]);
         $request->session()->flash('success','Successfully Upload Welcome Letter');
         return redirect()->route('welcome_letter_setting')->with('success', 'Successfully uploaded welcome letter theme');
    } 
    
  public function deleteWelcomeLetterTheme($id)
    {
 
    if (!$id) {
        return redirect()->route('welcome_letter_setting')->with('error', 'Something went wrong while deleting!');
    }

    $letter = DB::table('welcome_letter_images')->where('id', $id)->first();

    if (!$letter) {
        return redirect()->route('welcome_letter_setting')->with('error', 'This theme is no longer available!');
    }

    // Delete the image file if it exists
    $image = "public/" . $letter->image;
    if (Storage::exists($image)) {
        Storage::delete($image);
    }

    // Delete the database record
    DB::table('welcome_letter_images')->where('id', $id)->delete();
    if($letter->is_applied == '1'){
         return redirect()->route('welcome_letter_setting')->with('success', 'Successfully deleted welcome letter theme - Default theme applied.');

    }

    return redirect()->route('welcome_letter_setting')->with('success', 'Successfully deleted welcome letter theme');


       
    }

    
    public function applyLetter($id){
        if(!$id){
          return redirect()->route('welcome_letter_setting')->with('error', "Letter id is not set!"); 
        }
        DB::table('welcome_letter_images')->where('is_applied', 1)->update(['is_applied' => 0]);
        DB::table('welcome_letter_images')->where('id', $id)->update(['is_applied'=> '1']);
        
         return redirect()->route('welcome_letter_setting')->with('success', 'Applied successfully!'); 
        
    }
    
    
       public function welcome_content_save(Request $request){ 
      $data=array(
          
         'content'=>$request->description, 
         ); 
      DB::table('welcome_letter_setting')->where('id', 1)->update($data);
      
     $request->session()->flash('success','Successfully Upload Welcome Letter');
     return redirect()->route('welcome_content');
    } 
  
}












 