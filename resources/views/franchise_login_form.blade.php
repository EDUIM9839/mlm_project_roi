<!doctype html>
<html lang="en">
 

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
          <link rel="icon" href="{{ Storage::url('app/logo/').$business_settings['0']->fav_icon}}" type="image/png" />
    <!--plugins-->
    
    <link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
    <title>{{$business_settings['0']->business_name}}-Franchise Login</title>
</head>
 
<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">

                    <div
                        class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="{{asset('assets/images/login-images/vendor_login__addon.png')}}"
                                    class="img-fluid auth-img-cover-logins" width="650" alt="" />
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-3 text-center">
                                        <img src="/storage/app/logo/{{$business_settings['0']->logo}}" style="width:100px">
                                    </div>
                                      <div class="login-wrapper__top text-center">
                                        <h4 class="title">Welcome to <strong>{{$business_settings['0']->business_name}}</strong></h4>
                                        <h5 style='color:blue;' class="text-decoration-underline">Franchise Login</h5>
                                    </div>
                                    @if (session()->has('message'))
										<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
											<div class="d-flex align-items-center">
												<div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
												</div>
												<div class="ms-3">
													<h6 class="mb-0 text-white">Oppes! Wrong Credentials</h6>
													<div class="text-white">{{session()->get('message')}}</div>
												</div>
											</div>
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
                                    @endif
                                      <div class="form-body" style='margin-top:80px'>
                                        <form class="row g-3" action="{{route('login-validate')}}" method="POST">
                                            @csrf
                                              <input hidden name='franchise' value='1'>
                                            <div class="col-12">
                                                <label for="inputEmailAddress"  style='font-size:16px' class="form-label">User Id</label>
                                                <input type="text"   class="form-control" name="userid" 
                                                    id="country" placeholder="Enter User Id"  oninput="this.value = this.value.toUpperCase();">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword"  style='font-size:16px' class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0"
                                                        id="inputChoosePassword" name="password"
                                                        placeholder="Enter Password"> <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class="bx bx-hide"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <!--<input class="form-check-input" type="checkbox"-->
                                                    <!--    id="flexSwitchCheckChecked">-->
                                                    <!--<label class="form-check-label"-->
                                                    <!--    for="flexSwitchCheckChecked">Remember Me</label>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end"> <a
                                                    href="{{ route('forget-password') }}">Forgot Password ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                     <button disabled type="submit" class="btn btn-danger w-100" >Sign in</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <p class="mb-0">Don't have an account yet? <a
                                                            href="{{ route('register') }}">Sign up here</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="login-separater text-center"> <span><a style='font-size:12px;' class="badge rounded-pill bg-danger" href="{{route('admin-login')}}">ADMIN LOGIN</a></span>
                                        <hr>
                                        <div class="login-separater text-center"> <span><a style='font-size:12px;' class="badge rounded-pill bg-primary" href="{{route('login')}}">USER LOGIN</a></span>
                                    <hr>
                                    </div> 
                                    <!--<div class="login-separater text-center mb-5"> <span>OR SIGN IN WITH</span>-->
                                    <!--    <hr>-->
                                    <!--</div>-->
                                    <!--<div class="list-inline contacts-social text-center">-->
                                    <!--    <a href="javascript:;"-->
                                    <!--        class="list-inline-item bg-facebook text-white border-0 rounded-3"><i-->
                                    <!--            class="bx bxl-facebook"></i></a>-->
                                    <!--    <a href="javascript:;"-->
                                    <!--        class="list-inline-item bg-twitter text-white border-0 rounded-3"><i-->
                                    <!--            class="bx bxl-twitter"></i></a>-->
                                    <!--    <a href="javascript:;"-->
                                    <!--        class="list-inline-item bg-google text-white border-0 rounded-3"><i-->
                                    <!--            class="bx bxl-google"></i></a>-->
                                    <!--    <a href="javascript:;"-->
                                    <!--        class="list-inline-item bg-linkedin text-white border-0 rounded-3"><i-->
                                    <!--            class="bx bxl-linkedin"></i></a>-->
                                    <!--</div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end row-->
            </div>
        </div> 
    </div>
    
           @php  
$prefix=DB::table('business_setup')->first()->id_prefix;
@endphp
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
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
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
        //   var prefix='{{$prefix}}'+'001'; 
          var prefix='{{$prefix}}'; 
            $('#inputuserid').on('input', function(event) { 
                console.log($(this).val());
                // console.log(prefix);
                  if(prefix==$(this).val()){ 
                   $("button[type='submit']").prop('disabled', true);
                  }else{ 
                    $("button[type='submit']").prop('disabled', false);
               } 
            }); 
        });
    </script>
    <!--app JS-->
  <script type="text/javascript">
		function checking(argument) {
			// body...
			var x = document.getElementById("inputuserid").value
			alert(x);
		}
	</script>
	
	
	
	
	
	


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#country').on('input', function() {
                var userid = this.value;
                // console.log(userid);
                $.ajax({
                    url: "{{ url('/check/franchiseid') }}",
                    type: "POST",
                    data: {
                        user_id: userid,
                        _token: '{{ csrf_token() }}'
                    },
                    
                    dataType: 'json',
                    success: function(result) {
                        // console.log(result);
                         if(result=="franchise"){ 
                   $("button[type='submit']").prop('disabled', false);
                    $("button[type='submit']").css({'background-color':'green' ,'border':'2px solid green'});
                  }else{ 
                    $("button[type='submit']").prop('disabled', true);
                    $("button[type='submit']").css('background-color','red');
               } 
                        
                    }
                });
            });
        });
    </script>	
	
	
	
	
	
</body>

</html>
