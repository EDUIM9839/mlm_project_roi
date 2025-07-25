<?php

namespace App\Http\Controllers\Franchise;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
class FranchiseStockTransferController extends Controller
{


   
    

    public function frnforgetcartItems(){
        
           
            $cartdata=Session::get('cart');
            foreach($cartdata as $row){
                DB::table('cart_items')->where('product_id', $row['id'])->where('user_id', $row['from_id'])->delete();
            }
            
            Session::forget('cart');
            return redirect()->route('stock_transfer_by_franchise');
    }
    
    
    
    public function fbilling_forgetcartItems(){
           
           $cartdata=Session::get('cart');
            foreach($cartdata as $row){
                DB::table('cart_items')->where('product_id', $row['id'])->where('user_id', $row['from_id'])->delete();
            }
            
            Session::forget('cart');
            return redirect()->route('purchase_create');
    }
    
    
    
    public function purchase_list(){
        
            $id=Auth::user()->id;
            $bussiness_setup=DB::table('business_setup')->get();
            $title='Stock Transfer List';
            $data=DB::table('r_orders')->where('sell_from', $id)->paginate(9);
            return view('franchise.purchase-list' , compact('title', 'data', 'bussiness_setup', 'id'));
            
      }
    
    
     
    
    
    
    public function purchase_create(){
       
       
        
        
        
        // $cart = Session::get('cart');
        // if($cart){
        //     Session::forget('cart');
        //     return redirect()->route('purchase_create');
        // }else{
            $id=Auth::user()->id;
            $bussiness_setup=DB::table('business_setup')->get();
            $title='Stock Transfer List';
            
            $data=DB::table('franchise_product')->where('user_id', $id)->paginate(9);
            // print_r($data);
            return view('franchise.create-purchase' , compact('title', 'data', 'bussiness_setup', 'id'));
        // }
       
    }
    
    public function searchFranchises(){
        
    
    $from_id=$_POST['from_id'];
    $referaluser = DB::table('user')->where('role','franchise')->where('status', 1)->where('id', $from_id)->get();
   
    $referal=$referaluser['0']->userid;
    
    $term=$_POST['sdata'];
    $filterData = DB::table('user')->where('franchise_name','LIKE','%'.$term.'%')->where('role','franchise')->where('status', 1)->where('referal', $referal)->offset(0)->limit(5)->get();
  
    foreach($filterData as $row){ ?>
      <input type="hidden" id="uid<?php echo $row->id; ?>" name="uid" value="<?php echo $row->id; ?>">
      <input type="hidden" id="name<?php echo $row->id; ?>"   value="<?php echo $row->franchise_name; ?>">
      <input type="hidden" id="address<?php echo $row->id; ?>" name="address" value="<?php echo $row->address; ?>">
      <input type="hidden" id="city<?php echo $row->id; ?>" name="city" value="<?php echo $row->city;echo ','; ?>">
      <input type="hidden" id="state<?php echo $row->id; ?>" name="state" value="<?php echo $row->state;echo ','; ?>">
      <input type="hidden" id="zip<?php echo $row->id; ?>" name="zip" value="<?php echo $row->zip; ?>">
      <input type="hidden" id="mobile<?php echo $row->id; ?>" name="mobile" value="<?php  echo $row->contact;?>">
      <input type="hidden" id="email<?php echo $row->id; ?>" name="email" value="<?php  echo $row->email; ?>">
      <input type="hidden" id="saveWallet<?php echo $row->id; ?>" name="saveWallet" value="<?php echo $row->saving_wallet; ?>">
      <li class="list-group-item bgcolor" onclick="selectValsss('<?php echo  $row->id; ?>')" id="aaa<?php echo  $row->id; ?>"><?php echo $row->franchise_name; ?></li>
    <?php  }
  
}



