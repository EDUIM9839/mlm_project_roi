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
class Testing extends Controller
{
    public function testing(){
        
        
        dd('here');
        // $this->distributeTradingBonus();
        
    }
    
     public function removeTrading(){
        
        $incomes = DB::table('income_history')->where('type', 'trading_bonus')->where('received_user', 6180)->get();
        
        $leaveUs = [6280, 6546, 6283, 6371, 6305, 6323];
        
        foreach($incomes as $income){
            if(in_array($income->joined_user, $leaveUs)){
                continue;
            }
            
            if($income->credit_debit == "credit"){
                 DB::table('user')->where('id', $income->received_user)->decrement('withdrawl_wallet', $income->amount);
            }
            
            
            DB::table('income_history')->where('id', $income->id)->delete();
        }
        
    }
    public function removeLevelIncome(){
        
        
        $receiver = 6180;
        $incomes = DB::table('income_history')->where('type', 'level')->where('received_user', $receiver)->where('level_no', 1)->get();
        
        foreach($incomes as $income){
            
            if($income->joined_user == 6280 || $income->joined_user == 6546){
                continue;
            }
            
            if($income->credit_debit == "credit"){
                DB::table('user')->where('id', $income->received_user)->decrement('withdrawl_wallet', $income->amount);
            }
            
            DB::table('income_history')->where('id', $income->id)->delete();
        }
        
        $receiver = 6180;
        $incomes = DB::table('income_history')->where('type', 'level')->where('received_user', $receiver)->where('level_no', 2)->get();
        
        foreach($incomes as $income){
            
            if($income->joined_user == 6283 || $income->joined_user == 6371){
                continue;
            }
            
            if($income->credit_debit == "credit"){
                DB::table('user')->where('id', $income->received_user)->decrement('withdrawl_wallet', $income->amount);
            }
            
            DB::table('income_history')->where('id', $income->id)->delete();
        }
        
        $receiver = 6180;
        $incomes = DB::table('income_history')->where('type', 'level')->where('received_user', $receiver)->where('level_no', 3)->get();
        
        foreach($incomes as $income){
            
            if($income->joined_user == 6305){
                continue;
            }
            
            if($income->credit_debit == "credit"){
                DB::table('user')->where('id', $income->received_user)->decrement('withdrawl_wallet', $income->amount);
            }
            
            DB::table('income_history')->where('id', $income->id)->delete();
        }
        
        
        $receiver = 6180;
        $incomes = DB::table('income_history')->where('type', 'level')->where('received_user', $receiver)->where('level_no', 4)->get();
        
        foreach($incomes as $income){
            
            if($income->joined_user == 6323){
                continue;
            }
            
            if($income->credit_debit == "credit"){
                DB::table('user')->where('id', $income->received_user)->decrement('withdrawl_wallet', $income->amount);
            }
            
            DB::table('income_history')->where('id', $income->id)->delete();
        }
        
        
        
        
    }
    
    //  public function distributeTradingBonus(){
         
         
    //       date_default_timezone_set('UTC');
    //       $current_day=date("D");
    //         if($current_day=="Sat"){
    //               echo "Today Saturday";
    //         }elseif($current_day=="Sun"){
    //              echo "Today Sunday";
    //         }else{
    //               $current_date_time=date("Y-m-d H:i:s");
    //               $current_date=date("Y-m-d");
    //              echo $current_date_time."<br>";
    //              $last_insert_date=DB::table("income_history")->where("type","roi")->orderBy("id","desc")->first()->date??date("Y-m-d",strtotime("+1 days",strtotime(date("Y-m-d"))));
    //              $last_insert_date = "2025-04-07";
                 
    //               if($last_insert_date !=$current_date){
    //                      $roi_percent= DB::table("business_setup")->first()->roi_percent;
    //                       $user_package=DB::table("user_package")->where("roi_status","pending")->where("status","approved")->where("active_status", 1)->get();
    //                       foreach ($user_package as $up){
                              
    //                           if($up->user_id != 6126 || $up->id == 352){
    //                               continue;
    //                           }
                              
