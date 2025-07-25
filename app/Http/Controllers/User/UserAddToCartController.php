<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IncomeHistory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Auth;
use Hash;

class UserAddToCartController extends Controller
{

    public function cart()
    {
        $product = DB::table('products')
        ->join('product_images', 'products.id', '=', 'product_images.pid')
        ->select('products.*', 'product_images.image')
        ->where('products.first_or_repurchase','=','repurchase')
        ->get();
        return view('user.cart',compact('product'));
    }
        
    public function add_to_cart_product(Request $request)
    {         
        $id=$request->id;
        $product = DB::table('products')->where('id', $id)->get();
        $cart = Session::get('cart', []);
        $qtyData=DB::table('product_stocks')->where('pid', $id)->get();
        if(!empty($qtyData[0]->stock)){
         if(isset($cart[$id])) {
         if($cart[$id]['quantity']<$qtyData[0]->stock){
             $cart[$id]['quantity']++;
             Session::put('cart', $cart);
             echo 3;
          }else{
            echo 1;   
          }
             
         } else {
    
            $cart[$id] = [
                "name" => $product[0]->product_name,
                "id"=>$product[0]->id,
                "quantity" => 1,
                "mrp" => $product[0]->mrp,
            ];
            
            Session::put('cart', $cart);
            echo 2;
          } 
       
        }else{
       
         echo 0;
      }
    
    }   
    
     public function add_cart(Request $request)
     {
         $data1=DB::table('cart_items')->where('user_id',$request->user_id)->where('product_id',$request->product_id)->exists();
             $data=array(
                    'user_id'=>$request->user_id,
                    'product_id'=>$request->product_id,
                    'quantity'=>'1',
                    'created_at'=>date('Y-m-d H:i:s'),
                  );
                  if($data1)
                  {
                    echo 1;
                  }
                  else{
                 DB::table('cart_items')->insert($data);  
                 echo 2;
                  }
                  
     }
 
    public function user_cart()
     {
      $userid=Auth::user()->id;
      $data=DB::table('cart_items')->where('user_id',$userid)->get();
      
     return view('user.user_cart',compact('data'));    
     }
   
    
    public function first_user_cart(){
        $userid=Auth::user()->id;
        $result=DB::table('cart_items')->where('user_id',$userid)->get();
     
     
     return view('user.first_user_cart',compact('result'));
    }
 
    public function remove_cart(Request $request)
     {
         $data=DB::table('cart_items')->where('user_id',$request->user_id)->where('product_id',$request->product_id)->delete();
        if($data)
        {
            echo 1;
        }else{
            echo 2;
        }
     }
     
    public function update_cart(Request $request)
     {
     $data_size=DB::table('product_stocks')->where('pid',$request->product_id)->get();
     $stock=$data_size[0]->stock;
     $datasizecount=DB::table('cart_items')->where('user_id',$request->user_id)->where('product_id',$request->product_id)->get(['quantity']);
         $dataCount = $datasizecount[0]->quantity;
        
          if($dataCount<$stock)
          {
             $stocks=$dataCount+1;
             $datas=array('quantity'=>$stocks, ); //for cart quantity update 
             DB::table('cart_items')->where('user_id',$request->user_id)->where('product_id',$request->product_id)->update($datas);
             echo 1; 
          }else{
               echo 2; 
          }       
     }
     
    public function update_cart_minus(Request $request)
      {
      $datasizecount=DB::table('cart_items')->where('user_id',$request->user_id)->where('product_id',$request->product_id)->get(['quantity']);
         $dataCount = $datasizecount[0]->quantity;
         
          if($dataCount>1)
          {
             $stocks=$dataCount-1;
             $datas=array('quantity'=>$stocks, ); //for cart quantity update 
             DB::table('cart_items')->where('user_id',$request->user_id)->where('product_id',$request->product_id)->update($datas);
             echo 1;   
          }else{
               echo 2; 
          }       
     }
     
