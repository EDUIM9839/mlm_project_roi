<?php

use App\Http\Controllers\LoginController;
 
use Illuminate\Support\Facades\Route;
 
use App\Http\Controllers\DBManagerController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Cron\MatchingIncomeCron;
use App\Http\Controllers\Cron\Rewardcron;
use App\Http\Controllers\Cron\RoiCronJob;
use App\Http\Controllers\Cron\TestingOxapay;
use App\Http\Controllers\Cron\ClubRewadCronJob;
use App\Http\Controllers\Cron\LevelRoiCronManulay;
use App\Http\Controllers\SuperAdmin\SuperAdminLoginController;
use App\Http\Controllers\Admin\AssetController;

use App\Http\Controllers\MLMController;

use Illuminate\Http\Request;
use App\Mail\RegistrationMail;

 
use App\Http\Controllers\BtreeController;

use App\Http\Controllers\User\WelcomeController;
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/ 

Route::get('testing1233212341223321', [App\Http\Controllers\Cron\Testing::class, 'testing']);

Route::group(['middleware' => 'guest'], function(){
    
    Route::get('/register', [LoginController::class, 'registration'])->name('register');
    Route::post('/captcha/refresh', [LoginController::class, 'refreshCaptcha'])
      ->name('captcha.refresh');
    
    Route::post('/register', [DBManagerController::class, 'global_insert'])->name('registeration_submit');
        
    Route::get('/', [LoginController::class, 'login'])->name('login');
    
    Route::post('/login', [LoginController::class, 'login_validates'])->name('login-validate');
    
    Route::get('/admin', [LoginController::class, 'admin_login'])->name('admin-login');
    
    Route::post('/admin', [LoginController::class, 'admin_validates'])->name('admin-validate');
    
    Route::get('/forgetpassword', [LoginController::class, 'forget_password'])->name('forget-password');
});


Route::post('/get-referer-user', [LoginController::class, 'getRefererUser'])->name("web.get-referer-user");


Route::post('api/fetch-users', [LoginController::class, 'selectuser']);
Route::post('/register/data', [DBManagerController::class, 'global_insert'])->name('save-registration');
Route::get('/resetpassword', [LoginController::class, 'reset_password'])->name('reset_password');
Route::post('/reset', [LoginController::class, 'reset_old_password'])->name('reset_old_password');
Route::post('/verify', [LoginController::class, 'verify_otp'])->name('verify_otp');
Route::post('/verification', [LoginController::class, 'verification'])->name('verification');
Route::post('/forget_password', [MailController::class, 'forget_password_mail'])->name('forget_password_mail');


Route::view('/r', 'user_login_form_by_r');
 

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/franchise', [LoginController::class, 'franchise_login'])->name('franchise-login');
Route::post('/check/franchiseid', [LoginController::class, 'franchise_userid']);
Route::post('/check/userid', [LoginController::class, 'user_userid']);

Route::post('send-wishes',[MailController::class, 'sendwishes'])->name('sendwishes');
Route::get('/super-admin', [LoginController::class, 'super_admin'])->name('super-admin');
Route::post('/super-admin-login', [SuperAdminLoginController::class, 'login_validates'])->name('superadmin-login-validate');
Route::get('/show-product-image/{image}',[App\Http\Controllers\Admin\AssetController::class,'__invoke'])->name('show_product_image');
 
 
 Route::get('send-mail-check',function(){
      $send = DB::table('email_theme')->get(); 
         //dd($send);
     
      $email="suraj2002fake@gmail.com";
            //   $mailData = [
            //     'referal'=>"RCK00REHANA",
            //     'first_name'=>'Rehana',
            //     'last_name'=>'Maam',
            //     'password'=>123456,
            //     'userid'=>'Rehana',
            //     'contact'=>1234567890,
            //     'email'=>   'rrgmail.com',
            //     'aadhar'=>123456789123456,
            //     'transaction_password' => "456465465465",
            //     'name'=>"sdfsdfsdf",
            //     "message" => "sdfsdfsdfsdfsdf"
            //      ];
                $mailData = "sdfsdf";
                $data=compact('mailData');
                
 
                 return view('emails.forget-password',compact('send'))->with($data);
        //  Mail::to($email)->send(new RegistrationMail($mailData));
     
 });
 
 
Route::post('forget_password_mail1', [MailController::class, 'forget_password_mail1'])->name('forget_password_mail1');   
 Route::get('/privacy_policy', [LoginController::class, 'privacy_policy'])->name('privacy_policy');

// cron controller
//  Route::get('/matching_cron', [MatchingIncomeCron::class, 'matching_cron'])->name('matching_cron');
  Route::get('/rewards_income', [Rewardcron::class, 'rewards_income'])->name('rewards_income');
  Route::get('/roi_cron', [RoiCronJob::class, 'roi_cron'])->name('roi_cron');
  Route::get('/level_roi_cron', [RoiCronJob::class, 'level_roi_cron'])->name('level_roi_cron');
  Route::get('/coin_payment', [RoiCronJob::class, 'coin_payment'])->name('coin_payment');
  Route::get('/club_cron', [ClubRewadCronJob::class, 'club_cron'])->name('club_cron');
  Route::get('/club_distribution', [ClubRewadCronJob::class, 'club_distribution'])->name('club_distribution');
  Route::get('/reward_cron', [ClubRewadCronJob::class, 'reward_cron'])->name('reward_cron');
  Route::get('/manualy_level_roi', [LevelRoiCronManulay::class, 'manualy_level_roi'])->name('manualy_level_roi');
  Route::get('/find_level_roi_all', [LevelRoiCronManulay::class, 'find_level_roi_all'])->name('find_level_roi_all');
Route::get('/royality_distribution', [ClubRewadCronJob::class, 'royality_distribution'])->name('royality_distribution');
Route::get('/salary_distribution', [ClubRewadCronJob::class, 'salary_distribution'])->name('salary_distribution');
 
 Route::get('/autopool_check', function(){
     
     $mlm=new MLMController();
     
     $autopool_user=DB::table('autopool_user')->find(1); 
     $mlm->count_autopool_ids($autopool_user,'autopool_user');
     
     dd($mlm->get_autopool_ids()."s");
     
 });


 Route::get('/calculation_income/{user_id}', [WelcomeController::class, 'calculation_income'])->name('calculation_income');
 
 Route::post('/payment-ipn', [WelcomeController::class, 'ipn'])->name('payment.ipn');
 
 
 Route::get('/testingoxapay123655098', [TestingOxapay::class, 'testingoxapay'])->name('testingoxapay');
 Route::get('/testingpaymentwithapi', [App\Http\Controllers\Admin\OxaPayoutController::class, 'testtingwithdrawalpaymentapi'])->name('testingpaymentwithapi');
 
 

  
