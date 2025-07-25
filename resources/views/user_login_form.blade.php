<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--favicon-->

    <!--plugins-->

    @php
        $business_settings = DB::table('business_setup')->get();
    @endphp
    <link rel="icon" href="{{ Storage::url('app/logo/') . $business_settings['0']->fav_icon }}" type="image/png" />


    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/login-register.css') }}" rel="stylesheet">

@php
    $themes = DB::table('user_background')->get();
@endphp

<style>
    body {
        background-image: url('{{ count($themes) > 0 ? $themes[0]->image : '' }}');
        /* Add other background properties like size and repeat if needed */
        background-size: cover; /* Adjust as per your design */
        background-repeat: no-repeat; /* Adjust as per your design */
        /* Add more styles as needed */
    }
    
    .container{
        background-color:#0b0b24;
    }
        .form-content{
        background-color:#2e1856;
    }
    
    .form-content .input-box i{
        padding-left:10px;
    }
    .forms .form-content .button button {
      background: #df9b51;
    }
    .swa_logo {
    position: absolute;
    top: 40px;
    opacity: 1;
}
.registration_background {
    opacity: 1;
}
.container .cover img {
    
    height: 95%;
    width: 100%;
    
}
.w-30-30{
    width: 30px;
    height: 30px;
}
.container .cover::before, .container .cover::after {
    content: '';
    position: absolute;
    height: 100%;
    width: 100%;
    background: #d9575700 !important;
    opacity: 1;
    z-index: 12;
}

.container .form-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #0b0b24;
}
  .swa_logo {
    position: absolute;
    top: 0px!important;
    opacity: 1;
    left:150px;
}
</style>
</head>


<body>
    <div class="container" style="box-shadow: -1px 0px 10px 3px rgb(255 229 229)!important;border-radius: 20px;!important">

        <img class="swa_logo" style="left: 30px; margin-top: 15px; width: 101px;" src="{{ Storage::url('app/logo/') . $business_settings['0']->fav_icon }}" width="160px" alt="SWA Logo">


        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front" >
                 
                <img class="registration_background" src="{{ Storage::url('app/public/demo-1.jpg') }}"
                    alt="">
                {{--<img class="registration_background" src="{{ Storage::url('app/public/crypto.avif') }}"
                    alt="">--}}
                <div class="text">
                    <span class="text-1 text-white">Welcome to <b>BULL FIN</b><br></span>
                    <span class="text-2 text-white">Journey start's today!</span>
                </div>
            </div>

        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">

                    <div class="title mb-4 text-white" id='board-title'>User Login </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                     @elseif (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    
                    
                    <form action="{{ route('login-validate') }}" id="login-form" method="post">
                        @csrf
                        
                                              @php
                                $data = DB::table('user')->skip(1)->first(); 
                    @endphp
                        <div class="input-boxes">
                            <div class="input-box mb-2">
                                <i class="fas fa-link"></i>
                                <input type="text" name="userid" class="referalId"    placeholder="User id"
                                    id='userid' >
                                @error('userid')
                                    <small class="invalid-text">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="input-box mb-4">
                                <i class="fas fa-unlock"></i>
                                <input type="password" name="password" placeholder="Password"  id="password" >
                                <i class="bi bi-eye-fill" style="margin-left:auto;margin-right: 6px;"
                                    id="togglePassword"></i>
                                @error('password')
                                    <small class="invalid-text">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-2 d-flex justify-content-between">

                                <div class="mb-2">
                                    <!--<input class="form-check-input" type="checkbox" id="remeberMe" name="remember_me">-->
                                    <!--<label class="form-check-label text-small" for="remeberMe">Remember me</label>-->
                                </div>
                                <div class="text text-white"><a href="{{ route('forget-password') }}" class="text-small text-white" id="forgotpassword">Forgot
                                        password?</a></div>
                            </div>


            
                            <div class="button input-box">
                                <button type="submit" class="btn text-white">  Log In   </button>
                            </div>
                  
                            
                             <div class="my-3">
                              {{--  <a href="{{ route('admin-login') }}"  class="text-secondary w-100 d-flex align-items-center p-2 justify-content-center text-white">
                                    <i class='bx bx-arrow-back'></i>
                                    &nbsp;Go to admin login
                                </a>--}}
                            </div>

                        </div> 
                        <p class="text-center mt-4 text-white">Don’t have an account? <a href="{{ route('register') }}">Sign
                                up</a>.</p>
                       
                      
                       @include("partials.wallet_support")
                    </form>


                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            this.classList.toggle("bi-eye-slash-fill");
        });
    </script>
</body>

</html>
