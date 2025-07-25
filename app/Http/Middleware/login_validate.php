<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class login_validate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data = Auth::user();
        if($data==null){
            $request->session()->flash('message', 'Please Login First');
            return redirect('/');
        }else{
             if ($data->role == 'admin') {
                return $next($request);
            }
                else {
                $request->session()->flash('message', 'You are not an admin');
                return redirect('/');
            }
        }
    }

}