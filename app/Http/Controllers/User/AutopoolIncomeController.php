<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IncomeHistory;
use Auth;

class AutopoolIncomeController extends Controller
{
    public function autopool_income_list(Request $request){


       $autopool_income= DB::table('income_history')->join('user', 'income_history.joined_user','=','user.id')->select('income_history.*','user.userid','user.first_name','user.last_name')->where('income_history.type','=','autopool')->where('income_history.received_user','=',Auth::user()->id)->orderBy('id','desc')->get();
       
        $data=compact('autopool_income');
        
        return view("user.income_history_autopool")->with($data);
    }
    
 
}
