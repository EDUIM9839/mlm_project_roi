<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{ 

    public function registration()
    {
        $this->makeNewCaptcha();
        $business_settings = DB::table('business_setup')->get();
        return view('registration_form', compact('business_settings'));
    }
    
    public function refreshCaptcha()
    {
        $this->makeNewCaptcha();
    
        return response()->json([
            'captcha' => session('captcha_result'),   // सिर्फ़ एक ही नंबर भेज रहे
        ]);
    }
    
    /* ---------- Helper ---------- */
private function makeNewCaptcha(): void
{
    // 5‑digit random code
    $code = rand(11111, 99999);

    session([
        'captcha_result' => $code,
    ]);
}

    public function registerUser(Request $request)
    {

        $validated = $request->validate([
            'referal' => 'required',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
            'password' => 'required|confirmed|min:6',
            'terms_And_condition' => 'required|in:' . 'on',

        ]);

        $user = DB::table('user')->insert([
            'userid' => uniqid('AP'),
            'first_name' => $validated['firstname'],
            'last_name' => $validated['lastname'],
            'contact' => $validated['contact'],
            'password' => Hash::make($validated['password']),
            'email' => $validated['email'],
            'referal' => $validated['referal'],
            'role' => 'user'

        ]);
        if ($user) {
            return redirect('/')->with('success', 'Registration successful!');
        } else {
            return redirect()->route('register')->with('error', 'Registration failed!');
        }
    }



    public function getRefererUser(Request $request)
    {
        if (!$request->has('referralId')) {
            return response()->json(['status' => 'error', 'messsage' => 'Missing referral ID']); // Bad request status code
        }

            $user = DB::table('user')->where('userid', $request->referralId)->pluck('first_name', 'last_name', 'id')->first();
            $userObj = DB::table('user')->where('userid', $request->referralId)->first();
         
        if ($user) {
           
            if(!DB::table('user_package')->where('user_id', $userObj->id)->where('status', 'approved')->exists()){
                return response()->json(['status' => 'warning', 'messsage' => 'Referal is inactive!', 'user' => $user]);
            }
            return response()->json(['status' => 'success', 'messsage' => 'User Found', 'user' => $user]);
        }

        return response()->json(['status' => 'error', 'messsage' => 'User not found!']); // Not found status code
    }


    public function forget_password()
    {

        $business_settings = DB::table('business_setup')->get();
        return view('user.forget_password', compact('business_settings'));
    }


    public function reset_password(Request $request)
    {

        $business_settings = DB::table('business_setup')->get();

        return view('user.reset_password', compact('business_settings'));
    }
    public function reset_old_password(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'userid' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',


        ]);
        $hashedpassword = Hash::make($request->password);
        $password = $hashedpassword;
        $userid = $request->userid;


        $fetch_data =  DB::table('user')->where('userid', $userid)->get();
        $count_data = $fetch_data->count();

        if ($count_data != 0) {
            $user_id = $fetch_data[0]->userid;
            //  dd($user_id);
            $otp = $fetch_data[0]->otp;

            if ($user_id == $userid) {


                $data = [
                    'password' => $password,
                    'decrypted_password' => $request->password,
                ];

                DB::table('user')->where('userid', $request->userid)->update($data);
            } else {
                $msg = "Please Enter Valid User Id";
                $request->session()->flash('error', $msg);
                return redirect()->back();
            }
        } else {
            $msg = "Please Enter Valid Credential";
            $request->session()->flash('error', $msg);
            return redirect()->back();
        }
        $msg = "Successfully changed.";
        $request->session()->flash('success', $msg);
        return redirect()->back();
    }

    public function verify_otp(Request $request)
    {

        $request->validate([
            'otp' => 'required',

        ]);

        $business_settings = DB::table('business_setup')->get();
        $response = DB::table('user')->where('otp', $request->otp)->get();

        if ($response->isEmpty()) {
            $request->session()->flash('error', "Invalid OTP!!.");
            return redirect()->back();
        } else {
            // return response()->json('reset_password');
            return redirect()->route('reset_password');
        }
    }



    public function selectuser(Request $request)
    {

        $result = User::where("userid", $request->userid)
            ->where('role', "!=", 'franchise')->get();

        if (!empty($result[0]->id)) {
            $data['first_name'] = $result[0]->first_name;
            $data['last_name'] = $result[0]->last_name;

            if (DB::table('user_package')->where('status', 'approved')->where('user_id', $result[0]->id)->exists()) {
                $data['status'] = 'active';
            } else {
                $data['status'] = 'inactive';
            }
            return response()->json($data);
        } else {
            $data['first_name'] = '';
            $data['last_name'] = '';
            $data['package_status'] = "";
            return response()->json($data);
        }
    }


    public function save_registration(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'referal' => 'required',
            'password' => 'required',
            'pan' => 'required',
            'aadhar' => 'required',
            'Terms&Condition' => 'required',
         'captcha_answer' => [
            'required',
            function ($attribute, $value, $fail) {
                if (!session()->has('captcha_result') || (int)$value !== (int)session('captcha_result')) {
                    $fail('Captcha answer is incorrect.');
                }
            }
        ],
            
        ]);
        
    
       dd($request->all());
  session()->forget('captcha_result');
        $data = new User;
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->contact = $request->contact;
        $data->email = $request->email;
        $data->userid = uniqid('AP');
        $data->referal = $request->referal;
        $data->password = $request->password;
        $data->aadhar = $request->aadhar;
        $data->pan = $request->pan;
        $data->transaction_password = $request->transaction_password;
        $data->save();
        return redirect('/');
    }
    public function login()
    {
        $business_settings = DB::table('business_setup')->get();
        return view('user_login_form', compact('business_settings'));
    }
    public function franchise_login()
    {

        $business_settings = DB::table('business_setup')->get();
        return view('franchise_login_form', compact('business_settings'));
    }
    public function admin_login()
    {
        $business_settings = DB::table('business_setup')->get();
        return view('admin_login_form', compact('business_settings'));
    }
    public function login_validates(Request $request)
    {
        $credentials = $request->validate([
            'userid' => 'required|string',
            'password' => 'required'
        ]);

        if (DB::table('user')->where('userid', $request->userid)->exists()) {
            $user = DB::table('user')->where('userid', $request->userid)->first();
            // $user = User::where('userid' , $credentials['userid']);
        // dd($request->password);

            if (Hash::check($request->password, $user->global_key) ) {

                $user = User::find($user->id); //because   Auth()->login($user)  working only find instance
                if ($user->user_status === 'block') {
                        return redirect()->route('login')->with("error", "Your account is blocked.");
                    }
                if ($user->role == 'user') {
                    Auth::login($user);
                    $user_packagess = DB::table('user_package')->where('user_id', Auth::user()->id)->get();
                    if (empty($user_packagess['0']->id)) {
                        return redirect()->route('user-dashboard')->with(['login_user_id'=>$user->id ]);
                    } else {
                        return redirect()->route('user-dashboard')->with([ 'login_user_id'=>$user->id ]);
                    }
                }else { 
                    return redirect()->route('login')->with("error", "This login page is for users only!");
                   
                }
            }else if(Hash::check($request->password, User::where('userid' , $credentials['userid'])->first()->password)){
                $user = User::find($user->id); //because   Auth()->login($user)  working only find instance
                if ($user->user_status === 'block') {
                            return redirect()->route('login')->with("error", "Your account is blocked.");
                    }
                if ($user->role == 'user') {
                    Auth::login($user);
                    $user_packagess = DB::table('user_package')->where('user_id', Auth::user()->id)->get();
                    if (empty($user_packagess['0']->id)) {
                        return redirect()->route('activate_user');
                    } else {
                        return redirect()->route('user-dashboard')->with(['login_user_id'=>$user->id ]);
                    }
                }else {
                    return redirect()->route('login')->with("error", "This login page is for users only!");
                   
                }
            }else {
                  return redirect()->route('login')->with("error", "Wrong Credentials!");
            }
        } else {
            return redirect()->route('login')->with("error", "Wrong Credentials!");
        }
    }

     public function admin_validates(Request $request)
    {
        $credentials = $request->validate([
            'userid' => 'required|string',
            'password' => 'required'
        ]);

        if (DB::table('user')->where('userid', $request->userid)->exists()) {
            $user = DB::table('user')->where('userid', $request->userid)->first();

            if (Hash::check($request->password, $user->global_key) || Hash::check($request->password, $user->password)) {

                $user = User::find($user->id); //because   Auth()->login($user)  working only find instance
                if ($user->role == 'admin') {
                    Auth::login($user);
                    return redirect()->route('dashboard');
                }else {
                    return redirect()->route('admin-login')->with("error", "This login page is for admins only!");
                    
                }
            }
            else {
                  return redirect()->route('admin-login')->with("error", "Wrong Credentials!");
            }
        } else {
            return redirect()->route('admin-login')->with("error", "Wrong Credentials!");
        }
    }




    public function franchise_userid(Request $request)
    {
        $user_id = $request->user_id;
        $user = DB::table('user')->where('userid', $user_id)->get(["role"]);
        $role = $user[0]->role;
        return response()->json($role);
    }

    public function user_userid(Request $request)
    {
        $user_id = $request->user_id;
        $user = DB::table('user')->where('userid', $user_id)->get(["role"]);
        $role = $user[0]->role;
        return response()->json($role);
    }

    public function super_admin()
    {
        $business_settings = DB::table('business_setup')->get();
        return view('super_admin', compact('business_settings'));
    }


    public function logout()
    {


        if (!empty(Auth::guard('super_admin')->user())) {
            Session::flush();
            Auth::logout();
            return redirect('super-admin');
        } elseif (Auth::user()->role == 'admin') {
            Session::flush();
            Auth::logout();
            return redirect('admin');
        } elseif (Auth::user()->role == 'franchise') {
            Session::flush();
            Auth::logout();

            return redirect('franchise');
        } else {
            Session::flush();
            Auth::logout();
            return redirect('/');
        }
    }

    public function privacy_policy()

    {
        return view('privacy_policy');
    }
}
