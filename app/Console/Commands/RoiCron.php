<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;
 
use App\Http\Controllers\MLMController;
 

class RoiCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roi:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Roi Cron';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        echo "current Date=".date("Y-m-d H:i:s");
        
        // die('died');
        $this->distributeTradingBonus();
        
        echo " ------ Distribute roi income ----- ";
       
        
        echo "--end--";
        
    }
    
    
     public function distributeTradingBonus(){
         
         
           date_default_timezone_set('UTC');
           $current_day=date("D");
            if($current_day=="Sat"){
                  echo "Today Saturday";
            }elseif($current_day=="Sun"){
                 echo "Today Sunday";
            }else{
                  $current_date_time=date("Y-m-d H:i:s");
                  $current_date=date("Y-m-d");
                 echo $current_date_time."<br>";
                 $last_insert_date=DB::table("income_history")->where("type","roi")->orderBy("id","desc")->first()->date??date("Y-m-d",strtotime("+1 days",strtotime(date("Y-m-d"))));
                  if($last_insert_date !=$current_date){
                       
                        $user_package=DB::table("user_package")->where("roi_status","pending")->where("status","approved")->where('roi_status_on_off',1)->where("active_status", 1)->get();
                        foreach ($user_package as $up){
                                $default_roi_percent = DB::table("business_setup")->first()->roi_percent;
                                $user_group = DB::table("user_groups")->where("user_id", $up->user_id)->first();
                                if ($user_group) {
                                    $group = DB::table("groups")->where("id", $user_group->group_id)->first();
                                    $roi_percent = $group ? $group->group_percentage : $default_roi_percent;
                                } else {
                                    $roi_percent = $default_roi_percent;
                                }
                              $user_id=$up->user_id;
                              $amount=$up->amount;
                              $multipleofthree=$amount*3;
                              $paying_amount_find=$amount*$roi_percent/100;
                              $user_tbl=DB::table("user")->where("id",$user_id)->first();
                              
                            $mlm=new MLMController;
                            $mlm->upline($user_tbl);
                            $upline= $mlm->getUpline();
                            //   $parent_usertbl=DB::table("user")->where("userid",$user_tbl->referal)->first();
                            //   $check_parent_active=DB::table("user_package")->where("active_status",1)->where("status","approved")->where("user_id",$parent_usertbl->id)->count();
                              
                             $total_recived_amount=DB::table("income_history")->where('type',"roi")->where('up_id',$up->id)->where("received_user",$user_id)->sum('amount');
                             $total_paying_current_amt=$paying_amount_find+$total_recived_amount;
                             if($total_recived_amount<$multipleofthree){
                                 if($multipleofthree>=$total_paying_current_amt){
                                         $paying_amount=$paying_amount_find;
                                         $laps_amount=0;
                                 }elseif($multipleofthree<$total_paying_current_amt){
                                          $paying_amount=$total_paying_current_amt-$multipleofthree;
                                          $laps_amount=$paying_amount_find-$paying_amount;
                                    
                                 }
                                 $insert_income=[
                                            "credit_debit"=>'credit',
                                            "received_user"=>$user_id,
                                            "joined_user"=>$user_id,
                                            "laps_amount"=>$laps_amount,
                                            "amount"=>$paying_amount,
                                            "type"=>'roi',
                                            "invest_amount"=>$amount, 
                                            "roi_percent"=>$roi_percent,
                                            "up_id"=>$up->id,
                                           ];
                                 DB::table("income_history")->insert($insert_income);
                                 DB::table("user")->where("id",$user_id)->increment("withdrawl_wallet",$paying_amount);
                                 if($total_paying_current_amt>=$multipleofthree){
                                      DB::table("user_package")->where("id",$up->id)->update(['roi_status'=>'paid']);
                                 }
                                 
                                 foreach ($upline as $key=>$uplines){
                                    $total_level=DB::table("trading_level")->count();
                                    if($total_level>$key){
                                        $level_id=$key+1;
                                        $levels=DB::table("trading_level")->where("id",$level_id)->first();
                                        $check_active=DB::table('user_package')->where("user_id",$uplines->id)->where("status","approved")->where('active_status',1)->count();
                                        $mlm2=new MLMController;
                                        $total_direct=$mlm2->getActiveDirect($uplines);
                                        $parent_paying_amount=$paying_amount_find*$levels->percent/100;;
                                        if($check_active>0){
                                            if($total_direct>=$levels->direct){
                                                $insert_income=[
                                                    "type"=>'trading_bonus',
                                                    "level_no"=>$level_id,
                                                    "amount"=>$parent_paying_amount,
                                                    "laps_amount"=>0,
                                                    "invest_amount"=>$amount,
                                                    "joined_user"=>$user_id,
                                                    "received_user"=>$uplines->id,
                                                    "credit_debit"=>"credit",
                                                    "up_id"=>$up->id,
                                                    "discription"=>"Successfully",
                                                ]; 
                                                DB::table("income_history")->insert($insert_income);
                                                DB::table('user')->where('id',$uplines->id)->increment('withdrawl_wallet',$parent_paying_amount);
                                            }else{
                                                $insert_income=[
                                                    "type"=>'trading_bonus',
                                                    "level_no"=>$level_id,
                                                    "amount"=>0,
                                                    "laps_amount"=>$parent_paying_amount,
                                                    "invest_amount"=>$amount,
                                                    "joined_user"=>$user_id,
                                                    "received_user"=>$uplines->id,
                                                    "credit_debit"=>"credit",
                                                    "up_id"=>$up->id,
                                                    "discription"=>"direct condition false",
                                                ]; 
                                                  DB::table("income_history")->insert($insert_income);
                                            }
                                        }else{
                                            $insert_income=[
                                                "type"=>'trading_bonus',
                                                "level_no"=>$level_id,
                                                "amount"=>0,
                                                "laps_amount"=>$parent_paying_amount,
                                                "invest_amount"=>$amount,
                                                "joined_user"=>$user_id,
                                                "received_user"=>$uplines->id,
                                                "credit_debit"=>"credit",
                                                "up_id"=>$up->id,
                                                "discription"=>"received user inactive current time",
                                            ]; 
                                            DB::table("income_history")->insert($insert_income);
                                        }
                                    }
                                }
                                // if($check_parent_active>0){
                                //     $parent_paying_amount=$paying_amount_find*10/100;
                                //     $parent_laps_amount=0;
                                //     $discription="Successfully";
                                    
                                // }else{
                                //     $parent_paying_amount=0;
                                //     $parent_laps_amount=$paying_amount_find*10/100;
                                //     $discription="received user inactive";
                                // }
                                // $parent_insert_income=[
                                //             "credit_debit"=>'credit',
                                //             "received_user"=>$parent_usertbl->id,
                                //             "joined_user"=>$user_id,
                                //             "laps_amount"=>$parent_laps_amount,
                                //             "amount"=>$parent_paying_amount,
                                //             "type"=>'trading_bonus',
                                //             "invest_amount"=>$amount, 
                                //             "roi_percent"=>$roi_percent,
                                //             "up_id"=>$up->id,
                                //             "discription"=>$discription,
                                //           ];
                                //   DB::table("income_history")->insert($parent_insert_income);
                                //   if($parent_paying_amount>0){
                                //       DB::table("user")->where("id",$parent_usertbl->id)->increment("withdrawl_wallet",$parent_paying_amount);
                                //   }
                                 echo "User id=".$user_tbl->userid." ||| Amount=".$amount." ||| Multiple of three=".$multipleofthree." ||| Total received amount=".$total_recived_amount." ||| Paying amount=".$paying_amount." ||| Laps Amount=".$laps_amount."<br>";
                             }else{
                                 DB::table("user_package")->where("id",$up->id)->update(['roi_status'=>'paid']);
                             }
                             
                          }
                          
                          $this->distributeRoi();
                  }else{
                      echo "Today Genrated Cron Already";
                  }
                  
               
            }
            
          
     }
     
     
    
     public function distributeRoi(){
             echo "Start Cron for funded amount <br>";
           $user_package=DB::table("user_package")->where('active_status',0)->where('roi_status_on_off',1)->get();
           $roi_percent= DB::table("business_setup")->first()->roi_percent;
         foreach ($user_package as $up_inactive){
             $user_id=$up_inactive->user_id;
             $up_id=$up_inactive->id;
             $amount=$up_inactive->amount;
             $check_income_time=DB::table("income_history")->where('type',"roi")->where('up_id',$up_id)->where("received_user",$user_id)->count();
             if($check_income_time<3){
                   $paying_amount=$amount*$roi_percent/100;
                   $insert_income=[
                                "credit_debit"=>'credit',
                                "received_user"=>$user_id,
                                "joined_user"=>$user_id,
                                "laps_amount"=>0,
                                "amount"=>$paying_amount,
                                "type"=>'roi',
                                "invest_amount"=>$amount, 
                                "roi_percent"=>$roi_percent,
                                "up_id"=>$up_id,
                    ];
                DB::table("income_history")->insert($insert_income);
                DB::table("user")->where("id",$user_id)->increment("withdrawl_wallet",$paying_amount);
                echo "User id=".$up_inactive->user_id."  ||| Paying amount=".$paying_amount." ||| Check Count amount=".$check_income_time."<br>";
             }
            
         }
     }
    
    
}
