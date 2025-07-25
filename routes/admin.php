<?php
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CrudsController;
use App\Http\Controllers\DBManagerController;
use App\Http\Controllers\Admin\FranchiseController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SignupController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\GenerateInvoicController;
use App\Http\Controllers\Admin\AddToCartController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\Fund_RequestController;
use App\Http\Controllers\Admin\AchiverController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\StockTransferController;   
use App\Http\Controllers\Admin\Repurchase;   
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\User\WelcomeController; 
use App\Http\Controllers\Admin\BinaryTreeController;
use App\Http\Controllers\Admin\WithdrawlController;  
use App\Http\Controllers\Admin\CustomRoiController;  
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\LotteryHandleController;
use App\Http\Controllers\Admin\AwardController;  
use App\Http\Controllers\Admin\DappController;  
use App\Http\Controllers\Admin\OTPController;  

    
      Route::get('awards', [AwardController::class, 'awards'])->name('awards');
      Route::get('reward-approve/{id}', [AwardController::class, 'rewardApprove'])->name('reward.approve');
      
    // all user Edit route 
    Route::get('user-edit/{id}', [DashboardController::class, 'user_edit'])->name('user-edit');
    Route::get('user/login/{id}', [DashboardController::class, 'user_login'])->name('user-login');
   
    Route::get('/profile',[DashboardController::class, 'profile'])->name('profile');
    Route::post('/user_update', [CrudsController::class, 'user_update'])->name('user_update');
     Route::post('/update-usdt-address', [CrudsController::class, 'updateUsdtAddress'])->name('update.usdt.address');
    
    
    
    //CHANGE PASSWORD
    
    Route::post('/change_password', [CrudsController::class, 'change_password'])->name('change_password');
    Route::post('/change_password_transaction', [CrudsController::class, 'change_password_transaction'])->name('change_password_transaction');
    
    
    // show active user list route 
    Route::get('/active-user-list', [DashboardController::class, 'active_user_list'])->name('active-user-list');
     
    Route::get('/inactive-user-list', [DashboardController::class, 'only_inactive_user_list'])->name('only-inactive-user-list');
     
    Route::get('/active/user', [DashboardController::class, 'active_user'])->name('active_user_list');
    Route::get('/inactive/user/list', [DashboardController::class, 'inactive_user_list'])->name('inactive_user_list');
    
    
    Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');
    Route::get('/reward achiever user', [DashboardController::class, 'reward_achiever_user'])->name('reward_achiever_user');
    Route::get('/view_reward_achiver_user_list/{id}', [DashboardController::class, 'view_reward_achiver_user_list'])->name('view_reward_achiver_user_list');
    Route::get('/change_reward_status/{id}', [DashboardController::class, 'change_reward_status'])->name('change_reward_status');
    Route::get('/club achiever user', [DashboardController::class, 'club_achiever_user'])->name('club_achiever_user');
    Route::get('/weight', [DashboardController::class, 'weight'])->name('weight');
    Route::get('/users/list', [DashboardController::class, 'user_list'])->name('user-list');
    Route::post('/users/switch-status', [DashboardController::class, 'switch_status'])->name('switch-status');
    Route::get('/users/details', [DashboardController::class, 'user_details'])->name('user-details');
    Route::get('/joining/percentage', [DashboardController::class, 'joining_percentage'])->name('joining_percentage');
    Route::post('/joining/percentage',[DashboardController::class, 'joining_percentage'])->name('joining_percentage');
    Route::get('joining_percentage',[DashboardController::class, 'joining_percentage']);
    Route::post('updatejoiningpercentage/1',[CrudsController::class, 'update_joining_percentage'])->name('update_joining_percentage');
    Route::get('/p2p', [DashboardController::class, 'p_to_p'])->name('p_to_p');
    Route::get('/block_user', [DashboardController::class, 'block_user'])->name('block_user');
    Route::post('/block_user', [DashboardController::class, 'blockUserStore'])->name('blockUser');
    //LEVEL
     Route::get('/level',[LevelController::class, 'level'])->name('level');
      Route::post('/level/store',[LevelController::class, 'store_level'])->name('store_level');
       Route::get('level/delete/{id}',[LevelController::class, 'level_delete'])->name('level-delete');
        Route::get('level/update',[LevelController::class, 'updatelevel'])->name('updatelevel');
       Route::post('level/update',[LevelController::class, 'updatelevel'])->name('updatelevel');
      
    // pto p transfer route
    Route::post('/PtoP', [DBManagerController::class, 'global_insert'])->name('ptop_trancefer');
    Route::post('/admin_ptop_trancefer', [DashboardController::class, 'admin_ptop_trancefer'])->name('admin_ptop_trancefer');
    // ptop check user azax 
    Route::post('/ptop_user', [DashboardController::class, 'ptop_user'])->name('ptop_user');
    Route::post('/ptop_userrs', [DashboardController::class, 'ptop_userrs'])->name('ptop_userrs');
    // ptop check sender amount  
    Route::post('/check_amount_ptops', [DashboardController::class, 'check_amount_ptops'])->name('check_amount_ptops');
    
   
    Route::get('/autopool',[DashboardController::class, 'autopool'])->name('autopool');
    Route::get('/income_history',[DashboardController::class, 'income_history'])->name('income_history');
   
    Route::get('/income_booster',[DashboardController::class, 'income_booster'])->name('income_booster');
    Route::get('/package_detail',[DashboardController::class, 'package_detail'])->name('package_detail');
    Route::get('/purchase_package',[DashboardController::class, 'purchase_package'])->name('purchase_package');
    
    
    Route::get('/purchase_package_list',[DashboardController::class, 'purchase_package_list'])->name('purchase_package_list');
     
     
    Route::get('/notification',[DashboardController::class, 'notification'])->name('notification');
    Route::post('/notification',[DashboardController::class, 'notification'])->name('notification');
    Route::get('notification',[DashboardController::class, 'notification']);
    Route::post('update_notification',[CrudsController::class, 'update_notification'])->name('update_notification');
    Route::post('update_banner',[CrudsController::class, 'update_banner'])->name('update_banner');
    Route::get('/change_password',[DashboardController::class, 'change_password'])->name('change_password');
    
    Route::get('/change_roi_percent_by_admin',[DashboardController::class, 'change_roi_percent'])->name('change_roi_percent');
    Route::post('/change_roi_percent_by_admin',[DashboardController::class, 'change_roi_percent_by_admin'])->name('change_roi_percent_by_admin');
    Route::get('/roi_on_off_by_admin',[DashboardController::class, 'roi_on_off'])->name('roi_on_off');
    Route::post('/admin/roi-toggle/{id}', [DashboardController::class, 'toggleROI'])->name('admin.roi.toggle');
    
    Route::post('/change_bfi_percent_by_admin',[DashboardController::class, 'change_bfi_percent_by_admin'])->name('change_bfi_percent_by_admin');
    
    Route::get('/add/banner',[DashboardController::class, 'add_banner'])->name('add_banner');
    Route::get('/change_password_transaction',[DashboardController::class, 'change_password_transaction'])->name('change_password_transaction');
    // Route::get('/business/setup', [DashboardController::class, 'business_setup'])->name('business_setup');
    // Route::post('/business/setup', [DashboardController::class, 'business_setup'])->name('business_setup');
    // Route::get('business_setup', [DashboardController::class, 'business_setup']);
    // Route::post('update/1',[CrudsController::class, 'update'])->name('update_data');  
    // Route::get('/mail/config', [DashboardController::class, 'mail_config'])->name('mail_config');
    // Route::post('/mail/config',[DashboardController::class, 'mail_config'])->name('mail_config');
    // Route::get('mail_config',[DashboardController::class, 'mail_config']);
    // Route::post('updatemail/1',[CrudsController::class, 'updatemail'])->name('update_mail');
    // Route::get('/sms/config',[DashboardController::class, 'sms_config'])->name('sms_config');
    // Route::post('/sms/config',[DashboardController::class, 'sms_config'])->name('sms_config');
    // Route::get('sms_config',[DashboardController::class, 'sms_config']);
    // Route::post('updatetwilio/1',[CrudsController::class, 'updatetwilio'])->name('update_sms_twilio');
    // Route::post('updatenexmo/1',[CrudsController::class, 'updatenexmo'])->name('update_sms_nexmo');
    // Route::post('updatetwofactor/1',[CrudsController::class, 'updatetwofactor'])->name('update_sms_factor');
    // Route::post('updatemsg/1',[CrudsController::class, 'updatemsg'])->name('update_sms_msg');
    // Route::get('/social/media',[DashboardController::class, 'social_media'])->name('social_media');
    // Route::post('/social/media',[DashboardController::class, 'social_media'])->name('social_media');
    // Route::get('social_media',[DashboardController::class, 'social_media' ]);
    // Route::post('updatesocial/1',[CrudsController::class, 'updatesocial'])->name('update_social');
    // Route::get('/payment/config',[DashboardController::class, 'payment_config'])->name('payment_config');
    Route::get('/withdrawl_history1',[DashboardController::class, 'withdrawl_history1'])->name('withdrawl_history1');
    Route::get('/package_list', [DashboardController::class, 'package_list'])->name('package_list');
    Route::post('/AddPackage', [DashboardController::class, 'AddPackages'])->name('add_package');
    Route::post('/update_package', [DashboardController::class, 'update_package'])->name('update_package');
    Route::get('/withdrawl_request', [DashboardController::class, 'withdrawl_request'])->name('withdrawl_requests');
    Route::get('/withdrawal_request_manually_by_admin', [DashboardController::class, 'withdrawal_request_manually_by_admin'])->name('withdrawal_request_manually_by_admin');
    Route::post('/withdrawal_request_manually_by_admin2', [DashboardController::class, 'withdrawal_request_manually_by_admin2'])->name('withdrawal_request_manually_by_admin2');
   
    Route::post('/change_status/{id}', [DashboardController::class, 'change_status'])->name('change_status');

     Route::post('/change_status_default/{id}', [DashboardController::class, 'change_status_default'])->name('change_status_default');

    Route::get('/edit_package', [DashboardController::class, 'edit_package'])->name('edit_package');
    Route::get('/delete-package/{id}', [DashboardController::class, 'delete_package'])->name('delete_package');
  //  Route::get('/changeStatus', [DashboardController::class, 'changeStatus'])->name('changeStatus');
    
    //This route for plan settings
    // Route::get('/plan_setting',[PlanController::class, 'plan_setting'])->name('plan_setting');
    // Route::post('/plan_setting',[PlanController::class, 'plan_setting'])->name('plan_setting');
    // Route::get('plan_setting',[PlanController::class, 'plan_setting']);
    
    // Route::get('/matching_commission',[PlanController::class, 'matching_commission'])->name('matching_commission');
    // Route::get('/matching_bonus',[PlanController::class, 'matching_bonus'])->name('matching_bonus');
    
    // Route::get('/rank_commission',[PlanController::class, 'rank_commission'])->name('rank_commission');
    // Route::post('/rank_commission',[PlanController::class, 'rank_commission'])->name('rank_commission');
    Route::get('rank_commission',[PlanController::class, 'rank_commission']);
    Route::get('delete/{id}',[PlanController::class, 'delete'])->name('delete');
    Route::post('/store',[CrudsController::class, 'rank_store'])->name('rank_store');
    Route::post('update_rank',[CrudsController::class, 'update_rank'])->name('update_rank');
    // Route::get('/roi_commission',[PlanController::class,'roi_commission'])->name('roi_commission');
    // Route::post('/roi_commission',[PlanController::class, 'roi_commission'])->name('roi_commission');
    // Route::get('/autopool_bonus',[PlanController::class, 'autopool_bonus'])->name('autopool_bonus');
    // Route::post('/autopool_bonus',[PlanController::class, 'autopoo_bonus'])->name('autopool_bonus');
    // Route::get('/repurchase_bonus',[PlanController::class, 'repurchase_bonus'])->name('repurchase_bonus');
    // Route::post('/repurchase_bonus',[PlanController::class, 'repurchase_bonus'])->name('repurchase_bonus');
    // Route::get('/rewards',[PlanController::class, 'rewards'])->name('rewards');
    // Route::post('/rewards',[PlanController::class, 'rewards'])->name('rewards');
    Route::get('/level_roi_income',[PlanController::class, 'level_roi_income'])->name('level_roi_income');
    Route::post('/level_roi_income',[PlanController::class, 'level_roi_income'])->name('level_roi_income');
     Route::get('/level_roi_bonus',[PlanController::class, 'level_roi_bonus'])->name('level_roi_bonus');
    Route::post('/level_roi_bonus',[PlanController::class, 'level_roi_bonus'])->name('level_roi_bonus');
    Route::get('/cashback_bonus',[PlanController::class, 'cashback_bonus'])->name('cashback_bonus');
    Route::post('/cashback_bonus',[PlanController::class, 'cashback_bonus'])->name('cashback_bonus');
    Route::get('/matrix_commission',[PlanController::class, 'matrix_commission'])->name('matrix_commission');
    Route::post('/matrix_commission',[PlanController::class,'matrix_commission'])->name('matrix_commission');
    
    Route::post('/store_commission',[CrudsController::class, 'store_commission'])->name('store_commission');
     //This route for rank achivers page
    Route::get('/rank_achivers',[AchiverController::class, 'rank_achivers'])->name('rank_achivers');
    Route::post('/rank_achivers',[AchiverController::class, 'rank_achivers'])->name('rank_achivers');
    Route::get('rank_achivers',[AchiverController::class, 'rank_achivers']);
      //This route for payout
    Route::get('/generate/payout',[PayoutController::class, 'generate_payout'])->name('generate_payout');
    Route::get('/payout/history',[PayoutController::class, 'payout_history'])->name('payout_history');
    Route::get('/redirect',[PayoutController::class, 'redirect'])->name('redirect');
    // Route::get('payout',[PayoutController::class, 'payout']);
    //  //This route for nav payment page
    // Route::get('/payment',[PaymentController::class, 'payment'])->name('payment');
    // Route::post('/payment',[PaymentController::class, 'payment'])->name('payment');
    // Route::get('payment',[PaymentController::class, 'payment']);
    //  //This route for signup page nav
    // Route::get('/sign_up',[SignupController::class, 'sign_up'])->name('sign_up');
    // Route::post('/sign_up',[SignupController::class, 'sign_up'])->name('sign_up');
    // Route::get('sign_up',[SignupController::class, 'sign_up']);
    
    // get edit data route
        Route::post('/getEditData',[CrudsController::class, 'getEditData'])->name('getEditData');
    //START FRANCHISE SECTION
    Route::get('/add-franchise', [FranchiseController::class, 'add_franchise'])->name('add-franchise');
    Route::post('/save_franchise', [FranchiseController::class, 'save_franchise'])->name('save_franchise');
    Route::get('/franchise-list', [FranchiseController::class, 'franchise_list'])->name('franchise-list');
    Route::get('/edit-franchise/{id}', [FranchiseController::class, 'edit_franchise'])->name('edit-franchise');
    Route::get('/delete-franchise/{id}', [FranchiseController::class, 'delete_franchise'])->name('delete-franchise');
    Route::post('/update_franchise', [FranchiseController::class, 'update_franchise'])->name('update_franchise');
    // Route::post('/subcategory_list', [FranchiseController::class, ' subcategory_list'])->name(' subcategory_list');
    Route::post('/add_subcategory', [FranchiseController::class, ' add_subcategory'])->name(' add_subcategory');
    Route::post('/getCouponCodeDiscount', [FranchiseController::class, 'getCouponCodeDiscount'])->name('getCouponCodeDiscount');
    Route::get('/FranchiseListOfFranchise', [FranchiseController::class, 'FranchiseListOfFranchise'])->name('FranchiseListOfFranchise');
   
    //END FRANCHISE SECTION
    
    
    //START CATEGORY SECTION
    Route::get('/add-category', [FranchiseController::class, 'add_category'])->name('add-category');
    Route::get('/category-list', [FranchiseController::class, 'category_list'])->name('category-list');
    Route::post('/save_category', [FranchiseController::class, 'save_category'])->name('save_category');
    Route::get('/edit-category/{id}', [FranchiseController::class, 'edit_category'])->name('edit_category');
    Route::get('/delete-category/{id}', [FranchiseController::class, 'delete_category'])->name('delete_category');
    Route::post('/update_category', [FranchiseController::class, 'update_category'])->name('update_category');
    //END CATEGORY SECTION
    
    // messages route for ibndividual users 
    Route::get('/admin/message',[MessageController::class,'messages'])->name('user_message');
      Route::post('/admin/message-post',[MessageController::class,'messagesPost'])->name('message-save');  
      Route::get('message/{id}', [MessageController::class, 'delete'])->name('message-delete');
  

    //START SUBCATEGORY SECTION
    Route::get('/add-subcategory', [SubcategoryController::class, 'add_subcategory'])->name('add-subcategory');
     Route::post('/getsubcategory', [SubcategoryController::class, 'getsubcategory'])->name('getsubcategory');
    Route::get('/subcategory-list', [SubcategoryController::class, 'subcategory_list'])->name('subcategory-list');
    Route::post('/save_subcategory', [SubcategoryController::class, 'save_subcategory'])->name('save_subcategory');
    Route::get('/edit-subcategory/{id}', [SubcategoryController::class, 'edit_subcategory'])->name('edit_subcategory');
    Route::get('/delete-subcategory/{id}', [SubcategoryController::class, 'delete_subcategory'])->name('delete_subcategory');
    Route::post('/update_subcategory', [SubcategoryController::class, 'update_subcategory'])->name('update_subcategory');
    Route::get('/changeStatus', [SubcategoryController::class, 'changeStatus'])->name('changeStatus');
    //END SUBCATEGORY SECTION
     Route::get('/changeStatuss', [SubcategoryController::class, 'changeStatuss'])->name('changeStatuss'); 
    
    
    // START PRODUCT SECTION
    
    Route::get('/add-product', [ProductController::class, 'add_product'])->name('add-product');
    Route::get('/product-list', [ProductController::class, 'product_list'])->name('product-list');
    Route::post('/product_search', [ProductController::class, 'product_search'])->name('product_search');
    Route::post('/get_product_details', [ProductController::class, 'get_product_details'])->name('get_product_details');
    Route::get('/sell-product', [ProductController::class, 'sell_product'])->name('sell-product');
    Route::post('/update_product', [ProductController::class, 'update_product'])->name('update_product');
    Route::get('/delete-product/{id}', [ProductController::class, 'delete_product'])->name('delete_product');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit_product'])->name('edit_product');
    Route::get('/deleteProductImage/{id}', [ProductController::class, 'deleteProductImage'])->name('deleteProductImage');
    Route::post('/save_product', [ProductController::class, 'save_product'])->name('save_product');
    Route::post('/updateImage', [ProductController::class, 'updateImage'])->name('updateImage');
    Route::post('/uploadBulkImage', [ProductController::class, 'uploadBulkImage'])->name('uploadBulkImage');
    Route::get('/edit_images/{id}', [ProductController::class, 'edit_images'])->name('edit_images');
    
    Route::get('/first_order_list', [ProductController::class, 'FirstOrderList'])->name('first_order_list');
    Route::get('/repurchase_order_list', [ProductController::class, 'RepurchaseOrderList'])->name('repurchase_order_list');
    
    Route::post('/getProducts', [ProductController::class, 'getProducts'])->name('getProducts');
    Route::get('/GenerateInvoice/id', [ProductController::class, 'GenerateInvoice'])->name('GenerateInvoice');
    Route::get('/approvedPackage', [DashboardController::class, 'approvedPackage'])->name('approvedPackage');
    
    // END PRODUCT SECTION
    //Achivers Message
    Route::get('/achivers_message',[AchiverController::class, 'achivers_message'])->name('achivers_message');
    Route::post('/achivers_message',[AchiverController::class, 'achivers_message'])->name('achivers_message');
    Route::post('achivers_message',[AchiverController::class, 'achivers_message']);
    
    // START Invoice SECTION
    
     Route::post('searchClient', [GenerateInvoicController::class, 'searchClient'])->name('searchClient');
     Route::get('/create_invoice', [GenerateInvoicController::class, 'create_invoice'])->name('create_invoice');
     Route::post('/getData', [GenerateInvoicController::class, 'getData'])->name('getData');
     Route::post('/get_product_details', [GenerateInvoicController::class, 'get_product_details'])->name('get_product_details');
     Route::post('/getAllTypeDiscount', [GenerateInvoicController::class, 'getAllTypeDiscount'])->name('getAllTypeDiscount');
     Route::post('/adminOrder', [GenerateInvoicController::class, 'adminOrder'])->name('adminOrder');
    
    // END Invoice SECTION
    
    //Fund_Request Routes
    
    Route::get('/fund_request',[Fund_RequestController::class, 'fund_request'])->name('fund_request');
    Route::get('/pending_fund_request',[Fund_RequestController::class, 'pending_fund_request'])->name('pending_fund_request');
    Route::get('/delete-pending/{id}', [Fund_RequestController::class, 'delete_pending'])->name('delete-pending');
    Route::get('/fundrequest',[Fund_RequestController::class, 'fundrequest'])->name('fundrequest');
    Route::post('/fundrequest',[Fund_RequestController::class, 'fundrequest'])->name('fundrequest');
     Route::post('/getEditfund',[Fund_RequestController::class, 'getEditfund'])->name('getEditfund');
     
      // START Invoice SECTION
    Route::post('/getCitiess', [FranchiseController::class, 'getCitiess'])->name('getCitiess');
    Route::post('/getCities', [FranchiseController::class, 'getCities'])->name('getCities');
    Route::get('/create_invoice', [FranchiseController::class, 'allproducts'])->name('create_invoice');
    Route::post('/destroyCart',[AddToCartController::class,'destroyCart'])->name('destroyCart');
    Route::post('/addtocart',[AddToCartController::class,'addtocartproduct'])->name('addtocart');
    Route::post('/deleteItemCart',[AddToCartController::class,'deleteItemCart'])->name('deleteItemCart');
    Route::post('/Qtyupdate',[AddToCartController::class,'Qtyupdate'])->name('Qtyupdate');
    Route::post('/searchClientsss', [AddToCartController::class, 'searchClientssss'])->name('searchClientsss');
    Route::post('/uploarData',[AddToCartController::class,'uploarData'])->name('uploarData');
    Route::get('/testing', [FranchiseController::class, 'testing'])->name('testing');
    Route::post('/changeOrderStatus',[ProductController::class,'changeOrderStatus'])->name('changeOrderStatus');
    Route::post('changessOrder',[ProductController::class,'change_Orderfirst1'])->name('change_Orderfirst1');
    Route::post('/changeOrderRepurchase',[ProductController::class,'changeOrderRepurchase'])->name('changeOrderRepurchase');

    // END Invoice SECTION
    
    // Stock Transfer
    
   Route::get('/stock_transfer',[StockTransferController::class, 'stocktransfer'])->name('stock_transfer');
   Route::post('/searchFranchise', [StockTransferController::class, 'searchFranchise'])->name('searchFranchise');
   Route::post('/add_to_cart',[StockTransferController::class,'add_to_cart'])->name('add_to_cart');
   Route::post('/update_Qty',[StockTransferController::class,'update_Qty'])->name('update_Qty');
   Route::post('/delete_Item_Cart',[StockTransferController::class,'delete_Item_Cart'])->name('delete_Item_Cart');
   Route::post('/uploadData',[StockTransferController::class,'uploadData'])->name('uploadData');
   Route::get('/forgetcartItems',[StockTransferController::class,'forgetcartItems'])->name('forgetcartItems');
   Route::get('/StockTransferList',[StockTransferController::class,'StockTransferList'])->name('Stock_Transfer_List');
   Route::get('/StockTransferInvoice',[StockTransferController::class,'StockTransferInvoice'])->name('Stock_Transfer_Invoice');
   Route::post('/increaseqty',[StockTransferController::class,'increaseqty'])->name('increaseqty');
   Route::post('/decreaseqty',[StockTransferController::class,'decreaseqty'])->name('decreaseqty');
  
   Route::get('/payment',[StockTransferController::class,'onlinepayment'])->name('onlinepayment');
   Route::get('/stocktransfer',[StockTransferController::class,'cashpayment'])->name('cashpayment');
   Route::post('/Tstock',[StockTransferController::class,'Tstock'])->name('Tstock');
   Route::get('/ApprovedStockTransfer',[StockTransferController::class,'ApprovedStockTransfer'])->name('ApprovedStockTransfer');
   
   Route::post('/filterrecoreddatewise',[StockTransferController::class,'filterrecoreddatewise'])->name('filterrecoreddatewise');
   
   Route::post('/searchuser', [Repurchase::class, 'searchuser'])->name('searchuser');        

   Route::get('/create_repurchase_order',[Repurchase::class,'create_repurchase_order'])->name('create_repurchase_order');
   Route::post('/uploaduserdata',[Repurchase::class,'uploaduserdata'])->name('uploaduserdata');
   Route::post('/increaseqtys',[Repurchase::class,'increaseqtys'])->name('increaseqtys');
   Route::post('/decreaseqtys',[Repurchase::class,'decreaseqtys'])->name('decreaseqtys');
   Route::post('/getrepurchase_order', [Repurchase::class, 'getrepurchase_order'])->name('getrepurchase_order');
   Route::get('/forgetcartItem',[Repurchase::class,'forgetcartItem'])->name('forgetcartItem');
   Route::post('/filterrecoreddate',[ProductController::class,'filterrecoreddate'])->name('filterrecoreddate');
   Route::post('/filterrecored',[ProductController::class,'filterrecored'])->name('filterrecored');
   Route::post('/filter',[ProductController::class,'filter'])->name('filter');
   Route::post('/record',[ProductController::class,'record'])->name('record');

     Route::get('/suspended_user_list', [DashboardController::class, 'suspended_user_list'])->name('suspended_user_list');
     Route::get('/activate_suspend_user/{id}', [DashboardController::class, 'activate_suspend_user'])->name('activate_suspend_user');
     
   
   Route::get('/total_collection', [DashboardController::class, 'total_collection'])->name('total_collection');
    Route::post('/collection_filter', [DashboardController::class, 'collection_filter'])->name('collection_filter');
   Route::get('/pending/users', [DashboardController::class, 'pending_users'])->name('pending_users');
   Route::get('active_package/{id}', [DashboardController::class, 'active_package'])->name('active_package'); 
   Route::get('/self_fund', [DashboardController::class, 'self_fund'])->name('self_fund'); 
   Route::get('/update_upi', [DashboardController::class, 'update_upi'])->name('update_upi'); 
   Route::post('/update/upi', [DashboardController::class, 'update_barcode'])->name('update_barcode'); 
   Route::post('/add_self_fund', [DashboardController::class, 'add_self_fund'])->name('add_self_fund'); 
   
   Route::get('/activate_user_by_admin', [WelcomeController::class, 'activate_user_by_admin_page'])->name('activate_user_by_admin_page');
   Route::get('/inactivate_user', [WelcomeController::class, 'inactivate_user'])->name('inactivate_user');
     Route::post('/activate_user_by_admin', [WelcomeController::class, 'activate_user_by_admin'])->name('activate_user_by_admin');
       Route::get('/binary-tree', [BinaryTreeController::class, 'binary_tree'])->name('binary-tree-admin');
   
    Route::post('/cancel_withdrawl/{id}', [WithdrawlController::class, 'cancel_withdrawl'])->name('cancel_withdrawl');
   
   
     Route::get('/cto_achievers', [DashboardController::class, 'cto_achievers'])->name('cto_achievers');
     Route::get('/admin_invest_amount', [DashboardController::class, 'admin_invest_amount'])->name('admin_invest_amount');
   
   
    Route::get('/global_star_user_list', [DashboardController::class, 'global_star_user_list'])->name('global_star_user_list');
    Route::post('/activate_user_invest', [DashboardController::class, 'activate_user_invest'])->name('activate_user_invest');
   
    Route::get('/dapp-settings', [DappController::class, 'index'])->name('admin.dapp_settings.index');
    Route::post('/dapp-settings/withdrawal-settings', [DappController::class, 'storeWithdrawalSettings'])->name('admin.dapp_settings.withdrawal.store');
    // opt verification through email route here 
    Route::post('/send-otp', [DappController::class, 'sendOtpEmail'])->name('send_otp_emails');
    Route::post('/verify-otp', [DappController::class, 'verifyOtp'])->name('verify_otps');
    Route::post('/dapp-settings/receiver-settings', [DappController::class, 'saveReceiverSettings'])->name('admin.dapp_settings.receiver.store');
   
    Route::get('/custom-roi', [CustomRoiController::class, 'customRoiPage'])->name('admin.custom.roi.page');
   
   
