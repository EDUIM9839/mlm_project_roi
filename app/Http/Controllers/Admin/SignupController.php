<?php
 namespace App\Http\Controllers\SuperAdmin;
 use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class SignupController extends Controller
{
    //
    function sign_up()
    {
        return view('superadmin.signup');
    }
}
