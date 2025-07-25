<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IncomeHistory;
use Auth;

class TransactionController extends Controller
{
    
    public function sendTransaction($to , $amount){
        $curl = curl_init();
        
        $amount =  floor($amount);
    
        // $sender_private_key = "7a42cbf90e4857968cc9613852d91817d30f90fb49f5c19cd26ae1ec3521a54a";
        // $sender_address = "0xf7e281dbb83eb6b1d8dac67a17d31df0a0f75baf";
        
        $sender_private_key = "04a12346ff91a9277d44bc45bf2f4diuytiuytuiytuiytiuytuiy5e54342tiu";
        $sender_address = "0x5c22AC64B36987689769876897689768B494";
        
        
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
        
            if (json_last_error() === JSON_ERROR_NONE 
                && isset($decodedResponse['success']) 
                && $decodedResponse['success'] == 200) {
                    
                return $decodedResponse['txHash'];
            }
        }
        
        return null;
        
    }

    
    
 
}
