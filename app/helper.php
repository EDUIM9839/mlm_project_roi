<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class Helper
{
    public static function get_currency(){
   $currency=DB::table('business_setup')->select('currency_symbol')->first()->currency_symbol;
        if($currency){
   return $currency;
        }else{
            return '$';
        }

    }
    
      public static function get_business_unit(){
   $unit=DB::table('business_setup')->select('business_unit')->first()->business_unit;
        if($unit){
   return $unit;
        }else{
            return 'BV';
        }

    }
    public static function no_of_record($table,$last_7='all_record')
    {
        
        $date7ago=date('Y-m-d',strtotime('-7days'));

        if($table=='user'){
                        if($last_7=='last7days'){

                
                            $response=DB::table($table)->where('role','user')->where('created_at','>=',$date7ago)->count();
                            return $response;
                            
                        }else{
                        $response=DB::table($table)->where('role','user')->count();
                        return $response;

                        }
        }else{


                    if($last_7=='last7days'){

                        
                        $response=DB::table($table)->where('created_at','>=',$date7ago)->count();
                        return $response;
                        
                    }else{
                    $response=DB::table($table)->count();
                    return $response;

                    } 
        } 
    }


        public static function active_inactive_users($status='active',$last_7='all_record'){ 
       $active_users=array();
        $inactive_users=array();
        $date7ago=date('Y-m-d',strtotime('-7days'));
            $user= DB::table('user')->where('role','user')->get();
             foreach($user as $u){ 

                        if($last_7=='last7days'){ 

                                if(DB::table('user_package')->where('status','approved')->where('user_id',$u->id)->where('created_at','>=',$date7ago)->exists()){

                                    array_push($active_users,$u);
                                }else{
                                    array_push($inactive_users,$u);

                                }

                            }else{

                                        if(DB::table('user_package')->where('status','approved')->where('user_id',$u->id)->exists()){

                                            array_push($active_users,$u);
                                        }else{
                                            array_push($inactive_users,$u);

                                        } 
                            } 

                        }

              
              
                        if($status=='active'){
                        return $active_users;
                        }else{
                        return $inactive_users;

                        } 
        }

        public static function total_collection($last_7='all_record'){
            $date7ago=date('Y-m-d',strtotime('-7days'));

            if($last_7=='last7days'){


                $total_collection=DB::table('user_package')->join('package', 'user_package.package_id', '=', 'package.id')->where('user_package.activated_date','>=',$date7ago)
                ->sum('package.cost');
                return $total_collection;
                 

            }else{
                $total_collection=DB::table('user_package')->join('package', 'user_package.package_id', '=', 'package.id')
                ->sum('package.cost');
                return $total_collection; 
             } 
        } 
        

        public static function total_distribution($last_7='all_record'){
            $date7ago=date('Y-m-d',strtotime('-7days')); 
            if($last_7=='last7days'){  
                $total_distribution=DB::table('income_history')->where('date','>=',$date7ago)
                ->sum('amount'); 
                return $total_distribution; 
            }else{

                $total_distribution=DB::table('income_history')->sum('amount'); 
                return $total_distribution;
                
             }
          
        } 


        public static function fund_request($last_7='all_record'){

            $date7ago=date('Y-m-d',strtotime('-7days'));

            if($last_7=='last7days'){


                $fund_request=DB::table('fund_request')->where('status','pending')->where('created_at','>=',$date7ago)
                ->count();

                return $fund_request;  
            }else{

                $fund_request=DB::table('fund_request')->where('status','pending')->count(); 
                return $fund_request; 
             } 
        } 

        
        public static function withdrawl_request($last_7='all_record'){

            $date7ago=date('Y-m-d',strtotime('-7days'));

            if($last_7=='last7days'){


                $withdrawl_request=DB::table('withdrawl_request')->where('status','pending')->where('created_at','>=',$date7ago)
                ->count();

                return $withdrawl_request;
                 

            }else{

                $withdrawl_request=DB::table('withdrawl_request')->where('status','pending')->count();

                return $withdrawl_request;
                
             }
          
        } 

        public static function top_earners(){

            $top_earners=DB::table('income_history as i')
                            ->join('user', 'user.id', '=', 'i.received_user')
                            ->groupBy('i.received_user')
                            ->selectRaw('i.*,sum(amount) as sum,user.first_name,user.last_name,user.userid')
                            ->where('credit_debit', 'credit')
                            ->orderBy('sum','desc')->take(10)
                            ->get();
            
            return $top_earners;

        }


        public static function recent_joiners(){
             $recent_joiners=DB::table('user')->select('id','first_name','last_name','userid','role','created_at')->where('role','user')
            ->orderBy('created_at','desc')->take(10)->get();
              return $recent_joiners;
  }


        public static function check_active_inactive($user_id,$colorful=false){

            $user_package=DB::table('user_package')->where('user_id',$user_id)->where('status','approved')->exists();
               if($user_package){
                 if($colorful=='colorful'){
                    return "<span style='color:green; font-weight:bold;' >Active<span>";
                    
                 }else{

                 
                return "Active";
                 }


               }else{
                if($colorful=='colorful'){
                    return "<span style='color:red; font-weight:bold;' >Inactive<span>";
                    
                 }else{

                 
                return "Inactive";
                 }
               }


        }

public static function formatted_date($date){

  return date("d-M-Y",strtotime($date));

}
   public static function formatted_datetime($date){

  return date("d-M-Y H:i:s",strtotime($date));

}     
        
public static function filter_record_onedate_to_anotherdate($table,$fromdate, $todate){
        
     return $product_transfer_history=DB::table($table)->whereBetween('invoice_date', [$fromdate, $todate])->get();

}

// public static function filter_record_onedate($table,$fromdate, $todate){
        
//      return $product_transfer=DB::table($table)->whereBetween('dat_time', [$fromdate, $todate])->get();

// }
}

 
