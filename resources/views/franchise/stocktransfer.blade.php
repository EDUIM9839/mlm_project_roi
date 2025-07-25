@extends('franchise.layouts.main')
@section('mains')
<style>
   /*.card img {*/
   /*max-width: 25%;*/
   /*margin: auto;*/
   /*padding: 0.5em;*/
   /*border-radius: 0.7em;*/
   /*}*/
  .quantity__input{
   
    width: 50%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: var(--bs-body-color);
    background-color: var(--bs-form-control-bg);
    background-clip: padding-box;
    border: var(--bs-border-width) solid var(--bs-border-color);
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.375rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  }
  .bgcolor{
        background-color: rgb(203, 200, 200);
        margin-top: 0px;
        color: black;
      
  }
  .hidesubtotalTr{
      display:none!important;
  }
</style>


<!--start page wrapper -->
<div class="page-wrapper">
<div class="page-content">
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                        </ol>
                    </nav>
                </div>
                
            </div>
<hr />
<div class="card" >
   <div class="card-body">
      <div class="row" >
         <div class="col-md-12" id='error'></div>
         <div class="col-md-12">
             <?php echo Session::flash('message'); ?>
              
         </div>
         <div class="col-md-6" style="background-color:rgb(243 243 243);">
         <div class="container" style="margin-top: 15px">
               <div class="row hidden-md-up">
                 <?php 
                      foreach( $data as $row){
                         $product_images=DB::table('product_images')->where('pid', $row->product_id)->get();
                         $products=DB::table('products')->where('id', $row->product_id)->get();
                  ?> 
                  <div class="col-md-4" onclick="fadd_to_cart('<?php echo $row->product_id;?>');">
                    
                     
                     <div class="col">
						<div class="card">
						    <div class='row'>
						        <div class='col-md-6'>
        						     <?php if($row->quantity<3){?>
                                       <span class="badge bg-danger hidestockspan{{$row->product_id}}" style="font-size:13px">QTY : {{$row->quantity}}</span>
                                     <?php }else{ ?>
                                       <span class="badge bg-success" style="font-size:13px">QTY : {{$row->quantity}}</span>
                                      <?php } ?>
                                      <span class="badge bg-danger" style="font-size:13px" id='outofStock<?php echo $row->product_id;?>'></span>
                                </div>
                                
                                <div class='col-md-6'>
                                    
                                        @if(!empty($products['0']->percent_discount))
                                            <div><span style='float:right;margin-right:2px;font-size:13px' class="badge bg-info">-{{$products['0']->percent_discount}}&nbsp;% &nbsp;OFF</span></div>
                                         @else
                                            <div><span style='float:right;margin-right:2px;font-size:13px' class="badge bg-info">- {{Helper::get_currency()}}&nbsp;{{$products['0']->flat_discount}}&nbsp;OFF</span></div>
                                         @endif
                                        
                                </div>
                            </div>
                            
                            
							<img src="{{asset('productImages')}}/{{$product_images['0']->image}}" height='200' width='200' class="card-img-top mt-1" >
						
							<div class="card-body">
								<h6 class="card-title cursor-pointer">{{$products['0']->product_name}}</h6>
								<div class="clearfix">
									<p class="mb-0 float-start"><strong>{{$products['0']->business_value}}</strong> BV</p>
									<p class="mb-0 float-end fw-bold"><span class="me-2 text-decoration-line-through text-secondary">{{Helper::get_currency()}}&nbsp;{{$products['0']->mrp}}</span><span>{{Helper::get_currency()}}&nbsp;{{Helper::get_currency()}}&nbsp;{{$products['0']->dp}}</span></p>
								</div>
								<div class='row'>
    								<div class="d-flex align-items-center mt-3 fs-6">
    								  <div class='col-md-12'><button class='btn btn-warning'  style='float:right;background: #fb641b;box-shadow: 0 1px 2px 0 rgba(0,0,0,.2);border: none;color: #fff;width:100%'>Add To Cart</button></div>
    								</div>
								</div>
							</div>
							
						</div>
					</div>
               </div>
                 <?php } ?>
              
            </div>
            
        
          
         </div>
        
      </div>
      
      <?php 
                    
                        $cart=Session::get('cart');//print_r($cart);
                        if(!empty($cart)){
                       
                        foreach($cart as $row){
                            $customer_id=$row['user_id'];
                            $invoicedate=$row['invoicedate'];
                           
                            $from_id=$row['from_id'];
                        
                         }
                        
                         $result=DB::table('cart_items')->where('product_id', $row['id'])->where('user_id', $customer_id)->get();
                         $user=DB::table('user')->where('id', $customer_id)->get();
                        }
                        
                    ?>
       <div class="col-md-6">
            <form id='myform'>
                <input type="hidden" class="form-control" name="from_id" id="from_id" value="{{$id}}">
                <div>
                      <label>* Distributor / Franchise Business Name:</label>
                      <input type="text" class="form-control" onkeyup="search_franchises();" onchange="search_franchises();" onmousedown="search_franchises();"  autocomplete='off'    name="customer" id="customer" >
                      <label id='customer_error' style="color:red"></label>
                      <span class="position-absolute top-50 translate-middle-y"></span>
						     <?php if(!empty($user['0']->id)){?>
						        <span class='badge bg-success'   style='text-align: left;font-size: 12px;width: 170px;color: black;margin-top: 2px '  >Wallet Amount :{{Helper::get_currency()}}&nbsp;{{$user["0"]->saving_wallet}}</span> 
						     <?php } else{ ?>
						     
						        <span class='badge bg-success' id='hiddenwallet'  style='text-align: left;font-size: 12px;width: 170px;color: black;display: none;margin-top: -18px '  >Wallet Amount :{{Helper::get_currency()}}&nbsp;<small id='savingwallet'></small></span>
						     
						     <?php } ?>
                      <ul  style="display:none;margin-top: -20px " class="list-group" id="lidata"></ul>
                </div>
               
                <!--<div class="clientinfo">-->
                <!--    <div class="card-body" id='cbody' style="display:none">-->
                <!--        <p class="card-title"><strong id="customer_name"></strong></p>-->
                <!--        <p class="card-text"><strong id="city"></strong><strong id="state"></strong><strong id="zip"></strong></p>-->
                <!--        <p class="card-text"> <strong id="customer_phone"></strong></p>-->
                <!--        <p class="card-text"><strong id="customer_email"></strong></p>-->
                <!--        <p class="card-text"><strong id="customer_address"></strong></p>-->
                <!--    </div>-->
                <!--</div>-->
                 
                <!--<div class="clientinfo">-->
                <!--       <input type="hidden" name="customer_addresss" id="customer_addresss">-->
                <!--       <input type="hidden" name="customer_id" id="customer_id">-->
                <!--       <input type="hidden" name="cityy" id="cityy">-->
                <!--       <input type="hidden" name="zipp" id="zipp">-->
                <!--       <input type="hidden" name="customer_emaill" id="customer_emaill">-->
                <!--       <input type="hidden" name="customer_phonee" id="customer_phonee">-->
                <!--       <input type="hidden" name="statee" id="statee">-->
                <!--</div>-->
                
                
                <div class="clientinfo">
                    
                    
                      <?php if(!empty($user['0']->id)){?>
                        <div class="card-body card bg-info w-100" style="display:none">
                        <p class="card-title"><strong id="customer_name">{{$user["0"]->franchise_name}}</strong></p>
                        <p class="card-text"><strong id="city">{{$user["0"]->city}}</strong><strong id="state">{{$user["0"]->state}}</strong><strong id="zip">{{$user["0"]->zip}}</strong></p>
                        <p class="card-text"> <strong id="customer_phone">{{$user["0"]->contact}}</strong></p>
                        <p class="card-text"><strong id="customer_email">{{$user["0"]->email}}</strong></p>
                        <p class="card-text"><strong id="customer_address">{{$user["0"]->address}}</strong></p>
                    </div>
                      <?php } else { ?>
                        <div class="card-body" id='cbody1' style="display:none">
                        <p class="card-title"><strong id="customer_name"></strong></p>
                        <p class="card-text"><strong id="city"></strong><strong id="state"></strong><strong id="zip"></strong></p>
                        <p class="card-text"> <strong id="customer_phone"></strong></p>
                        <p class="card-text"><strong id="customer_email"></strong></p>
                        <p class="card-text"><strong id="customer_address"></strong></p>
                    </div>
                      <?php } ?>
                    <div class="card-body" id='cbody1' style="display:none">
                        <p class="card-title"><strong id="customer_name"></strong></p>
                        <p class="card-text"><strong id="city"></strong><strong id="state"></strong><strong id="zip"></strong></p>
                        <p class="card-text"> <strong id="customer_phone"></strong></p>
                        <p class="card-text"><strong id="customer_email"></strong></p>
                        <p class="card-text"><strong id="customer_address"></strong></p>
                    </div>
                </div>
                 
                <div class="clientinfo">
                       
                       <?php if(!empty($user['0']->id)){?>
                            <input type="hidden" name="customer_addresss" id="customer_addresss" value='{{$user["0"]->address}}'>
                            <input type="hidden" name="customer_id" id="customer_id" value='{{$customer_id}}'>
                            <input type="hidden" name="cityy" id="cityy" value='{{$user["0"]->city}}'>
                            <input type="hidden" name="zipp" id="zipp" value='{{$user["0"]->zip}}'>
                            <input type="hidden" name="customer_emaill" id="customer_emaill" value='{{$user["0"]->email}}'>
                            <input type="hidden" name="customer_phonee" id="customer_phonee" value='{{$user["0"]->contact}}'>
                            <input type="hidden" name="statee" id="statee" value='{{$user["0"]->state}}'>
                       <?php } else { ?>
                            <input type="hidden" name="customer_addresss" id="customer_addresss">
                            <input type="hidden" name="customer_id" id="customer_id">
                            <input type="hidden" name="cityy" id="cityy">
                            <input type="hidden" name="zipp" id="zipp">
                            <input type="hidden" name="customer_emaill" id="customer_emaill">
                            <input type="hidden" name="customer_phonee" id="customer_phonee">
                            <input type="hidden" name="statee" id="statee">
                         <?php } ?>
                </div>
                
                <div> 
                      <label>* Invoice Date</label>
                      <input type="date" class="form-control" id="invoicedate" name="invoicedate"  value="<?= date('Y-m-d') ?>" max ="<?= date('Y-m-d')?>">
                </div>
             
                <div style="margin-top: 10px">
                  <label>Select Payment Method</label>  <br>
                  <select class='form-control' name='payment_method' id='payment_method'>
                     <option value=''>
                        --Select Method--
                     </option>
                     <option value='cash'>
                        CASH
                     </option>
                     <option value='wallet'>
                        WALLET
                     </option>
                     <!-- <option value='online'>-->
                     <!--   ONLINE-->
                     <!--</option>-->
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
                        <?php
                            if(!empty($user['0']->id)){
                            $i=1;
                            $subtotal=0;
                            $Tbv=0;
                            foreach($cart as $rows){
                            
                             $dp=($rows['mrp']-$rows['mrp']*$rows['percent_discount']/100);
                             $total=($dp*$rows['quantity']);
                             $subtotal+=$total;
                             $Tbv=$rows['business_value']*$rows['quantity']; 
                             
                        ?>
                        <tr>
                            <td style="text-align:center">{{$i++}}</td>
                            <td style="text-align:center">{{$rows['name']}}</td>
                            <td style="text-align:center"><a onclick="fdecreaseqty('{{$rows['id']}}')" class="btn btn-md" style="height: 26px;background-color:#e7e7e7"><span>-</span></a><input name="quantity" style="width:50px" type="text" min="1" value="{{$rows['quantity']}}" id="" readonly ><a onclick="fincreaseqty('{{$rows['id']}}')" class="btn btn-md" style="height: 26px;background-color:#e7e7e7"><span>+</span></a></td>
                            <td style="text-align:center">{{$bussiness_setup['0']->currency_symbol}}&nbsp;{{$rows['mrp']}}</td>
                            <td style="text-align:center">{{$bussiness_setup['0']->currency_symbol}}&nbsp;{{$dp}}</td>
                            <td style="text-align:center">{{$bussiness_setup['0']->currency_symbol}}&nbsp;<?php echo $total ?></td>
                            <td style="text-align:center"><?php echo $Tbv ?></td>
                            <td style="text-align:center"><a onclick="fdelete_Cart_Item({{$rows['id']}})"><i class="fa fa-trash"></i></a></td>
                        
                         </tr>
                        <?php }} ?>
                        
                          
                     </tbody>
                       <tfoot id='tfooter'>
                         <tr>
                               <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                           
                            <?php  if(!empty($user['0']->id)){?> <td>Sub Total</td><td  id="subtotal" style="text-align:center">{{$bussiness_setup['0']->currency_symbol}}&nbsp;{{$subtotal}}</td><?php } ?>
                            <?php  if(!empty($user['0']->id)){?><td style="text-align:center"><input type="hidden" value='{{$subtotal}}'  id="total" name="total"></td><?php }else{ ?>
                               <td style="text-align:center"><input type="hidden" value=''  id="total" name="total"></td>
                            <?php } ?>
                        </tr>   
                     </tfoot>
                  </table>
               </div>
               <!--<div style="margin-top: 10px"> -->
               <!--   <label>Coupon Code ( Optional )</label><br>-->
               <!--   <input type='text' name='coupon_code' id='coupon_code' onkeyup="getCouponCodeDiscount(this.value)" class='form-control'>-->
               <!--   <small style='float:right;margin-top:5px;display:none' id='messagesss'>25 % Off</small>-->
               <!--</div>-->
             <?php if(!empty($result['0']->id)){?>
               <div style="margin-top:10px;" id='countinue_sale'>
                   <input type='hidden' id='allproducts' name='allproducts' value='<?php print_r(json_encode($cart)); ?>'>
                  <input type="button"  onclick="fuploadData();" style="float:right;" class="btn btn-primary"  class="fixed-bottom" value="Continue Sale">
               </div>
               <?php } else { ?>
               <div style="margin-top:10px;display:none;" id='countinue_sale'>
                   <input type='hidden' id='allproducts' name='allproducts'>
                  <input type="button"  onclick="fuploadData();" style="float:right;" class="btn btn-primary"  class="fixed-bottom" value="Continue Sale">
               </div>
               <?php } ?>
               <!--<div style="margin-top:10px;display:none;" id='countinue_sale'>-->
               <!--   <input type="button"  onclick="fuploadFranchise();" style="float:right;" class="btn btn-primary"  class="fixed-bottom" value="Continue Sale">-->
               <!--</div>-->
               
               
            </form>
         </div>
   </div>
