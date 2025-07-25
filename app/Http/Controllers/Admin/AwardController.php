<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rank_achiver;
use App\Models\User;
use App\Models\reward_vip;
use Illuminate\Support\Facades\DB;
class AwardController extends Controller
{
    public function awards(Request $req){
        
        $title = 'Rewards';
        $user=DB::table("reward_achieved_user")->where("delivery_status","delivered")->paginate(10);
        // dd($user);
        $pendingRewards=DB::table("reward_achieved_user")->where("delivery_status","pending")->paginate(10);
        $pendingRewardCount=DB::table("reward_achieved_user")->where("delivery_status","pending")->get();
       
        $compact = compact('title', 'user','pendingRewards','pendingRewardCount');
        
         return view('admin.awards', $compact);
    }
    public function rewardApprove($id){
        $rewards=DB::table("reward_achieved_user")->where("id",$id)->first();
        $reward=DB::table("reward_achieved_user")->where("id",$id)->update(['delivery_status'=>'delivered']);
        // dd($reward);
       

        if($rewards){
            $rewardData = $rewards->reward_name;
            $rewardParts = explode('/', $rewardData);
            $rewardAmount = $rewardParts[0];
           $d= DB::table("user")->where("id",$rewards->user_id)->increment("reward_wallet",$rewardAmount);
        //    dd($d);
        }

        return redirect()->back()->with('success','Reward Approved Successfully');
    }
} 