    //                           $user_id=$up->user_id;
    //                           $amount=$up->amount;
    //                           $multipleofthree=$amount*3;
    //                           $paying_amount_find=$amount*$roi_percent/100;
    //                           $user_tbl=DB::table("user")->where("id",$user_id)->first();
    //                           $parent_usertbl=DB::table("user")->where("userid",$user_tbl->referal)->first();
    //                           $check_parent_active=DB::table("user_package")->where("active_status",1)->where("status","approved")->where("user_id",$parent_usertbl->id)->count();
    //                          $total_recived_amount=DB::table("income_history")->where('type',"roi")->where('up_id',$up->id)->where("received_user",$user_id)->sum('amount');
    //                          $total_paying_current_amt=$paying_amount_find+$total_recived_amount;
    //                          if($total_recived_amount<$multipleofthree){
    //                              if($multipleofthree>=$total_paying_current_amt){
    //                                      $paying_amount=$paying_amount_find;
    //                                      $laps_amount=0;
    //                              }elseif($multipleofthree<$total_paying_current_amt){
    //                                       $paying_amount=$total_paying_current_amt-$multipleofthree;
    //                                       $laps_amount=$paying_amount_find-$paying_amount;
                                    
    //                              }
    //                              $insert_income=[
    //                                         "credit_debit"=>'credit',
    //                                         "received_user"=>$user_id,
    //                                         "joined_user"=>$user_id,
    //                                         "laps_amount"=>$laps_amount,
    //                                         "amount"=>$paying_amount,
    //                                         "type"=>'roi',
    //                                         "invest_amount"=>$amount, 
    //                                         "roi_percent"=>$roi_percent,
    //                                         "up_id"=>$up->id,
    //                                       ];
    //                              DB::table("income_history")->insert($insert_income);
    //                              DB::table("user")->where("id",$user_id)->increment("withdrawl_wallet",$paying_amount);
    //                              if($total_paying_current_amt>=$multipleofthree){
    //                                   DB::table("user_package")->where("id",$up->id)->update(['roi_status'=>'paid']);
    //                              }
    //                             if($check_parent_active>0){
    //                                 $parent_paying_amount=$paying_amount_find*10/100;
    //                                 $parent_laps_amount=0;
    //                                 $discription="Successfully";
                                    
    //                             }else{
    //                                 $parent_paying_amount=0;
    //                                 $parent_laps_amount=$paying_amount_find*10/100;
    //                                 $discription="received user inactive";
    //                             }
    //                             $parent_insert_income=[
    //                                         "credit_debit"=>'credit',
    //                                         "received_user"=>$parent_usertbl->id,
    //                                         "joined_user"=>$user_id,
    //                                         "laps_amount"=>$parent_laps_amount,
    //                                         "amount"=>$parent_paying_amount,
    //                                         "type"=>'trading_bonus',
    //                                         "invest_amount"=>$amount, 
    //                                         "roi_percent"=>$roi_percent,
    //                                         "up_id"=>$up->id,
    //                                         "discription"=>$discription,
    //                                       ];
    //                               DB::table("income_history")->insert($parent_insert_income);
    //                               if($parent_paying_amount>0){
    //                                   DB::table("user")->where("id",$parent_usertbl->id)->increment("withdrawl_wallet",$parent_paying_amount);
    //                               }
    //                              echo "User id=".$user_tbl->userid." ||| Amount=".$amount." ||| Multiple of three=".$multipleofthree." ||| Total received amount=".$total_recived_amount." ||| Paying amount=".$paying_amount." ||| Laps Amount=".$laps_amount." ||| Pairent Paying Amount=".$parent_paying_amount."<br>";
    //                          }else{
    //                              DB::table("user_package")->where("id",$up->id)->update(['roi_status'=>'paid']);
    //                          }
                             
    //                       }
                          
