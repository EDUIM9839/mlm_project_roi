@extends('user.layouts.main')
@section('mains')
<style>

    .water-mark{
        
        top:18%;
        left:0;
        width:100%;
        height:auto;
        position:absolute;
         text-align:center;
        opacity:0.1;
    }
    
     .water-mark-img{
         
          width:90%;
        height:auto;
         
     }
     
     
     .water-mark{
        
        
        top:30%;
     
    }
  .logo-icon1 {
    width: 80px!important;
}  
    
    #smallscreen{
        font-size:0.65rem;
        background-color:#FFE5E5;
        padding-top:20px;
        padding-right:13%; 
        padding-left:13%;
        border-radius:10px; 
         
       
   }
    
    
   #welcome-letter{
  

      position:relative;
      
      height:auto;
      background-repeat: no-repeat;
      background-size:100% 100%;
      padding-right:35px;
      padding-left:35px;
         border-radius: 10px;
    

   
       
   }
   #welcome-letter p{
      color:black !important;
   }
   #welcome-letter ul li{
      color:black !important;
   }
   #welcome-letter-content{
       
       text-align:justify;
       
       top:7%;
       left:4%;
     
       
        
       padding-top:20px;
      padding-bottom:20px;
       font-size:1rem;
       /*position:absolute;*/
      
   }
   
   @media only screen and (max-width:906px) {
   #welcome-letter-content{
        font-size:0.75rem;
       
   }
   
   }
   
    @media only screen and (max-width:779px) {
   #welcome-letter-content{
        font-size:0.7rem;
       
   }
   
    }
   
    @media only screen and (max-width:676px) {
   #welcome-letter-content{
        font-size:0.65rem;
       
   }
    @media only screen and (max-width:480px) {
   #smallscreen{
        font-size:0.65rem;
        background-color:#FFE5E5;
        padding-top:20px;
        padding-right:5%; 
        padding-left:5%;
        border-radius:10px; 
       
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
                            <li class="breadcrumb-item active" aria-current="page">Welcome Letter</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->

            <!-- Scrollable -->
              <div  class="content pb-4" >
                   
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10"  id="smallscreen"> 
                                        <h3 style="text-align:center">WELCOME LETTER</h3>  
                                  <div class="line">
                                       <hr>
                                  </div>
                   
                <div id="welcome-letter"  style="background-image: url({{ $welcomeletter ? url('storage/app/public/'.$welcomeletter->image) : '../public/assets/images/theme/background-image.jpg' }}) !important"  class="mt-2" >
                    
                    
                            <div id="welcome-letter-content">
                                
                <div class="water-mark"><img  class="water-mark-img img-fluid" src="{{ Storage::url('app/logo/').DB::table('business_setup')->first()->logo}}"  alt="logo" > </div>
                                   <img src="{{ Storage::url('app/logo/').DB::table('business_setup')->first()->logo}}"   align=right; class="logo-icon1" alt="logo icon">
                               <br>
                                   <br>
                                   <!--<img src="{{ Storage::url('app/public/earner.gif')}}" height='30' width='30'>-->
                                    
                                <p  style="width:60%; position:absolute; top:30px">
                                    
                                    <span style="font-weight:600;">
                               
                                 </span>
                                 
                                    
                                 <br /> 
                                 {{--
                                  To: {{Auth::user()->first_name}}  {{Auth::user()->last_name}}<br />
                                  UserId: {{Auth::user()->userid}}
                                  --}}
                                  <br>
                                  Date:{{Helper::formatted_date(Auth::user()->created_at)}}
                                </p></br>&nbsp;
                           
                                <p>
                                  <b>Dear {{Auth::user()->first_name}}  {{Auth::user()->last_name}}</b></p>
                               
                                 <p>Your login id is {{Auth::user()->userid}}</p>
                              
                                 <p>{!! $welcomeletter ? $welcomeletter->content : $DefaultWelcomeLetter->content !!}</p>
                            
                               
                                
                        </div>
                                
                </div>
                
                
                
                <!-- <div  class="py-4"  align="center"> -->
                <!--<button class="btn btn-primary" onclick="CreatePDFfromHTML();" > <i class="fa fa-download"></i> Download </button>-->
                <!--</div>-->
                    <div style="display:block;" align="center"><img src="{{ asset('assets/images/downloadbutton.gif') }}"width=200px; onclick="CreatePDFfromHTML();" alt="logo" style="cursor: pointer;"> <br>
                        </div> 
                    </div>
                      
                      
                      
                      
                      <div class="col-sm-1"></div>

                       
                    </div>
                  </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->

        
        </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <script>
function CreatePDFfromHTML(){
    var HTML_Width = $("#welcome-letter").width();
    var HTML_Height = $("#welcome-letter").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#welcome-letter")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("Welcome Letter.pdf");
        $(".html-content").hide();
    });
}
</script>
    <!--end page wrapper -->
@endsection
