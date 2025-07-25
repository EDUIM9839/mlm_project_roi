@extends('admin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <style>
        .textcenter{
            text-align:center!important;
            vertical-align: middle!important;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-content">
             <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->
           
           <div class="card">
              <div class="table-responsive text-nowrap">
                    <div class="row"> <div class="col-md-12"><?php echo Session::flash('message'); ?></div></div>
                    <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                               <tr class='table-dark'>
                                    <th class='textcenter' >Sr.No</th>
                                    <th class='textcenter'>Order Id</th>
                                    <th class='textcenter'>Total</th>
                                  
                                    <th class='textcenter'>Bussiness Value</th>
                                    <th class='textcenter'>Payment Method</th>
                                    <th class='textcenter'>Payment Status</th>
                                    <th class='textcenter'>Delivery Status</th>
                                     <th class='textcenter'>BILLING & SHIPPING ADDRESS</th>
                                    <th class='textcenter'>Created At</th>
                                    <th class='textcenter'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @php
                                    $i = 1;
                                @endphp
                             
                                   <?php  
                                   
                                       //$row=DB::table('product_images')->where('pid', $d->id)->get(); //print_r($row['0']->image );
                                       //$product=$data['0']->products;
                                      
                                       foreach($data as $d){
                                       
                                         $products=json_decode($d->products, true);  
                                         $billingaddress=json_decode($d->shipping_address, true);  
                                         $userid=$d->user_id;
                                         $userData=DB::table('user')->where('id', $userid)->get();
                                         //print_r($billingaddress);die;
                                         
                                   
                                   ?>
                                    <tr>
                                        <td class='textcenter'>{{$i++}}</td>
                                       
                                        <td class='textcenter'><?php echo $d->order_id; ?></td>
                                        <td class='textcenter'><?php echo $d->total; ?></td>
                                       
                                        <td class='textcenter'><?php echo $d->total_bv; ?></td>
                                        <td class='textcenter'><?php echo $d->payment_methods; ?></td>
                                        <td class='textcenter'><?php echo $d->payment_status; ?></td>
                                        <td class='textcenter'>
                                            <select class='form-control' onchange="getval(this.value, <?php echo $d->id; ?>);"
                                             <?php if($d->order_status=='0'){?>style='background-color: #f54242;color: white;'<?php }?> 
                                             <?php if($d->order_status=='1'){?>style='background-color: #42f5f5;color: white;'<?php }?> 
                                             <?php if($d->order_status=='2'){?>style='background-color: #01010d;color: white;'<?php }?> 
                                             <?php if($d->order_status=='3'){?>style='background-color: green;color: white;'<?php }?> 
                                        
                                            >
                                               
                                               <?php if($d->order_status=='0'){?> 
                                               
                                               <option value='0' <?php if($d->order_status=='0'){ echo 'selected'; }?>>Pending</option>
                                               <option value='1' <?php if($d->order_status=='1'){ echo 'selected'; }?>>On the Way</option>
                                               <option value='2' <?php if($d->order_status=='2'){ echo 'selected'; }?>>Dispatch </option>
                                               <option value='3' <?php if($d->order_status=='3'){ echo 'selected'; }?>>Delivered</option>
                                               <?php } ?>
                                               <?php if($d->order_status=='1'){?> 
                                               
                                                <option value='1' <?php if($d->order_status=='1'){ echo 'selected'; }?>>On the Way</option>
                                               <option value='2' <?php if($d->order_status=='2'){ echo 'selected'; }?>>Dispatch </option>
                                               <option value='3' <?php if($d->order_status=='3'){ echo 'selected'; }?>>Delivered</option>
                                               <?php } ?>
                                               <?php if($d->order_status=='2'){?> 
                                                <option value='2' <?php if($d->order_status=='2'){ echo 'selected'; }?>>Dispatch </option>
                                                <option value='3' <?php if($d->order_status=='3'){ echo 'selected'; }?>>Delivered</option>
                                               <?php } ?>
                                               <?php if($d->order_status=='3'){?> 
                                                <option value='3' <?php if($d->order_status=='3'){ echo 'selected'; }?>>Delivered</option>
                                               <?php } ?>
                                               
                                            </select>
                                           
                                        </td>
                                        <td class='textcenter'>
                                            <?php 
                                                
                                                echo $billingaddress['0']['address'];
                                                echo ',';
                                                echo $billingaddress['0']['city'];
                                                echo ',';
                                                echo $billingaddress['0']['state'];
                                                echo '-';
                                                echo $billingaddress['0']['zip'];
                                            ?>
                                        </td>
                                      
                                              <td>{{ Helper::formatted_date($d->created_at)}}</td>
                                       
                                        <td class='textcenter'>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#allproducts" onclick="getProducts('<?php echo $d->id?>');">
                                                 <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>&nbsp;&nbsp; 
                                            <a href="<?php echo route('GenerateInvoice',['id'=>$d->id]);?>">
                                                 <i class='fas fa-file-invoice'></i>
                                            </a>
                                            <!--<a href="">-->
                                                 
                                            <!--     <i class="fa fa-edit" title="Edit" style="font-size:15px"></i>-->
                                            <!--</a>&nbsp;&nbsp;-->
                                            <!--<a href=""><i class="fa fa-trash" title="Delete" style="font-size:15px"></i></a>-->
                                        </td>
                                    </tr>
                                    <?php  } ?>
                               
                            </tbody>
                           
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Button to Open the Modal -->


<!-- The Modal -->
<div class="modal fade"  id="allproducts">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Product Details</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
        <table class="table" >
                    <thead>
                        <tr>
                            <th>PRODUCT NAME</th>
                            <th>QTY</th>
                            <th>MRP</th>
                            <th>DP</th>
                            <th>TOTAL</th>
                            <th>TOTAL BV</th>
                          
                         
                        </tr>
                    </thead>
                    <tbody id='table'>
                       
                    </tbody>
                </table>
             
      </div>

     
    </div>
  </div>
</div>
    <div class="modal" id="myModal-1">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Update Image</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('uploadBulkImage') }}" method="post" enctype="multipart/form-data"> 
                @csrf 
            <!-- Modal body -->
            <div class="modal-body">
            
              <input type="hidden" id="pid"  name="pid" class="form-control" >
             
               <input type="file" class="form-control" name="image[]" multiple >
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Update</button>
            </div>
           </form>
          </div>
        </div>
      </div>
      <script>
        function getpId(id , img){
          
             $('#pid').val(id);
            
        }
        function reloadpage(){
            location.reload();
        }
    </script>               
@endsection
