<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IncomeHistory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Auth;
use Hash;
use App\Http\Controllers\MLMController;
use  App\Coinpayments\CoinPaymentsAPI;
 
class WelcomeController extends Controller
{
      public function index()
      {
          $business_setup=DB::table('business_setup')->first();
         $packages=DB::table('package')->first();
           $crypto_type=DB::table('crypto_type')->first();
           $user_package=DB::table('user_package')->where('user_id',Auth::user()->id)->first();
          $data=compact('business_setup','packages','crypto_type','user_package');
          
          
                  if(!empty($user_package)){
                          if($user_package->status=='approved'){
                              return redirect()->route('user-dashboard');
                              
                          }
                  }
          return view('user.welcome')->with($data);
          
      }
 
     public function join_request(Request $request){
           $package=DB::table('package')->first();
         
         
         if($request->payment_type=='direct'){
                         
                         $request->validate([
                        'proof' => 'required|image|mimes:jpeg,png,jpg,gif',
                       ]);
                   
                        $desiredPath = 'paymentproofimages';
             
                    $imageName ='proof'.time() . '_' . $request->proof->getClientOriginalExtension();
            


                   
                    
                       $request->proof->move(public_path($desiredPath), $imageName);
                    $array=array(
                        'user_id'=>Auth::user()->id,
                        'status'=>'pending',
                        'payment_type'=>'direct',
                        'proof_image'=>$imageName,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'activated_by'=>Auth::user()->id, 
                        );
                    
                   DB::table('user_package')->insert($array);   
                         
             
         }else{
                     if(Auth::user()->saving_wallet>=$package->cost){
                               
                                    $array=array(
                                        'user_id'=>Auth::user()->id,
                                        'status'=>'approved',
                                        'payment_type'=>'wallet',
                                        'activated_date'=>date('Y-m-d H:i:s'),
                                        'created_at'=>date('Y-m-d H:i:s'),
                                        'activated_by'=>Auth::user()->id, 
                                        );
                              
                              
            if(DB::table('user')->leftJoin('user_package','user.id','=','user_package.user_id')->where('user.referal',Auth::user()->referal)->where('user_package.status','approved')->count()>=2){
                   
                          DB::table('user')->where('id',Auth::user()->id)->update(array('global_star_status'=>'no'));     
            }else{
                
                DB::table('user')->where('id',Auth::user()->id)->update(array('global_star_status'=>'yes'));     
            }
                              
                              
                                 DB::table('user_package')->insert($array);  
                                 
             
                                 
                                 DB::table('user')->where('id',Auth::user()->id)->decrement('saving_wallet',$package->cost);
                                 
                                 $this->calculation_income(Auth::user()->id);
                                
                     }else{
                         
                         return redirect()->back()->with('error','Insufficient Fund Wallet');
                     } 
         }
         
    return redirect()->back();
         
     } 
     public function calculation_income($user_id){ 
                   
                    $user=DB::table('user')->find($user_id); 
                    $parent_user=DB::table('user')->where('userid',$user->referal)->first(); 
        if($user->global_star_status=='yes'){
                        
                                  $array=array(
                                        'type'=>'direct',
                                        'joined_user'=>$user->id,
                                        'received_user'=>$parent_user->id,
                                        'amount'=>10,
                                        'profit'=>2.5,
                                        'date'=>date('Y-m-d'),
                                        'date_time'=>date("Y-m-d H:i:s"),
                                        'credit_debit'=>'credit',
                                        'global_star_status'=>'yes'
                                 );
                                
                                 DB::table('income_history')->insert($array);
                                  DB::table('user')->where('id',$parent_user->id)->increment('withdrawl_wallet',2.5);
                                   
                                 $income_history_direct_sum=DB::table('income_history')->where('type','direct')->where('received_user',$parent_user->id)->sum('amount');
                                 
                if($income_history_direct_sum==20){
                                
 
                   
                   $global_star_plan=DB::table("global_star_plan")->get();
                    $mlm=new MLMController;
                     $mlm->autopool_placement($parent_user);
                     $autopool_user=DB::table('autopool_user')->where('userid',$parent_user->id)->first();
                     
                     
                     $mlm->recurseUserReferaCheckForAutopool($autopool_user);
                     
                    
                     $upline=$mlm->getAutoPoolUserList();
                    
                            // $mlm->upline($user);
                            // $upline= $mlm->getUpline();
                            // echo "<pre>";
                            // print_r($mlm->getUpline());
                            // echo "</pre>";
                            
                   foreach($global_star_plan as $gsp){
                       
                      if(isset($upline[$gsp->upper_level_given_id])){
                          
                               if(!isset($previous_help_sender_id)){
                                   
                                   $previous_help_sender_id=$parent_user->id;
                                   
                               }
                                 if($gsp->id!=5){
                               
                                                     $array=array(
                                                            'type'=>'global_star',
                                                            
                                                            'joined_user'=>$user->id,
                                                            'received_user'=>$upline[$gsp->upper_level_given_id]->userid,
                                                            'help_sender_id'=>$previous_help_sender_id,
                                                            'amount'=>$gsp->helping_amount,
                                                            'profit'=>$gsp->profit_amount,
                                                            'level_no'=>$gsp->id,
                                                            'date'=>date('Y-m-d'),
                                                            'date_time'=>date("Y-m-d H:i:s"),
                                                            'credit_debit'=>'credit',
                                                            'global_star_status'=>'yes'
                                                            );
                                                    
                                                      DB::table('income_history')->insert($array);
                                                      
                                                      DB::table('user')->where('id',$upline[$gsp->upper_level_given_id]->userid)->increment('withdrawl_wallet',$gsp->profit_amount);
                                                       
                                                      //global sponser
                                                      
                                                         $this_user=DB::table('user')->find($upline[$gsp->upper_level_given_id]->userid);
                                                         $global_sponser=DB::table('user')->where('userid',$this_user->referal)->where('role','user')->first();
                                                         
                                                         if($gsp->sponser_income>0){
                                                         
                                                                 if($global_sponser){
                                                              
                                                                   $array=array(
                                                                    'type'=>'global_sponser',
                                                                    'joined_user'=>$user->id,
                                                                    'received_user'=>$global_sponser->id,
                                                                    'help_sender_id'=>$this_user->id,
                                                                    'amount'=>$gsp->sponser_income,
                                                                     'profit'=>$gsp->sponser_income,
                                                                    'level_no'=>$gsp->id,
                                                                    'date'=>date('Y-m-d'),
                                                                    'date_time'=>date("Y-m-d H:i:s"),
                                                                    'credit_debit'=>'credit',
                                                                    'global_star_status'=>'yes'
                                                                    );
                                                                    
                                                                    
                                                                    DB::table('income_history')->insert($array);
                                                                    DB::table('user')->where('id',$global_sponser->id)->increment('withdrawl_wallet',$gsp->sponser_income);
                                                                 } 
                                                                 
                                                                  
                                                      
                                                         }
                                                      
                                                      //global sponser end
                                                      
                                                       //global level
                                                       $mlm=new MLMController;
                                                    $mlm->recurseUserReferaCheckForAutopool($upline[$gsp->upper_level_given_id]);
                                                       $global_current_upline= $mlm->getAutoPoolUserList();
                                                       
                                                       for($i=0; $i<5; $i++){
                                                           
                                                           
                                                           if($gsp->level_income>0){
                                                                   if(isset($global_current_upline[$i])){
                                                                       
                                                                        $array=array(
                                                                    'type'=>'global_level',
                                                                    'joined_user'=>$user->id,
                                                                    'received_user'=>$global_current_upline[$i]->userid,
                                                                    'help_sender_id'=>$this_user->id,
                                                                    'amount'=>$gsp->level_income,
                                                                     'profit'=>$gsp->level_income,
                                                                    'level_no'=>$gsp->id,
                                                                    'date'=>date('Y-m-d'),
                                                                    'date_time'=>date("Y-m-d H:i:s"),
                                                                    'credit_debit'=>'credit',
                                                                    'global_star_status'=>'yes',
                                                                     'global_star_level'=>$i+1
                                                                    );
                                                                    
                                                                    
                                                                    DB::table('income_history')->insert($array);
                                                                    DB::table('user')->where('id',$global_current_upline[$i]->userid)->increment('withdrawl_wallet',$gsp->level_income);
                                                                       
                                                                   }
                                                           }
                                                       }
                                                       
                                   
                                 }else{
                                     
                                               
                                                  for($k=$gsp->upper_level_given_id;$k<=13; $k++){   
                                                      
                                                        if(isset($upline[$k])){
                                     
                                                            $array=array(
                                                                'type'=>'global_star',
                                                                'joined_user'=>$user->id,
                                                                'received_user'=>$upline[$k]->userid,
                                                                'help_sender_id'=>$previous_help_sender_id,
                                                                'amount'=>$gsp->helping_amount,
                                                                'profit'=>$gsp->profit_amount,
                                                                'level_no'=>$gsp->id,
                                                                'date'=>date('Y-m-d'),
                                                                'date_time'=>date("Y-m-d H:i:s"),
                                                                'credit_debit'=>'credit',
                                                                'global_star_status'=>'yes'
                                                            );
                                                            
                                                         
                                                         
                                                            
                                                          DB::table('income_history')->insert($array);
                                                          
                                                          DB::table('user')->where('id',$upline[$k]->userid)->increment('withdrawl_wallet',$gsp->profit_amount);
                                                          
                                                          
                                                          
                                                          
                                                    //global sponser
                                                      
                                                         $this_user=DB::table('user')->find($upline[$i]->userid);
                                                         $global_sponser=DB::table('user')->where('userid',$this_user->referal)->where('role','user')->first();
                                                         
                                                         if($gsp->sponser_income>0){
                                                         
                                                                 if($global_sponser){
                                                              
                                                                   $array=array(
                                                                    'type'=>'global_sponser',
                                                                    'joined_user'=>$user->id,
                                                                    'received_user'=>$global_sponser->id,
                                                                    'help_sender_id'=>$this_user->id,
                                                                    'amount'=>$gsp->sponser_income,
                                                                     'profit'=>$gsp->sponser_income,
                                                                    'level_no'=>$gsp->id,
                                                                    'date'=>date('Y-m-d'),
                                                                    'date_time'=>date("Y-m-d H:i:s"),
                                                                    'credit_debit'=>'credit',
                                                                    'global_star_status'=>'yes'
                                                                    );
                                                                    
                                                                    
                                                                    DB::table('income_history')->insert($array);
                                                                    DB::table('user')->where('id',$global_sponser->id)->increment('withdrawl_wallet',$gsp->sponser_income);
                                                                 } 
                                                                 
                                                                  
                                                      
                                                         }
                                                      
                                                    //global sponser end
                                                          
                                                           //global level
                                                       $mlm=new MLMController;
                                                    $mlm->recurseUserReferaCheckForAutopool($upline[$gsp->upper_level_given_id]);
                                                       $global_current_upline= $mlm->getAutoPoolUserList();
                                                       
                                                       for($i=0; $i<5; $i++){
                                                           
                                                           
                                                           if($gsp->level_income>0){
                                                                   if(isset($global_current_upline[$i])){
                                                                       
                                                                        $array=array(
                                                                    'type'=>'global_level',
                                                                    'joined_user'=>$user->id,
                                                                    'received_user'=>$global_current_upline[$i]->userid,
                                                                    'help_sender_id'=>$this_user->id,
                                                                    'amount'=>$gsp->level_income,
                                                                     'profit'=>$gsp->level_income,
                                                                    'level_no'=>$gsp->id,
                                                                    'date'=>date('Y-m-d'),
                                                                    'date_time'=>date("Y-m-d H:i:s"),
                                                                    'credit_debit'=>'credit',
                                                                    'global_star_status'=>'yes',
                                                                     'global_star_level'=>$i+1
                                                                    );
                                                                    
                                                                    
                                                                    DB::table('income_history')->insert($array);
                                                                    DB::table('user')->where('id',$global_current_upline[$i]->userid)->increment('withdrawl_wallet',$gsp->level_income);
                                                                       
                                                                   }
                                                           }
                                                       }
                                                       
                                                          
                                                          
                                                        }
                                                        
                                                        
                                                        
                                                        
                                                  }
                                     
                                 }
                                                       //global_level_end
                                  
                                 $previous_help_sender_id=$upline[$gsp->upper_level_given_id]->userid;
                                   
                                   
                       }
                             
                       
                       
                    }
                    
            }  //income_history_direct_sum_end
 
        }elseif($user->global_star_status=='no'){
                    //  $array=array(
                    //         'type'=>'direct',
                    //         'joined_user'=>$user->id,
                    //         'received_user'=>$parent_user->id,
                    //         'amount'=>5,
                    //          'profit'=>5,
                    //         'date'=>date('Y-m-d'),
                    //         'date_time'=>date("Y-m-d H:i:s"),
                    //         'credit_debit'=>'credit'
                    //         );
                    //  DB::table('income_history')->insert($array);
                    //       DB::table('user')->where('id',$parent_user->id)->increment('withdrawl_wallet',5);
                      //level
                                   $mlm=new MLMController;
                                $mlm->upline($user);
                                $upline= $mlm->getUpline();
                                
                                $levels=DB::table('levels')->get();
                                
                     foreach($levels as $l){
                         
                         
                         if(isset($upline[$l->id-1])){
                                     $array=array(
                                        'type'=>'level',
                                        'joined_user'=>$user->id,
                                        'received_user'=>$upline[$l->id-1]->id,
                                        'level_no'=>$l->id,
                                        'amount'=>$l->amount,
                                        'profit'=>$l->amount,
                                        'date'=>date('Y-m-d'),
                                        'date_time'=>date("Y-m-d H:i:s"),
                                        'credit_debit'=>'credit'
                                        );
                                        
                         if(DB::table('user')->join('user_package','user.id','=','user_package.user_id')->where('user.referal',$upline[$l->id-1]->userid)->where('user_package.status','approved')->count()>=$l->id){
                                    DB::table('income_history')->insert($array);
                                    DB::table('user')->where('id',$upline[$l->id-1]->id)->increment('withdrawl_wallet',$l->amount);
                            }else{   //flash
                                     $array=array(
                                            'type'=>'level_flash',
                                            'joined_user'=>$user->id,
                                            'received_user'=>1,
                                            'level_no'=>$l->id,
                                            'amount'=>$l->amount,
                                            'profit'=>$l->amount,
                                            'date'=>date('Y-m-d'),
                                            'date_time'=>date("Y-m-d H:i:s"),
                                            'credit_debit'=>'direct_not_exists'
                                            );
                                
                                     DB::table('income_history')->insert($array);
                                    
                                
                            }   //flash end
                
                
                         }else{   //flash
                             
                             
                               $array=array(
                                            'type'=>'level_flash',
                                            'joined_user'=>$user->id,
                                            'received_user'=>1,
                                            'level_no'=>$l->id,
                                            'amount'=>$l->amount,
                                            'profit'=>$l->amount,
                                            'date'=>date('Y-m-d'),
                                            'date_time'=>date("Y-m-d H:i:s"),
                                            'credit_debit'=>'level_not_exists'
                                            );
                                
                                     DB::table('income_history')->insert($array);
                             
                             
                             
                             
                             
                             
                              
                         }   //flash end
                         
                     }
                     
                     
        }
                            
                
  
         
     }
     
     
     
