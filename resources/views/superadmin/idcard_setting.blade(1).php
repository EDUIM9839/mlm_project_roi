@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')

<style>
	.company-name {
		font-family: Impact, Arial;
		font-stretch: ultra-condensed;
		text-transform: uppercase;
		font-size: 1.rem;
	}

	.website-footer {
		display: block;
		text-transform: uppercase;
		font-weight: bold;
		font-size: 0.8rem;
		padding-top: 0.6rem;
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
		background-color: #4d4f4e;
		width: 70px;
		margin: 0 auto;
		height: 15px;
		border-radius: 5px 5px 0 0;
	}

	.id-card-hook:after {
		content: '';
		background-color: #d7d6d3;
		width: 47px;
		height: 6px;
		display: block;
		margin: 0px auto;
		position: relative;
		top: 6px;
		border-radius: 4px;
	}

	.panel {
		background-color: #f6f6f6;
		padding-right: 16%;
		position: relative;
		padding-left: 16%;
		border-radius: 10px;
	}

	#user-img {
		object-fit: fill;
		height: 5rem;
		width: 5rem;
		border: 2px solid orange;
	}

	.welcome-letter {
		border: 2px solid #4d4f4e;
		margin: auto;
		position: relative;
		min-height: 400px;
		width: 300px;
		background-image:url('../public/assets/images/theme/8.jpg' );
		background-repeat: no-repeat;
		background-size: 100% 100%;
		padding-right: 35px;
		padding-left: 35px;
		border-radius: 15px;
	}
	.welcome-letters {
		border: 2px solid #4d4f4e;
		margin: auto;
		position: relative;
		min-height: 400px;
		width: 300px;
		background-image:url('../public/assets/images/theme/2.png' );
		background-repeat: no-repeat;
		background-size: 100% 100%;
		padding-right: 35px;
		padding-left: 35px;
		border-radius: 15px;
	}
	.welcome{
		border: 2px solid #4d4f4e;
		margin: auto;
		position: relative;
		min-height: 400px;
		width: 300px;
		background-image:url('../public/assets/images/theme/3.jpg' );
		background-repeat: no-repeat;
		background-size: 100% 100%;
		padding-right: 35px;
		padding-left: 35px;
		border-radius: 15px;
	}
	.letter {
		border: 2px solid #4d4f4e;
		margin: auto;
		position: relative;
		min-height: 400px;
		width: 300px;
		background-image:url('../public/assets/images/theme/1.jpg' );
		background-repeat: no-repeat;
		background-size: 100% 100%;
		padding-right: 35px;
		padding-left: 35px;
		border-radius: 15px;
	}

	.welcome-letter-content {
		text-align: justify;
		top: 7%;
		width: 100%;
		left: 0;
		padding-left: 16px;
		padding-right: 16px;
		font-size: 0.7rem;
		position: absolute;
		
	}

	.font-set {
		font-size: 0.7rem;
		text-align: justify;
	}

	@media only screen and (max-width:919px) {
		#welcome-letter-content {
			font-size: 0.7rem;
		}
	}

	.font-set {
		font-size: 0.7rem;
	}

	@media only screen and (max-width:873px) {
		#welcome-letter-content {
			font-size: 0.7rem;
		}

		.font-set {
			font-size: 0.7rem;
		}
	}

	@media only screen and (max-width:676px) {
		.company-name {
			font-family: Arial;
			font-stretch: ultra-condensed;
			text-transform: uppercase;
			font-size: 1.06rem;
			font-weight: 900;
		}

		#welcome-letter-content {
			font-size: 0.7rem;
		}

		.font-set {
			font-size: 0.7rem;
		}

		.panel {
			background-color: #f6f6f6;
			padding-right: 0%;
			position: relative;
			padding-left: 0%;
			border-radius: 10px;
		}

		#welcome-letter {
			width: 100%;
		}
	}

	@media only screen and (max-width:389px) {
		.panel {
			background-color: #f6f6f6;
			padding-right: 0%;
			position: relative;
			padding-left: 0%;
			border-radius: 10px;
		}

		#welcome-letter {
			width: 100%;
		}

		#welcome-letter-content {
			font-size: 0.7rem;
		}

		.font-set {
			font-size: 0.7rem;
		}
	}

	@media only screen and (max-width:328px) {
		#welcome-letter-content {
			font-size: 0.7rem;
		}

		.font-set {
			font-size: 0.7rem;
		}

		.panel {
			background-color: #f6f6f6;
			padding-right: 0%;
			position: relative;
			padding-left: 0%;
			border-radius: 10px;
		}

		#welcome-letter {
			width: 100%;
		}
	}

	.sticky {
		position: sticky;
		top: 80px;
	}
	@media only screen and (max-width:676px) {
	.widgets-icons-2 {
    position: absolute;top: 50px;right:20px;margin-right:15px;
}
}

