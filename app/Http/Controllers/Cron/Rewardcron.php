<?php

namespace App\Http\Controllers\Cron;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BtreeController;
use App\Models\User;
class Rewardcron extends Controller
{ 
    
    
        
    public function rewards_income(){
        $current_date=date("Y-m-d H:i:s");
       $payout_report=DB::table("payout_report")->where("type","reward")->orderBy("id","DESC")->first();
       if(!empty($payout_report)){
           $previus_date=$payout_report->date_time;
       }else{
           $previus_date=date("Y-m-d H:i:s", strtotime(" -1 month",strtotime($current_date)));
       }
       echo $previus_date."<br>";
       
      $user_package= DB::table("user_package")->get();
      foreach($user_package as $user_packages){
         
          $user_date=date("Y-m-d H:i:s",strtotime(" +10 day",strtotime($user_packages->activated_date)));
         
          $user_tbl=DB::table("user")->where('id',$user_packages->user_id)->first();
         $referal= DB::table("user")->join('user_package','user.id','=','user_package.user_id')->select('user_package.*','user.referal','user.id')->where("user.referal",$user_tbl->userid)->where('user_package.activated_date','<=',$user_date)->get();
         
         $total_direct=0;
         foreach($referal as $referals){
            //  echo "chield=".$referals->userid."<br>";
             $check_user_package=DB::table("user_package")->where("user_id",$referals->id)->where("status","approved")->count();
             if($check_user_package>0){
                 $total_direct++;
             }
         }
        //   echo $user_packages->user_id."  ||| PAckage Date=".$user_date."  ||total direct=".$total_direct."<br>";
         if($total_direct>=10){
             $data=array(
                      'userid'=>$user_packages->user_id,
                      );
                      $check_user=DB::table('rank_achivers')->where('userid',$user_packages->user_id)->count();

                      if($check_user<1){
                      DB::table('rank_achivers')->insert($data);
                      }
         }
      }
      
      $this->royality_distribution($previus_date);
    }
    
    public function royality_distribution($previus_date){
       
    $change_previous_date=date('d-m-Y', strtotime($previus_date));
    
        $total_collection=DB::table("user_package")->where('created_at2','>',$previus_date)->sum('amount');
       
       $total_no_of_achivers= DB::table('rank_achivers')->count();
       if($total_collection>0){
            $total_payin_business=$total_collection*5/100;
       $toytal_per_achives_amount= round($total_payin_business/$total_no_of_achivers,2);
       }else{
           $total_payin_business=0;
           $toytal_per_achives_amount=0;
       }
       
        //   dd($total_payin_business);
           echo "Total achiver Users=".$total_no_of_achivers."<br>";
          echo "Total collection=".$total_collection."<br>";
          echo "Total Distribution=".$total_payin_business."<br>";
          echo "Total per user income=".$toytal_per_achives_amount."<br>";
         $rank_achivers= DB::table("rank_achivers")->get();
         foreach($rank_achivers as $rank_achivers2){
             echo "user id=".$rank_achivers2->userid." ||| paying_amount=".$toytal_per_achives_amount."<br>";
             
             $insert_income=[
                 'type'=>'reward',
                 'profit'=>$toytal_per_achives_amount,
                  'amount'=>$toytal_per_achives_amount,
                 'received_user'=>$rank_achivers2->userid,
                 'joined_user'=>$rank_achivers2->userid,
                  'credit_debit'=>'credit'
                 ];
                 if($toytal_per_achives_amount>0){
                     DB::table('income_history')->insert($insert_income);
                     DB::table('user')->where('id',$rank_achivers2->userid)->increment('withdrawl_wallet',$toytal_per_achives_amount);
                 }
         }
          $data_payout=[
              "type"=>'reward',
              "total_distribution"=>$total_payin_business,
              "total_collection"=>$total_collection,
              "per_user_income"=>$toytal_per_achives_amount,
              "total_achiver"=>$total_no_of_achivers,
              ];
              DB::table('payout_report')->insert($data_payout);
              
               echo "<br>";
               echo "done";
    }
    
   
    
}


















