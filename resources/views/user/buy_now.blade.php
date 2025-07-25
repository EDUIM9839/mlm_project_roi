@extends('user.layouts.main')
@section('mains')
@php $user = Auth::user(); @endphp

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">E Commerce</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
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

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Product Details Summery</h5>
                <hr>
                <div class="form-body mt-4">
                    
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
                  <form action="{{route('buy_now_from_wallet')}}" method="post">
                      @csrf()
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="border border-3 p-4 rounded">
                                 <h5 class="card-title">Billing & Shipping Address</h5>
                                <hr>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputPrice" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{$user->first_name }} {{$user->last_name}}"
                                        class="form-control" id="inputPrice" placeholder="Your Name">
                                       @error('name')
                                        <small style="color:red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCompareatprice" class="form-label">Mobile No</label>
                                        <input type="number" name="contact" value="{{$user->contact }}" class="form-control"
                                        id="inputCompareatprice" placeholder="+91 9000000000">
                                       @error('contact')
                                        <small style="color:red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCostPerPrice" class="form-label">City</label>
                                        <input type="text" name="city" value="{{$user->city }}" class="form-control"
                                        id="inputCostPerPrice" placeholder="Abc">
                                       @error('city')
                                        <small style="color:red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputStarPoints" class="form-label">State</label>
                                        <input type="text" name="state" class="form-control" value="{{$user->state }}"
                                        id="inputStarPoints" placeholder="Abc">
                                       @error('state')
                                        <small style="color:red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCostPerPrice1" class="form-label">Country</label>
                                        <input type="text" name="country" class="form-control" value="{{$user->country }}"
                                        id="inputCostPerPrice1" placeholder="India">
                                       @error('country')
                                        <small style="color:red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputStarPoints12" class="form-label"> Pin Code</label>
                                        <input type="number" name="zip" value="{{$user->zip }}" class="form-control"
                                        id="inputStarPoints12" placeholder="220000">
                                       @error('zip')
                                        <small style="color:red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
										<label for="input11" class="form-label">Address</label>
										<textarea class="form-control" name="address" id="input11" placeholder="Address ..." rows="3">{{$user->address }}</textarea>
									   @error('address')
                                        <small style="color:red">{{ $message }}</small>
                                        @enderror
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="border border-3 p-4 rounded">
                                <h5 class="card-title">Product Details</h5>
                                <hr>
                                <div class="row row-cols-1 row-cols-lg-3" >
                                         
                                    @php
                                    $image=DB::table('product_images')->where('pid',$id)->get();
                                    
                                    $da=DB::table('products')->where('id',$id)->get();
                                      
                                    @endphp
                                    <div class="col">
                                        <div class="card">
                                            <div class="row g-0">
                                                <div class="col-md-12">
                                                    <img src="{{asset('productImages') }}{{'/'}}{{$image[0]->image}}"
                                                        class="img-fluid" alt="Loading..."  style="height: 160px; width: 200px;">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{$da[0]->product_name}}</h6>
                                                         <div class="d-flex align-items-center mt-3 fs-6">
                                                         <div class="cursor-pointer">
                                                             @for ($i=1; $i<=$da[0]->rating; $i++)
                                                                <i class="bx bxs-star text-warning"></i> 
                                                             @endfor
                                                             @for ($i=1;  $i<=(5-$da[0]->rating); $i++)
                                                                <i class="bx bxs-star text-secondary"></i> 
                                                             @endfor 
                                                              </div>
                                                    <p class="mb-0 ms-auto">{{$da[0]->rating}}</p>
                                                </div>
                                                        
                                                         <div class="clearfix">
                                                             @if($da[0]->discount_type=='percent')
                                                            <p class="mb-0 float-start fw-bold">
                                                                <span class="me-2 text-decoration-line-through text-secondary">{{Helper::get_currency()}}{{$da[0]->mrp}}</span><span>{{Helper::get_currency()}}{{$da[0]->dp}}</span>
                                                            </p><br>
                                                             @elseif($da[0]->discount_type=='flat')
                                                             <p class="mb-0 float-start fw-bold">
                                                                <span class="me-2 text-decoration-line-through text-secondary">{{Helper::get_currency()}}{{$da[0]->mrp}}</span><span>{{Helper::get_currency()}}{{$da[0]->dp}}</span>
                                                            </p><br>
                                                              @else
                                                       @endif
                                                             <dt class="col-sm-12">BV : {{$da[0]->business_value}}</dt>
                                                        </div>
                                                          
                                                         <dt class="col-sm-12">Quantity : 1</dt>
                                                           <input type="hidden" name="business_value" class="form-control" value="{{$da[0]->business_value}}">
                                                           <input type="hidden" name="dp" class="form-control" value="{{$da[0]->dp}}">
                                                           <input type="hidden" name="product_id" class="form-control" value="{{$da[0]->id}}">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <hr>
                                      <h4 class="card-title">Payment</h4>
                                      <h6 class="card-title">Wallet Amount: {{Helper::get_currency()}} {{$user->saving_wallet}}</h6>
                                      @if(($da[0]->dp)>=($user->saving_wallet))
                                       <small style="color:red">Insufficient Balance Amount</small>
                                       @endif
                                        <div class="col-md-4 col-sm-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Pay From Wallet</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </form> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
