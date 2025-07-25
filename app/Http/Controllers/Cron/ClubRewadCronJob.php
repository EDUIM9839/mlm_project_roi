<?php

namespace App\Http\Controllers\Cron;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BtreeController;
use App\Http\Controllers\MLMController;
use App\Models\User;
use Carbon\Carbon;
class ClubRewadCronJob extends Controller
{
    function club_cron(){
      $current_date=date("Y-m-d");
         $current_day=date("D");
        if($current_day=="Sat"){
              echo "Today Saturday";
        }elseif($current_day=="Sun"){
             echo "Today Sunday";
        }else{
            $club_level=DB::table("club_level")->get();
            foreach($club_level as $club_levels){
               $time_duration=$club_levels->time_duration;
                $powerbusinesstarget40=$club_levels->target_business*$club_levels->power_leg_percent/100;
                $weekbusinesstarget60=$club_levels->target_business*$club_levels->week_leg_percent/100;
              echo "Level No=".$club_levels->id." ||| Target Total Business=".$club_levels->target_business." ||| Target Power Business=".$powerbusinesstarget40." ||| Target Week Business=".$weekbusinesstarget60."<br>";
                $user_package=DB::table("user_package")->groupBy("user_id")->get();
                foreach($user_package as $up){
                   $user_package2=DB::table("user_package")->where("status","approved")->where("user_id",$up->user_id)->first();
                   $expairy_date=date("Y-m-d",strtotime("+$time_duration days",strtotime($user_package2->activated_date)));
                   if($expairy_date>=$current_date){
                    $total_investment_amount=DB::table("user_package")->where("status","approved")->where("user_id",$up->user_id)->sum("amount");
                    if($total_investment_amount>0){
                       
                        $user_tbl=DB::table("user")->where("id",$up->user_id)->first();
                        $user_tbl2=DB::table("user")->where("id",$up->user_id)->get();
                      
                         $mlmc2=new MLMController();
                         $mlmc3=new MLMController();
                         $mlmc3->downline($user_tbl2,false,false);
                         $getDownline=$mlmc3->getDownline();
                        //  teambusiness($getDownline);
                        //  dd($getDownline);
                         $mlmc2->direct($user_tbl);
                         $getdirect2=$mlmc2->getdirect();
                        $total_direct=count($getdirect2);
                         if($total_direct>1){
                              $mlmc=new MLMController();
                              $mlmc->PowerWeekLeg($user_tbl);
                             $powerweekleg=$mlmc->GetPowerWeekLeg();
                             if($powerweekleg['power_leg']>=$powerbusinesstarget40 && $powerweekleg['week_leg']>=$weekbusinesstarget60){
                                 echo $expairy_date."user id=".$up->user_id." ||| Total Business =".$powerweekleg['total_business']." ||| Power Leg=".$powerweekleg['power_leg']." ||| Week Leg=".$powerweekleg['week_leg']."<br>";
                                 $insert_club=[
                                       
                                       "user_id"=>$up->user_id,
                                       "level_no"=>$club_levels->id,
                                       "rank_name"=>$club_levels->club_name,
                                       
                                     ];
                                    $check_club_achiver=DB::table("club_achiver_user")->where("user_id",$up->user_id)->where("level_no",$club_levels->id)->count();
                                    if($check_club_achiver<1){
                                        DB::table("club_achiver_user")->insert($insert_club);
                                    }
                             }
                              
                         }
                        
                    }
                }
                }
            }
        }
    }
    
