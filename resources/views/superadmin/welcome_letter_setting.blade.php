@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')
    <style>
        #smallscreen {
            font-size: 0.65rem;
            background-color: #f1f1f1;
            padding-top: 20px;
            padding-right: 13%;
            padding-left: 13%;
            border-radius: 10px;
            padding-bottom: 20px;
        }

        #welcome-letter {
            position: relative;
            background-image: url('../public/assets/images/theme/background-image.jpg');
            height: auto;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            padding-right: 35px;
            padding-left: 35px;
            border-radius: 10px;
        }

        #welcome-letter1 {
            position: relative;
            background-image: url('../public/assets/images/theme/11.jpg');
            height: auto;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            padding-right: 35px;
            padding-left: 35px;
            border-radius: 10px;
        }

        #welcome-letters {
            position: relative;
            background-image: url('../public/assets/images/theme/18.jpg');
            height: auto;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            padding-right: 35px;
            padding-left: 35px;
            border-radius: 10px;
        }

        #welcome-letteres {
            position: relative;
            background-image: url('../public/assets/images/theme/15.jpg');
            height: auto;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            padding-right: 35px;
            padding-left: 35px;
            border-radius: 10px;
        }

        #welcome-letter2 {
            position: relative;
            background-image: url('../public/assets/images/theme/letter-head.jpg');
            height: auto;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            padding-right: 35px;
            padding-left: 35px;
            border-radius: 10px;
        }

        #welcome-letter-content {
            text-align: justify;
            top: 7%;
            left: 4%;
            right: 4%;
            padding-top: 70px;
            padding-bottom: 40px;
            font-size: 1rem;
            /*position:absolute;*/
        }

        @media only screen and (max-width:906px) {
            #welcome-letter-content {
                font-size: 0.75rem;
            }
        }

        @media only screen and (max-width:779px) {
            #welcome-letter-content {
                font-size: 0.7rem;
            }
        }
        
        .water_mark{
            position: absolute;
            width: max-content;
            width: 100%;
            height: 100%;
            top: 0px;
            left: 0;
            display: flex;
            align-items: center;
            font-size: 300px;
            justify-content: center;
            z-index: 1;
            opacity: 0.2;
        }
        
        .water_mark img{
             position: relative;
             width: 412px;
        }

        @media only screen and (max-width:676px) {
            #welcome-letter-content {
                font-size: 0.65rem;

            }
        }
            @media only screen and (max-width:480px) {
                #smallscreen {
                    font-size: 0.65rem;
                    background-color: #f1f1f1;
                    padding-top: 20px;
                    padding-right: 5%;
                    padding-left: 5%;
                    border-radius: 10px;

                }
                
                .water_mark img{
                       width: 332px;
                }
            }
    
            
    </style>

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Welcome Letter</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="w-100 p-2 mb-3">
                <div class="row d-flex justify-content-between align-items-center">
                    
                    
                    <div class="col-12 col-sm-6 fs-4 fw-bold ">
                        
                        <div class="row">
                            <div class="col-12 col">
                                <span>Welcome Letter Themes</span> 
                            </div>
                            <div class="col-12 col">
                                @if($defaultApplied)
                                    <span class="py-1 px-2 bg-warning text-light" style="border-radius: 5px;font-size: 12px">Default Theme applied<span> 
                                @endif
                            </div>
                            
                        </div>
                        
                    
                    </div>
                    <div class="col-12 col-sm-6 d-flex">
                    <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#uploadThemeModal"><i
                            class='bx d-inline bx-add-to-queue'></i> Add Theme</button>
                            
                    </div>
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
					<span  style="height: 100%; top: -21px;">
					    <button type="button" class="btn-close" style="padding: 28px 23px;" data-bs-dismiss="alert"></button>
					    
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
					    <button type="button" class="btn-close" style="padding: 28px 23px;" data-bs-dismiss="alert"></button>
					    
					</span>
				</div> @endif
            
            
        </div><br>
        <!--/ Scrollable -->

        <!-- Scrollable -->
       
        @php
        $i = 1;
        @endphp
        @forelse($welcomeletter as $letter)
        
            <div class="content pb-4">

                <div class="row g-3">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10" id="smallscreen">
                       <div class="card d-flex flex-row px-3 py-2 align-items-center justify-content-between" style="opacity: 0.8;border-radius: 0; background-image: linear-gradient(to bottom right, #ffffff0f, #e1e1e19c) !important;">
                            <div class="fs-5 fw-bold" style="text-align:center">Theme {{ $i++ }} </div>
                           <!--<input class="widgets-icons-2  ms-auto" name="theme" id='themes' -->
                           <!--                 value="../public/assets/images/theme/11.jpg" type="radio"-->
                           <!--                 checked>-->
                           
                           <div class="d-flex align-items-center justify-content-center">
                              <form action="{{ route('apply-welcome-letter', $letter->id ) }}" method="post">
                                  @csrf
                                   <button class="btn btn-sm text-white me-1 {{ $letter->is_applied == '0' ? 'btn-info': 'btn-success' }} " {{ $letter->is_applied == '0' ? '': 'disabled' }} data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Apply this theme">
                                        {{ $letter->is_applied == '0' ? 'Apply': 'Applied' }}
                                        </button>
                              </form>
                              
                           
                              <form action="{{ route('delete-welcome-letter', $letter->id) }}" method="post">
                                  @csrf
                               <button class="btn btn-danger btn-sm text-white d-flex align-items-center justify-content-center" style="height: 30px ; width: 30px" ><i class='bx bxs-trash-alt me-0'></i></button>
                              </form>
                           
                              
                              
                           </div>
                           
                       </div>
                       
                        <div id="welcome-letter1" style="background-image: url({{ $letter->image }}) !important;background-size: 100% 100%; background-repeat: no-repeat; background-position: center;" class="mt-2">
                            
                            <div class="water_mark">
                                <img src="/storage/app/logo/LOGO_1721201552.png" width="500px" />
                                
                            </div>
                            
                            <div id="welcome-letter-content">
                                <label for="themes">
                                    <img class="mt-1" src="/storage/app/logo/LOGO_1721201552.png"
                                        width=100px; alt="logo" align=right;><br>
                                    <br>
                                    <p style="width:60%; position:absolute; top:90px">
                                        <span style="font-weight:600;">
                                            <br>
                                        </span>
                                        <br />
                                        To:SWA Softech<br />
                                        UserId:RCK003
                                        <br>
                                        Date:16-Jan-2024
                                    </p></br></br></br>
                                    <p><b>Dear Sir/Ma'am</b></p>
                                   
                                    <p>{!! $letter->content !!}</p>
                                    
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        @empty
        
            <div class="container w-100 d-flex flex-column align-items-center justify-content-center">
                <div class=" mt-5 d-flex fs-2 align-items-center justify-content-center text-warning" style="width: 150px;border-radius: 20px; height: 150px; background: #fff3cd; border: 1px solid #ffe69c; " >
                    <i class='bx bx-image-alt' style="font-size: 100px;"> </i>
                    
                </div>
                <div class="text-secondary fs-4 mt-2 fw-bold">No Themes Created</div>
            </div>
        
        @endforelse
        <!--/ Scrollable -->





    </div>
    

    </div>
    </form>
    </div>


    <div class="modal fade" id="uploadThemeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Theme</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('welcome_letter_save') }}" method="post" enctype='multipart/form-data'>

                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="mb-2">
                                <label class="form-label">Select Image</label>
                                <div class="input-group">
                                    <input type="file" name="image" class="form-control" id="inputGroupFile02"
                                        accept="image/png, image/jpeg">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>

                                @error('image')
                                    <small class="text-danger" id="uploadImageError">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Theme</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  @error('image')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
           setTimeout(function(){
                    $("#uploadThemeModal").modal("show");
           }, 100);
        });
    </script>
  @enderror



    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script src="https://example.com/ckfinder/ckfinder.js"></script>
    
    <script>
        
        document.addEventListener('DOMContentLoaded', function(){
           let uploadImageError = document.querySelector("#uploadImageError");
           if(uploadImageError){
                $("#uploadThemeModal").modal("show");
           }   
        });
    
        ClassicEditor
            .create(document.querySelector('#description'), {})
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#descriptio'), {})
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#descriptin'), {})
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#descriptn'), {})
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#descript'), {})
            .catch(error => {
                console.error(error);
            });
    </script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <script>
        function CreatePDFfromHTML() {
            var HTML_Width = $("#welcome-letter").width();
            var HTML_Height = $("#welcome-letter").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;
            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

            html2canvas($("#welcome-letter")[0]).then(function(canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width,
                    canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4),
                        canvas_image_width, canvas_image_height);
                }
                pdf.save("Welcome Letter.pdf");
                $(".html-content").hide();
            });
        }
        
        
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipTriggerList.forEach(element =>{
             new bootstrap.Tooltip(element);
        });
    </script>
     

    <!--end page wrapper -->
@endsection
