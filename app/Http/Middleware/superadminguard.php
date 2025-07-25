<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class superadminguard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        $data=Auth::guard('super_admin')->user();
        if($data==null){
            $request->session()->flash('error', 'Please Login First');
            return redirect('super-admin');
        }else{
            
                return $next($request);
            
        }
    }

}