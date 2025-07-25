<?php

namespace App\Http\Controllers\Cron;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\BtreeController;
// use App\Http\Controllers\MLMController;
// use App\Models\User;
class RoiCronJob extends Controller
{
    
    public function testing(){
        $this->roi_cron();
        $this->roi_cron2();
    }
 
     public function roi_cron(){
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
                         $roi_percent= DB::table("business_setup")->first()->roi_percent;
                          $user_package=DB::table("user_package")->where("roi_status","pending")->where("status","approved")->where("active_status", 1)->get();
                          foreach ($user_package as $up){
                              $user_id=$up->user_id;
                              $amount=$up->amount;
                              $multipleofthree=$amount*3;
                              $paying_amount_find=$amount*$roi_percent/100;
                              $user_tbl=DB::table("user")->where("id",$user_id)->first();
                              $parent_usertbl=DB::table("user")->where("userid",$user_tbl->referal)->first();
                              $check_parent_active=DB::table("user_package")->where("active_status",1)->where("status","approved")->where("user_id",$parent_usertbl->id)->count();
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
                                if($check_parent_active>0){
                                    $parent_paying_amount=$paying_amount_find*10/100;
                                    $parent_laps_amount=0;
                                    $discription="Successfully";
                                    
                                }else{
                                    $parent_paying_amount=0;
                                    $parent_laps_amount=$paying_amount_find*10/100;
                                    $discription="received user inactive";
                                }
                                $parent_insert_income=[
                                            "credit_debit"=>'credit',
                                            "received_user"=>$parent_usertbl->id,
                                            "joined_user"=>$user_id,
                                            "laps_amount"=>$parent_laps_amount,
                                            "amount"=>$parent_paying_amount,
                                            "type"=>'trading_bonus',
                                            "invest_amount"=>$amount, 
                                            "roi_percent"=>$roi_percent,
                                            "up_id"=>$up->id,
                                            "discription"=>$discription,
                                           ];
                                  DB::table("income_history")->insert($parent_insert_income);
                                  if($parent_paying_amount>0){
                                       DB::table("user")->where("id",$parent_usertbl->id)->increment("withdrawl_wallet",$parent_paying_amount);
                                  }
                                 echo "User id=".$user_tbl->userid." ||| Amount=".$amount." ||| Multiple of three=".$multipleofthree." ||| Total received amount=".$total_recived_amount." ||| Paying amount=".$paying_amount." ||| Laps Amount=".$laps_amount." ||| Pairent Paying Amount=".$parent_paying_amount."<br>";
                             }else{
                                 DB::table("user_package")->where("id",$up->id)->update(['roi_status'=>'paid']);
                             }
                             
                          }
                          
                          $this->roi_cron2();
                  }else{
                      echo "Today Genrated Cron Already";
                  }
                  
               
            }
            
          
     }
     
     
         public function roi_cron2(){
             echo "Start Cron for funded amount <br>";
           $user_package=DB::table("user_package")->where('active_status',0)->get();
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
    
    public function roi_cron3(){
        
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



 
