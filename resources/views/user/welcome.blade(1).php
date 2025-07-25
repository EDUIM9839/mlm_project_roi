@extends('user.layouts.main')
@section('mains')
@php	$data=Auth::user(); $d=$data->id;  @endphp
<style>
    /* only animate if the device supports hover */
   @media (hover: hover) {
   #creditcard {
   /*  set start position */
   transform: translateY(110px);
   transition: transform 0.1s ease-in-out;
   /*  set transition for mouse enter & exit */
   }
   #money {
   /*  set start position */
   transform: translateY(180px);
   transition: transform 0.1s ease-in-out;
   /*  set transition for mouse enter & exit */
   }
   button:hover #creditcard {
   transform: translateY(0px);
   transition: transform 0.2s ease-in-out;
   /*  overide transition for mouse enter */
   }
   button:hover #money {
   transform: translateY(0px);
   transition: transform 0.3s ease-in-out;
   /*  overide transition for mouse enter */
   }
   }
   @keyframes bounce {
   0% {
   transform: translateY(0);
   }
   50% {
   transform: translateY(-0.25rem);
   }
   100% {
   transform: translateY(0);
   }
   }
   .button:hover .button__text span {
   transform: translateY(-0.25rem);
   transition: transform .2s ease-in-out;
   }
</style>
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
				<div class="breadcrumb-title pe-3">Home</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/user/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Products</li>
							</ol>
						</nav>
					</div>
					<!--<div class="ms-auto">-->
					
					    
					
            </div>
            <div class="ms-auto">
                 <div class='row'>
        
           <div class='col-md-6'>
            <button class="button" style='float:right;font-size: 12px;'>
               <span class="button__text">
               <span style="color:#fbff00e6;">Wallet Amount: {{Helper::get_currency()}} {{($data->saving_wallet)}}</span>
               </span>
               <svg class="button__svg" role="presentational" viewBox="0 0 600 600">
                  <defs>
                     <clipPath id="myClip">
                        <rect x="0" y="0" width="100%" height="50%" />
                     </clipPath>
                  </defs>
                  <g clip-path="url(#myClip)">
                     <g id="money">
                        <path d="M441.9,116.54h-162c-4.66,0-8.49,4.34-8.62,9.83l.85,278.17,178.37,2V126.37C450.38,120.89,446.56,116.52,441.9,116.54Z" fill="#699e64" stroke="#323c44" stroke-miterlimit="10" stroke-width="14" />
                        <path d="M424.73,165.49c-10-2.53-17.38-12-17.68-24H316.44c-.09,11.58-7,21.53-16.62,23.94-3.24.92-5.54,4.29-5.62,8.21V376.54H430.1V173.71C430.15,169.83,427.93,166.43,424.73,165.49Z" fill="#699e64" stroke="#323c44" stroke-miterlimit="10" stroke-width="14" />
                     </g>
                     <g id="creditcard">
                        <path d="M372.12,181.59H210.9c-4.64,0-8.45,4.34-8.58,9.83l.85,278.17,177.49,2V191.42C380.55,185.94,376.75,181.57,372.12,181.59Z" fill="#a76fe2" stroke="#323c44" stroke-miterlimit="10" stroke-width="14" />
                        <path d="M347.55,261.85H332.22c-3.73,0-6.76-3.58-6.76-8v-35.2c0-4.42,3-8,6.76-8h15.33c3.73,0,6.76,3.58,6.76,8v35.2C354.31,258.27,351.28,261.85,347.55,261.85Z" fill="#ffdc67" />
                        <path d="M249.73,183.76h28.85v274.8H249.73Z" fill="#323c44" />
                     </g>
                  </g>
                  <g id="wallet">
                     <path d="M478,288.23h-337A28.93,28.93,0,0,0,112,317.14V546.2a29,29,0,0,0,28.94,28.95H478a29,29,0,0,0,28.95-28.94h0v-229A29,29,0,0,0,478,288.23Z" fill="#a4bdc1" stroke="#323c44" stroke-miterlimit="10" stroke-width="14" />
                     <path d="M512.83,382.71H416.71a28.93,28.93,0,0,0-28.95,28.94h0V467.8a29,29,0,0,0,28.95,28.95h96.12a19.31,19.31,0,0,0,19.3-19.3V402a19.3,19.3,0,0,0-19.3-19.3Z" fill="#a4bdc1" stroke="#323c44" stroke-miterlimit="10" stroke-width="14" />
                     <path d="M451.46,435.79v7.88a14.48,14.48,0,1,1-29,0v-7.9a14.48,14.48,0,0,1,29,0Z" fill="#a4bdc1" stroke="#323c44" stroke-miterlimit="10" stroke-width="14" />
                     <path d="M147.87,541.93V320.84c-.05-13.2,8.25-21.51,21.62-24.27a42.71,42.71,0,0,1,7.14-1.32l-29.36-.63a67.77,67.77,0,0,0-9.13.45c-13.37,2.75-20.32,12.57-20.27,25.77l.38,221.24c-1.57,15.44,8.15,27.08,25.34,26.1l33-.19c-15.9,0-28.78-10.58-28.76-25.93Z" fill="#7b8f91" />
                     <path d="M148.16,343.22a6,6,0,0,0-6,6v92a6,6,0,0,0,12,0v-92A6,6,0,0,0,148.16,343.22Z" fill="#323c44" />
                  </g>
               </svg>
            </button>
         </div>
        
      </div>
            </div>
           
					<!--<div class="ms-auto">-->
					    
     <!--                   <span><img src="https://mlmlaravel.swasoftech.in/public/assets/images/Wallet_Cash.gif" style="width:40px; height:45px;"></span> &nbsp;<h4 style="display: contents"> {{Helper::get_currency()}} {{($data->saving_wallet)}}</h4>-->
					<!--</div>-->
		    	</div>
            <hr/>
            
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-4 product-grid">
            @foreach($product as $row)
            <div class="col">
                <div class="card">
                    <div class='row'>
                        <div class='col-md-12'>
                                @if(($row->stock)< 1)
                                <div><span style='float:left;margin-left:2px;font-size:13px' class="badge bg-danger">{{$row->stock}}&nbsp;Out of Stock</span></div>
                                @else
                                <div><span style='float:left;margin-left:2px;font-size:13px' class="badge bg-success">{{$row->stock}}&nbsp;Qty</span></div>
                                @endif
                                @if(!empty($row->percent_discount))
                                    <div><span style='float:right;margin-right:2px;font-size:13px' class="badge bg-info">{{$row->percent_discount}}% &nbsp;OFF</span></div>
                                @elseif(!empty($row->flat_discount))
                                 <div><span style='float:right;margin-right:2px;font-size:13px' class="badge bg-info">{{Helper::get_currency()}}{{$row->flat_discount}}&nbsp;OFF</span></div>
                                @endif
                        </div>
                    </div>
                    <a href="{{route('product_details',['id'=>$row->id])}}">
                    <img src="{{asset('productImages')}}{{'/'}}{{$row->image }}" width="200" height="250" class="card-img-top" alt="loading...">
                    </a>
                    <div class="card-body">
                        <h6 class="card-title cursor-pointer">{{$row->product_name}}</h6>
                        <div class="clearfix">
                            <p class="mb-0 float-start"><strong>{{$row->business_value}} </strong>BV</p>
                            <p class="mb-0 float-end fw-bold"><span
                                class="me-2 text-decoration-line-through text-secondary">{{Helper::get_currency()}}{{$row->mrp}}</span><span>{{Helper::get_currency()}}{{$row->dp}}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center mt-3 fs-6">
                            <div class="cursor-pointer">
                                @for ($i=1;  $i<$row->rating; $i++)
                                   <i class="bx bxs-star text-warning"></i> 
                                @endfor
                                <i class="bx bxs-star text-secondary"></i>
                            </div>
                            <p class="mb-0 ms-auto">{{$row->rating}}</p>
                        </div>
                        @php
                         $dataexists=DB::table('cart_items')->where('user_id',$d)->where('product_id',$row->id)->exists();
                        @endphp
                        @if($dataexists)
                        <div class='row'>
							  <center><a href="{{route('user_cart')}}" class="btn btn-outline-primary">Go to cart</a></center>
    				    </div>
						@elseif(($row->stock)< 1)
                        <div class='row'>
							  <center><a href="#" class="btn btn-outline-danger">Out of Stock</a></center>
    				    </div>
						@else
                        	<div class='row'>
    							<div class="d-flex align-items-center">
    							  <div class='col-md-6 col-sm-6 col-lg-6 col-xl-6 col-xxl-6'>
    							      <button value="{{$row->id}}" class="btn btn-outline-primary getid"  style="float:left;">Add&nbsp;to&nbsp;cart</button>
    							  </div>
    							  <div class='col-md-6 col-sm-6 col-lg-6 col-xl-6 col-xxl-6'>
    							      <a href="{{route('buy_now',['id'=>$row->id])}}" class="btn btn-primary ha" style="float:Right;">Buy&nbsp;Now</a>
    							  </div>
    							</div>
						   </div>
						@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div><!--end row-->
    </div>
</div>
<style>
    @media only screen and (max-width: 600px) {
  .ha{
    
    position:absolute;
    left:235px;
    bottom:15px;
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
