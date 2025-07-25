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
class LevelRoiCronManulay extends Controller
{
    
    public function find_level_roi_all(){
        echo date("Y-m-d H:i:s")."<br>";
       $user_package=DB::table("user_package")->groupBy("user_id")->get();
       $all_total_extra_amt=0;
       foreach($user_package as $up){
           $user=DB::table("user")->where('id',$up->user_id)->first();
           $withdrawl_amt=DB::table("withdrawl_request")->where("user_id",$up->user_id)->where("wallet_type","incentive_wallet")->sum('amount');
           $withdrawl_amt_roi=DB::table("withdrawl_request")->where("user_id",$up->user_id)->where("wallet_type","roi_wallet")->sum('amount');
           $convert_amt=DB::table("transaction")->where("to_id",$up->user_id)->where("wallet_type","incentive_wallet")->sum('amount');
           $convert_amt_roi=DB::table("transaction")->where("to_id",$up->user_id)->where("wallet_type","withdrawl_wallet")->sum('amount');
            $total_direct_amt=DB::table("income_history")->where("received_user",$user->id)->where("type","direct")->where("credit_debit","credit")->sum('amount');
            $total_level_amt=DB::table("income_history")->where("received_user",$user->id)->where("type","level")->where("credit_debit","credit")->sum('amount');
            $total_roi_amt=DB::table("income_history")->where("received_user",$user->id)->where("type","roi")->where("credit_debit","credit")->sum('amount');
           $incentive_wallet=$user->incentive_wallet;
           $total_amt=$incentive_wallet+$convert_amt+$withdrawl_amt;
            $total_roi_amount=$user->withdrawl_wallet+$convert_amt_roi+$withdrawl_amt_roi;
          $total_extra_amt=$total_roi_amount-$total_roi_amt;
           $total_revied_amt=$total_direct_amt+$total_level_amt;
           $extraamt=$total_amt-($total_revied_amt+$total_extra_amt);
           if($total_revied_amt<$total_amt){
               if($extraamt>0.9){
                  $all_total_extra_amt+=$extraamt;
                    //  echo $extraamt."/user id=".$user->userid." ||| Current IW=".$incentive_wallet." |||Recived  IW withdrwal=".$withdrawl_amt." |||convert IW =".$convert_amt." || Level Amt=".$total_level_amt." || Direct Amt=".$total_direct_amt." || Total Amt wt=".$total_amt." ||| total Amt Recived=".$total_revied_amt."<br>";
                     echo $user->id."=user id=".$user->userid." ||| Current Wallet Amt=".$incentive_wallet." ||| Total Recived Income history=".$total_revied_amt." |||Total Recived =".$total_amt." ||| Extra Amt =".$extraamt."<br><br>";
                     if($total_roi_amount>$total_roi_amt){
                         if($total_extra_amt>0.1){
                            //   echo $total_extra_amt."<br>". $user->id."<br>";
                         }
                        
                        //   echo "Recived Roi Amt=".$total_roi_amt."<br>";
                        //   echo "Curent Wallet Roi Amt=".$user->withdrawl_wallet."<br>";
                        //   echo "Convert Roi Amt=".$convert_amt_roi."<br>";
                        //   echo "Withdrwal Roi Amt=".$withdrawl_amt_roi."<br>";
                     }
                    
               }
              
           }
          
       }
       echo "total Extra Amt=".$all_total_extra_amt;
    }
    public function find_level_roi_all2(){
        die;
        echo date("Y-m-d H:i:s")."<br>";
        $income_history=DB::table("income_history")->where("date","2025-01-06")->where("type","level")->orderBy("received_user","ASC")->get();
        foreach($income_history as $income_historys){
            $user_id=$income_historys->received_user;
            $paying_amount=$income_historys->amount;
            echo "received_user=".$income_historys->received_user." |||| joined_user=".$income_historys->joined_user." ||| Date=".$income_historys->date_time."<br>";
            //   DB::table("user")->where("id",$user_id)->decrement("incentive_wallet",$paying_amount);
            //   DB::table("income_history")->where("id",$income_historys->id)->delete();
        }
        
    }
    public function manualy_level_roi(){
        die;
        echo "current Date=".date("d-m-Y H:i:s")."<br>";
        $current_day=date("D");
        if($current_day=="Sat"){
              echo "Today Saturday";
        }elseif($current_day=="Sun"){
             echo "Today Sunday";
        }else{
         $current_date=date("Y-m-d");
        $roi_date=DB::table("income_history")->where("type","level")->orderBy("id","desc")->first();
        if(!empty($roi_date)){
            $previus_date=$roi_date->date;
        }else{
            $previus_date=date("Y-m-d",strtotime("-1 day",strtotime($current_date)));
        }
        if($current_date!=$previus_date){
        $levels=DB::table("levels")->get();
        $count_levels=DB::table("levels")->count();
        // dd($count_levels);
          $user_package=DB::table("user_package")->where("id",">","0")->where("id","<=","565")->get();
       foreach($user_package as $up){
             $mlmc=new MLMController();
           $tbl_user=DB::table("user")->where('id',$up->user_id)->first();
           $total_invest_amount=$mlmc->CurrentInvestAmount($up->user_id);
        //   $total_invest_amount=DB::table("user_package")->where("user_id",$up->user_id)->where("status","approved")->where("created_at","<","2025-01-03 07:07:44")->sum('amount');
           if($total_invest_amount>0){
           echo $up->id."User id=".$up->user_id." |||| Invest Amount=".$total_invest_amount."<br>";
        
         $mlmc->upline2($tbl_user);
        $upline= $mlmc->getUpline2();
        
            foreach($upline as $key=>$uplines){
                  if(DB::table("income_history")->where("received_user",$uplines->id)->where("joined_user",$up->user_id)->where("type","level")->where("date","2025-01-02")->count()<1){
                  $total_invest_amount_upline=DB::table("user_package")->where("user_id",$uplines->id)->where("status","approved")->sum('amount');
                   $total_invest_amount_upline3=$total_invest_amount_upline*3;
                $current_recived_direct=DB::table("income_history")->where("received_user",$uplines->id)->where("credit_debit","credit")->where("type","direct")->sum('amount');
                $current_recived_level=DB::table("income_history")->where("received_user",$uplines->id)->where("credit_debit","credit")->where("type","level")->sum('amount');
                $current_recived_roi=DB::table("income_history")->where("received_user",$uplines->id)->where("credit_debit","credit")->where("type","roi")->sum('amount');
            $current_recived_amount=$current_recived_direct+$current_recived_level+$current_recived_roi;
                    $mlmc2=new MLMController();
                   $mlmc2->direct($uplines);
                 $direct=$mlmc2->getdirect();
                $total_direct=count($direct);
           
            // foreach($levels as $level){
                  $level= DB::table("levels")->where("level_no",$key)->first();
                   if(!empty($level)){
                if($key==$level->level_no){
                  if($total_invest_amount_upline>0){
                      if($total_direct>=$level->direct){
                        echo "Achived Level No=".$level->id." ||| Pairent Id=".$uplines->id." ||| Total Direct=".$total_direct."<br>";
                         $paying_amount=$total_invest_amount*$level->percent/100;
                         $total_income2=$current_recived_amount+$paying_amount;
                        if($total_invest_amount_upline3>$current_recived_amount){
                            if($total_invest_amount_upline3>=$total_income2){
                                $insert_income=[
                                         "credit_debit"=>'credit',
                                         "received_user"=>$uplines->id,
                                         "joined_user"=>$up->user_id,
                                         "laps_amount"=>0,
                                         "level_no"=>$level->id,
                                         "amount"=>$paying_amount,
                                         "type"=>'level',
                                         "date_time"=>'2025-01-02 18:21:10',
                                         "date"=>'2025-01-02',
                                          "invest_amount"=>$total_invest_amount,
                                        ];
                                 DB::table("income_history")->insert($insert_income);
                                 DB::table("user")->where("id",$uplines->id)->increment("incentive_wallet",$paying_amount);
                            }else{
                                 $paying_amount2=$total_invest_amount_upline3-$current_recived_amount;
                                 $laps_amount=$paying_amount-$paying_amount2;
                                 $insert_income=[
                                         "credit_debit"=>'credit',
                                         "received_user"=>$uplines->id,
                                         "joined_user"=>$up->user_id,
                                         "laps_amount"=>$laps_amount,
                                         "level_no"=>$level->id,
                                         "amount"=>$paying_amount2,
                                         "type"=>'level',
                                          "invest_amount"=>$total_invest_amount,
                                          "date_time"=>'2025-01-02 18:21:10',
                                         "date"=>'2025-01-02',
                                        ];
                                 DB::table("income_history")->insert($insert_income);
                                 DB::table("user")->where("id",$uplines->id)->increment("incentive_wallet",$paying_amount2);
                            }
                        }else{
                             $paying_amount=$total_invest_amount*$level->percent/100;
                        //  echo "Laps Level No=".$level->id." ||| Pairent Id=".$uplines->id." ||| Total Direct=".$total_direct."<br>";
                           $insert_income=[
                            "credit_debit"=>'laps',
                            "received_user"=>$uplines->id,
                            "joined_user"=>$up->user_id,
                            "laps_amount"=>$paying_amount,
                            "level_no"=>$level->id,
                            "amount"=>0,
                            "type"=>'level',
                             "invest_amount"=>$total_invest_amount,
                             "date_time"=>'2025-01-02 18:21:10',
                             "date"=>'2025-01-02',
                           ];
                          DB::table("income_history")->insert($insert_income);
                        }
                    }else{
                        $paying_amount=$total_invest_amount*$level->percent/100;
                        //  echo "direct Laps Level No=".$level->id." ||| Pairent Id=".$uplines->id." ||| Total Direct=".$total_direct."<br>";
                           $insert_income=[
                            "credit_debit"=>'laps direct',
                            "received_user"=>$uplines->id,
                            "joined_user"=>$up->user_id,
                            "laps_amount"=>$paying_amount,
                            "level_no"=>$level->id,
                            "amount"=>0,
                            "type"=>'level',
                             "invest_amount"=>$total_invest_amount,
                             "date_time"=>'2025-01-02 18:21:10',
                             "date"=>'2025-01-02',
                           ];
                      DB::table("income_history")->insert($insert_income);
                    }
                  }else{
                       
                      $paying_amount=$total_invest_amount*$level->percent/100;
                        //  echo "Inactive Level No=".$level->id." ||| Pairent Id=".$uplines->id." ||| Total Direct=".$total_direct."<br>";
                           $insert_income=[
                            "credit_debit"=>'inactive',
                            "received_user"=>$uplines->id,
                            "joined_user"=>$up->user_id,
                            "laps_amount"=>$paying_amount,
                            "level_no"=>$level->id,
                            "amount"=>0,
                            "type"=>'level',
                             "invest_amount"=>$total_invest_amount,
                             "date_time"=>'2025-01-02 18:21:10',
                             "date"=>'2025-01-02',
                           ];
                      DB::table("income_history")->insert($insert_income);
                  }
                    
                }
                
            }
            
        
                     }
            }
       }
       }
       
    }else{
        echo "Today Already Genrated";
    }
    }
    
    
    }
}



 