    public function fbilling_searchFranchises(){
    
    
    $term=$_POST['sdata'];
    $filterData = DB::table('user')->where('first_name','LIKE','%'.$term.'%')->offset(0)->limit(5)->get();
  
    foreach($filterData as $row){ ?>
      <input type="hidden" id="uid<?php echo $row->id; ?>" name="uid" value="<?php echo $row->id; ?>">
      <input type="hidden" id="name<?php echo $row->id; ?>"   value="<?php echo $row->first_name; ?>">
      <input type="hidden" id="address<?php echo $row->id; ?>" name="address" value="<?php echo $row->address; ?>">
      <input type="hidden" id="city<?php echo $row->id; ?>" name="city" value="<?php echo $row->city;echo ','; ?>">
      <input type="hidden" id="state<?php echo $row->id; ?>" name="state" value="<?php echo $row->state;echo ','; ?>">
      <input type="hidden" id="zip<?php echo $row->id; ?>" name="zip" value="<?php echo $row->zip; ?>">
      <input type="hidden" id="mobile<?php echo $row->id; ?>" name="mobile" value="<?php  echo $row->contact;?>">
      <input type="hidden" id="email<?php echo $row->id; ?>" name="email" value="<?php  echo $row->email; ?>">
      <input type="hidden" id="saveWallet<?php echo $row->id; ?>" name="saveWallet" value="<?php echo $row->saving_wallet; ?>">
      <li class="list-group-item bgcolor" onclick="selectValsss('<?php echo  $row->id; ?>')" id="aaa<?php echo  $row->id; ?>"> <?php echo $row->first_name; ?></li>
    <?php  }
  
}



public function fbilling_add_to_cart(Request $request){
                
    $id=$request->id;// product id
    $cid=$request->cid; // customer id jisko stock transfer karna hai
    $from_id=$request->from_id; // jo stock transfer karta hai uski id hai
    if(empty($id) or empty($cid)){
       echo 11;exit; // customer id and cart id must be required  
    }else{
    
    $product = DB::table('products')->where('id', $id)->get();
    $cart = Session::get('cart', []);
    $qtyData=DB::table('franchise_product')->where('product_id', $id)->where('user_id', $from_id)->get();
  
    if($qtyData[0]->quantity==0){
      echo 0;exit;
    }else{
     if(isset($cart[$id])) {
     if($cart[$id]['quantity']<$qtyData[0]->quantity){
        $cart[$id]['quantity']++;
          $udata=array(
                 'quantity'=>$cart[$id]['quantity']
              );
          DB::table('cart_items')->where('product_id', $id)->where('user_id', $from_id)->update($udata); 
      }    
    
      } else {

           $cart[$id] = [
            "name" => $product[0]->product_name,
            "id"=>$product[0]->id,
            "user_id"=>$cid,
            "quantity" => 1,
            "mrp" => $product[0]->mrp,
            "business_value" => $product[0]->business_value,
            "percent_discount" => $product[0]->percent_discount,
            "invoicedate" =>$request->invoicedate,
            "from_id" =>$request->from_id,
            "flat_discount" => $product[0]->flat_discount,
        ];
        
          $dataaaaaa=array(
              'user_id'=>$from_id,
              'product_id'=>$id,
              'quantity'=>1
          );
          
          DB::table('cart_items')->insert($dataaaaaa); 
    }  
  }
  
   Session::put('cart', $cart);
   $cdata=Session::get('cart');
   $data['cartdata']=$cdata;
   return response()->json($data);

}
    
}










public function fadd_to_cart(Request $request){
                
    $id=$request->id;// product id
    $cid=$request->cid; // customer id jisko stock transfer karna hai
    $from_id=$request->from_id; // jo stock transfer karta hai uski id hai
    if(empty($id) or empty($cid)){
       echo 11;exit; // customer id and cart id must be required  
    }else{
    
    $product = DB::table('products')->where('id', $id)->get();
    $cart = Session::get('cart', []);
    $qtyData=DB::table('franchise_product')->where('product_id', $id)->where('user_id', $from_id)->get();
  
    if($qtyData[0]->quantity==0){
      echo 0;exit;
    }else{
     if(isset($cart[$id])) {
     if($cart[$id]['quantity']<$qtyData[0]->quantity){
        $cart[$id]['quantity']++;
          $udata=array(
                 'quantity'=>$cart[$id]['quantity']
              );
          DB::table('cart_items')->where('product_id', $id)->where('user_id', $from_id)->update($udata); 
      }    
    
      } else {

           $cart[$id] = [
            "name" => $product[0]->product_name,
            "id"=>$product[0]->id,
            "user_id"=>$cid,
            "quantity" => 1,
            "mrp" => $product[0]->mrp,
            "business_value" => $product[0]->business_value,
            "percent_discount" => $product[0]->percent_discount,
            "invoicedate" =>$request->invoicedate,
            "from_id" =>$request->from_id,
        ];
        
          $dataaaaaa=array(
              'user_id'=>$from_id,
              'product_id'=>$id,
              'quantity'=>1
          );
          
          DB::table('cart_items')->insert($dataaaaaa); 
    }  
  }
  
   Session::put('cart', $cart);
   $cdata=Session::get('cart');
   $data['cartdata']=$cdata;
   return response()->json($data);

}
    
}


public function fincreaseqty(Request $request){
    
    $qty=$request->qty;
    $id=$request->id;
    $cid=$request->cid;
    $from_id=$_POST['from_id'];
    $cart=Session::get('cart');
    $qtyData=DB::table('franchise_product')->where('product_id', $id)->where('user_id', $from_id)->get();
    if($cart[$id]['quantity']<$qtyData[0]->quantity){
          $cart[$id]['quantity']++;
          
        $udata=array(
                 'quantity'=>$cart[$id]['quantity']
              );
              
          DB::table('cart_items')->where('product_id', $id)->where('user_id', $from_id)->update($udata);    
        
    }    
    Session::put('cart', $cart);
    $cdatass=Session::get('cart');
    $data['cartdata']=$cdatass;
    return response()->json($data);
  
}  


public function fbilling_increaseqty(Request $request){
    
    $qty=$request->qty;
    $id=$request->id;
    $cid=$request->cid;
    $from_id=$_POST['from_id'];
    $cart=Session::get('cart');
    $qtyData=DB::table('franchise_product')->where('product_id', $id)->where('user_id', $from_id)->get();
    if($cart[$id]['quantity']<$qtyData[0]->quantity){
        $cart[$id]['quantity']++;
          
        $udata=array(
                 'quantity'=>$cart[$id]['quantity']
              );
              
          DB::table('cart_items')->where('product_id', $id)->where('user_id', $from_id)->update($udata);    
        
    }    
    Session::put('cart', $cart);
    $cdatass=Session::get('cart');
    $data['cartdata']=$cdatass;
    return response()->json($data);
  
}  


public function fdecreaseqty(Request $request){
    
    $qty=$request->qty;
    $id=$request->id;
    $cid=$request->cid;
     $from_id=$_POST['from_id'];
    $cart=Session::get('cart');
    $from_id=$_POST['from_id'];
    // $qtyData=DB::table('product_stocks')->where('pid', $id)->get();
   $qtyData=DB::table('franchise_product')->where('product_id', $id)->where('user_id', $from_id)->get();

     if($cart[$id]['quantity']<=$qtyData[0]->quantity and $cart[$id]['quantity']>1){    
          $cart[$id]['quantity']--;
           $udata=array(
                 'quantity'=>$cart[$id]['quantity']
              );
              
          DB::table('cart_items')->where('product_id', $id)->where('user_id', $from_id)->update($udata);    
        
          
    }    
    Session::put('cart', $cart);
    $cdatass=Session::get('cart');
   
    $data['cartdata']=$cdatass;
    return response()->json($data);
  
}  


public function fbilling_decreaseqty(Request $request){
    
    $qty=$request->qty;
    $id=$request->id;
    $cid=$request->cid;
     $from_id=$_POST['from_id'];
    $cart=Session::get('cart');
    $from_id=$_POST['from_id'];
    // $qtyData=DB::table('product_stocks')->where('pid', $id)->get();
   $qtyData=DB::table('franchise_product')->where('product_id', $id)->where('user_id', $from_id)->get();

     if($cart[$id]['quantity']<=$qtyData[0]->quantity and $cart[$id]['quantity']>1){    
          $cart[$id]['quantity']--;
           $udata=array(
                 'quantity'=>$cart[$id]['quantity']
              );
              
          DB::table('cart_items')->where('product_id', $id)->where('user_id', $from_id)->update($udata);    
        
          
    }    
    Session::put('cart', $cart);
    $cdatass=Session::get('cart');
   
    $data['cartdata']=$cdatass;
    return response()->json($data);
  
}  

public function fupdate_Qty(Request $request){
    
    $qty=$request->qty;
    $id=$request->id;
    $from_id=$_POST['from_id'];
    $Cart=Session::get('cart');
   
    $qtyData=DB::table('franchise_product')->where('product_id', $id)->where('user_id', $from_id)->get();
    
    if($qty<=$qtyData[0]->quantity and $qty>0){
          $Cart[$id]['quantity']=$qty;
          Session::put('cart', $Cart);
    }    
     $cdatass=Session::get('cart');
 
    $subtotal=0;
    foreach($cdatass as $row){
    $qty=$row['quantity'];
    // $subtotal+=$row['DpAfterPercentageDiscount']*$row['quantity'];
    $product = DB::table('products')->where('id', $row['id'])->get();
    $subtotal+=($row['mrp']-$row['mrp']*$product[0]->percent_discount/100)*$row['quantity'];
   
    }
    $products = DB::table('products')->where('id', $id)->get();
    $data['qty']=$cdatass[$id]['quantity'];
    $data['price']=($cdatass[$id]['mrp']-($cdatass[$id]['mrp']*$products[0]->percent_discount/100))*$data['qty'];
    
    $data['id']=$cdatass[$id]['id'];
    $data['subtotal']=$subtotal;
    echo json_encode($data);
}  


public function fdelete_Item_Cart(Request $request){
        $id=$request->id;
        $user_id=$request->cid;
        $Cart=Session::get('cart');
         
        
        
        $res=DB::table('cart_items')->where('product_id', $id)->where('user_id', $request->from_id)->delete();
        if(!empty($res)){
            unset($Cart[$id]);
            Session::put('cart', $Cart);
            $cdata['cartdata']=Session::get('cart');
            $cdta=Session::get('cart');
            $cartcount=count($cdta);
            
            if($cartcount==0){
                $cdata['status']=2;
                return response()->json($cdata); 
            }else{
                return response()->json($cdata); 
            }
            
        }else{
            
            Session::put('cart', $Cart);
            $cdata['cartdata']=Session::get('cart');
            $cdata['status']=1;
            return response()->json($cdata); 
        }
}



public function fbilling_delete_Cart_Item(Request $request){
    
        $id=$request->id;
        $user_id=$request->cid;
        $Cart=Session::get('cart');
        
        $res=DB::table('cart_items')->where('product_id', $id)->where('user_id', $request->from_id)->delete();
        
        if(!empty($res)){
            unset($Cart[$id]);
            Session::put('cart', $Cart);
            $cdata['cartdata']=Session::get('cart');
            $cdta=Session::get('cart');
            $cartcount=count($cdta);
            
            if($cartcount==0){
                $cdata['status']=2;
                return response()->json($cdata); 
            }else{
                return response()->json($cdata); 
            }
            
        }else{
            
            Session::put('cart', $Cart);
            $cdata['cartdata']=Session::get('cart');
            $cdata['status']=1;
            return response()->json($cdata); 
        }
}



public function generate_numbers($start, $count, $digits) {
        
        $result = array();
        for ($n = $start; $n < $start + $count; $n++) {
        $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
        }
          return 'DSC-'.$result['0'];
   }
        

public function generate_order_numbers($start, $count, $digits,$prefixname) {
      
        $result = array();
        for ($n = $start; $n < $start + $count; $n++) {
        $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
        }
        
        return $prefixname.'-'.$result['0'];
    }
        

public function fbilling_uploadData(Request $request){
    
    
   
    $business_setup=DB::table('business_setup')->where('id' , 1)->get();
    $prefixname=$business_setup['0']->id_prefix;
    $status='';
    $cdata=Session::get('cart');  
    $jsondata=array();
    foreach($cdata as $row){
        
        $productdata=DB::table('products')->where('id', $row['id'])->get();
        array_push($jsondata, $row);
     
    }
    $jencodedata=json_encode($jsondata);
    $countcartItem=count($cdata);
    
    if($countcartItem=='0'){
        $status='0';die;
    }else{
        
    $total_mrp=0;
    $total_bv=0;
    $total_dp=0;
    $qty=0;
    $Totalshipping_charge=0;
    foreach($cdata as $row){
        $total_bv+=$row['business_value'];
        $total_mrp+=$row['mrp'];
        $dp=$row['mrp']-$row['mrp']*$row['percent_discount']/100;
        $total_dp+=$dp;
        $qty+=$row['quantity'];
        $product=DB::table('products')->where('id', $row['id'])->get();
        $Totalshipping_charge+=$product['0']->shipping_charge;
        
    }
    
    
    $data=$_POST['data'];
    $dta=parse_str($data, $array);
    $to_id=$array['customer_id'];
    $products=$array['allproducts'];
    $from_id=$array['from_id'];
    $invoice_date= $array['invoicedate']; 
    $payment_method= $array['payment_method']; 
    $total=$array['total'];
  
    if(empty($to_id)){
        $status=11;
    }else if(empty($invoice_date)){
        $status=12;
    }else if(empty($payment_method)){
        $status=13;
    }else{
    
    $user=DB::table('user')->where('id', $to_id)->get(); 
    
    $result=DB::table('r_orders')->get();
    
    // FOR START GENERATE ORDER ID
    if(!empty($result[0])){
    
        $res=DB::table('r_orders')->orderBy('id', 'desc')->limit(1)->get();
        $order_id=$res[0]->order_id;
        $order_ids=substr($order_id, strrpos($order_id, '-') + 1);
        $order_numbers = $this->generate_order_numbers($order_ids+1, 1, 6, $prefixname);
        $orderid = $order_numbers;
    
    }else{
        $orderid=$prefixname.'-000001';
    }
    
    // FOR END GENERATE ORDER ID
    
    
    $shipping_address = array(
        [
        'user_id' => $to_id,
        'name' => $user['0']->first_name,
        'mobile' => $user['0']->contact,
        'address' => $user['0']->address,
        'city' => $user['0']->city,
        'state' => $user['0']->state,
        'pin_code' => $user['0']->zip
        ]
    );
    
    $shipping_address = json_encode($shipping_address);
    //PAYMENT BY WALLET START SECTION  
    
        $data=array(
        
            'sell_from'=>$from_id,
            'user_id'=>$to_id,
            'order_id'=>$orderid,
            'shipping_address'=>$shipping_address,
            'products'=>$jencodedata,
            'total'=>$total,
            'total_mrp'=>$total_mrp,
            'total_bv'=>$total_bv,
            'total_Dp'=>$total_dp,
            'payment_methods'=>$payment_method,
            // 'invoice_date'=>$invoice_date,
            // 'invoice_no'=>$invoice_no,
            'order_status'=>'0',
            'total'=>$total,
            'Totalshipping_charge'=>$Totalshipping_charge,
            'payment_status'=>'success',
            'sell_from'=>$from_id,
            'created_at'=>date('Y-m-d H:i:s'),
            'created_date'=>date('Y-m-d'),
            'total_qty'=>$qty
        
        
        );
    
    
    if($payment_method=='wallet'){
      
        if(empty($user['0']->saving_wallet)){
            
          $status=16;
            
         }else if($user['0']->saving_wallet<$total){
           $status=17; 
         }else {
               
              
                if(!empty($products)) {
                           
                       DB::table('r_orders')->insert($data);
                       
                       $lastInsertId=DB::getPdo()->lastInsertId();
            
                       if(!empty($lastInsertId)){
                           
                       $products2 = json_decode($products,1);
                     
                       if (count($products2) > 0) {
                              
                                foreach ($products2 as $item_product) {
                                    
                                    $product_idd = $item_product['id'];
                                    
                                    $quantityy = $item_product['quantity'];
                                    
                                    $franchise_product=DB::table('franchise_product')->where('product_id', $product_idd)->where('user_id', $from_id)->get();
                                    
                                    $updatestockdata=array(
                                        
                                       'quantity'=>$franchise_product['0']->quantity-$quantityy
                                       
                                    );
                                
                                    DB::table('franchise_product')->where('product_id', $product_idd)->where('user_id', $from_id)->update($updatestockdata);   
                                
                                    $deductamount=$user['0']->saving_wallet-$total;
                                    
                                    $updatewalletdata=array(
                                        
                                        'saving_wallet'=>$deductamount
                                        
                                    );    
                                   
                                    DB::table('user')->where('id',$to_id)->update($updatewalletdata);
                                   
                                    
                                }
                                
                                $status='1';             
                            }
                          
                        }else{
                           $status=15;
                       }
                       
                       
                } else{
                    $status=14;
                }
            
        }
       
     }
   
   //PAYMENT BY WALLET END SECTION   
   
    if($payment_method=='cash'){
             
                if(!empty($products)) {
                           
                       DB::table('r_orders')->insert($data);
                       $lastInsertId=DB::getPdo()->lastInsertId();
                       
                       if(!empty($lastInsertId)){
                       $products2 = json_decode($products,1);
                     
                       if (count($products2) > 0) {
                              
                                foreach ($products2 as $item_product) {
                                    
                                    $product_idd = $item_product['id'];
                                    $quantityy = $item_product['quantity'];
                                    
                                     $franchise_product=DB::table('franchise_product')->where('product_id', $product_idd)->where('user_id', $from_id)->get();
                                    
                                    $updatestockdata=array(
                                        
                                       'quantity'=>$franchise_product['0']->quantity-$quantityy
                                       
                                    );
                                    
                                    DB::table('franchise_product')->where('product_id', $product_idd)->where('user_id', $from_id)->update($updatestockdata); 
                                  }
                             }
                          
                       }else{
                           $status=15;
                       }
                       
                       
                } else{
                    $status=14;
                }
                
       $status='1';       
         
    }
    
    
    if($payment_method=='online'){
         $status=19;
    }
    
    
    }
       
    }
    echo $status;die;
    
}




        
public function fuploadData(Request $request){
    
    
    
    
    
    
    
    $status='';
    $cdata=Session::get('cart');  
    $countcartItem=count($cdata);
    
    if($countcartItem=='0'){
        $status='0'; // check cart item 0 
    }else{
        
    
    $data=$_POST['data'];
    $dta=parse_str($data, $array);
    $to_id=$array['customer_id'];
    $products=$array['allproducts'];
    $from_id=$array['from_id'];
    $total=$array['total'];
    
    $payment_method=$array['payment_method'];
    
    
    if($payment_method=='wallet'){
        
        $user=DB::table('user')->where('id', $to_id)->get();
       
        if(empty($user['0']->saving_wallet)){
            
          $status=16;
            
         }else if($user['0']->saving_wallet<$total){
           $status=17; 
         }else{
           
           
           $result=DB::table('product_transfer_history')->get();
    if(!empty($result[0])){
        
        $res=DB::table('product_transfer_history')->orderBy('id', 'desc')->limit(1)->get();
        $invoice=$res[0]->invoice_no;
        $invoicee=substr($invoice, strrpos($invoice, '-') + 1);
        $numbers = $this->generate_numbers($invoicee+1, 1, 6);
        $invoice_no = $numbers;
        
     }else{
        $res=DB::table('product_transfer_history')->orderBy('id', 'desc')->limit(1)->get();
        $invoice=$res[0]->invoice_no;
        $invoicee=substr($invoice, strrpos($invoice, '-') + 1);
        $numbers = $this->generate_numbers($invoicee+1, 1, 6);
        $invoice_no = $numbers;
     }
    $invoice_date= $array['invoicedate']; 
  
    
    if(!empty($products)) {
      
               $data=array(
                   
                    'from_id'=>$from_id,
                    'to_id'=>$to_id,
                    'product_details'=>$products,
                    'invoice_date'=>$invoice_date,
                    'invoice_no'=>$invoice_no,
                    'status'=>'success',
                    'total'=>$total,
                    'payment_method'=>$payment_method
                           
                     
                  );
              
               DB::table('product_transfer_history')->insert($data);
               $lastInsertId=DB::getPdo()->lastInsertId();
        
               if(!empty($lastInsertId)){
               $products2 = json_decode($products,1);
               if (count($products2) > 0) {
                      
                        foreach ($products2 as $item_product) {
                            
                            $product_idd = $item_product['id'];
                            $quantityy = $item_product['quantity'];
                           
                           
                            $product_stocks=DB::table('franchise_product')->where('product_id', $product_idd)->where('user_id', $from_id)->get();
                            $updatestockdata=array( 'quantity'=>$product_stocks['0']->quantity-$quantityy);
                            DB::table('franchise_product')->where('product_id', $product_idd)->where('user_id', $from_id)->update($updatestockdata);       
                          
                            $count=DB::table('franchise_product')->where('user_id', $to_id)->where('product_id', $product_idd)->count(); // check user_product me koi record hai ya nahidie;
                             
                            if($count>0) {
                                
                            
                                $select_product_from_user=DB::table('franchise_product')->where('user_id', $to_id)->where('product_id', $product_idd)->get(); 
                                
                                $franchse_product=array(
                                    
                                   'quantity'=>$select_product_from_user['0']->quantity+$quantityy
                                   
                                );
                                
                                DB::table('franchise_product')->where('product_id', $product_idd)->where('user_id', $to_id)->update($franchse_product); 
                                 $deductamount=$user['0']->saving_wallet-$total;
                                        $updatewalletdata=array(
                                           'saving_wallet'=>$deductamount,
                                        );     
                                        DB::table('user')->where('id', $to_id)->update($updatewalletdata);  
                               
                               
                            } else {
                            
                                $date=date("Y-m-d H:i:s");
                                $udata=array(
                                    'user_id'=>$to_id,
                                    'product_id'=>$product_idd,
                                    'quantity'=>$quantityy,
                                    'created_at'=>$date
                                );
                            
                                DB::table('franchise_product')->insert($udata);
                                
                                 $deductamount=$user['0']->saving_wallet-$total;
                                        $updatewalletdata=array(
                                           'saving_wallet'=>$deductamount,
                                        );     
                                        DB::table('user')->where('id', $to_id)->update($updatewalletdata);  
                               
                            }
                         
                           
                           }
                           
                          
                                  
                                  
                    }
               } 
               
               
        }  
            
    $status='1';
           
                
         }
        
        
    }
    
   //wallet end
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   if($payment_method=='cash'){
        
        $user=DB::table('user')->where('id', $to_id)->get();
        $result=DB::table('product_transfer_history')->get();
    if(!empty($result[0])){
        
        $res=DB::table('product_transfer_history')->orderBy('id', 'desc')->limit(1)->get();
        $invoice=$res[0]->invoice_no;
        $invoicee=substr($invoice, strrpos($invoice, '-') + 1);
        $numbers = $this->generate_numbers($invoicee+1, 1, 6);
        $invoice_no = $numbers;
        
     }else{
        $res=DB::table('product_transfer_history')->orderBy('id', 'desc')->limit(1)->get();
        $invoice=$res[0]->invoice_no;
        $invoicee=substr($invoice, strrpos($invoice, '-') + 1);
        $numbers = $this->generate_numbers($invoicee+1, 1, 6);
        $invoice_no = $numbers;
     }
     
     
    $invoice_date= $array['invoicedate']; 
  
    
    if(!empty($products)) {
      
               $data=array(
                   
                    'from_id'=>$from_id,
                    'to_id'=>$to_id,
                    'product_details'=>$products,
                    'invoice_date'=>$invoice_date,
                    'invoice_no'=>$invoice_no,
                    'status'=>'success',
                    'total'=>$total,
                    'payment_method'=>$payment_method
                           
                     
                  );
              
               DB::table('product_transfer_history')->insert($data);
               $lastInsertId=DB::getPdo()->lastInsertId();
        
               if(!empty($lastInsertId)){
               $products2 = json_decode($products,1);
               if (count($products2) > 0) {
                      
                        foreach ($products2 as $item_product) {
                            
                            $product_idd = $item_product['id'];
                            $quantityy = $item_product['quantity'];
                           
                           
                            $product_stocks=DB::table('franchise_product')->where('product_id', $product_idd)->where('user_id', $from_id)->get();
                            $updatestockdata=array( 'quantity'=>$product_stocks['0']->quantity-$quantityy);
                            DB::table('franchise_product')->where('product_id', $product_idd)->where('user_id', $from_id)->update($updatestockdata);       
                          
                            $count=DB::table('franchise_product')->where('user_id', $to_id)->where('product_id', $product_idd)->count(); // check user_product me koi record hai ya nahidie;
                             
                            if($count>0) {
                                
                            
                                $select_product_from_user=DB::table('franchise_product')->where('user_id', $to_id)->where('product_id', $product_idd)->get(); 
                                
                                $franchse_product=array(
                                    
                                   'quantity'=>$select_product_from_user['0']->quantity+$quantityy
                                   
                                );
                                
                                DB::table('franchise_product')->where('product_id', $product_idd)->where('user_id', $to_id)->update($franchse_product); 
                               
                               
                            } else {
                            
                                $date=date("Y-m-d H:i:s");
                                $udata=array(
                                    'user_id'=>$to_id,
                                    'product_id'=>$product_idd,
                                    'quantity'=>$quantityy,
                                    'created_at'=>$date
                                );
                            
                                DB::table('franchise_product')->insert($udata);
                               
                            }
                         
                           
                           }
                           
                          
                                  
                                  
                    }
               } 
               
               
        }  
            
    $status='1';
           
       
        
    }
    
    }
    echo $status;
    }
}
