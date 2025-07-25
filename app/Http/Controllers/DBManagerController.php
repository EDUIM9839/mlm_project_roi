<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use DB;
use Mail;
use Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BtreeController;
use App\Http\Controllers\MLMController;
use Auth;
use Exception;

class DBManagerController extends Controller
{
    
  public function global_insert(Request $request)
    {
      $tbname=$request->tbname;   
       if(!$request->tbname){
           $tbname= 'user';
       }
    
     if(!empty($request->referal)){
        $request->validate([
            'referal'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'contact'=>'required|min:10|numeric',
            'email' => 'required|email',
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password',
            'term_condition'=>'required',
            'captcha_answer' => [
            'required',
            function ($attribute, $value, $fail) {
                if (!session()->has('captcha_result') || (int)$value !== (int)session('captcha_result')) {
                    $fail('Captcha answer is incorrect.');
                }
            }
        ],
        
        ]);
        
        $referalParent = DB::table('user')->where('userid', $request->referal)->first();
        if($referalParent){
            if(!DB::table('user_package')->where('user_id', $referalParent->id )->where('status', 'approved')->exists()){
                return redirect()->back()->with('error', 'Referal user is inactive!');
            }
        }else{
            return redirect()->back()->with('error', "Referal doesn't exists!");
        }
       
         if ($request->file('image'))
          {
                $profile = $request->file('image');
                $profile = 'IMG_'.time(). "." .$profile->getClientOriginalExtension();
                $path='profileupload/';
                $request->file('image')->storeAs($path, $profile);
          }else{
              $profile="";
          }
       
            $hashedpassword=Hash::make($request->password);
            $password=$hashedpassword;
            $prefix=DB::table('business_setup')->first()->id_prefix;
            $userid=$this->userId($prefix);
            $apikey=$this->apiKey($prefix);
            $data['userid']=$userid;
            $data['api_key']=$apikey;
            $data['decrypted_password']=$request->password;
            
           
            
            $transaction_password= rand(100000, 999999);
            $data=array(
                'referal'=>$request->referal,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'contact'=>$request->contact,
                'email'=>$request->email,
                'aadhar_no'=>$request->aadhar,
                'pan'=>strtoupper($request->pan),
                'country'=>$request->country,
                'image'=>$profile,
                'state'=>$request->state,
                'city'=>$request->city,
                'address'=>$request->address,
                'zip'=>$request->zip,
                'password'=>$password,
                'userid'=>$userid,
                'api_key'=>$apikey,
                'decrypted_password'=>$request->password,
                'transaction_password'=>$transaction_password
            );
       
            try{
               $email=$request->email;
                $mailData = [
                'referal'=>$request->referal,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'password'=>$request->password,
                'userid'=>$userid,
                'contact'=>$request->contact,
                'email'=>$request->email,
                'aadhar'=>$request->aadhar,
                'transaction_password'=>$transaction_password
                 ];
                 
            try{
                Mail::to($email)->send(new RegistrationMail($mailData));
            }catch(Exception $e){} 
                 
                 
            
             $check_postion=DB::table("user")->where('referal',$request->referal)->orderBy("id","DESC")->first();
            //  $parrent=DB::table("user")->where('userid',$request->referal)->first();
            
            
            
            $total_referal_count=DB::table('user')->where('referal',$request->referal)->count();
            if($total_referal_count<2){
             
            }
            
            DB::table($tbname)->insert($data);
            $last_save_id=DB::getPdo()->lastInsertId();
          
            $inserted_record =DB::table($tbname)->find($last_save_id);
            
            if(DB::table('business_setup')->first()->mlm_plan_type=='binary' and $tbname=="user"){
                
                $parent_user=DB::table($tbname)->where('userid',$data['referal'])->first();
                $parent_user_id=$parent_user->id;
                $star_parent=DB::table('star_user')->where('userid',$parent_user_id)->first();
                
                $user_package=DB::table('user_package')->first();
                $btree=new BtreeController;
                
            //    $position=$request->position;
                $btree->findPlaceNew($star_parent,$position,$inserted_record,$user_package);
            }
            $this->defaultSavePackage($last_save_id);
            if($tbname=='user'){
                
                
          $msg="Registration Successful <br> <b> Userid=$inserted_record->userid <br> <b>UserName=$inserted_record->first_name </b><br><b>Password=$request->password </b><br><b>Transaction Password=$transaction_password </b>";
          $request->session()->flash('success',$msg);
                
                
                
                return redirect()->route('userLogin');
            
            }elseif($tbname=='ptop_transefer'){
                $this->update_p2p($inserted_record);
                
                $msg="Added Successfully";
            }else{
            
                $msg="Added Successfully";
            }
            
            $request->session()->flash('success',$msg);
            
            
        } catch (\Throwable $e) {
    
            $request->session()->flash('error',$e->getMessage());
            return redirect()->back();
        }
        
         return redirect()->back();
        
     
     }else{
       
          
           if($tbname=='ptop_transefer'){
            //   dd($request->all());
              $request->validate([
                  'password'=>'required'
                  ]);
              
              
      if ($request->password==Auth::user()->transaction_password){
                $sender_id=$request->sender_id;
                $receiver_id=$request->receiver_id;
                $amount=$request->amount;
                // $deduction=$amount*10/100;
                // $transfer_amount=$amount-$deduction;
               
                $data=array(
                        
                        'total_amount'=>$amount,
                        'sender_id'=>$sender_id,
                        'receiver_id'=>$receiver_id,
                        'date'=>date('Y-m-d'),
                        'description'=>$request->description,
                        
                    );
                    
                    
                    if(Auth::user()->saving_wallet<$amount){
                         $msg="!Insufficient fund.";
                             $request->session()->flash('error',$msg);
                            return redirect()->back(); 
                    }
                    if($amount>19){
                   if($receiver_id!=null){
                              if($sender_id!=$receiver_id){
                    $increment=DB::table('user')->where('id',$receiver_id)->increment('saving_wallet',$amount);
                    $decrement=DB::table('user')->where('id',$sender_id)->decrement('saving_wallet',$amount);
                    if(!empty($increment) and !empty($decrement)){
                    $inserted=DB::table('ptop_transefer')->insert($data); 
                    $msg="Fund has been successfully transfered.";
                    $request->session()->flash('success',$msg);
                    return redirect()->back();
                    }else{
                      
                      $msg="Something went wrong.";
                      $request->session()->flash('success',$msg);
                      return redirect()->back(); 
                    }
               
                }else{
                      $msg="Cannot transfer funds to yourself.";
                      $request->session()->flash('error',$msg);
                      return redirect()->back(); 
                }
                 }else{
                   
                       $msg="Cannot transfer funds to yourself.";
                      $request->session()->flash('error',$msg);
                      return redirect()->back(); 
                   
                   
                }
            }else{
                 $msg="The minimum amount for transfer should be more than 20$.";
                      $request->session()->flash('error',$msg);
                      return redirect()->back();
            }
            
           }else{
               
                   $msg="Please Enter Correct Password.";
                  $request->session()->flash('error',$msg);
                  return redirect()->back(); 
           }
           }
     }
    
    
    }
    
