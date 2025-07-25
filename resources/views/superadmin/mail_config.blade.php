@extends('superadmin.layouts.main')
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
                            <li class="breadcrumb-item active" aria-current="page">Mail Configuration</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class='col-md-6'>
                       <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{route('add-product')}}" class='badge bg-info'>Add Product</a></h6>
                </div>
                </div>
            </div>
            <!--end breadcrumb-->
            
          
                    <!-- nav -->
             
             <div class="row">
    <div class="col-xl-12">
        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('plan_setting')}}" id="commission">
                    <span class=""><i class="fas fa-percent"></i></span>
                    <span class="">Plan Setting</span>
                </a>
            </li>
            
            
                        <li class="nav-item ">
                <a class="nav-link " href="{{route('payout')}}" role="tab" id="payout">
                    <span class=""><i class="fas fa-chart-line"></i></span>
                    <span class="">Payout</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('payment')}}" role="tab" id="payment">
                    <span class=""><i class="far fa-money-bill-alt"></i></span>
                    <span class="">Payment</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " href="{{route('sign_up')}}" role="tab" id="signup">
                    <span class=""><i class="far fa-user-circle"></i></span>
                    <span class="">Signup</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  " href="{{route('mail_config')}}" role="tab" id="mail">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <span class="">Mail</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('sms_config')}}" role="tab" id="api">
                    <span class=""><i class="fas fa-key"></i></span>
                    <span class="">SMS Module</span>
                </a>
            </li>
                    </ul>
    </div>
</div>
&nbsp;
            <!-- nav end -->
                   <div class="card border-top border-0 border-4 border-white">
							<div class="card-body p-2">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-black"></i>
									</div>
									<h5 class="mb-0 text-black">Mail Config</h5>
								<!--  -->
								<div>
							</div>
								<!--  -->
									<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked style="margin: 1px;
    padding: 4px;">
  <label class="form-check-label" for="flexSwitchCheckChecked">ON/OFF</label>
									</div>
					</div>
                    <form class="row g-3" action="{{route('update_mail')}}" method="POST">
						@csrf
									<div class="col-md-6">
										<label for="inputLastName1" class="form-label">Mailer Name</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
											<input type="text" class="form-control border-start-0" value="{{$mc->mailer_name}}" name="mailer_name" id="mailer_name" placeholder="Mailer Name" />
										</div>
									</div>
									<div class="col-md-6">
										<label for="inputLastName2" class="form-label">Host</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-inbox'></i></span>
											<input type="text" class="form-control border-start-0" value="{{$mc->host}}" name="host" id="host" placeholder="Host here" />
										</div>
									</div>
									<div class="col-md-6">
										<label for="inputPhoneNo" class="form-label">Driver</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user' ></i></span>
											<input type="text" class="form-control border-start-0" value="{{$mc->driver}}" name="driver" id="driver" placeholder="Driver Name here" />
										</div>
									</div>
									<div class="col-md-6">
										<label for="inputEmailAddress" class="form-label">Port</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user' ></i></span>
											<input type="text" class="form-control border-start-0" value="{{$mc->port}}" name="port" id="port" placeholder="Type Port here" />
										</div>
									</div>
									<div class="col-md-6">
										<label for="inputChoosePassword" class="form-label">Username</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user' ></i></span>
											<input type="text" class="form-control border-start-0" value="{{$mc->username}}" name="username" id="username" placeholder="Username" />
										</div>
									</div>
									<div class="col-md-6">
										<label for="inputConfirmPassword" class="form-label">Email Id</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-inbox' ></i></span>
											<input type="text" class="form-control border-start-0" value="{{$mc->email}}" name="email" id="email" placeholder="Email" />
										</div>
									</div>
									<div class="col-md-6">
										<label for="inputConfirmPassword" class="form-label">Encryption</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-coin' ></i></span>
											<input type="text" class="form-control border-start-0" value="{{$mc->encryption}}" name="encryption" id="encryption" placeholder="Encryption here" />
										</div>
                                </div>
								<div class="col-md-6">
										<label for="inputConfirmPassword" class="form-label">Password</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user' ></i></span>
											<input type="text" class="form-control border-start-0" value="{{$mc->password}}" name="password" id="password" placeholder="Type password here" />
										</div>
                                </div>
                                <div align="right" class="btn-container justify-content-end mt-2" style="padding: 15px;">
									<button type="reset" name="reset" class="btn btn-danger">Reset</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Save Information</button>
								</div>

								</form>
                            </div>
                    </div>
                  

        </div>
    </div>

           
@endsection
