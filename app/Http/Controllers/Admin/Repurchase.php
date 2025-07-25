<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;
class Repurchase extends Controller
{


public function create_repurchase_order(){
        
        // $cart = Session::get('cart');
        // if($cart){
        //     Session::forget('cart');
        //     return redirect()->route('stock_transfer');
        // }else{
        $from_id=Auth::user()->id;
        $bussiness_setup=DB::table('business_setup')->get();
        $title='Repurchase';
        $subtitle='Create Invoice';
        $data=DB::table('products')->paginate(9);
        return view('admin.repurchase-order' , compact('title', 'data', 'subtitle','bussiness_setup', 'from_id'));
        // }
        
            
    }
    
    
public function getrepurchase_order(Request $request){
        
        $id=$request->id; 
        $result=DB::table('r_orders')->where('id', $id)->get();
        $data=$result;
        $data=json_decode($result['0']->products);
      
        $qty=0;
        $price=0;
        $totaldp=0;
        $totalmrp=0;
        $totalbv=0;
        foreach($data as $row){
             $product=DB::table('products')->where('id', $row->id)->get();
             $qty+=$row->quantity;
             $totaldp+=($row->mrp-($row->mrp*$product['0']->percent_discount)/100)*$row->quantity;
             $totalbv+=($product['0']->business_value)*$row->quantity;
             $totalmrp+=($row->mrp)*$row->quantity;
        ?>
         <tr>
             <td><?php echo $row->name; ?></td>
             <td><?php echo $row->quantity; ?> </td>
             <td><?php echo $row->mrp; ?> * <?php echo $row->quantity ;?> </td>
             <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo ($row->mrp-($row->mrp*$product['0']->percent_discount)/100)*$row->quantity; ?></td>
             <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo ($row->mrp-($row->mrp*$product['0']->percent_discount)/100)*$row->quantity; ?></td>
             <td><?php echo $product['0']->business_value; ?> * <?php echo $row->quantity ;?> </td>
         </tr>
        <?php }?>
           
         <tr class="table-dark">
             <td>Total</td>
             <td><?php echo $qty; ?> </td>
             <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $totalmrp; ?></td>
              <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $totaldp; ?></td>
              <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $totaldp;?> </td>
             <td><?php echo $totalbv; ?></td>
          
         </tr>
        <?php }
    
public function onlinepayment(){
    
       return view('admin.onlinepayment');
    }
    

    

public function filterrecoreddatewise(Request $request){
       
       $request->validate([
            'fromdate'=>'required',
            'todate'=>'required',
        ]); 
         
        $bussiness_setup=DB::table('business_setup')->get();
        $title='Stock Transfer List';
        $fromdate=$request->fromdate;
        $todate=$request->todate;
        $table=$request->tablename;
        $data=Helper::filter_record_onedate_to_anotherdate($table,$fromdate,$todate);
        return view('admin.StockTransferList' , compact('title', 'data', 'bussiness_setup', 'fromdate','todate'));
         
    }    
    
    
public function StockTransferInvoice(Request $request){
        $id=$request->id; 
        $title='Create Invoice';
        $lastRecord=DB::table('product_transfer_history')->orderBy('id', 'desc')->first();
        // echo "<pre>";
        // print_r($lastRecord);die;
        $data=DB::table('business_setup')->get();
        $lastRecord->invoice_no;
         $invoiceno= substr($lastRecord->invoice_no, strpos($lastRecord->invoice_no, "-") + 1);
        $product_transfer_history=DB::table('product_transfer_history')->where('id', $id)->get();
        return view('admin/stock_transfer_invoice' , compact('title', 'invoiceno', 'data','product_transfer_history'));
    }
    
public function forgetcartItem(){
    
            $cartdata=Session::get('cart');
            foreach($cartdata as $row){
                DB::table('cart_items')->where('product_id', $row['id'])->where('user_id', $row['from_id'])->delete();
            }
            
            Session::forget('cart');
            return redirect()->route('create_repurchase_order');
    }
    
public function searchuser(){

    $term=$_POST['sdata'];
    $filterData = DB::table('user')->where('first_name','LIKE','%'.$term.'%')->where('role','user')->offset(0)->limit(5)->get();
  
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
      <li class="list-group-item bgcolor" onclick="selectValss('<?php echo  $row->id; ?>')" id="aaa<?php echo  $row->id; ?>"><?php echo $row->first_name; ?></li>
    <?php  }
  
}


