<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Image;


class FranchiseController extends Controller
{
    public function add_franchise(){
        $title='Add Franchise';
        $bussiness_setup=DB::table('business_setup')->get();
        $states=DB::table('states')->get();
        return view('admin.add-franchise', compact('title', 'bussiness_setup','states'));
    }

    public function edit_images(Request $request){
        $title='Edit Images';
        $id=$request->id;
        return view('admin.update-images', compact('title' , 'id' ));
    }
    public function testing(){
         return view('admin.Tessting');
    }
    public function getCities(Request $request){
         $id=$request->id;
         $result = DB::table('cities')->where( 'state_id', $id)->get();
        //  echo "<option value=''>--Select City--</option>";
         foreach($result as $row){
    ?>
        
        <option value="<?php echo  $row->city; ?>" ><?php echo $row->city; ?></option>
        
    <?php }  }
    
    
     public function getCitiess(Request $request){
         $id=$request->id;
         $result = DB::table('cities')->where( 'state_id', $id)->get();
        //  echo "<option value=''>--Select City--</option>";
         foreach($result as $row){
    ?>
        
        <option value="<?php echo  $row->city; ?>" <?php if($row->city==$request->cityname){?>selected<?php } ?>><?php echo $row->city; ?></option>
        
    <?php }  }
     public function getCouponCodeDiscount(Request $request){
            
            $code=$request->code;
            $result = DB::table('coupons')->where( 'coupon_code', $code)->where( 'status', 1)->get();
            
            if(!empty($result['0']->id)){
            $ExpiryDate=$result['0']->expiry_date;
            $Expirytimestamp = strtotime($ExpiryDate);
            $Currentdate = date('Y-m-d');
            $Currenttimestamp = strtotime($Currentdate);
           
            if($Currenttimestamp<=$Expirytimestamp){
             
             if($result['0']->amount_type=='Percentage'){
                $data['status']=1;
                $data['discount']=$result['0']->amount.'% Percentage Discount';
               
                $cdata=Session::get('cart');
                $subtotaAfterdiscount=0;
                 foreach($cdata as $row){
                        $subtotaAfterdiscount+=$row['DpAfterPercentageDiscount']*$row['quantity'];
                }
                $data['discounts']=$subtotaAfterdiscount-($subtotaAfterdiscount*$result['0']->amount/100);
                Session::put('discounts', $data['discounts']);
             }
             
             if($result['0']->amount_type=='Flat'){
                $data['status']=2;
                $data['discount']=$result['0']->amount.'  Rs Flat Discount';
            
                
                $cdata=Session::get('cart');
                $subtotaAfterdiscount=0;
                foreach($cdata as $row){
                $subtotaAfterdiscount+=$row['DpAfterPercentageDiscount']*$row['quantity'];
                }
                $data['discounts']=$subtotaAfterdiscount-$result['0']->amount;
                Session::put('discounts', $data['discounts']);
             }
             
            
            }
            else{
                  $data['status']=3;
                  $data['msg']='Coupon code has been expired.';
            }
            }else{
                 
                 $data['status']=00;
                 $data['msg']='';
            }
            
            echo json_encode($data);
    
    }
    
    

