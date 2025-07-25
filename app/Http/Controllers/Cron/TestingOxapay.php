<?php

namespace App\Http\Controllers\Cron;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BtreeController;
use App\Http\Controllers\MLMController;
use App\Models\User;
use Carbon\Carbon;
 use Illuminate\Support\Facades\Http;
 
class TestingOxapay extends Controller
{
    public function testingoxapay(){
        $processing_request = DB::table('withdrawl_request')->where('status','processing')->get();
       
        foreach($processing_request as $pr){

                $response = Http::post('https://api.oxapay.com/api/inquiry', [
                    'key'     => 'YTZMXN-MS389X-A3CFX5-CYG70M',
                    'trackId' => "$pr->track_id",
                ]);
                if ($response->successful()) {
                    $data = $response->json();
                    
                    if($data['status']=='confirmed'){
                        $hash = $data['txID'] ?? '';
                        DB::table('withdrawl_request')->where('id', $pr->id)->update(['status'=>'Approved','transaction_hash'=>$hash]);
                    }elseif($data['status']=='processing'){
                         echo "Still Processing : " . $pr->track_id . " ||| User id=".$pr->user_id." <br> ";
                    }else{
                         $hash = $data['txID'] ?? '';
                        DB::table('withdrawl_request')->where('id', $pr->id)->update(['status'=>'failed','transaction_hash'=>$hash]);
                    }
                    
                } else {
                   echo "failed trackId : " . $pr->track_id . " ||| User id=".$pr->user_id." <br> ";
                   
                }
            
        }
    }
}





 
