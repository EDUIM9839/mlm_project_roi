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
					@php
					$user_id=Auth::user()->id;
					$check_status = DB::table('user_package')->where('user_id',$user_id)->where('status',"=",'approved')->count();
					 if($check_status==0){
					@endphp
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('welcome')}}" type="button" class="btn btn-primary"><i class="lni lni-arrow-left-circle"></i> Product</a>
						</div>
					</div>
					@php }else{ @endphp
						<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('products')}}" type="button" class="btn btn-primary"><i class="lni lni-arrow-left-circle"></i> Product</a>
						</div>
							@php } @endphp
					</div>
				</div>
				<!--end breadcrumb-->
			  <div class="container-fluid">
				<div class="card">
				<!--	<div class="row g-0">-->
					            @php
                                $num=count($data);
                                @endphp
                                @if($num)
                    <div class="table-responsive">
			         	<table class="table">
                          <thead>
                            <tr>
                              <th>Product</th>
                              <th>Product Price</th>
                              <th>Quantity</th>
                              <th>Discount</th>
                              <th>Subtotal</th>
                              <th>Business Value</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                          @endif
                            @foreach($data as $d)
                             @php
            			       $da=DB::table('products')->where('id',$d->product_id)->get();
            			      
            			       $image=DB::table('product_images')->where('pid',$d->product_id)->get();
            			     
            			     @endphp
            			     
			 
			   
                                   <tr>
                                    <td>
                                      <img src="{{asset('productImages')}}{{'/'}}{{$image[0]->image}}" style="width: 100px; height: 100px;">
                                      <span style="font-size:25px;">{{$da[0]->product_name}}</span>
                                    </td>
                                     @if(!empty($da[0]->percent_discount))
                                    <td><p class="mt-4 fw-bold"><span class="me-2 text-decoration-line-through text-secondary ">{{Helper::get_currency()}}{{$da[0]->mrp}}</span> <span >{{Helper::get_currency()}}{{$da[0]->dp}}</span>
                                       </p></td>
                                        @elseif(!empty($da[0]->flat_discount))
                                        <td><p class="mt-4 fw-bold"><span class="me-2 text-decoration-line-through text-secondary ">{{Helper::get_currency()}}{{$da[0]->mrp}}</span> <span >{{Helper::get_currency()}}{{$da[0]->dp}}</span>
                                       </p></td>
                                         @else
                                          <td><p class="mt-4 fw-bold"> <span >{{Helper::get_currency()}}{{$da[0]->dp}}</span>
                                       </p></td>
                                        @endif
                                    <td><div class="row mt-4  row-cols-1 row-cols-md-3 row-cols-sm-3 align-items-center">
            							<div class="col">
            								<div class="input-group input-spinner input-group mb-3" style="width: 130px;">
            									<button value="{{$d->product_id}}" class="btn btn-white getid2" type="button" id="button-minus"> − </button>
            								     <input type="text" readonly class="form-control text-center" value="{{$d->quantity}}">
            									<button value="{{$d->product_id}}" class="btn btn-white getid1" type="button" id="button-plus"> + </button>
            								</div>
            							</div> 
						              </div></td>
                                    <td> 
            						 @if($da[0]->discount_type=='percent')
                                    <span class=" mt-4 badge bg-success" style='margin-left:10px'>&nbsp;{{$da[0]->percent_discount}}%&nbsp;OFF</span>
                                    @elseif($da[0]->discount_type=='flat')
                                    <span class="badge bg-success" style='margin-left:10px'>&nbsp;{{Helper::get_currency()}}{{$da[0]->flat_discount}}&nbsp;OFF</span>
                                    @else
                                     <span class=" mt-4 badge bg-success" style='margin-left:10px'>&nbsp;{{Helper::get_currency()}}0&nbsp;OFF</span>
                                    @endif
            					     </td>
                                    <td><div class="mt-4">{{Helper::get_currency()}}{{($d->quantity)*($da[0]->dp)}}</div></td>
                                    <td><div class="mt-4">BV {{$da[0]->business_value}}</div></td>
                                    <td> 
                                  	<div class="d-flex gap-3 mt-3" style='float:right'>
        							<button href="#" value="{{$d->product_id}}"class="badge bg-danger getid" style='margin-top: 20px;font-size: 15px;'>Remove</button>
        						   	</div>
                                    </td>
                                  </tr>
                                   @endforeach
                              
                                @php $num=count($data);  $total=0; $bv=0; @endphp
                                    @foreach($data as $d)
                                    @php
                                    $quantity=$d->quantity;
                                    $ds=DB::table('products')->where('id',$d->product_id)->get();
                                    $total+=$ds[0]->dp*$quantity;
                                    $bv+=$ds[0]->business_value*$quantity;
                                    @endphp
                                    @endforeach
                                @if($num)
                                <tr>
                                <td><h2>Total: </h2></td>
                                <td><h2>{{Helper::get_currency()}} {{$total}} </h2></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><h2>BV {{$bv}}</h2></td>
                                <td></td>
                                <td></td>
                              </tr>
                          </tbody>
                        </table>
                    </div>
				</div>
                  @endif
              </div>
			</div>
              @if($num)
              <center><a href="{{route('product_summery')}}" type="button" class="btn btn-primary"><i class="lni lni-bolt-alt"></i> Buy Now</a></center>
              @else
              
              <div class="row">
                <div class="col-md-12 col-sm-12 bg-white p-5">
                     <div class="text-center">                                                    
                <a href="{{route('products')}}"> <img src="{{asset('/assets/images/empty-cart.svg')}}" class="img-responsive"></a>
                 <h5 class="mt-4">Empty Cart</h5>
                <p class="text-muted">Lets add something in it !!</p>
                <a href="{{route('products')}}" class="btn btn-primary "> Continue Shopping</a>
            </div> 
                </div>
            </div>
              
              @endif
			
			
		</div>
		<!--End page wrapper -->
	</div>
