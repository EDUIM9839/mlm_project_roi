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
                    <img src="{{ url('storage/app/logo/'.$user['0']->logo)}}" style="width:150px; border-radius:5px; margin-top:30px; margin-bottom:30px;">
                   
                     
                    
                      <h3> Your Transaction Password is  {{$mailData['transaction_password']}}.</h3>
                   
                   <center><p style="margin-top:35px;" >{{$email['0']->footer}}  {{$email['0']->contact}}</br> or email us at {{$email['0']->email}} </p></center> 
                   
                </div>
            </center>
            <div class="col-sm-12" style="margin-top:25px;">
                <center>
                    2024 &#169; All rights reserved
                    <br />
                    <p>Note: This is system Generated Mail. Plz Don't Reply</p>
                </center>

                <br>
                <br>
            </div>
        </div>
</body>

</html>