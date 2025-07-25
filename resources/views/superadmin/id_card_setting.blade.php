@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')
<style>
.company-name{
    font-family:Impact,Arial; font-stretch:ultra-condensed;  text-transform: uppercase; font-size:1.rem;
}

.website-footer{
    display:block; text-transform:uppercase; font-weight:bold; font-size:0.8rem; padding-top:0.6rem;
}

	.id-card-tag {
			width: 0;
			height: 0;
			border-left: 120px solid transparent;
			border-right: 120px solid transparent;
			border-top: 100px solid #d7d6d3;
			margin: -10px auto -30px auto;
		}
.id-card-tag:after {
    content: '';
    display: block;
    width: 0;
    height: 0;
    border-left: 50px solid transparent;
    border-right: 50px solid transparent;
    border-top: 100px solid #f6f6f6;
    margin: -10px auto -30px auto;
    position: relative;
    top: -90px;
    left: -50px;
}


		.id-card-hook {
			background-color:#4d4f4e;
		    width: 70px;
		    margin: 0 auto;
		    height: 15px;
		    border-radius: 5px 5px 0 0;
		}
		.id-card-hook:after {
			content: '';
		    background-color:#d7d6d3;
		    width: 47px;
		    height: 6px;
		    display: block;
		    margin: 0px auto;
		    position: relative;
		    top: 6px;
		    border-radius: 4px;
		}

.panel{
      background-color:#f6f6f6;padding-right:16%; position:relative; padding-left:16%; border-radius:10px;
   }
    #user-img{
        
        object-fit:fill;
       height:5rem;
       width:5rem;
        border:2px solid orange;
    }
    
   .welcome-letter{
       
       border:2px solid #4d4f4e;
      margin:auto;
      position:relative;
      background-image:url('../public/assets/images/theme/8.jpg' );
       min-height:400px;
       width:300px;
        background-repeat: no-repeat;
  background-size:100% 100%;
  padding-right:35px;
  padding-left:35px;
  border-radius:15px;
   }
    .welcome-letter-content{
       text-align:justify;
       top:7%;
       width:100%;
       left:0;
       padding-left:16px;
          padding-right:16px;
      font-size:0.7rem;
       position:absolute;
       
   }
    .welcome-letters{
       
       border:2px solid #4d4f4e;
      margin:auto;
      position:relative;
     background-image:url('../public/assets/images/theme/2.png' );
       min-height:400px;
       width:300px;
        background-repeat: no-repeat;
  background-size:100% 100%;
  padding-right:35px;
  padding-left:35px;
  border-radius:15px;
   }
    .welcome-letters-content{
       text-align:justify;
       top:7%;
       width:100%;
       left:0;
       padding-left:16px;
          padding-right:16px;
      font-size:0.7rem;
       position:absolute;
       
   }
    .welcome-letter3{
       
       border:2px solid #4d4f4e;
      margin:auto;
      position:relative;
      background-image:url('../public/assets/images/theme/3.jpg' );
       min-height:400px;
       width:300px;
        background-repeat: no-repeat;
  background-size:100% 100%;
  padding-right:35px;
  padding-left:35px;
  border-radius:15px;
   }
    .welcome-letter3-content{
       text-align:justify;
       top:7%;
       width:100%;
       left:0;
       padding-left:16px;
          padding-right:16px;
      font-size:0.7rem;
       position:absolute;
       
   }
   
   .welcome-letter4{
       
       border:2px solid #4d4f4e;
      margin:auto;
      position:relative;
      background-image:url('../public/assets/images/theme/111.jpg' );
       min-height:400px;
       width:300px;
        background-repeat: no-repeat;
  background-size:100% 100%;
  padding-right:35px;
  padding-left:35px;
  border-radius:15px;
   }
    .welcome-letter4-content{
       text-align:justify;
       top:7%;
       width:100%;
       left:0;
       padding-left:16px;
          padding-right:16px;
      font-size:0.7rem;
       position:absolute;
       
   }
   
   .welcome-letter5{
       
       border:2px solid #4d4f4e;
      margin:auto;
      position:relative;
      	background-image:url('../public/assets/images/theme/1.jpg' );
       min-height:400px;
       width:300px;
        background-repeat: no-repeat;
  background-size:100% 100%;
  padding-right:35px;
  padding-left:35px;
  border-radius:15px;
   }
    .welcome-letter5-content{
       text-align:justify;
       top:7%;
       width:100%;
       left:0;
       padding-left:16px;
          padding-right:16px;
      font-size:0.7rem;
       position:absolute;
       
   }
   .font-set{
font-size:0.7rem;     
text-align:justify;
       
   }
     @media only screen and (max-width:919px) {
   #welcome-letter-content{
        font-size:0.7rem;
   }
   
   .font-set{
        font-size:0.7rem;

     }
    @media only screen and (max-width:873px) {
        
        
         
   #welcome-letter-content{
        font-size:0.7rem;
       
   }
   
   .font-set{
       
        font-size:0.7rem;
   }
   
    }
   
    @media only screen and (max-width:676px) {
        
        
        
        
.company-name{
    
    
    font-family:Arial; font-stretch:ultra-condensed;  text-transform: uppercase; font-size:1.06rem;
    font-weight:900;
}



   #welcome-letter-content{
        font-size:0.7rem;
   }
   
   .font-set{
       
        font-size:0.7rem;
   }
   .panel{
     background-color:#f6f6f6;
     padding-right:0%;
     position:relative;
     padding-left:0%; 
     border-radius:10px;
}

