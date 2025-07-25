<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;
 
use App\Http\Controllers\MLMController;
 

class RewardCronCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reward:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reward Cron';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo $current_date=date("Y-m-d");
        $this->reward_cron();
        echo "-- Completly Done --";
    }
    
      public function reward_cron(){
        // working by afzal tested by shubham
        
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
                // echo "<h5>Level No=".$reward->id." |||| Target Total Business=".$reward->target_business." ||||  Target Power Leg 40% Business=".$powerbusinesstarget40." ||||  Target Week Leg 60% Business=".$weekbusinesstarget60."</h5>";
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
    
}
