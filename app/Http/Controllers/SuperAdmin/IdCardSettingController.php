<?php
 namespace App\Http\Controllers\SuperAdmin;
 use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IdCardSettingController extends Controller
{
    
 public function idcard_setting(){
     $idcards = DB::table('idcard_setting')->get();
     foreach($idcards as $idcardtheme){
        $image = "public/" . $idcardtheme->theme;
        if(Storage::exists($image)){
            $idcardtheme->image = url('storage/app/public/' . $idcardtheme->image);
        }
    }
        return view('superadmin.idcard_setting',compact('idcards'));
    } 
    
public function saveIdCardTheme(Request $request){
    
    $validated = $request->validate([
                'image' => 'required|image|max:5120'
              ]);
          
          if(request()->has('image')){
                $imagePath = request()->file('image')->store('idthemes', 'public');
                $validated['image'] = $imagePath;
            }else{
                $validated['image'] = null;
            }  
            
            // dd($imagePath);
         DB::table('id_card_themes')->insert(['theme'=>$validated['image']]);
         $request->session()->flash('success','Successfully Upload ID Card Theme');
         return redirect()->route('idcard_setting')->with('success', 'Successfully uploaded ID Card Theme');
    
}
 
    
    
 public function idcard_setting_save(Request $request){
     
      $id=$request->id;
      $data=[
         'theme'=>$request->theme,
         ];
      DB::table('idcard_setting')->update($data);
     $request->session()->flash('success','Successfully Upload IdCard');
     return redirect()->route('idcard_setting');
    } 
 
}




































