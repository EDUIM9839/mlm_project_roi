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
class RoiCronJob extends Controller
{
    public function roi_cron(){
        
         $current_day=date("D");
        //  dd($current_day);
        if($current_day=="Sat"){
              echo "Today Saturday";
        }elseif($current_day=="Sun"){
             echo "Today Sunday";
        }else{
        $current_date=date("Y-m-d");
        $roi_date=DB::table("income_history")->where("type","roi")->orderBy("id","desc")->first();
        if(!empty($roi_date)){
            $previus_date=$roi_date->date;
        }else{
            $previus_date=date("Y-m-d",strtotime("-1 day",strtotime(date("Y-m-d"))));
        }
        if($current_date!=$previus_date){
        $roi_percent=0.5;
       $user_package=DB::table("user_package")->groupBy("user_id")->get();
       
       foreach($user_package as $up){
           $total_invest_amount=DB::table("user_package")->where("user_id",$up->user_id)->where("status","approved")->sum('amount');
           if($total_invest_amount>0){
            $total_invest_amount3=$total_invest_amount*3;
            $paying_amount=$total_invest_amount*$roi_percent/100;
           
            $current_recived_direct=DB::table("income_history")->where("received_user",$up->user_id)->where("credit_debit","credit")->where("type","direct")->sum('amount');
            $current_recived_level=DB::table("income_history")->where("received_user",$up->user_id)->where("credit_debit","credit")->where("type","level")->sum('amount');
            $current_recived_roi=DB::table("income_history")->where("received_user",$up->user_id)->where("credit_debit","credit")->where("type","roi")->sum('amount');
                
            $current_recived_amount=$current_recived_direct+$current_recived_level+$current_recived_roi;
            $total_income=$current_recived_amount+$paying_amount;
            
           echo "user id=".$up->user_id." |||| Total Amount=".$total_invest_amount." |||| Total Amount 3 Guna=".$total_invest_amount3." |||| Paying Amount=".$paying_amount." |||| Current Recived Amount=".$current_recived_amount."<br>";
           if($total_invest_amount3>$current_recived_amount){
               if($total_invest_amount3>=$total_income){
                    $insert_income=[
                            "credit_debit"=>'credit',
                            "received_user"=>$up->user_id,
                            "joined_user"=>$up->user_id,
                            "laps_amount"=>0,
                            "amount"=>$paying_amount,
                            "type"=>'roi',
                            "invest_amount"=>$total_invest_amount, 
                           ];
                            //  dd($insert_income);
                             DB::table("income_history")->insert($insert_income);
                             DB::table("user")->where("id",$up->user_id)->increment("withdrawl_wallet",$paying_amount);
               }else{
                 $paying_amount2=$total_invest_amount3-$current_recived_amount;
                 $laps_amount=$paying_amount-$paying_amount2;
                  $insert_income=[
                            "credit_debit"=>'credit',
                            "received_user"=>$up->user_id,
                            "joined_user"=>$up->user_id,
                            "laps_amount"=>$laps_amount,
                            "amount"=>$paying_amount2,
                            "type"=>'roi',
                             "invest_amount"=>$total_invest_amount,
                           
                           ];
                             DB::table("income_history")->insert($insert_income);
                             DB::table("user")->where("id",$up->user_id)->increment("withdrawl_wallet",$paying_amount2);
               }
           }else{
               $insert_income=[
                            "credit_debit"=>'laps',
                            "received_user"=>$up->user_id,
                            "joined_user"=>$up->user_id,
                            "laps_amount"=>$paying_amount,
                            "amount"=>0,
                            "type"=>'roi',
                             "invest_amount"=>$total_invest_amount,
                           ];
                   DB::table("income_history")->insert($insert_income);
           }
           
       }  
       }
       
    }
    else{
      echo "Today Already Genrated";
    }
    }
    
    $this->DirectIncomeCron();
    }
    
