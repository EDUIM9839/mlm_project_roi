<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--favicon-->

    <!--plugins-->

    @php  $business_settings = DB::table('business_setup')->get();  @endphp
    <link rel="icon" href="{{ Storage::url('app/logo/') . $business_settings['0']->fav_icon }}" type="image/png" />


    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/login-register.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="/public/assets/css/dd.css?v=4.0">
    <link rel="stylesheet" href="/public/assets/css/flags.css?v=1.0">

    <style>
        
        .registration-alert-btn{
            position: absolute;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            top: -21px !important;
            flex-direction: column-reverse;
        }        
        
    </style>
    @php  $themes = DB::table('register_image')->get();  @endphp
    <style>
    body {
        background-image: url('{{ count($themes) > 0 ? $themes[0]->image : '' }}');
        /* Add other background properties like size and repeat if needed */
        background-size: cover; /* Adjust as per your design */
        background-repeat: no-repeat; /* Adjust as per your design */
        /* Add more styles as needed */
    }
    .swa_logo {
    position: absolute;
    top: 0px!important;
    opacity: 1;
    left:100px;
}
.forms .form-content .button {
    color: #fff;
    margin-top: 40px;
    background: #fbcd47;
}
span div{
        margin: 0 !important;
        width: 150px !important;
        background: white !important;
        
        border: none;
        border-radius: 5px;
    }
    span div ul{
        max-height: 350px !important;
    }
    span div ul::-webkit-scrollbar {
      width: 10px;
    }
    
    /* Track */
     span div ul::-webkit-scrollbar-track {
      background: #f1f1f1; 
    }
     
    /* Handle */
    span div ul::-webkit-scrollbar-thumb {
      background: #888; 
    }
    
    /* Handle on hover */
     span div ul::-webkit-scrollbar-thumb:hover {
      background: #555; 
    }
    
    span div img{
        width: 25px !important;
        height: 25px !important;
    }
    .w-30-30{
    width: 30px;
    height: 30px;
}
</style> 
</head>

