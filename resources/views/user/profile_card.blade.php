@extends('user.layouts.main')
@section('mains')

<style>
    html {
  box-sizing: border-box;  
}
*, *:after, *:before {
  box-sizing: inherit;
}
body {
 /*background-color: #ccc; */
}
.container {
  display: flex;
  max-width: 960px;
  margin: 20px auto;
  /*background-color: #eaeaea;*/
  background-color: #4d87b5;
  justify-content: space-between;
  box-shadow: 1px 1px 10px #e6e6e6;
}
.profile {
  flex-basis: 35%;
  /*max-width: 350px;*/
  /*background-color: #39383a;*/
   /*background-color:#5C7E99;*/
  color: #DDE1E5;
}
.profile-photo {
  /*height: 290px;*/
  /*background-image: url(https://cache3.youla.io/files/images/1284_1284_out/5a/e0/5ae099012138bb974f57d5d4.jpg);*/
  background-color:#ccc;
  background-size: cover;
  background-position: top;
  background-repeat: no-repeat; 
}

.profile-info {
  padding: 50px 30px 70px 30px; 
}
.heading {
  margin: 0;
  padding-bottom: 16px;
  text-transform: uppercase;
  font-weight: 700;
  
}
.heading-light {
  color: #fff;
  border-bottom: 2px dashed #5a5a5a;
}

.profile-text {
  font-size: 13px;
  line-height: 24.19px;
  margin-bottom: 50px;
}
.contacts {
  margin-bottom: 70px;
}
.contacts-title {
   color: #fff; 
  margin-bottom: 13px;
  font-size: 16px;
  font-weight: 400;
  
}
.contacts-text {
   color:#DDE1E5; 
   text-decoration: none;
   padding-left: 32px;
   line-height: 29.97px;
}
.contacts-item {
    border-bottom: 2px dashed #5a5a5a;
    padding-bottom: 24px;
    padding-top: 24px;
}
address {
  font-style: normal;
}
.fas {
  margin-right: 10px;
}
.languages {
  display: flex;
  flex-wrap: wrap;
  padding-top: 40px;
}
.language {
  width: 100px;
  height: 100px;
  border: 6px solid #5a5a5a;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  margin-bottom: 30px;
  margin-right: 30px;
}
.language:nth-child(3) {
  margin-bottom: 0;  
}
.language-text {
  text-transform: uppercase;
  font-size: 11px;
  margin-bottom: 8px;
}
.language-per {
  font-size: 15px;
  font-weight: 600;
}
.lines {
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.line {
  display: block;
  width: 90px;
  height: 2px;
  background-color: #5a5a5a;
  margin-top: 10px;
  margin-bottom: 10px;
}
.line:nth-child(2) {
  width: 100px;
  margin-left: 15px;
}
.resume {
  color: #39383a;
  
  padding: 20px 30px;
  flex-basis: 63%;
  background-color: #fff;
}
.resume-wrap {
 border: 1px solid #eaeaea;
 padding: 35px 56px;
 min-height: 100%; 
}
.logo {
  display: flex;
  justify-content: center;
  margin-bottom: 38px;
}
.logo-img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 1px solid #39383a;
  display: flex;
  justify-content: center;
  align-items: center;
  text-transform: uppercase;
  font-size: 18px; 
  letter-spacing: -2px;
}

.logo-lines {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  margin-left: 17px;
  margin-right: 17px;
}
.logo-lines-left {}
.logo-lines-right {}
.logo-line {
  display: block;
  width: 43px;
  height: 2px;
  background-color: #39383a;
  margin-top: 10px;
  margin-bottom: 10px;
}
.logo-lines_left .logo-line:nth-child(2) {
  margin-right: 20px;
  width: 55px;
}
.logo-lines_right .logo-line:nth-child(2) {
  margin-left: 20px;
  width: 55px;
}
.about {
  text-align: center;
  border-bottom: 2px dashed #ededed;
  padding-bottom: 30px;
  margin-bottom: 30px;
}
.name {
  text-transform: uppercase;
  font-size: 16px;
  letter-spacing: 10px;
  margin-bottom: 10px;
}
.position {
  text-transform: uppercase;
  font-size: 9px;
  color: #808080;
  margin-bottom: 30px;

}
.about-address {
   font-size: 13px; 
   margin-bottom: 15px;
   font-family: 'Roboto';
}
.about-contacts a {
   font-size: 10px;
   color: #777777; 
   text-decoration: none;
}