public function add_to_cart(Request $request){
 
    $id=$request->id;
    $cid=$request->cid;
    if(empty($id) or empty($cid)){
       echo 11;exit; 
    }else{
    $product = DB::table('products')->where('id', $id)->get();
   
    $cart = Session::get('cart', []);
    $qtyData=DB::table('product_stocks')->where('pid', $id)->get();
  
    if($qtyData[0]->stock==0){
      echo 0;exit;
    }else{
     if(isset($cart[$id])) {
     if($cart[$id]['quantity']<$qtyData[0]->stock){
          $cart[$id]['quantity']++;
      
          $udata=array(
                 'quantity'=>$cart[$id]['quantity'],
                
              );
          DB::table('cart_items')->where('product_id', $id)->where('user_id', $request->from_id)->update($udata); 
      }    
    
      } else {
       
        $cart[$id] = [
           
            "name" => $product[0]->product_name,
            "id"=>$product[0]->id,
            "user_id"=>$cid,
            "quantity"=>1,
            "mrp"=>$product[0]->mrp,
            "business_value"=> $product[0]->business_value,
            "percent_discount"=> $product[0]->percent_discount,
            "flat_discount"=> $product[0]->flat_discount,
            "invoicedate"=>$request->invoicedate,
            "from_id"=>$request->from_id,
            "category_id"=>$product[0]->category_id,
            "subcategory_id"=>$product[0]->subcategory_id,
        ];
        
          $dataaaaaa=array(
              'user_id'=>$request->from_id,
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


public function increaseqtys(Request $request){
    
    $qty=$request->qty;
    $id=$request->id;
    $cid=$request->cid;
    $cart=Session::get('cart');
 
    $qtyData=DB::table('product_stocks')->where('pid', $id)->get();
    
    if($cart[$id]['quantity']<$qtyData[0]->stock){
          $cart[$id]['quantity']++;
          
          $udata=array(
                 'quantity'=>$cart[$id]['quantity']
              );
              
          DB::table('cart_items')->where('product_id', $id)->where('user_id', $request->from_id)->update($udata); 
        
    }    
    Session::put('cart', $cart);
    $cdatass=Session::get('cart');
    $data['cartdata']=$cdatass;
    return response()->json($data);
  
}  


public function decreaseqtys(Request $request){
    
    $qty=$request->qty;
    $id=$request->id;
    $cid=$request->cid;
     $cart=Session::get('cart');
 
    $qtyData=DB::table('product_stocks')->where('pid', $id)->get();
  

     if($cart[$id]['quantity']<=$qtyData[0]->stock and $cart[$id]['quantity']>1){    
          $cart[$id]['quantity']--;
         $udata=array(
          'quantity'=>$cart[$id]['quantity']
         );
        
         DB::table('cart_items')->where('product_id', $id)->where('user_id', $request->from_id)->update($udata); 
          
    }    
    Session::put('cart', $cart);
    $cdatass=Session::get('cart');
   
    $data['cartdata']=$cdatass;
    return response()->json($data);
  
}  



public function delete_Item_Cart(Request $request){
   
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
     

public function Tstock(Request $request){
    
    $request->validate([
         'image' => 'required|mimes:jpg,png,jpeg,gif,svg'
        ]);
    
    $imageName = time() . "." . strtoupper($request->image->extension());
    
    $request->image->move(public_path('paymentproofimages'), $imageName);
    
    $to_id=$request->to_id;
    $products=$request->allproducts;
    $from_id=$request->from_id;
    $invoice_date= $request->invoicedate; 
    $payment_method= 'CASH'; 
    $total=$request->total;
    
    //PAYMENT BY CASH START SECTION    
    
    $user=DB::table('user')->where('id', $to_id)->get();
    $result=DB::table('product_transfer_history')->get();
    
    if(!empty($result[0])){
    
        $res=DB::table('product_transfer_history')->orderBy('id', 'desc')->limit(1)->get();
        $invoice=$res[0]->invoice_no;
        $invoicee=substr($invoice, strrpos($invoice, '-') + 1);
        $numbers = $this->generate_numbers($invoicee+1, 1, 6);
        $invoice_no = $numbers;
    
    }else{
        $invoice_no='DSC-000001';
    }
    
    if(!empty($products)) {
    
    $data=array(
    
    'from_id'=>$from_id,
    'to_id'=>$to_id,
    'product_details'=>$products,
    'invoice_date'=>$invoice_date,
    'invoice_no'=>$invoice_no,
    'status'=>'pending',
    'total'=>$total,
    'payment_method'=>$payment_method,
    'payment_proof'=>$imageName
    
    );
    
    DB::table('product_transfer_history')->insert($data);
    $lastInsertId=DB::getPdo()->lastInsertId();
    if(!empty($lastInsertId)){
        $request->session()->put('success', 'For Approval request has been send.');
        $cart = Session::get('cart');
        Session::forget('cart');
        return redirect()->route('Stock_Transfer_List');
     }else{
        $request->session()->put('error', 'Something went wrong.');
        return redirect()->route('Tstock');  
     }
    
    } 
        
   //PAYMENT BY CASH END SECTION   
  
    }

        
        
public function uploaduserdata(Request $request){
    
    $business_setup=DB::table('business_setup')->where('id' , 1)->get();
    $prefixname=$business_setup['0']->id_prefix;
 
    $status='';
    $cdata=Session::get('cart');  
    $countcartItem=count($cdata);
    $jsondata=array();
    foreach($cdata as $row){
        
        $productdata=DB::table('products')->where('id', $row['id'])->get();
        array_push($jsondata, $row);
     
    }
    $jencodedata=json_encode($jsondata);
  
    if($countcartItem=='0'){
        $status='0';
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
    // print_r(json_decode($products));die;
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
    //PAYMENT BY WALLET START SECTION    
    
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
                                    $product_stocks=DB::table('product_stocks')->where('pid', $product_idd)->get();
                                    $updatestockdata=array(
                                       'stock'=>$product_stocks['0']->stock-$quantityy
                                    );
                                
                                    DB::table('product_stocks')->where('pid', $product_idd)->update($updatestockdata);   
                                
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
                                    $product_stocks=DB::table('product_stocks')->where('pid', $product_idd)->get();
                                  
                                    $updatestockdata=array(
                                       'stock'=>$product_stocks['0']->stock-$quantityy
                                    );
                                
                                    DB::table('product_stocks')->where('pid', $product_idd)->update($updatestockdata);   
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
    
}