#welcome-letter{
    width:100%;
}
    }
      @media only screen and (max-width:389px) {
             .panel{
     background-color:#f6f6f6;
     padding-right:0%;
     position:relative;
     padding-left:0%; 
     border-radius:10px;
}

#welcome-letter{
    
    width:100%;
}
   #welcome-letter-content{
        font-size:0.7rem;
       
   }
   
   .font-set{
       
        font-size:0.7rem;
   }
    }
         @media only screen and (max-width:328px) {
   #welcome-letter-content{
        font-size:0.7rem;
       
   }
   .font-set{
        font-size:0.7rem;
   }
      .panel{
     background-color:#f6f6f6;
     padding-right:0%;
     position:relative;
     padding-left:0%; 
     border-radius:10px;
}

#welcome-letter{
    
    width:100%;
}

    }
    .sticky{
        position: sticky;
        top: 80px;
        
    }
    
</style>
    <!--start page wrapper -->
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
                            <li class="breadcrumb-item active" aria-current="page">Id Card</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
            <!-- Scrollable -->
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
					<div class=" ">
						<div class="font-20 text-white"><i class='bx bxs-message-square-x'
								style='display:contents; !important'></i><span
								style='font-size:16px;'>&nbsp;{!!session()->get('error')!!}</span>
						</div>
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div> @endif
            <form action="{{route('idcard_setting_save')}}" method="post" enctype="multipart/form-data">
					@csrf 
						@if(($idcards[0]->theme)==('../public/assets/images/theme/8.jpg')) 
              <div  class="content pb-4" >
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10 col-md-10 panel" >
                                        <h3 style="text-align:center" class="pt-3">Theme 1</h3>
                                  <div class="line">
                                       <hr>
                                  </div>
                                   <div id='id-card-x' >
                                <div class="id-card-tag"> </div>  
                                  <div class="id-card-hook"> </div>  
                      <div class="welcome-letter" class="mt-5 d-flex" >
                       <div class="welcome-letter-content"> 
                       <label for="themes1">
                       <div style="display:block;" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"width=30%; alt="logo"><br>
  </div>
                       <!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
                       
                                        <div class="row" align="center" style="position: relative;height: 55%;margin-top:17%;margin-bottom:5%; ">
                          <div class="col-md-12" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png" width=70px; height=50px; alt="logo" class="img-fluid rounded-circle" > </div>  
                                        </div>
                                         <div class="ms-auto " >
								<input class="widgets-icons-2  ms-auto" name="theme" id='themes1'
									value="../public/assets/images/theme/8.jpg" type="radio" style="position: relative;left: 50%;"checked>
							</div>
                                    <h5 align="center" style="color:black;   margin-top:-21.8%; font-weight:800;">
                                  Ajay
                                     </h5>
                                             <div class="row" style="position: relative;left: 13%;">
                                            <table class="tb" id="mytable">
                                                  
                                                  <tr>
                                                    <td id="id1"><b>Id No</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td><b> 1</b></td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Joined Date</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>RCK003</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Email</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b style="color:blue;">test@gmail.com</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Phone</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td><b> 9100000000</b></td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Address</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td><b>Your Address</b></td>
                                                  </tr>
                                            </table>
                                            
                                        </div>
                                          
                                         <br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.COMPANY.COM
									</span>
                      </div>
                      </div>
                </div>      
            </div>    
            <div class="col-sm-1">
            </div>   
                    </div>
                  </div>
                  	@else
                  	<div  class="content pb-4" >
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10 col-md-10 panel" >
                                        <h3 style="text-align:center" class="pt-3">Theme 1</h3>
                                  <div class="line">
                                       <hr>
                                  </div>
                                   <div id='id-card-x' >
                                <div class="id-card-tag"> </div>  
                                  <div class="id-card-hook"> </div>  
                      <div class="welcome-letter" class="mt-5 d-flex" >
                       <div class="welcome-letter-content"> 
                       <label for="themes1">
                       <div style="display:block;" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"width=30%; alt="logo"><br>
  </div>
                       <!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
                       
                                        <div class="row" align="center" style="position: relative;height: 55%;margin-top:17%;margin-bottom:5%; ">
                          <div class="col-md-12" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png" width=70px; height=50px; alt="logo" class="img-fluid rounded-circle" > </div>  
                                        </div>
                                         <div class="ms-auto " >
								<input class="widgets-icons-2  ms-auto" name="theme" id='themes1'
									value="../public/assets/images/theme/8.jpg" type="radio" style="position: relative;left: 50%;">
							</div>
                                    <h5 align="center" style="color:black;   margin-top:-21.8%; font-weight:800;">
                                  Ajay
                                     </h5>
                                             <div class="row" style="position: relative;left: 13%;">
                                            <table class="tb" id="mytable">
                                                  
                                                  <tr>
                                                    <td id="id1"><b>Id No</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td><b> 1</b></td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Joined Date</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>RCK003</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Email</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b style="color:blue;">test@gmail.com</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Phone</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td><b> 9100000000</b></td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Address</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td><b>Your Address</b></td>
                                                  </tr>
                                            </table>
                                            
                                        </div>
                                          
                                         <br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.COMPANY.COM
									</span>
                      </div>
                      </div>
                </div>      
            </div>    
            <div class="col-sm-1">
            </div>   
                    </div>
                  </div>
                  	@endif
                  	@if(($idcards[0]->theme)==('../public/assets/images/theme/2.jpg')) 
                   <div  class="content pb-4" >
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10 col-md-10 panel" >
                                        <h3 style="text-align:center" class="pt-3">Theme 2</h3>
                                  <div class="line">
                                       <hr>
                                  </div>
                                   <div id='id-card-x' >
                                <div class="id-card-tag"> </div>  
                                  <div class="id-card-hook"> </div>  
                      <div class="welcome-letters" class="mt-5 d-flex" >
                       <div class="welcome-letters-content"> 
                       <label for="themes">
                       <div style="display:block;" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"width=30%; alt="logo"><br>
  </div>
                       <!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
                       
                                        <div class="row" align="center" style="position: relative;height: 55%;margin-top:17%;margin-bottom:5%; ">
                          <div class="col-md-12" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png" width=70px; height=50px; alt="logo" class="img-fluid rounded-circle" > </div> 
                                         </div> 
                                         <div class="ms-auto " >
								<input class="widgets-icons-2  ms-auto" name="theme" id='themes'
									value="../public/assets/images/theme/2.png" type="radio" style="position: relative;left: 50%;"checked>
							</div>
                                    <h5 align="center" style="color:black;   margin-top:-21.8%;  font-weight:800;">
                                  Ajay
                                     </h5>
                                             <div class="row" style="position: relative;left: 13%;">
                                            <table class="tb" id="mytable">
                                                  
                                                  <tr>
                                                    <td id="id1"><b>Id No</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td> <b> 1 </b> </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Joined Date</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td> <b>RCK003</b></td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Email</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b style="color:blue;">test@gmail.com</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Phone</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td><b> 9100000000 </b></td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Address</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td> <b> Your Address </b> </td>
                                                  </tr>
                                                  
                                            </table> 
                                        </div> 
                                         <br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.COMPANY.COM
									</span>
                      </div>  
                      </div>
                      
                </div>  
               
                             
            </div>    
            <div class="col-sm-1">
                
            </div>

                       
                    </div>
                  </div>
                  	@else
                  	 <div  class="content pb-4" >
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10 col-md-10 panel" >
                                        <h3 style="text-align:center" class="pt-3">Theme 2</h3>
                                  <div class="line">
                                       <hr>
                                  </div>
                                   <div id='id-card-x' >
                                <div class="id-card-tag"> </div>  
                                  <div class="id-card-hook"> </div>  
                      <div class="welcome-letters" class="mt-5 d-flex" >
                       <div class="welcome-letters-content"> 
                       <label for="themes">
                       <div style="display:block;" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"width=30%; alt="logo"><br>
  </div>
                       <!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
                       
                                        <div class="row" align="center" style="position: relative;height: 55%;margin-top:17%;margin-bottom:5%; ">
                          <div class="col-md-12" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png" width=70px; height=50px; alt="logo" class="img-fluid rounded-circle" > </div> 
                                         </div> 
                                         <div class="ms-auto " >
								<input class="widgets-icons-2  ms-auto" name="theme" id='themes'
									value="../public/assets/images/theme/2.png" type="radio" style="position: relative;left: 50%;">
							</div>
                                    <h5 align="center" style="color:black;   margin-top:-21.8%;  font-weight:800;">
                                  Ajay
                                     </h5>
                                             <div class="row" style="position: relative;left: 13%;">
                                            <table class="tb" id="mytable">
                                                  
                                                  <tr>
                                                    <td id="id1"><b>Id No</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td> <b> 1 </b> </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Joined Date</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td> <b>RCK003</b></td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Email</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b style="color:blue;">test@gmail.com</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Phone</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td><b> 9100000000 </b></td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Address</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td> <b> Your Address </b> </td>
                                                  </tr>
                                                  
                                            </table> 
                                        </div> 
                                         <br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.COMPANY.COM
									</span>
                      </div>  
                      </div>
                      
                </div>  
               
                             
            </div>    
            <div class="col-sm-1">
                
            </div>

                       
                    </div>
                  </div>
                  	@endif
                  	@if(($idcards[0]->theme)==('../public/assets/images/theme/3.jpg')) 
                   <div  class="content pb-4" >
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10 col-md-10 panel" >
                                        <h3 style="text-align:center" class="pt-3">Theme 3</h3>
                                  <div class="line">
                                       <hr>
                                  </div>
                                   <div id='id-card-x' >
                                <div class="id-card-tag"> </div>  
                                  <div class="id-card-hook"> </div>  
                      <div class="welcome-letter3" class="mt-5 d-flex" >
                       <div class="welcome-letter3-content">
                           <label for="theme"> 
                       <div style="display:block;" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"width=30%; alt="logo"><br>
  </div>
                       <!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
                       
                                        <div class="row" align="center" style="position: relative;height: 55%;margin-top:17%;margin-bottom:5%; ">
                          <div class="col-md-12" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png" width=70px; height=50px; alt="logo" class="img-fluid rounded-circle" > </div> 
                                         
                                        </div>
                                        <div class="ms-auto " >
								<input class="widgets-icons-2  ms-auto" name="theme" id='theme'
									value="../public/assets/images/theme/3.jpg" type="radio" style="position: relative;left: 50%;" checked>
							</div>
                                    <h5 align="center" style="color:black;    margin-top:-21.8%;  font-weight:800;">
                                  Ajay
                                     </h5>
                                             <div class="row" style="position: relative;left: 13%;">
                                            <table class="tb" id="mytable">
                                                  
                                                  <tr>
                                                    <td id="id1"><b>Id No</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                         1
                                                        </b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Joined Date</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>RCK003</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Email</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b style="color:blue;">test@gmail.com</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Phone</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                            9100000000
                                                        </b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Address</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                            Your Address
                                                        </b>
                                                    </td>
                                                  </tr>
                                                  
                                            </table>
                                            
                                        </div>
                                          
                                         <br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.COMPANY.COM
									</span>
                      </div>  
                      </div>
                      
                </div>  
                
                           
            </div>    
            <div class="col-sm-1">
                
            </div>

                       
                    </div>
                  </div>
                  	@else
                  	<div  class="content pb-4" >
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10 col-md-10 panel" >
                                        <h3 style="text-align:center" class="pt-3">Theme 3</h3>
                                  <div class="line">
                                       <hr>
                                  </div>
                                   <div id='id-card-x' >
                                <div class="id-card-tag"> </div>  
                                  <div class="id-card-hook"> </div>  
                      <div class="welcome-letter3" class="mt-5 d-flex" >
                       <div class="welcome-letter3-content"> 
                       <label for="theme">
                       <div style="display:block;" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"width=30%; alt="logo"><br>
  </div>
                       <!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
                       
                                        <div class="row" align="center" style="position: relative;height: 55%;margin-top:17%;margin-bottom:5%; ">
                          <div class="col-md-12" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png" width=70px; height=50px; alt="logo" class="img-fluid rounded-circle" > </div> 
                                         
                                        </div>
                                        <div class="ms-auto " >
								<input class="widgets-icons-2  ms-auto" name="theme" id='theme'
									value="../public/assets/images/theme/3.jpg" type="radio" style="position: relative;left: 50%;">
							</div>
                                    <h5 align="center" style="color:black;    margin-top:-21.8%;  font-weight:800;">
                                  Ajay
                                     </h5>
                                             <div class="row" style="position: relative;left: 13%;">
                                            <table class="tb" id="mytable">
                                                  
                                                  <tr>
                                                    <td id="id1"><b>Id No</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                         1
                                                        </b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Joined Date</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>RCK003</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Email</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b style="color:blue;">test@gmail.com</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Phone</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                            9100000000
                                                        </b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Address</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                            Your Address
                                                        </b>
                                                    </td>
                                                  </tr>
                                                  
                                            </table>
                                            
                                        </div>
                                          
                                         <br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.COMPANY.COM
									</span>
                      </div>  
                      </div>
                      
                </div>  
                
                           
            </div>    
            <div class="col-sm-1">
                
            </div>

                       
                    </div>
                  </div>
                  	@endif
                  	@if(($idcards[0]->theme)==('../public/assets/images/theme/111.jpg')) 
                  <div  class="content pb-4" >
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10 col-md-10 panel" >
                                        <h3 style="text-align:center" class="pt-3">Theme 4</h3>
                                  <div class="line">
                                       <hr>
                                  </div>
                                   <div id='id-card-x' >
                                <div class="id-card-tag"> </div>  
                                  <div class="id-card-hook"> </div>  
                      <div class="welcome-letter4" class="mt-5 d-flex" >
                       <div class="welcome-letter4-content"> 
                       <label for="them1">
                       <div style="display:block;" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"width=30%; alt="logo"><br>
  </div>
                       <!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
                       
                                        <div class="row" align="center" style="position: relative;height: 55%;margin-top:17%;margin-bottom:5%; ">
                          <div class="col-md-12" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png" width=70px; height=50px; alt="logo" class="img-fluid rounded-circle" > </div> 
                                         
                                        </div>
                                        <div class="ms-auto " >
								<input class="widgets-icons-2  ms-auto" name="theme" id='them1'
									value="../public/assets/images/theme/111.jpg" type="radio" style="position: relative;left: 50%;" checked>
							</div>
                                    <h5 align="center" style="color:black;    margin-top:-21.8%;  font-weight:800;">
                                  Ajay
                                     </h5>
                                             <div class="row" style="position: relative;left: 13%;">
                                            <table class="tb" id="mytable">
                                                  
                                                  <tr>
                                                    <td id="id1"><b>Id No</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                         1
                                                        </b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Joined Date</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>RCK003</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Email</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b style="color:blue;">test@gmail.com</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Phone</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                            9100000000
                                                        </b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Address</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                            Your Address
                                                        </b>
                                                    </td>
                                                  </tr>
                                                  
                                            </table>
                                            
                                        </div>
                                          
                                         <br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.COMPANY.COM
									</span>
                      </div>  
                      </div>
                      
                </div>  
                
                           
            </div>    
            <div class="col-sm-1">
                
            </div>

                       
                    </div>
                  </div>
                  	@else
                  	<div  class="content pb-4" >
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10 col-md-10 panel" >
                                        <h3 style="text-align:center" class="pt-3">Theme 4</h3>
                                  <div class="line">
                                       <hr>
                                  </div>
                                   <div id='id-card-x' >
                                <div class="id-card-tag"> </div>  
                                  <div class="id-card-hook"> </div>  
                      <div class="welcome-letter4" class="mt-5 d-flex" >
                       <div class="welcome-letter4-content"> 
                       <label for="them1">
                       <div style="display:block;" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"width=30%; alt="logo"><br>
  </div>
                       <!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
                       
                                        <div class="row" align="center" style="position: relative;height: 55%;margin-top:17%;margin-bottom:5%; ">
                          <div class="col-md-12" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png" width=70px; height=50px; alt="logo" class="img-fluid rounded-circle" > </div> 
                                         
                                        </div>
                                        <div class="ms-auto " >
								<input class="widgets-icons-2  ms-auto" name="theme" id='them1'
									value="../public/assets/images/theme/111.jpg" type="radio" style="position: relative;left: 50%;">
							</div>
                                    <h5 align="center" style="color:black;    margin-top:-21.8%;  font-weight:800;">
                                  Ajay
                                     </h5>
                                             <div class="row" style="position: relative;left: 13%;">
                                            <table class="tb" id="mytable">
                                                  
                                                  <tr>
                                                    <td id="id1"><b>Id No</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                         1
                                                        </b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Joined Date</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>RCK003</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Email</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b style="color:blue;">test@gmail.com</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Phone</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                            9100000000
                                                        </b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Address</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                            Your Address
                                                        </b>
                                                    </td>
                                                  </tr>
                                                  
                                            </table>
                                            
                                        </div>
                                          
                                         <br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.COMPANY.COM
									</span>
                      </div>  
                      </div>
                      
                </div>  
                
                           
            </div>    
            <div class="col-sm-1">
                
            </div>

                       
                    </div>
                  </div>
                  	@endif
                  	@if(($idcards[0]->theme)==('../public/assets/images/theme/1.jpg')) 
                  <div  class="content pb-4" >
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10 col-md-10 panel" >
                                        <h3 style="text-align:center" class="pt-3">Theme 5</h3>
                                  <div class="line">
                                       <hr>
                                  </div>
                                   <div id='id-card-x' >
                                <div class="id-card-tag"> </div>  
                                  <div class="id-card-hook"> </div>  
                      <div class="welcome-letter5" class="mt-5 d-flex" >
                       <div class="welcome-letter5-content"> 
                       <label for="the">
                       <div style="display:block;" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"width=30%; alt="logo"><br>
  </div>
                       <!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
                       
                                        <div class="row" align="center" style="position: relative;height: 55%;margin-top:17%;margin-bottom:5%; ">
                          <div class="col-md-12" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png" width=70px; height=50px; alt="logo" class="img-fluid rounded-circle" > </div> 
                                         
                                        </div>
                                        <div class="ms-auto " >
								<input class="widgets-icons-2  ms-auto" name="theme" id='the'
									value="../public/assets/images/theme/1.jpg" type="radio" style="position: relative;left: 50%;"checked>
							</div>
                                    <h5 align="center" style="color:black;    margin-top:-21.8%;  font-weight:800;">
                                  Ajay
                                     </h5>
                                             <div class="row" style="position: relative;left: 13%;">
                                            <table class="tb" id="mytable">
                                                  
                                                  <tr>
                                                    <td id="id1"><b>Id No</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                         1
                                                        </b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Joined Date</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>RCK003</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Email</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b style="color:blue;">test@gmail.com</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Phone</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                            9100000000
                                                        </b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Address</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                            Your Address
                                                        </b>
                                                    </td>
                                                  </tr>
                                                  
                                            </table>
                                            
                                        </div>
                                          
                                         <br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.COMPANY.COM
									</span>
                      </div>  
                      </div>
                      
                </div>  
                
                           
            </div>    
            <div class="col-sm-1">
                
            </div>

                       
                    </div>
                  </div>
                  	@else
                  	<div  class="content pb-4" >
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10 col-md-10 panel" >
                                        <h3 style="text-align:center" class="pt-3">Theme 5</h3>
                                  <div class="line">
                                       <hr>
                                  </div>
                                   <div id='id-card-x' >
                                <div class="id-card-tag"> </div>  
                                  <div class="id-card-hook"> </div>  
                      <div class="welcome-letter5" class="mt-5 d-flex" >
                       <div class="welcome-letter5-content"> 
                       <label for="the">
                       <div style="display:block;" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"width=30%; alt="logo"><br>
  </div>
                       <!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
                       
                                        <div class="row" align="center" style="position: relative;height: 55%;margin-top:17%;margin-bottom:5%; ">
                          <div class="col-md-12" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png" width=70px; height=50px; alt="logo" class="img-fluid rounded-circle" > </div> 
                                         
                                        </div>
                                        <div class="ms-auto " >
								<input class="widgets-icons-2  ms-auto" name="theme" id='themes1'
									value="../public/assets/images/theme/1.jpg" type="radio" style="position: relative;left: 50%;">
							</div>
                                    <h5 align="center" style="color:black;    margin-top:-21.8%;  font-weight:800;">
                                  Ajay
                                     </h5>
                                             <div class="row" style="position: relative;left: 13%;">
                                            <table class="tb" id="mytable">
                                                  
                                                  <tr>
                                                    <td id="id1"><b>Id No</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                         1
                                                        </b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Joined Date</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>RCK003</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Email</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b style="color:blue;">test@gmail.com</b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Phone</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                            9100000000
                                                        </b>
                                                    </td>
                                                  </tr>
                                                   <tr>
                                                    <td id="id1"><b>Address</b></td>
                                                    <td id="id2"><b>:</b></td>
                                                    <td>
                                                        <b>
                                                            Your Address
                                                        </b>
                                                    </td>
                                                  </tr>
                                                  
                                            </table>
                                            
                                        </div>
                                          
                                         <br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.COMPANY.COM
									</span>
                      </div>  
                      </div>
                      
                </div>  
                
                           
            </div>    
            <div class="col-sm-1">
                
            </div>

                       
                    </div>
                  </div>
                  	@endif
                 <div class="py-4" align="center">
			<button class="btn btn-primary"> <i class="fa"></i> Upload
			</button>
		</div>
                  </form>
                  
            <!--/ Scrollable -->

          </div>
        
        </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

@endsection