    //   send otp and verify otp 
public function sendOtpEmail(Request $request)
{
    $user = Auth::user();

    if (!$user || empty($user->email)) {
        return response()->json([
            'status' => 'emailError',
            'message' => 'Your email ID does not exist in the database.'
        ], 200); 
    }

    try {
        $otp = rand(100000, 999999);
        $existing = DB::table('user_otp_verifications')
            ->where('user_id', $user->id)
            ->first();

        if ($existing) {
            DB::table('user_otp_verifications')
                ->where('user_id', $user->id)
                ->update([
                    'otp_code' => $otp,
                    'is_used' => false,
                    'expires_at' => now()->addMinutes(10),
                    'created_at' => now()
                ]);
        } else {
            DB::table('user_otp_verifications')->insert([
                'user_id' => $user->id,
                'otp_code' => $otp,
                'is_used' => false,
                'expires_at' => now()->addMinutes(10),
                'created_at' => now()
            ]);
        }
        Mail::to($user->email)->send(new \App\Mail\SendOtpMail($otp));
        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully.'
        ]);
    } catch (Exception $e) {
        \Log::error('OTP sending failed: ' . $e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong. Please try again.'
        ], 200); 
    }
}



public function verifyOtp(Request $request) {
    $otpRow = DB::table('user_otp_verifications')
        ->where('user_id', $request->user_id)
        ->where('otp_code', $request->otp)
        ->where('is_used', false)
        ->where('expires_at', '>', now())
        ->first();
    if ($otpRow) {
        DB::table('user_otp_verifications')
            ->where('id', $otpRow->id)
            ->update(['is_used' => true]);
        return response()->json(['status' => 'success']);
    } else {
        return response()->json(['status' => 'error']);
    }
}

