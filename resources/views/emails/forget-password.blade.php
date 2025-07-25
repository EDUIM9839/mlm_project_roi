<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="background-color:#e2e2e2;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <center>
                                              
                                            <img src="{{asset('/assets/images/logo-icon.png')}}" style="width:100px; border-radius:5px; margin-top:30px; margin-bottom:30px;" />
                                        </center>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6">
                                        <div style="width:75%; border:1px solid black; border-radius:7px; background-color:white; color:black; padding:10px; margin-left:auto; margin-right:auto;">  
                                            <center><h1>Your Password</h1></center>
                                            <h3>Your Password is: {{$mailData}} </h3>
                                           
                                          
                                        </div>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" style="margin-top:30px;">
                                        <center>
                                            2024 &#169; All rights reserved
                                            <br/><br/><br/>
                                        </center>
                                    </div>
                                </div>
                            </body>
 
 
 
</html>