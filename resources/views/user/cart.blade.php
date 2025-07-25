@extends('user.layouts.main')
@section('mains')

<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">E Commerce</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Cart Details</li>
							</ol>
						</nav>
					</div>
					<!--<div class="ms-auto">-->
					<!--	<div class="btn-group">-->
					<!--		<button type="button" class="btn btn-primary">Settings</button>-->
					<!--		<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>-->
					<!--		</button>-->
					<!--		<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>-->
					<!--			<a class="dropdown-item" href="javascript:;">Another action</a>-->
					<!--			<a class="dropdown-item" href="javascript:;">Something else here</a>-->
					<!--			<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->
				</div>
				<!--end breadcrumb-->

				 <div class="card">
				    <?php 
				      foreach(Session::get('cart') as $row){
				          $products=DB::table('products')->where('id', $row['id'])->get();
				          $product_images=DB::table('product_images')->where('pid', $row['id'])->get();
				    ?> 
					<div class="row g-0">
					  <div class="col-md-2 border-end" style='text-align: center;margin-top:20px'>
						<img src="{{asset('productImages')}}{{'/'}}{{$product_images[0]->image}}" width="200" height="200" class="img-fluid" alt="loading...">
					  </div>
					  <div class="col-md-10" style='margin-top:10px'>
						<div class="card-body">
						  <h4 class="card-title">{{$row['name']}}</h4>
						
						  <div class="mb-3"> 
							 @if($product[0]->discount_type=='percent')
                        <span class="badge bg-success" style='margin-left:10px'>&nbsp;{{$product[0]->percent_discount}}%&nbsp;OFF</span>
                        @else
                       <span class="text-muted badge bg-success" style='margin-left:10px'>&nbsp;{{Helper::get_currency()}}{{$product[0]->flat_discount}}&nbsp; OFF</span>
                        @endif
                        <p class="mb-0 float-start fw-bold"><span class="me-2 text-decoration-line-through text-secondary ">{{Helper::get_currency()}}{{$row['mrp']}}</span>
                        @if($product[0]->discount_type=='percent')
                        <span >{{Helper::get_currency()}}{{$row['mrp']-$row['mrp']*$product[0]->percent_discount/100}}</span>
                        @else
                        <span>{{Helper::get_currency()}}{{$row['mrp']-$product[0]->flat_discount}}</span>
                        @endif
                            </p>
						</div>
						  <dl class="row">
							<dt class="col-sm-3">Business Value :&nbsp; {{Helper::get_currency()}} {{$product[0]->business_value}}</dt>
							<dd class="col-sm-9"></dd>
						  </dl>
					
						  <hr>
						  <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center" style="width:40%!important">
							<div class="col">
								<label class="form-label">Quantity</label>
								<div class="input-group input-spinner">
									<button class="btn btn-white" type="button" id="button-plus"> + </button>
								     <input type="text" class="form-control" value="{{$row['quantity']}}">
									<button class="btn btn-white" type="button" id="button-minus"> − </button>
								</div>
							</div> 
						</div>
						<div class="d-flex gap-3 mt-3" style='float:right'>
							<a href="#" class="badge bg-primary" style='margin-top: 20px;font-size: 15px;'>Remove</a>
						</div>
						</div>
					  </div>
					  <hr>
					</div>
					
					<?php } ?>
                   
				</div>

			</div>
		</div>
		<!--End page wrapper -->

@endsection