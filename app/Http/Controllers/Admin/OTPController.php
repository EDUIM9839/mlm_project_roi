<?php

namespace App\Http\Controllers\Admin;
use App\Models\reward_vip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\DemoMail;
use App\Mail\WithdrawalOtp;
use Carbon\Carbon;
use Auth;
use Exception;

class OTPController extends Controller
{
    /*
    * Send OTP : send otp to the given user
    */
    public function sendOTP($email, $otpType, $userId = null, $title = null){
        
        if(!$userId){
            $userId = Auth::user();
        }
        
        $otp = rand(100000, 999999);
       
        
        $mailData = [
            'email' => $email,
            'otp' => $otp,
            'title' => $title ?? 'Your OTP'
        ];
        
      Mail::to($email)->send(new WithdrawalOtp($mailData));
        
        DB::table('admin_otp_codes')->insert([
            'type' => $otpType,
            'email' => $email,
            'otp' => $otp,
            'is_used' => 0,
            'update_user' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
            'expired_at' => Carbon::now()->addMinutes(10)
        ]);
        
        
        
    }
    
    /*
    * Verify OTP : verify the otp
    */
    public function verifyOTP($email, $otp, $otpType, $userId=null){
        if(!$userId){
            $userId = Auth::user();
        }
      
        $otpVarifiedId = DB::table('admin_otp_codes')
                ->where('email', $email)
                ->where('update_user', $userId)
                ->where('type', $otpType)
                ->where('otp', $otp)
                ->where('is_used', 0)
                ->where('expired_at', '>=', now())
                ->orderBy('id', 'DESC')
                ->value('id');
        
        if($otpVarifiedId){
            DB::table('admin_otp_codes')->where('id', $otpVarifiedId)->update(['is_used' => true]);
        }
      
        return $otpVarifiedId;
        
    }
    
    
    public function sendUsdtChangeOTP($id){
        
        try{
            $email = env('ADMIN_EMAIL');
            $user = DB::table('user')->where('id', $id)->first();
            if(!$user){
                return response()->json([
                    'status' => 'error',
                    'message' => "User not found!"
                ]);
            }
            
            $this->sendOTP($email, 'usdt_address_update', $user->id, 'Wallet Address Update Email');
            
            return response()->json([
                    'status' => 'success',
                    'message' => 'Otp send successfully!'
            ]);
        }catch(Exception $ex){
            return response()->json([
                    'status' => 'error',
                    'message' => $ex->getMessage()
                ]);
        }
        
        
    }
    
    public function sendEnterWithdrawalRequestOTP(){
         
        try{
            $email = env('ADMIN_EMAIL');
            $user = Auth::user();
            if(!$user){
                return response()->json([
                    'status' => 'error',
                    'message' => "User not found!"
                ]);
            }
            
            $this->sendOTP($email, 'enter_withdrawal_update', $user->id, 'Enter Withdrawal Request Email');
            
            return response()->json([
                    'status' => 'success',
                    'message' => 'Otp send successfully!'
            ]);
        }catch(Exception $ex){
            return response()->json([
                    'status' => 'error',
                    'message' => $ex->getMessage()
                ]);
        }
    }
    
    public function openWithdrawalRequestPage(Request $request){
        if(empty($request->otp)){
            return redirect()->back()->with('error', 'Please Enter Valid OTP!');
        }
        
        try{
            $email = env('ADMIN_EMAIL');
            $varifiedOtpId = $this->verifyOTP($email, $request->otp, 'enter_withdrawal_update', Auth::id());
            
            
            if(!$email || !$varifiedOtpId){
                return redirect()->back()->with('error', 'Wrong OTP! Please try again!');
            }
            
            
            
            return redirect()->route('withdrawl_requests')->with([
                    'enable_withdrawal_request' => true,
                    'success' => 'Otp Verified : Stay on this page while working.'
                ]);
            
        }catch(Exception $ex){
            return redirect()->back()->with('error', $ex->getMessage());
        }
        
    }
}
