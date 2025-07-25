<?php

namespace App\Http\Controllers\SuperAdmin;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Image;
class SendMailController extends Controller
{
    public function mail()
    {
        $info = array(
            'message' => "sdhf"
        );
        Mail::send(['text' => 'mail'], $info, function ($message)
        {
            $message->to('info@mlmlaravel.swasoftech.in', 'W3SCHOOLS')
                ->subject('Hello sir ');
            $message->from('rehan@smartwebarts.com', 'Alex');
        });
        echo "Successfully sent the email";
    }
}