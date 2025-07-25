<?php
use App\Http\Controllers\Franchise\DashboardController;
use App\Http\Controllers\Franchise\FranchiseStockTransferController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->name('franchise-dashboard');
Route::get('/myprofile', [DashboardController::class, 'myprofile'])->name('myprofile');

    
Route::get('/stock_transfer_history', [DashboardController::class, 'stock_transfer_history'])->name('stock_transfer_history');

Route::get('/FranchiseStockTransferInvoice', [DashboardController::class, 'FranchiseStockTransferInvoice'])->name('stock_transfer_historysss');
Route::get('/stock_transfer', [DashboardController::class, 'stock_transfer_by_franchise'])->name('stock_transfer_by_franchise');
Route::post('/fadd_to_cart',[FranchiseStockTransferController::class,'fadd_to_cart'])->name('fadd_to_cart');
Route::post('/searchFranchises', [FranchiseStockTransferController::class, 'searchFranchises'])->name('searchFranchises');
Route::post('/fdelete_Item_Cart',[FranchiseStockTransferController::class,'fdelete_Item_Cart'])->name('fdelete_Item_Cart');

Route::post('/fuploadData',[FranchiseStockTransferController::class,'fuploadData'])->name('fuploadData');
Route::post('/fupdate_Qty',[FranchiseStockTransferController::class,'fupdate_Qty'])->name('fupdate_Qty');
Route::get('/frnforgetcartItems',[FranchiseStockTransferController::class,'frnforgetcartItems'])->name('frnforgetcartItems');

Route::post('/fincreaseqty',[FranchiseStockTransferController::class,'fincreaseqty'])->name('fincreaseqty');
Route::post('/fdecreaseqty',[FranchiseStockTransferController::class,'fdecreaseqty'])->name('fdecreaseqty');

Route::get('/purchase/create',[FranchiseStockTransferController::class,'purchase_create'])->name('purchase_create');
Route::post('/purchase',[FranchiseStockTransferController::class,'purchase'])->name('purchase');



Route::post('/fbilling_add_to_cart',[FranchiseStockTransferController::class,'fbilling_add_to_cart'])->name('fbilling_add_to_cart');

Route::post('/fbilling_increaseqty',[FranchiseStockTransferController::class,'fbilling_increaseqty'])->name('fbilling_increaseqty');
Route::post('/fbilling_decreaseqty',[FranchiseStockTransferController::class,'fbilling_decreaseqty'])->name('fbilling_decreaseqty');

Route::post('/fbilling_delete_Cart_Item',[FranchiseStockTransferController::class,'fbilling_delete_Cart_Item'])->name('fbilling_delete_Cart_Item');

Route::post('/fbilling_uploadData',[FranchiseStockTransferController::class,'fbilling_uploadData'])->name('fbilling_uploadData');


Route::get('/fbilling_forgetcartItems',[FranchiseStockTransferController::class,'fbilling_forgetcartItems'])->name('fbilling_forgetcartItems');


Route::post('/fbilling_searchFranchises',[FranchiseStockTransferController::class,'fbilling_searchFranchises'])->name('fbilling_searchFranchises');
Route::get('/purchase_list',[FranchiseStockTransferController::class,'purchase_list'])->name('purchase_list');
Route::get('/purchase_invoice',[DashboardController::class,'purchase_invoice'])->name('purchase_invoice');
