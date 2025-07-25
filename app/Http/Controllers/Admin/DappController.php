<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rank_achiver;
use App\Models\User;
use Mail;
use App\Models\reward_vip;
use Illuminate\Support\Facades\DB;

class DappController extends Controller
{
    
    public function index(){
        $dappSettingsDB = DB::table('dapp_settings')->whereIn('setting_key', ['sender_address', 'private_key', 'reciever_address'])->get();
       
        $dappSettings = [];

        foreach ($dappSettingsDB as $setting) {
             $dappSettings["{$setting->setting_key}"] = "{$setting->setting_value}" ;
        }
        
      
        return view('admin.dapp_settings', compact('dappSettings'));
    }
    
    public function storeWithdrawalSettings(Request $request){
            
        $validated = $request->validate([
                'sender_address' => 'required|string',
                'private_key' => 'required|string'
            ]);
        
        
        if(DB::table('dapp_settings')->where('setting_key', 'sender_address')->exists()){
            DB::table('dapp_settings')->where('setting_key', 'sender_address')->update(['setting_value' => $validated['sender_address']]);
        }else{
            DB::table('dapp_settings')->insert([
                   'setting_key' => 'sender_address',
                   'setting_value' => $validated['sender_address'],
                   'last_updated' => now()
                ]);
        }
        
        if(DB::table('dapp_settings')->where('setting_key', 'private_key')->exists()){
            DB::table('dapp_settings')->where('setting_key', 'private_key')->update(['setting_value'=> $validated['private_key']]);
        }else{
            DB::table('dapp_settings')->insert([
                'setting_key' => 'private_key',
                'setting_value' => $validated['private_key'],
                'last_updated' => now()
                ]);
        }
        
        return redirect()->back()->with('success', 'Withdrawal Settigns Updated!');
        
    }
    
    public function sendOtpEmail(Request $request){
    $user = Auth::user();
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
        Mail::to('bullfin5225@gmail.com')->send(new \App\Mail\DappOtpMail($otp));
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
    $user = Auth::user();
    $otpRow = DB::table('user_otp_verifications')
        ->where('user_id', $user->id)
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
    
    public function saveReceiverSettings(Request $request){
        
        $validated = $request->validate([
                'reciever_address' => 'required|string'
            ]);
        
        if(DB::table('dapp_settings')->where('setting_key', 'reciever_address')->exists()){
                DB::table('dapp_settings')->where('setting_key', 'reciever_address')->update(['setting_value'=> $validated['reciever_address']]);
            }else{
                DB::table('dapp_settings')->insert([
                       'setting_key' => 'reciever_address',
                       'setting_value' => $validated['reciever_address'],
                       'last_updated' => now()
                    ]);
            }
           return redirect()->back()->with('success', 'Receiver Settigns Updated!');    
        
    }
    
    
} 
