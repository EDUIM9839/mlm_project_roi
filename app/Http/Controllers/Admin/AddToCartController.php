<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
class AddToCartController extends Controller
{


public function addtocartproduct(Request $request){
                
    $id=$request->id;
    $product = DB::table('products')->where('id', $id)->get();
    $cart = Session::get('cart', []);
    $qtyData=DB::table('product_stocks')->where('pid', $id)->get();
    if($qtyData[0]->stock==0){
      echo 0;exit;
    }else{
     if(isset($cart[$id])) {
     if($cart[$id]['quantity']<$qtyData[0]->stock){
         $cart[$id]['quantity']++;
      }    
    
      } else {

        $cart[$id] = [
            "name" => $product[0]->product_name,
            "id"=>$product[0]->id,
            "quantity" => 1,
            "r_price" => $product[0]->r_price,
        ];

    }  
  }
   Session::put('cart', $cart);
   $cdata=Session::get('cart');
   $i=1;
   $total_bv=0;
   $total=0; foreach($cdata as $row){
   $qty=$row['quantity'];
  
   $products=DB::table('products')->where('id', $row['id'])->get();
   $total+=($row['r_price']-$row['r_price']*$products[0]->discount/100)*$row['quantity'];
   $total_bv+=$products['0']->business_value;
   ?>
       <tr>
          <td style="text-align:center"><?php echo $i++;?></td>
          <td style="text-align:center"><input type='text'  name='name' value="<?php echo $row['name'];?>" id='name' readonly='readonly' /></td>
          <td style="text-align:center"><input type='number' min="1" name='quantity' value="<?php echo $row['quantity'];?>" id='quantity<?php echo $row['id']; ?>' onchange="updateQty(<?php echo $row['id']; ?>)"/></td>
          <td style="text-align:center" id='mrp<?php echo $row['id']; ?>'><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $row['r_price'];?></td>
          <td style="text-align:center" id='dp<?php echo $row['id']; ?>'><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $row['r_price']-$row['r_price']*$products[0]->discount/100;?></td>
          
          <td style="text-align:center" id='total<?php echo $row['id']; ?>'><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo ($row['r_price']-$row['r_price']*$products[0]->discount/100)*$row['quantity'];?></td>
          <td style="text-align:center" id=''><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $row['quantity']*$total_bv; ?></td>
          <td style="text-align:center"><a onclick="deleteCartItem('<?php echo $row['id']?>')"><i class='fa fa-trash'></i></a></td>
       </tr>
    <?php } ?>
        <tr>
        
        
          <td style="text-align:center"></td>
          <td style="text-align:center"></td>
          <td style="text-align:center"></td>
          <td style="text-align:center"></td>
          <td style="text-align:center"></td>
          <td style="text-align:center">
              <input type='hidden' name='allproducts' value='<?php print_r(json_encode($cdata)); ?>' id='allproducts' />
              <input type='hidden' name='total' value="<?php echo $total; ?>" id='total' />
          </td>
          <td style="text-align:center"><strong>Sub Total</strong></td>
          <td style="text-align:center" id='subtotal'>
                <i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $total; ?>
            </td>
       </tr>

<?php
}

public function generate_numbers($start, $count, $digits) {
        
        $result = array();
        for ($n = $start; $n < $start + $count; $n++) {
        $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
        }
          return 'NBG_'.$result['0'];
        }
        