//   add on routes - code by ajendra

Route::get('/joining_date_update', [DashboardController::class, 'joining_date_update'])->name('joining_date_update');
Route::post('/get-referer-user', [DashboardController::class, 'getRefererUser'])->name("get-referer-user");
Route::post('/update-joining-date', [DashboardController::class, 'updateJoiningDate'])->name('update-joining-date');

Route::get('/tree_swap', [DashboardController::class, 'tree_swap'])->name('tree_swap');
Route::post('/updatereferal', [DashboardController::class, 'updatereferal'])->name('updatereferal');

// ******************************************** Add Route for Group By Afzal (Start) ***********************************************************************

    Route::get('/add-group', [DashboardController::class, 'add_group'])->name('add-group');
    Route::post('/addGroup', [DashboardController::class, 'addGroup'])->name('addGroup');
    Route::get('/get-group-details/{id}', [DashboardController::class, 'getGroupDetails']);
    Route::put('/update-group/{id}', [DashboardController::class, 'updateGroup'])->name('update-group');
    Route::post('/set-default-group/{id}', [DashboardController::class, 'setDefault']);
    Route::get('/group_wise',[DashboardController::class, 'group_wise'])->name('group_wise');
    Route::get('/get-user-group-details/{id}', [DashboardController::class, 'getUserGroupDetails']);
    Route::post('/assign-group', [DashboardController::class, 'assignGroup'])->name('assignGroup');
    Route::post('/check-user', [DashboardController::class, 'checkUser'])->name('checkUser');
    Route::post('/update-user-group/{id}', [DashboardController::class, 'updateUserGroup'])->name('updateUserGroup');