    public function FranchiseListOfFranchise(Request $request){
        
        $referal=$request->referal;
        $title='Franchise List';
        $data = DB::table('user')->where( 'role', 'franchise')->where( 'referal', $referal)->get();
        return view('admin.franchise-list' , compact('title', 'data'));
        
    }
    public function save_franchise(Request $request){
         $bussiness_setup=DB::table('business_setup')->get();
         if(!empty($bussiness_setup['0']->franchise_commission)) {
             
        $this->validate($request,[
            'name'=>'required',
            'first_name'=>'required',
            'franchise_discount'=>'required|numeric',
            'gender'=>'required',
            'contact'=>'required|numeric|min:10',
            'email'=>'required|email',
            'password'=>'required',
            'area'=>'required',
            'city'=>'required',
            'state'=>'required',
            'franchise_address'=>'required',
            'zip'=>'required|numeric',
          
            ]); 
            $commission=$request->franchise_discount;
         }else{
             $this->validate($request,[
            'name'=>'required',
            'first_name'=>'required',
            'gender'=>'required',
            'contact'=>'required|numeric|min:10',
            'email'=>'required|email',
            'password'=>'required',
            'area'=>'required',
            'city'=>'required',
            'state'=>'required',
            'franchise_address'=>'required',
            'zip'=>'required|numeric',
           
         ]);
             $commission='';
         }
         
        
       
        $anystring=env('COMPANY_PREFIX_NAME_VALUE');
        $rand = rand(0, 100000);
        $rawhashword = $anystring.$rand;
        $randss = rand(111111, 999999);
        $userid = $anystring.$randss;
        $data=array(
            'name'=>$request->name,
            'first_name'=>$request->first_name,
            'franchise_discount'=>$commission,
            'gender'=>$request->gender,
            'password'=>$request->password,
            'area'=>$request->area,
            'city'=>$request->city,
            'state'=>$request->state,
            'contact'=>$request->contact,
            'email'=>$request->email,
            'franchise_address'=>$request->franchise_address,
            'zip'=>$request->zip,
            'role'=>'franchise',
            'password'=>Hash::make($request->password),
            'userid'=>$userid,
            'referal'=>$request->pfranchise,
            'decrypted_password'=>$request->password

         );
        
        $user = DB::table('user')->where('email', $request->email)->orWhere('contact', $request->contact)->first();
        if(!empty($user->id)){
                        session()->flash('error',"There is already a franchise created in your name or contact and email.");  

           // Session::flash('message', '<p class="alert alert-danger" style="text-align:center">There is already a franchise created in your name.</p>');
            return redirect()->route('add-franchise');
            
          
        }else{
            DB::table('user')->insert($data);
            $lastInsertId=DB::getPdo()->lastInsertId();
            if(!empty($lastInsertId)){
                    $request->session()->flash('success',"Francise has been successfully added.");  
                //Session::flash('message', '<p class="alert alert-success" style="text-align:center">Francise has been successfully added.</p>');
                return redirect()->route('franchise-list');
            }
        }
    }
    
  
    public function save_category(Request $request){
      
        $bussiness_setup=DB::table('business_setup')->get();
        if(!empty($bussiness_setup['0']->category_commission)){
            $commission=$request->category_commission;
            $request->validate([
           'category_name'=>'required',
           'category_commission'=>'required|numeric',
           'category_image'=>'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        }else{
            $commission='';
            $request->validate([
           'category_name'=>'required',
           'category_image'=>'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        }
        
       
        $imageName = time().'.'.$request->category_image->extension();
        $request->category_image->move(public_path('assets/categoryImages'), $imageName);

        $data=array(
           'category_name'=>$request->category_name,
           'category_image'=>$imageName,
           'category_commission'=>$commission,
           'created_at'=>date('Y-m-d H:i:s'),
           'updated_at'=>date('Y-m-d H:i:s'),
        );
      

        DB::table('categories')->insert($data);
        $lastInsertId=DB::getPdo()->lastInsertId();
        if(!empty($lastInsertId)){
          $request->session()->flash('success',"Add Category has been Successfully "); 
             //return redirect()->back();
            return redirect()->route('category-list');
        }
       
  
   }


    public function franchise_list(){
        $title='Franchise List';
        $data = DB::table('user')->where( 'role', 'franchise')->get();
        return view('admin.franchise-list' , compact('title', 'data'));
    }


    public function category_list(){
        $title='Categories';
        // $referal='AP002';
        $bussiness_setup=DB::table('business_setup')->get();
        $data = DB::table('categories')->get();
        dd($data);
        return view('admin.category-list' , compact('title', 'data','bussiness_setup'));
    }


//   public function subcategory_list(){
//         $title='SubCategories';
//         // $referal='AP002';
//         $data = DB::table('subcategories')->get();
//         return view('admin.subcategory-list' , compact('title', 'data'));
//     }

  

    public function add_category(){
        $title='Add Category';
        $bussiness_setup=DB::table('business_setup')->get();
        return view('admin.add-category', compact('title', 'bussiness_setup'));
    }

   public function add_subcategory(){
        $title='Add Sub Category';
        return view('admin.add-subcategory', compact('title'));
    }
 
    
    public function supplier_list(){
        $title='Supplier List';
        // $referal='AP002';
        $data = DB::table('user')->where('referal','AP002')->where( 'role', 'franchise')->get();
        return view('admin.supplier-list' , compact('title', 'data'));
    }

    public function edit_category(Request $request){
        $title='Edit Category';
        $id=$request->id;
        $bussiness_setup=DB::table('business_setup')->get();
        $data = DB::table('categories')->where('id', $id)->get();
        // print_r($data);die;
        return view('admin.add-category', compact('id', 'title', 'data', 'bussiness_setup'));
    }

    public function add_supplier(){
        $title='Add Supplier';
        return view('admin.add-supplier', compact('title'));
    }

    
    public function update_category(Request $request){

        $id=$request->id;

       
        $bussiness_setup=DB::table('business_setup')->get();
         if(!empty($bussiness_setup['0']->category_commission)){
                
                $commission=$request->category_commission;
                $request->validate([
                'category_name'=>'required',
                'category_commission'=>'required|numeric',
                ]);
         
                
            }else{
                
                $commission='';
                $request->validate([
                'category_name'=>'required',
                ]);
         
            }
         

         if(empty($request->category_image)){
                
            $data=array(
                'category_name'=>$request->category_name,
                'category_commission'=>$commission,
                'updated_at'=>date('Y-m-d H:i:s'),
                );
                DB::table('categories')->where('id', $id)->update($data);
                $request->session()->flash('success',"Category has been successfully updated."); 
             //return redirect()->back();
               // $request->session()->put('message', '<p class="alert alert-success" style="text-align:center">Category has been successfully updated.</p>');
                return redirect()->route('category-list');
         }else{
                $imageName = time().'.'.$request->category_image->extension();
                $deletedImage=public_path('assets/categoryImages').'/'.$request->category_oldimage;
                $request->category_image->move(public_path('assets/categoryImages'), $imageName);
                $data=array(

                'category_name'=>$request->category_name,
                'category_commission'=>$commission,
                'updated_at'=>date('Y-m-d H:i:s'),
                'category_image'=>$imageName,

                );
                
                unlink($deletedImage);
                DB::table('categories')->where('id', $id)->update($data);
                  $request->session()->flash('success',"Category has been  successfully updated."); 
            // return redirect()->back();
               // $request->session()->put('message', '<p class="alert alert-success" style="text-align:center">Category has been successfully updated.</p>');
                return redirect()->route('category-list');
         }
         
    }
 
    public function uploadBulkImage(Request $request){

        $imagesss = new Image;
        $request->validate([
            'image' => 'required',
            'image.*' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
            $image_array = array();
            if (!empty($request->file('image'))) {
             $i = 2;
            foreach ($request->file('image') as $image) {
                
                $file = $image;
                $filename =  "PRO" . $i . time() . "." .  strtoupper($file->getClientOriginalExtension());
                $file->move("productImages", $filename);
                $data=array(
                    'image'=>$filename,
                    'p_id'=>$request->pid,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                );
                DB::table('images')->insert($data);
                $lastInsertId=DB::getPdo()->lastInsertId();
                // array_push($image_array, $filename);
                $i++;
            }
            

            if ($lastInsertId) {
                Session::flash('message', "<p class='alert alert-success'>Bulk Images has been successfully uploaded.</p><br>");
                return redirect('edit_images/'.$request->pid);
            } else {
                Session::flash('message', "!Sorry data not inserted.");
                return redirect('edit_images/'.$request->pid);
            }


            }
    }
     
    // public function delete_category(Request $request){
    //     $id=$request->id;
    //     $cdata=DB::table('categories')->where('id', $id)->get();
    //     $cimage=$cdata['0']->category_image;
    //     $deletedImage=public_path('assets/categoryImages').'/'.$cimage;
    //      if(file_exists($deletedImage)){
    //     unlink($deletedImage);
    //   }
    //     DB::table('categories')->where('id', $id)->delete();
    //     $deletes=DB::table('subcategories')->where('category_id', $id)->update(['category_id'=>'0']);

    //                       $request->session()->flash('success',"Category has been successfully deleted."); 

    //     // Session::flash('message', '<p class="alert alert-success" style="text-align:center">Category has been successfully deleted.</p>');
    //     return redirect()->route('category-list');
    // }

     


    
    public function delete_franchise(Request $request){
        $id=$request->id;
        DB::table('user')->where('id', $id)->delete();
         $request->session()->flash('success',"Record has been successfully deleted."); 
       // $request->session()->put('message', '<p class="alert alert-success" style="text-align:center">Record has been successfully deleted.</p>');
        return redirect()->route('franchise-list');
    }
    

    public function edit_franchise(Request $request){
        $states=DB::table('states')->get();
        $bussiness_setup=DB::table('business_setup')->get(); 
        $title='Edit Franchise';
        $id=$request->id;
        $data = DB::table('user')->where('id', $id)->get();
        
        // print_r($data);die;
        return view('admin.add-franchise', compact('id', 'title', 'data', 'bussiness_setup', 'states'));
     }



     public function update_franchise(Request $request){
      
        $bussiness_setup=DB::table('business_setup')->get();  
      
        $bussiness_setup=DB::table('business_setup')->get();
         if(!empty($bussiness_setup['0']->franchise_commission)) {
             $request->validate([
           'name'=>'required',
           'first_name'=>'required',
           'gender'=>'required',
           'contact'=>'required|numeric|min:10',
           'email'=>'required|email',
        
           'area'=>'required',
           'city'=>'required',
           'state'=>'required',
           'franchise_address'=>'required',
           'zip'=>'required|numeric',
        ]); 
            $commission=$request->franchise_discount;
         }else{
            $request->validate([
           'name'=>'required',
           'first_name'=>'required',
           'gender'=>'required',
           'contact'=>'required|numeric|min:10',
           'email'=>'required|email',
        
           'area'=>'required',
           'city'=>'required',
           'state'=>'required',
           'franchise_address'=>'required',
           'zip'=>'required|numeric',
        ]);
             $commission='';
         }
         
      
      
      
       
       $id=$request->id;
       if(empty($commission)){
            $user=DB::table('user')->where('id', $id)->get();
            $fdiscount=$user['0']->franchise_discount;
       }else{
            $fdiscount=$commission;
       } 
       
       $data=array(

           'name'=>$request->name,
           'first_name'=>$request->first_name,
           'franchise_discount'=>$fdiscount,
           'gender'=>$request->gender,
           'area'=>$request->area,
           'city'=>$request->city,
           'state'=>$request->state,
           'contact'=>$request->contact,
           'email'=>$request->email,
           'franchise_address'=>$request->franchise_address,
           'zip'=>$request->zip,
          

        );
       
        DB::table('user')->where('id', $id)->update($data);
          $request->session()->flash('success',"franchise has been successfully updated.");
        //Session::flash('message', '<p class="alert alert-success" style="text-align:center">Record has been successfully updated.</p>');
        return redirect()->route('franchise-list');

   }
   
   public function getFranchiseDiscountPercentage(Request $request){
    
    $dataArray=array();
    $id=$request->id;
    $res=DB::table('user')->where('id', $id)->get();
    $d=$res['0']->franchise_discount;
    $userid=$res['0']->userid;
    for($i=1;$i<25;$i++)   {
        if($d==$i){

            $dataArray['commission']=$d;
            $dataArray['uid']=$userid;
            echo json_encode($dataArray);

        }
    }
   }

  

public function allproducts(){

    //   $cart = Session::get('cart');
    //     if($cart){
    //          //Session::forget('cart');
    //          return redirect()->route('create_invoice');
    //     }else{
            
            $bussiness_setup=DB::table('business_setup')->get();
            $title='Sales';
            $subtitle='Create Invoice';
            $data=DB::table('products')->paginate(10);
            // $data = DB::table('products')->get();
            return view('admin.all-products' , compact('title', 'data', 'subtitle','bussiness_setup'));
        // }



       
    }


 public function getusersavingwalletAmount(){
        $id = $_POST['user_id'];
        $user_data =DB::table('user')->where('id', $id)->get();
        return response()->json($user_data);
 }

public function adminOrder(Request $request){

    $request->validate([
        'search_client'=>'required',
        'invocieno'=>'required',
        'invoicedate'=>'required',
        'notes'=>'required'
       
     ]);
   
echo "<pre>";;
print_r($_POST);die;
$payment_methods = $_POST['payment_method'];
$user_id = $_POST['uid'];
$sell_from = $_POST['address'];

$order_id = 'NBG' . $user_id . '-' . date('dmyhis');
$name = $_POST['city'];
$mobile = $_POST['state'];
$address = $_POST['zip'];
$city = $_POST['mobile'];
$state = $_POST['email'];
$pin_code = $_POST['saveWallet'];
$quantity = $_POST['customer_id'];


$city = $_POST['invocieno'];
$state = $_POST['invoicedate'];
$pin_code = $_POST['bill_type'];
$quantity = $_POST['quantity'];

$state = $_POST['price'];
$pin_code = $_POST['sp'];
$quantity = $_POST['bv'];

$state = $_POST['amount'];


$total = $_POST['total'];
$total_bv = $_POST['total_bv'];
$total_sp = $_POST['total_sp'];
$products = $_POST['products'];

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


// $sql = "INSERT INTO `r_orders`(`user_id`, `order_id`, `shipping_address`, `products`, `quantity`, `total`, `total_bv`,`total_sp`, `payment_methods`, `coupon`, `shipping_charge`, `order_status`, `transaction_id`, `landmark`, `cancellation_request`, `payment_status`, `service_type`, `sell_from`,`invoice_date`,`invoice_no`) VALUES ('$user_id','$order_id','$shipping_address','$products','$quantity','$total','$total_bv',$total_sp,'$payment_methods','$coupon','$shipping_charge','received','$transaction_id','$landmark','no','$payment_status','General Service','$sell_from','$invoice_date','$invoice_no')";
    // $request->validate([
    //     'category_id'=>'required|numeric',
    //     'name'=>'required',
    //     'mrp'=>'required|numeric',
    //     'f_price'=>'required|numeric',
    //     'r_price'=>'required|numeric',
    //     'discount'=>'required|numeric',
    //     'flat_discount'=>'numeric',
    //     'unit'=>'required',
    //     'size'=>'required',
    //     'quantity'=>'required|numeric',
    //     'sku_code'=>'required',
    //     'business_value'=>'required',
    //     'description'=>'required',
    //      // 'images' => 'required|mimes:jpg,png,jpeg,gif,svg'
    //  ]);
 
    // $data=array(

    //  'category_id'=>$request->category_id,
    //  'name'=>$request->name,
    //  'mrp'=>$request->mrp,
    //  'f_price'=>$request->f_price,
    //  'r_price'=>$request->r_price,
    //  'discount'=>$request->discount,
    //  'flat_discount'=>$request->flat_discount,
    //  'unit'=>$request->unit,
    //  'size'=>$request->size,
    //  'gst'=>$request->gst,
    //  'quantity'=>$request->quantity,
    //  'sku_code'=>$request->sku_code,
    //  'business_value'=>$request->business_value,
    //  'description'=>$request->description,
    //  'created_at'=>date('Y-m-d H:i:s'),
    //  'updated_at'=>date('Y-m-d H:i:s')
    
    // );
    
    // DB::table('products')->insert($data);
    // $lastInsertId=DB::getPdo()->lastInsertId();
    // $i=1;
    // if(!empty($lastInsertId)){
          
    //      $imageName = "PRO" . $i . time() . "." . strtoupper($request->image->extension());
    //      $request->image->move(public_path('productImages'), $imageName);
    //      $datass=array(
    //          'image'=>$imageName,
    //          'p_id'=>$lastInsertId,
    //          'created_at'=>date('Y-m-d H:i:s'),
    //          'updated_at'=>date('Y-m-d H:i:s'),
    //      );
    //      DB::table('images')->insert($datass);
    //      $request->session()->put('message', '<p class="alert alert-success" style="text-align:center">Record has been successfully added.</p>');
    //      return redirect()->route('product-list');
    // }
     
 }



}
