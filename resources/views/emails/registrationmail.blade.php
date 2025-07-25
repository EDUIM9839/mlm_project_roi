<?php $user = DB::table('business_setup')->get();  ?>
<?php $email = DB::table('email_theme')->get(); ?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    .button {
        background-color: #fb9d05;
        ;
        -webkit-border-radius: 60px;
        border-radius: 50px;
        border: none;
        color: #eeeeee;
        cursor: pointer;
        display: inline-block;
        font-family: sans-serif;
        font-size: 20px;
        padding: 10px 25px;
        text-align: center;
        text-decoration: none;
    }

    @keyframes glowing {
        0% {
            background-color: #fb9d05;
            box-shadow: 0 0 5px#fb9d05;
        }

        50% {
            background-color: #fb9d05;
            box-shadow: 0 0 20px #fb9d05;
        }

        100% {
            background-color: #fb9d05;
            box-shadow: 0 0 5px #fb9d05;
        }
    }

    .button {
        animation: glowing 1000ms infinite;
    }

    /*@media only screen and (max-width: 768px) {*/
    /*    .email {*/
    /*        color: red;*/
    /*        font-size: 15px;*/
    /*    }*/
    /*}*/
</style>

<body style="background-color:#e2e2e2;">
    <div class="row">
        
        <div class="col-sm-12">
            <center>
                <div style="width:90%; border-style: none; background: linear-gradient(#ffffff, #0393cf 1%, #ffffff 60%);">
                    <img src="{{ url('storage/app/logo/bull.jpg')}}" style="width:150px; border-radius:5px; margin-top:30px; margin-bottom:30px;">
                    <h1 style="color:white;">{{$email['0']->header}} </h1></br>
                    <!--<p class="email" style="color:white;font-size:15px;"><b>“खुद लड़नी पड़ती है जिंदगी की लड़ाई.. लोग साथ कम, ज्ञान ज्यादा  देते है..”</b></p>-->
                    <div style="" class="login-separater text-center  bg-gradient-orange"> <span><a class="badge rounded-pill bg-gradient-orange button" style=' background-color: #fb9d05; color:white;font-size:15px; border-radius:20px; padding: 10px 25px; ' href="{{route('login')}}">Login To Your New Account</a></span>
                    </div> <br>
                    
                    <p style="color:black; font-size:20px;">User Id:-<span style="color:#0393cf"><b><u>{{$mailData['userid']}}</u></b></span></p>
                    <p style="color:black; font-size:20px;">Password:-<span style="color:#0393cf"><b><u>{{$mailData['password']}}</u></b></span></p>
                      <p style="color:black; font-size:20px;">Transaction Password:-<span style="color:#0393cf"><b><u>{{$mailData['transaction_password']}}</u></b></span></p>
                    <h3 style="color:#0393cf;"><b>{{$email['0']->message}} </b></h3>
                    <p class="email" style=" font-size:15px;"><b> {{$email['0']->quote}}</b></p>
                   <center><p style="margin-top:25px;" >{{$email['0']->footer}} </br> or email us at {{$email['0']->email}} </p></center> 
                    <div style="display:block;" align="center"> <img src="{{asset('assets/images/theme/e11.jpeg')}}" width="600" height="200">
                    </div>
                </div>
            </center>
            <div class="col-sm-12" style="margin-top:25px;">
                <center>
                    {{date("Y")}} &#169; All rights reserved
                    <br />
                    <p>Note: This is system Generated Mail. Plz Don't Reply</p>
                </center>

                <br>
                <br>
            </div>
        </div>
</body>

</html>