     public function activate_user_by_admin_page(Request $request){
         
        $all_user = DB::table('user')->join('user_package', 'user.id', '=', 'user_package.user_id')->where('user_package.status', 'approved')->select('user.*', 'user_package.status', 'user_package.created_at')->groupBy('user_package.user_id')->get();

  //dd($all_user);
                return view('admin.activate_user', compact('all_user'));

         
     }
     
      public function inactivate_user(Request $request){
         
        $all_user = DB::table('user')->join('user_package', 'user.id', '=', 'user_package.user_id')->where('user_package.status', 'pending')->select('user.*', 'user_package.status', 'user_package.created_at')->groupBy('user_package.user_id')->get();

  //dd($all_user);
                return view('admin.inactivate_user', compact('all_user'));

         
     }
     
     
     
     
      public function activate_user_by_admin(Request $request){
         $request->validate([
             'activation_id'=>'required'
             ]);
             
         $activated_by=Auth::user()->id;
         $package=DB::table('package')->first();
           
         if(DB::table('user_package')->where('user_id',$request->activation_id)->exists()){
             
             return redirect()->back()->with('error','User is already activated or requested');
             
         }else{
             
             
            if(Auth::user()->saving_wallet>=$package->cost){
             
                             $array=array(
                                'user_id'=>$request->activation_id,
                                'status'=>'approved',
                                'payment_type'=>'wallet',
                                'activated_date'=>date('Y-m-d H:i:s'),
                                'created_at'=>date('Y-m-d H:i:s'),
                                'activated_by'=>$activated_by,
                                'description'=>$request->description
                                );
                              
                                
                           $user=DB::table('user')->find($request->activation_id);   
                                                   
                    if(DB::table('user')->leftJoin('user_package','user.id','=','user_package.user_id')->where('user.referal',$user->referal)->where('user_package.status','approved')->count()>=2){
                                  DB::table('user')->where('id',$request->activation_id)->update(array('global_star_status'=>'no'));     
                    }else{
                        DB::table('user')->where('id',$request->activation_id)->update(array('global_star_status'=>'yes'));     
                    }
              
                              
                                DB::table('user_package')->insert($array); 
                                 $this->calculation_income($request->activation_id);
                              
                                
                                DB::table('user')->where('id',$activated_by)->decrement('saving_wallet',$package->cost);
                               return redirect()->back()->with('success','User Activated Successfully');
                       }else{
                             return redirect()->back()->with('error','Insufficient Fund');
                           
                           
                       }
         }           
        
         
         
     }
     
     
         public function activate_user_by_user(Request $request){
             $amount=$request->amount;
            $user_id=Auth::user()->id;
            $saving_wallet=Auth::user()->saving_wallet;
            $referal=Auth::user()->referal;
               $pairent_user=DB::table("user")->where("userid",$referal)->first();
               $app_config=DB::table("app_config")->first();
               $pairent_amount=DB::table("user_package")->where("user_id",$pairent_user->id)->where("status","approved")->sum('amount');
              $paying_amount=$amount*$app_config->joining_percentage/100;
            $request->payment_type = "activation_wallet";
            // if($amount>=100){
            // if($request->payment_type=="online"){
            //         // return redirect()->back()->with('error','online payment coming soon');
            //     $coinPayments = new CoinPaymentsAPI;
        
            //   // $currency = $request->input('currency');
            //     $currency='LTCT';
            //     // $currency='USDT.TRC20';
                
            //     $result = $coinPayments->CreateTransaction([
            //         'amount' => $amount,
            //         'currency1' => 'USD', // Replace with your base currency
            //         'currency2' => $currency,
            //         'buyer_email'=>Auth::user()->email,
            //         'ipn_url' => route('payment.ipn')
            //     ]);
            //     if ($result['error'] == 'ok') {
            //         return redirect($result['result']['checkout_url']);
                    
                        
            //         // return redirect()->back()->with('error','online payment coming soon');
            //     } else {
            //         return back()->withErrors(['error' => $result['error']]);
            //     }
                
      
                   
                   
            // }else if($request->payment_type=="wallet"){
            //   if($saving_wallet>=$amount){
            //          $insert_package=[
            //           "payment_type"=>$request->payment_type,
            //           "amount"=>$amount,
            //           "user_id"=>$user_id,
            //           "status"=>'approved',
            //          ];
            //          if($pairent_amount>0){
                                       
            //             $enevest_amount3guna=$pairent_amount*3;
            //             $current_recived_direct=DB::table("income_history")->where("received_user",$pairent_user->id)->where("credit_debit","credit")->where("type","direct")->sum('amount');
            //             $current_recived_level=DB::table("income_history")->where("received_user",$pairent_user->id)->where("credit_debit","credit")->where("type","level")->sum('amount');
            //             $current_recived_roi=DB::table("income_history")->where("received_user",$pairent_user->id)->where("credit_debit","credit")->where("type","roi")->sum('amount');
            //              $current_recived_club=DB::table("income_history")->where("received_user",$pairent_user->id)->where("credit_debit","credit")->where("type","club_income")->sum('amount');
                       
                        
            //             $current_recived_amount=$current_recived_direct+$current_recived_level+$current_recived_roi + $current_recived_club;
            //           $current_amount2=$current_recived_amount+$paying_amount;
            //           if($enevest_amount3guna > $current_recived_amount){
            //               if($enevest_amount3guna>=$current_amount2){
                     
            //                       $insert_income=[
            //                             "credit_debit"=>'credit',
            //                             "received_user"=>$pairent_user->id,
            //                             "joined_user"=>$user_id,
            //                             "laps_amount"=>0,
            //                             "amount"=>$paying_amount,
            //                             "type"=>'direct',
            //                             "invest_amount"=>$amount,
                                       
            //                           ];
            //                             //  dd($insert_income);
            //                              DB::table("income_history")->insert($insert_income);
            //                              DB::table("user")->where("id",$pairent_user->id)->increment("incentive_wallet",$paying_amount);
            //                   }else{
            //                       $paying_amount2=$enevest_amount3guna-$current_recived_amount;
            //                       $laps_amount=$paying_amount-$paying_amount2;
            //                         $insert_income=[
            //                             "credit_debit"=>'credit',
            //                             "received_user"=>$pairent_user->id,
            //                             "joined_user"=>$user_id,
            //                             "laps_amount"=>$laps_amount,
            //                             "amount"=>$paying_amount2,
            //                             "type"=>'direct',
            //                              "invest_amount"=>$amount,
                                       
            //                           ];
            //                              DB::table("income_history")->insert($insert_income);
            //                              DB::table("user")->where("id",$pairent_user->id)->increment("incentive_wallet",$paying_amount2);
            //                   }
            //   }else{
            //         $insert_income=[
            //                 "credit_debit"=>'laps',
            //                 "received_user"=>$pairent_user->id,
            //                 "joined_user"=>$user_id,
            //                 "laps_amount"=>$paying_amount,
            //                 "amount"=>0,
            //                 "type"=>'direct',
            //                  "invest_amount"=>$amount,
            //               ];
            //       DB::table("income_history")->insert($insert_income);
            //   }
            
            //          }else{
            //               $insert_income=[
            //                 "credit_debit"=>'inactive',
            //                 "received_user"=>$pairent_user->id,
            //                 "joined_user"=>$user_id,
            //                 "laps_amount"=>$paying_amount,
            //                 "amount"=>0,
            //                 "type"=>'direct',
            //                 "invest_amount"=>$amount,
                           
            //               ];
            //              DB::table("income_history")->insert($insert_income);
            //          }
            //         DB::table("user")->where("id",$user_id)->decrement("saving_wallet",$amount);
            //       DB::table("user_package")->insert($insert_package);
            //       $this->recheckLapsedDirectIncomesOfToday($user_id);  // to pay the lapsed incomes of today | by shubham on 12-11-2024
                  
            //       $request->session()->flash('success','Amount Add Successfully');
            //       return redirect()->route("activation_fund_history");
            //   }else{
            //          $request->session()->flash('error','Your Wallet Amount Insufficient');
            //          return redirect()->back();
            //   }
                
            // }else if($request->payment_type=="barcode"){
            //     $countcheck=DB::table("user_package")->where("user_id",$user_id)->where("status","pending")->count();
            //     if($countcheck<1){
            //         if($request->file('image')){
                    
               
            //     $image = $request->file('image');
            //     $image = 'PAYMENT_'.date("YmdHis"). "." .$image->getClientOriginalExtension();
            //     $path='proof_of_payment/';
            //     $request->file('image')->storeAs($path, $image);
            //      $insert_package=[
            //           "proof_image"=>$image,
            //           "payment_type"=>$request->payment_type,
            //           "amount"=>$amount,
            //           "user_id"=>$user_id,
            //          ];
            //     DB::table("user_package")->insert($insert_package);
            //       $this->recheckLapsedDirectIncomesOfToday($user_id);  // to pay the lapsed incomes of today | by shubham on 12-11-2024
                  
            //     $request->session()->flash('success','Amount Add Successfully');
            //     return redirect()->route("activation_fund_history");
            //     }else{
            //      $request->session()->flash('error','Please Upload Proof Of Image');
            //     return redirect()->back();
            //   }
            //     }else{
            //          $request->session()->flash('error','Already Pending Package Please Waite ');
            //          return redirect()->back();
            //     }
                
            // }
            // }else{
            //     $request->session()->flash('error','Minmum Amount $100');
            //     return redirect()->back();
                
            // }
            
            if($request->payment_type=="activation_wallet"){
           
                 $insert_package=[
                   "amount"=>$amount,
                   "user_id"=>$user_id,
                   "status"=>'approved',
                   "payment_type" => "activation_wallet",
                   "activated_by" => Auth::id()
                 ];
                 
                 $package = DB::table("package")->where("cost", $amount)->first();
                 if(!$package){
                      return redirect()->back()->with('error', 'Package With this amount does not exists!');
                 }
                 
                 if($amount > Auth::user()->saving_wallet){
                     return redirect()->back()->with('error', 'Insufficient Fund!');
                 }
                 
                 
                     
                if(!$this->distributeLevelIncome($package->id)){
                    return redirect()->back()->with('error', 'Something went Wrong!');
                }
                    
                  DB::table("user")->where("id", $user_id)->decrement("saving_wallet",$amount);
                   DB::table("user_package")->insert($insert_package);
                   
                   
                   
                   
                //   $this->recheckLapsedDirectIncomesOfToday($user_id);  // to pay the lapsed incomes of today | by shubham on 12-11-2024
                  
                  return redirect()->back()->with('success', 'Amount Add Successfully!');
                    // return response()->json([
                    //     "status" => 'success',
                    //     'message' => 'Amount Add Successfully'
                    // ]);
                
            }else{
                
                 return redirect()->back()->with('error', 'Payment type must be wallet!');
            //     return response()->json([
            //             "status" => 'error',
            //             'message' => 'Payment type must be wallet!'
            //   ]);
                
            }
            
          
         }
         
        
         public function activate_user_crypto(Request $request){
             
               
                $amount=$request->package_amount;
                
                $user_id=Auth::user()->id;
                $saving_wallet=Auth::user()->saving_wallet;
                $referal=Auth::user()->referal;
                $pairent_user=DB::table("user")->where("userid",$referal)->first();
                $app_config=DB::table("app_config")->first();
                $pairent_amount=DB::table("user_package")->where("user_id",$pairent_user->id)->where("status","approved")->sum('amount');
                $paying_amount=$amount*$app_config->joining_percentage/100;
            
            
            if($amount <= 0){
                return response()->json([
                        "status" => 'error',
                        'message' => 'Must be greater than zero ' .$amount
                    ]);
            }
            
        //   if ($amount % 10 !== 0) {
        //         return response()->json([
        //             'status' => 'error',
        //             'message' => 'The amount must be a multiple of 10.'
        //         ]);
        //     }

           
            if($request->payment_type=="wallet"){
              
           
                 $insert_package=[
                   "payment_type"=>$request->payment_type,
                   "amount"=>$amount,
                   "user_id"=>$user_id,
                   "status"=>'approved',
                   "transaction_wallet_address"=> $request->wallet_address,
                   "transaction_hash"=>$request->transaction_hash,
                   "payment_type" => "BEP-20",
                     "activated_by" => Auth::id()
                 ];
                 
                 $package = DB::table("package")->where("cost", $amount)->first();
                 if(!$package){
                      return response()->json([
                            "status" => 'error',
                            'message' => 'Package With this amount does not exists!'
                       ]);
                 }
                if(!$this->distributeLevelIncome($package->id)){
                    return response()->json([
                            "status" => 'error',
                            'message' => 'Something went wrong!'
                       ]);
                }
                     
                    
                //   DB::table("user")->where("id",$user_id)->decrement("saving_wallet",$amount);
                   DB::table("user_package")->insert($insert_package);
                //   $this->recheckLapsedDirectIncomesOfToday($user_id);  // to pay the lapsed incomes of today | by shubham on 12-11-2024
                  
                    return response()->json([
                        "status" => 'success',
                        'message' => 'Amount Add Successfully'
                    ]);
                
            }else{
                return response()->json([
                        "status" => 'error',
                        'message' => 'Payment type must be wallet!'
               ]);
                
            }
       
         
         }    
         
    
    public function distributeLevelIncome($packageId){
   $id=Auth::user()->id;
   $tbl_user=Auth::user();
   $package=DB::table("package")->where("id", $packageId)->first();
               
   if(!empty($tbl_user)){
       if(!empty($package)){
            $user_id=$tbl_user->id;
            $recived_roi_percent=$package->roi_percent;
            //  $insert_package=[
            //   "payment_type"=>"Cas",
            //   "amount"=>$package->cost,
            //   "user_id"=>$user_id,
            //   "status"=>'approved',
            //   "activated_by"=>$id,
            //   "recived_roi_percent" =>$recived_roi_percent,
            //  ];
            //      DB::table("user_package")->insert($insert_package);
                 $last_save_id=DB::getPdo()->lastInsertId();
            $mlm=new MLMController;
            $mlm->upline($tbl_user);
            $upline= $mlm->getUpline();
            
            if($package->level_distribution){
                foreach ($upline as $key=>$uplines){
                $total_level=DB::table("levels")->count();
                if($total_level>$key){
                $level_id=$key+1;
                $levels=DB::table("levels")->where("id",$level_id)->first();
                $check_active=DB::table('user_package')->where("user_id",$uplines->id)->where("status","approved")->where('active_status',1)->count();
                 $mlm2=new MLMController;
                 $total_direct=$mlm2->getActiveDirect($uplines);
                //  echo $total_direct." ||| $key User Id=".$uplines->userid."<br>";
                 $paying_amount=$package->cost*$levels->percent/100;
                 
                 $totalInvestment = DB::table('user_package')->where('user_id',$uplines->id)->where('active_status', 1)->sum('amount');
                 
                 if($totalInvestment < 100){
                     $insert_income=[
                               "type"=>'level',
                               "level_no"=>$level_id,
                               "amount"=>0,
                               "laps_amount"=>$paying_amount,
                               "invest_amount"=>$package->cost,
                               "joined_user"=>$user_id,
                               "received_user"=>$uplines->id,
                               "credit_debit"=>"credit",
                               "up_id"=>$last_save_id,
                               "discription"=>'investment less than $100',
                              ]; 
                      DB::table("income_history")->insert($insert_income);
                      
                      continue;
                 }
                 
                 if($check_active>0  ){
                       if($total_direct>=$levels->direct){
                             $insert_income=[
                                    "type"=>'level',
                                    "level_no"=>$level_id,
                                    "amount"=>$paying_amount,
                                    "laps_amount"=>0,
                                    "invest_amount"=>$package->cost,
                                    "joined_user"=>$user_id,
                                    "received_user"=>$uplines->id,
                                    "credit_debit"=>"credit",
                                    "up_id"=>$last_save_id,
                                    "discription"=>"Successfully",
                                     ]; 
                                DB::table("income_history")->insert($insert_income);
                                DB::table('user')->where('id',$uplines->id)->increment('withdrawl_wallet',$paying_amount);
                         }else{
                             $insert_income=[
                                       "type"=>'level',
                                       "level_no"=>$level_id,
                                       "amount"=>0,
                                       "laps_amount"=>$paying_amount,
                                       "invest_amount"=>$package->cost,
                                       "joined_user"=>$user_id,
                                       "received_user"=>$uplines->id,
                                       "credit_debit"=>"credit",
                                       "up_id"=>$last_save_id,
                                       "discription"=>"direct condition false",
                                      ]; 
                              DB::table("income_history")->insert($insert_income);
                         }
                 }else{
                    $insert_income=[
                            "type"=>'level',
                            "level_no"=>$level_id,
                            "amount"=>0,
                            "laps_amount"=>$paying_amount,
                            "invest_amount"=>$package->cost,
                            "joined_user"=>$user_id,
                            "received_user"=>$uplines->id,
                            "credit_debit"=>"credit",
                            "up_id"=>$last_save_id,
                            "discription"=>"received user inactive current time",
                        ]; 
                     DB::table("income_history")->insert($insert_income);
                 }
                }
             }
            }      
                   
            return true;
           }else{
            return false;
           }
      }else{
         return false;
      }
    }     
         
         
         
