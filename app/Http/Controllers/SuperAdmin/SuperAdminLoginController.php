<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SuperAdminLoginController extends Controller
{
    

    public function login_validates(Request $request)
    {


         $request->validate([
            'userid'=>'required',
            'password'=>'required'
         ]);
        //dd($request->all());
        $credentials = $request->only('userid', 'password');
         

       //  Auth::guard('super_admin')->attemp
        if (Auth::guard('super_admin')->attempt($credentials)) {
            
            
              return redirect()->route('superadmin-dashboard');
        
              
            }else{

                $request->session()->flash('error', 'You have entered invalid credentials');

            

                return redirect()->back();
            }
        }
        
      
    }