</div>
  </div>
</div>
<script>

 function selectValsss(id){
            
                $("#customer").val($("#aaa"+id).text());
                $("#customer_id").val($("#uid"+id).val());
                $("#lidata").css('display', 'none');
                $("#customer_name").text($("#name"+id).val());
                $("#customer_address").text($("#address"+id).val());
                $("#customer_addresss").val($("#address"+id).val());
                $("#city").text($("#city"+id).val());
                $("#cityy").val($("#city"+id).val());
                $("#state").text($("#state"+id).val());
                $("#statee").text($("#state"+id).val());
                $("#zip").text($("#zip"+id).val());
                $("#zipp").val($("#zip"+id).val());
                $("#customer_email").text($("#email"+id).val());
                 $("#customer_emaill").val($("#email"+id).val());
                $("#customer_phone").text($("#mobile"+id).val());
                $("#customer_phonee").val($("#mobile"+id).val());
                $('#cbody').addClass('card bg-info w-100');
                $('#cbody').css('display', 'block');

       }

     function search_franchises(){
            var searchdata=$("#customer").val(); 
             var from_id=$("#from_id").val(); 
            $.ajax({
            type: 'post',
            url: '{{ route("searchFranchises") }}',
            data: {"sdata":searchdata,"from_id":from_id,"_token":"{{csrf_token()}}"},
            success: function (data) {
          
             $("#lidata").html(data);
             $("#lidata").css('display', 'block');
            }
        }); 
       }
       
        function fadd_to_cart(id){
            var cid=$("#customer_id").val();
            var from_id=$("#from_id").val();
            $.ajax({
            type: 'post',
            url: '{{ route("fadd_to_cart") }}',
            data: {'id':id,'cid':cid,'from_id':from_id, "_token":"{{csrf_token()}}"},
            success: function (data) {
              
              
              
              
                
                if(data==0){
                 $('#outofStock'+id).text('Out Of Stock');
                 $('.hidestockspan'+id).css('display', 'none');
                 
                }else if(data=='1'){
                    $('#tfooter').html(result);
                }else if(data=='11'){
                    Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    rounded: true,
                    delayIndicator: false,
                    icon: 'bx bx-x-circle',
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: 'Firstly franchise name must be selected.'
                    });
                }else{
                    
                    var cdata = JSON.stringify(data['cartdata']);
                    $("#allproducts").val(cdata);
                    console.log(data['cartdata']);   
                    var res='';
                    var result='';
                    var subtotal=0;
                    var i=0;
                    $.each (data['cartdata'], function (kvey, value) {
                    i++;
                    var dp=value.mrp-value.mrp*value.percent_discount/100;  
                    var total=(value.mrp-value.mrp*value.percent_discount/100)*value.quantity;
                    var total_bv=(value.business_value)*value.quantity; 
                    
                    subtotal+=total;
                    res +=
                    '<tr>'+
                    '<td style="text-align:center">'+i+'</td>'+
                    '<td style="text-align:center">'+value.name+'</td>'+
                     '<td style="text-align:center">'+'<a onclick="fdecreaseqty('+value.id+')" class="btn btn-md" style="height: 26px;background-color:#e7e7e7"><span>-</span></a><input name="quantity" style="width:50px" type="text" min="1" value="'+value.quantity+'" id="quantity'+value.id+'" readonly ><a onclick="fincreaseqty('+value.id+')" class="btn btn-md" style="height: 26px;background-color:#e7e7e7"><span>+</span></a>'+'</td>'+
                    '<td style="text-align:center">'+value.mrp+'</td>'+
                    '<td style="text-align:center">'+dp+'</td>'+
                    '<td style="text-align:center">'+total+'</td>'+
                    '<td style="text-align:center">'+total_bv+'</td>'+
                     '<td style="text-align:center">'+'<a onclick="fdelete_Cart_Item('+value.id+')"><i class="fa fa-trash"></i></a>'+'</td>'+
                    
                    '</tr>';
                    
                    });
                    
                    $('tbody').html(res);
                    $("#countinue_sale").css('display', 'block');
                     result +=
                    '<tr>'+
            
                    '<td></td>'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td>Sub Total</td>'+
                    '<td  id="subtotal" style="text-align:center">'+subtotal+'</td>'+
                    '<td style="text-align:center">'+'<input type="hidden" value='+subtotal+'  id="total" name="total">'+'</td>'+
                   
                    '</tr>';
                    
                     $('#tfooter').html(result);
                }
               
            
               
            }
        }); 
    }
    
    function update_Qty(id){
         
            var qty=$("#quantity"+id).val();
             var from_id=$("#from_id").val();
            $.ajax({
            type: 'post',
            url: '{{ route("fupdate_Qty") }}',
            data: {'id':id, 'qty':qty,'from_id':from_id, "_token":"{{csrf_token()}}"},
            success: function (data) {
            
                var obj=JSON.parse(data);
              
                var total=obj.price;
            
                var idd=obj.id;
                $("#quantity"+idd).val(obj.qty);
                $("#price"+idd).text(obj.price);
                $("#total"+idd).text(total);
                $("#subtotal").text(obj.subtotal);
                
                
            }
        }); 
            
    }
    
     function fdelete_Cart_Item(id){
            var cid=$("#customer_id").val();
            var from_id=$("#from_id").val();
            $.ajax({
            type: 'post',
            url: '{{ route("fdelete_Item_Cart") }}',
            data: {'id':id,'cid':cid,'from_id':from_id, "_token":"{{csrf_token()}}"},
            success: function (data) {
                
                
                var cdata = JSON.stringify(data['cartdata']);
                  var cdataaa = JSON.stringify(data['status']);
                  $("#allproducts").val(cdata);  
                  
                if(cdataaa==1){
                    alert('Franchise Business Name must be selected related to cart item');
                }else{
                    
                    if(cdataaa==2){
                         $('tbody').html(''); 
                         $('#tfooter').html('');
                         $("#countinue_sale").css('display', 'none');
                    } else{
                      var i=0;  
                    var res='';
                     var result='';
                    var subtotal=0;
                    
                    $.each (data['cartdata'], function (kvey, value) {
                      i++;
                    var dp=value.mrp-value.mrp*value.percent_discount/100;  
                    var total=(value.mrp-value.mrp*value.percent_discount/100)*value.quantity;
                    var total_bv=(value.business_value)*value.quantity;  
                    subtotal+=total;
                    
                    res +=
                    '<tr>'+
                    '<td style="text-align:center">'+i+'</td>'+
                    '<td style="text-align:center">'+value.name+'</td>'+
                    '<td style="text-align:center">'+'<a onclick="fdecreaseqty('+value.id+')" class="btn btn-md" style="height: 26px;background-color:#e7e7e7"><span>-</span></a><input name="quantity" style="width:50px;background-color:#e7e7e7" type="text" min="1" value="'+value.quantity+'" id="quantity'+value.id+'" readonly ><a onclick="fincreaseqty('+value.id+')" class="btn btn-md" style="height: 26px;background-color:#e7e7e7"><span>+</span></a>'+'</td>'+
                    '<td style="text-align:center">'+value.mrp+'</td>'+
                    '<td style="text-align:center">'+dp+'</td>'+
                    '<td style="text-align:center">'+total+'</td>'+
                    '<td style="text-align:center">'+total_bv+'</td>'+
                    '<td style="text-align:center">'+'<a onclick="fdelete_Cart_Item('+value.id+')"><i class="fa fa-trash"></i></a>'+'</td>'+
                    
                    
             
                    '</tr>';
                    
                    });
                    
                    $('tbody').html(res); 
                    result +=
                        '<tr>'+
                      
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td>Sub Total</td>'+
                       '<td style="text-align:center" id="subtotal">'+subtotal+'</td>'+
                        '<td style="text-align:center">'+'<input type="hidden" value='+subtotal+'  id="total" name="total"> '+'</td>'+
                     
                        '</tr>';
                    $('#tfooter').html(result);
                    $("#countinue_sale").css('display', 'block');
                    
                    }
                    }
                
               
                // if(data==1){
                //      $("#countinue_sale").css('display', 'none');
                //      $("#tablerow").html('');
                // }else{
                //   $("#tablerow").html(data);
                //     $("#countinue_sale").css('display', 'block');
                // }
                
            }
        }); 
    }

 function fincreaseqty(id){
         
            var qty=$("#quantity"+id).val();
            var cid=$("#customer_id").val();
            var from_id=$("#from_id").val();
            $.ajax({
            type: 'post',
            url: '{{ route("fincreaseqty") }}',
            data: {'id':id, 'qty':qty,'from_id':from_id,'cid':cid, "_token":"{{csrf_token()}}"},
            success: function (data) {
                 var cdata = JSON.stringify(data['cartdata']);
                 $("#allproducts").val(cdata);
                  var result  ='';
                    var res='';
                    var i=0;
                    var subtotal=0;
                    $.each (data['cartdata'], function (kvey, value) {
                    i++; 
                    var dp=value.mrp-value.mrp*value.percent_discount/100;  
                    var total=(value.mrp-value.mrp*value.percent_discount/100)*value.quantity;
                    var total_bv=(value.business_value)*value.quantity;  
                    subtotal+=total;
                    res +=
                    '<tr>'+
                    '<td style="text-align:center">'+i+'</td>'+
                    '<td style="text-align:center">'+value.name+'</td>'+
                    '<td>'+'<a onclick="fdecreaseqty('+value.id+')" class="btn btn-md" style="height: 26px;background-color:#e7e7e7"><span>-</span></a><input name="quantity" style="width:50px;background-color:#e7e7e7" type="text" min="1" value="'+value.quantity+'" id="quantity'+value.id+'" readonly ><a onclick="fincreaseqty('+value.id+')" class="btn btn-md" style="height: 26px;background-color:#e7e7e7"><span>+</span></a>'+'</td>'+
                    '<td style="text-align:center">'+value.mrp+'</td>'+
                    '<td style="text-align:center">'+dp+'</td>'+
                    '<td style="text-align:center">'+total+'</td>'+
                    '<td style="text-align:center">'+total_bv+'</td>'+
                    '<td style="text-align:center">'+'<a onclick="fdelete_Cart_Item('+value.id+')"><i class="fa fa-trash"></i></a>'+'</td>'+
                    
                    
             
                    '</tr>';
                    
                    });
                    
                $('tbody').html(res); 
                 result +=
                    '<tr>'+
                 
                    '<td></td>'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td>Sub Total</td>'+
                   '<td style="text-align:center" id="subtotal">'+subtotal+'</td>'+
                    '<td style="text-align:center">'+'<input type="hidden" value='+subtotal+'  id="total" name="total"> '+'</td>'+
                 
                    '</tr>';
                    
                     $('#tfooter').html(result);
               
            }
        }); 
            
    }
    
    
        function fdecreaseqty(id){
           
            var qty=$("#quantity"+id).val();
            var cid=$("#customer_id").val();
          var from_id=$("#from_id").val();
            $.ajax({
            type: 'post',
            url: '{{ route("fdecreaseqty") }}',
            data: {'id':id, 'qty':qty,'cid':cid,'from_id':from_id, "_token":"{{csrf_token()}}"},
            success: function (data) {
                 var cdata = JSON.stringify(data['cartdata']);
                  $("#allproducts").val(cdata);
                  var result  ='';
                    var res='';
                     var i=0;
                    var subtotal=0;
                    $.each (data['cartdata'], function (kvey, value) {
                    i++;
                    var dp=value.mrp-value.mrp*value.percent_discount/100;  
                    var total=(value.mrp-value.mrp*value.percent_discount/100)*value.quantity;
                    var total_bv=(value.business_value)*value.quantity;  
                    subtotal+=total;
                    res +=
                    '<tr>'+
                     '<td style="text-align:center">'+i+'</td>'+
                    '<td style="text-align:center">'+value.name+'</td>'+
                    '<td style="text-align:center">'+'<a onclick="fdecreaseqty('+value.id+')" class="btn btn-md" style="height: 26px;background-color:#e7e7e7"><span>-</span></a><input name="quantity" style="width:50px;background-color:#e7e7e7" type="text" min="1" value="'+value.quantity+'" id="quantity'+value.id+'" readonly ><a onclick="fincreaseqty('+value.id+')" class="btn btn-md" style="height: 26px;background-color:#e7e7e7"><span>+</span></a>'+'</td>'+
                    '<td style="text-align:center">'+value.mrp+'</td>'+
                    '<td style="text-align:center">'+dp+'</td>'+
                    '<td style="text-align:center">'+total+'</td>'+
                    '<td style="text-align:center">'+total_bv+'</td>'+
                    '<td style="text-align:center">'+'<a onclick="fdelete_Cart_Item('+value.id+')"><i class="fa fa-trash"></i></a>'+'</td>'+
                    
                    
             
                    '</tr>';
                    
                    });
                    
                $('tbody').html(res); 
                 result +=
                    '<tr>'+
                
                    '<td></td>'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td>Sub Total</td>'+
                    '<td style="text-align:center" id="subtotal">'+subtotal+'</td>'+
                    '<td style="text-align:center">'+'<input type="hidden" value='+subtotal+'  id="total" name="total"> '+'</td>'+
                   
                    '</tr>';
                    
                     $('#tfooter').html(result);
                     $("#countinue_sale").css('display', 'block');
               
            }
        }); 
            
    }

 function fuploadData(){
        var customer=$("#customer").val();
        var invoicedate=$("#invoicedate").val();
        var payment_method=$("#payment_method").val();
        if(customer==''){
          
                Lobibox.notify('error', {
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                delayIndicator: false,
                icon: 'bx bx-x-circle',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                msg: 'Customer field must be required.'
                });
            
        }else if(invoicedate==''){
               
                Lobibox.notify('error', {
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                delayIndicator: false,
                icon: 'bx bx-x-circle',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                msg: 'Invoicedate field must be required.'
                });
        }else if(payment_method==''){
         
               
                
                 Lobibox.notify('error', {
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                delayIndicator: false,
                icon: 'bx bx-x-circle',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                msg: 'Payment method field must be required.'
                });
        }
        else{
           
           var data=$('#myform').serialize();
           $.ajax({
                    type: 'post',
                    url: '{{route("fuploadData")}}',
                    data: {'data':data, '_token':"{{ csrf_token()}}"},
                    success: function (data) {
                        console.log(data);
                        if(data=='1'){
                             
                               
                                Lobibox.notify('success', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                icon: 'bx bx-check-circle',
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'Order has been successfully created.'
                                });
                                
                                var url = "{{ route('frnforgetcartItems') }}";
                                setTimeout(function () {
                                    window.location.href = url;
                                }, 800); 
        
                                  
                         }else if(data=='0'){
                            
                                Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                delayIndicator: false,
                                icon: 'bx bx-x-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'No product available in cart so please cart at least one product'
                                });
                         }else if(data=='11'){
                            
                                Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                delayIndicator: false,
                                icon: 'bx bx-x-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'Customer field must be required.'
                                });
                         } else if(data=='12'){
                            
                                Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                delayIndicator: false,
                                icon: 'bx bx-x-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                 msg: 'Invoicedate field must be required.'
                                });
                         }else if(data=='13'){
                            
                                Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                delayIndicator: false,
                                icon: 'bx bx-x-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'Payment method field must be required.'
                                });
                         }else if(data=='14'){
                            
                                Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                delayIndicator: false,
                                icon: 'bx bx-x-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'Something went wrong when cart in product.'
                                });
                         }else if(data=='15'){
                            
                                Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                delayIndicator: false,
                                icon: 'bx bx-x-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'Product not transfered.'
                                });
                         }else if(data=='16'){
                            
                                Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                delayIndicator: false,
                                icon: 'bx bx-x-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'no amount in selected franchise wallet.'
                                });
                         }else if(data=='17'){
                            
                                Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                delayIndicator: false,
                                icon: 'bx bx-x-circle',
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                msg: 'wallet amount must be less than cart amount.'
                                });
                         }
                     
                    }
                       
                });  
        }
        
    }
    
    
    
    
</script>


@endsection