    public function DirectIncomeCron(){
        $direct_income=DB::table("income_history")->where( "type",'direct')->where( "credit_debit","inactive")->get();
       foreach($direct_income as $di){
           
           $total_invest_amount=DB::table("user_package")->where("user_id",$di->received_user)->where("status","approved")->sum('amount');
           if($total_invest_amount>0){
               $total_invest_amount3=$total_invest_amount*3;
                 $paying_amount=$di->amount;
               $current_recived_direct=DB::table("income_history")->where("received_user",$di->received_user)->where("credit_debit","credit")->where("type","direct")->sum('amount');
                $current_recived_level=DB::table("income_history")->where("received_user",$di->received_user)->where("credit_debit","credit")->where("type","level")->sum('amount');
                $current_recived_roi=DB::table("income_history")->where("received_user",$di->received_user)->where("credit_debit","credit")->where("type","roi")->sum('amount');
            $current_recived_amount=$current_recived_direct+$current_recived_level+$current_recived_roi;
            $total_income=$current_recived_amount+$paying_amount;
            if($total_invest_amount3>$current_recived_amount){
                 if($total_invest_amount3>=$total_income){
                       DB::table("income_history")->where("id",$di->id)->update(["credit_debit"=>"credit","laps_amount"=>"0","amount"=>$paying_amount]);
                      DB::table("user")->where("id",$di->received_user)->increment("withdrawl_wallet",$paying_amount);
                      
                  }else{
                 $paying_amount2=$total_invest_amount3-$current_recived_amount;
                 $laps_amount=$paying_amount-$paying_amount2;
                   DB::table("income_history")->where("id",$di->id)->update(["credit_debit"=>"credit","laps_amount"=>$laps_amount,"amount"=>$paying_amount2]);
                      DB::table("user")->where("id",$di->received_user)->increment("withdrawl_wallet",$paying_amount2);
               }
            }else{
                 DB::table("income_history")->where("id",$di->id)->update(["credit_debit"=>"laps"]);
            }
           }else{
               DB::table("income_history")->where("id",$di->id)->update(["credit_debit"=>"laps"]);
           }
           
       }
    }
    
    public function level_roi_cron(){
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
          $user_package=DB::table("user_package")->groupBy("user_id")->get();
       foreach($user_package as $up){
           $tbl_user=DB::table("user")->where('id',$up->user_id)->first();
           $total_invest_amount=DB::table("user_package")->where("user_id",$up->user_id)->where("status","approved")->sum('amount');
           if($total_invest_amount>0){
           echo "User id=".$up->user_id." |||| Invest Amount=".$total_invest_amount."<br>";
          $mlmc=new MLMController();
         $mlmc->upline($tbl_user);
        $upline= $mlmc->getUpline();
        
            foreach($upline as $key=>$uplines){
               
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
           
            foreach($levels as $level){
                   
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
                                        ];
                                 DB::table("income_history")->insert($insert_income);
                                 DB::table("user")->where("id",$uplines->id)->increment("incentive_wallet",$paying_amount2);
                            }
                        }else{
                             $paying_amount=$total_invest_amount*$level->percent/100;
                         echo "Laps Level No=".$level->id." ||| Pairent Id=".$uplines->id." ||| Total Direct=".$total_direct."<br>";
                           $insert_income=[
                            "credit_debit"=>'laps',
                            "received_user"=>$uplines->id,
                            "joined_user"=>$up->user_id,
                            "laps_amount"=>$paying_amount,
                            "level_no"=>$level->id,
                            "amount"=>0,
                            "type"=>'level',
                             "invest_amount"=>$total_invest_amount,
                           ];
                          DB::table("income_history")->insert($insert_income);
                        }
                    }else{
                        $paying_amount=$total_invest_amount*$level->percent/100;
                         echo "direct Laps Level No=".$level->id." ||| Pairent Id=".$uplines->id." ||| Total Direct=".$total_direct."<br>";
                           $insert_income=[
                            "credit_debit"=>'laps direct',
                            "received_user"=>$uplines->id,
                            "joined_user"=>$up->user_id,
                            "laps_amount"=>$paying_amount,
                            "level_no"=>$level->id,
                            "amount"=>0,
                            "type"=>'level',
                             "invest_amount"=>$total_invest_amount,
                           ];
                      DB::table("income_history")->insert($insert_income);
                    }
                  }else{
                       
                      $paying_amount=$total_invest_amount*$level->percent/100;
                         echo "Inactive Level No=".$level->id." ||| Pairent Id=".$uplines->id." ||| Total Direct=".$total_direct."<br>";
                           $insert_income=[
                            "credit_debit"=>'inactive',
                            "received_user"=>$uplines->id,
                            "joined_user"=>$up->user_id,
                            "laps_amount"=>$paying_amount,
                            "level_no"=>$level->id,
                            "amount"=>0,
                            "type"=>'level',
                             "invest_amount"=>$total_invest_amount,
                           ];
                      DB::table("income_history")->insert($insert_income);
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



 
