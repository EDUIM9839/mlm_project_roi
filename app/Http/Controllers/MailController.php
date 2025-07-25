<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Hash;

class MailController extends Controller
{
  
  
    public function build()
    {
        return $this->markdown('emails.password.decrypted')
                    ->with(['password' => $this->password]);
    } 
    
    
    public function sendwishes(Request $request){
        $emails = $request->input('emails');
         $name = $request->input('name');
        // dd($emails); die;
        // dd($request->all()); die;
        $mailData = [
        'emails'=>$request->emails,
        'message'=>$request->message,
        'name'=>$request->name,
        ];
        // dd($mailData); die;
        Mail::to($emails)->send(new DemoMail($mailData));
        return redirect()->route('rank_achivers');
    }
    
    public function forget_password_mail(Request $request){
        die('ddddd');
    //     echo $email = $request->input('email');die;
        
    //     $get_email = DB::table('user')->where('email',$email)->get();
        
    //     $emails = $get_email['0']->email;
        
    //   if(!empty($emails)){
    //      $mailData = [
    //   'otp'=>rand(10000,99999),
    //     ];
       
    //         DB::table('user')->where('email',$email)->update($mailData);
    //     // dd($mailData); die;
    //       Mail::to($emails)->send(new DemoMail($mailData ));
    //     return redirect()->route('verify_otp');
    //     //  return view('user.forget_password');   
    //   }else{
    //       alert("Email Not Found");
    //   }
       
    }
    
    
    
 
    
   public function forget_password_mail1(Request $request)
{ 
    $validated = $request->validate([
            'email' => 'required|email',
            'userid' => 'required|string'
        ]);
    
    $email = $validated['email']; 
    $get_email = DB::table('user')->where('email', $email)->where('userid', $validated['userid'])->first(); 
    if (is_null($get_email)) {
        return redirect()->route('forget-password')->with('error',"Invalid User Id or Email !");
    }
    $mailData = $get_email->decrypted_password; 
    
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomNumber = mt_rand(100000, 999999) . $characters[rand(0, strlen($characters) - 1)];
    $formattedNumber = str_shuffle($randomNumber);

    $haspassword=Hash::make($formattedNumber);
    $updatedUser = DB::table('user')->where('email', $email)->where('userid', $validated['userid'])->update(['password' => $haspassword,'decrypted_password'=>$formattedNumber]);
   
    $data = Mail::to($get_email->email)->send(new DemoMail($formattedNumber)); 
    
    if($data){
    return redirect()->route('forget-password')->with('success',"Password reset email sent successfully."); 
    }else{
    return redirect()->route('forget-password')->with('error',"Something went wrong while sending email!"); 
    }
} 
}