<body>
    <div class="container" style="box-shadow: -1px 0px 10px 3px rgb(0 0 0) !important;border-radius: 20px; !important; background: #12161c;">

        <img class="swa_logo center" src="{{ Storage::url('app/logo/') . $business_settings['0']->fav_icon }}" width="160px"
            alt="Logo">  
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img class="registration_background" src="{{ Storage::url('app/public/cover-login.png') }}"
                    alt="">
                <div class="text">
                    <span class="text-1 text-white">Welcome to <b>BULL FIN</b><br></span>
                    <span class="text-2 text-white">Please fill the details to create your account</span>
                </div>
            </div>

        </div>
        <div class="forms">
            <div class="form-content" style="background: #12161c;">
                <div class="login-form">

                    <div class="title mb-4 text-white" id='board-title'>Register </div>

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                              {!! session('success') !!}
                        <button type="button" class="btn-close registration-alert-btn" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                     @elseif (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
 
                    @php $referal = request()->query('referal');  @endphp
                    <form action="{{ route('registeration_submit') }}" id="login-form" method="post">
                        @csrf
                        <div class="input-boxes">
                            <h6 id="show_name" style="color:#f8d248"></h6>
                            <div class="input-box mb-2">
                                <i class="fas fa-link"></i>
                                <input type="text" name="referal" class="referalId" placeholder="Referal id"
                                    id='referalId' value="{{ old('referal') ? old('referal') : (isset($referal) ? $referal : '') }}" >
                                @error('referal') 
                                    <small class="invalid-text">{{ $message }}</small>
                                @enderror
                            </div>

                            <div id="form-area" @php if(!$errors->any()){ echo "style='display:none;'"; } @endphp>
                                <div class="row name-inputs">
                                    <div class="col-12 col-md-6 d-flex w-100" style="grid-gap: 20px">

                                        <div class="input-box">
                                            <i class="fas fa-user"></i>
                                            <input type="text" name="first_name" placeholder="First name"
                                                value="{{ old('first_name') }}">
                                            @error('firs_tname')
                                                <small class="invalid-text">{{ $message }}</small>
                                            @enderror
                                        </div> 
                                        
                                        <div class="input-box mb-2">
                                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                                placeholder="Last name" class="px-2">
                                            @error('last_name')
                                                <small class="invalid-text">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="input-box mb-4">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" name="email" placeholder="Email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <small class="invalid-text">{{ $message }}</small>
                                    @enderror
                                </div>
                              {{--  <div class="input-box mb-4">
                                    <i class="fas fa-phone-alt"></i>
                                    <input type="number" name="contact" placeholder="Phone Number"
                                        value="{{ old('contact') }}">
                                    @error('contact')
                                        <small class="invalid-text">{{ $message }}</small>
                                    @enderror
                                </div>
                                --}}
                               
                                <div class="input-group mb-3">
                                    
                                    <span class="input-group-text  m-0 p-0" id="basic-addon1">
                                       
                                        
                                       <select id="multigames" name="countryCode" is="ms-dropdown" multiple required onchange="showMe(this)">
                                            @php
                                                $countries = DB::table('CountryCodes')->orderBy('code', 'ASC')->get();
                                            @endphp
                                            @foreach($countries as $country)
                                                <option data-image="/public/assets/flags/{{strtolower($country->code)}}.svg" {{$country->dial_code == '+91' ? 'selected' : ''}}  value="{{ $country->dial_code }}">{{ $country->dial_code }} ({{$country->code}})</option>
                                            @endforeach
                                          </select>
                                    </span>
                                    <input type="number" maxlength="10" class="form-control" id="contact" value="{{old('contact', '+91')}}" 
                                        name="contact" placeholder="Phone Number">
                                        
                                </div>
                               @error('contact')
                                        <small class="invalid-text">{{ $message }}</small>
                                    @enderror
                                
                                
                                <div class="input-box mb-4">
                                    <i class="fas fa-unlock"></i>
                                    <input type="password" name="password" placeholder="Password" id="password">
                                    <i class="bi bi-eye-fill" style="margin-left:auto;margin-right: 6px;"
                                        id="togglePassword"></i>
                                    @error('password')
                                        <small class="invalid-text">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="input-box mb-4">
                                    <i class="fas fa-unlock"></i>
                                    <input type="password" name="confirm_password"
                                        placeholder="Confirm password" id="cPassword">
                                    @error('confirm_password')
                                        <small class="invalid-text">{{ $message }}</small>
                                    @enderror
                                    
                                </div>
                               
                          {{-- CAPTCHA --}}
                        <div id="captcha-wrapper" class="input-group mb-3">
                        
                            {{-- 5‑digit code as plain text, no input --}}
                            <span id="captcha-code"
                                  class="input-group-text bg-light border-secondary fw-bold">
                                {{ session('captcha_result') }}
                            </span>
                        
                            {{-- user answer --}}
                            <input type="text"
                                   name="captcha_answer"
                                   maxlength="5"
                                   class="form-control"
                                   placeholder="Enter code"
                                   aria-label="Captcha answer">
                        
                            {{-- refresh button --}}
                            <button type="button"
                                    id="refresh-captcha"
                                    class="btn btn-outline-secondary">
                                ↻
                            </button>
                        </div>
                        
                        @error('captcha_answer')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror





                                <div class="mb-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="termsAndConditions"
                                            name="term_condition">
                                        <label class="form-check-label text-small text-white" for="termsAndConditions">I
                                            read and agree to <a href="#">Terms &amp; Conditions</a></label>

                                    </div>
                                    @error('term_condition')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                               <div class="button input-box">
                                <button type="submit" class="btn yes" id="submit-btn">Sign up</button>
                            </div>

                            </div>
                        </div>
                        <p class="already-account mt-5 text-white">Already have an account? <a href="{{ route('login') }}">Sign
                                in here</a>.</p>
                       
                       
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
        const cPassword = document.querySelector("#cPassword");

        togglePassword.addEventListener("click", function() {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            cPassword.setAttribute("type", type);

            this.classList.toggle("bi-eye-slash-fill");
        });
        
    </script>

    <script>
    
            $(document).ready(function() {  
                const referalId = @json($referal);
                console.log(referalId);
                
                $.ajax({
                    url: '{{ route('web.get-referer-user') }}',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        referralId: referalId
                    }),
                    success: function(response) {
                        if (response['status'] === 'success') {
                            $("#form-area").slideDown();
                        } else {
                            $("#form-area").slideUp();
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
 
        });
    
     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajaxSetup({
            headers: {
                'x-csrf-token': csrfToken
            }
        });
 
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector("#referalId").addEventListener('keyup', function() {
                const referalId = this.value;
                $("#show_name").empty();
                $.ajax({
                    url: "{{ route('web.get-referer-user') }}",
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        referralId: referalId,
                         _token: '{{ csrf_token() }}'
                    }),
                    success: function(response) {
                        console.log(response)
                        if (response['status'] === 'success') {
                            $("#show_name").html(response['user']);
                            $("#form-area").slideDown();
                        }else if(response['status'] === 'warning'){
                            $("#show_name").html(response['messsage']);
                             $("#form-area").slideUp();
                        }
                        else {
                            $("#form-area").slideUp();
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });



            });
          
          $("#referalId").keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
            }
          });
            

        });
        
        
        let inputs = document.querySelectorAll('input');
        inputs.forEach(element => {
            element.addEventListener('keyup', function(){
                let invalidTexts = document.querySelectorAll(".invalid-text");
                invalidTexts.forEach(text => {
                    text.style.display = "none";
                });
            });
        });
    </script>
    
    
<script>
document.addEventListener('DOMContentLoaded', () => {

    const btn = document.getElementById('refresh-captcha');

    btn.addEventListener('click', () => {
        fetch("{{ route('captcha.refresh') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
        })
        .then(r => r.json())
        .then(data => {
            // नया कोड दिखाएँ (SPAN में है, इसलिए textContent)
            document.getElementById('captcha-code').textContent = data.captcha;

            // answer box साफ़ करें
            document.querySelector('input[name="captcha_answer"]').value = '';
        })
        .catch(err => console.error('Captcha refresh failed:', err));
    });

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submit-btn');

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Please wait...'; // optional
    });
});
</script>



 <script src="/public/assets/js/dd.min.js"></script>
</body>

</html>
