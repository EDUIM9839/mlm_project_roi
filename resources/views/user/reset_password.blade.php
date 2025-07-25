<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	      <link rel="icon" href="{{ Storage::url('app/logo/').$business_settings[0]->fav_icon}}" type="image/png" />
	<!--plugins-->
	<link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{asset('assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
	<title>Rocker - Bootstrap 5 Admin Dashboard Template</title>
</head>
<body class="">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-cover">
			<div class="">
				<div class="row g-0">
					<div class="col-md-6  auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
							<div class="card-body">
                                 <img src="{{asset('assets/images/login-images/forgot-password-cover.svg')}}" class="img-fluid" width="600" alt=""/>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 justify-content-center">
						<div class="card rounded-0 m-6 shadow-none bg-transparent mb-0">
							<div class="card-body p-sm-5">
								<div class="p-3">
									<div class="text-center">
										<img src="{{asset('assets/images/icons/forgot-2.png')}}" width="100" alt="" />
									</div>
								 
                                   
									<div style="position:relative; left:35%">
									    <h4 class="mt-5 font-weight-bold">Reset Password?</h4>
								
									</div>
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
									<form  action="{{route('reset_old_password')}}" method="POST">
									    @csrf
									    <div class="my-4">
										<label class="form-label">User Id</label>
										<input type="text" name="userid" class="form-control" placeholder="Enter Your Userid" />
									</div>
									<div class="my-4">
										<label class="form-label">New Password</label>
										<input type="password" name="password" id="txtNewPassword" class="form-control" placeholder="********" />
									</div>
									<div class="my-4">
										<label class="form-label">Confirm Password</label>
										<input type="password" name="confirm_password" id="txtConfirmPassword" class="form-control" placeholder="********" />
									</div>
									<div class="registrationFormAlert"  id="CheckPasswordMatch"></div>
										<div class="registrationFormAlert"  id="CheckPasswordMatch"></div>
									<!--	<div class="my-4">-->
									<!--	<label class="form-label">Enter Your OTP</label>-->
									<!--	<input type="text" name="otp" class="form-control" placeholder="12345" />-->
									<!--</div>-->
									<div class="d-grid gap-2">
									    <div align="center">
								<button type="submit" class="btn btn-primary">Change</button>
									</div>
									
									</div>
									</form>
								</div>
							</div>
						</div>
					
					</div>
					
					
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<script>
    function checkPasswordMatch() {
        var password = $("#txtNewPassword").val();
        var confirmPassword = $("#txtConfirmPassword").val();
        if (password == confirmPassword)
            $("#CheckPasswordMatch").html("Passwords match.").css({'color':'green'});
              
       else if (password != confirmPassword)
            $("#CheckPasswordMatch").html("Passwords does not match!").css({'color':'red'});
       
    }
    $(document).ready(function () {
       $("#txtConfirmPassword").keyup(checkPasswordMatch);
    });
    </script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>
</html>