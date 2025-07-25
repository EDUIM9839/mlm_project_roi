<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\CrudsController;
use App\Http\Controllers\SuperAdmin\crudcontroller;
use App\Http\Controllers\DBManagerController;
use App\Http\Controllers\SuperAdmin\FranchiseController;
use App\Http\Controllers\SuperAdmin\PlanController;
use App\Http\Controllers\SuperAdmin\PayoutController;
use App\Http\Controllers\SuperAdmin\PaymentController;
use App\Http\Controllers\SuperAdmin\SignupController;
use App\Http\Controllers\SuperAdmin\ProductController;
use App\Http\Controllers\SuperAdmin\GenerateInvoicController;
use App\Http\Controllers\SuperAdmin\AddToCartController;
use App\Http\Controllers\SuperAdmin\SubcategoryController;
use App\Http\Controllers\SuperAdmin\Fund_RequestController;
use App\Http\Controllers\SuperAdmin\AchiverController;
use App\Http\Controllers\SuperAdmin\LevelController;
use App\Http\Controllers\BtreeController;
use App\Http\Controllers\SuperAdmin\SuperAdminLoginController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\WelcomeLetterController;
use App\Http\Controllers\SuperAdmin\IncomeSettingController;
use App\Http\Controllers\SuperAdmin\IdCardSettingController;
use App\Http\Controllers\SuperAdmin\TreeSettingController;
use App\Http\Controllers\SuperAdmin\EmailSettingController;
use App\Http\Controllers\SuperAdmin\SendMailController;
use App\Http\Controllers\SuperAdmin\WebsiteSettingController;
use App\Http\Controllers\SuperAdmin\loginSettingController;
use App\Http\Controllers\SuperAdmin\SaveloginthemeController;
use App\Helpers\Helper;  
  
    Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('superadmin-dashboard');
    Route::get('/direct_income_setting', [IncomeSettingController::class, 'direct_income_setting_page'])->name('direct-income-setting-page');
    Route::post('/save_direct_income_setting', [IncomeSettingController::class, 'save_direct_income_setting'])->name('save_direct_income_setting');
    Route::get('/changeStatuse', [IncomeSettingController::class, 'changeStatuse'])->name('changeStatuse');

    
    Route::get('/level_income_setting', [IncomeSettingController::class, 'level_income_setting'])->name('level_income_setting');
    
    // ID card Controller
    Route::get('/idcard_setting', [IdCardSettingController::class, 'idcard_setting'])->name('idcard_setting');  
    Route::post('/idcard_setting',[IdCardSettingController::class, 'idcard_setting_save'])->name('idcard_setting_save');
 
    //  Route::get('/id',[IdCardSettingController::class, 'id'])->name('id');
    //  Route::post('/id',[IdCardSettingController::class, 'id_save'])->name('id_save');

    Route::get('/tree_seeting', [TreeSettingController::class, 'tree_setting_page'])->name('tree-setting-page');

    Route::post('/tree_setting_update', [TreeSettingController::class, 'tree_setting_update'])->name('tree-setting-update');
    
    Route::get('/business/setup', [DashboardController::class, 'business_setup'])->name('business_setup');
    Route::post('/business/setup', [DashboardController::class, 'business_setup'])->name('business_setup');
    Route::get('business_setup', [DashboardController::class, 'business_setup']);
    Route::get('/social/media',[DashboardController::class, 'social_media'])->name('social_media');
    Route::post('/social/media',[DashboardController::class, 'social_media'])->name('social_media');
    Route::get('social_media',[DashboardController::class, 'social_media' ]);
    Route::get('/payment/config',[DashboardController::class, 'payment_config'])->name('payment_config');
    Route::get('/mail/config', [DashboardController::class, 'mail_config'])->name('mail_config');
    Route::post('/mail/config',[DashboardController::class, 'mail_config'])->name('mail_config');
    Route::get('mail_config',[DashboardController::class, 'mail_config']);
    Route::post('updatemail/1',[CrudsController::class, 'updatemail'])->name('update_mail');
    Route::get('/sms/config',[DashboardController::class, 'sms_config'])->name('sms_config');
    Route::post('/sms/config',[DashboardController::class, 'sms_config'])->name('sms_config');
    Route::get('sms_config',[DashboardController::class, 'sms_config']);
    Route::get('/plan_setting',[DashboardController::class, 'plan_setting'])->name('plan_setting');
    Route::post('/plan_setting',[DashboardController::class, 'plan_setting'])->name('plan_setting');
    Route::get('plan_setting',[DashboardController::class, 'plan_setting']);
    
    Route::post('updates',[crudcontroller::class, 'updates'])->name('updates');  

    Route::post('update/1',[CrudsController::class, 'update'])->name('update_data');  
    Route::post('updatesocial/1',[CrudsController::class, 'updatesocial'])->name('update_social');
  
    Route::post('updatetwilio/1',[CrudsController::class, 'updatetwilio'])->name('update_sms_twilio');
    Route::post('updatenexmo/1',[CrudsController::class, 'updatenexmo'])->name('update_sms_nexmo');
    Route::post('updatetwofactor/1',[CrudsController::class, 'updatetwofactor'])->name('update_sms_factor');
    Route::post('updatemsg/1',[CrudsController::class, 'updatemsg'])->name('update_sms_msg');
    
      //This route for payout
    Route::get('/payout',[PayoutController::class, 'payout'])->name('payout');
    Route::post('/payout',[PayoutController::class, 'payout'])->name('payout');
    Route::get('payout',[PayoutController::class, 'payout']);
      //This route for nav payment page
    Route::get('/payment',[PaymentController::class, 'payment'])->name('payment');
    Route::post('/payment',[PaymentController::class, 'payment'])->name('payment');
    Route::get('payment',[PaymentController::class, 'payment']);
     //This route for signup page nav
    Route::get('/sign_up',[SignupController::class, 'sign_up'])->name('sign_up');
    Route::post('/sign_up',[SignupController::class, 'sign_up'])->name('sign_up');
    Route::get('sign_up',[SignupController::class, 'sign_up']);
    Route::get('/matching_commission',[PlanController::class, 'matching_commission'])->name('matching_commission');
    Route::get('/matching_bonus',[PlanController::class, 'matching_bonus'])->name('matching_bonus');
    Route::get('/rank_commission',[PlanController::class, 'rank_commission'])->name('rank_commission');
    Route::post('/rank_commission',[PlanController::class, 'rank_commission'])->name('rank_commission');
    Route::get('rank_commission',[PlanController::class, 'rank_commission']);
    Route::get('/roi_commission',[PlanController::class,'roi_commission'])->name('roi_commission');
    Route::post('/roi_commission',[PlanController::class, 'roi_commission'])->name('roi_commission');
    Route::get('/joining/percentage', [DashboardController::class, 'joining_percentage'])->name('joining_percentage');
    Route::post('/joining/percentage',[DashboardController::class, 'joining_percentage'])->name('joining_percentage');
    Route::get('joining_percentage',[DashboardController::class, 'joining_percentage']);
    Route::post('updatejoiningpercentage/1',[CrudsController::class, 'update_joining_percentage'])->name('update_joining_percentage');
    Route::get('/autopool_bonus',[PlanController::class, 'autopool_bonus'])->name('autopool_bonus');
    Route::post('/autopool_bonus',[PlanController::class, 'autopoo_bonus'])->name('autopool_bonus');
    Route::get('/repurchase_bonus',[PlanController::class, 'repurchase_bonus'])->name('repurchase_bonus');
    Route::post('/repurchase_bonus',[PlanController::class, 'repurchase_bonus'])->name('repurchase_bonus');
    Route::get('/rewards',[PlanController::class, 'rewards'])->name('rewards');
    Route::post('/rewards',[PlanController::class, 'rewards'])->name('rewards');
    Route::get('/level_roi_income',[PlanController::class, 'level_roi_income'])->name('level_roi_income');
    Route::post('/level_roi_income',[PlanController::class, 'level_roi_income'])->name('level_roi_income');
    Route::get('/cashback_bonus',[PlanController::class, 'cashback_bonus'])->name('cashback_bonus');
    Route::post('/cashback_bonus',[PlanController::class, 'cashback_bonus'])->name('cashback_bonus');
    
    // Welcome letter settings routes
    Route::get('/welcome_letter_setting',[WelcomeLetterController::class, 'welcome_letter_setting_page'])->name('welcome_letter_setting'); 
    Route::post('/welcome_letter_setting',[WelcomeLetterController::class, 'welcome_letter_save'])->name('welcome_letter_save'); 
    Route::post("/welcome_letter_setting/delete/{id}", [WelcomeLetterController::class, 'deleteWelcomeLetterTheme'])->name('welcome_letter_delete'); 
    Route::post("/welcome_letter/apply/{id}", [WelcomeLetterController::class, 'applyLetter'])->name('apply-welcome-letter'); 
    Route::post("/welcome_letter/delete/{id}", [WelcomeLetterController::class, 'deleteWelcomeLetterTheme'])->name('delete-welcome-letter'); 
    Route::post('/welcome_content/save',[WelcomeLetterController::class, 'welcome_content_save'])->name('welcome_content_save'); 
    
    // Id card settings routes
    Route::post("/idcard/save", [IdCardSettingController::class, 'saveIdCardTheme'])->name('id_card_save');
    
    
    Route::get('/welcome_content',[DashboardController::class, 'welcome_content'])->name('welcome_content'); 
    Route::get('/email_setting',[EmailSettingController::class, 'email_setting'])->name('email_setting'); 
    Route::post('/email',[EmailSettingController::class, 'email'])->name('email'); 
    Route::get('/mail',[SendMailController::class, 'mail'])->name('mail'); 
    Route::get('/website_setting',[WebsiteSettingController::class, 'website_setting'])->name('website_setting'); 
    Route::post('/website_setting/save',[WebsiteSettingController::class, 'website_setting_save'])->name('website_setting_save'); 
    Route::get('/delete_level_no',[IncomeSettingController::class, 'delete_level_no'])->name('delete_level_no'); 
    //LEVEL
    
     Route::post('/level/store',[IncomeSettingController::class, 'store_level'])->name('store_level');
     Route::get('level/delete/{id}',[IncomeSettingController::class, 'level_delete'])->name('level-delete');
     Route::get('level/update',[IncomeSettingController::class, 'updatelevel'])->name('updatelevel');
     Route::post('level/update',[IncomeSettingController::class, 'updatelevel'])->name('updatelevel');
     
    //  =========================login========================================
     
    Route::get('background_login',[loginSettingController::class,'background_login'])->name('background_login');
     
    Route::post('login_background',[loginSettingController::class,'login_background'])->name('login_background');
     
    Route::get('loginimage',[loginSettingController::class,'loginimage'])->name('loginimage');
    Route::post('upload_image',[loginSettingController::class,'upload_image'])->name('upload_image');
     
    Route::get('user_background',[loginSettingController::class,'user_background'])->name('user_background');
    Route::post('theme_login', [loginSettingController::class, 'theme_login'])->name('theme_login');
    
    Route::get('register_background',[loginSettingController::class,'register_background'])->name('register_background');
    
  // Correct
Route::post('register_logins', [loginSettingController::class, 'register_logins'])->name('register_logins');

    Route::get('forget_background',[loginSettingController::class,'forget_background'])->name('forget_background');
// Correct
    //Route::post('forgets',[loginSettingController::class,' forgets'])->name('forgets'); 
    Route::post('forgets', [loginSettingController::class, 'forgets'])->name('forgets');
    Route::get('/delete-login/{id}', [loginSettingController::class, 'delete_login'])->name('delete_login');
    Route::post('admin_Images',[loginSettingController::class,'admin_Images'])->name('admin_Images');

    
    
    
 