<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GenerateInvoicController extends Controller
{
    public function create_invoice(){
        $title='Create Invoice';
        $lastRecord=DB::table('r_orders')->orderBy('id', 'desc')->first();
        $lastRecord->invoice_no;
        $invoiceno= substr($lastRecord->invoice_no, strpos($lastRecord->invoice_no, "_") + 1);
        return view('admin/create-invoice' , compact('title', 'invoiceno'));
    }

    public function searchClient(){
                $term=$_POST['sdata'];
                $filterData = DB::table('user')->where('first_name','LIKE','%'.$term.'%')->get();
                
                foreach($filterData as $row){ ?>
                  <input type="hidden" id="uid<?php echo $row->id; ?>" name="uid" value="<?php echo $row->id; ?>">
                  <input type="hidden" id="name<?php echo $row->id; ?>" name="name"  value="<?php echo $row->name; ?>">
                  <input type="hidden" id="address<?php echo $row->id; ?>" name="address" value="<?php echo $row->address; ?>">
                  <input type="hidden" id="city<?php echo $row->id; ?>" name="city" value="<?php echo $row->city;echo ','; ?>">
                  <input type="hidden" id="state<?php echo $row->id; ?>" name="state" value="<?php echo $row->state;echo ','; ?>">
                  <input type="hidden" id="zip<?php echo $row->id; ?>" name="zip" value="<?php echo $row->zip; ?>">
                  <input type="hidden" id="mobile<?php echo $row->id; ?>" name="mobile" value="<?php  echo $row->contact;?>">
                  <input type="hidden" id="email<?php echo $row->id; ?>" name="email" value="<?php  echo $row->email; ?>">
                  <input type="hidden" id="saveWallet<?php echo $row->id; ?>" name="saveWallet" value="<?php echo $row->saving_wallet; ?>">
                  
                  <li class="list-group-item" onclick="selectVal('<?php echo  $row->id; ?>')" id="aaa<?php echo  $row->id; ?>"> <?php echo $row->first_name; ?></li>
                <?php  }
                
        }
        
public function getData(Request $request){
   
    $result=DB::table('products')->get();
	// $output['res'] = 'success';
	// $output['msg'] = 'Data  found';
	$output['data'] = $result;
	echo json_encode($output);

} 

public function get_product_details(Request $request){
    
     $pid=$request->product_id;
     $filterData=DB::table('products')->where('id', $pid)->get();
     return response()->json($filterData);
}


public function getAllTypeDiscount(Request $request){
    
    $dis=$request->discount;
    if($dis=='flat_discount'){
         $filterDatasss=DB::table('products')->get();
         $output['flat_discount'] = $filterDatasss['0']->flat_discount;
    }
    if($dis=='discount'){
         $filterDatasss=DB::table('products')->get();
         $output['discount'] = $filterDatasss['0']->flat_discount;
    }
     
    $filterData=DB::table('products')->get();
    $output['data'] = $filterData;
    echo json_encode($output);
    
}



public function adminOrder(Request $request){

    $request->validate([
        'search_client'=>'required',
        'invocieno'=>'required',
        'invoicedate'=>'required',
        'notes'=>'required'
       
     ]);
   

$user_id = $_POST['customer_id'];
// echo "<pre>";
// echo print_r($_POST);die;
$payment_status = 'success';
$coupon = '';
$shipping_charge = '0';
$transaction_id = '';
$landmark = '';
$last_id = '';


$payment_methods ='COD';
$sell_from = $_POST['sell_from'];
$order_id = 'NBG' . $user_id . '-' . date('dmyhis');
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$address = $_POST['customer_address'];
$city = $_POST['city'];
$state = $_POST['state'];
$pin_code = $_POST['zip'];
$quantity = $_POST['quantity'];
$total = $_POST['total'];
$total_bv = $_POST['total_bv'];
$total_sp = $_POST['total_sp'];
$products = $_POST['products'];
$invoice_date = $_POST['invoicedate'];
$invoice_no = $_POST['invocieno'];
$payment_status = 'success';
$coupon = '';
$shipping_charge = '0';
$transaction_id = '';
$landmark = '';
$last_id = '';

$shipping_address = array(
  [
    'id' => '1',
    'user_id' => $user_id,
    'name' => $name,
    'mobile' => $mobile,
    'address' => $address,
    'city' => $city,
    'state' => $state,
    'pin_code' => $pin_code
  ]
);
$shipping_address = json_encode($shipping_address);


$data=array(
            'user_id'=>$user_id, 
            'order_id'=>$order_id,
            'shipping_address'=>$shipping_address,
            'products'=>$products,
            'quantity'=>$quantity,
            'total'=>$total,
            'total_bv'=>$total_bv,
            'total_sp'=>$total_sp,
            'payment_methods'=>$payment_methods,
            'coupon'=>$coupon,
            'shipping_charge'=>$shipping_charge,
            'order_status'=>'received',
            'transaction_id'=>$transaction_id,
            'landmark'=>$landmark,
            'cancellation_request'=>'no',
            'payment_status'=>$payment_status,
            'service_type'=>'General Service',
            'sell_from'=>$sell_from,
            'invoice_date'=>$invoice_date,
            'invoice_no'=>$invoice_no

);
$products2 = json_decode($products,1);

if (count($products2) > 0) {
  
    foreach ($products2 as $key=>$item_product) {
       
      $product_id = $item_product[0]['id'];
      $filterData=DB::table('products')->where('id', $product_id)->get();
     echo  $quantity = $item_product[0]['quantity'];
    //   $datass=array(
    //         'quantity'=>$filterData['0']->quantity-$quantity
    //       );
    //   DB::table('products')->where('id' , $product_id)->update($datass);
      
    }
  }
  
die;  
DB::table('r_orders')->insert($data);
$lastInsertId=DB::getPdo()->lastInsertId();
if(!empty($lastInsertId)){
          
    $products2 = json_decode($products,1);
    $last_id = $lastInsertId;

//   $cart_items_products = $conn->query("SELECT * FROM `cart_items` WHERE user_id=$sell_from");
  if (count($products2) > 0) {
    foreach ($products2 as $item_product) {
      $product_id = $item_product['id'];
      $quantity = $item_product['quantity'];
      $conn->query("UPDATE `tbl_product` SET quantity=quantity-$quantity WHERE `id`=$product_id");
    }
  }

  //$conn->query("DELETE FROM `cart_items` WHERE user_id=$sell_from");



  if($payment_methods == 'wallet') {
    $conn->query("UPDATE `user` SET saving_wallet=saving_wallet-$total WHERE `id`=$user_id");
    $transction_sql = "INSERT INTO `transaction`(`amount`, `transaction_type`, `from_id`, `to_id`, `description`) VALUES ('$total','debit','$user_id','$user_id','product purchased from saving wallet')";
    $conn->query($transction_sql);
  }
  
  $app_config = $conn->query("SELECT * FROM `app_config` WHERE id=1")->fetch_assoc();
  $cash_back_percent = $app_config['cash_back'];
  $magic_bonus_upline_percent = $app_config['magic_bonus_upline'];
  $magic_bonus_left_percent = $app_config['magic_bonus_left'];
  $magic_bonus_right_percent = $app_config['magic_bonus_right'];
  $franchise_referal_percent = $app_config['franchise_referal'];

  $cash_back_amt = ($total_bv * $cash_back_percent) / 100;
  
  
  $cash_back_sql = "INSERT INTO `repurchase_history`(`user_id`, `amount`, `order_id`, `description`,`type`) VALUES ('$user_id','$cash_back_amt','$last_id','cash back income','self_purchase_bonus')";
  $conn->query($cash_back_sql);
  
  $repurchase_income_update = "UPDATE `repurchase_income` SET `cash_back`=cash_back+$cash_back_amt WHERE `user_id`=$user_id";
  $conn->query($repurchase_income_update);
  
  $user_wallet_update = "UPDATE `user` SET `withdrawl_wallet`=withdrawl_wallet+$cash_back_amt WHERE `id`=$user_id";
  $conn->query($user_wallet_update);
  
  echo "<script>alert('Order Placed Successfully');window.location.href='../html/admin/order_history.php';</script>";
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//+++++++++++++++++++++++++++++++++ repurchesh bonus  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//

// $users = $conn->query("SELECT * FROM `user` WHERE role='user'");
// if($users->num_rows > 0) {
    
//     while($user = $users->fetch_assoc()) {
//         $user_id = $user['id'];
        
//         $left_active = $right_active = $left_inactive = $right_inactive = $left_business = $right_business = 0;
        // $repurchase_income = [];
        
        // $self_sv = $conn->query("SELECT SUM(total_bv) as total from `r_orders` where user_id='$user_id'")->fetch_assoc();
        // $exit_bv = $conn->query("SELECT SUM(left_bv) as total from `repurchase_history` where user_id='$user_id'")->fetch_assoc();
        // $exitbv= $exit_bv['total'];
        // $all_self_sv= $self_sv['total'];
        // $star_user = $conn->query("SELECT * FROM `star_user` WHERE userid=$user_id")->fetch_assoc();
        // // echo $star_user['userid'];
        
       
        
        // $b2 = new Btree();
        
        // $left_right_users = $b2->getLeftRightUsers($conn,$star_user,$star_user);
        // $left_right_users_business = $b2->getLeftRightBusiness($conn,$left_right_users);
        
        
        // for($i=0; $i<count($left_right_users['left']); $i++) {
        //     $left_user_id = $left_right_users['left'][$i];
        //     // echo "left-".$left_user_id."<br>";
        //     if($left_user_id>0){
        //         $query=$conn->query("SELECT SUM(total_bv) AS total FROM r_orders WHERE user_id='$left_user_id'")->fetch_assoc();
        //         $left_business += $query['total'];
                
        //     }
          
        //   }
        //   echo $left_business.'<br>';
    
        //   for($i=0; $i<count($left_right_users['right']); $i++) {
        //     $right_user_id = $left_right_users['right'][$i];
        //      if($right_user_id>0){
        //         $query=$conn->query("SELECT SUM(total_bv) AS total FROM r_orders WHERE user_id='$right_user_id'")->fetch_assoc();
        //         $right_business += $query['total'];
                
        //     }
            
        //   }
        //   echo $right_business.'<br>';
    
        //     if ($left_business > $right_business) {
        //     $left_carry_forward = $left_business - $right_business;
        //     $common_pv = $right_business;
        //     // $leftpv=$leftpv-$rightpv;
        //       } else if ($left_business < $right_business) {
        //     $right_carry_forward = $right_business - $left_business;
        //     $common_pv = $left_business;
        //     // $rightpv=$rightpv-$leftpv;
        //      } else {
        //     $common_pv = $left_business;
        //     //   $leftpv=0;
        //     //   $rightpv=0;
        //    }
        //  $allcomon= $common_pv-$exitbv;
        
        
        // $repuchase_level_settings = $conn->query("SELECT * FROM `repuchase_level_settings`");
        // if($repuchase_level_settings->num_rows > 0) {
        //     while($repuchase_level_setting = $repuchase_level_settings->fetch_assoc()) {
        //         $level_no = $repuchase_level_setting['id'];
        //         $level_name = $repuchase_level_setting['level_name'];
        //         $target_bv = $repuchase_level_setting['target_bv'];
        //         $reward = $repuchase_level_setting['reward'];
        //         $level_cap = $repuchase_level_setting['count'];
        //         $team_matching_business = $repuchase_level_setting['team_matching_business'];
                
        //        if($common_pv>=$team_matching_business){
        //            if($level_name=='STAR' && $common_pv<=9999 && $all_self_sv=$target_bv){
                       
        //               $amount=$allcomon*$level_cap/100;
        //             //   echo $amount;
        //             if($amount==0){
                        
        //             }else{
        //                 $sql = "INSERT INTO `repurchase_history`(`user_id`, `amount`, `left_bv`, `right_bv`, `description`,`type`,`reward`) VALUES ('$user_id','$amount','$allcomon','$allcomon','$level_name','r_income','$reward')";
        //                       $conn->query($sql);
        //             }
                      
        //            }
                //    elseif($level_name=='SILVER' && $common_pv<=29999 && $all_self_sv=$target_bv){
                //    $amount=$allcomon*$level_cap/100;
                   
                //       if($amount==0){
                        
                //     }else{
                //         $sql = "INSERT INTO `repurchase_history`(`user_id`, `amount`, `left_bv`, `right_bv`, `description`,`type`,`reward`) VALUES ('$user_id','$amount','$allcomon','$allcomon','$level_name','r_income','$reward')";
                //               $conn->query($sql);
                //     }
                //    }
                //   elseif($level_name=='GOLD' && $common_pv<=119999 && $all_self_sv=$target_bv){
                //     $amount=$allcomon*$level_cap/100;
                   
                //       if($amount==0){
                        
                //     }else{
                //         $sql = "INSERT INTO `repurchase_history`(`user_id`, `amount`, `left_bv`, `right_bv`, `description`,`type`,`reward`) VALUES ('$user_id','$amount','$allcomon','$allcomon','$level_name','r_income','$reward')";
                //               $conn->query($sql);
                //     }
                //    }
                //    elseif($level_name=='PLATINUM' && $common_pv<=299999 && $all_self_sv=$target_bv){
                //     $amount=$allcomon*$level_cap/100;
                   
                //       if($amount==0){
                        
                //     }else{
                //         $sql = "INSERT INTO `repurchase_history`(`user_id`, `amount`, `left_bv`, `right_bv`, `description`,`type`,`reward`) VALUES ('$user_id','$amount','$allcomon','$allcomon','$level_name','r_income','$reward')";
                //               $conn->query($sql);
                //     }
                //   }
                //    elseif($level_name=='RUBY' && $common_pv<=1249999 && $all_self_sv=$target_bv){
                //     $amount=$allcomon*$level_cap/100;
                   
                //       if($amount==0){
                        
                //     }else{
                //         $sql = "INSERT INTO `repurchase_history`(`user_id`, `amount`, `left_bv`, `right_bv`, `description`,`type`,`reward`) VALUES ('$user_id','$amount','$allcomon','$allcomon','$level_name','r_income','$reward')";
                //               $conn->query($sql);
                //     }
                //   }
                //    elseif($level_name=='EMRALD' && $common_pv<=4999999 && $all_self_sv=$target_bv){
                //     $amount=$allcomon*$level_cap/100;
                   
                //       if($amount==0){
                        
                //     }else{
                //         $sql = "INSERT INTO `repurchase_history`(`user_id`, `amount`, `left_bv`, `right_bv`, `description`,`type`,`reward`) VALUES ('$user_id','$amount','$allcomon','$allcomon','$level_name','r_income','$reward')";
                //               $conn->query($sql);
                //     }
                //   }
                //    elseif($level_name=='DAIMOND' && $common_pv<=9999999 && $all_self_sv=$target_bv){
                //     $amount=$allcomon*$level_cap/100;
                   
                //       if($amount==0){
                        
                //     }else{
                //         $sql = "INSERT INTO `repurchase_history`(`user_id`, `amount`, `left_bv`, `right_bv`, `description`,`type`,`reward`) VALUES ('$user_id','$amount','$allcomon','$allcomon','$level_name','r_income','$reward')";
                //               $conn->query($sql);
                //     }
                //   }
                //    elseif($level_name=='CROWN' && $common_pv<=49999999 && $all_self_sv=$target_bv){
                //     $amount=$allcomon*$level_cap/100;
                   
                //       if($amount==0){
                        
                //     }else{
                //         $sql = "INSERT INTO `repurchase_history`(`user_id`, `amount`, `left_bv`, `right_bv`, `description`,`type`,`reward`) VALUES ('$user_id','$amount','$allcomon','$allcomon','$level_name','r_income','$reward')";
                //               $conn->query($sql);
                //     }
                //   }
                //    elseif($level_name=='PRESIDENT' && $common_pv>49999999 && $all_self_sv=$target_bv){
                //     $amount=$allcomon*$level_cap/100;
                   
                //       if($amount==0){
                        
                //     }else{
                //         $sql = "INSERT INTO `repurchase_history`(`user_id`, `amount`, `left_bv`, `right_bv`, `description`,`type`,`reward`) VALUES ('$user_id','$amount','$allcomon','$allcomon','$level_name','r_income','$reward')";
                //               $conn->query($sql);
                //     }
                //   }
                 
        //        }
        //     } 
        // }
        // echo "$user_id--->done<br/>";
    // }
}



}
