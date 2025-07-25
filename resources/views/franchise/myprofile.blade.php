@extends('franchise.layouts.main')
@section('pageTitle', 'franchisess')
@section('mains')

<!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

           <h6 class="text-uppercase">My Profile</h6>
			    <hr>
				<div id="stepper1" class="bs-stepper" style='height:100px'>
				  <div class="card">
					
					<div class="card-header">
						<div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
							<div class="step" data-target="#test-l-1">
							  <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
								<div class="bs-stepper-circle">1</div>
								<div class="">
									<h5 class="mb-0 steper-title">Welcome Letter</h5>
									<p class="mb-0 steper-sub-title">Welcome in Appear Store</p>
								</div>
							  </div>
							</div>
							<div class="bs-stepper-line"></div>
							<div class="step" data-target="#test-l-2">
								<div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
								  <div class="bs-stepper-circle">2</div>
								  <div class="">
									  <h5 class="mb-0 steper-title">ID Card</h5>
									  <p class="mb-0 steper-sub-title">Personal ID Card</p>
								  </div>
								</div>
							  </div>
							<div class="bs-stepper-line"></div>
							<div class="step" data-target="#test-l-3">
								<div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
								  <div class="bs-stepper-circle">3</div>
								  <div class="">
									  <h5 class="mb-0 steper-title">Personal Details</h5>
									  <p class="mb-0 steper-sub-title">Setup Personal Details</p>
								  </div>
								</div>
							  </div>
							  <div class="bs-stepper-line"></div>
								<div class="step" data-target="#test-l-4">
									<div class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
									<div class="bs-stepper-circle">4</div>
									<div class="">
										<h5 class="mb-0 steper-title">Account Info</h5>
										<p class="mb-0 steper-sub-title">Manage Account Information</p>
									</div>
									</div>
								</div>
						  </div>
					</div>
				    <div class="card-body" >
					
					  <div class="bs-stepper-content">
						<form onSubmit="return false">
						  <div id="test-l-1" role="tabpanel" class="bs-stepper-pane " aria-labelledby="stepper1trigger1">
                            @php
                                 $business=DB::table('business_setup')->select('business_name')->take(1)->first();
                            @endphp
                            <div class="row g-3">
                                <div class="row g-3">
                                  
                                    <div class="col-sm-12 card bg-success text-white" style="background-color:#f6f6f6; padding:35px; border-radius:10px;">
                                        <img src="{{ Storage::url('app/logo/').DB::table('business_setup')->first()->logo}}" style="width:60px">
                                        <h3 style="text-align:center">Welcome Letter</h3>
                                        <p>Appear Stores<br>To: Demo <br>Date: 28-Sep-2023</p>
                                        <p>Hello Demo ,</p>
                                        <p>Did you get a raise this year? Well, would you like one? You know, you don’t have to wait until your boss decides you’re worth more money. One of the best, and most overlooked ways to earn more money is to develop a secondary stream of income.</p>
                                        <p>Let the Internet make money for you.</p>
                                        <p>You heard right. With the power of the Internet you don’t have to work longer hours to increase your wages. You can start a web-based business with a few simple tools. Whether you already have a business or don’t have a clue where to start, you can make a good income as an Internet entrepreneur. You don’t need any special skills, education or above average intelligence—but you do need persistence and determination. If you have these two qualities, I guarantee you can earn more money this year online.</p>
                                        <p>You don’t have to invest in expensive advertising or a fancy location. Work right in your house and watch your business grow. It’s not rocket science—it’s just plain common sense—and it works! Just select the Web site below and take the first step to getting that raise you deserve!
                                        </p>
                                        <p>
                                        Sincerely,<br>Demo</p>
                                    </div>
                                   
                                </div> 
                                 <div class="col-12 col-lg-6">
                                <button class="btn btn-primary px-4" onclick="stepper1.next()">Next<i class='bx bx-right-arrow-alt ms-2'></i></button>
                                </div>
                            </div><!---end row-->
							
						  </div>

						  <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">

							<h5 class="mb-1">Account Details</h5>
							<p class="mb-4">Enter Your Account Details.</p>

							<div class="row g-3">
								<div class="col-12 col-lg-6">
									<label for="InputUsername" class="form-label">Username</label>
									<input type="text" class="form-control" id="InputUsername" placeholder="jhon@123">
								</div>
								<div class="col-12 col-lg-6">
									<label for="InputEmail2" class="form-label">E-mail Address</label>
									<input type="text" class="form-control" id="InputEmail2" placeholder="example@xyz.com">
								</div>
								<div class="col-12 col-lg-6">
									<label for="InputPassword" class="form-label">Password</label>
									<input type="password" class="form-control" id="InputPassword" value="12345678">
								</div>
								<div class="col-12 col-lg-6">
									<label for="InputConfirmPassword" class="form-label">Confirm Password</label>
									<input type="password" class="form-control" id="InputConfirmPassword" value="12345678">
								</div>
								<div class="col-12">
									<div class="d-flex align-items-center gap-3">
										<button class="btn btn-outline-secondary px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button>
										<button class="btn btn-primary px-4" onclick="stepper1.next()">Next<i class='bx bx-right-arrow-alt ms-2'></i></button>
									</div>
								</div>
							</div><!---end row-->
							
						  </div>

						  <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
							<h5 class="mb-1">Welcome Letter</h5>
							<p class="mb-4">Welcome in Appear Store</p>
                            
							<div class="row g-3">
								<div class="col-12 col-lg-6">
									<label for="SchoolName" class="form-label">School Name</label>
									<input type="text" class="form-control" id="SchoolName" placeholder="School Name">
								</div>
								<div class="col-12 col-lg-6">
									<label for="BoardName" class="form-label">Board Name</label>
									<input type="text" class="form-control" id="BoardName" placeholder="Board Name">
								</div>
								<div class="col-12 col-lg-6">
									<label for="UniversityName" class="form-label">University Name</label>
									<input type="text" class="form-control" id="UniversityName" placeholder="University Name">
								</div>
								<div class="col-12 col-lg-6">
									<label for="InputCountry" class="form-label">Course Name</label>
									<select class="form-select" id="InputCountry" aria-label="Default select example">
										<option selected>---</option>
										<option value="1">One</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									  </select>
								</div>
								<div class="col-12">
									<div class="d-flex align-items-center gap-3">
										<button class="btn btn-outline-secondary px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button>
										<button class="btn btn-primary px-4" onclick="stepper1.next()">Next<i class='bx bx-right-arrow-alt ms-2'></i></button>
									</div>
								</div>
							</div><!---end row-->
							
						  </div>

						  <div id="test-l-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">
							<h5 class="mb-1">Work Experiences</h5>
							<p class="mb-4">Can you talk about your past work experience?</p>

							<div class="row g-3">
								<div class="col-12 col-lg-6">
									<label for="Experience1" class="form-label">Experience 1</label>
									<input type="text" class="form-control" id="Experience1" placeholder="Experience 1">
								</div>
								<div class="col-12 col-lg-6">
									<label for="Position1" class="form-label">Position</label>
									<input type="text" class="form-control" id="Position1" placeholder="Position">
								</div>
								<div class="col-12 col-lg-6">
									<label for="Experience2" class="form-label">Experience 2</label>
									<input type="text" class="form-control" id="Experience2" placeholder="Experience 2">
								</div>
								<div class="col-12 col-lg-6">
									<label for="PhoneNumber" class="form-label">Position</label>
									<input type="text" class="form-control" id="PhoneNumber" placeholder="Position">
								</div>
								<div class="col-12 col-lg-6">
									<label for="Experience3" class="form-label">Experience 3</label>
									<input type="text" class="form-control" id="Experience3" placeholder="Experience 3">
								</div>
								<div class="col-12 col-lg-6">
									<label for="PhoneNumber" class="form-label">Position</label>
									<input type="text" class="form-control" id="PhoneNumber" placeholder="Position">
								</div>
								<div class="col-12">
									<div class="d-flex align-items-center gap-3">
										<button class="btn btn-primary px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button>
										<button class="btn btn-success px-4" onclick="stepper1.next()">Submit</button>
									</div>
								</div>
							</div><!---end row-->
							
						  </div>
						</form>
					  </div>
					   
					</div>
				   </div>
				 </div>

        </div>
    </div>
    <!--end page wrapper -->
@endsection

