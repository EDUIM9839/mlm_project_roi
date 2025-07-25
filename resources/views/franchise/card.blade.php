@extends('user.layouts.main')
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
     
       background-image:url("{{Storage::url('app/public/welcome_letter_backgorund.png')}}");
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
                       <h4 class="mb-0 text-uppercase alert  "> ID Card</h4>
                
       <hr/>
            <!-- Scrollable -->
              <div  class="content pb-4" >
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10 col-md-10 panel" >
                                        <h3 style="text-align:center" class="pt-3">ID Card</h3>
                                  <div class="line">
                                       <hr>
                                  </div>
                                   <div id='id-card-x' >
                                <div class="id-card-tag"> </div>  
                                  <div class="id-card-hook"> </div>  
                      <div class="welcome-letter" class="mt-5 d-flex" >
                       <div class="welcome-letter-content"> 
                       <div style="display:block;" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png"width=100px; alt="logo"><br>
  </div>
                       <!--<h3 align="center" class="name"><span  class="company-name" ></span></h3>-->
                       
                                        <div class="row" style="margin-top:21px;" align="center"> 
                                        
                                        .
                          <div class="col-md-12" align="center"><img src="https://mlmlaravel.swasoftech.in/public/assets/images/twilio.png" width=70px; height=50px; alt="logo" class="img-fluid rounded-circle" > </div> 
                                         
                                        </div>
                                    <h5 align="center" style="color:black;   margin-top:0.2%; font-weight:800;">
                                  {{Auth::user()->first_name}}  {{Auth::user()->last_name}}
                                     </h5>
                                     
                                     <h6 align="center" style="color:red;  margin:2%; text-decoration:underline;  font-weight:400;">ID-
                                     {{Auth::user()->userid}}
                                     </h6>       
                                            <div class="row"> 
                                    <div class="col-12" align="center"> Email : &nbsp;&nbsp;
                                      {{Auth::user()->email}}
                                      <b style="color:blue;"></b>
                                    </div>
                                       <div class="col-12 py-1"  align="center" >Date of Joining : &nbsp;&nbsp;
                                    <b>
                                       
                                        {{Helper::formatted_date(Auth::user()->created_at)}}
                                        
                                    </b> </div>
                                    
                                        <div class="col-12 py-1"  align="center" >Intro. Name : 
                                    <b style="color:green; font-size:10px;" >
                                        @php
                                        $referal=DB::table('user')->where('userid',Auth::user()->referal)->first();
                                        @endphp
                                        {{$referal->first_name}} {{$referal->last_name}}
                                       
                                    </b> </div>
                                        </div><br>
                                       <span  class="sticky website-footer"   align="center";>
                                           @php
                                        $company=DB::table('app_config')->first();
                                        @endphp
                                         {{$company->company_email}} 
                                       </span>
                      </div>  
                      </div>
                </div>            
                           <hr class="my-3" style="height:5px;" >   
            </div>    <div class="col-sm-1"></div>

                       
                    </div>
                  </div>
                   <div  class="py-4"  align="center"> 
                <button class="btn btn-primary" onclick="CreatePDFfromHTML();" > <i class="fa fa-download"></i> Download </button>
                </div>
            <!--/ Scrollable -->

          </div>
        
        </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <script>

function CreatePDFfromHTML(){
    var HTML_Width = $("#id-card-x").width();
    var HTML_Height = $("#id-card-x").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#id-card-x")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("id_card.pdf");
        $(".html-content").hide();
    });
}
</script>
    <!--end page wrapper -->
@endsection
