@extends('admin.layouts.main')
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Stock Transfer</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->
                 
            <hr />
           <div class='row'>
               <div class='col-md-2'>
                   
               </div>
                <div class='col-md-8'>
                     <div class="card">
							<div class="card-body p-4">
								<h5 class="mb-4">Upload Payment Proof</h5>
								<?php echo Session::get('message');?>
								<form class="row g-3" method='post' action='{{route("Tstock")}}' enctype='multipart/form-data'>
								    @csrf
									<?php 
									
									   $cart=Session::get('cart');//print_r($cart);
									   $total=0;
									   
									   foreach($cart as $row){
									      $customer_id=$row['user_id'];
									      $invoicedate=$row['invoicedate'];
									      $total+=($row['mrp']-$row['mrp']*$row['percent_discount']/100)*$row['quantity'];
									      $from_id=$row['from_id'];
									    
									   }
									
									?>
									<div class="col-md-12">
									   
									   <input type='hidden' id='allproducts' name='allproducts' value='<?php print_r(json_encode($cart)); ?>'>
									   <input type='hidden' id='invoicedate' name='invoicedate' value='<?php echo $invoicedate; ?>'>
									   <input type='hidden' id='total' name='total' value='<?php echo $total; ?>'>
									    <input type='hidden' id='from_id' name='from_id' value='<?php echo $from_id; ?>'>
									   <input type='hidden' id='to_id' name='to_id' value='<?php echo $customer_id; ?>'>
									   <div class="position-relative input-icon">
											<input type="file" class="form-control" id="image" name='image'>
											<span class="position-absolute top-50 translate-middle-y"><i class="lni lni-image"></i></span>
										
										</div>
										@error('image')
										  <small style='color:red'> {{$message}} </small>
										@enderror
									</div>
				                    <div class="col-md-12">
										<div class="d-md-flex d-grid align-items-center gap-3" style='float:right'>
											<button type="submit" class="btn btn-primary px-4">Upload</button>
										
										</div>
									</div>
								</form>
							</div>
						</div>
               </div>
                <div class='col-md-2'>
                   
               </div>
           </div>
          
        </div>
    </div>
    </div>
  
@endsection
