@extends('user.layouts.main')
@section('mains')

<!--start page wrapper -->
<style>
	input {
		border-width: 1px !important;
	}

	.input-group-text {

		border-width: 1px !important;

	}
</style>

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
                            <li class="breadcrumb-item active" aria-current="page">Personal Detail</li>
                        </ol>
                    </nav>
                </div> 
            </div>
            <!--end breadcrumb-->
		<!--Breadcrum end-->

		<!--Page Start-->

		<div class="card">
			<div class="card-body p-4">
			    
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

				<div class="form-body ">
					<form class="row g-3" action="{{route('profile_update')}}" method="POST" enctype="multipart/form-data" onsubmit="onsubmitForms(event)" id="target">
						@csrf

						<!-- Company Location start -->

						<p style="color:red;">Note: Please fill all required fields marked with(*) before submit.</p>
						<div class="border p-4 rounded">
							<div class="row g-3">

								<div class="col-md-6">
									<label for="inputLastName1" class="form-label">USERNAME<span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-user'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->first_name}}" name="first_name" id="first_name"
											placeholder="Enter Username" required   />
									</div>
								</div>
								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">SURNAME<span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-user'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->last_name}}" name="last_name" id="last_name"
											placeholder="SURNAME" required   />
									</div>
								</div>

								<div class="col-md-6">
									<label for="inputLastName1" class="form-label">EMAIL<span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-envelope'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->email}}" name="email" id="email"
											placeholder="Enter EMAIL" required  readonly/>
									</div>
								</div>
								{{--
								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">NOMINEE NAME<span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-user'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->nomini_name}}" name="nomini_name" id="nomini_name"
											placeholder="NOMINEE NAME" />
									</div>
								</div>
--}}
								<div class="col-md-6">
									<label for="inputLastName1" class="form-label">CONTACT<span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-phone'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->contact}}" name="contact" id="contact"
											placeholder="Enter CONTACT" required />
									</div>
								</div>
								{{--
								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">NOMINEE RELATION</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-user'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->nomini_relation}}" name="nomini_relation"
											id="nomini_relation" placeholder="Enter NOMINEE RELATION" />
									</div>
								</div>
								
								<div class="col-md-6">
									<label for="inputLastName1" class="form-label">PAN NO<span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-file'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->pan}}" name="pan" id="pan" placeholder="Enter PAN NO"
											 />
									</div>
								</div>
								--}}
								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">UPDATE NEW PASSWORD</label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><svg
												xmlns="http://www.w3.org/2000/svg" width="24" height="24"
												viewBox="0 0 24 24">
												<path fill="currentColor"
													d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2h1m-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3Z" />
											</svg></span>
										<input type="text" class="form-control border-start-0" value="" name="password"
											id="password" placeholder="Enter NEW PASSWORD" />
									</div>
								</div>
								<!---->
								<div class="col-md-6">
									<label for="inputLastName1" class="form-label">CITY<span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-phone'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->city}}" name="city" id="city"
											placeholder="Enter CITY" required />
									</div>
								</div>
								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">STATE</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-user'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->state}}" name="state"
											id="state" placeholder="Enter STATE" />
									</div>
								</div>
								 
								<div class="col-md-6">
									<label for="inputLastName1" class="form-label">COUNTRY<span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-phone'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->country}}" name="country" id="country"
											placeholder="Enter COUNTRY" required />
									</div>
								</div>
								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">PIN CODE</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-user'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->zip}}" name="zip"
											id="zip" placeholder="Enter ZIP" />
									</div>
								</div>
								{{--
								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">Address</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-user'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->address}}" name="address"
											id="address" placeholder="Enter ADDRESS" />
									</div>
								</div>
								--}}
								<!---->
								
								{{--
								<div class="col-md-6">
									<label for="inputLastName1" class="form-label">PAN CARD IMAGE <span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"></i></span>
										<input type="file" class="form-control border-start-0 input" name="pan_img"
											id="Uimages" placeholder="Enter Location" />
										@error('files')
										<span class="text-danger">
											{{$message}}
										</span>
										@enderror
									</div><br>
									
									<div class="row col-md-6">
									<div class="col-md-6 ">
									<img id="img" src="{{ Storage::url('app/profileupload/').Auth::user()->pan_img}}"
										style="border:1px dashed black; width: 100px; height: 100px;">
                                    </div>
									<div id="Idive" class="col-md-6 ha">
										<img style="border:1px dashed black;" id="Simages" height="100" width="100"
											src="" alt="nothing uploaded...">
									</div>
								</div>
								
								</div>
							
								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">PROFILE PHOTO<span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"></i></span>
										<input type="file" class="form-control border-start-0input" name="file"
											id="Uimage" placeholder="Footer text" />
										@error('file')
										<span class="text-danger">
											{{$message}}
										</span>
										@enderror
									</div><br>
									
								 
									<div class="row col-md-6 ">
									<div class="col-md-6" >
									<img id="img" src="{{ Storage::url('app/profileupload/').Auth::user()->image}}"
										style="border:1px dashed black; width: 100px; height: 100px; ">
									</div> 	
									<div id="Idiv" class="col-md-6 ha"  >
										<img style="border:1px dashed black; "
											id="Simage" height="100" width="100" src="" alt="nothing uploaded...">
									</div>
								</div>
								</div>
								 	--}}
								
								
							</div>
						</div>
						 
						<!-- Company Location end -->

						<!-- Office Start -->
						<h5 class="card-title pb-2">USDT BEP20</h5>
						<hr />
						<div class="border p-4 rounded">
							<div class="row g-3">
								<div class="col-md-6">
									<label for="inputLastName1" class="form-label">USDT BEP20 <span
											class="text-danger">*</span></label>
									<div class="input-group"><span class="input-group-text bg-transparent"><i
												class='bx bxs-dollar-circle'></i></span>
										    <input type="text" class="form-control border-start-0"
											value="{{Auth::user()->tron_address}}" name="tron_address" id="tron_address"
											placeholder="USDT"  @if(!empty(Auth::user()->tron_address)) readonly  @endif />
									</div>
								</div>
								 
								<div class="col-md-6">
									<label for="inputLastName1" class="form-label">BANK NAME <span
											class="text-danger">*</span></label>
									<div class="input-group"><span class="input-group-text bg-transparent"><i
												class='bx bxs-dollar'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->bank_name}}" name="bank_name" id="bank_name"
											placeholder="Bank Name"  @if(!empty(Auth::user()->bank_name)) readonly  @endif/>
									</div>
								</div>
								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">HOLDER NAME <span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-user'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->account_holder_name}}" name="account_holder_name"
											id="account_holder_name" placeholder="Holder Name"  @if(!empty(Auth::user()->account_holder_name)) readonly  @endif/>
									</div>
								</div>

								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">ACCOUNT NUMBER <span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-bank'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->account_no}}" name="account_no" id="account_no"
											placeholder="Account No." @if(!empty(Auth::user()->account_no)) readonly  @endif />
									</div>
								</div>

								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">BANK IFSC CODE <span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-bank'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->ifsc_code}}" name="ifsc_code" id="ifsc_code"
											placeholder="Ifsc code"  @if(!empty(Auth::user()->ifsc_code)) readonly  @endif/>
									</div>
								</div>

								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">BRANCH DETAILS<span
											class="text-danger">*</span></label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-bank'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->branch_detail}}" name="branch_detail" id="address"
											placeholder="Branch Details" @if(!empty(Auth::user()->branch_detail)) readonly  @endif />
									</div>
								</div>

								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">G PAY NUMBER</label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-bank'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->g_pay}}" name="g_pay" id="g_pay"
											placeholder="gPay Number" @if(!empty(Auth::user()->g_pay)) readonly  @endif/>
									</div>
								</div>

								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">PHONE PAY NO</label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-bank'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->phone_pay}}" name="phone_pay" id="phone_pay"
											placeholder="Phone Pay No." @if(!empty(Auth::user()->phone_pay)) readonly  @endif />
									</div>
								</div>

								<div class="col-md-6">
									<label for="inputLastName2" class="form-label">PAYTM NO</label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i
												class='bx bxs-bank'></i></span>
										<input type="text" class="form-control border-start-0"
											value="{{Auth::user()->paytm_no}}" name="paytm_no" id="paytm_no"
											placeholder="Paytm No" @if(!empty(Auth::user()->paytm_no)) readonly  @endif/>
									</div>
								</div>
								 
								<div align="right" class="btn-container justify-content-end mt-2"
									style="padding: 15px;">
									<button type="reset" name="reset" class="btn btn-danger">Reset</button>
									<button type="submit" class="btn btn-primary" id="btnx">Save Information</button>
								</div>
							</div>
					</form>
				</div>
						<!-- Office Start -->
				
					
				<!--Page End-->
			</div>
		</div>
	</div>
