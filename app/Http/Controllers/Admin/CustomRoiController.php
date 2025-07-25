<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rank_achiver;
use App\Models\User;
use App\Models\reward_vip;
use Illuminate\Support\Facades\DB;

class CustomRoiController extends Controller
{
    public function customRoiPage(){
    
        return view('admin.custom_roi');
        
    }
    
    public function setCustomROI(Request $request){
        
        
        
    }
    
} 