/*@media only screen and (min-width: 480px){*/
/*    	.widgets-icons-2 {*/
/*    position: absolute;top: 50px;right:20px;margin-right:15px;*/
/*}*/
/*}*/
	@media only screen and (max-width:676px) {
		.welcome-letter {
		margin-left:50px;
		}
	}
		@media only screen and (max-width:676px) {
		.welcome-letters {
		margin-left:50px;
		}
		}
		@media only screen and (max-width:676px) {
		.welcome {
		margin-left:50px;
		}
		}
		@media only screen and (max-width:676px) {
		.letter {
		margin-left:50px;
		}
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
						<li class="breadcrumb-item active" aria-current="page">Id Card Theme</li>
					</ol>
				</nav>
			</div>
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
					<div class=" ">
						<div class="font-20 text-white"><i class='bx bxs-message-square-x'
								style='display:contents; !important'></i><span
								style='font-size:16px;'>&nbsp;{!!session()->get('error')!!}</span>
						</div>
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div> @endif
		<!--end breadcrumb-->
		<!-- Scrollable -->
		<form action="{{route('idcard_setting_save')}}" method="post" enctype="multipart/form-data">
					@csrf
						@if(($idcards[0]->theme)==('../public/assets/images/theme/8.jpg'))
		<div class="card-body">
			<div class="content pb-4">
				<div class="row g-3">
					<div class="col-sm-1"></div>
					<div class="col-sm-10 col-md-10 panel">
						<h3 style="text-align:center" class="pt-3">Theme 1 </h3>
						<div class="line">
							<hr>
						</div>
								
						<div id='id-card-x'> 
							<div class="id-card-tag"> </div>
							<div class="id-card-hook"> </div>
						 <label for="themes" class="d-flex">
							<div   class="welcome-letter" class="mt-5 d-flex">
							    <div class="welcome-letter-content">
							         </label>
									<div style="display:block;" align="center"><img
											src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"
											width=100px; alt="logo"><br>
									</div>
									<!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
									<div class="row" style="margin-top:21px;" align="center">
										.
										<div class="col-md-12" align="center"><img
												src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png"
												width=70px; height=50px; alt="logo" class="img-fluid rounded-circle">
										</div>
									</div>
									<h5 align="center" style="color:black;   margin-top:0.2%; font-weight:800;">
									    SWAS Softech
									</h5>
									<h6 align="center"
										style="color:red;  margin:2%; text-decoration:underline;  font-weight:400;">ID-RCK003
									</h6>
									<div class="row">
										<div class="col-12" align="center"> Email : test@gmail.com &nbsp;&nbsp;
											<b style="color:blue;"></b>
										</div>
										<div class="col-12 py-1" align="center">Date of Joining :  16-Jan-2024 &nbsp;&nbsp;
											<b>
											</b>
										</div>
										<div class="col-12 py-1" align="center">Intro. Name :  Admin Chaturvedi
											<b style="color:green; font-size:15px;">

											</b>
										</div>
									</div><br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.NEPTUNE99CURE.COM
									</span>
								</div>
								</div><br>
							<div class="d-flex" style="position: absolute;top: 300px;right:20px;margin-right:260px;" class="widgets-icons-2 rounded-circle  ms-auto ">
								<input class="widgets-icons-2  ms-auto" name="theme" id='themes1'
									value="../public/assets/images/theme/8.jpg" type="radio">
							</div>
						
						</div>
						<hr class="my-3" style="height:5px;">
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div>
		</div>
		@else
		<div class="card-body">
			<div class="content pb-4">
				<div class="row g-3">
					<div class="col-sm-1"></div>
					<div class="col-sm-10 col-md-10 panel">
						<h3 style="text-align:center" class="pt-3">Theme 1 </h3>
						<div class="line">
							<hr>
						</div>
							
						<div id='id-card-x'>
						    	 
							<div class="id-card-tag"> </div>
							<div class="id-card-hook"> </div>
							  <label for="themes1" class=" d-flex">
							<div class="welcome-letter" class="mt-5 d-flex">
								<div   class="welcome-letter-content">
								    </label>	 
									<div style="display:block;" align="center"><img
											src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"
											width=100px; alt="logo"><br>
									</div>
									<!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
									<div class="row" style="margin-top:21px;" align="center">
										.
										<div class="col-md-12" align="center"><img
												src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png"
												width=70px; height=50px; alt="logo" class="img-fluid rounded-circle">
										</div>
									</div>
									<h5 align="center" style="color:black;   margin-top:0.2%; font-weight:800;">
									    SWAS Softech
									</h5>
									<h6 align="center"
										style="color:red;  margin:2%; text-decoration:underline;  font-weight:400;">ID-RCK003
									</h6>
									<div class="row">
										<div class="col-12" align="center"> Email : test@gmail.com &nbsp;&nbsp;
											<b style="color:blue;"></b>
										</div>
										<div class="col-12 py-1" align="center">Date of Joining :  16-Jan-2024 &nbsp;&nbsp;
											<b>
											</b>
										</div>
										<div class="col-12 py-1" align="center">Intro. Name :  Admin Chaturvedi
											<b style="color:green; font-size:15px;">

											</b>
										</div>
									</div><br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.NEPTUNE99CURE.COM
									</span>
								</div>
							 	</div><br>
							 	<div class="d-flex" style="position: absolute;top: 300px;right:20px;margin-right:260px;" class="widgets-icons-2 rounded-circle  ms-auto ">
								<input class="widgets-icons-2  ms-auto" name="theme" id='themes1'
									value="../public/assets/images/theme/8.jpg" type="radio">
							</div>
						
						
						</div>
						<hr class="my-3" style="height:5px;">
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div>
		</div>
		@endif
	@if(($idcards[0]->theme)==('../public/assets/images/theme/2.jpg')) 
		<div class="content pb-4">
			<div class="row g-3">
				<div class="col-sm-1"></div>
				<div class="col-sm-10 col-md-10 panel">
					<h3 style="text-align:center" class="pt-3">Theme 2</h3>
					<div class="line">
						<hr>
					</div>
				
					<div id='id-card-x'>
						<div class="id-card-tag"> </div>
						<div class="id-card-hook"> </div>
						<label for="parul" class="d-flex">
						<div   class="welcome-letters" class="mt-5 d-flex">
							<div class="welcome-letter-content">
							    </label>
								<div style="display:block;" align="center"><img
										src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"
										width=100px; alt="logo"><br>
								</div>
								<!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
								<div class="row" style="margin-top:21px;" align="center">
									.
									<div class="col-md-12" align="center"><img
											src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png"
											width=70px; height=50px; alt="logo" class="img-fluid rounded-circle"> </div>
								</div>
								<h5 align="center" style="color:black;   margin-top:0.2%; font-weight:800;">
									    SWAS Softech
									</h5>
									<h6 align="center"
										style="color:red;  margin:2%; text-decoration:underline;  font-weight:400;">ID-RCK003
									</h6>
									<div class="row">
										<div class="col-12" align="center"> Email : test@gmail.com &nbsp;&nbsp;
											<b style="color:blue;"></b>
										</div>
										<div class="col-12 py-1" align="center">Date of Joining :  16-Jan-2024 &nbsp;&nbsp;
											<b>
											</b>
										</div>
										<div class="col-12 py-1" align="center">Intro. Name :  Admin Chaturvedi
											<b style="color:green; font-size:15px;">

											</b>
										</div>
									</div><br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.NEPTUNE99CURE.COM
									</span>
							</div>
						
						</div><br>
							<div class="d-flex" style="position: absolute;top: 300px;right:20px;margin-right:260px;" class="widgets-icons-2 rounded-circle  ms-auto ">
								<input  class="widgets-icons-2  ms-auto" name="theme" id='parul'
									value="../public/assets/images/theme/2.jpg" type="radio" checked>
									</div> 
					</div>
					<hr class="my-3" style="height:5px;">
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
		@else
		
		<div class="content pb-4">
			<div class="row g-3">
				<div class="col-sm-1"></div>
				<div class="col-sm-10 col-md-10 panel">
					<h3 style="text-align:center" class="pt-3">Theme 2</h3>
					<div class="line">
						<hr>
					</div>
				
					<div id='id-card-x'>
						<div class="id-card-tag"> </div>
						<div class="id-card-hook"> </div>
						<label for="the" class=" d-flex">
						<div  class="welcome-letters" class="mt-5 d-flex">
							<div class="welcome-letter-content">
							    </label>
								<div style="display:block;" align="center"><img
										src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"
										width=100px; alt="logo"><br>
								</div>
								<!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
								<div class="row" style="margin-top:21px;" align="center">
									.
									<div class="col-md-12" align="center"><img
											src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png"
											width=70px; height=50px; alt="logo" class="img-fluid rounded-circle"> </div>
								</div>
								<h5 align="center" style="color:black;   margin-top:0.2%; font-weight:800;">
									    SWAS Softech
									</h5>
									<h6 align="center"
										style="color:red;  margin:2%; text-decoration:underline;  font-weight:400;">ID-RCK003
									</h6>
									<div class="row">
										<div class="col-12" align="center"> Email : test@gmail.com &nbsp;&nbsp;
											<b style="color:blue;"></b>
										</div>
										<div class="col-12 py-1" align="center">Date of Joining :  16-Jan-2024 &nbsp;&nbsp;
											<b>
											</b>
										</div>
										<div class="col-12 py-1" align="center">Intro. Name :  Admin Chaturvedi
											<b style="color:green; font-size:15px;">

											</b>
										</div>
									</div><br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.NEPTUNE99CURE.COM
									</span>
							</div>
						
							</div><br>
							<div class="d-flex" style="position: absolute;top: 300px;right:20px;margin-right:260px;" class="widgets-icons-2 rounded-circle  ms-auto ">
								<input   class="widgets-icons-2  ms-auto" name="theme" id='the'
									value="../public/assets/images/theme/2.jpg" type="radio">
								
							</div> 
					</div>
					<hr class="my-3" style="height:5px;">
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
		@endif
	@if(($idcards[0]->theme)==('../public/assets/images/theme/3.jpg')) 
		
		<div class="content pb-4">
			<div class="row g-3">
				<div class="col-sm-1"></div>
				<div class="col-sm-10 col-md-10 panel">
					<h3 style="text-align:center" class="pt-3">Theme 3</h3>
					<div class="line">
						<hr>
					</div>
					
					<div id='id-card-x'>
						<div class="id-card-tag"> </div>
						<div class="id-card-hook"> </div>
						<label for="hello" class=" d-flex">
						<div   class="welcome" class="mt-5 d-flex">
							<div class="welcome-letter-content">
							    </label>
								<div style="display:block;" align="center"><img
										src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"
										width=100px; alt="logo"><br>
								</div>
								<!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
								<div class="row" style="margin-top:21px;" align="center">
									.
									<div class="col-md-12" align="center"><img
											src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png"
											width=70px; height=50px; alt="logo" class="img-fluid rounded-circle"> </div>
								</div>
								<h5 align="center" style="color:black;   margin-top:0.2%; font-weight:800;">
									    SWAS Softech
									</h5>
									<h6 align="center"
										style="color:red;  margin:2%; text-decoration:underline;  font-weight:400;">ID-RCK003
									</h6>
									<div class="row">
										<div class="col-12" align="center"> Email : test@gmail.com &nbsp;&nbsp;
											<b style="color:blue;"></b>
										</div>
										<div class="col-12 py-1" align="center">Date of Joining :  16-Jan-2024 &nbsp;&nbsp;
											<b>
											</b>
										</div>
										<div class="col-12 py-1" align="center">Intro. Name :  Admin Chaturvedi
											<b style="color:green; font-size:15px;">

											</b>
										</div>
									</div><br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.NEPTUNE99CURE.COM
									</span>
							</div>
						</div><br>
						
						<div class="d-flex" style="position: absolute;top: 300px;right:20px;margin-right:260px;" class="widgets-icons-2 rounded-circle  ms-auto ">
								<input  class="widgets-icons-2  ms-auto" name="theme" id='hello'
									value="../public/assets/images/theme/3.jpg" type="radio" checked>
							</div>
						 
					</div>
					<hr class="my-3" style="height:5px;">
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
		@else
		
		<div class="content pb-4">
			<div class="row g-3">
				<div class="col-sm-1"></div>
				<div class="col-sm-10 col-md-10 panel">
					<h3 style="text-align:center" class="pt-3">Theme 3</h3>
					<div class="line">
						<hr>
					</div>
					
					<div id='id-card-x'>
						<div class="id-card-tag"> </div>
						<div class="id-card-hook"> </div>
						<label for="hi" class=" d-flex">
						<div   class="welcome" class="mt-5 d-flex">
							<div class="welcome-letter-content">
							    </label>
								<div style="display:block;" align="center"><img
										src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"
										width=100px; alt="logo"><br>
								</div>
								<!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
								<div class="row" style="margin-top:21px;" align="center">
									.
									<div class="col-md-12" align="center"><img
											src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png"
											width=70px; height=50px; alt="logo" class="img-fluid rounded-circle"> </div>
								</div>
								<h5 align="center" style="color:black;   margin-top:0.2%; font-weight:800;">
									    SWAS Softech
									</h5>
									<h6 align="center"
										style="color:red;  margin:2%; text-decoration:underline;  font-weight:400;">ID-RCK003
									</h6>
									<div class="row">
										<div class="col-12" align="center"> Email : test@gmail.com &nbsp;&nbsp;
											<b style="color:blue;"></b>
										</div>
										<div class="col-12 py-1" align="center">Date of Joining :  16-Jan-2024 &nbsp;&nbsp;
											<b>
											</b>
										</div>
										<div class="col-12 py-1" align="center">Intro. Name :  Admin Chaturvedi
											<b style="color:green; font-size:15px;">

											</b>
										</div>
									</div><br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.NEPTUNE99CURE.COM
									</span>
							</div>
						</div><br>
					
						<div class="d-flex" style="position: absolute;top: 300px;right:20px;margin-right:260px;" class="widgets-icons-2 rounded-circle  ms-auto ">
								<input  class="widgets-icons-2  ms-auto" name="theme" id='hi'
									value="../public/assets/images/theme/3.jpg" type="radio" >
							</div>
								 
					</div>
					<hr class="my-3" style="height:5px;">
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
		@endif
	@if(($idcards[0]->theme)==('../public/assets/images/theme/1.jpg')) 
		
		<div class="content pb-4">
			<div class="row g-3">
				<div class="col-sm-1"></div>
				<div class="col-sm-10 col-md-10 panel">
					<h3 style="text-align:center" class="pt-3">Theme 4</h3>
					<div class="line">
						<hr>
					</div>
				
					<div id='id-card-x'>
						<div class="id-card-tag"> </div>
						<div class="id-card-hook"> </div>
						<label for="card" class=" d-flex">
						<div   class="letter" class="mt-5 d-flex">
							<div class="welcome-letter-content">
							    </label>
								<div style="display:block;" align="center"><img
										src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"
										width=100px; alt="logo"><br>
								</div>
								<!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
								<div class="row" style="margin-top:21px;" align="center">
									.
									<div class="col-md-12" align="center"><img
											src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png"
											width=70px; height=50px; alt="logo" class="img-fluid rounded-circle"> </div>
								</div>
								<h5 align="center" style="color:black;   margin-top:0.2%; font-weight:800;">
									    SWAS Softech
									</h5>
									<h6 align="center"
										style="color:red;  margin:2%; text-decoration:underline;  font-weight:400;">ID-RCK003
									</h6>
									<div class="row">
										<div class="col-12" align="center"> Email : test@gmail.com &nbsp;&nbsp;
											<b style="color:blue;"></b>
										</div>
										<div class="col-12 py-1" align="center">Date of Joining :  16-Jan-2024 &nbsp;&nbsp;
											<b>
											</b>
										</div>
										<div class="col-12 py-1" align="center">Intro. Name :  Admin Chaturvedi
											<b style="color:green; font-size:15px;">

											</b>
										</div>
									</div><br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.NEPTUNE99CURE.COM
									</span>
							</div>
						</div><br>
					
							<div class="d-flex" style="position: absolute;top: 300px;right:20px;margin-right:260px;" class="widgets-icons-2 rounded-circle  ms-auto ">
								<input  class="widgets-icons-2  ms-auto" name="theme" id='card'
									value="../public/assets/images/theme/1.jpg" type="radio" checked >
							</div>
								 
					</div>
					<hr class="my-3" style="height:5px;">
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
		@else
		
		<div class="content pb-4">
			<div class="row g-3">
				<div class="col-sm-1"></div>
				<div class="col-sm-10 col-md-10 panel">
					<h3 style="text-align:center" class="pt-3">Theme 4</h3>
					<div class="line">
						<hr>
					</div>
					
					<div id='id-card-x'>
						<div class="id-card-tag"> </div>
						<div class="id-card-hook"> </div>
						<label for="letter" class=" d-flex">
						<div   class="letter" class="mt-5 d-flex">
							<div class="welcome-letter-content">
							    </label>
								<div style="display:block;" align="center"><img
										src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"
										width=100px; alt="logo"><br>
								</div>
								<!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
								<div class="row" style="margin-top:21px;" align="center">
									.
									<div class="col-md-12" align="center"><img
											src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png"
											width=70px; height=50px; alt="logo" class="img-fluid rounded-circle"> </div>
								</div>
								<h5 align="center" style="color:black;   margin-top:0.2%; font-weight:800;">
									    SWAS Softech
									</h5>
									<h6 align="center"
										style="color:red;  margin:2%; text-decoration:underline;  font-weight:400;">ID-RCK003
									</h6>
									<div class="row">
										<div class="col-12" align="center"> Email : test@gmail.com &nbsp;&nbsp;
											<b style="color:blue;"></b>
										</div>
										<div class="col-12 py-1" align="center">Date of Joining :  16-Jan-2024 &nbsp;&nbsp;
											<b>
											</b>
										</div>
										<div class="col-12 py-1" align="center">Intro. Name :  Admin Chaturvedi
											<b style="color:green; font-size:15px;">

											</b>
										</div>
									</div><br>
									<span class="sticky website-footer" align="center" ;>
                                                WWW.NEPTUNE99CURE.COM
									</span>
							</div>
						</div><br>
						
						<div class="d-flex" style="position: absolute;top: 300px;right:20px;margin-right:260px;" class="widgets-icons-2 rounded-circle  ms-auto ">
								<input  class="widgets-icons-2  ms-auto" name="theme" id='letter'
									value="../public/assets/images/theme/1.jpg" type="radio" >
							</div>
							 
					</div>
					<hr class="my-3" style="height:5px;">
				</div>
				<div class="col-sm-1"></div>
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

@endsection