<?php

namespace App\Http\Controllers\User;
use Auth ;
Use DB ;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class MessageController extends Controller
{
   public function Messages()
   {
       $user=Auth::user()->userid;
       $allMsg=DB::table('messages')->where('userid',Auth::user()->id)->get();
       return view('user.message.message',compact('allMsg'));
   }
  
}

