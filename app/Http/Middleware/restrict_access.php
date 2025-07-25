<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class RestrictAccess   
{
  
    public function handle(Request $request, Closure $next): Response
    {
         return redirect()->away('https://megaworld.org.in');
    }

}