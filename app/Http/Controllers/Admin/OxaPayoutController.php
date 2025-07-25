<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IncomeHistory;
use Auth;

class OxaPayoutController extends Controller
{
    public function sendTransaction($to , $amount){
        
        // dd("Stop for testing");
        
        $curl = curl_init();
        $amount =  floor($amount);
        // dd($amount,$to);
        $url = 'https://api.oxapay.com/api/send';
            $data = array(
              'key' => 'YTZMXN-MS389X-A3CFX5-CYG70M',
              'address' => $to,
              'amount' => $amount,
              'currency' => 'USDT',
              'network' => 'BNB',
              'callbackUrl' => 'https://panel.bullfin.io/callback'
            );
            $options = array(
                'http' => array(
                    'header' => 'Content-Type: application/json',
                    'method'  => 'POST',
                    'content' => json_encode($data),
                ),
            );
            $context  = stream_context_create($options);
            $response = file_get_contents($url, false, $context);
            
            // dd($context,$response);
            
        if ($response !== false) {
            $decodedResponse = json_decode($response, true);
            if (json_last_error() === JSON_ERROR_NONE 
                && isset($decodedResponse['result']) 
                && $decodedResponse['result'] == 100) {
                return $decodedResponse['trackId'];
            }
        }
        return null;
    }
 
 
 
 
    public function testtingwithdrawalpaymentapi(){
        
        // dd(34567);
        
        // $hash = $this->sendTransaction('0x0b5EF1A48A5D36aAE549E5fe66E347E1D2C24D5f', 1);
        
        dd($hash);
    }
}
