<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rank_achiver;
use App\Models\User;
use App\Models\reward_vip;
use Illuminate\Support\Facades\DB;
class WithdrawlController extends Controller
{
    
    
    public function cancel_withdrawl(Request $request, $id){
    
        $withdrawl_request=DB::table('withdrawl_request')->find($id);
      
        if($withdrawl_request){
         if($withdrawl_request->wallet_type=="club_wallet"){
            $wallet_name="club_wallet";
        }else if($withdrawl_request->wallet_type=="roi_wallet"){
            $wallet_name="withdrawl_wallet";
        }elseif($withdrawl_request->wallet_type=="incentive_wallet"){
              $wallet_name="incentive_wallet";
        }elseif($withdrawl_request->wallet_type=="withdrawl_wallet"){
              $wallet_name="withdrawl_wallet";
        }else{
              $wallet_name="withdrawl_wallet";
        }
        DB::table('withdrawl_request')->where('id',$id)->update(array('status'=>'canceled'));
        
        DB::table('user')->where('id',$withdrawl_request->user_id)->increment($wallet_name,$withdrawl_request->amount);
        
        return redirect()->route('withdrawl_history1')->with('success','Withdrawl Canceled Successfully');
        
        }else{
            
              return redirect()->back()->with('error','!Withdrawl Not Found');
        }
        
    }
    
    
} 
