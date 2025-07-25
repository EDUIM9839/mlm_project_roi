@extends('admin.layouts.main')
<style>
    .hide{
        display: none !important;
    }
</style>

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
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('user-list')}}">User List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Edit Details Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <!--  -->
            
            @if(Session::has('message'))
    {!! Session::get('message') !!}
@endif

            @if (session()->has('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success !</strong> {!!session()->get('success')!!}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session()->has('error'))

               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error !</strong> {!!session()->get('error')!!}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                @endif

          <div class="card">
                <div class="card-body p-4">
                   
                    <div class="form-body ">
                         
                           <form action="{{route('user_update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
								<h6 class="card-title pb-2"> User Detials</h6>
								<hr/>

					                <div class="border p-4 rounded">
						<div class="row g-3">
                                <div class="col-md-3">
                                    <label for="defaultFormControlInput" class="form-label">User id</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                     
                                     <input type="text" class="form-control" name="userid" id="defaultFormControlInput" readonly value="{{$edit_user['0']->userid}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                     <label for="defaultFormControlInput" class="form-label">Fisrt Name</label><span class="useridlabel"></span>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-file-signature"></i></span>
                                     
                                       <input type="text" class="form-control" name="first_name" value="{{$edit_user['0']->first_name}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="defaultFormControlInput" class="form-label">Last Name</label><span class="useridlabel"></span>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                       
                                         <input type="text" class="form-control" name="last_name" value="{{$edit_user['0']->last_name}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                      <label for="defaultFormControlInput" class="form-label">Mob NO</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-phone'></i></span>
                                          <input type="number" class="form-control" name="contact" value="{{$edit_user['0']->contact}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="defaultFormControlInput" class="form-label">Email</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-envelope"></i></span>
                                       
                                        <input type="email" class="form-control" name="email" value="{{$edit_user['0']->email}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                     
                                       <label for="defaultFormControlInput" class="form-label">Country</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-globe"></i></span>
                                    
                                       <input type="text" class="form-control" name="country" value="{{$edit_user['0']->country}}">
                                     
                                    </div>
                                </div>
                                <div class="col-md-3">
                                   <label for="defaultFormControlInput" class="form-label">State</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-brands fa-usps"></i></span>
                                        
                                     <input type="text" class="form-control" name="state" value="{{$edit_user['0']->state}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                   <label for="defaultFormControlInput" class="form-label">City</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-city"></i></span>
                                         <input type="text" class="form-control" name="city" value="{{$edit_user['0']->city}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                   <label for="defaultFormControlInput" class="form-label">Address</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-location-dot"></i></span>
                                       
                                         <input type="text" class="form-control" name="address" value="{{$edit_user['0']->address}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                   <label for="defaultFormControlInput" class="form-label">Aadhar No</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-address-card"></i></span>
                                       
                                          
                                                 <input type="number" class="form-control" name="aadhar_no" value="{{$edit_user['0']->aadhar_no}}">
                                                  <input type="hidden" class="form-control" name="id" value="{{$edit_user['0']->id}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                   <label for="defaultFormControlInput" class="form-label">Pan No</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-address-card"></i></span>
                                       
                                          
                                                 <input type='file'class="form-control" name="pan" value="{{$edit_user['0']->pan}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                  <label for="inputLastName2" class="form-label">Profile </label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-image"></i></span>
                                        <input type="file"     onchange="readURL(this)" class="form-control border-start-0" name="image" id="image" placeholder="image"  />
                                </div>
                                <img    id="img"  src="  {{ Storage::url('app/profileupload/').$edit_user['0']->image}}" style= "border:1px dashed black; width: 100px; height: 100px; position: relative;  top:10px;  margin-left:100px;">
						
                         
					</div>
	</div>
	
 

                                <!-- Company Information end -->


								
<br><br>
<h4>USDT ADDRESS</h4>
<hr>


                                
<div class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputLastName1" class="form-label"> USDT ADDRESS</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-building-columns"></i></span>
                                        <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->tron_address}}" name="tron_address" id="tron_address" placeholder="Enter USDT" />
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">Account No</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-file-invoice"></i></span>
                                       <input type="number" class="form-control border-start-0" value="{{$edit_user['0']->account_no}}" name="account_no" id="account_no" placeholder="Enter Bank Ac No" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">IFSC Code</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-brands fa-codepen"></i></span>
                                       <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->ifsc_code}}" name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC code" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">Account Holder Name</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-user-tie"></i></span>
                                       <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->account_holder_name}}" name="account_holder_name" id="account_holder_name" placeholder="Enter Account Holder Name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">Bank Name</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-brands fa-codepen"></i></span>
                                       <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->bank_name}}" name="bank_name" id="bank_name" placeholder="Enter Bank Name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">Branch Detail</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-user-tie"></i></span>
                                       <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->branch_detail}}" name="branch_detail" id="account_holder_name" placeholder="Enter Branch Detail"/>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">G-Pay Number</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-brands fa-codepen"></i></span>
                                       <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->g_pay}}" name="g_pay" id="g_pay" placeholder="Enter Google Pay id" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">Phone Pay No.</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-user-tie"></i></span>
                                       <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->phone_pay}}" name="phone_pay" id="phone_pay" placeholder="Enter Phone Pay Id"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">Paytm No.</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-user-tie"></i></span>
                                       <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->paytm_no}}" name="paytm_no" id="paytm_no" placeholder="Enter Paytm No." />
                                    </div>
                                </div>
                                
                                 <div class="col-md-6 hide" id="otpInput">
                                    <label for="inputLastName1" class="form-label"> Enter OTP : </label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent">***</span>
                                        <input type="text" class="form-control border-start-0" name="otp" id="otp" placeholder="Enter OTP" />
                                    </div>
                                </div>
                                    </div>

 
                                  
                                  <div align="right" class="btn-container justify-content-end mt-2"
                                    style="padding: 15px;">
                                      
                                    <button type="button" class="btn text-white" style="background-color:#030735f2 ;" id="getOTPBtn">Get OTP To Update</button>
                                    <button type="submit" class="btn text-white hide" style="background-color:#030735f2 ;" id="updateBtn">Update</button>
                                </div>

							</div>
						</div>
					
						
						
						
                                <!-- Business Information end -->
                                <!-- Office Start -->
							

								

							</form>
							
						 
					</div>
                        </div>
	
                                <!-- Company Location start -->
                               


                             

						<!--		<div class="">-->
						<!--			<div class="row g-3">-->
                               
      <!--                          <div class="col-md-6">-->
      <!--                              <label for="inputLastName2" class="form-label">Account No</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-file-invoice"></i></span>-->
      <!--                                 <input type="number" class="form-control border-start-0" value="{{$edit_user['0']->account_no}}" name="account_no" id="account_no" placeholder="Enter Bank Ac No" />-->
      <!--                              </div>-->
      <!--                          </div>-->
      <!--                          <div class="col-md-6">-->
      <!--                              <label for="inputLastName2" class="form-label">IFSC Code</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-brands fa-codepen"></i></span>-->
      <!--                                 <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->ifsc_code}}" name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC code" />-->
      <!--                              </div>-->
      <!--                          </div>-->
      <!--                          <div class="col-md-6">-->
      <!--                              <label for="inputLastName2" class="form-label">Account Holder Name</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-user-tie"></i></span>-->
      <!--                                 <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->account_holder_name}}" name="account_holder_name" id="account_holder_name" placeholder="Enter Account Holder Name" />-->
      <!--                              </div>-->
      <!--                          </div>-->
      <!--                          <div class="col-md-6">-->
      <!--                              <label for="inputLastName2" class="form-label">Bank Name</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-brands fa-codepen"></i></span>-->
      <!--                                 <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->bank_name}}" name="bank_name" id="bank_name" placeholder="Enter Bank Name" />-->
      <!--                              </div>-->
      <!--                          </div>-->
      <!--                          <div class="col-md-6">-->
      <!--                              <label for="inputLastName2" class="form-label">Branch Detail</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-user-tie"></i></span>-->
      <!--                                 <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->branch_detail}}" name="branch_detail" id="account_holder_name" placeholder="Enter Branch Detail"/>-->
      <!--                              </div>-->
      <!--                          </div>-->
                                
      <!--                          <div class="col-md-6">-->
      <!--                              <label for="inputLastName2" class="form-label">G-Pay Number</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-brands fa-codepen"></i></span>-->
      <!--                                 <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->g_pay}}" name="g_pay" id="g_pay" placeholder="Enter Google Pay id" />-->
      <!--                              </div>-->
      <!--                          </div>-->
      <!--                          <div class="col-md-6">-->
      <!--                              <label for="inputLastName2" class="form-label">Phone Pay No.</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-user-tie"></i></span>-->
      <!--                                 <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->phone_pay}}" name="phone_pay" id="phone_pay" placeholder="Enter Phone Pay Id"/>-->
      <!--                              </div>-->
      <!--                          </div>-->
      <!--                          <div class="col-md-6">-->
      <!--                              <label for="inputLastName2" class="form-label">Paytm No.</label>-->
      <!--                              <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-user-tie"></i></span>-->
      <!--                                 <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->paytm_no}}" name="paytm_no" id="paytm_no" placeholder="Enter Paytm No." />-->
      <!--                              </div>-->
      <!--                          </div>-->
                                
						<!--	</div>-->
						<!--</div>-->
                                

							 {{--	<div class="border p-4 rounded">
									<div class="row g-3">



                                <div class="col-md-4">
                                    <label for="inputLastName1" class="form-label">Nominee Name</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-file-signature"></i></span>
                                        <input type="text" class="form-control border-start-0" value="{{$edit_user['0']->nomini_name}}" name="nomini_name" id="nomini_name" placeholder="Nominee Name " />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputLastName2" class="form-label">Nominee Relation</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="fa-solid fa-circle-chevron-down"></i></span>
                                        <select class="form-control border-start-0" name="nomini_relation" id="nomini_relation" >
                                            <option selected >---select---</option>
                                            <option value="mother">Mother</option>
                                            <option value="father">Father</option>
                                            <option value="brother">Brother</option>
                                            <option value="sister">Sister</option>
                                            <option value="husband">Husband</option>
                                            <option value="wife">Wife</option>
                                            <option value="son">Son</option>
                                            <option value="daughter">Daughter</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="inputLastName2" class="form-label">Nominee Contact No</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-phone'></i></span>
                                         <input type="number" class="form-control border-start-0" value="{{$edit_user['0']->nomini_contact}}" name="nomini_contact" id="	nomini_contact" placeholder="Nominee Contact No " />
                                    </div>
                                </div>
                                
                                --}}
                                  
                                   {{-- <div align="right" class="btn-container justify-content-end mt-2"
                                    style="padding: 15px;">
                                    <button type="submit" class="btn btn-primary">Update
                                        Information</button>
                                </div> --}}

							</div>
						</div>
					
						
                                <!-- Business Information end -->
                                <!-- Office Start -->
						
						 
					</div>
                        </div>
                    </div>
<!--  -->

        
    </div>
@endsection
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('imgPreview').src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const otpBtn = document.getElementById('getOTPBtn');
    const updateBtn = document.getElementById('updateBtn');
    const otpInput = document.getElementById('otpInput');

    otpBtn?.addEventListener('click', () => sendOTP());

    function toggleVisibility(isSuccess) {
        otpBtn.classList.toggle('hide', isSuccess);
        otpInput.classList.toggle('hide', !isSuccess);
        updateBtn.classList.toggle('hide', !isSuccess);
    }

    async function sendOTP() {
        otpBtn.disabled = true;
        let prevText = otpBtn.innerHTML;
        otpBtn.innerHTML = "&nbsp;&nbsp;Sending...&nbsp;&nbsp;";

        try {
            const response = await fetch(`{{ route('admin.update-usdt.send-otp', collect(request()->segments())->last()) }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            const data = await response.json();
            toggleVisibility(data.status === 'success');
        } catch (error) {
            console.error('OTP sending failed:', error);
            toggleVisibility(false);
        } finally {
            otpBtn.disabled = false;
            otpBtn.innerHTML = prevText;
        }
    }
});
</script>
