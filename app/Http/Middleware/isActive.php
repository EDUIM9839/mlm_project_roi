<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Illuminate\Support\Facades\Gate;
class Isactive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          if (Gate::denies('isActive')) {
              
               abort(403,"!Sorry you are not active user please activate your ID");
           // return response('Access Denied: You are not authorized to view this page.', 403);
        }

        return $next($request);
    }

}