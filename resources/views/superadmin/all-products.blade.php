@extends('admin.layouts.main')
@section('mains')
<style>
   .card img {
   max-width: 25%;
   margin: auto;
   padding: 0.5em;
   border-radius: 0.7em;
   }
  
</style>

<link rel="stylesheet" type="text/css" href="https://www.chaturbuy.com/css/toastr.min.css">
<!--start page wrapper -->
<div class="page-wrapper">
<div class="page-content">
<!--breadcrumb-->
<!--end breadcrumb-->
<h6 class="mb-0 text-uppercase">{{$subtitle}}</h6>
<hr />
<div class="card">
   <div class="card-body">
      <div class="row" >
         <div class="col-md-12" id='error'></div>
         <div class="col-md-12">
             <?php echo Session::flash('message'); ?>
                 {{ $data->links() }} 
         </div>
         <div class="col-md-6" style="background-color:rgb(243 243 243);">
            <div class="container" style="margin-top: 15px">
               <div class="row hidden-md-up">
                  <?php foreach( $data as $row){?> 
                  <div class="col-md-6" onclick="addtocartproduct('<?php echo $row->id;?>');">
                     <div class="card">
                        <div class="card-block">
                           <span class="badge bg-danger" style="margin-left:5px">QTY : 10</span>
                           <div class="row">
                              <div class="col-md-4">
                              </div>
                              <div class="col-md-8" style="height:125px">
                                 <p class="card-text">Name : {{$row->product_name}}</p>
                                 <p class="card-text">Price : {{$bussiness_setup['0']->currency_symbol}}&nbsp;{{$row->f_price}}</p>
                                 <p class="card-text">SKU : {{$row->sku_code}}</p>
                              </div>
                           </div>
                           <span class="badge bg-danger" style="float: right; margin-right: 5px;margin-bottom: 4px;font-size:12px" id='outofStock<?php echo $row->id;?>'></span>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <br>
            </div>
            
        
          
         </div>
         <div class="col-md-6">
            <form id='myform'>
               <div>
                  <label>* Customer</label>
                  <br><br>
                  <input type="text" class="form-control" onkeyup="searchdatas();" onmousedown="searchdatas();"    name="customer" id="customer" >
                  <label id='customer_error' style="color:red"></label>
                  <ul  style="display:none" class="list-group" id="lidata"></ul>
               </div>
               <br>
               <div>
                  <div class="clientinfo">
                     Client Details
                     <hr>
                     <div><strong id="customer_name"></strong></div>
                  </div>
                  <div class="clientinfo">
                     <input type="hidden" name="customer_addresss" id="customer_addresss">
                     <input type="hidden" name="customer_id" id="customer_id">
                     <input type="hidden" name="cityy" id="cityy">
                     <input type="hidden" name="zipp" id="zipp">
                     <input type="hidden" name="customer_emaill" id="customer_emaill">
                     <input type="hidden" name="customer_phonee" id="customer_phonee">
                     <input type="hidden" name="statee" id="statee">
                     <div><strong id="customer_address"></strong></div>
                  </div>
                  <div class="clientinfo">
                     <div><strong id="city"></strong><strong id="state"></strong><strong id="zip"></strong></div>
                  </div>
                  <div class="clientinfo">
                     <div> <strong id="customer_phone"></strong><br><strong id="customer_email"></strong></div>
                  </div>
               </div>
               <br>
               <div> 
                  <label>* Date</label>
                  <br> 
                  <input type="date" class="form-control" id="invoicedate" name="invoicedate">
                  <label></label>
               </div>
               <br>
               <div style="margin-top: 10px">
                  <label>Select Payment Method</label>  <br>
                  <select class='form-control' name='payment_method' id='payment_method'>
                     <option value=''>
                        --Select Method--
                     </option>
                     <option value='cod'>
                        COD
                     </option>
                     <option value='wallet'>
                        WALLET
                     </option>
                  </select>
                  <label id='payment_method_error' style='color:red'></label>
               </div>
               <br> 
               <div class="table table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                           <th style="text-align:center">Sr. no.</th>
                           <th >Product</th>
                           <th >Qty</th>
                           <th style="text-align:center">MRP</th>
                           <th style="text-align:center">DP</th>
                           <th style="text-align:center">Total</th>
                           <th style="text-align:center">Total BV</th>
                           <th style="text-align:center">Action</th>
                        </tr>
                     </thead>
                     <tbody id="tablerow">
                     </tbody>
                  </table>
               </div>
               <div style="margin-top: 10px"> 
                  <label>Coupon Code ( Optional )</label><br>
                  <input type='text' name='coupon_code' id='coupon_code' onkeyup="getCouponCodeDiscount(this.value)" class='form-control'>
                  <small style='float:right;margin-top:5px;display:none' id='messagesss'>25 % Off</small>
               </div>
               <div style="margin-top:10px;display:none;" id='countinue_sale'>
                  <input type="button"  onclick="uploadRecord();" style="float:right;" class="btn btn-primary"  class="fixed-bottom" value="Continue Sale">
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

@endsection