  public function generate_ordernumbers($start, $count, $digits) {
        
        $result = array();
        for ($n = $start; $n < $start + $count; $n++) {
        $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
        }
          return 'ORDS_'.$result['0'];
        }        
              
public function uploarData(Request $request){
   
    $data=$_POST['data'];
    $dta=parse_str($data, $array);
    
   
    $coupon=$array['coupon_code'];
    
    $cartData=Session::get('cart');
    
     if(!empty($cartData)){
     $total=0;$totalShipping=0;$total_mrp=0;$total_dp=0;$total_qty=0;$total_bv=0;
     $total_bussiness_value=0;
     foreach($cartData as $row){
          $filterData = DB::table('products')->where('id', $row['id'])->get();
          $totalShipping+=$filterData['0']->shipping_charge*$row['quantity'];
          $total_mrp+=$row['r_price']*$row['quantity'];
          $total_dp+= ($row['r_price']-$row['r_price']*$filterData[0]->discount/100)*$row['quantity'];
         
          $total+=($row['r_price']-$row['r_price']*$filterData[0]->discount/100)*$row['quantity'];
          $total_qty+=$row['quantity'];
          $total_bussiness_value+=$filterData['0']->business_value*$row['quantity'];
         
     }
    
     $dataa['total_mrp']=$total_mrp;
     $dataa['Totalshipping_charge']=$totalShipping;
     $dataa['total_dp']=$total_dp;
     
     $dataa['quantity']=$total_qty;
     $dataa['total_bv']=$total_bussiness_value;
     $dataa['invoice_date'] = $array['invoicedate'];
     $dataa['user_id']=$array['customer_id'];
     $dataa['created_at']=date('Y-m-d H:i:s');
     $dataa['created_date']=date('Y-m-d');
     //start invoice no ke liye
     
   
    
    if($coupon==''){
        $dataa['total']=$total;
        $dataa['coupon'] ='';
    }else{
    $dataa['coupon'] =  $coupon;
    $Couponresult=DB::table('coupons')->where('coupon_code', $coupon)->where('status', 1)->get();
    
    $ExpiryDate=$Couponresult['0']->expiry_date;
    $Expirytimestamp = strtotime($ExpiryDate);
    $Currentdate = date('Y-m-d');
    $Currenttimestamp = strtotime($Currentdate);   
    if($Currenttimestamp<=$Expirytimestamp){
    
    
    $res=DB::table('r_orders')->where('coupon', $coupon)->get();
  
    if(empty($res['0']->coupon)){
    
    if($Couponresult['0']->amount_type=='Percentage') {
         $cdiscount=$Couponresult['0']->amount;
         $totals=$total-($total*$cdiscount)/100;
         $dataa['total']=$totals;
         $dataa['coupon_amt']=($total*$cdiscount)/100;
    }
    if($Couponresult['0']->amount_type=='Flat') {
        $cdiscount=$Couponresult['0']->amount;
        $totals=$total-$cdiscount;
        $dataa['total']=$totals;
        $dataa['coupon_amt']=$cdiscount;
    }
    
    }else{
    
      echo 11;
      die;
    
    }
    
    }else{
      echo 10;
      die;
    }
    } 
     
    
       
     $result=DB::table('r_orders')->get();
   
     if(!empty($result[0])){
        $res=DB::table('r_orders')->orderBy('id', 'desc')->limit(1)->get();
        $invoice=$res[0]->invoice_no;
        $invoicee=substr($invoice, strrpos($invoice, '_') + 1);
        $numbers = $this->generate_numbers($invoicee+1, 1, 6);
        $dataa['invoice_no'] = $numbers;
     }else{
        $dataa['invoice_no']='NBG_000001';
     }  
     
     
     
     
     if(!empty($result[0])){
        $res=DB::table('r_orders')->orderBy('id', 'desc')->limit(1)->get();
        $order_id=$res[0]->order_id;
        $order_ids=substr($order_id, strrpos($order_id, '_') + 1);
        $numberss = $this->generate_ordernumbers($order_ids+1, 1, 6);
        $dataa['order_id'] = $numberss;
     }else{
        $dataa['order_id']='ORDS_100000';
     } 
     
     
     
     
     //end invoice no ke liye
     $dataa['payment_methods']=$array['payment_method'];
    //  $dataa['order_id'] = 'NBG' . $array['customer_id'] . '-' . date('dmyhis');
     
     $shipping_address = array(
        [
            'id' => '1',
            'user_id' => $array['customer_id'],
            'name' => $array['customer'],
            'mobile' => $array['customer_phonee'],
            'email' => $array['customer_emaill'],
            'address' => $array['customer_addresss'],
            'city' => $array['cityy'],
            'state' => $array['statee'],
            'zip' => $array['zipp']
        ]
        );
  
    $shipping_address = json_encode($shipping_address);
    $dataa['shipping_address']=$shipping_address;
    // $total_bv = $_POST['total_bv'];
    // $total_sp = $_POST['total_sp'];
    $dataa['products'] = $array['allproducts'];
 
    $dataa['payment_status'] = 'success';
   
    $dataa['transaction_id'] = '';   
    
    $user=DB::table('user')->where('id', $array['customer_id'] )->get();
    
    if($array['payment_method']=='wallet' and $total_dp<=$user['0']->saving_wallet) {
        
    DB::table('r_orders')->insert($dataa);
    $lastInsertId=DB::getPdo()->lastInsertId();
    
    if(!empty($lastInsertId)){
        $products2=count(Session::get('cart', array()));
   
        if ($products2 > 0) {
        foreach ($cartData as $item_product) {
                 
                 $product_id = $item_product['id'];
                 $quantity = $item_product['quantity'];
                 $stock=DB::table('product_stocks')->where('pid', $product_id)->get();
                 if($stock['0']->stock>0){
                     $udata=array('stock'=>$stock['0']->stock-$quantity,);
                     DB::table('product_stocks')->where('pid', $product_id)->update($udata);
                 }
               
            }
            
        $updateData=array(
        'saving_wallet'=>$user['0']->saving_wallet-$total_dp
        );
        DB::table('user')->where('id', $array['customer_id'])->update($updateData);
        
        $transactionData=array(
        
        'amount'=>$total_dp,
        'transaction_type'=>'debit',
        'from_id'=>$array['customer_id'],
        'to_id'=>$array['customer_id'],
        'description'=>'product purchased from saving wallet',
        
        );
        DB::table('transaction')->insert($transactionData);    
        echo 1;
        die;
        
        }
    }        
   }
    
    if($array['payment_method']=='cod'){
      
    DB::table('r_orders')->insert($dataa);
    $lastInsertId=DB::getPdo()->lastInsertId();
    
    if(!empty($lastInsertId)){
        $products2=count(Session::get('cart', array()));
        if ($products2 > 0) {
        foreach ($cartData as $item_product) {
                 $product_id = $item_product['id'];
                 $quantity = $item_product['quantity'];
                 $stock=DB::table('product_stocks')->where('pid', $product_id)->get();
                 if($stock['0']->stock>0){
                     $udata=array('stock'=>$stock['0']->stock-$quantity,);
                     DB::table('product_stocks')->where('pid', $product_id)->update($udata);
                 }
               
            }
            
                    $transactionData=array(
                               'amount'=>$total_dp,
                               'transaction_type'=>'debit',
                               'from_id'=>$array['customer_id'],
                               'to_id'=>$array['customer_id'],
                               'description'=>'product purchased from saving wallet',
                               
                            );
                    DB::table('transaction')->insert($transactionData);
                
                   echo 1;
                   die;
        }
    }        
  }    
      }else{
         echo 0;
     }
    }
    

public function deleteItemCart(Request $request){
    $id=$request->id;
    $Cart=Session::get('cart');
    unset($Cart[$id]);
    Session::put('cart', $Cart);
    $cdatass=Session::get('cart');
    
    $i=1;
    $total=0;
    $total_bv=0;
    foreach($cdatass as $row){
        $qty=$row['quantity'];
        $product=DB::table('products')->where('id', $row['id'])->get();
        $total+=($row['r_price']-$row['r_price']*$product[0]->discount/100)*$row['quantity'];
        $total_bv+=$product['0']->business_value;
           ?>
         <tr>
            <td style="text-align:center"><?php echo $i++;?></td>
          <td style="text-align:center"><input type='text'  name='name' value="<?php echo $row['name'];?>" id='name' readonly='readonly' /></td>
          <td style="text-align:center"><input type='number' min="1" name='quantity' value="<?php echo $row['quantity'];?>" id='quantity<?php echo $row['id']; ?>' onchange="updateQty(<?php echo $row['id']; ?>)"/></td>
          <td style="text-align:center" id='mrp<?php echo $row['id']; ?>'><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $row['r_price'];?></td>
          <td style="text-align:center" id='dp<?php echo $row['id']; ?>'><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $row['r_price']-$row['r_price']*$product[0]->discount/100;?></td>
          
          <td style="text-align:center" id='total<?php echo $row['id']; ?>'><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $row['r_price']-$row['r_price']*$product[0]->discount/100*$row['quantity'];?></td>
          <td style="text-align:center" id=''><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $row['quantity']*$total_bv; ?></td>
          <td style="text-align:center"><a onclick="deleteCartItem('<?php echo $row['id']?>')"><i class='fa fa-trash'></i></a></td>
       </tr>
           <?php } ?>
  
       <tr>
         
          <td style="text-align:center"></td>
          <td style="text-align:center"></td>
          <td style="text-align:center"></td>
          <td style="text-align:center"></td>
           <td style="text-align:center"></td>
          <td style="text-align:center">
              <input type='hidden' style="width: 200px;" name='allproducts' value="<?php print_r(json_encode($cdatass)); ?>" id='allproducts' />
              <input type='hidden' style="width: 200px;" name='total' value="<?php echo $total; ?>" id='total' />
          </td>
          <td style="text-align:center"><strong>Sub Total</strong></td>
          <td style="text-align:center" id='subtotal'>
                <i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo $total; ?>
          </td>
       </tr>
      


<?php
}


public function Qtyupdate(Request $request){
    
    $qty=$request->qty;
    $id=$request->id;
    $Cart=Session::get('cart');
    $qtyData=DB::table('product_stocks')->where('pid', $id)->get();
    $cdatass=Session::get('cart');
    if($qty<=$qtyData[0]->stock){
        $Cart[$id]['quantity']=$qty;
          Session::put('cart', $Cart);
    }    
    
      
   
   
    $subtotal=0;
    foreach($cdatass as $row){
    $qty=$row['quantity'];
    // $subtotal+=$row['DpAfterPercentageDiscount']*$row['quantity'];
    $product = DB::table('products')->where('id', $row['id'])->get();
    $subtotal+=($row['r_price']-$row['r_price']*$product[0]->discount/100)*$row['quantity'];
   
    }
    $products = DB::table('products')->where('id', $id)->get();
    $data['qty']=$cdatass[$id]['quantity'];
    $data['price']=($cdatass[$id]['r_price']-($cdatass[$id]['r_price']*$products[0]->discount/100))*$qty;
    $data['id']=$cdatass[$id]['id'];
    $data['subtotal']=$subtotal;
    echo json_encode($data);
    
 
}




public function searchFranchise(){

    $term=$_POST['sdata'];
    $filterData = DB::table('user')->where('first_name','LIKE','%'.$term.'%')->where('role','user')->orWhere('role','franchise')->offset(0)->limit(5)->get();
    
    foreach($filterData as $row){ ?>
      <input type="hidden" id="uid<?php echo $row->id; ?>" name="uid" value="<?php echo $row->id; ?>">
      <input type="hidden" id="name<?php echo $row->id; ?>"   value="<?php echo $row->name; ?>">
      <input type="hidden" id="address<?php echo $row->id; ?>" name="address" value="<?php echo $row->address; ?>">
      <input type="hidden" id="city<?php echo $row->id; ?>" name="city" value="<?php echo $row->city;echo ','; ?>">
      <input type="hidden" id="state<?php echo $row->id; ?>" name="state" value="<?php echo $row->state;echo ','; ?>">
      <input type="hidden" id="zip<?php echo $row->id; ?>" name="zip" value="<?php echo $row->zip; ?>">
      <input type="hidden" id="mobile<?php echo $row->id; ?>" name="mobile" value="<?php  echo $row->contact;?>">
      <input type="hidden" id="email<?php echo $row->id; ?>" name="email" value="<?php  echo $row->email; ?>">
      <input type="hidden" id="saveWallet<?php echo $row->id; ?>" name="saveWallet" value="<?php echo $row->saving_wallet; ?>">
      <li class="list-group-item" onclick="selectValss('<?php echo  $row->id; ?>')" id="aaa<?php echo  $row->id; ?>"> <?php echo $row->first_name; ?></li>
    <?php  }
  
}
}
