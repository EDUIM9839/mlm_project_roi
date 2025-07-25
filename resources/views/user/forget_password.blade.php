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
    <style>
        
        .registration_background{
            opacity: 0.5;
        }
        
    </style>

</head>
@php
    $themes = DB::table('forget_image')->get();
@endphp

<style>
    body {
        background-image: url('{{ count($themes) > 0 ? $themes[0]->image : '' }}');
      
        background-size: cover; 
        background-repeat: no-repeat;  
       
    }
    .swa_logo {
    position: absolute;
    top: 0px!important;
    opacity: 1;
    left:150px;
}
.forms .form-content .button {
    color: #fff;
    margin-top: 40px;
    background: #fbcd47;
}
</style>
<body>
    <div class="container">

        <img class="swa_logo"  style="left: 30px; margin-top: 15px; width: 101px;" src="{{ Storage::url('app/logo/') . $business_settings['0']->fav_icon }}" width="160px"
            alt="SWA Logo">
             

        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                 <img class="registration_background" src="{{ Storage::url('app/public/cover-login2.jpg') }}"
                    alt="">
                <div class="text">
                    <span class="text-1 text-white">Welcome to <b>BULL FIN</b><br></span>
                    <span class="text-2 text-white">Journey start's today!</span>
                </div>
            </div>

        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">

                    <div class="title mb-4 text-white" id='board-title'>Forgot password </div>
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
                    
                    
                    
                    <form action="{{ route('forget_password_mail1') }}" id="login-form" method="post">
                        @csrf
                        <div class="input-boxes">
                            <div class="input-box mb-2">
                                <i class="fas fa-link"></i>
                                <input type="text" name="userid" class="referalId" placeholder="User Id"
                                    id='userid' value="{{ old('userid') }}">
                                @error('userid')
                                    <small class="invalid-text">{{ $message }}</small>
                                @enderror
                            </div>

                             <div class="input-box mb-2">
                                <i class="fas fa-envelope"></i>
                                <input type="text" name="email" class="" placeholder="Email"
                                    id='email' value="{{ old('email') }}">
                                @error('email')
                                    <small class="invalid-text">{{ $message }}</small>
                                @enderror
                            </div>

                          

                            <div class="button input-box">
                                <button type="submit" class="btn">
                                     Send Verification Email
                                </button>
                            </div>
                            
                             <div>
                                <a href="{{ route('login') }}" class="text-secondary w-100 d-flex align-items-center p-2 justify-content-center">
                                    <i class='bx bx-arrow-back'></i>
                                    &nbsp; Back to login
                                </a>
                            </div>
                            

                        </div> 
                       
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
