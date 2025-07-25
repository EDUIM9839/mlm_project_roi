<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PayoutController extends Controller
{
    //
    function generate_payout()
    {
        $all_users=DB::table('user')->where('role','user')->get();
        foreach($all_users as $au){
            $id=$au->id;
            $userid=$au->userid;
            $direct_user=DB::table('user')->where('role','user')->where('referal',$userid)->get();
            if(count($direct_user)>=2){
               $pending_amount=DB::table('income_history')->where('paid_status','pending')->where('received_user',$id)->sum('amount');
               $deduct_amount=$pending_amount*15/100;
               $paying_amount=$pending_amount-$deduct_amount;
               $pending_user=DB::table('income_history')->where('paid_status','pending')->where('received_user',$id)->get();
               DB::table('user')->where('id',$id)->increment('withdrawl_wallet',$paying_amount); 
           if(count($pending_user)>0){
               $paid_status=array(
                   'paid_status'=>'paid'
                   );
                 $update_user=DB::table('income_history')->where('paid_status','pending')->where('received_user',$id)->update($paid_status);
                 $data=array(
                     'user_id'=>$id,
                     'amount'=>$pending_amount,
                     'paying_amount'=>$paying_amount,
                     );
                 DB::table('withdrawl_request')->insert($data);
           }  
            }
          
        }
         return redirect()->route('redirect');
    }
    
    public function payout_history(){
        $pending_users=DB::table('withdrawl_request')->where('status','pending')->get();
        return view('admin.payout_history',compact('pending_users'));
    }
    
    public function redirect(){
        return view('admin.redirect');
    }
}


















