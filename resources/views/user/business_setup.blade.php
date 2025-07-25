@extends('layouts.main')
@section('mains')
    <!--start page wrapper -->

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Business Setup</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User List</li>
                        </ol>
                    </nav>
                </div>
				<div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button"
                            class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                                href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                                link</a>
                        </div>
                    </div>
                </div>
           </div>
           <div class="card border-top border-0 border-4 border-white">
							<div class="card-body p-2">
							<form class="row g-3" action="{{route('update_data')}}" method="POST">
								@csrf
					<div class="card-title d-flex align-items-center">
						<div><i class="bx bxs-user me-1 font-22 text-black"></i></div>
						<h5 class="mb-0 text-black">Company Information</h5>
					</div>
					<div class="col-md-3">
										<label for="inputLastName1" class="form-label">Business Name</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
											<input type="text" class="form-control border-start-0" name="business_name"  value="{{$bs->business_name}}" id="business_name" placeholder="Business Name" />
										</div>
									</div>
									<div class="col-md-3">
										<label for="inputLastName2" class="form-label">Email</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-inbox'></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->email}}" name="email" id="email" placeholder="Email here" />
										</div>
									</div>
									<div class="col-md-3">
										<label for="inputPhoneNo" class="form-label">Phone No</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-phone' ></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->phone}}" name="phone" id="phone" placeholder="Phone No" />
										</div>
									</div>
									<div class="col-md-3">
										<label for="inputEmailAddress" class="form-label">Country</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-map' ></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->country}}" name="country" id="country" placeholder="Country" />
										</div>
									</div>
									<div class="col-md-3">
										<label for="inputChoosePassword" class="form-label">Time Zone</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-time' ></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->time_zone}}" name="time_zone" id="time_zone" placeholder="Time Zone" />
										</div>
									</div>
									<div class="col-md-3">
										<label for="inputConfirmPassword" class="form-label">Time Format</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-time' ></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->time_format}}" name="time_format" id="time_format" placeholder="Time Format" />
										</div>
									</div>
									<div class="col-md-3">
										<label for="inputConfirmPassword" class="form-label">Currency Symbol</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-coin' ></i></span>
											<input type="text" class="form-control border-start-0" name="currency_symbol" value="{{$bs->currency_symbol}}" id="currency_symbol" placeholder="Currency Symbol" />
										</div>
                                </div>
								<div class="col-md-3">
										<label for="inputConfirmPassword" class="form-label">ID Prefix</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user' ></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->id_prefix}}" name="id_prefix" id="id_prefix" placeholder="ID Prefix" />
										</div>
                                </div>
                              

								

<!-- Company Information end -->

<!-- Company Location start -->
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-black"></i></div>
									<h5 class="mb-0 text-black">Company Location</h5>
								</div>
                         
									<div class="col-md-6">
										<label for="inputLastName1" class="form-label">Address</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-map'></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->address}}" name="address" id="address" placeholder="Enter Location" />
										</div>
									</div>
									<div class="col-md-6">
										<label for="inputLastName2" class="form-label">Footer Text</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-note'></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->footer_text}}" name="footer_text" id="footer_text" placeholder="Footer text" />
										</div>
									</div>

								
<!-- Company Location end -->

<!-- Business Information -->


								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-black"></i></div>
									<h5 class="mb-0 text-black">Business Information</h5>
								</div>
                         
            
        
									<div class="col-md-6">
										<label for="inputLastName1" class="form-label">Tax/GST</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-inbox'></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->tax_amount}}" name="tax_amount" id="tax_amount" placeholder="Tax/GST" />
										</div>
									</div>
									<div class="col-md-6">
										<label for="inputLastName2" class="form-label">Logo</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-image'></i></span>
											<input type="file" class="form-control border-start-0" value="{{$bs->logo}}" name="logo" id="logo" placeholder="Logo" />
										</div>
									</div>
									
									<div class="col-md-6">
										<label for="inputLastName2" class="form-label">Fav Icon</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-image'></i></span>
											<input type="file" class="form-control border-start-0" value="{{$bs->fav_icon}}" name="fav_icon" id="fav_icon" placeholder="Fav Icon" />
										</div>
									</div>

								

<!-- Business Information end -->
<!-- Office Start -->

								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-black"></i></div>
									<h5 class="mb-0 text-black">Office Opening&Closing</h5>
								</div>
                         
									<div class="col-md-6">
										<label for="inputLastName1" class="form-label">Opening Time</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-time'></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->opening_time}}" name="opening_time" id="opening_time" placeholder="Tax/GST" />
										</div>
									</div>
									<div class="col-md-6">
										<label for="inputLastName2" class="form-label">Closing Time</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-time'></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->closing_time}}" name="closing_time" id="closing_time" placeholder="Logo" />
										</div>
									</div>
									
									<div class="col-md-6">
										<label for="inputLastName2" class="form-label">Opening Day</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-calendar'></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->opening_day}}" name="opening_day" id="opening_day" placeholder="Fav Icon" />
										</div>
									</div>
                               
									<div class="col-md-6">
										<label for="inputLastName2" class="form-label">Closing Day</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-calendar'></i></span>
											<input type="text" class="form-control border-start-0" value="{{$bs->closing_day}}" name="closing_day" id="closing_day" placeholder="Fav Icon" />
										</div>
									</div>

								
<!-- Office End -->
								<div align="right" class="btn-container justify-content-end mt-2" style="padding: 15px;">
									<button type="reset" name="reset" class="btn btn-danger">Reset</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Save Information</button>
								</div>
           </div>
        </div>
    </div>
</div>


@endsection