<style>
    @media only screen and (max-width: 768px) {
 .ha{
   margin-top:10px;
  }
}
</style>
	<script>
		Uimage.onchange = evt => {
			Idiv.style.display = "flex";
			const [file] = Uimage.files
			if (file) {
				Simage.src = URL.createObjectURL(file)
			}
		}
	</script>

	<script>
		Uimages.onchange = evt => {
			Idive.style.display = "flex";
			const [files] = Uimages.files
			if (files) {
				Simages.src = URL.createObjectURL(files)
			}
		}
	</script>
<script>
    function onsubmitForms(e) {
    e.preventDefault();
    $("#btnx").attr("disabled", true);

    $.ajax({
        url: "{{ route('send_otp_email') }}",
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            user_id: '{{ Auth::user()->id }}',
           
        },
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
    title: 'Enter OTP',
    input: 'text',
    inputLabel: 'OTP sent to your email',
    inputPlaceholder: 'Enter OTP here',
    confirmButtonText: 'Verify OTP',
    showCancelButton: true,
    inputAttributes: {
        maxlength: 6,
        autocapitalize: 'off',
        autocorrect: 'off'
    },
    allowOutsideClick: () => !Swal.isLoading(),
    didOpen: () => {
        Swal.getConfirmButton().disabled = false;
        Swal.getInput().addEventListener('input', () => {
            Swal.resetValidationMessage();
        });
    },
   preConfirm: (otp) => {
    return $.ajax({
        url: "{{ route('verify_otp') }}",
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            user_id: '{{ Auth::user()->id }}',
            otp: otp
        }
    }).then(response => {
        if (response.status === 'success') {
            return true;
        } else {
            Swal.showValidationMessage('Invalid or expired OTP.');
            Swal.getConfirmButton().disabled = false;
            throw new Error('Invalid OTP');
        }
    }).catch(error => {
        console.error(error);
        Swal.showValidationMessage('Validation failed. Please try again.');
        Swal.getConfirmButton().disabled = false;
        throw error;
    });
    }
    
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("target").submit();
        } else {
            $("#btnx").removeAttr("disabled");
        }
    });

        } else if (response.status === 'emailError') {
            Swal.fire({
                icon: 'error',
                title: 'Email Not Found',
                text: 'Your email ID does not exist in the database.',
                confirmButtonColor: '#d33'
            });
            $("#btnx").removeAttr("disabled");
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to send OTP. Try again.',
                confirmButtonColor: '#d33'
            });
            $("#btnx").removeAttr("disabled");
        }
    },
    error: function() {
        Swal.fire({
            icon: 'error',
            title: 'Server Error',
            text: 'An unexpected error occurred. Please try again later.',
            confirmButtonColor: '#d33'
        });
        $("#btnx").removeAttr("disabled");
    }
});
}


   
    </script>
	@endsection