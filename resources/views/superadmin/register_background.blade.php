@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')

 <style> 
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
      /*background-image: url('../public/assets/22.jpg');*/
      height:auto;
      background-repeat: no-repeat;
      background-size:100% 100%;
      padding-right:35px;
      padding-left:35px;
         border-radius: 10px; 
   } 
      
   #welcome-letter-content{ 
       text-align:justify; 
       top:7%;
       left:4%;
       right:4%; 
       padding-top:70px;
      padding-bottom:40px;
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
                            <li class="breadcrumb-item active" aria-current="page">Register Login Side Background Theme</li>
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
				
                    <div class="row g-3">
                      <div class="col-sm-1"></div>
            <div    class="col-sm-10"  id="smallscreen">
                          
                                      <!-- Scrollable -->
                                       <form action="{{route('register_logins')}}" method="post" enctype="multipart/form-data">
				                    	@csrf
		
	 		                
		
		
	@foreach($login_theme as $image)
    <div class="content pb-4">
        <h3 style="text-align:center">Login Background Image</h3>
        <div class="line">
            <hr>
        </div>
        <div id="welcome-letter" class="mt-2">
            <div id="welcome-letter-content">
                <!-- Displaying each image dynamically -->
                <img style="width: 100%;" src="{{ asset('assets/' . $image->image) }}" id="image{{ $loop->index }}">
                <br>
                <label for="image{{ $loop->index }}">
                    <div class="ms-auto">
                        <input class="widgets-icons-2 ms-auto" name="image" id="radio{{ $loop->index }}"
                               value="{{ asset('assets/' . $image->image) }}" type="radio"
                               style="position: relative;left: 500%; top: 25px;"
                               @if($loop->first) checked @endif>
                    </div>
                </label>
                 <button type="submit" class="btn btn-danger ms-3"><a class='delete-btn' href="{{ route('delete_login', ['id'=>$image->id]) }}" class="ms-3" style="color:white"><i class="bx bxs-trash"></i>Delete</a></button>
            </div>
        </div>
        <br>
    </div>
@endforeach

 


                      <div class="col-sm-1"></div> 
                    </div>
                  </div><br>
            <!--/ Scrollable -->
            
             
                   
          </div>
         
               
 <div class="py-4" align="center">
			<button  class="btn btn-primary"> <i class="fa"></i> Upload
			</button>
		</div>
	 
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
<script>
    ClassicEditor
        .create(document.querySelector('#descriptio'), {
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#descriptin'), {
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#descriptn'), {
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#descript'), {
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