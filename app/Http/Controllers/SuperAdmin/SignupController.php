<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SignupController extends Controller
{
    //
    function sign_up()
    {
        return view('admin.signup');
    }
}