    public function club_distribution(){
         $current_date=date("Y-m-d");
         $current_day=date("D");
        if($current_day=="Sat"){
              echo "Today Saturday";
        }elseif($current_day=="Sun"){
             echo "Today Sunday";
        }else{
            $payout_report=DB::table("payout_report")->where("type","club_income")->orderBy("id","DESC")->first();
            if(!empty($payout_report)){
                $prievius_date=$payout_report->date_time;
            }else{
                $prievius_date=date("Y-m-d H:i:s",strtotime("-90 Days",strtotime(date("Y-m-d H:i:s"))));
            }
           $company_profit=DB::table("user_package")->where("status","approved")->where("activated_date",">",$prievius_date)->sum("amount");
            $club_level=DB::table("club_level")->get();
            $pay_total_distribution=0;
            $pay_total_achiver=0;
            foreach($club_level as $club_levels){
               $total_achiver=DB::table("club_achiver_user")->where("level_no",$club_levels->id)->count();
              $total_ditribustion_amount=$company_profit*$club_levels->percent/100;
               if($total_achiver>0){
                   $pay_total_achiver+=$total_achiver;
                   $one_persone_amount=$total_ditribustion_amount/$total_achiver;
                   echo "level no=".$club_levels->id." ||| percent Distribute=".$club_levels->percent." ||| Total Achiver=".$total_achiver." ||| Total Collection=".$company_profit." ||| Total Distribution=".$total_ditribustion_amount." ||| one persone Amount=".$one_persone_amount."<br>";
                   $achiver_tbl=DB::table("club_achiver_user")->where("level_no",$club_levels->id)->get();
                   foreach($achiver_tbl as $achiver_tbls){
                       if($one_persone_amount>0){
                           $insert_income=[
                               "credit_debit"=>"credit",
                               "received_user"=>$achiver_tbls->user_id,
                               "joined_user"=>$achiver_tbls->user_id,
                               "amount"=>$one_persone_amount,
                               "level_no"=>$club_levels->id,
                               "type"=>"club_income",
                               "total_collection"=>$company_profit,
                               "total_achiver"=>$total_achiver,
                               
                               
                               ];
                               $pay_total_distribution+=$one_persone_amount;
                               DB::table("income_history")->insert($insert_income);
                               DB::table("user")->where("id",$achiver_tbls->user_id)->increment("club_wallet",$one_persone_amount);
                       }
                       echo $achiver_tbls->user_id." ||| Paying Amount=".$one_persone_amount."<br>";
                   }
               }
                 
            }
            $insert_payout=[
                
                "type"=>"club_income",
                "total_distribution"=>$pay_total_distribution,
                "total_collection"=>$company_profit,
                "total_achiver"=>$pay_total_achiver,
                
                ];
                DB::table("payout_report")->insert($insert_payout);
        }
    }
    
