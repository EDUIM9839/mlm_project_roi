<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IncomeHistory;
use Auth;
use Mail;
use App\Mail\send_transaction_email;

class TransitionController extends Controller
{
    
    
        public function forget_transition() {
            
    return view('user.forget_transition');
}


    public function send_transaction_password(){
          
          
    $transaction_password= rand(100000, 999999);
              $mailData = [
                'transaction_password'=>$transaction_password
                 ];
                 
                 DB::table('user')->where('id',Auth::user()->id)->update($mailData);
                 $email=Auth::user()->email;
                 
          Mail::to($email)->send(new send_transaction_email($mailData));
          
          
          return redirect()->back()->with('success','Transaction password sent successfully on your email.');
    
    
    }
}