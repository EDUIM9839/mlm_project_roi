<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;
 
use App\Http\Controllers\MLMController;
 
 use Illuminate\Support\Facades\Http;

class CheckPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check_payment:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Payment Cron';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        echo "current Date=".date("Y-m-d H:i:s");
        
        // die('died');
        
        
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