.heading_dark {
   font-size: 16px;  
   font-weight: 400;
   border-bottom: 2px dashed #ededed;
   padding-bottom: 30px;
   margin-bottom: 37px;
}
.list {
  list-style: none;
  padding-left: 0;
}
.list-item {
  position: relative;
  padding-left: 40px;
  padding-bottom: 30px;
  margin-bottom: 30px;
  border-bottom: 2px dashed #ededed;
}
.list-item:before {
  content:'';
  position: absolute;
  left: 0;
  top: 3px;
  width: 9px;
  height: 9px;
  border-radius: 50%;
  background-color: #000;
}

.list-item__title {
  font-size: 11px;
  text-transform: uppercase;
}
.list-item__date {
  font-size: 10px;
  text-transform: uppercase;
  margin-bottom: 5px;
}
.list-item__text {
   font-size: 10px;
  color: #777;
}
.list-item_non_border {
  border: none;
}
.skills-list {
  list-style: none;
  padding-left: 0;
}
.skills-list__item {
  margin-bottom: 30px;
  text-transform: uppercase;
  font-size: 11px;
  display: flex;
  justify-content: space-between;
}
.level {
  width: 70%;
  height: 8px;
  border: 1px solid #39383a;
  position: relative;
}
.level:before {
  content:'';
  position: absolute;
  height: 100%;
  background-color: #898989;
}
.level-75:before {
  width: 75%;
}
.level-62:before {
  width: 62%;
}
.level-82:before {
  width: 82%;
}

@media (max-width: 1024px) {
  .container {
    width: 90%;
}
}
@media (max-width: 992px) {
.container {
  flex-direction: column;
  width: 70%;
   }

  .profile {
    position: relative;    
  }
  .profile:before {
    content: '';
    position: absolute;
    display: block;
    /*background-color: #024fff;*/
    width: 100%;
    /*height: 145px;*/
  }
  .profile-photo {
   width: 200px;
   margin:auto;
   height: 20px;
  border: 3px solid #ccc;
  margin: auto;
  margin-top: 40px;
  position: relative;
  z-index: 10;
  }
  .lines {
    display: none;
  } 
}
@media (max-width: 768px) {
  .container {
    width: 80%;
}
  .resume {
    padding: 10px;
  }
  .resume-wrap {
    padding-left: 20px;
    padding-right: 20px;
  }
  .list-item__title {
    font-size: 14px;
  } 
    .list-item__title {
    font-date: 12px;
  } 
    .list-item__text {
    font-size: 12px;
      line-height: 1.4;
  } 
  .about-contacts {
    font-size: 12px;    
  }
}