    //                       $this->distributeRoi();
    //               }else{
    //                   echo "Today Genrated Cron Already";
    //               }
                  
               
    //         }
            
          
    //  }
    //  public function distributeRoi(){
    //          echo "Start Cron for funded amount <br>";
    //       $user_package=DB::table("user_package")->where('active_status',0)->get();
    //       $roi_percent= DB::table("business_setup")->first()->roi_percent;
    //      foreach ($user_package as $up_inactive){
             
    //          if($up_inactive->user_id != 6126 || $up_inactive->id == 352){
    //              continue;
    //          }
             
    //          $user_id=$up_inactive->user_id;
    //          $up_id=$up_inactive->id;
    //          $amount=$up_inactive->amount;
    //          $check_income_time=DB::table("income_history")->where('type',"roi")->where('up_id',$up_id)->where("received_user",$user_id)->count();
    //          if($check_income_time<3){
    //               $paying_amount=$amount*$roi_percent/100;
    //               $insert_income=[
    //                             "credit_debit"=>'credit',
    //                             "received_user"=>$user_id,
    //                             "joined_user"=>$user_id,
    //                             "laps_amount"=>0,
    //                             "amount"=>$paying_amount,
    //                             "type"=>'roi',
    //                             "invest_amount"=>$amount, 
    //                             "roi_percent"=>$roi_percent,
    //                             "up_id"=>$up_id,
    //                 ];
    //             DB::table("income_history")->insert($insert_income);
    //             DB::table("user")->where("id",$user_id)->increment("withdrawl_wallet",$paying_amount);
    //             echo "User id=".$up_inactive->user_id."  ||| Paying amount=".$paying_amount." ||| Check Count amount=".$check_income_time."<br>";
    //          }
            
    //      }
    //  }
   
    public function testingold(){
        dump("execution start");
        
        // $incomes = DB::table('income_history')->where('type', 'roi')->groupBy('date', 'received_user')->get();
       
        
        $bonusPackages = DB::table("user_package")->where('active_status',0)->whereNotIn('user_id', [5950, 5949, 5948])->get();
        
        foreach($bonusPackages as $package){
            
            $incomes = DB::table('income_history')->where('up_id', $package->id)->get();
            
            foreach($incomes as $income){
                
                if(DB::table('income_history')->where('up_id', $package->id)->where('date', $income->date)->count() >  1){
                       echo "Multiple Time || $income->received_user || $income->date || $income->invest_amount || $income->amount<br>";
                       DB::table('user')->where('id', $income->received_user)->decrement('withdrawl_wallet', $income->amount);
                       DB::table('income_history')->where('id', $income->id)->delete();
                       
                }
                if(date("D", strtotime($income->date_time)) == "Sat" || date("D", strtotime($income->date_time)) == "Sun"){
                      echo "Weekend || $income->received_user || $income->date || $income->invest_amount || $income->amount<br>";
                      DB::table('user')->where('id', $income->received_user)->decrement('withdrawl_wallet', $income->amount);
                      DB::table('income_history')->where('id', $income->id)->delete();
                }
                
            }
            
        }
        
        
        dd("execution complete");
        
    }
    
    public function test(){
        
        $allRewards = DB::table('reward_achieved_user')
                            ->join('reward_vip', 'reward_achieved_user.level_no', '=', 'reward_vip.id')
                            ->where('delivery_status', 'delivered')
                            ->get();
        
        
        foreach($allRewards as $reward){
            
            
            DB::table('user')->where('id',$reward->user_id)->increment("reward_wallet", $reward->reward_amount);
            
            DB::table('income_history')->insert([
                'type' => 'reward',
                'amount' =>  $reward->reward_amount,
                'joined_user' =>  $reward->user_id,
                'received_user' =>  $reward->user_id,
                'credit_debit' => 'credit'
            ]);
            
        }
        
        
    }
  
