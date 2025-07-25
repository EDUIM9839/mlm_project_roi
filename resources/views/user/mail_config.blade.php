@extends('layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Mail Configuration</div>
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
                   <!-- end breadcrumb -->
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
