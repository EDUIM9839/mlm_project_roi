@extends('user.layouts.main')
@section('mains')
    <!--start page wrapper -->
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
                            <li class="breadcrumb-item active" aria-current="page">R-Order History</li>
                        </ol>
                    </nav>
                </div> 
            </div>
            <!--end breadcrumb-->
         
            <!-- Scrollable -->
            <div class="card">
                  @if (session()->has('success'))
                      <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                            <div class="d-flex align-items-center">
                                <div class="font-35 text-white"></i><i class="bx bxs-check-circle"></i>
                                </div>
                                <div class="ms-3">
                                    <div class="text-white">{!!session()->get('success')!!}</div>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                     @elseif(session()->has('error'))
                      <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                            </div>
                            <div class="ms-3">
                                <div class="text-white">{!!session()->get('error')!!}</div>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>
                     @endif
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                         <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>User Id </th>
                                    <th>Name</th>
                                    <!--<th>Product Name</th>-->
                                    <th>Delivery Status</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                    <th>Total</th>
                                    <th>Total BV</th>
                                      <th>Date</th>
                                      <th>Action</th>
                                      <th>Invoice View</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                 @php
                                 $i = 1;
                                 @endphp
                                 @foreach ($data as $d)
								 @php $products = json_decode($d->products,true);
								 
								 @endphp
							 
                                    <tr>
                                        <td>{{$i++}}</td> 
										<td> 
												<div class="ms-2">
													<h6 class="mb-0 font-14"> {{$d->order_id}}</h6>
											 </div>
										</td>
										<td>{{ucfirst ($d->first_name)}} {{$d->last_name}}</td>
									
										
									<td>
										 @if($d->order_status=='0')
										  	 <div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>confirmed</div> 
										 
										 @elseif($d->order_status=='1')
										 <div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>dispatch</div> 
	                                    @else
	                                    <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Delivered</div> 
                                       
                                        @endif
										</td>
										
										<td>{{$d->payment_methods}}</td>
									    <td>{{$d->payment_status}}</td>
                                        <td>{{Helper::get_currency()}}{{$d->total}}</td>
                                        <td>{{$d->total_bv}}{{Helper::get_business_unit()}}</td> 
										<td>{{Helper::formatted_date($d->dat_time)}}</td>
                                        <td> <button type="button" data-bs-toggle="modal" data-bs-target="#exampleWarningModal{{$d->id}}" class="btn btn-primary btn-sm radius-30 px-4">View Details</button>
                                         	<div class="col">
                                    	<div class="modal fade" id="exampleWarningModal{{$d->id}}" tabindex="-1" aria-hidden="true">
                                    	    <div class="modal-dialog modal-lg modal-dialog-centered">
                                    	        <div class="modal-content  ">
                                    	            	<div class="modal-header  ">
														<h5 class="modal-title text-dark text-right">Order Id :- {{$d->order_id}}  
										 @if($d->order_status=='0')
										  	 <div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>confirmed</div> 
										 
										 @elseif($d->order_status=='1')
										 <div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Dispatch</div> 
	                                    @else
	                                    <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Delivered</div> 
                                        
                                        @endif
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body text-dark">
										     @php $shipping_address = json_decode($d->shipping_address,true);
										      @endphp
										      
								<div class="card">
					<div class="card-body">
					 <center><h7 class="text-center"><b>Shipping Address</b></h7></center>
					 <hr/> 
					 <center>
					 <p class="text-center paa">
									        {{$shipping_address['0']['address']}},{{$shipping_address['0']['city']}},{{$shipping_address['0']['state']}},{{$shipping_address['0']['country']}},{{$shipping_address['0']['zip']}},<br>{{$shipping_address['0']['mobile']}}</p>
									        </center>
							 </div>
			 </div> 
											
								 @foreach($products as $p)
							
							     @php
								 $category = DB::table('categories')->where('id',$p['category_id'])->get(); 
								 @endphp
								 @if ($p['subcategory_id'])
								 @php
								 $subcategory = DB::table('subcategories')->where('id',$p['subcategory_id'])->get();
								 @endphp
								 @else 
								 @php
								 $subcategory = null;
								 @endphp
								   @endif
                                 <div class="table-responsive">
                                 <table  class="table table-bordered mb-0 ">
								<thead class="">
								    <style>
								        .yes     { 
                                        position: relative;
                                        top: 24px;
                                    }
                                    p {
    margin-top: 0;
    margin-bottom: 0rem;
}
@media only screen and (max-width: 768px) {
  .paa{
    font-size: 10px!important;
  }
}
                                  
								    </style>            
								    <div class="d-lg-flex align-items-center mb-4 gap-3">
							<div class="position-relative bottom-0 end-0">
							</div>
						  <div class="ms-auto col-xs"><button class="border-0 bg-warning text-dark yes  rounded-top  col-xs-12 "><b>Total:- {{Helper::get_currency()}}{{$p['dp']*$p['quantity']}}</b></button></div>
						</div> 
						<tr><th>Product Name</th><td>{{$p['name']}}</td><th>MRP</th><td>{{Helper::get_currency()}}{{$p['mrp']}}</td> </tr>
						
		            	<tr><th> Discount</th><td> {{Helper::get_currency()}}{{$p['discount']}}</td><th>DP</th><td>{{Helper::get_currency()}}{{$p['dp']}}</td></tr>
					    <tr><th>Payment Methods</th><td>{{$d->payment_methods}}</td><th>Business Value({{Helper::get_business_unit()}})</th><td>{{$p['business_value']}}{{Helper::get_business_unit()}}</td></tr>
					  <tr><th>Quantity</th><td>{{$p['quantity']}}</td> <th>Category</th><td>{{($category[0]->category_name)}}</td>  </tr> 
					  
					     @if($subcategory)
	                <tr><th>Subcategory</th><td colspan="3" >{{$subcategory[0]->subcategory_name}}</td>  </tr>
	                
		                                         @else
		                                         	<tr><th>Subcategory</th> <td colspan="3" ></td>
		                                         	
		                                         	</tr>
		                                          
		                                         @endif
		                                        
		                                         	</thead>
                                                        </table>
                                                         </div>
                                                        <hr style=" margin:1.5rem; border:'0.5px solid dashed; !important'">
                                                       
		                                         @endforeach
		                                         <h2 class="text-center">Grand Total:- {{Helper::get_currency()}}{{$d->total}}</h2>
		                                        
													    </div>
													    	<div class="modal-footer border-dark">
														<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
													</div>
                                    	            </div>
                                    	        </div>
                                            </div>
                                         	    </div>
                                         </td>
                                       
                                        <td class='textcenter'>
                                            <div class="d-flex order-actions">
												<a href="{{ route('generateInvoice', ['id'=>$d->id]) }}" class=""><i class='bx bx-file'></i></a>
											</div>
                                        </td>
                                        
                                    </tr>
                                    
                                    @endforeach
                            </tbody>
                        </table>
            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    
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
<script>
function r_orders(id){
     $.ajax({
            type: 'post',
            url: '{{ route("r_orders") }}',
            data: {'id':id, "_token":"{{csrf_token()}}"},
            success: function (data) {
                   $("#table").html(data);
            }
        }); 
}
</script>
@endsection
