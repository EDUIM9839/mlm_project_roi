<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\CustomerLogic;
use App\Models\User;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Mail\EmailVerification;
use App\Models\BusinessSetting;
use App\CentralLogics\SMS_module;
use App\Models\EmailVerifications;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userid' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $data = [
           

            'userid' => $request->userid,
            'password' => $request->password
        ];
        $customer_verification = user::where('key', 'userid')->first()->value;
        if (auth()->attempt($data)) {
             return response()->json(['message' => translate('messages.Authorized')], 200);
            }
    }
}
