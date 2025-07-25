<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
 
use App\Http\Controllers\Controller;
 
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;


class ProductController extends Controller
{
    
    public function edit_images(Request $request){
        $title='Edit Images';
        $id=$request->id;
        return view('admin.update-images', compact('title' , 'id' ));
    }
    
    public function save_product(Request $request){
        // dd($request);
      $request->validate([
          'category_id'=>'required|numeric',
          'product_name'=>'required',
          'mrp'=>'required|numeric',
          'size'=>'required',
          'stock'=>'required',
          'sku_code'=>'required',
          'rating'=>'required',
          'business_value'=>'required',
          'description'=>'required',
         'image' => 'required|mimes:jpg,png,jpeg,gif,svg'
        ]);
       
       if($request['discount_type']=='percent'){
            $percent_discount=$request['percent_discount']??null;
            $dp=$request['mrp']-$request['mrp']*$percent_discount/100;
            $flat_discount=null;
        }elseif($request['discount_type']=='flat'){
             $flat_discount=$request['flat_discount']??null;
              $dp=$request['mrp']-$flat_discount;
              $percent_discount=null;
        }else{
             $flat_discount=null;
              $percent_discount=null;
            $dp=$request->mrp;
        }
        
        if(isset($request['first_or_repurchase'])){
            $first_or_repurchase='first';
        }else{
            $first_or_repurchase='repurchase';
        }
       $data=array(
        'first_or_repurchase'=>$first_or_repurchase,
        'category_id'=>$request->category_id,
        'subcategory_id'=>$request->subcategory_id,
        'product_name'=>$request->product_name,
        'first_or_repurchase'=>$first_or_repurchase,
        'mrp'=>$request->mrp,
        'percent_discount'=>$percent_discount,
        'flat_discount'=>$flat_discount,
        'discount_type'=>$request->discount_type,
        'dp'=>$dp,
        'gst'=>$request->gst,
        'sku_code'=>$request->sku_code,
        'business_value'=>$request->business_value,
        'rating'=>$request->rating,
        'description'=>$request->description,
        'created_at'=>date('Y-m-d H:i:s'),
        'updated_at'=>date('Y-m-d H:i:s'),
        'created_date'=>date('Y-m-d'),
        'updated_date'=>date('Y-m-d')
       );
    //   print_r($data);die;
       DB::table('products')->insert($data);
       $lastInsertId=DB::getPdo()->lastInsertId();
       $i=1;
       if(!empty($lastInsertId)){
            $imageName = "PRO" . $i . time() . "." . strtoupper($request->image->extension());
            $request->image->move(public_path('productImages'), $imageName);
            $datass=array(
                'image'=>$imageName,
                'pid'=>$lastInsertId,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            );
            DB::table('product_images')->insert($datass);
             $stock_size=array(
                'pid'=>$lastInsertId,
                'size'=>$request->size,
                'stock'=>$request->stock,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            );
            DB::table('product_stocks')->insert($stock_size);
           $request->session()->flash('success',"Record has been successfully added.");  
            //$request->session()->put('message', '<p class="alert alert-success" style="text-align:center">Record has been successfully added.</p>');
            return redirect()->route('product-list');
       }
        
    }

    public function GenerateInvoice(Request $request){
        $id=Auth::user()->id;
        $OrderId=$request->id;
        $data=DB::table('business_setup')->where('id' , $id)->get();
        $r_orders=DB::table('r_orders')->where('id' , $OrderId)->get();
        return view('admin.GenerateInvoice', compact('data', 'r_orders'));
    }

    public function updateImage(Request $request){
        $id=$request->imageid;
        $request->oldimage;
        $i=substr($request->oldimage, 3, 1); 
        if(!empty($request->image)){ 
        
        $imageName = "PRO" . $i . time() . "." . strtoupper($request->image->extension());
        $request->image->move(public_path('productImages'), $imageName);
        $data=array(
            'image'=>$imageName,
        );
        DB::table('product_images')->where('id' , $id)->update($data);
        $deletedImage=public_path('productImages').'/'.$request->oldimage;
        unlink($deletedImage);
        $request->session()->put('message', '<p class="alert alert-success" style="text-align:center">Record has been successfully updated.</p>');
        return redirect()->route('product-list');
      } 
         
     }

