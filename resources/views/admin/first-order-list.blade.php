@extends('admin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <style>
        .textcenter{
            text-align:center!important;
            vertical-align: middle!important;
        }
           .yes {
    background: linear-gradient(to right, #c10e36, #1f1c1b)!important;
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
             <div class="card">
					<div class="card-body">
					    <form action="{{route('filter')}}" method='post'>
					        @csrf
    					    <div class='row'>
    							    <input type='hidden' class='form-control' value="r_orders" name='tablename'  >
    							    <div class='col-md-5'>
    							        <input type='text' class='form-control datepicker'   value="{{$fromdate}}{{old('fromdate')}}" name='fromdate' placeholder='From Date' >
    							         @error('fromdate')
    							         <small style='color:red'>{{$message}}</small>
    							         @enderror
    							     </div>
    							    <div class='col-md-5'>
    							        <input type='text' class='form-control datepicker'  value="{{$todate}}{{old('todate')}}" name='todate' placeholder='To Date'>
    							        @error('todate')
    							         <small style='color:red'>{{$message}}</small>
    							         @enderror
    							     </div>
    							     
    							    <div class='col-md-2'>
    							        <button type="submit" style='float:right' class="btn btn-info px-5">Search</button>
    							     </div>
    							   
    						</div>
						</form>
					
					</div>
				</div>
				<div class="card">
					<div class="card-body">
					    <form action="{{route('record')}}" method='post'>
					        @csrf
    					    <div class='row'>
    							    <input type='hidden' class='form-control' value="r_orders" name='tablename'  >
    							   <div class='col-md-3'>
    							      @php
                                    $i = 1;
                                @endphp
                                
    							       <select id="type"  class="form-control" onchange="this.form.submit();" name="userid" placeholder="User Id">
    							           
                                           <option value="" >User Id.... </option>
                                           @foreach ($user as $d)
                                           
                                           <option @if(@$userid==$d->userid)selected @endif value="{{$d->userid}} ">{{$d->first_name}} {{$d->last_name}}({{ $d->userid }})</option>
                                           @endforeach
                                        </select>
    							          
    							        @error('userid')
    							         <small style='color:red'>{{$message}}</small>
    							         @enderror
    							     </div>
    							     
    							   <div class='col-md-8'> 
    							     <button type="button" style='float:right' id="myBtn" onclick="alluser()" class="btn btn-success px-3 ">All User</button>
    							     </div>
    						</div>
						</form>
					
					</div>
				</div>
            <!--end breadcrumb-->
    <!--           <div class="card">-->
				<!--	<div class="card-body">-->
				<!--		<div class="d-lg-flex align-items-center mb-4 gap-3">-->
				<!--			<div class="position-relative">-->
				<!--				<input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>-->
				<!--			</div>-->
				<!--		  <div class="ms-auto"><a href="javascript:;" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Order</a></div>-->
				<!--		</div>-->
				<!--		<div class="table-responsive">-->
				<!--			<table class="table mb-0">-->
				<!--				<thead class="table-light">-->
				<!--					<tr>-->
				<!--						<th>Order#</th>-->
				<!--						<th>Company Name</th>-->
				<!--						<th>Status</th>-->
				<!--						<th>Total</th>-->
				<!--						<th>Date</th>-->
				<!--						<th>View Details</th>-->
				<!--						<th>Actions</th>-->
				<!--					</tr>-->
				<!--				</thead>-->
				<!--				<tbody>-->
				<!--					<tr>-->
				<!--						<td>-->
				<!--							<div class="d-flex align-items-center">-->
				<!--								<div>-->
				<!--									<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">-->
				<!--								</div>-->
				<!--								<div class="ms-2">-->
				<!--									<h6 class="mb-0 font-14">#OS-000354</h6>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--						<td>Gaspur Antunes</td>-->
				<!--						<td><div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>FulFilled</div></td>-->
				<!--						<td>$485.20</td>-->
				<!--						<td>June 10, 2020</td>-->
				<!--						<td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td>-->
				<!--						<td>-->
				<!--							<div class="d-flex order-actions">-->
				<!--								<a href="javascript:;" class=""><i class='bx bxs-edit'></i></a>-->
				<!--								<a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--					</tr>-->
				<!--					<tr>-->
				<!--						<td>-->
				<!--							<div class="d-flex align-items-center">-->
				<!--								<div>-->
				<!--									<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">-->
				<!--								</div>-->
				<!--								<div class="ms-2">-->
				<!--									<h6 class="mb-0 font-14">#OS-000986</h6>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--						<td>Gaspur Antunes</td>-->
				<!--						<td><div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Confirmed</div></td>-->
				<!--						<td>$650.30</td>-->
				<!--						<td>June 12, 2020</td>-->
				<!--						<td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td>-->
				<!--						<td>-->
				<!--							<div class="d-flex order-actions">-->
				<!--								<a href="javascript:;" class=""><i class='bx bxs-edit'></i></a>-->
				<!--								<a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--					</tr>-->
				<!--					<tr>-->
				<!--						<td>-->
				<!--							<div class="d-flex align-items-center">-->
				<!--								<div>-->
				<!--									<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">-->
				<!--								</div>-->
				<!--								<div class="ms-2">-->
				<!--									<h6 class="mb-0 font-14">#OS-000536</h6>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--						<td>Gaspur Antunes</td>-->
				<!--						<td><div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Partially shipped</div></td>-->
				<!--						<td>$159.45</td>-->
				<!--						<td>June 14, 2020</td>-->
				<!--						<td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td>-->
				<!--						<td>-->
				<!--							<div class="d-flex order-actions">-->
				<!--								<a href="javascript:;" class=""><i class='bx bxs-edit'></i></a>-->
				<!--								<a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--					</tr>-->
				<!--					<tr>-->
				<!--						<td>-->
				<!--							<div class="d-flex align-items-center">-->
				<!--								<div>-->
				<!--									<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">-->
				<!--								</div>-->
				<!--								<div class="ms-2">-->
				<!--									<h6 class="mb-0 font-14">#OS-000678</h6>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--						<td>Gaspur Antunes</td>-->
				<!--						<td><div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>FulFilled</div></td>-->
				<!--						<td>$968.40</td>-->
				<!--						<td>June 16, 2020</td>-->
				<!--						<td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td>-->
				<!--						<td>-->
				<!--							<div class="d-flex order-actions">-->
				<!--								<a href="javascript:;" class=""><i class='bx bxs-edit'></i></a>-->
				<!--								<a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--					</tr>-->
				<!--					<tr>-->
				<!--						<td>-->
				<!--							<div class="d-flex align-items-center">-->
				<!--								<div>-->
				<!--									<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">-->
				<!--								</div>-->
				<!--								<div class="ms-2">-->
				<!--									<h6 class="mb-0 font-14">#OS-000457</h6>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--						<td>Gaspur Antunes</td>-->
				<!--						<td><div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Confirmed</div></td>-->
				<!--						<td>$689.50</td>-->
				<!--						<td>June 18, 2020</td>-->
				<!--						<td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td>-->
				<!--						<td>-->
				<!--							<div class="d-flex order-actions">-->
				<!--								<a href="javascript:;" class=""><i class='bx bxs-edit'></i></a>-->
				<!--								<a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--					</tr>-->
				<!--					<tr>-->
				<!--						<td>-->
				<!--							<div class="d-flex align-items-center">-->
				<!--								<div>-->
				<!--									<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">-->
				<!--								</div>-->
				<!--								<div class="ms-2">-->
				<!--									<h6 class="mb-0 font-14">#OS-000685</h6>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--						<td>Gaspur Antunes</td>-->
				<!--						<td><div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Confirmed</div></td>-->
				<!--						<td>$478.60</td>-->
				<!--						<td>June 20, 2020</td>-->
				<!--						<td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td>-->
				<!--						<td>-->
				<!--							<div class="d-flex order-actions">-->
				<!--								<a href="javascript:;" class=""><i class='bx bxs-edit'></i></a>-->
				<!--								<a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--					</tr>-->
				<!--					<tr>-->
				<!--						<td>-->
				<!--							<div class="d-flex align-items-center">-->
				<!--								<div>-->
				<!--									<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">-->
				<!--								</div>-->
				<!--								<div class="ms-2">-->
				<!--									<h6 class="mb-0 font-14">#OS-000356</h6>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--						<td>Gaspur Antunes</td>-->
				<!--						<td><div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Partially shipped</div></td>-->
				<!--						<td>$523.30</td>-->
				<!--						<td>June 21, 2020</td>-->
				<!--						<td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td>-->
				<!--						<td>-->
				<!--							<div class="d-flex order-actions">-->
				<!--								<a href="javascript:;" class=""><i class='bx bxs-edit'></i></a>-->
				<!--								<a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--					</tr>-->
				<!--					<tr>-->
				<!--						<td>-->
				<!--							<div class="d-flex align-items-center">-->
				<!--								<div>-->
				<!--									<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">-->
				<!--								</div>-->
				<!--								<div class="ms-2">-->
				<!--									<h6 class="mb-0 font-14">#OS-000875</h6>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--						<td>Gaspur Antunes</td>-->
				<!--						<td><div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>FulFilled</div></td>-->
				<!--						<td>$960.20</td>-->
				<!--						<td>June 24, 2020</td>-->
				<!--						<td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td>-->
				<!--						<td>-->
				<!--							<div class="d-flex order-actions">-->
				<!--								<a href="javascript:;" class=""><i class='bx bxs-edit'></i></a>-->
				<!--								<a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--					</tr>-->
				<!--					<tr>-->
				<!--						<td>-->
				<!--							<div class="d-flex align-items-center">-->
				<!--								<div>-->
				<!--									<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">-->
				<!--								</div>-->
				<!--								<div class="ms-2">-->
				<!--									<h6 class="mb-0 font-14">#OS-000658</h6>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--						<td>Gaspur Antunes</td>-->
				<!--						<td><div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>FulFilled</div></td>-->
				<!--						<td>$428.10</td>-->
				<!--						<td>June 25, 2020</td>-->
				<!--						<td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td>-->
				<!--						<td>-->
				<!--							<div class="d-flex order-actions">-->
				<!--								<a href="javascript:;" class=""><i class='bx bxs-edit'></i></a>-->
				<!--								<a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--					</tr>-->
				<!--					<tr>-->
				<!--						<td>-->
				<!--							<div class="d-flex align-items-center">-->
				<!--								<div>-->
				<!--									<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">-->
				<!--								</div>-->
				<!--								<div class="ms-2">-->
				<!--									<h6 class="mb-0 font-14">#OS-000689</h6>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--						<td>Gaspur Antunes</td>-->
				<!--						<td><div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Partially shipped</div></td>-->
				<!--						<td>$876.60</td>-->
				<!--						<td>June 26, 2020</td>-->
				<!--						<td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td>-->
				<!--						<td>-->
				<!--							<div class="d-flex order-actions">-->
				<!--								<a href="javascript:;" class=""><i class='bx bxs-edit'></i></a>-->
				<!--								<a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>-->
				<!--							</div>-->
				<!--						</td>-->
				<!--					</tr>-->
				<!--				</tbody>-->
				<!--			</table>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->
               <div class="card">
                <div class="table-responsive text-nowrap">
                    <div class="row"> <div class="col-md-12"><?php echo Session::flash('message'); ?></div></div>
                     <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                              <tr class='table-dark'>
                                    <th class='textcenter' >Sr.No</th>
                                    <th class='textcenter'>Order Id</th>
                                    <th class='textcenter'>Product Name</th>
                                     
                                    <th class='textcenter'>User</th>
                                    <th class='textcenter'>Role</th>
                                    <!--<th class='textcenter'>MRP</th>-->
                                    <!--<th class='textcenter'>Price</th>-->
                                    <!--<th class='textcenter'>Discount </th>-->
                                    <th class='textcenter'>Total</th>
                                    <th class='textcenter'>Payment Method</th> 
                                    <th class='textcenter'>Payment Status</th> 
                                    <th class='textcenter'>Total({{Helper::get_business_unit()}})</th>
                                    <th class='textcenter'>Delivery Status</th>
                                    <th class='textcenter'>Order Date</th>
                                    <th class='textcenter'>View Details</th>
                                    
                                    
                                    <th class='textcenter'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            @php
                                 $i = 1;
                                 @endphp
                                 @foreach ($data as $d)
                                 
								 @php $products = json_decode($d->products,true);
								 //dd($products);
								 @endphp
							 
                                
                                    <tr>
                                        <td class='textcenter'>{{$i++}}</td>
                                     <td class='textcenter'><?php echo $d->order_id; ?></td>

                                        <td class='textcenter'>{{$products['0']['name']}}</td>
                                        <td class='textcenter'>{{$d->first_name}} {{$d->last_name}}<br><span
                                                class="badge bg-gradient-quepal  text-white shadow-sm w-100">{{ $d->userid }}</span></td>
                                <td class='textcenter'><span style="text-transform:uppercase"  class="badge bg-gradient-quepal yes text-white shadow-sm w-100"><?php echo $d->role; ?></span></td>

                                       
                                         <td class='textcenter'>{{Helper::get_currency()}}{{$d->total}}</td> 
                                        <td class='textcenter'>{{$d->payment_methods}}</td>
                                       <td class='textcenter'>{{$d->payment_status}}</td>
                                         <td class='textcenter'>{{$d->total_bv}}{{Helper::get_business_unit()}}</td>
                                        <td class='textcenter'>
                                            <select class='form-control' id="selection{{$d->id}}" onchange="getvalue(<?php echo $d->id; ?>);"
                                             <?php if($d->order_status=='0'){?>style='background-color: #f54242;color: white;'<?php }?> 
                                             <?php if($d->order_status=='1'){?>style='background-color: blue;color: white;'<?php }?> 
                                             <?php if($d->order_status=='2'){?>style='background-color: green;color: white;'<?php }?> 
                                         
                                            >
                                               
                                               <?php if($d->order_status=='0'){?> 
                                               
                                               <option value='0' <?php if($d->order_status=='0'){ echo 'selected'; }?>>Confirmed</option>
                                               <option value='1' <?php if($d->order_status=='1'){ echo 'selected'; }?>>Dispatch</option>
                                               <option value='2' <?php if($d->order_status=='2'){ echo 'selected'; }?>>Delivered </option>
                                                <?php } ?>
                                               <?php if($d->order_status=='1'){?> 
                                               
                                                <option value='1' <?php if($d->order_status=='1'){ echo 'selected'; }?>>Dispatch</option>
                                               <option value='2' <?php if($d->order_status=='2'){ echo 'selected'; }?>>Delivered </option>
                                                <?php } ?>
                                               <?php if($d->order_status=='2'){?> 
                                                <option value='2' <?php if($d->order_status=='2'){ echo 'selected'; }?>>Delivered </option>
                                                <?php } ?>
                                                
                                               
                                            </select>
                                           
                                        </td>
                                        <td class='textcenter'>{{Helper::formatted_date( $d->date_time)}}</td>

                                        <td class='textcenter'>
                                           <button type="button" data-bs-toggle="modal" data-bs-target="#exampleWarningModal{{$d->id}}" class="btn btn-primary btn-sm radius-30 px-4">View Details</button>&nbsp;&nbsp; 
                                           
                                           <div class="col">
                                    	<div class="modal fade" id="exampleWarningModal{{$d->id}}" tabindex="-1" aria-hidden="true">
                                    	    <div class="modal-dialog modal-lg modal-dialog-centered">
                                    	        <div class="modal-content  ">
                                    	            	<div class="modal-header  ">
														<h5 class="modal-title text-dark text-right">Order Id :- {{$d->order_id}}</h5>  
										 @if($d->order_status=='0')
										  	 <div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>confirmed</div> 
										 
										 @elseif($d->order_status=='1')
										 <div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Dispatch</div> 
	                                    @else
	                                    <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Delivered</div> 
                                        
                                        @endif
                                           
                                        
											<button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
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
								      
                                    .yess{
                                        position: relative;
                                        top: 24px;
                                         background-color:#eded03!important;
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
						  <div class="ms-auto col-xs"><button class="border-0 bg-warning text-dark yess  rounded-top  col-xs-12 "><b>Total:- {{Helper::get_currency()}}{{$p['dp']*$p['quantity']}}</b></button></div>
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
												 <a href="{{ route('GenerateInvoice', ['id'=>$d->id]) }}" class=""><i class='fas fa-file-invoice'></i></a>

											 
											</div>
                                            
                                        </td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                           
                        </table>
                    </div>
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
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script>
    
     function getvalue(id){
        
       var value=$("#selection"+id).val();
       
       console.log(value);
        
          $.ajax({
            type: 'POST',
            url: "{{ route('change_Orderfirst1') }}",
            data: {"status": value,"id":id, "_token":"{{csrf_token()}}"},
            success: function (data) {
              if(data==1){
                location.reload();
              }
            }
        }); 
     }
   
      </script>
     <script>
function alluser() {
  location.href = "{{route('first_order_list')}}";
}
</script>
                    
@endsection