    public function recheckLapsedDirectIncomesOfToday($userid){
        
    
       
        $userPackages = DB::table('user_package')
            ->select('id', 'user_id', 'created_at')
            ->where('user_id', $userid)
            ->where('status', 'approved')
            ->orderBy('id', 'DESC')
            ->get();
     
        if($userPackages){
            $incomeHistories = DB::table('income_history')
            ->where('type', 'direct')
            ->where('credit_debit', 'laps')
            ->whereIn('received_user', $userPackages->pluck('user_id'))
            ->whereIn(DB::raw('DATE(date)'), $userPackages->pluck('created_at')->map(function ($created_at) {
                return DB::raw('DATE("' . $created_at . '")');
            }))
            ->get();
     
            foreach($incomeHistories as $lapsDirectIncome){
                
                DB::table('income_history')->where('id', $lapsDirectIncome->id)->update(['credit_debit' => 'credit', 'laps_amount' => 0, 'amount'=> $lapsDirectIncome->laps_amount]);
                DB::table('user')->where('id', $userid)->increment('withdrawl_wallet', $lapsDirectIncome->laps_amount);
                
            }
        }
        
        
    }


        public function ipn(Request $request)
            {
        
                $merchant_id = '8aabc358432c3cda73e08c331a36e2e7';
                $secret = 'finservipnsecret';
        
                    if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
                          $array=array(
                    'transaction'=>'no hmac signature sent'
                );
                DB::table('crypto_transaction')->insert($array);
                      die("No HMAC signature sent");
                      
                     
                    }
                    
