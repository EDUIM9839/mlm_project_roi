<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        date_default_timezone_set("Asia/Kolkata");
        Gate::define('isActive',function (User $user){
            
             $user_package=DB::table('user_package')->where('user_id',$user->id)->where('status','approved')->get();
                 if(count($user_package)){
                     return true;
                 }else{
                     return false;
                 }
            
            
        });
        
        
    }
}
