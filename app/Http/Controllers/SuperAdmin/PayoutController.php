<?php
 namespace App\Http\Controllers\SuperAdmin;
 use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class PayoutController extends Controller
{
    //
    function payout()
    {
        return view('superadmin.payout');
    }
}