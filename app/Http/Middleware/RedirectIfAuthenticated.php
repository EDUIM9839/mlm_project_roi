<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use DB;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                 if (Auth::user()->role == 'admin') {
                        return redirect()->route('dashboard');
                    } elseif (Auth::user()->role == 'franchise') {
                        return redirect()->route('franchise-dashboard');
                    } else {
                        $check_id = DB::table('user')->where('userid', Auth::user()->userid)->first();

                        $username = $check_id->first_name;

                        $user_packagess = DB::table('user_package')->where('user_id', Auth::user()->id)->where('status', 'approved')->get();
                        if (empty($user_packagess['0']->id)) {
                            return redirect()->route('user-dashboard');
                        } else {
                            return redirect()->route('user-dashboard');
                        }
                    }
            }
        }

        return $next($request);
    }
}
