<?php
 namespace App\Http\Controllers\SuperAdmin;
 use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class PlanController extends Controller
{
   
    function plan_setting(){
        return view('superadmin.plan_setting');
    }
    function rank_commission(){

        $data = reward_vip::all();
        return view('superadmin.rank_commission',compact('data'));
    }
    function delete($id)
    {
        $data= reward_vip::find($id);
        $data->delete();
        return redirect('superadmin.rank_commission');
    }
    function roi_commission(){
        return view('superadmin.roi_commission');
    }
    function autopool_bonus(){
        return view('superadmin.autopool_bonus');
    }
    function repurchase_bonus(){
        return view('superadmin.repurchase_bonus');
    }
    function rewards(){
        return view('superadmin.rewards');
    }
    function level_roi_income(){
        return view('superadmin.level_roi_income');
    }
    function level_roi_bonus(){
        return view('superadmin.level_roi_bonus');
    }
    function cashback_bonus(){
        return view('superadmin.cashback_bonus');
    }
    function matrix_commission(){
        return view('superadmin.matrix_commission');
    }
    function matching_commission(){
        return view('superadmin.matching_commission');
    }
    function matching_bonus(){
        return view('superadmin.matching_bonus');
    }
    
}