    public function reward_cron(){
        // working by afzal tested by shubham
        // dd(123456);
        
        $current_date=date("Y-m-d");
        $current_day=date("D");
        if($current_day=="Sat"){
            echo "Today Saturday";
        }elseif($current_day=="Sun"){
            echo "Today Sunday";
        }else{
            $reward_vip=DB::table("reward_vip")->get();
            $user_package=DB::table("user_package")->groupBy("user_id")->get();
            foreach($reward_vip as $reward){
                
                $powerbusinesstarget40=$reward->target_business*$reward->power_leg_percent/100;
                $weekbusinesstarget60=$reward->target_business*$reward->week_leg_percent/100;
                echo "<h5>Level No=".$reward->id." |||| Target Total Business=".$reward->target_business." ||||  Target Power Leg 40% Business=".$powerbusinesstarget40." ||||  Target Week Leg 60% Business=".$weekbusinesstarget60."</h5>";
                foreach($user_package as $up){
                    $total_investment_amount=DB::table("user_package")->where("status","approved")->where("user_id",$up->user_id)->sum("amount");
                    if($total_investment_amount>0){
                        $user_tbl=DB::table("user")->where("id",$up->user_id)->first();
                        $mlmc2=new MLMController();
                        $mlmc2->direct($user_tbl);
                        $getdirect2=$mlmc2->getdirect();
                        $total_direct=count($getdirect2);
                        if($total_direct>1){
                            $mlmc=new MLMController();
                            $mlmc->PowerWeekLeg($user_tbl);
                            $powerweekleg=$mlmc->GetPowerWeekLeg();
                            if($powerweekleg['power_leg']>=$powerbusinesstarget40 && $powerweekleg['week_leg']>=$weekbusinesstarget60){
                            dump($powerweekleg['power_leg'],$powerweekleg['week_leg']);
                                $insert_reward=[
                                    "user_id"=>$up->user_id,
                                    "level_no"=>$reward->id,
                                    "reward_name"=>$reward->reward_name,
                                    "is_amount_paid"=>$reward->reward_amount,
                                ];
                                $insert_income=[
                                    'type'=>'reward',
                                    "level_no"=>$reward->id,
                                    'amount'=>$reward->reward_amount,
                                    'received_user'=>$up->user_id,
                                    'joined_user'=>$up->user_id,
                                    'credit_debit'=>'credit'
                                ];
                                $reward_achieved_usercheck=DB::table("reward_achieved_user")->where("user_id",$up->user_id)->where("level_no",$reward->id)->count();
                                if($reward_achieved_usercheck<1){
                                  DB::table("reward_achieved_user")->insert($insert_reward);
                                DB::table('income_history')->insert($insert_income);
                                DB::table('user')->where('id',$up->user_id)->increment('withdrawl_wallet',$reward->reward_amount);
                                    echo "user id=".$up->user_id." ||| Total Direct=".$total_direct." ||| Total Business =".$powerweekleg['total_business']." ||| Power Leg=".$powerweekleg['power_leg']." ||| Week Leg=".$powerweekleg['week_leg']. " |||| Amount : $reward->reward_amount<br>";
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    
    public function royality_distribution(){
        $current_date=date("Y-m-d H:i:s");
        $payout_report=DB::table("payout_report")->where("type","royality")->orderBy("id","DESC")->first();
        if(!empty($payout_report)){
           $previus_date=$payout_report->date_time;
        }else{
           $previus_date=date("Y-m-d H:i:s", strtotime(" -1 month",strtotime($current_date)));
        }
        echo $previus_date."<br>".$current_date;
        
        $change_previous_date=date('d-m-Y', strtotime($previus_date));
        $total_collection=DB::table("user_package")->where('created_at2','>',$previus_date)->sum('amount');
        $rank_achivers= DB::table('reward_achieved_user')->where('level_no',7)->get();
        $total_no_of_achivers= count($rank_achivers);
        if($total_no_of_achivers<=0){
            return;
        }
        if($total_collection>0){
            $total_payin_business= $total_collection * 5 / 100 ;
            $perPersonDistributionAmount = $total_payin_business / $total_no_of_achivers;
        }else{
            $total_payin_business =0;
            $perPersonDistributionAmount=0;
        }
            echo "Total achiver Users=".$total_no_of_achivers."<br>";
            echo "Total collection=".$total_collection."<br>";
            echo "Total Distribution=".$total_payin_business."<br>";
            echo "Total per user income=".$perPersonDistributionAmount."<br>";
        foreach($rank_achivers as $rank_achivers2){
            echo "user id=".$rank_achivers2->user_id." ||| paying_amount=".$perPersonDistributionAmount."<br>";
            $insert_income=[
                'type'=>'royality',
                'profit'=>$perPersonDistributionAmount,
                'amount'=>$perPersonDistributionAmount,
                'received_user'=>$rank_achivers2->user_id,
                'joined_user'=>$rank_achivers2->user_id,
                'credit_debit'=>'credit',
                'total_achiver' => $total_no_of_achivers,
                'total_collection' => $total_collection
                
            ];
            if($perPersonDistributionAmount>0){
                
                if($insert_income['amount']>600){
                    $insert_income['amount']=600;
                    $insert_income['laps_amount']=$insert_income['amount']-600;
                    $insert_income['discription']= "success - capping deduction.";
                }
                
                
                // DB::table('income_history')->insert($insert_income);
                // DB::table('user')->where('id',$rank_achivers2->userid)->increment('withdrawl_wallet',$toytal_per_achives_amount);
            }
        }
        $data_payout=[
            "type"=>'royality',
            "total_distribution"=>$total_payin_business,
            "total_collection"=>$total_collection,
            "per_user_income"=>$perPersonDistributionAmount,
            "total_achiver"=>$total_no_of_achivers,
        ];
        // DB::table('payout_report')->insert($data_payout);
            echo "<br>";
            echo "done";
    }
    
    public function salary_distribution(){
        $firstDayOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d 00:00:00');
        $salaryMonth = Carbon::now()->subMonth()->startOfMonth()->format('M Y');
        $lastDayOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d 23:59:59');
        $user_package = DB::table("user_package")->groupBy('user_id')->get();
        
        foreach($user_package as $up){
            $mlm = new MLMController();
            $downlineBusiness = $mlm->getTeamBusinessBetween($up->user_id,$firstDayOfLastMonth,$lastDayOfLastMonth);
            
            // dump($up->user_id,$team);
            $salary = $downlineBusiness * 0.05/100;
          
            if($salary <= 0){
                continue;
            }
              $insert_income = [
                'type' => 'salary',
                'amount' => $salary,
                'total_collection'=>$downlineBusiness,
                'received_user' => $up->user_id, 
                'joined_user' => $up->user_id,
                'credit_debit' => 'credit',
                'discription' => $salaryMonth,
            ];
            // DB::table('income_history')->insert($insert_income);
           // DB::table('user')->where('id',$up->user_id)->increment('withdrawl_wallet',$salary);
            echo "user id=".$up->user_id." ||| First Day of Month =".$firstDayOfLastMonth."||| Last Day of Month=".$lastDayOfLastMonth." ||| Salary of Month=".$salaryMonth." || Total Business =".$downlineBusiness." |||  Salary : $salary<br>";
          
        }
    }
    
}



 