    public function update_product(Request $request){
        $id=$request->id;
        //  dd($request);
        // $request->validate([
        //     'category_id'=>'required|numeric',
        //     'name'=>'required',
        //     'mrp'=>'required|numeric',
        //     'discount'=>'numeric',
        //     'flat_discount'=>'numeric',
        //     'unit'=>'required',
        //     'size'=>'required',
        //     'quantity'=>'required|numeric',
        //     'sku_code'=>'required',
        //     'business_value'=>'required',
        //     'description'=>'required',
        //     'stock'=>'required'
        //  ]);
        //  dd($request->discount-type);
         if(isset($request['first_or_repurchase'])){
            $first_or_repurchase='first';
        }else{
            $first_or_repurchase='repurchase';
        }
        if($request['discount_type']=='percent'){
            $percent_discount=$request['percent_discount']??null;
            $dp=$request['mrp']-$request['mrp']*$percent_discount/100;
            $flat_discount=null;
        }elseif($request['discount_type']=='flat'){
             $flat_discount=$request['flat_discount']??null;
              $dp=$request['mrp']-$flat_discount;
              $percent_discount=null;
        }else{
             $flat_discount=null;
              $percent_discount=null;
            $dp=$request->mrp;
        }
        $data=array(
         'category_id'=>$request->category_id,
          'subcategory_id'=>$request->subcategory_id,
         'product_name'=>$request->product_name,
         'dp'=>$dp,
         'first_or_repurchase'=>$first_or_repurchase,
         'mrp'=>$request->mrp,
         'discount_type'=>$request->discount_type,
         'percent_discount'=>$percent_discount,
         'flat_discount'=>$flat_discount,
         'gst'=>$request->gst,
         'sku_code'=>$request->sku_code,
         'rating'=>$request->rating,
         'business_value'=>$request->business_value,
         'description'=>$request->description,
         'updated_at'=>date('Y-m-d H:i:s'),
         'updated_date'=>date('Y-m-d')
        );
        
    //   print_r($data);die;
        DB::table('products')->where('id', $id)->update($data);
        $data1=array(
             'size'=>$request->size,
            'stock'=>$request->stock ,
            'updated_at'=>date('Y-m-d H:i:s')
            );
        DB::table('product_stocks')->where('pid', $id)->update($data1);
            $request->session()->flash('success',"Record has been successfully updated"); 
            //$request->session()->put('message', '<p class="alert alert-success" style="text-align:center">Record has been successfully updated.</p>');
        return redirect()->route('product-list');
     }

    public function product_list()
    {
        $title='Product List';
        $bussiness_setup=DB::table('business_setup')->get();
        $data = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
            ->select('products.*', 'categories.category_name','subcategories.subcategory_name')
             ->get();
        return view('admin.product-list' , compact('title', 'data', 'bussiness_setup'));
    }
    public function FirstOrderList(Request $request){
        $fromdate=$request->fromdate;
        $todate=$request->todate;
        if(empty($fromdate) and empty($todate)){
        $title='First Order List';
         $user = DB::table('user')->where("role","user")->get();
        $data = DB::table('orders')->join('user', 'orders.user_id','=','user.id')->select('orders.*','user.userid','user.first_name','user.last_name','user.role')->orderBy('id','DESC')->get(); 
        return view('admin.first-order-list' , compact('title','user', 'data','fromdate','todate'));
    }
    }
    
      public function filter(Request $request){
          $request->validate([
            'fromdate'=>'required',
            'todate'=>'required',
        ]);  
        $fromdate=$request->fromdate;
        $todate=$request->todate; 
        $title='First Order List';
          $user = DB::table('user')->where("role","user")->get();
        $data = DB::table('orders')->join('user', 'orders.user_id','=','user.id')->select('orders.*','user.userid','user.first_name','user.last_name','user.role')->orderBy('id','DESC')->whereBetween('dat_time', [$fromdate, $todate])->get(); 
        return view('admin.first-order-list' , compact('title', 'data','user','fromdate','todate'));
    }
    
