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
                            <li class="breadcrumb-item active" aria-current="page">Update Payment Details</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
               
                     @if (session()->has('success'))
                                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class='bx bxs-message-square-check'></i>
                                            </div>
                                            <div class="ms-3">
                                                 
                                                <div class="text-white">{!!session()->get('success')!!}</div>
                                            </div>
                                        </div>
                                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @elseif(session()->has('error'))
                                
                                
                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                    <div class=" "  >
                                        <div class="font-20 text-white"><i class='bx bxs-message-square-x' style='display:contents; !important' ></i><span style='font-size:16px;'>&nbsp;{!!session()->get('error')!!}</span>
                                        </div> 
                                          
                                               
                                             
                                        
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                                

                                @endif
                  
              <div class="card" style="width: 50%;left: 29%;">
                <div class="card-body p-4">
                   <h6 style="color:green">Update Payment</h6></span>
								<hr/>
                    <div class="form-body ">
                         
                            <form action="{{route('update_payment',['id'=>Auth::user()->id])}} " method="POST" enctype="multipart/form-data">
                                @csrf
								

					<div class="border p-4 rounded">
					    <input type="hidden" name="id">
						<div class="row g-6">
						      <label><b>Payment Method</b></label><br>
                    <select class='form-control' id='payment' name='upi_usdt'>
                    <option selected disabled>--SELECT --</option>
                        
                        <option name="upi_address" value="upi" >UPI  </option>
                      <option name="usdt_address" value="usdt" >USTD </option>
                    </select><br><br>
                       <div style="color:red;">{{ $errors->first('upi_usdt') }}</div>
                                <div class="col-md-12"><br>
                                <label class="form-label">Image Bar code:</label>
                                        <div class="input-group"> 
                                        <!--<span class="input-group-text bg-transparent"><i class='bx bxs-inbox'></i></span>-->
                                            <input type="file" class="form-control" 
                                                name="upi_image" placeholder="Enter UPI Image"
                                                id="upi_image">
                                               
                                        </div>
                                          <div style="color:red;">{{ $errors->first('upi_image') }}</div><br>
                                       
                                    <div class="col-md-12">
                                    <label for="inputLastName2" class="form-label">UPI Address</label>
                                    <div class="input-group"> 
                                    <!--<span class="input-group-text bg-transparent"><i class='lni lni-user'></i></span>-->
                                        <input type="text" class="form-control "
                                             name="upi_address" id="upi_address"
                                            placeholder="upi address here" />
                                    </div>
                                     <div style="color:red;">{{ $errors->first('upi_address') }}</div>
                                </div></br>
                              
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="submit" class="btn btn-success">Update</button> 
                                    </div>
                                   
                              

							</form>
					</div>
                        </div>
                    </div>
                </div>
            </div>
                       

          </div>
             <div class="card" style="">
                <div class="card-body p-4">
                    <div class="row">
                        <div class='col-sm-6 text-center'>
                           <h4>USDT Details</h4>
                           <hr>
                           <h5>USDT Address:{{Auth::user()->usdt_address}}</h5>
                           <img src='{{asset("user_self_payment_barcode/".Auth::user()->usdt_image)}}' style="width:200px;height:200px">
                        </div>
                        <div class='col-sm-6 text-center'>
                            <h4>UPI Details</h4> 
                            <hr>
                             <h5>UPI Address:{{Auth::user()->upi_address}}</h5>
                           <img src='{{asset("user_self_payment_barcode/".Auth::user()->upi_image)}}' style="width:200px;height:200px">
                        </div>
                    </div>
                </div>
            </div>
                 <!-- Scrollable -->
                 </div>
                 </div>
                 
 
@endsection