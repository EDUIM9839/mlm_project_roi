<?php
 namespace App\Http\Controllers\SuperAdmin;
 use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PaymentController extends Controller
{
    //
    function payment()
    {
        return view('superadmin.payment');
    }
}