@php
$data=Auth::user();
$d=$data->id;
@endphp
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.getid').on('click', function() {
                var productid = this.value;
                var userid = "<?php echo $d; ?>";
                $.ajax({
                    url: "{{ route('remove_cart') }}",
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
                        
                            if(result==1){ 
                                location.reload();
                            }else if(result==2){
                                
                                 setTimeout(function() {
                                    location.reload();
                                }, 4000);
                                
                                Lobibox.notify('error', {
                        		pauseDelayOnHover: true,
                        		continueDelayOnInactiveTab: false,
                        		position: 'top right',
                        		icon: 'bx bx-x-circle',
                        		msg: "Already Removed From Your Cart."
                        	    });
                            }   
                    }
                });
            });
        });
    </script>
    
	 <script>
        $(document).ready(function() {
            $('.getid1').on('click', function() {
                var productid = this.value;
                var userid = "<?php echo $d; ?>";
                $.ajax({
                    url: "{{ route('update_cart') }}",
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
                            if(result==1){ 
                                location.reload();
                        	  
                            }else if(result==2){
                                Lobibox.notify('error', {
                        		pauseDelayOnHover: true,
                        		continueDelayOnInactiveTab: false,
                        		position: 'top right',
                        		icon: 'bx bx-x-circle',
                        		msg: "Sorry! You Can't Add More Product into Cart."
                        	    });
                            }   
                    }
                });
                
            });
        });
    </script>	
		
			 <script>
        $(document).ready(function() {
            $('.getid2').on('click', function() {
                var productid = this.value;
                var userid = "<?php echo $d; ?>";
                $.ajax({
                    url: "{{ route('update_cart_minus') }}",
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
                            if(result==1){ 
                                location.reload();
                        	    
                            }else if(result==2){
                                
                                Lobibox.notify('error', {
                        		pauseDelayOnHover: true,
                        		continueDelayOnInactiveTab: false,
                        		position: 'top right',
                        		icon: 'bx bx-x-circle',
                        		msg: "Sorry! You Can't Decreases Your Product Quantity in Your Cart."
                        	    });
                            }   
                    }
                });
                
                
            });
        });
    </script>	

@endsection