    public function product_summery()
     {
       $userid=Auth::user()->id;
       $data=DB::table('cart_items')->where('user_id',$userid)->get();
         return view('user.product_details_summery',compact('data'));
     }
     
     
       public function generate_order_numbers($start, $count, $digits,$prefix_name)
           {
            $result = array();
            for ($n = $start; $n < $start + $count; $n++) {
            $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
            }
            $user=Auth::user();
         $user_id=Auth::user()->id;
         $userid=$user->userid;
         $checks_status = DB::table('user_package')->where('user_id',$user_id)->where('status',"=",'approved')->count();
          if($checks_status==0){
              return $prefix_name.'-'.'first'.'-'.$result['0'];
          }else{
              return $prefix_name.'-'.$result['0'];
          }
        }
        
    public function pay_from_wallet(Request $request)
     {
          $request->validate([
                     'name'=>'required',
                     'contact'=>'required',
                     'city'=>'required',
                     'state'=>'required',
                     'country'=>'required',
                     'zip'=>'required',
                     'address'=>'required',
                     'total_bv'=>'required',
                     'total_amount'=>'required',
                    ]); 
          ini_set('max_execution_time', 6000);
          date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
          $prefix=DB::table('business_setup')->get();
          $prefix_name=$prefix[0]->id_prefix;
         $user=Auth::user();
         $user_id=Auth::user()->id;
         $userid=$user->userid;
         $user_wallet=$user->saving_wallet;
         $result=DB::table('r_orders')->get();
         $results=DB::table('orders')->get();
         $checks_status = DB::table('user_package')->where('user_id',$user_id)->where('status',"=",'approved')->count();
          if($checks_status==0){
         if(!empty($results[0])){
        $res=DB::table('orders')->orderBy('id', 'desc')->limit(1)->get();
        $order_id=$res[0]->order_id;
        $order_ids=substr($order_id, strrpos($order_id, '-') + 1);
        $order_numbers = $this->generate_order_numbers($order_ids+1, 1, 6, $prefix_name);
        $orderid = $order_numbers;
        }else{
            $orderid=$prefix_name.'-'.'first'.'-000001';
        } 
          }else{
               if(!empty($result[0])){
        $res=DB::table('r_orders')->orderBy('id', 'desc')->limit(1)->get();
        $order_id=$res[0]->order_id;
        $order_ids=substr($order_id, strrpos($order_id, '-') + 1);
        $order_numbers = $this->generate_order_numbers($order_ids+1, 1, 6, $prefix_name);
        $orderid = $order_numbers;
        }else{
            $orderid=$prefix_name.'-000001';
        }
          }
         
            
          $product_data=DB::table('cart_items')->where('user_id',$user_id)->get();
            $product_details1=[];
          foreach($product_data as $pd)
          {
             $product_details=DB::table('products')->where('id',$pd->product_id)->get();
             $product_quantity=DB::table('cart_items')->where('user_id',$user_id)->where('product_id',$pd->product_id)->get();
             $iddd=$product_details[0]->id;
        
            if((($product_details[0]->discount_type)=='percent')&&(isset($product_details[0]->discount_type)))
            {
                $discount=$product_details[0]->mrp*$product_details[0]->percent_discount/100;
            }
            elseif((($product_details[0]->discount_type)=='flat')&&(isset($product_details[0]->discount_type)))
            {
               $discount= $product_details[0]->flat_discount;
            }
            else
            {
                $discount='0';
            }
             $cartt[$iddd]=[
                'name' => $product_details[0]->product_name,
                'id' => $iddd,
                'category_id' =>$product_details[0]->category_id,
                'subcategory_id' =>$product_details[0]->subcategory_id,
                'quantity' => $product_quantity[0]->quantity,
                'business_value' => $product_details[0]->business_value,
                'dp' => $product_details[0]->dp,
                'user_id' => $user_id,
                'mrp' => $product_details[0]->mrp,
                'discount' => $discount,
                'invoicedate' => date('Y-m-d H:i:s'),
                'from_id' => null,
               ];
            array_push($product_details1, $cartt[$iddd]);
             DB::table('product_stocks')->where('pid',$pd->product_id)->decrement('stock',$product_quantity[0]->quantity);
          }
            $shipping_address = [
                'user_id' => $user_id,
                'name' => $request->name,
                'mobile' => $request->contact,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'zip' => $request->zip,
                'address' => $request->address
           ];
         $data=array(
                    'total'=>$request->total_amount,
                    'total_bv'=>$request->total_bv,
                    'shipping_address'=>json_encode(array($shipping_address)),
                    'order_id'=>$orderid,
                    'products'=>json_encode($product_details1),
                    'user_id'=>$user_id,
                    'sell_from'=>$userid,
                    'order_status'=>'0',
                    'dat_time'=>date('Y-m-d H:i:s'),
                    'payment_status'=>'success',
                    'payment_methods'=>'wallet',
                    'delivery_status'=>'pending',
                  );
                  
                  $package_data=array(
                      'user_id'=>$user_id,
                      'package_id'=>'1',
                      'status'=>'approved',
                      'payment_type'=>'wallet',
                      'activated_by'=>$user_id,
                      'activated_date'=>date('Y-m-d H:i:s'),
                      'date'=>date('Y-m-d H:i:s'),
                      );
                      
                
                //  $check_status= DB::table('user_package')->where('user_id',$user_id)->where('status','approved')->count();
                $check_status = DB::table('user_package')->where('user_id',$user_id)->where('status',"=",'approved')->count();
               
         if($user_wallet>=($request->total_amount))
          {
              if($check_status==0){
                   $get_referal =  DB::table('user')->where('id',$user_id)->get();
                         $referal_id=$get_referal['0']->referal;
                   $get_referal_data = DB::table('user')->where('userid',$referal_id)->get();
                         $referal_withdrawal=$get_referal_data['0']->withdrawl_wallet;
                         
                   $direct_income=DB::table('direct_income')->get();
                         $income_type=$direct_income['0']->income_type;
                         $direct_amount=$direct_income['0']->fixed_amount;
                         $direct_status=$direct_income['0']->status;
                         if($direct_status==1){
                              if($income_type=="Percentage"){
                        $amount=($request->total_bv)*$direct_amount/100;
                        $direct_income_amount=$referal_withdrawal+$amount;
                        DB::table('user')->where('userid',$referal_id)->update(['withdrawl_wallet'=>$direct_income_amount]);
                    }elseif($income_type=="Fixed"){
                        $direct_income_amount=$referal_withdrawal+$direct_amount;
                        DB::table('user')->where('userid',$referal_id)->update(['withdrawl_wallet'=>$direct_income_amount]);
                    }
                   
                         }
                   
                   DB::table('orders')->insert($data); 
                   DB::table('user_package')->insert($package_data);
            DB::table('user')->where('id',$user_id)->decrement('saving_wallet',$request->total_amount);
            DB::table('cart_items')->where('user_id',$user_id)->delete(); 
         
            $request->session()->flash('success',"Order Placed Successfully"); 
          return redirect()->route('order_history');
              }else{
                   DB::table('r_orders')->insert($data); 
            DB::table('user')->where('id',$user_id)->decrement('saving_wallet',$request->total_amount);
            DB::table('cart_items')->where('user_id',$user_id)->delete(); 
             $request->session()->flash('success',"Order Placed Successfully"); 
          return redirect()->route('r_order_history');
              }
             
         
          }else{
           $request->session()->flash('error',"Insufficient Wallet Ammount"); 
           return redirect()->route('product_summery');
         }
         
     }
     
     
    
     
     public function buy_now($id)
     {
         $userid=Auth::user()->id;
       $data=DB::table('cart_items')->where('user_id',$userid)->get();
         return view('user.buy_now',compact('id','data'));
     }
     public function buy_now_from_wallet(Request $request)
     {
        //  dd($request);
          $request->validate([
                     'name'=>'required',
                     'contact'=>'required',
                     'city'=>'required',
                     'state'=>'required',
                     'country'=>'required',
                     'zip'=>'required',
                     'address'=>'required',
                     'business_value'=>'required',
                     'dp'=>'required',
                     'product_id'=>'required',
                    ]); 
         
         ini_set('max_execution_time', 6000);
          date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
          $prefix=DB::table('business_setup')->get();
          $prefix_name=$prefix[0]->id_prefix;
         $user=Auth::user();
         $user_id=Auth::user()->id;
         $userid=$user->userid;
         $user_wallet=$user->saving_wallet;
         $result=DB::table('r_orders')->get();  
          if(!empty($result[0])){
        $res=DB::table('r_orders')->orderBy('id', 'desc')->limit(1)->get();
        $order_id=$res[0]->order_id;
        $order_ids=substr($order_id, strrpos($order_id, '-') + 1);
        $order_numbers = $this->generate_order_numbers($order_ids+1, 1, 6, $prefix_name);
        $orderid = $order_numbers;
        }else{
            $orderid=$prefix_name.'-000001';
        }  
             $product_details=DB::table('products')->where('id',$request->product_id)->get();
              $qty=DB::table('product_stocks')->where('pid',$request->product_id)->get('stock');
             // dd($qty);
              if($qty[0]->stock>=1)
              {
                  $iddd=$product_details[0]->id;
             if(($product_details[0]->discount_type)=='percent')
             {
                 $discount=$product_details[0]->percent_discount;
             }elseif(($product_details[0]->discount_type)=='flat'){
                $discount= $product_details[0]->flat_discount;
             }
             else{
                 $discount='0';
             }
             $product_details1=[
                'name' => $product_details[0]->product_name,
                'id' => $iddd,
                'category_id' =>$product_details[0]->category_id,
                'subcategory_id' =>$product_details[0]->subcategory_id,
                'quantity' => '1',
                'business_value' => $product_details[0]->business_value,
                'dp' => $product_details[0]->dp,
                'user_id' => $user_id,
                'mrp' => $product_details[0]->mrp,
                'discount' => $discount,
                'invoicedate' => date('Y-m-d H:i:s'),
                'from_id' => null,
               ];
             DB::table('product_stocks')->where('pid',$request->product_id)->decrement('stock',1);
            $shipping_address = [
                'user_id' => $user_id,
                'name' => $request->name,
                'mobile' => $request->contact,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'zip' => $request->zip,
                'address' => $request->address
           ];
         $data=array(
                    'total'=>$request->dp,
                    'total_bv'=>$request->business_value,
                    'shipping_address'=>json_encode(array($shipping_address)),
                    'order_id'=>$orderid,
                    'products'=>json_encode(array($product_details1)),
                    'user_id'=>$user_id,
                    'sell_from'=>$userid,
                    'order_status'=>'0',
                    'dat_time'=>date('Y-m-d H:i:s'),
                    'payment_status'=>'success',
                    'payment_methods'=>'wallet',
                    'delivery_status'=>'pending',
                  );
         if($user_wallet>=($request->dp))
         
          {
            //   dd("test");
            DB::table('r_orders')->insert($data); 
            DB::table('user')->where('id',$user_id)->decrement('saving_wallet',$request->dp);
          $request->session()->flash('success',"Order Placed Successfully"); 
          return redirect()->route('r_order_history');
          }else{
           $request->session()->flash('error',"Insufficient Wallet Ammount"); 
           return redirect()->route('product_summery');
         } 
      }else{
           $request->session()->flash('error',"Sorry! Product is Out of Stock"); 
           return redirect()->route('product_summery');
      }
            
     }
}




