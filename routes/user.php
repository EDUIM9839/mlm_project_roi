<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\LotteryController;
use App\Http\Controllers\User\PaymentAlltypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudsController;
use App\Http\Controllers\DBManagerController;
use App\Http\Controllers\User\DirectIncomeController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UserAddToCartController;  
use App\Http\Controllers\User\TreeController; 
use App\Http\Controllers\User\BinaryTreeController;
use App\Http\Controllers\User\AutopoolIncomeController;
use App\Http\Controllers\User\MatchingIncomeController;
use App\Http\Controllers\User\CronSuspendController;
use App\Http\Controllers\User\WelcomeController; 
use App\Http\Controllers\User\MessageController; 
use App\Http\Controllers\User\TransitionController; 
use App\Http\Controllers\User\PowerWeakerController; 
        

    Route::get('testing4215', [DashboardController::class, 'testing1']);
    

    Route::get('login/{id}', [DashboardController::class, 'admins_login'])->name('admins-login');  
    Route::get('/add_fund',[DashboardController::class, 'add_fund'])->name('add_fund');
    Route::post('/add_fund',[DashboardController::class, 'addfund'])->name('addfund');
    // Route::middleware(['auth', 'isActive'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user-dashboard');
    // Route::get('/dashboard_test', [DashboardController::class, 'index_test'])->name('user-dashboard_test');
    // route for new dashboard
    Route::get('/user_dashboard', [DashboardController::class, 'new_dashboard'])->name('user_dashboard');
     
    Route::get('/team', [DashboardController::class, 'total_team'])->name('total_team');
    Route::get('/direct-user', [DashboardController::class, 'direct_user'])->name('direct-user');
    Route::get('/trading-bonus-income-list', [DirectIncomeController::class, 'direct_income_list'])->name('direct-income-list');
    Route::get('/roi_income', [DirectIncomeController::class, 'global_star_income'])->name('global_star_income');
    Route::get('/club_income', [DirectIncomeController::class, 'help_send'])->name('help_send');
    Route::get('/royality_income', [DirectIncomeController::class, 'royality_income'])->name('royality_income');
    Route::get('/company_turn_over/income', [DirectIncomeController::class, 'company_turn_over_income'])->name('company_turn_over_income');
    Route::get('/profile',[ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile',[ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile_update', [ProfileController::class, 'profile_update'])->name('profile_update');
    Route::post('/profile_update', [ProfileController::class, 'profile_update'])->name('profile_update');
    Route::get('/id-card',[DashboardController::class, 'id_card'])->name('id-card');
    Route::get('/welcome_letter',[DashboardController::class, 'welcome_letter'])->name('welcome_letter');
    Route::get('/update_payment_details',[DashboardController::class, 'update_payment_details'])->name('update_payment_details');
    Route::post('/update_payment',[DashboardController::class, 'update_payment'])->name('update_payment');
    
    Route::get('/salary_income', [DirectIncomeController::class, 'salary_income'])->name('salary_income');
    // ===================Credit==========================
    
    Route::get('/level_income',[DirectIncomeController::class, 'level_income'])->name('level_income');
    Route::get('/credit_matching_income',[DirectIncomeController::class, 'credit_matching_income'])->name('credit_matching_income');
    Route::get('/credit_autopool_income',[DirectIncomeController::class, 'credit_autopool_income'])->name('credit_autopool_income');
    
    // =====================Debit===========================
    
    Route::get('/debit_direct_income',[DirectIncomeController::class, 'debit_direct_income'])->name('debit_direct_income');
    Route::get('/debit_matching_income',[DirectIncomeController::class, 'debit_matching_income'])->name('debit_matching_income');
    Route::get('/debit_autopool_income',[DirectIncomeController::class, 'debit_autopool_income'])->name('debit_autopool_income');
    
    // ==================================
    Route::get('/downline',[DashboardController::class, 'downline'])->name('downline');
    Route::get('/activate_user',[DashboardController::class, 'activate_user'])->name('activate_user');
    Route::get('/active_users',[DashboardController::class, 'active_users'])->name('active_users');
    Route::get('/activation_fund_history',[DashboardController::class, 'activation_fund_history'])->name('activation_fund_history');
    Route::get('/profile_card',[DashboardController::class, 'profile_card'])->name('profile_card');
   
    Route::post('/pay_fundded_amount_by_user',[DashboardController::class, 'pay_fundded_amount_by_user'])->name('pay_fundded_amount_by_user');
    Route::post('/bfi_amount_by_user',[DashboardController::class, 'bfi_amount_by_user'])->name('bfi_amount_by_user');
    
    Route::get('/ptop_transefer',[DashboardController::class, 'ptop_transefer'])->name('ptop_transefer');
    Route::get('/transfer_history',[DashboardController::class, 'transfer_history'])->name('transfer_history');
    Route::get('/withdrawl_to_fund_history',[DashboardController::class, 'withdrawl_to_fund_history'])->name('withdrawl_to_fund_history');
    Route::get('/withdrawl_to_fund',[DashboardController::class, 'withdrawl_to_fund'])->name('withdrawl_to_fund');
    Route::get('/order_history',[DashboardController::class, 'order_history'])->name('order_history');
    Route::get('/r_order_history',[DashboardController::class, 'r_order_history'])->name('r_order_history');
    Route::post('/r_orders', [DashboardController::class, 'r_orders'])->name('r_orders');
    Route::get('/generateInvoice/id', [DashboardController::class, 'generateInvoice'])->name('generateInvoice');
    Route::get('/mywallet',[DashboardController::class, 'mywallet'])->name('mywallet');
    Route::get('/wallet_details',[DashboardController::class, 'wallet_details'])->name('wallet_details');
    Route::get('/payout_summary',[DashboardController::class, 'payout_summary'])->name('payout_summary');
    Route::get('/support',[DashboardController::class, 'support'])->name('support');
    Route::post('/ptop_user', [DashboardController::class, 'ptop_user'])->name('ptop_user');
     // pto p trancefare route
    Route::post('/PtoP', [DBManagerController::class, 'global_insert'])->name('ptop_trancefer_user');
    Route::get('/ptop_receive_transfer',[DashboardController::class, 'ptop_receive_transfer'])->name('ptop_receive_transfer');
    Route::post('/send-otp', [DBManagerController::class, 'sendOtpEmail'])->name('send_otp_email');
    Route::post('/verify-otp', [DBManagerController::class, 'verifyOtp'])->name('verify_otp');
     // ptop check sender amount  
    Route::post('/check_amount_transfer', [DashboardController::class, 'check_amount_transfer'])->name('check_amount_transfer');
     Route::post('/check_amount_aadfund', [DashboardController::class, 'check_amount_aadfund'])->name('check_amount_aadfund');
      Route::get('/withdrawl_history',[DashboardController::class, 'withdrawl_history'])->name('withdrawl_history');
    Route::post('/withdrawl_to_fund1', [DashboardController::class, 'add_withdrawal_to_fund'])->name('add_withdrawal_to_fund');
    Route::get('/withdrawl_income',[DashboardController::class, 'withdrawl_income'])->name('withdrawl_income');
    Route::post('/withdrawl_income1', [DashboardController::class, 'withdrawl_income1'])->name('withdrawl_income1');
    Route::post('/withdrawl-send-otp', [DBManagerController::class, 'withdrawlOtpEmail'])->name('withdrawl_otp_email');
    Route::post('/withdrawl-verify-otp', [DBManagerController::class, 'withdrawlVerifyOtp'])->name('withdrawl_verify_otp');
    Route::get('/withdrawl_request_history',[DashboardController::class, 'withdrawl_request_history'])->name('withdrawl_request_history'); 
    //add fund
    Route::get('/fund_history',[DashboardController::class, 'fund_history'])->name('fund_history');
    Route::get('/crypto_data',[DashboardController::class, 'crypto_data'])->name('crypto_data');
    Route::get('/welcome/product',[DashboardController::class, 'welcomepages'])->name('welcomes');
    Route::post('/purchage_package_bywallet',[DashboardController::class, 'purchage_package_bywallet'])->name('purchage_package_bywallet');
    Route::post('/purchage_package_byupi',[DashboardController::class, 'purchage_package_byupi'])->name('purchage_package_byupi');
    Route::get('/payment',[DashboardController::class, 'payment'])->name('payment');
    Route::get('/test',[DashboardController::class, 'test'])->name('test');
    Route::get('/FindAllReferalUserUnderAuser',[DashboardController::class, 'FindAllReferalUserUnderAuser'])->name('FindAllReferalUserUnderAuser');
    Route::get('/total_direct', [DashboardController::class, 'total_direct'])->name('total_direct');
    
    //product
    Route::get('/welcome',[ProductController::class, 'welcomepage'])->name('welcome');
    Route::get('/first_user_cart',[UserAddToCartController::class, 'first_user_cart'])->name('first_user_cart');
   
    Route::get('/products',[ProductController::class, 'products'])->name('products');
    Route::get('/product_details/{id}',[ProductController::class, 'product_details'])->name('product_details');
    Route::get('/Product/detail/{id}',[ProductController::class, 'first_product_details'])->name('first_product_details');
    Route::get('/cart',[UserAddToCartController::class, 'cart'])->name('cart');
    Route::post('/add_to_cart_product',[UserAddToCartController::class, 'add_to_cart_product'])->name('add_to_cart_product');
    // Route::get('/GenerateInvoice/id', [ProductController::class, 'GeneratesInvoice'])->name('GeneratesInvoice');
    
    //route for viewing mesage
      Route::get('message',[MessageController::class, 'Messages'])->name('message');
      
    
    //add to cart
    Route::post('save/userid/productid',[UserAddToCartController::class, 'add_cart'])->name('userid_productid');
    Route::get('user/cart',[UserAddToCartController::class, 'user_cart'])->name('user_cart');
    Route::post('remove/cart',[UserAddToCartController::class, 'remove_cart'])->name('remove_cart');
    Route::post('update/cart',[UserAddToCartController::class, 'update_cart'])->name('update_cart');
    Route::post('update/cart/minus',[UserAddToCartController::class, 'update_cart_minus'])->name('update_cart_minus');
    Route::get('product/summery',[UserAddToCartController::class, 'product_summery'])->name('product_summery');
    Route::get('product/buy/now/{id}',[UserAddToCartController::class, 'buy_now'])->name('buy_now');
    
    //payment 
    Route::post('pay/wallet',[UserAddToCartController::class, 'pay_from_wallet'])->name('pay_from_wallet');
    Route::post('pay_first/wallet',[UserAddToCartController::class, 'pay_first_from_wallet'])->name('pay_first_from_wallet');
    Route::post('buy/now/from/wallet',[UserAddToCartController::class, 'buy_now_from_wallet'])->name('buy_now_from_wallet');
    //forget password
    Route::post('forget_password_mail',[MailController::class, 'forget_password_mail'])->name('forget_password_mail');
    
    Route::get('/sponser-tree', [TreeController::class, 'sponser_tree'])->name('sponser-tree');
    
    Route::get('/binary-tree', [BinaryTreeController::class, 'binary_tree'])->name('binary-tree');
//Direct Income Generation
Route::get('/direct-income', [DirectIncomeController::class, 'direct_income_generation'])->name('direct_income_generation');
Route::get('/global_sponser_income', [DirectIncomeController::class, 'global_sponser_income'])->name('global_sponser_income');
Route::get('/global_level_income', [DirectIncomeController::class, 'global_level_income'])->name('global_level_income');

//  get get_user_usdt_upi
Route::post('/get_user_usdt_upi', [DashboardController::class, 'get_user_usdt_upi'])->name('get_user_usdt_upi');
Route::post('/pay_direct_income', [PaymentAlltypeController::class, 'pay_direct_income'])->name('pay_direct_income');
Route::post('/pay_matching_income', [PaymentAlltypeController::class, 'pay_matching_income'])->name('pay_matching_income');

Route::post('/pay_autopool_income', [PaymentAlltypeController::class, 'pay_autopool_income'])->name('pay_autopool_income');
Route::post('/conform_direct_income', [PaymentAlltypeController::class, 'conform_direct_income'])->name('conform_direct_income');
Route::get('/autopool_income_list', [AutopoolIncomeController::class, 'autopool_income_list'])->name('autopool_income_list');    
Route::get('/matching_income_list', [MatchingIncomeController::class, 'matching_income_list'])->name('matching_income_list');  
Route::get('/suspend',[CronSuspendController::class, 'suspend'])->name('suspend');
Route::get('suspend/form',[DashboardController::class, 'suspend_form'])->name('suspend_form');




// });

Route::get('/welcome',[WelcomeController::class, 'index'])->name('welcome');  

Route::post('/join_request',[WelcomeController::class, 'join_request'])->name('join_request');  
Route::post('/withdraw', [DashboardController::class,'withdraw'])->name('withdraw');
Route::post('/activate_user_by_user', [WelcomeController::class, 'activate_user_by_user'])->name('activate_user_by_user');
Route::post('/activate_user_crypto', [WelcomeController::class, 'activate_user_crypto'])->name('activate_user_crypto');
Route::post('/get_user_for_activation', [DashboardController::class, 'get_user_for_activation'])->name('get_user_for_activation');
      
 
Route::get('/forget_transition',[TransitionController::class, 'forget_transition'])->name('forget_transition');   
 
  Route::post('send_transaction_password',[TransitionController::class, 'send_transaction_password'])->name('send_transaction_password');   
 
   Route::get('/reward', [DirectIncomeController::class, 'reward'])->name('reward');
   Route::get('/power-leg', [PowerWeakerController::class, 'powerLeg'])->name('powerLeg');
   
   Route::get('/weaker-leg', [PowerWeakerController::class, 'weakerLeg'])->name('weakerLeg');
   
   
  
  Route::get('/testing234234234234234/{id}', [WelcomeController::class, 'recheckLapsedDirectIncomesOfToday']);    

    // ****************************************************** Lottery Route By Afzal (Start) ******************************************************************************
        Route::get('/invest_lottery',[LotteryController::class, 'invest_lottery'])->name('invest_lottery');
        Route::post('/user/lottery_amount', [LotteryController::class, 'lottery_amount'])->name('lottery_amount');
        Route::get('/lottery_winner',[LotteryController::class, 'lottery_winner_list'])->name('lottery_winner');
        Route::get('/luckey-draw/participants', [LotteryController::class, 'lotteryParticipents'])->name('luckey.draw.participants');
        
    // ****************************************************** Lottery Route By Afzal (End) ******************************************************************************** 
    
    
    