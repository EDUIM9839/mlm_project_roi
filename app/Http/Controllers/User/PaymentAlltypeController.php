<?php

namespace App\Http\Controllers\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BtreeController;
use App\Models\User;
use App\Http\Controllers\MLMController;
class PaymentAlltypeController extends Controller
{

function pay_direct_income(Request $request){
    
   $id=Auth::user()->id;
   $current_date=date("Y-m-d H:i:s");
    $request->validate([
                     'upi_usdt'=>'required',
                     'proof_of_image'=>'required',
                    
                ]);
    $data=DB::table("income_history")->where("type","direct")->where("joined_user",$id)->first();
    if($data->credit_status=="pending"){
           $imageName = "DI".$id.date("dmYHis").".".$request->proof_of_image->getClientOriginalExtension(); 
        
         $request->proof_of_image->move(public_path('assets/user_payment_barcode'), $imageName);
            // dd($imageName);
            $update_data=[
                "credit_status"=>"paid",
                "credit_date"=>$current_date,
                "proof_image"=>$imageName,
                ];
                DB::table('income_history')->where('id',$data->id)->update($update_data);
    }
      $total_debit_amount= DB::table("income_history")->where('joined_user',$id)->where('credit_status','paid')->sum("amount");
   if($total_debit_amount==65){
       DB::table("user")->where('id',$id)->update(['package_status'=>'active']);
   }
     return redirect()->back();
}
function pay_matching_income(Request $request){
    
   $id=Auth::user()->id;
   $current_date=date("Y-m-d H:i:s");
    $request->validate([
                     'upi_usdt'=>'required',
                     'proof_of_image'=>'required',
                    
                ]);
    $data=DB::table("income_history")->where("type","matching")->where("joined_user",$id)->first();
    if($data->credit_status=="pending"){
           $imageName = "MA".$id.date("dmYHis").".".$request->proof_of_image->getClientOriginalExtension(); 
        
         $request->proof_of_image->move(public_path('assets/user_payment_barcode'), $imageName);
            // dd($imageName);
            $update_data=[
                "credit_status"=>"paid",
                "credit_date"=>$current_date,
                "proof_image"=>$imageName,
                ];
                DB::table('income_history')->where('id',$data->id)->update($update_data);
    }

   $total_debit_amount= DB::table("income_history")->where('joined_user',$id)->where('credit_status','paid')->sum("amount");
   if($total_debit_amount==65){
       DB::table("user")->where('id',$id)->update(['package_status'=>'active']);
   }
     return redirect()->back();
}
function conform_direct_income(Request $request){
 
   $joined_user=DB::table("income_history")->find($request->id)->joined_user;
 DB::table("income_history")->where('id',$request->id)->update(['status'=>"paid",'confirm_date'=>date("Y-m-d H:i:s")]);
   $total_sum_of_joined_user=DB::table("income_history")->where('status','paid')->where('joined_user',$joined_user)->sum('amount');
   
    $user=DB::table('user')->find($joined_user);
   
    if($total_sum_of_joined_user>=65 and $user->company_role=='no'){
        

            
              DB::table('user')->where('id',$joined_user)->update(array('package_status'=>'active'));
            
              $mlm=new MLMController;
              
              $mlm->autopool_placement($user);
              
               
              $autopool_user=DB::table('autopool_user')->get();
              
              foreach($autopool_user as $au){
                  
                  
                        $mlm=new MLMController;
                       $mlm->count_autopool_ids($au,'autopool_user');
                       
                       
                       $total_this_autopool_ids=$mlm->get_autopool_ids();
                       
               
                       
                       
                       if($total_this_autopool_ids!=0){
                       
                       if($total_this_autopool_ids%3==0){
                           
                           
                           
    //after 3 company add in income history   
    
                                        $last_three_autopool=DB::table('income_history')->where('type','autopool')->orderBy('id','desc')->limit(3)->get();
                                           $company_array=array(817,818,819,820,821);
                                           $company_received_id=NULL;
                                           $current_received_company=NULL;
                                        foreach($last_three_autopool as $lta){
                                            
                                            if(in_array($lta->received_user,$company_array)){
                                                
                                                $company_received_id=$lta->received_user;
                                                break;
                                                
                                            }
                                            
                                        }
                                        
                                        if(is_null($company_received_id)){
                                          $last_autopool_company=DB::table('income_history')->where('type','autopool')->whereIn('received_user',[817,818,819,820,821])->orderBy('id','desc')->first();
                                              if($last_autopool_company){
                                                  
                                                   if($last_autopool_company->received_user==821){
                                                       
                                                        $current_received_company=817;
                                                   }else{
                                                       $current_received_company=$last_autopool_company->received_user+1;
                                                       
                                                   }
                                                  
                                              }else{
                                                  
                                                  $current_received_company=817;
                                              }
                                         
                                        }
                                        
                                        
                                        if($current_received_company){
                                            
                                                          $income_autopool=[
                                                      "type"=>"autopool",
                                                      "amount"=>6,
                                                      "joined_user"=>NULL,
                                                      "received_user"=>$current_received_company,
                                                      "credit_debit"=>"credit",
                                                      "total_pair"=>0,
                                                      "company_role"=>"yes",
                                                        "created_at"=>date('Y-m-d H:i:s')
                                     
                                                      ];
                                                 DB::table("income_history")->insert($income_autopool);
                                            
                                        }
                        
                        
    //after 3 company add in income history   
                           
                           
                           
                           
                                      $income_autopool=[
                                          "type"=>"autopool",
                                          "amount"=>6,
                                          "joined_user"=>NULL,
                                          "received_user"=>$au->userid,
                                          "credit_debit"=>"credit",
                                          "total_pair"=>0,
                                          "company_role"=>"no",
                                            "created_at"=>date('Y-m-d H:i:s')
                         
                                          ];
                                     DB::table("income_history")->insert($income_autopool);
                           
                       }
                       
                       
                    
                       
                       
                       
                    }
              }
              
              
              
              
              
              
            
      
    }
    
    return redirect()->back();
     
     
     
}


public function pay_autopool_income(Request $request){
    
    
    
                $request->validate([
                    'id'=>'required',
                     'upi_usdt'=>'required',
                     'proof_of_image'=>'required',
                    
                ]);
                
                  $imageName = "AP".date("dmYHis").".".$request->proof_of_image->getClientOriginalExtension(); 
                 $request->proof_of_image->move(public_path('assets/user_payment_barcode'), $imageName);
                $today=date("Y-m-d H:i:s");
                
                
                DB::table('income_history')->where('id',$request->id)->update(array('credit_status'=>'paid','credit_date'=>$today,"proof_image"=>$imageName));
                
                return redirect()->back()->with('status','Updated Successfully');
                
    
}






}

?>