      public function record(Request $request){
          $request->validate([
            'userid'=>'required', 
        ]); 
       $fromdate=$request->fromdate;
        $todate=$request->todate;
        $userid=$request->userid;
        $title='First Order List';
         $user = DB::table('user')->where("role","user")->get();
        $data = DB::table('orders')->join('user', 'orders.user_id','=','user.id')->select('orders.*','user.userid','user.first_name','user.last_name','user.role')->where('user.userid',$request->userid)->get();
      // dd($user);
        return view('admin.first-order-list' , compact('title', 'data','user','fromdate','todate','userid'));
    }
    
    
    public function RepurchaseOrderList(Request $request){
        
        $fromdate=$request->fromdate;
        $todate=$request->todate;
        if(empty($fromdate) and empty($todate)){
        $title='Repurchase Order List';
        // $referal='AP002';
         $user = DB::table('user')->where("role","user")->get();
        $data = DB::table('r_orders')->join('user', 'r_orders.user_id','user.id')->select('r_orders.*','user.userid','user.first_name','user.last_name','user.role')->orderBy('id','DESC')->get();
        // dd($data);
        return view('admin.repurchase-order-list' , compact('title', 'data' ,'user', 'fromdate','todate'));
        }
    }

  public function filterrecoreddate(Request $request){
       
       $request->validate([
            'fromdate'=>'required',
            'todate'=>'required',
        ]);  
        $fromdate=$request->fromdate;
        $todate=$request->todate;
        
        $table=$request->tablename;
        $title='Repurchase Order List';
        $user = DB::table('user')->where("role","user")->get();
        $data = DB::table('r_orders')->join('user', 'r_orders.user_id','=','user.id')->select('r_orders.*','user.userid','user.first_name','user.last_name','user.role')->orderBy('id','DESC')->whereBetween('dat_time', [$fromdate, $todate])->get();
        return view('admin.repurchase-order-list' , compact('title','data','user' ,'fromdate','todate'));
         
    }  
    
      public function filterrecored(Request $request){
       
       $request->validate([
            'userid'=>'required', 
        ]); 
        $fromdate=$request->fromdate;
        $todate=$request->todate;
        $userid=$request->userid;
        $table=$request->tablename;
        $title='Repurchase Order List';
         $user = DB::table('user')->where("role","user")->get();
        $data = DB::table('r_orders')->join('user', 'r_orders.user_id','=','user.id')->select('r_orders.*','user.userid','user.first_name','user.last_name','user.role')->where('user.userid',$request->userid)->get();
          //dd($user);
        return view('admin.repurchase-order-list' , compact('title','data','fromdate','user','todate','userid'));
         
    }  

    public function add_product(){
        
        $title='Add Product';
        $bussiness_setup=DB::table('business_setup')->get();
        $category = DB::table('categories')->get();
        return view('admin.add-product', compact('title', 'category', 'bussiness_setup'));
        
    }
    public function edit_product(Request $request){
        $id=$request->id;
        $title='Edit Product';
        $data = DB::table('products')->where('id', $id)->get();
        $pid=$data[0]->id;
        $cid=$data[0]->category_id;
        $scid=$data[0]->subcategory_id;
        $data1 = DB::table('product_stocks')->where('pid', $pid)->get();
        $data2 = DB::table('categories')->where('id', $cid)->get();
        $subcategories = DB::table('subcategories')->where('id', $scid)->get();
        $subcategory = DB::table('subcategories')->get();
        $bussiness_setup=DB::table('business_setup')->get();
        $category = DB::table('categories')->get();
        return view('admin.add-product', compact('title', 'data', 'category','bussiness_setup','data1','data2','subcategories','subcategory'));
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
                $size = getimagesize($file);
               dd($filename);
                $file->move(public_path('productImages'), $filename);
                $data=array(
                    'image'=>$filename,
                    'pid'=>$request->pid,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                );
                // if($size['0']>500 && $size['1']>500){
                //     Session::flash('error', "Sorry !! Please Upload more than 1200 KB");
                //     return redirect()->route('edit_images', ['id'=>$request->pid]);
                // }else{
                    DB::table('product_images')->insert($data);
                    $lastInsertId=DB::getPdo()->lastInsertId();
                    
                    // array_push($image_array, $filename);
                    $i++; 
                // }
               
            }
            