@media (max-width: 567px) {
  .logo-img {
    width: 70px;
    height: 70px;
  }
  .logo-lines {
    margin-left: 0px;
    margin-right: 0px;
  }
}
@media (max-width: 480px) {
  .logo {
    display: none;
  }
  .container {
    min-width: 320px;
  }
  .name {
    letter-spacing: normal;
  }
  .level {
   width: 50px; 
  }
}
</style>
	@php
    $userid= Auth::user()->userid;
    $detail = DB::table('user')->where('userid',$userid)->get();
   $rank=DB::table('rank_achivers')->where('userid',$userid)->orderBy('id', 'DESC')->get();
    $business_setup=DB::table('business_setup')->first();
    @endphp
     
    <!--start page wrapper -->
   <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">User Profile</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">User Profile</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
				
				<div class="container">
				    
  <div class="profile">
      
      
    <div class="profile-photo"></div>
    <div class="profile-info">
    <h2 class="heading heading-light">Profile</h2>
        <p class="profile-text">
    </p>
      <div class="contacts">
        <div class="contacts-item">
          <h3 class="contacts-title">
            <i class="lni lni-phone"></i>
            Phone
          </h3>
          <a  class="contacts-text">{{Auth::user()->contact}}</a>
        </div>
        <div class="contacts-item">
          <h3 class="contacts-title">
            <i class="lni lni-envelope"></i>
            Email
          </h3>
          <a href="https://mail.google.com/" class="contacts-text">{{Auth::user()->email}}</a>
        </div>
        
        {{--
        <div class="contacts-item">
          <h3 class="contacts-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe "><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
            Web
          </h3>
          <a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/" class="contacts-text"><?php echo "www.". $_SERVER['SERVER_NAME']; ?></a>
        </div>
        
        --}}
        
        <div class="contacts-item">
          <h3 class="contacts-title">
            <i class="fadeIn animated bx bx-current-location"></i>
            Address
          </h3>
          <address class="contacts-text">
          {{Auth::user()->address}},{{Auth::user()->state}},{{Auth::user()->country}}</address>
       </div>
      </div>
      <h5  class="heading heading-light">Referal Link</h5>
      <div class="languages"> 
      <!--  <div class="language">-->
      <!--    <span class="language-text">English</span>-->
      <!--    <strong class="language-per">100%</strong>-->
      <!--</div>-->
      <!--<div class="language">-->
      <!--  <span class="language-text">French</span>-->
      <!--  <strong class="language-per">90%</strong>-->
      <!--</div>-->
      <!--<div class="language">-->
      <!--  <span class="language-text">Greak</span>-->
      <!--  <strong class="language-per">80%</strong>-->
      <!--</div>-->
      
      
      <span id="pwd_spn" class="password-span" style="margin-right:2px; color:white;"><?php echo $_SERVER['SERVER_NAME']; ?>/register?referal=<?php echo $userid; ?></span> 
	<a href="javascript:void(0)" id="cp_btn" class="btn btn-primary mt-4">Copy Referal Link<i class='lni lni-link'></i></a>
											
    
       <div class="lines">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
        </div> 
      </div>
     </div> 
   </div> 
  <div class="resume">
     
   <div class="resume-wrap">
       
       
     <div class="logo">
       <div class="logo-lines logo-lines_left">
         <span class="logo-line"></span>
         <span class="logo-line"></span>
         <span class="logo-line"></span>
       </div>
       <div class="logo-img">
  <img style="border-radius:22px" src="{{ Storage::url('app/profileupload/') . Auth::user()->image }}" alt="Admin" width="70" height="auto">
</div>
<div class="logo-lines logo-lines_right">
  <span class="logo-line"></span>
  <span class="logo-line"></span>
  <span class="logo-line"></span>
