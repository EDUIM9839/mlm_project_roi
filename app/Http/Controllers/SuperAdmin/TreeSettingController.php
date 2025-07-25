<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tree_setting;

class TreeSettingController extends Controller
{
    

    public function tree_setting_page(){
        $tree= tree_setting::first();
        $data=compact('tree');
        return view('superadmin.tree_setting')->with($data);
    }


    public function tree_setting_update(Request $request){


         
     //  dd($request->all());
     
      $tree= tree_setting::first();
    $tree->theme=$request->theme;
    $tree->save();
       $request->session()->flash('success',"Updated Successfully");
        return redirect()->back();
    }


}
