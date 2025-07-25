<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IncomeHistory;
use Auth;

class CronSuspendController extends Controller
{
   public function suspend(){
    //   dd($date);
       $data=DB::table('income_history')->where('credit_status','pending')->where('date_time', '<>', '0000-00-00 00:00:00')->where('company_role','no')->get();
            echo "credit status pending"."</br>";
       foreach($data as $d){
           $joined_userid=$d->joined_user;
           
           $usercreditdate=$d->created_at;
          
           $suspend_date=date("Y-m-d H:i:s", strtotime('+1day',strtotime($usercreditdate)));    //this suspension is base on credit status
           $date=date("Y-m-d H:i:s");
           if($suspend_date<=$date){
               $data=array(
                   'suspend_status'=>'suspend',
                   );
              DB::table('user')->where('id',$joined_userid)->where('company_role','no')->update($data);
           echo "Suspend Id is ----".$joined_userid."</br>";
           }
       }
       
       $datas=DB::table('income_history')->where('status','pending')->where('credit_date', '<>', '0000-00-00 00:00:00')->where('company_role','no')->get();
       echo "status pending"."</br>";
       foreach($datas as $d){
           $recieved_userid=$d->received_user;
           
           $userdate=$d->credit_date;
          
           $suspend_dates=date("Y-m-d H:i:s", strtotime('+1day',strtotime($userdate)));    //this suspension is base on status
           $date=date("Y-m-d H:i:s");
           if($suspend_dates<=$date){
               $data=array(
                   'suspend_status'=>'suspend',
                   );
              DB::table('user')->where('id',$recieved_userid)->where('company_role','no')->update($data);
             echo "Suspend Id is ----".$recieved_userid."</br>";
           
           }
           
       }
   }
}