</div>

       <!--<div class="logo-img">-->
       <!--   <img src="{{ Storage::url('app/profileupload/').Auth::user()->image}}" alt="Admin" width="110">-->
         
       <!--    </div>-->
       <!--<div class="logo-lines logo-lines_right">-->
       <!--  <span class="logo-line"></span>-->
       <!--  <span class="logo-line"></span>-->
       <!--  <span class="logo-line"></span>-->
       <!--</div>-->
     </div> 
     <div class="about">
       <h1 class="name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h1>
       <p class="position">Team Member at @php echo $business_setup->business_name;  @endphp </p>
        <address  class="about-address">{{Auth::user()->address}}|{{Auth::user()->state}}|{{Auth::user()->country}}</address>
        {{--
         <div class="about-contacts">
           <a href="" class=""><b>t : {{Auth::user()->contact}}</b></a> |
           <a href="" class=""><b>e : {{Auth::user()->email}}</b></a> |
           <a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/" class=""><b>w : <?php echo $_SERVER['SERVER_NAME']; ?></b></a> |
         </div>
         --}}
      </div>
    @if(!empty($rank[0]->rank_name))
      <marquee>
          <p style="font-style:italic;">Congratulation {{Auth::user()->first_name}}!! <b>You have achieved {{$rank[0]->rank_name}} </b></p>
      </marquee>
     @endif
    <!-- <div class="experience">-->
    <!--   <h2 class="heading heading_dark">Experience</h2>-->
    <!--   <ul class="list">-->
    <!--     <li class="list-item">-->
    <!--       <h4 class="list-item__title">Hexogan Web Development Company</h4>-->
    <!--       <p class="list-item__date">Jan 2016 - 0ct 2016</p>-->
    <!--       <p class="list-item__text">Fleeing from the Cylon tyranny the last Battlestar – Galactica -  leads a rag-tag fugitive fleet on a lonely quest - a shining planet known as Earth? -->
    <!--         Texas tea.</p>-->
    <!--     </li>-->
    <!--     <li class="list-item">-->
    <!--       <h4 class="list-item__title">Budnet Web Designing & Development</h4>-->
    <!--       <p class="list-item__date">Oct 2016 - Aug 2017</p>-->
    <!--       <p class="list-item__text">Fleeing from the Cylon tyranny the last Battlestar – Galactica -              leads a rag-tag fugitive fleet on a lonely quest - a shining planet known as Earth?-->
    <!--         Texas tea.</p>-->
    <!--     </li>-->
    <!--     <li class="list-item">-->
    <!--       <h4 class="list-item__title">HashWeb Web Designing & Development</h4>-->
    <!--       <p class="list-item__date">Aug 2017 - Present</p>-->
    <!--       <p class="list-item__text">Fleeing from the Cylon tyranny the last Battlestar – Galactica -              leads a rag-tag fugitive fleet on a lonely quest - a shining planet known as Earth?-->
    <!--         Texas tea.</p>-->
    <!--     </li>         -->
    <!--   </ul>-->
    <!-- </div>-->
     
    <!--      <div class="education">-->
    <!--   <h2 class="heading heading_dark">Education</h2>-->
    <!--   <ul class="list">-->
    <!--     <li class="list-item list-item_non_border">-->
    <!--       <h4 class="list-item__title">Bachelords of Art and Creative School</h4>-->
    <!--       <p class="list-item__date">Jan 2014 - 0ct 2015</p>-->
    <!--       <p class="list-item__text">Fleeing from the Cylon tyranny the last Battlestar – Galactica -            leads a rag-tag fugitive fleet on a lonely quest - a shining planet known as Earth? -->
    <!--         Texas tea.</p>-->
    <!--   </ul>-->
    <!-- </div>-->
    <!-- <div class="skills">-->
    <!--   <h2 class="heading heading_dark">Skills</h2>-->
    <!--<ul class="skills-list">-->
    <!--  <li class="skills-list__item">Wordpress-->
    <!--  <div class="level level-75"></div></li>-->
    <!--  <li class="skills-list__item">HTML-->
    <!--  <div class="level level-62"></div></li>-->
    <!--  <li class="skills-list__item">PhotoShop-->
    <!--  <div class="level level-82"></div></li>-->
    <!--   </ul>-->

    <!--   </ul>-->
    <!-- </div>-->
     
     
     </div>
     
    </div>
  </div>
</div>
		<script>
      document.getElementById("cp_btn").addEventListener("click", copy_password);

    function copy_password() {
        var copyText = document.getElementById("pwd_spn");
        var textArea = document.createElement("textarea");
        textArea.value = copyText.textContent;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("Copy");
        textArea.remove();
         $('#copy_refreal').removeClass('hidden');
    $('#copy_refreal').addClass('show');
    setTimeout(function(){
        $('#copy_refreal').removeClass('show');
        $('#copy_refreal').addClass('hidden');
   
  },2000)
    }
  </script>		
	
@endsection