    public function handle12()
    {
       
         echo "current Date=".date("d-m-Y H:i:s");
         $current_day=date("D");
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
            // update code with sanchit singh 26/10/2024
        // $roi_percent=0.5;
       $user_package=DB::table("user_package")->groupBy("user_id")->get();
       if(!empty($user_package[0])){
          
       foreach($user_package as $up){
           $recived_roi_percent=DB::table("user_package")->where("user_id",$up->user_id)->where("recived_roi_percent",">",0)->first();
           if(!empty($recived_roi_percent)){
                $roi_percent=$recived_roi_percent->recived_roi_percent;
           }else{
                $roi_percent=0.5;
           }
           $total_invest_amount=DB::table("user_package")->where("user_id",$up->user_id)->where("status","approved")->sum('amount');
           if($total_invest_amount>0){
          $total_invest_amount3=$total_invest_amount*3;
           $paying_amount=$total_invest_amount*$roi_percent/100;
                
                $current_recived_direct=DB::table("income_history")->where("received_user",$up->user_id)->where("credit_debit","credit")->where("type","direct")->sum('amount');
                $current_recived_level=DB::table("income_history")->where("received_user",$up->user_id)->where("credit_debit","credit")->where("type","level")->sum('amount');
                $current_recived_roi=DB::table("income_history")->where("received_user",$up->user_id)->where("credit_debit","credit")->where("type","roi")->sum('amount');
                $current_recived_club=DB::table("income_history")->where("received_user",$up->user_id)->where("credit_debit","credit")->where("type","club_income")->sum('amount');
                        
                        
            $current_recived_amount=$current_recived_direct+$current_recived_level+$current_recived_roi+$current_recived_club;
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
                            "date_time"=> "2025-01-28 23:46:01",
                            "date" => "2025-01-28",
                           ];
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
                              "date_time"=> "2025-01-28 23:46:01",
                            "date" => "2025-01-28",
                           
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
                              "date_time"=> "2025-01-28 23:46:01",
                            "date" => "2025-01-28",
                           ];
                   DB::table("income_history")->insert($insert_income);
           }
           
       }  
       }}else{
           echo "not found roi";
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
        if(!empty($direct_income[0])){
       foreach($direct_income as $di){
           
           $total_invest_amount=DB::table("user_package")->where("user_id",$di->received_user)->where("status","approved")->sum('amount');
           if($total_invest_amount>0){
               $total_invest_amount3=$total_invest_amount*3;
                 $paying_amount=$di->amount;
               $current_recived_direct=DB::table("income_history")->where("received_user",$di->received_user)->where("credit_debit","credit")->where("type","direct")->sum('amount');
                $current_recived_level=DB::table("income_history")->where("received_user",$di->received_user)->where("credit_debit","credit")->where("type","level")->sum('amount');
                $current_recived_roi=DB::table("income_history")->where("received_user",$di->received_user)->where("credit_debit","credit")->where("type","roi")->sum('amount');
                $current_recived_club=DB::table("income_history")->where("received_user",$di->received_user)->where("credit_debit","credit")->where("type","club_income")->sum('amount');
                 
            $current_recived_amount=$current_recived_direct+$current_recived_level+$current_recived_roi + $current_recived_club;
            $total_income=$current_recived_amount+$paying_amount;
            if($total_invest_amount3>$current_recived_amount){
                 if($total_invest_amount3>=$total_income){
                       DB::table("income_history")->where("id",$di->id)->update(["credit_debit"=>"credit","laps_amount"=>"0","amount"=>$paying_amount]);
                      DB::table("user")->where("id",$di->received_user)->increment("incentive_wallet",$paying_amount);
                      
                  }else{
                 $paying_amount2=$total_invest_amount3-$current_recived_amount;
                 $laps_amount=$paying_amount-$paying_amount2;
                   DB::table("income_history")->where("id",$di->id)->update(["credit_debit"=>"credit","laps_amount"=>$laps_amount,"amount"=>$paying_amount2]);
                      DB::table("user")->where("id",$di->received_user)->increment("incentive_wallet",$paying_amount2);
               }
            }else{
                 DB::table("income_history")->where("id",$di->id)->update(["credit_debit"=>"laps"]);
            }
           }else{
               DB::table("income_history")->where("id",$di->id)->update(["credit_debit"=>"laps"]);
           }
           
       }}else{
           echo "not found direct";
       }
    }
    
    
    
}



 