                    $merchant = isset($request['merchant']) ? $request['merchant']:'';
                    if (empty($merchant)) {
                         $array=array(
                    'transaction'=>'No Merchant ID passed'
                );
                DB::table('crypto_transaction')->insert($array);
                      
                      die("No Merchant ID passed");
                       
                    }
                    
                    if ($merchant != $merchant_id) {
                        
                         $array=array(
                    'transaction'=>'Invalid Merchant ID'
                );
                DB::table('crypto_transaction')->insert($array);
                      die("Invalid Merchant ID");
                      
                     
                      
                    }
                    
                    $request_input = file_get_contents('php://input');
                    if ($request_input === FALSE || empty($request_input)) {
                        
                          $array=array(
                    'transaction'=>'Error reading POST data'
                );
                DB::table('crypto_transaction')->insert($array);
                      die("Error reading POST data");
                    }
                    
                    $hmac = hash_hmac("sha512", $request_input, $secret);
                    if ($hmac != $_SERVER['HTTP_HMAC']) {
                          $array=array(
                    'transaction'=>'HMAC signature does not match'
                );
                DB::table('crypto_transaction')->insert($array);
                      die("HMAC signature does not match");
                    }
        
                $json_response=json_encode($request->all());
                
                
                   $array=array(
                    'transaction_data'=>$json_response,
                    'transaction_id'=>$request->txn_id,
                    'status'=>$request->status
                );
                if(DB::table('crypto_transaction')->where('transaction_id',$request->txn_id)->exists()){
                    
                      DB::table('crypto_transaction')->where('transaction_id',$request->txn->id)->update($array);
                    
                }else{
             
                DB::table('crypto_transaction')->insert($array);
                }
            }
            
    
    
}




