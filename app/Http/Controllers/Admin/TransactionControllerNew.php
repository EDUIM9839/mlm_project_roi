<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IncomeHistory;
use Auth;

class TransactionControllerNew extends Controller
{
    
    public function sendTransaction($to , $amount){
        $curl = curl_init();
         
        $data = array();
        $data['status'] = "error";
        $data['hash'] = '';
        
        $amount =  floor($amount);
    
        $sender_private_key = "7a42cbf90e4857968cc9613852d916546547654646754765464765464a";
        $sender_address = "0xf7e281dbb83eb6b1d8dac60987907098798070987af";
        $gas = "5000000000";
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://dlife.online/send-token-usdt',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'senderPrivateKey='. $sender_private_key .'&toAddress='. $to .'&amount='. $amount .'&senderAddress='. $sender_address .'&gasPrice='. $gas .'',
            CURLOPT_HTTPHEADER => array(
                 'auth-token: ff28233dab8ae08d0cf0e5eca1e00131494cf101f2393182c346577c7692bbe4',
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);

        if ($response !== false) {
            $decodedResponse = json_decode($response, true);
        
            if(json_last_error() === JSON_ERROR_NONE){
                if(!isset($decodedResponse['success'])){
                    DB::table('failed_transactions')->insert([
                                'user_id' => Auth::user()->id,
                                'error_json' => substr(json_encode($decodedResponse), 0, 4500)
                    ]);
                    
                }else{
                    if($decodedResponse['success'] != 200){
                        DB::table('failed_transactions')->insert([
                                'user_id' => Auth::user()->id,
                                'error_json' => substr(json_encode($decodedResponse), 0, 4500)
                            ]);
                        
                        if(isset($decodedResponse['error'])){
                             $data['status'] = "error";
                             $data['message'] = $decodedResponse['error'];
                                
                             return $data;
                        }
                        
                
                
                    }
                }
            }
        
            if (json_last_error() === JSON_ERROR_NONE 
                && isset($decodedResponse['success']) 
                && $decodedResponse['success'] == 200) {
                
                $data['status'] = "success";
                $data['hash'] = $decodedResponse['txHash'];
                    
                // return $decodedResponse['txHash'];
            }else if(isset($decodedResponse['txHash'])){
                $data['status'] = "error";
                $data['hash'] = $decodedResponse['txHash'];
            }
        }
        
        return $data;
        
    }

    
    
 
}
