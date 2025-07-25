@extends('user.layouts.main')
@section('mains')
@php $data=Auth::user();
$d=$data->id;
@endphp
	
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
								<li class="breadcrumb-item active" aria-current="page">Products Details</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
 
				 <div class="card">
					<div class="row g-0">
					  <div class="col-md-4 border-end">
					       &nbsp;&nbsp;
						<center><img src="{{asset('productImages')}}{{'/'}}{{$product[0]->image}}" width="350" height="450" class="img-fluid" alt="loading..."></center>
					  </div>
					  <div class="col-md-8">
						<div class="card-body">
						  <h4 class="card-title">{{$product[0]->product_name}}</h4>
						  <small id="outofStock" class="btn btn-danger" style='display:none;font-size: 12px;width: 13%;'></small>
						  <div class="d-flex gap-3 py-3"> 
							  <div class="d-flex align-items-center mt-3 fs-6">
                                                         <div class="cursor-pointer">
                                                             @for ($i=1; $i<=$product[0]->rating; $i++)
                                                                <i class="bx bxs-star text-warning"></i> 
                                                             @endfor
                                                             @for ($i=1;  $i<=(5-$product[0]->rating); $i++)
                                                                <i class="bx bxs-star text-secondary"></i> 
                                                             @endfor 
                                                              </div>
                                                 </div> 
						  </div>
						  <div class="mb-3"> 
							<span class="price h4">{{Helper::get_currency()}} {{$product[0]->dp}} </span> 
							<span class="text-muted">/per {{$product[0]->size}}</span> 
						</div>
						
						   <div class="mb-3"> 
							 @if($product[0]->discount_type=='percent')
                        <span class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$product[0]->percent_discount}}%off</span>
                        @elseif($product[0]->discount_type=='flat')
                       <span class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{Helper::get_currency()}}{{$product[0]->flat_discount}}off</span>
                       @else
                        @endif
                        
                        
                         @if($product[0]->discount_type=='percent')
                        <p class="mb-0 float-start fw-bold"><span class="me-2 text-decoration-line-through text-secondary ">{{Helper::get_currency()}}{{$product[0]->mrp}}</span>
                        
                            </p>
                              @elseif($product[0]->discount_type=='flat')
                               <p class="mb-0 float-start fw-bold"><span class="me-2 text-decoration-line-through text-secondary ">{{Helper::get_currency()}}{{$product[0]->mrp}}</span>
                        
                            </p>
                             @else
                        @endif
						</div>
						
						  <dl class="row">
							<dt class="col-sm-3">Business Value</dt>
							<dd class="col-sm-9"> {{$product[0]->business_value}} {{Helper::get_business_unit()}}</dd>
						  </dl>
						  
						  <hr>
						 
						   @php
                         $dataexists=DB::table('cart_items')->where('user_id',$d)->where('product_id',$id)->exists();
                        $get_id=  DB::table('product_stocks')->where('pid',$id)->get();
                            @endphp
                        @if($dataexists)
                        <div class='row'>
							  <left><a href="{{route('first_user_cart')}}" class="btn btn-outline-primary">Go to cart</a></left>
    				    </div>
						@elseif(($get_id[0]->stock)< 1)
                        <div class='row'>
							  <left><a href="#" class="btn btn-outline-danger">Out of Stock</a></left>
    				    </div>
						@else
                        	<div class='row'>
    							<div class="d-flex align-items-center">
    							  <div class='col-md-6 col-sm-6 col-lg-6 col-xl-6 col-xxl-6'>
    							      <button value="{{$id}}" class="btn btn-outline-primary getid" >Add&nbsp;to&nbsp;cart</button>
    							  </div>
    							  <div class='col-md-6 col-sm-6 col-lg-6 col-xl-6 col-xxl-6'>
    							      <a href="{{route('buy_now',['id'=>$id])}}" class="btn btn-primary pa" style="margin-left: -200px;">Buy&nbsp;Now</a>
    							  </div>
    							</div>
						   </div>
						@endif
						 
						</div>
					  </div>
					</div>
                    <hr>
					<div class="card-body">
						<ul class="nav nav-tabs nav-primary mb-0" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class="bx bx-comment-detail font-18 me-1"></i>
										</div>
										<div class="tab-title"> Product Description </div>
									</div>
								</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false" tabindex="-1">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class="bx bx-star font-18 me-1"></i>
										</div>
										<div class="tab-title">Reviews</div>
									</div>
								</a>
							</li>
						</ul>
						<div class="tab-content pt-3">
							<div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
								<p>{!!$product[0]->description!!}</p>
							</div>
						 
						</div>
					</div>
				  </div> 
				  
					<h6 class="text-uppercase mb-0">Recent Product</h6>
					<hr>
                     <div class="row row-cols-1 row-cols-lg-3">
                         @foreach($lastproduct as $yes)
						   <div class="col">
						    
							<div class="card">
								<div class="row g-0">
								  <div class="col-md-4">
								      <a href="{{route('first_product_details',['id'=>$yes->id])}}">
								          &nbsp;&nbsp;
										<center><img src="{{asset('productImages')}}{{'/'}}{{$yes->image}}" width="100" height="100" class="img-fluid" alt="loading..."></center>
										</a>
								  </div>
								  <div class="col-md-8">
									<div class="card-body">
									  <h6 class="card-title">{{$yes->product_name}}</h6>
									    <div class="d-flex align-items-center mt-3 fs-6">
                                                         <div class="cursor-pointer">
                                                             @for ($i=1; $i<=$yes->rating; $i++)
                                                                <i class="bx bxs-star text-warning"></i> 
                                                             @endfor
                                                             @for ($i=1;  $i<=(5-$yes->rating); $i++)
                                                                <i class="bx bxs-star text-secondary"></i> 
                                                             @endfor 
                                                              </div>
                                                 </div>
									  <div class="clearfix">
										<p class="mb-0 float-start fw-bold"><span class="me-2 text-decoration-line-through text-secondary">{{Helper::get_currency()}}{{$yes->mrp}}</span><span>{{Helper::get_currency()}}{{$yes->dp}}</span></p>
									 </div>
									 <dl class="row">
							<dt class="col-sm-3">B V</dt>
							<dd class="col-sm-9"> {{$yes->business_value}} {{Helper::get_business_unit()}}</dd>
						  </dl>
									</div>
								  </div>
								</div>
							  </div>
							 </a>
						   </div>
						 @endforeach  
					   </div>
			</div>
		</div>
		<!--End page wrapper -->
		<style>
 @media only screen and (max-width: 600px) {
  .pa{ 
    position:absolute;
    left:350px;
    bottom:350px;
  }
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.getid').on('click', function() {
                var productid = this.value;
                var userid = "<?php echo $d; ?>";
                $.ajax({
                    url: "{{ route('userid_productid') }}",
                    type: "POST",
                    data: {
                        user_id: userid,
                        product_id: productid,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result)
                    {
                        console.log(result);
                        
                            if(result==2){ 
                        	    Lobibox.notify('success', {
                        		pauseDelayOnHover: true,
                        		continueDelayOnInactiveTab: false,
                        		position: 'top right',
                        		icon: 'bx bx-check-circle',
                        	    msg: 'Product Added into Cart.'
                            	});
                            }else if(result==1){
                                Lobibox.notify('error', {
                        		pauseDelayOnHover: true,
                        		continueDelayOnInactiveTab: false,
                        		position: 'top right',
                        		icon: 'bx bx-x-circle',
                        		msg: "Already Added in your Cart! Please Visit Go To Cart."
                        	    });
                            }
                    }
                });
                  setTimeout(function() {
                    location.reload();
                }, 1000);
            });
        });
    </script>



@endsection

