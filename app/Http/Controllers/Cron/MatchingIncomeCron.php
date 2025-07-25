<?php

namespace App\Http\Controllers\Cron;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BtreeController;
use App\Models\User;
class MatchingIncomeCron extends Controller
{
 
  function matching_cron(){
  
     $user_tbl=DB::table("user")->where('role','user')->where('company_role','no')->get();
     foreach($user_tbl as $user_tbls){
       $star_user=DB::table("star_user")->where('userid',$user_tbls->id)->first();
         if($user_tbls->package_status=="active"){
             $total_direct=DB::table("user")->where('referal',$user_tbls->userid)->where('package_status','active')->count();
                 $btree=new BtreeController;
             $get_left_right=$btree->getLeftRightUsers($star_user,$star_user);
             $total_left_user=100;
        for($i=0;$i<count($get_left_right["left"]);$i++){
            $userch=DB::table("user")->where('id',$get_left_right["left"][$i])->first();
            if($userch->package_status="active"){
                  $total_left_user++;
            }
          
        }
        $total_right_user=100;
        for($ii=0;$ii<count($get_left_right["right"]);$ii++){
              $userch2=DB::table("user")->where('id',$get_left_right["right"][$ii])->first();
               if($userch2->package_status="active"){
                   $total_right_user++;
               }
        }
             if($total_right_user>$total_left_user){
                 $common_pair=$total_left_user;
             }else{
                  $common_pair=$total_right_user;
             }
            $recived_total_pair_amount= DB::table("income_history")->where('received_user',$user_tbls->id)->where('type','matching')->sum("total_pair_id");
          $all_total_pair= $common_pair-$recived_total_pair_amount;
          
           $levels= DB::table("levels")->get();
          foreach($levels as $level){
             $recived_total_pair_amount2= DB::table("income_history")->where('received_user',$user_tbls->id)->where('type','matching')->sum("total_pair_id");
             $total_cycle= DB::table("income_history")->where('received_user',$user_tbls->id)->where('type','matching')->sum("total_pair");
            $levels_direct= DB::table("levels_direct")->where("cycle_start","<=",$total_cycle)->where('cycle_end',">=",$total_cycle)->first();
            $level_wisePair=DB::table("income_history")->where('received_user',$user_tbls->id)->where('type','matching')->where("level_no",$level->id)->sum("total_pair");
           $common_pair2=$common_pair-$recived_total_pair_amount2;
        //   echo "test=".$common_pair2."<br>";
           $actual_pair=floor($common_pair2/$level->pair_id);
            echo "level No=".$level->pair_id." ||| Current total pair Recived=".$level_wisePair." ||| Actual Current Pair=".$actual_pair."<br>";
            if($level_wisePair<$level->recived_pair){
                // echo $actual_pair."<br>";
                // echo $level_wisePair."<br>";
                if($actual_pair>=$level->recived_pair){
                    $total_recived_pair=$level->recived_pair-$level_wisePair;
                   $paying_amount=30*$total_recived_pair;
                }else
                {
                    if($actual_pair>0){
                        $check_actuar_pair=$level_wisePair+$actual_pair;
                        if($check_actuar_pair>$level->recived_pair){
                           $total_recived_pair= $level->recived_pair-$level_wisePair;
                             $paying_amount=30*$total_recived_pair;
                        }else{
                            $total_recived_pair=$actual_pair;
                            $paying_amount=30*$total_recived_pair;
                        }
                       
                     }else{
                         $total_recived_pair=0;
                         $paying_amount=0;
                     }
                }
                echo $total_recived_pair."<br>";
                if($total_recived_pair>0){
                    if($levels_direct->direct<=$total_direct){
                    for($i=0;$i<$total_recived_pair;$i++){
                        $insert_data=[
                        "type"=>"matching",
                        "level_no"=>$level->id,
                        "amount"=>30,
                        "total_pair"=>1,
                        "total_pair_id"=>$level->pair_id,
                        "received_user"=>$user_tbls->id,
                        "credit_debit"=>"credit",
                    ];
                    DB::table("income_history")->insert($insert_data);
                    }
                }
                   $total_pair_id= $total_recived_pair*$level->pair_id;
                    //  $insert_data=[
                    //     "type"=>"matching",
                    //     "level_no"=>$level->id,
                    //     "amount"=>$paying_amount,
                    //     "total_pair"=>$total_recived_pair,
                    //     "total_pair_id"=>$total_pair_id,
                    //     "joined_user"=>$user_tbls->id,
                    //     "received_user"=>$user_tbls->id,
                    //     "credit_debit"=>"credit",
                    // ];
                    // DB::table("income_history")->insert($insert_data);
                }
               
            }
 
          }
          
                 echo "User id=".$user_tbls->id."  ||| Total Left User=".$total_left_user."  ||| Total Right User=".$total_right_user."  ||| Common user=".$common_pair." ||| Total Recived Pair Total=".$recived_total_pair_amount." ||| Total Direct=".$total_direct."<br>";
         }
     }
  }
     
}


















