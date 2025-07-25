@extends('layouts.main')
@section('mains')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <!-- header start -->
                <div class="breadcrumb-title pe-3">SMS Gateway Setup</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User List</li>
                        </ol>
                    </nav>
                </div>
                <!-- header end -->
                <!-- setting start -->
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
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                        </div>
                    </div>
                </div>
				</div>
                <!-- setting end -->
				<!-- Form Section Start -->
				
			<div class="row g-3">
				<div class="col-md-6">
				<div class="card h-100">
					<div class="card-body">
					<form class="sms-module-form" action="{{route('update_sms_twilio')}}" method="post">
                        @csrf
						<!-- <div class="card" style="width: 25rem;">
							<div class="card-body"> -->
							
								<h5 class="d-flex flex-wrap justify-content-between align-items-center text-uppercase">
								
									<span class="mb-0 text-black">TWILIO</span>
								
								<div class="pl-2">
									<img src="../assets/images/twilio.png" width="38px" height="38px">
								</div>
								</h5>
								<span class="badge badge-info mb-3" style="--bs-badge-color: #00c9db; background-color: rgba(0,201,219,0.1);"> NB : #OTP# will be replace with otp </span>
								<div class="d-flex flex-wrap mb-4">
                                    <label class="form-check form--check mr-2 mr-md-4">
                                        <input class="form-check-input" type="radio" name="status" value="1">
                                        <span class="form-check-label text--title pl-2">Active</span>
                                    </label>
									&nbsp; &nbsp;
                                    <label class="form-check form--check">
                                        <input class="form-check-input" type="radio" name="status" value="0" checked="">
                                        <span class="form-check-label text--title pl-2">Inactive </span>
                                    </label>
                                </div>
								<div class="form-group">
                                    <label class="text-capitalize form-label">SID</label>
                                    <input type="text" class="form-control" name="sid" value="{{$sc->sid}}">
                                </div>
								<div class="form-group">
                                    <label class="text-capitalize form-label">Messaging Service Sid</label>
                                    <input type="text" class="form-control" name="messaging_service_sid" value="{{$sc->messaging_service_sid}}">
                                </div>
								<div class="form-group">
                                    <label class="text-capitalize form-label">Token</label>
                                    <input type="text" class="form-control" name="token" value="{{$sc->token}}">
                                </div>
								<div class="form-group">
                                    <label class="text-capitalize form-label">From</label>
                                    <input type="text" class="form-control" name="from_twilio" value="{{$sc->from_twilio}}">
                                </div>
								<div class="form-group">
                                    <label class="text-capitalize form-label">OTP template</label>
                                    <input type="text" class="form-control" name="otp_template_twilio" value="{{$sc->otp_template_twilio}}">
                                </div>
							</div>
							<div align="right" class="btn-container justify-content-end mt-2" >
                                <button type="submit" onclick="" style="margin: 8px;" class="btn btn-primary">Save</button>
                            </div>

						</div>
						</form>
					<!-- </div>
					</div> -->
				</div>
				
				<div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                    <form class="sms-module-form" action="{{route('update_sms_nexmo')}}" method="post">
                            @csrf
                                <h5 class="d-flex flex-wrap justify-content-between align-items-center text-uppercase">
                                    <span>Nexmo</span>
                                    <div class="pl-2">
                                        <img src="../assets/images/nexmo.png" alt="public" width="38px" height="38px">
                                    </div>
                                </h5>
                                <span class="badge badge-info mb-3" style="--bs-badge-color: #00c9db; background-color: rgba(0,201,219,0.1);"> NB : #OTP# will be replace with otp </span>
								
                                <div class="d-flex flex-wrap mb-4">
                                    <label class="form-check form--check mr-2 mr-md-4">
                                        <input class="form-check-input" type="radio" name="status" value="1">
                                        <span class="form-check-label text--title pl-2">Active</span>

                                    </label>
									&nbsp; &nbsp;
                                    <label class="form-check form--check">
                                        <input class="form-check-input" type="radio" name="status" value="0" checked="">
                                        <span class="form-check-label text--title pl-2">Inactive </span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-capitalize">API key</label>
                                    <input type="text" class="form-control" name="api_key_nexmo" value="{{$sc->api_key_nexmo}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-capitalize">API Secret</label>
                                    <input type="text" class="form-control" name="api_secret" value="{{$sc->api_secret}}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label text-capitalize">From</label>
                                    <input type="text" class="form-control" name="from_nexmo" value="{{$sc->from_nexmo}}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label text-capitalize">OTP template</label>
                                    <input type="text" class="form-control" name="otp_template_nexmo" value="{{$sc->otp_template_nexmo}}">
                                </div>
                            </div>
							<div align="right" class="btn-container justify-content-end mt-2" >
                                <button type="submit" onclick="" style="margin: 8px;" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
				<!-- third card -->
				<br>
				
				<div class="row g-3">
				<div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <form class="sms-module-form" action="{{route('update_sms_factor')}}" method="post">
                            @csrf
                                <h5 class="d-flex flex-wrap justify-content-between align-items-center text-uppercase">
                                    <span>2factor</span>
                                    <div class="pl-2">
                                        <img src="../assets/images/factor.png" alt="public" width="38px" height="38px"> 
                                    </div>
                                </h5>
                                <div>
                                    <span class="badge badge-info mb-1" style="--bs-badge-color: #00c9db; background-color: rgba(0,201,219,0.1);">EX of SMS provider`s template : your OTP is XXXX here  please check.</span>
                                </div>
                                <div>
								<span class="badge badge-info mb-3" style="--bs-badge-color: #00c9db; background-color: rgba(0,201,219,0.1);"> NB : #OTP# will be replace with otp </span>
                                </div>
								
                                <div class="d-flex flex-wrap mb-4">
                                    <label class="form-check form--check mr-2 mr-md-4">
                                        <input class="form-check-input" type="radio" name="status" value="1" checked="">
                                        <span class="form-check-label text--title pl-2">Active</span>

                                    </label>
									&nbsp;&nbsp;
                                    <label class="form-check form--check">
                                        <input class="form-check-input" type="radio" name="status" value="0">
                                        <span class="form-check-label text--title pl-2">Inactive </span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label class="form-label text-capitalize">API key</label>
                                    <input type="text" class="form-control" name="api_key_factor" value="{{$sc->api_key_factor}}">
                                </div>
                            </div>
							<div align="right" class="btn-container justify-content-end mt-2" >
                                <button type="submit" onclick="" style="margin: 8px;" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
           
				<!-- end third card -->
                <!-- fourth card -->
                <br>
                <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                         <form class="sms-module-form" action="{{route('update_sms_msg')}}" method="post">
                            @csrf
                              <h5 class="d-flex flex-wrap justify-content-between align-items-center text-uppercase">
                                    <span>Msg91</span>
                                    <div class="pl-2">
                                        <img src="../assets/images/Msg91_Logo.jpg" alt="public" width="78px" height="38px">
                                    </div>
                                </h5>
                                <span class="badge badge-soft-info mb-3" style="--bs-badge-color: #00c9db; background-color: rgba(0,201,219,0.1);">NB : Keep an OTP variable in your SMS providers OTP Template.</span>

                                <div class="d-flex flex-wrap mb-4">
                                    <label class="form-check form--check mr-2 mr-md-4">
                                        <input class="form-check-input" type="radio" name="status" value="1">
                                        <span class="form-check-label text--title pl-2">Active</span>

                                    </label>
                                    &nbsp;&nbsp;
                                    <label class="form-check form--check">
                                        <input class="form-check-input" type="radio" name="status" value="0" checked="">
                                        <span class="form-check-label text--title pl-2">Inactive </span>
                                    </label>
                                </div>


                                <div class="form-group">
                                    <label class="form-label text-capitalize">Template ID</label>
                                    <input type="text" class="form-control" name="template_id_msg" value="{{$sc->template_id_msg}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-capitalize">Auth Key</label>
                                    <input type="text" class="form-control" name="auth_key" value="{{$sc->auth_key}}">
                                </div>
                            </div>
                            <div align="right" class="btn-container justify-content-end mt-2" >
                                <button type="submit" onclick="" style="margin: 8px;" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
                <!-- end fourth card -->
			</div>
           </div> 
           <!-- breadcrumb end-->
        </div>           
    </div>
    <!-- end page wrapper -->
    

           
@endsection