//   send otp and verify otp for withdrawl request
public function withdrawlOtpEmail(Request $request) {
    $otp = rand(100000, 999999);
    $existing = DB::table('user_otp_verifications')
        ->where('user_id', $request->user_id)
        ->first();
    if ($existing) {
        DB::table('user_otp_verifications')
            ->where('user_id', $request->user_id)
            ->update([
                'otp_code' => $otp,
                'is_used' => false,
                'expires_at' => now()->addMinutes(10),
                'created_at' => now()
            ]);
    } else {
        DB::table('user_otp_verifications')->insert([
            'user_id' => $request->user_id,
            'otp_code' => $otp,
            'is_used' => false,
            'expires_at' => now()->addMinutes(10),
            'created_at' => now()
        ]);
    }
    Mail::to(Auth::user()->email)->send(new \App\Mail\SendOtpMail($otp));
    return response()->json(['status' => 'success']);
}


public function withdrawlVerifyOtp(Request $request) {
    $otpRow = DB::table('user_otp_verifications')
        ->where('user_id', $request->user_id)
        ->where('otp_code', $request->otp)
        ->where('is_used', false)
        ->where('expires_at', '>', now())
        ->first();
    if ($otpRow) {
        DB::table('user_otp_verifications')
            ->where('id', $otpRow->id)
            ->update(['is_used' => true]);
        return response()->json(['status' => 'success']);
    } else {
        return response()->json(['status' => 'error']);
    }
}

    public function defaultSavePackage($user_id){
        DB::table("user_package")->insert([
                  "user_id"=>$user_id,
                  "package_id"=>3,
                  "amount"=>100,
                  "recived_roi_percent"=>1,
                  "singup_time"=>"yes",
                  "active_status"=>0,
                  "description"=>'When you signup, get $100 for treading, valid for 3 dyas',
             ]);
    }

//   public function userId($prefix='ABC')
//     {
//         $rand = rand(10000, 99999);
//         $userid = str_replace(" ", "_", $prefix) . $rand;
//         return $userid;
//     }
    
    public function userId($prefix = 'ABC')
    {
        do {
            $rand = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $userid = substr(str_replace(" ", "_", $prefix), 0, 3) . $rand;
        } while (DB::table('user')->where('userid', $userid)->exists());
    
        return $userid;
    }


    public function apiKey($anystring='ABC')
    {
        $rand = rand(0, 100000);
        $rawhashword = $anystring . "" . $rand;
        $hashed = password_hash($rawhashword, PASSWORD_DEFAULT);
        return $hashed;
    }
    
    public function update_p2p($last_inserted_record){
        
        $sender_id=$last_inserted_record->sender_id;
        $receiver_id=$last_inserted_record->receiver_id;
        
        $amount=$last_inserted_record->amount;
    // dd($amount);
         DB::table('user')->where('id',$receiver_id)->increment('saving_wallet',$amount);
         DB::table('user')->where('id',$sender_id)->decrement('saving_wallet',$amount);
           
    }

}
