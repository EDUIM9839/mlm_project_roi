@extends('admin.layouts.main')
@section('mains')
    <!--start page wrapper -->

<style>
	input{
		border-width: 1px !important;
	}

	.input-group-text{

		border-width: 1px !important;

	}
	
	 .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }
    
       input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
	 
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
</style>



    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
              <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Business Setup</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->
            
          
            
            <div class="card">
                <div class="card-body p-4">
                   
                    <div class="form-body ">
                         @if (session()->has('success'))
                                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
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
                         
                            <form     action="{{ route('update_data') }}" method="POST" enctype="multipart/form-data">
                                @csrf
								<h6 class="card-title pb-2"> Company Information</h6>
								<hr/>

					<div class="border p-4 rounded">
						<div class="row g-3 ">
                                <div class="col-md-6">
                                    <label for="inputLastName1" class="form-label">Business Name</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                        <input type="text" class="form-control  " name="business_name"
                                            value="{{ $bs->business_name }}" id="business_name"
                                            placeholder="Business Name" />
                                            </div>
                                             <span style="color:red;">{{$errors->first('business_name')}}</span> 
                                    
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">Email</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent">
                                       <i class="fa fa-envelope" aria-hidden="true"></i>
                                                </span>
                                        <input type="text" class="form-control "
                                            value="{{ $bs->email }}" name="email" id="email"
                                            placeholder="Email here" />
                                     
                                    </div>
                                     <span style="color:red;">{{$errors->first('email')}}</span> 
                                    </div>
                                </div>
                                <div class="row g-3  mt-2">
                                <div class="col-md-6">
                                    <label for="inputPhoneNo" class="form-label">Phone No</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-phone'></i></span>
                                        <input type="text" class="form-control"
                                            value="{{ $bs->phone }}" name="phone" id="phone"
                                            placeholder="Phone No" />
                                            </div>
                                             <span style="color:red;">{{$errors->first('phone')}}</span> 
                                    
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmailAddress" class="form-label">Country</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-map'></i></span>
                                        <input type="text" class="form-control"
                                            value="{{ $bs->country }}" name="country" id="country"
                                            placeholder="Country" />
                                             </div>
                                             <span style="color:red;margin-right:5px;">{{$errors->first('country')}}</span> 
                                   
                                </div>
                                </div>
                                <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputChoosePassword" class="form-label">Time Zone</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-time'></i></span>
                                        <input type="text" class="form-control"
                                            value="{{ $bs->time_zone }}" name="time_zone" id="time_zone"
                                            placeholder="Time Zone" />
                                            </div>
                                             <span style="color:red;">{{$errors->first('time_zone')}}</span> 
                                    
                                </div>
                                <div class="col-md-6">
                                    <label for="inputConfirmPassword" class="form-label">Time Format</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-time'></i></span>
                                        <input type="text" class="form-control"
                                            value="{{ $bs->time_format }}" name="time_format" id="time_format"
                                            placeholder="Time Format" />
                                            </div>
                                             <span style="color:red;">{{$errors->first('time_format')}}</span> 
                                    
                                    </div>
                                </div>
                                
                                <div class="row g-3  mt-2">
                                <div class="col-md-6">
                                    <label for="inputConfirmPassword" class="form-label">Currency Symbol</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent">
                                       <i class="bx bx-money"></i>
                                        </span>
                                        <input type="text" class="form-control" name="currency_symbol"
                                            value="{{ $bs->currency_symbol }}" id="currency_symbol"
                                            placeholder="Currency Symbol" />
                                             <span style="color:red;">{{$errors->first('currency_symbol')}}</span> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputConfirmPassword" class="form-label">ID Prefix</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                        <input type="text" class="form-control"
                                            value="{{ $bs->id_prefix }}" name="id_prefix" id="id_prefix"
                                            placeholder="ID Prefix" />
                                            </div>
                                             <span style="color:red;">{{$errors->first('id_prefix')}}</span> 
                                    
                             </div>
                               <div class="col-md-6">
                                    <label for="inputConfirmPassword" class="form-label">Business Value</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                        <input type="text" class="form-control"
                                            value="{{ $bs->business_unit }}" name="business_unit" id="business_unit"
                                            placeholder="Business Value" />
                                            </div>
                                             <span style="color:red;">{{$errors->first('business_unit')}}</span> 
                                    
                             </div>
                        </div>
					</div>
					 


                                <!-- Company Information end -->


								
                  <!-- Company Location start -->
                                
								<h6 class="card-title pt-3">Company Location</h6>
								<hr/>

								<div class="border   p-4 rounded">
									<div class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputLastName1" class="form-label">Address</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-map'></i></span>
                                        <input type="text" class="form-control border-start-0"
                                            value="{{ $bs->address }}" name="address" id="address"
                                            placeholder="Enter Location" />
                                             <span style="color:red;">{{$errors->first('address')}}</span> 
                                    </div>
                                      <span style="color:red;">{{$errors->first('address')}}</span> 
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">Footer Text</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-note'></i></span>
                                        <input type="text" class="form-control border-start-0"
                                            value="{{ $bs->footer_text }}" name="footer_text" id="footer_text"
                                            placeholder="Footer text" />
                                            </div>
                                             <span style="color:red;">{{$errors->first('footer_text')}}</span> 
                                    
                                </div>
							</div>
						</div>

                                <!-- Company Location end -->

                                <!-- Business Information -->


								<h6 class="card-title pt-3">Business Information</h6>
								<hr/>

							<!--	<div class="border p-4 rounded">-->
       <!--                             <div class="row g-3">-->
       <!--                                 <div class="col-md-6">-->
       <!--                                     <label for="inputLastName1" class="form-label">Tax/GST</label>-->
       <!--                                     <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bx-money" aria-hidden="true"></i></span>-->
       <!--                                     <input type="text" class="form-control border-start-0" name="tax_amount" value="{{$bs->tax_amount}}" id="tax_amount" placeholder="Tax/GST" />-->
       <!--                                     </div>-->
       <!--                                     <span style="color:red;">{{$errors->first('tax_amount')}}</span> -->
       <!--                                 </div>-->
       <!--                                 <div class="col-md-4">-->
       <!--                                     <label for="inputLastName2" class="form-label">Logo</label>-->
       <!--                                     <div class="input-group"> <span class="input-group-text bg-transparent"><i-->
       <!--                                     class='bx bxs-image'></i></span>-->
       <!--                                     <input type="file" class="form-control border-start-0" name="logo" id="logo" placeholder="Logo" />-->
       <!--                                     </div>-->
       <!--                                     <span style="color:red;">{{$errors->first('logo')}}</span> -->
                                            
       <!--                                 </div>-->
       <!--                                 <div class="col-md-2">-->
       <!--                                 <img src="{{ Storage::url('app/logo/').$bs->logo}}" style="width:100px">-->
       <!--                                 </div>-->
                                        
       <!--                                 <div class="col-md-6">-->
       <!--                                 <label for="inputLastName2" class="form-label">Fav Icon</label>-->
       <!--                                 <div class="input-group"> <span class="input-group-text bg-transparent"><i-->
       <!--                                 class='bx bxs-image'></i></span>-->
       <!--                                 <input type="file" class="form-control border-start-0"-->
       <!--                                 value="{{ $bs->fav_icon }}" name="fav_icon" id="fav_icon"-->
       <!--                                 placeholder="Fav Icon" />-->
       <!--                                 </div><br>-->
       <!--                                 <span style="color:red;">{{$errors->first('fav_icon')}}</span> -->
                                        
       <!--                                 </div>-->
       <!--                             </div>-->
       <!--                         <div class="col-md-2">-->
       <!--                             <img src="{{ Storage::url('app/logo/').$bs->fav_icon}}" style="width:100px">-->
       <!--                         </div>-->

 
                                <!-- Business Information end -->
                                
                                
                                   <!--<div class="row g-3">-->
                                        
                                   <!--     <div class="col-md-9">-->
                                   <!--         <label for="inputLastName2" class="form-label">Logo</label>-->
                                   <!--         <div class="input-group"> <span class="input-group-text bg-transparent"><i-->
                                   <!--         class='bx bxs-image'></i></span>-->
                                   <!--         <input type="file" class="form-control border-start-0" name="logo" id="logo" placeholder="Logo" />-->
                                   <!--         </div>-->
                                   <!--         <span style="color:red;">{{$errors->first('logo')}}</span> -->
                                            
                                   <!--     </div>-->
                                   <!--     <div class="col-md-3">-->
                                   <!--     <img src="{{ Storage::url('app/logo/').$bs->logo}}" style="width:100px">-->
                                   <!--     </div>-->
                                        
                                   <!-- </div>-->
                                
							<!--</div>-->
							
							
							
							
							
							
							
							    <div class="border p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label for="inputLastName1" class="form-label">Tax/GST</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i class="bx bx-money" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control border-start-0" name="tax_amount" value="{{$bs->tax_amount}}" id="tax_amount" placeholder="Tax/GST" />
                                            </div>
                                            <span style="color:red;">{{$errors->first('tax_amount')}}</span> 
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputLastName2" class="form-label">Company Logo</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                            class='bx bxs-image'></i></span>
                                            <input type="file" class="form-control border-start-0" name="logo" id="logo" placeholder="Logo" />
                                            </div>
                                            <span style="color:red;">{{$errors->first('logo')}}</span> 
                                            
                                            <img src="{{ Storage::url('app/logo/').$bs->logo}}" class='mt-3' style="width:100px;float:right;">
                                            
                                        </div>
                                      
                                        <div class="col-md-12">
                                            <label for="inputLastName2" class="form-label">Company Fav Icon</label>
                                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                            class='bx bxs-image'></i></span>
                                            <input type="file" class="form-control border-start-0"
                                            value="{{ $bs->fav_icon }}" name="fav_icon" id="fav_icon"
                                            placeholder="Fav Icon" />
                                            </div>
                                            <span style="color:red;">{{$errors->first('fav_icon')}}</span> 
                                             <img src="{{ Storage::url('app/logo/').$bs->fav_icon}}" class='mt-3' style="width:100px;float:right;">
                                        </div>
                                    </div>
                               
                                
							</div>
					        	
					        	
					        	<h6 class="card-title pt-3">Office Opening & Closing</h6>
								<hr/>
                                
                                <div class="border p-4 rounded">
								<div class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputLastName1" class="form-label">Opening Time</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-time'></i></span>
                                        <input type="text" class="form-control border-start-0"
                                            value="{{ $bs->opening_time }}" name="opening_time" id="opening_time"
                                            placeholder="Tax/GST" />
                                              </div>
                                        <span style="color:red;">{{$errors->first('opening_time')}}</span> 
                                 </div>
                              <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">Closing Time</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-time'></i></span>
                                        <input type="text" class="form-control border-start-0"
                                            value="{{ $bs->closing_time }}" name="closing_time" id="closing_time"
                                            placeholder="Logo" />
                                             </div>
                                    <span style="color:red;">{{$errors->first('closing_time')}}</span> 

                                   
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">Opening Day</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-calendar'></i></span>
                                        <input type="text" class="form-control border-start-0"
                                            value="{{ $bs->opening_day }}" name="opening_day" id="opening_day"
                                            placeholder="Fav Icon" />
                                             </div>
                                    <span style="color:red;">{{$errors->first('opening_day')}}</span> 

                                   
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">Closing Day</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-calendar'></i></span>
                                        <input type="text" class="form-control border-start-0"
                                            value="{{ $bs->closing_day }}" name="closing_day" id="closing_day"
                                            placeholder="Fav Icon" />
                                             </div>
                                        <span style="color:red;">{{$errors->first('closing_day')}}</span> 
                                            
                                   
                                </div>
                            </div>
                                <!-- Business Information end -->
                               
							</div>
					 </div>
					 
					 
                  <!-- Company Location start -->
                                
								<h6 class="card-title pt-3">Business setting</h6>
								<hr/>

								<div class="border   p-4 rounded">
									<div class="row g-3">
                                
                               @if( $bs->pending_user_all_page_access =='active')
                                 <h4 align='left'> <span style='font-size:18px;'>Pending User All Page Access : </span><label class="switch">
                                <input type="checkbox" name="pending_user_all_page_access" checked>
                                <span class="slider"></span>
                            </label>
                        </h4>
                        @else
                            <h4 align='left'> <span style='font-size:18px;'>Pending User All Page Access : </span><label class="switch">
                                <input type="checkbox" name="pending_user_all_page_access" >
                                <span class="slider"></span>
                            </label>
                        </h4>
                        @endif
							</div>
						 
                                <div align="right" class="btn-container justify-content-end mt-2"
                                    style="padding: 15px;">
                                    <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Save
                                        Information</button>
                                </div>
                                <!-- Company Location end -->
					 </div>
 
							</form> 
							</div>
							 
        @endsection
        
        
        
        
        
        
