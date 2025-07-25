<?php

namespace App\Http\Controllers\Admin;
use App\Models\reward_vip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
   
    function plan_setting(){
        return view('admin.plan_setting');
    }
    function rank_commission(){

        $data = reward_vip::all();
        return view('admin.rank_commission',compact('data'));
    }
    function delete($id)
    {
        $data= reward_vip::find($id);
        $data->delete();
        return redirect('admin.rank_commission');
    }
    function roi_commission(){
        return view('admin.roi_commission');
    }
    function autopool_bonus(){
        return view('admin.autopool_bonus');
    }
    function repurchase_bonus(){
        return view('admin.repurchase_bonus');
    }
    function rewards(){
        return view('admin.rewards');
    }
    function level_roi_income(){
        return view('admin.level_roi_income');
    }
    function level_roi_bonus(){
        return view('admin.level_roi_bonus');
    }
    function cashback_bonus(){
        return view('admin.cashback_bonus');
    }
    function matrix_commission(){
        return view('admin.matrix_commission');
    }
    function matching_commission(){
        return view('admin.matching_commission');
    }
    function matching_bonus(){
        return view('admin.matching_bonus');
    }
    
}
