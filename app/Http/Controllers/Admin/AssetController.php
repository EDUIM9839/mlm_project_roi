<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
 
use App\Http\Controllers\Controller;
 
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;


class AssetController extends Controller
{
    
  
    
    public function __invoke($image){
        
       
        abort_if(auth()->guest(),Response::HTTP_FORBIDDEN);
        return response()->file(
            Storage::path('public/'.$image)
            );
        
        
        
    }

}