            if ($lastInsertId) {
                 $request->session()->flash('success',"Record has been successfully added.");  
                return redirect()->route('edit_images', ['id'=>$request->pid]);
            } else {
                Session::flash('error', "!Sorry data not inserted.");
                return redirect()->route('edit_images', ['id'=>$request->pid]);
            }
            
            }
    }
     
    public function getProducts(Request $request){
        
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
             $totaldp+=($row->mrp-($row->mrp*$product['0']->discount)/100)*$row->quantity;
             $totalbv+=($product['0']->business_value)*$row->quantity;
             $totalmrp+=($row->mrp)*$row->quantity;
        ?>
         <tr>
             <td><?php echo $row->name; ?></td>
             <td><?php echo $row->quantity; ?> </td>
             <td><?php echo $row->mrp; ?> * <?php echo $row->quantity ;?> </td>
             <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo ($row->mrp-($row->mrp*$product['0']->discount)/100)*$row->quantity; ?></td>
             <td><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo ($row->mrp-($row->mrp*$product['0']->discount)/100)*$row->quantity; ?></td>
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

     public function deleteProductImage(Request $request){
        $id=$request->id;
        $cdata=DB::table('product_images')->where('id', $id)->get();
        $cimage=$cdata['0']->image;
        $deletedImage=public_path('productImages').'/'.$cimage;
        unlink($deletedImage);
        DB::table('product_images')->where('id', $id)->delete();
        Session::flash('message', '<p class="alert alert-success" style="text-align:center">Category has been successfully deleted.</p>');
        // return redirect('edit_images/'.$cdata['0']->p_id);
        return redirect()->route('edit_images', ['id'=>$cdata['0']->pid]);
    }
    
    public function delete_product(Request $request){
        $id=$request->id;
        DB::table('products')->where('id', $id)->delete();
        DB::table('images')->where('p_id', $id)->delete();
         $request->session()->flash('success',"Record has been successfully deleted."); 
        return redirect()->route('product-list');
    }
 
  
   public function product_search(Request $request){
        
        $term=$_POST['sdata'];
        $filterData = DB::table('products')->where('name','LIKE','%'.$term.'%')->get();
        foreach($filterData as $row){ ?>
           
           <li class="list-group-item" onclick="selectValss('<?php echo  $row->id; ?>')" id="aaaa<?php echo  $row->id; ?>"> <?php echo $row->name; ?></li>
          <?php  }
   }

   public function get_product_details(Request $request){
    
     $pid=$request->product_id;
     $filterData=DB::table('products')->where('id', $pid)->get();
     return response()->json($filterData);
    }

    public function changeOrderStatus(Request $request){
         
         $status=$request->status;
         $id=$request->id;
         $data=array(
                'order_status'=>$status
             );
         DB::table('orders')->where('id' , $id)->update($data);
         echo 1; 
         
    }
 public function change_Orderfirst1(Request $request){
          
         $status=$request->status;
         $id=$request->id;
         $data=array(
                'order_status'=>$status,
             );
      $sql= DB::table('orders')->where('id' , $id)->update($data);
         if($sql){
              echo 1; 
         }else{
              echo 0; 
         }
        
         
    }
     public function changeOrderRepurchase(Request $request){
         
         $status=$request->status;
         $id=$request->id;
         $data=array(
                'order_status'=>$status
             );
         DB::table('r_orders')->where('id' , $id)->update($data);
         echo 1; 
         
    }
    
    public function __invoke($image){
        
        //dd('dkk');
        abort_if(auth()->guest(),Response::HTTP_FORBIDDEN);
        return response()->file(
            Storage::path($image)
            );
        
        
        
    }

}
