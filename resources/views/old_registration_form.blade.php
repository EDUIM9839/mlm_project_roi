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
  
    <title>Mega World</title>
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
                                <img src="{{asset('assets/images/login-images/register-cover.svg')}}"
                                    class="img-fluid auth-img-cover-login" width="550" alt="" />
                            </div>
                        </div>
                    </div>
                    <?php
                     $user = DB::table('business_setup')->get();
                     //dd($user);
                    ?>

                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-3 text-center">
                                      <img style="border-radius:18px; width:30%;" src="{{ Storage::url('app/logo/').$user[0]->logo}}" style="width:60px">
                                    <!--<img src="{{asset('productImages')}}{{'/'}}{{$user[0]->logo}}" width="60" alt="" />-->
                                    </div>
                                    <div class="text-center mb-4">
                                       
                                        <h4 style="color:white;" class="title">Welcome to <strong>{{$user[0]->business_name}}</strong></h4>
                                        <p class="mb-0">Please fill the below details to create your account</p>
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
   
                                    <div class="form-body">
                                        <form id="jQueryValidationForm1" class="mb-3"
                                            action="{{ route('save-registration') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input name='tbname' value='user' hidden >
                                          
                                            <div class="mb-3"> 
                                                <label for="email" class="form-label">Referal
                                                    ID</label>&nbsp;<span class="useridlabel" id="show_name"></span>
                                                    
                                                   
                                                <input type="text" class="form-control" name="referal" id="user_ids"
                                                     <?php if(isset(request()->referal)){ ?> value="{{request()->referal}}" <?php }else{ ?> value="{{old('referal')}}" <?php }?>
                                                     placeholder="Enter referal id" onkeyup="this.value = this.value.toUpperCase();"  <?php if(isset(request()->referal)){ echo "readonly";} ?>>

                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#user_ids').on('input', function() {
                                                        

                                                            $("#btnx").attr("disabled", "disabled");
                                                            var userid = this.value;
                                                            // console.log(userid);
                                                            $("#state-dropdown").html('');
                                                            $.ajax({
                                                                url: "{{url('api/fetch-users')}}",
                                                                type: "POST",
                                                                data: {
                                                                    userid: userid,
                                                                    _token: '{{ csrf_token() }}'
                                                                },
                                                                dataType: 'json',
                                                                success: function(result) {
                                                                 
                                                                 
                                                                    if(result.status=='active'){
                                                                 $('#show_name').text(result.first_name.concat(' ').concat(result.last_name));
                                                                      
                                                                      if(result.first_name!='' && result.last_name!=''){
                                                                          $("#btnx").removeAttr("disabled");
                                                                          $("#data").slideDown();
                                                                          
                                                                      }else{
                                                                         $("#data").slideUp();
                                                                     $("#show_name").html('<span style="color:red">UserId not found</span>');
                                                                       
                                                                      }
                                                                      
                                                                    }else{
                                                                        
                                                                        
                                                                         $("#data").slideUp();
                                                                     $("#show_name").html('<span style="color:red">User Not Active</span>');
                                                                       
                                                                        
                                                                    }
                                                              
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>
                                                
                                              
                                                <div style="color:red;">{{ $errors->first('referal') }}</div>
                                            </div>
                                            
                                        <div id="data" style="display:none!important">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="username" value="{{old('first_name')}}"
                                                    name="first_name">
                                                <div style="color:red;">{{ $errors->first('first_name') }}</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="username" value="{{old('last_name')}}"
                                                    name="last_name">
                                                <div style="color:red;">{{ $errors->first('last_name') }}</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Mobile</label>
                                                <input type="text" maxlength="13" class="form-control" id="username" value="{{old('contact')}}"
                                                    name="contact">
                                                <div style="color:red;">{{ $errors->first('last_name') }}</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" value="{{old('email')}}"
                                                    name="email">
                                                <div style="color:red;">{{ $errors->first('email') }}</div>
                                            </div>
                                            {{--
                                            <div class="mb-3">
                                                <label for="aadhar_no" class="form-label">Aadhar Card No.</label>
                                                <input type="text" class="form-control" id="aadhar_no" value="{{old('aadhar_no')}}"
                                                    name="aadhar_no" maxlength="12">
                                                <div style="color:red;">{{ $errors->first('aadhar_no') }}</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Pan Card No.</label>
                                                <input type="text" class="form-control" id="pan" value="{{old('pan')}}"
                                                    name="pan" maxlength="10">
                                                <div style="color:red;">{{ $errors->first('pan') }}</div>
                                            </div>
                                            --}}
                                            @if(DB::table('business_setup')->first()->mlm_plan_type=='binary')
                                            {{--<div class="mb-3 form-password-toggle">
                                                <label class="form-label" for="password">Position</label>
                                                <div class="input-group">
                                                       <input checked type="radio" value='left'  id='left' name="position">&nbsp;<label for='left'>Left</label>
                                                   &nbsp;&nbsp;  &nbsp;&nbsp; <input type="radio" id='right' value='right'   name="position">&nbsp;<label for='right' >Right</label>
                                                </div>
                                                <div style="color:red;">{{ $errors->first('position') }}</div>
                                            </div>--}}
                                             @endif
                                            <div class="mb-3 form-password-toggle">
                                                <label class="form-label" for="password">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0"
                                                        id="inputChoosePassword" name="password"
                                                        placeholder="Enter Password"> <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                                <div style="color:red;">{{ $errors->first('password') }}</div>
                                            </div>
                                            <div class="mb-3 form-password-toggle">
                                                <label class="form-label" for="password">Confirm
                                                    Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0"
                                                        id="inputChoosePassword" name="confirm_password"
                                                        placeholder="Enter Password"> <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                                <div style="color:red;">{{ $errors->first('confirm_password') }}</div>
                                            </div>
                                            
                                            {{--
                                            <div class="mb-3">
                                                <label class="form-label" for="image"> Upload Profile
                                                    </label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control border-end-0"
                                                        id="image" name="image"> <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                           ></i></a>
                                                </div>
                                                <div style="color:red;">{{ $errors->first('image') }}</div>
                                            </div>
                                            --}}
                                            
                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked" name="term_condition">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">I
                                                        read and agree to Terms & Conditions</label>
                                                    <div style="color:red;">
                                                        {{ $errors->first('term_condition') }}
                                                    </div>
                                                </div>
                                            </div><br>

                                            <input type="hidden" name="push_notification_code" value=""
                                                id="token" />
                                            <input type="hidden" name="transaction_password"
                                                value="<?php echo rand(100000, 999999); ?>" />

                                            <button class="btn btn-primary d-grid w-100" id="btnx"
                                                type="submit">
                                                Sign up
                                            </button>
                                    </div>
                                            
                                        </form>
                                        <div class="col-12">
                                            <div class="text-center ">
                                                <p class="mb-0">Already have an account? <a
                                                        href="{{ route('login') }}">Sign in here</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="login-separater text-center mb-5"> <p style="color:black!important;"><span>OR SIGN UP WITH EMAIL</span></p>
                                        <hr />
                                    </div>
                                    <div class="list-inline contacts-social text-center">
                                        <a href="javascript:;"
                                            class="list-inline-item bg-facebook text-white border-0 rounded-3"><i
                                                class="bx bxl-facebook"></i></a>
                                        <a href="javascript:;"
                                            class="list-inline-item bg-twitter text-white border-0 rounded-3"><i
                                                class="bx bxl-twitter"></i></a>
                                        <a href="javascript:;"
                                            class="list-inline-item bg-google text-white border-0 rounded-3"><i
                                                class="bx bxl-google"></i></a>
                                        <a href="javascript:;"
                                            class="list-inline-item bg-linkedin text-white border-0 rounded-3"><i
                                                class="bx bxl-linkedin"></i></a>
                                    </div>
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
    
   @if(count($errors->all())>0)
    <script>  $("#data").css("display",'block');</script>
    
    @endif
    
    <!--<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>-->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('assets/plugins/validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/plugins/validation/validation-script.js')}}"></script>
    <!--Password show & hide js -->
    @if(isset(request()->referal))
    @php
  $chech_users=  DB::table('user')->where('userid',request()->referal)->count();
    @endphp
    @if($chech_users<'1')
     <script>window.location = "{{ route('register') }}";</script>
    @endif
     <script>
         $(document ).ready(function() {
              $("#data").slideDown();
         });
     </script>
     @endif
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
        });
    </script>
    <!--app JS-->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>

</body>

</html>
