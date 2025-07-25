<?php

namespace App\Http\Controllers\Franchise;
use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
   public function Dashboard()
    {
        
        // echo "franchise a agye";
        // die;
        $endDate=date("Y-m-d");
        $startDate=date('Y-m-d', strtotime('-7 days'));
        // echo $endDate; die;
        $data = User::where('role', '=', 'user')->get();
        $userData= DB::table('user')->where("role","user")->get();
        $last_sevenDays_user = DB::table('user')->whereBetween('created_at', ["$startDate", "$endDate"])->count();
        $last_sevenDays_userpackage = DB::table('user_package')->whereBetween('created_at', ["$startDate", "$endDate"])->count();
        $check_activeuser = DB::table('user_package')->where("status","approved")->count();
        // dd($last_sevenDays_user);die;
        $total_user=count($userData);
        $inactiveuser=$total_user-$check_activeuser;
        $last_sevenDays_inactiveuser=$last_sevenDays_user- $last_sevenDays_userpackage;
        $datas=compact('data','total_user','last_sevenDays_user','check_activeuser','last_sevenDays_userpackage','inactiveuser','last_sevenDays_inactiveuser');
        return view('franchise/Dashboard')->with($datas);
    }
 
 
 public function myprofile()
    {
        return view('franchise/myprofile');
    }
    
    
public function FranchiseStockTransferInvoice(Request $request){
        $id=$request->id; 
        $title='Create Invoice';
        $lastRecord=DB::table('product_transfer_history')->orderBy('id', 'desc')->first();
        // echo "<pre>";
        // print_r($lastRecord);die;
        $data=DB::table('business_setup')->get();
        $lastRecord->invoice_no;
         $invoiceno= substr($lastRecord->invoice_no, strpos($lastRecord->invoice_no, "-") + 1);
        $product_transfer_history=DB::table('product_transfer_history')->where('id', $id)->get();
     
        return view('franchise/stock_transfer_invoices' , compact('title', 'invoiceno', 'data','product_transfer_history'));
} 

    
public function purchase_invoice(Request $request){
        $id=$request->id; 
        $title='Create Invoice';
        
        $data=DB::table('business_setup')->get();

        $r_orders=DB::table('r_orders')->where('id', $id)->get();
     
        return view('franchise/purchase_invoice' , compact('title',  'data','r_orders'));
} 
    
    
 public function stock_transfer_history(){
     
        $id=Auth::user()->id;
        $bussiness_setup=DB::table('business_setup')->get();
        $title='Stock Transfer List';
        
        $data=DB::table('product_transfer_history')->where('from_id', $id)->get();
        return view('franchise.stock_transfer_history' , compact('title', 'data', 'bussiness_setup'));
        
        
      return view('franchise.stock_transfer_history');
 }  
 
  public function stock_transfer_by_franchise(){
     
     
     
     
            //  $cart = Session::get('cart');
       
            // Session::forget('cart');
        
       
        $id=Auth::user()->id;
        $bussiness_setup=DB::table('business_setup')->get();
        $title='Stock Transfer List';
        
        $data=DB::table('franchise_product')->where('user_id', $id)->get();
        // echo "<pre>";
        // print_r($data);die;
        return view('franchise.stocktransfer' , compact('title', 'data', 'bussiness_setup', 'id'));
        
 }  
}
 