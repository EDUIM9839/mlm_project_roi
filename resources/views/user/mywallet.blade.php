                    @extends('user.layouts.main')
@section('mains')

<style>
    font-size:80px;
    .fa ,.fas{
        font-family:"Font Awesome 5 free"!important;
        font-weight:900px!important;
           -webkit-font-smoothing: antialiased!important;
    display: inline-block!important;
    font-style: normal!important;
    font-variant: normal!important;
    text-rendering: auto!important;
    line-height: 1!important;
    }
    
    .fa-wallet:before {
    content: "";
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
                            <li class="breadcrumb-item active" aria-current="page">My Wallet History</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            
            <!--end breadcrumb-->
              
  <br><br><br>
              <!-- Content wrapper -->
        <div class="content-wrapper">

          <!-- Content -->
          <section id="services" class="services d-flex align-items-center"  style="height:100%;">

      <div class="container" data-aos="fade-up">
 

        <div class="row"  >

           
<div class="col-md-8 mb-4 order-0 offset-md-2 ">
                <div class="card rainbow" data-aos="fade-up" data-aos-delay="200">
                  <div class="d-flex align-items-center justify-content-center row service-box blue pink">

                   
                   
                   <div class="col-sm-3 pack-achieve-card2"   >
                      <i class="bx bx-wallet" style="font-size:80px;"></i>
                       
                    </div>
                   
                   @php
                   $withdrawl_amount = Auth::user()->withdrawl_wallet;
                   @endphp
                    <div class="col-sm-6 mb-2 pack-achieve-card" style="padding-top:23px; padding-bottom:5px;">
                      <center>

                        <h1 style="font-size:55px;"><a style="color: #020468;" href="#" class="ctext"><b>₹</b>
                        @php 
                        echo $withdrawl_amount;
                        @endphp
                        </a></h1>
                        <p    class="chead">Withdrawl Wallet Amount</p>
                      </center>

                    </div>


                  </div>
                </div>
              </div>


     

        </div>

      </div>

    </section>
        </div>
    </div>
    <!--end page wrapper -->
    
    
    
      <script>
    function copyText() {
      /* Get the text field */
      var copyText = document.getElementById("myInput");

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */

      /* Copy the text inside the text field */
      navigator.clipboard.writeText(copyText.value);

      /* Alert the copied text */
      alert("Copied the text: " + copyText.value);
    }
  </script>
  <style>
   .show{
      display:block;
  }
  .hidden {
  display: none;
}
  
  .text-primary {
    color: #f8f9f9 !important;
}
    .flex-center {
      display: flex;
      justify-content: center;
    }

    .layout-container {
      background: #4e54c8;
      /* fallback for old browsers */
      background: -webkit-linear-gradient(to bottom, rgba(143, 148, 251, .1), rgba(78, 84, 200, .1));
      /* Chrome 10-25, Safari 5.1-6 */
      background: linear-gradient(to bottom, rgba(143, 148, 251, .1), rgba(78, 84, 200, .1));
      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }

    .card {
      background-color: rgba(255, 255, 255, .7);
      box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px !important;
    }

    .card-text-design {
      font-weight: bold;
      font-size: 25px;
    }

    .chead {
      color: black;
    }
    
    .chead:hover{
        
        color:white;
    }

    .ctext {
      color: black;
    }

    .cicon {
      color: #fff;
      border-radius: 5px;
      padding: 2px;
      box-shadow: 0 10px 29px 0 rgba(9, 9, 9, 0.47);
    }

.swamlm {
    display: block;
    background: 0;
    /* width: 100%; */
    box-shadow: inset -1px 1px 16px 17px rgba(182,185,255,341.5);
    margin-bottom: 0px;
}
    .cicon-opposite {
      color: #fbe852;
      border-radius: 5px;
      padding: 2px;
      box-shadow: 0 1px 25px 0 #fbe852ab;
    }

    
    .ccount {
    color: white !important;
    font-size: 30px;
    font-weight: bold;
}

    .aliminate {
      position: relative;
      -webkit-animation: glide 2s ease-in-out alternate infinite;
    }

    @-webkit-keyframes glide {
      from {
        left: 0px;
        top: 0px;
      }

      to {
        left: 0px;
        top: 20px;
      }

    }

    .act {
      color: black;
      font-size: 16px;
      margin-top: 50px;
    }
html:not([dir=rtl]) .border-start {
    border: 5px solid #d9dee3 !important;
}
.sewa{
     border: 5px solid #d9dee3 !important;
}
    .pkgborder {
      border: 1px solid white;
      border-radius: 7px;
      margin-bottom: 20px;
      text-align: center;
      padding-top: 13px;
      width: 100%;
      font-size: 16px;
      background-color: #f2d2fd;
      box-shadow: 0 10px 29px 0 rgba(255, 255, 255, 0.29);
    }

    @media only screen and (max-width: 600px) {
      .pack-achieve-card {
        width: 50%;
      }

    }



    @keyframes wobble {

      0%,
      100% {
        -webkit-transform: translateX(0%);
        transform: translateX(0%);
        -webkit-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
      }

      15% {
        -webkit-transform: translateX(-32px) rotate(-10deg);
        transform: translateX(-32px) rotate(-10deg);
      }

      30% {
        -webkit-transform: translateX(calc(32px / 2)) rotate(10deg);
        transform: translateX(calc(32px / 2)) rotate(10deg);
      }

      45% {
        -webkit-transform: translateX(calc(-32px / 2)) rotate(calc(-10deg / 1.8));
        transform: translateX(calc(-32px / 2)) rotate(calc(-10deg / 1.8));
      }

      60% {
        -webkit-transform: translateX(calc(32px / 3.3)) rotate(calc(10deg / 3));
        transform: translateX(calc(32px / 3.3)) rotate(calc(10deg / 3));
      }

      75% {
        -webkit-transform: translateX(calc(-32px / 5.5)) rotate(calc(-10deg / 5));
        transform: translateX(calc(-32px / 5.5)) rotate(calc(-10deg / 5));
      }
    }

    @keyframes jump {
      0% {
        transform: translate3d(0, 0, 0) scale3d(1, 1, 1);
      }

      40% {
        transform: translate3d(0, 5%, 0) scale3d(.9, 1.3, 1);
      }

      100% {
        transform: translate3d(0, 5%, 0) scale3d(1.5, .9, 1);
      }
    }

    .jump-effect:hover {

      animation: jump .5s linear alternate 1;
    }

    .wobble-effect:hover {
      animation: wobble 1s ease 1;
    }

    .bv{
      Width: 48px;
      height: 45px;
      border-radius: 5px;
      padding-top: 5px;
      padding-left: 6px;
      font-size: 25px;
      font-weight: bold;
      box-shadow: 0 10px 29px 0 rgba(9, 9, 9, 0.47);
    }
    
    
@keyframes rotate {
	100% {
		transform: rotate(1turn);
	}
}
 
.rainbow {
	position: relative;
	z-index: 0;
 
	border-radius: 10px;
	overflow: hidden;
	 
	
	&::before {
		content: '';
		position: absolute;
		z-index: -2;
		left: -50%;
		top: -50%;
		width: 200%;
		height: 200%;
		background-color: #399953;
		background-repeat: no-repeat;
		background-size: 50% 50%, 50% 50%;
		background-position: 0 0, 100% 0, 100% 100%, 0 100%;
		background-image: linear-gradient(#399953, #399953), linear-gradient(#fbb300, #fbb300), linear-gradient(#d53e33, #d53e33), linear-gradient(#377af5, #377af5);
		animation: rotate 4s linear infinite;
	}
	
	&::after {
		content: '';
		position: absolute;
		z-index: -1;
		left: 6px;
		top: 6px;
		width: calc(100% - 12px);
		height: calc(100% - 12px);
		background: white;
		border-radius: 5px;
		animation: opacityChange 3s infinite alternate;
	}
}

@keyframes opacityChange {
	50% {
		opacity:1;
	}
	100% {
		opacity: .5;
	}
}
    
    
    
    
    @media only screen and (max-width:600px){
        
    
.pack-achieve-card2 {
    width: 30%;
}

}
    
    
    
  </style>
</head>

<body>

  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">
      <!-- Menu -->
     
     

      <!-- / Menu -->



      <!-- Layout container -->
      <div class="layout-page">


       
       

        <style>
          .card {
            background: linear-gradient(to right, #56ccf2, #2f80ed)!important;
          }
        </style>

        <!-- Content wrapper -->
        <div class="content-wrapper">

       
          

        </div>
        <style>
            /*--------------------------------------------------------------
# Services
--------------------------------------------------------------*/
.services .service-box {
      box-shadow: 0px 0 30px rgba(1, 41, 112, 0.08);
    /* height: 100%; */
    /* padding: 60px 30px; */
    /*text-align: center;*/
    /* transition: 0.3s; */
    border-radius: 5px;
}


.services .service-box .icon {
  font-size: 36px;
  padding: 40px 20px;
  border-radius: 4px;
  position: relative;
  margin-bottom: 25px;
  display: inline-block;
  line-height: 0;
  transition: 0.3s;
}

.services .service-box h3 {
  color: #444444;
  font-weight: 700;
}

.services .service-box .read-more {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 16px;
  padding: 8px 20px;
}

.services .service-box .read-more i {
  line-height: 0;
  margin-left: 5px;
  font-size: 18px;
}

.services .service-box.pink {
  border-bottom: 0px solid #2db6fa;
}

.services .service-box.pink .icon {
  color: #2db6fa;
  background: #dbf3fe;
}

.services .service-box.pink .read-more {
  color: #2db6fa;
}

.services .service-box.pink:hover {
  background: #2db6fa;
}

.services .service-box.orange {
  border-bottom: 0px solid #f68c09;
}



.services .service-box.pink {
  border-bottom: 0px solid #f51f9c;
}

.services .service-box.pink .icon {
  color: #f51f9c;
  background: #feecf7;
}

.services .service-box.pink .read-more {
  color: #f51f9c;
}

.services .service-box.pink:hover {
  background: #f51f9c;
}

.services .service-box:hover h3,
.services .service-box:hover p,
.services .service-box:hover .read-more {
  color: #fff;
}

.services .service-box:hover .icon {
  background: #fff;
}

        </style>
        <!-- / Content -->
       
     
     


        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>



  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>


  <!-- Drag Target Area To SlideIn Menu On Small Screens -->
  <div class="drag-target"></div>

  </div>
  <!-- / Layout wrapper -->
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
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
