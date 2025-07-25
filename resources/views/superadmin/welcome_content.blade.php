 
@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')
 

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
                   	@if (session()->has('success'))
				<div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
					<div class="d-flex align-items-center">
						<div class="font-35 text-white"><i class='bx bxs-message-square-check'></i>
						</div>
						<div class="ms-3"> 
							<div class="text-white">{!!session()->get('success')!!}</div>
						</div>
					</div>
					<span  style="height: 100%; top: -21px;">
					    <button type="button" class="btn-close" data-bs-dismiss="alert" style="padding: 28px 23px;"></button>
					    
					</span>
				</div>
				@elseif(session()->has('error'))
				<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
					<div class=" ">
						<div class="font-20 text-white"><i class='bx bxs-message-square-x'
								style='display:contents; !important'></i><span
								style='font-size:16px;'>&nbsp;{!!session()->get('error')!!}</span>
						</div>
					</div>
					<span  style="height: 100%; top: -21px;">
					    <button type="button" class="btn-close" data-bs-dismiss="alert" style="padding: 28px 23px;"></button>
					    
					</span>
				</div> @endif
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10"  id="smallscreen">
                          
                                      <!-- Scrollable -->
                 <form action="{{route('welcome_content_save')}}" method="post" enctype="multipart/form-data">
					 	@csrf
                                        <div  class="content pb-4" >
                                        <h3 style="text-align:center">Welcome Content</h3> 
                                         <div class="line">
                                       <hr>
                                  </div>
                                    <div id="welcome-letter" class="mt-2" >
                                 <div id="welcome-letter-content">
                                
       <!--                            <img src="https://mlmlaravel.swasoftech.in/public/assets/images/logo-icon.png" width=100px; alt="logo" align=right; ><br>-->
       <!--                            <br>-->
       <!--                            <label for="themes1">-->
       <!--                                     <div class="ms-auto " >-->
							<!--	<input class="widgets-icons-2  ms-auto" name="theme" id='themes1'-->
							<!--		value="../public/assets/images/theme/background-image.jpg" type="radio" style="position: relative;left: 25%; top:170px;" checked>-->
							<!--</div>  -->
       <!--                         <p style="width:60%; position:absolute; top:90px"> -->
       <!--                             <span style="font-weight:600;"> -->
       <!--                            <br> -->
       <!--                          </span> -->
                                <!-- <br/> -->
                                <!--  To:Dusht<br/>-->
                                <!--  UserId: RCK004-->
                                <!--  <br>-->
                                <!--  Date:27-feb-2024-->
                                <!--</p></br></br></br>-->
                                <!--<p><b>Dear Sir/Ma'am</b></p>-->
                                  @php
                                    $i = 1;
                                @endphp
                                @foreach ($welcomeletter as $paa) 
                           
                                            
                                  <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label"></label>
                                        <textarea cols="80" class="form-control ckeditor" id="description"  
                                            name="description" id='description' rows="10">{{$paa->content}} </textarea>
                                    </div>
                                        
                                    @endforeach
                                </div>
                                <div class="py-4" align="center">
			<button style="width :200px;border-radius: 0px;" class="btn btn-primary p-2 d-flex align-items-center justify-content-center"> <i class='bx bx-upload' ></i> Upload
			</button>
		</div> 
                                 
                         </div>  
                </div> 
            </div>  
              
            </div>  
             
                    </div>
                  </div><br>
            <!--/ Scrollable --> 
          </div>
          <!-- / Content -->
 
        </div>
        
        </form>
        
    </div>
     
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script src="https://example.com/ckfinder/ckfinder.js"></script>

 
 
<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
        })
        .catch(error => {
            console.error(error);
        });
</script>
 
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