// ******************************************** Add Route for Group By Afzal (End) *************************************************************************
//mail Route

Route::get('/mail',function (){
    return view('emails.demoMail');
});

// ********************************************************************* Lottery By Afzal (Start) *********************************************************************

    Route::get('/lottery_pending', [LotteryHandleController::class, 'lottery_pending'])->name('lottery_pending');
    Route::get('/admin/export-winners/{week}', [LotteryHandleController::class, 'exportWinners'])->name('admin.export_winners');
    Route::post('/reset-winner/{week}', [LotteryHandleController::class, 'resetWinners'])->name('reset_winner');
    // Route::post('/select-winner/{week}', [LotteryHandleController::class, 'selectWinner'])->name('select_winner');
    Route::get('/lottery_result', [LotteryHandleController::class, 'lottery_result_view'])->name('lottery_result');
    
    Route::get('/percent', [LotteryHandleController::class, 'percentage'])->name('percent');
    Route::post('/week-percentage-save', [LotteryHandleController::class, 'saveWeekPercentage'])->name('weekly.save');
    Route::get('/update-week-percentage/{id}', [LotteryHandleController::class, 'editWeekPercentage'])->name('update.week');
    Route::post('/update-week-percentage-submit/{id}', [LotteryHandleController::class, 'updateWeekPercentage'])->name('update.week.submit');

    Route::get('/participants/{week_year}', [LotteryHandleController::class, 'viewParticipants'])->name('participants');
    Route::post('/participants/{week_year}/select-winner', [LotteryHandleController::class, 'selectWinner'])->name('select_winner');


// ********************************************************************* Lottery By Afzal (End) ***********************************************************************


 Route::post('update-usdt/get-otp/{id}', [OTPController::class, 'sendUsdtChangeOTP'])->name('admin.update-usdt.send-otp');
    Route::post('enter-withdrawal/get-otp', [OTPController::class, 'sendEnterWithdrawalRequestOTP'])->name('admin.enter-withdrawal.send-otp');
    Route::post('enter-withdrawal/verify-otp', [OTPController::class, 'openWithdrawalRequestPage'])->name('admin.enter-withdrawal.verify-otp');

