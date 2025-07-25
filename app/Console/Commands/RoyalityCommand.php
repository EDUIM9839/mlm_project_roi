<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
 
 

class RoyalityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'royality:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Royality Cron';

    /**
     * Execute the console command.
     */
    public function handle()
    {
     echo  $current_date=date("Y-m-d H:i:s");
      $this->royality_distribution();
        echo "-- Successfully Done-- ";
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
                
                
                DB::table('income_history')->insert($insert_income);
                DB::table('user')->where('id',$rank_achivers2->userid)->increment('withdrawl_wallet',$toytal_per_achives_amount);
            }
        }
        $data_payout=[
            "type"=>'royality',
            "total_distribution"=>$total_payin_business,
            "total_collection"=>$total_collection,
            "per_user_income"=>$perPersonDistributionAmount,
            "total_achiver"=>$total_no_of_achivers,
        ];
        DB::table('payout_report')->insert($data_payout);
           
    }
    
  
      
      
        
     
  
    
    
    
    
}
