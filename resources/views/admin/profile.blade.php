@extends('admin.layouts.main')
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
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
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
            <!--end breadcrumb-->
            <!--  -->
            
            
            <div class="card">
                <div class="card-body p-4">
                   
                    <div class="form-body ">
                         
                           <form action="{{route('profile')}}" method="POST" enctype="multipart/form-data">
                                @csrf
								<h6 class="card-title pb-2"> Profile Detials</h6>
								<hr/>

					<div class="border p-4 rounded">
						<div class="row g-3">
                                <div class="col-md-6">
                                    <label for="defaultFormControlInput" class="form-label">Old Password</label><span class="useridlabel"></span>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                     
                                     <input type="text" class="form-control" name="password"  >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <label for="defaultFormControlInput" class="form-label">New Password</label><span class="useridlabel"></span>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-file-signature"></i></span>
                                     
                                       <input type="text" class="form-control" name="new_password" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="defaultFormControlInput" class="form-label">Confirm Password</label><span class="useridlabel"></span>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                       
                                         <input type="text" class="form-control" name="confirm_password"  >
                                    </div>
                                </div>
                                <!--<div class="col-md-3">-->
                                <!--      <label for="defaultFormControlInput" class="form-label">Mob NO</label>-->
                                <!--    <div class="input-group"> <span class="input-group-text bg-transparent"><i-->
                                <!--                class='bx bxs-phone'></i></span>-->
                                <!--          <input type="number" class="form-control" name="contact"  >-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="col-md-3">-->
                                <!--    <label for="defaultFormControlInput" class="form-label">Email</label>-->
                                <!--    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-envelope"></i></span>-->
                                       
                                <!--        <input type="email" class="form-control" name="email">-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="col-md-3">-->
                                     
                                <!--       <label for="defaultFormControlInput" class="form-label">Country</label>-->
                                <!--    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-globe"></i></span>-->
                                    
                                <!--       <input type="text" class="form-control" name="country">-->
                                     
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="col-md-3">-->
                                <!--   <label for="defaultFormControlInput" class="form-label">State</label>-->
                                <!--    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-brands fa-usps"></i></span>-->
                                        
                                <!--     <input type="text" class="form-control" name="state" >-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="col-md-3">-->
                                <!--   <label for="defaultFormControlInput" class="form-label">City</label>-->
                                <!--    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-city"></i></span>-->
                                <!--         <input type="text" class="form-control" name="city">-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="col-md-3">-->
                                <!--   <label for="defaultFormControlInput" class="form-label">Address</label>-->
                                <!--    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-location-dot"></i></span>-->
                                       
                                <!--         <input type="text" class="form-control" name="address" >-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="col-md-3">-->
                                <!--   <label for="defaultFormControlInput" class="form-label">Aadhar No</label>-->
                                <!--    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-address-card"></i></span>-->
                                       
                                          
                                <!--                 <input type="number" class="form-control" name="aadhar_no">-->
                                <!--                  <input type="hidden" class="form-control" name="id" >-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="col-md-3">-->
                                <!--   <label for="defaultFormControlInput" class="form-label">Pan No</label>-->
                                <!--    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-address-card"></i></span>-->
                                       
                                          
                                <!--                 <input type='file'class="form-control" name="pan">-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="col-md-6">
                                  <label for="inputLastName2" class="form-label">Profile </label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-image"></i></span>
                                        <input type="file"     onchange="readURL(this)" class="form-control border-start-0" name="image" id="image" placeholder="image"  />
                                </div>
                                <img    id="img"  src="{{ Storage::url('app/profileupload/')}}" style= "border:1px dashed black; width: 100px; height: 100px; position: relative;  top:10px;  margin-left:100px;">
						
                         
					</div>
	</div>
	
 

                                <!-- Company Information end -->


								



                                <!-- Company Location start -->
                                
						<!--		<h6 class="card-title pt-3">Bank Detials</h6>-->
						<!--		<hr/>-->

						<!--		<div class="border   p-4 rounded">-->
						<!--			<div class="row g-3">-->
      <!--                          <div class="col-md-6">-->
      <!--                              <label for="inputLastName1" class="form-label">Bank Name</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-building-columns"></i></span>-->
      <!--                                  <input type="text" class="form-control border-start-0" name="bank_name" id="bank_name" placeholder="Enter Bank name" />-->
      <!--                              </div>-->
      <!--                          </div>-->
      <!--                          <div class="col-md-6">-->
      <!--                              <label for="inputLastName2" class="form-label">Account No</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-file-invoice"></i></span>-->
      <!--                                 <input type="number" class="form-control border-start-0"  name="account_no" id="account_no" placeholder="Enter Bank Ac No" />-->
      <!--                              </div>-->
      <!--                          </div>-->
      <!--                          <div class="col-md-6">-->
      <!--                              <label for="inputLastName2" class="form-label">IFSC Code</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-brands fa-codepen"></i></span>-->
      <!--                                 <input type="text" class="form-control border-start-0"  name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC code" />-->
      <!--                              </div>-->
      <!--                          </div>-->
      <!--                          <div class="col-md-6">-->
      <!--                              <label for="inputLastName2" class="form-label">Account Holder Name</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-user-tie"></i></span>-->
      <!--                                 <input type="text" class="form-control border-start-0" name="account_holder_name" id="account_holder_name" placeholder="Enter Account Holder Name" />-->
      <!--                              </div>-->
      <!--                          </div>-->
						<!--	</div>-->
						<!--</div>-->

                                <!-- Company Location end -->

                                <!-- Business Information -->


						<!--		<h6 class="card-title pt-3">Nominee Information</h6>-->
						<!--		<hr/>-->

						<!--		<div class="border p-4 rounded">-->
						<!--			<div class="row g-3">-->



      <!--                          <div class="col-md-4">-->
      <!--                              <label for="inputLastName1" class="form-label">Nominee Name</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-file-signature"></i></span>-->
      <!--                                  <input type="text" class="form-control border-start-0"   name="nomini_name" id="nomini_name" placeholder="Nominee Name " />-->
      <!--                              </div>-->
      <!--                          </div>-->
      <!--                          <div class="col-md-4">-->
      <!--                              <label for="inputLastName2" class="form-label">Nominee Relation</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-circle-chevron-down"></i></span>-->
      <!--                                  <select class="form-control border-start-0" name="nomini_relation" id="nomini_relation" >-->
      <!--                                      <option selected >---select---</option>-->
      <!--                                      <option value="mother">Mother</option>-->
      <!--                                      <option value="father">Father</option>-->
      <!--                                      <option value="brother">Brother</option>-->
      <!--                                      <option value="sister">Sister</option>-->
      <!--                                      <option value="husband">Husband</option>-->
      <!--                                      <option value="wife">Wife</option>-->
      <!--                                      <option value="son">Son</option>-->
      <!--                                      <option value="daughter">Daughter</option>-->
      <!--                                      <option value="other">Other</option>-->
      <!--                                  </select>-->
      <!--                              </div>-->
      <!--                          </div>-->

      <!--                          <div class="col-md-4">-->
      <!--                              <label for="inputLastName2" class="form-label">Nominee Contact No</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i-->
      <!--                                          class='bx bxs-phone'></i></span>-->
      <!--                                   <input type="number" class="form-control border-start-0"  name="nomini_contact" id="	nomini_contact" placeholder="Nominee Contact No " />-->
      <!--                              </div>-->
      <!--                          </div>-->
                                  
                                   <div align="right" class="btn-container justify-content-end mt-2"
                                    style="padding: 15px;">
                                    <button type="submit" class="btn btn-primary">Update
                                        Information</button>
                                </div>

							</div>
						</div>
                                <!-- Business Information end -->
                                <!-- Office Start -->
							

								

							</form>
						 
					</div>
                        </div>
                    </div>
<!--  -->

        </div>
    </div>
@endsection
 <script>
  function readURL(input) {
    if (input.files && input.files[0]) {
    
      var reader = new FileReader();
      reader.onload = function (e) { 
        document.querySelector("#img").setAttribute("src",e.target.result);
      };

      reader.readAsDataURL(input.files[0]); 
    }
  }
  </script>
