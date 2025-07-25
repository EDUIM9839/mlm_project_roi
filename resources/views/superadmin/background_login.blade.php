@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')
 <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
  #smallscreen {
    font-size: 0.65rem;
    background-color: #FFE5E5;
    padding-top: 20px;
    padding-right: 13%;
    padding-left: 13%;
    border-radius: 10px;
  }

  #welcome-letter {
    position: relative;
    /*background-image: url('../public/assets/22.jpg');*/
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

  @media only screen and (max-width:676px) {
    #welcome-letter-content {
      font-size: 0.65rem;

    }

    @media only screen and (max-width:480px) {
      #smallscreen {
        font-size: 0.65rem;
        background-color: #FFE5E5;
        padding-top: 20px;
        padding-right: 5%;
        padding-left: 5%;
        border-radius: 10px;

      }
    }
</style>
 <style>
        /* Custom styles for multi-color options */
        select#image {
            background: linear-gradient(135deg, #f06, #4a90e2);
            color: #fff;
            border: none;
    bottom: 0px;
    right:60px;
    position: absolute;
        }

        /*select#image option:nth-child(1) {*/
            background-color: #e74c3c; /* Red */
        /*    color: #fff;*/
        /*}*/

        /*select#image option:nth-child(2) {*/
            background-color: #f1c40f; /* Yellow */
        /*    color: #000;*/
        /*}*/

        select#image option:nth-child(3) {
            background-color: #2ecc71; /* Green */
             color: #000;
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
            <li class="breadcrumb-items actives" aria-current="page">Welcome Theme</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
     <div class="col-12 col-sm-6 fs-4 fw-bold ">
                        
                        <div class="row">
                            <div class="col-12 col">
                                <span>Welcome to Side Background Theme</span> 
                            </div>
                            <div class="col-12 col">
                                
                        <span class="py-1 px-2 bg-warning text-light" style="border-radius: 5px;font-size: 12px">Default Theme applied<span> 
                    
                            </div>
                            
                        </div>
                        
                    
                    </div>
    <br>
    
    <div class="col-12 col-sm-6">
    <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#uploadThemeModal">
        <i class='bx d-inline bx-add-to-queue'></i> Add Theme
    </button>
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
    </div> 
    @endif
    
       <div class="container">
        <div class="row">
            <div class="col text-right">
                <select name="image" id="image" class="form-control d-inline-block w-auto">
                    <option value="">Select number of images</option>
                    <option value="1"  style="color:black">1</option>
                    <option value="2"  style="color:black">2</option>
                    <option value="3" style="color:black">3</option>
                </select>
            </div>
        </div>
        
            <div class="line">
              <hr>
            </div>
            <div class="row mt-3" id="image-container">
            <!-- Images will be dynamically inserted here -->
             </div>
    </div>
    <br>
   
     
    <div class="row g-3">
      <div class="col-sm-1"></div>
      <div class="col-sm-10" id="smallscreen">
      
        <!-- Scrollable -->
        <form action="{{route('login_background')}}" method="post" enctype="multipart/form-data" id="hidedata">
              <h3 style="text-align:center">Login Background Image</h3>
        <div class="line">
          <hr>
        </div>
          @csrf 
          <input type="hidden" name="image_id" id='image_id_target'> 
          
          
          @foreach($login_image as $image) 
          <div class="content pb-4"> 
            <div id="welcome-letter" class="mt-2">
              <div id="welcome-letter-content">
                <label for="themes1{{$image->id}}">
                  <!-- Displaying each image dynamically -->
                  <img   src="{{ asset('assets/' . $image->image) }}" height="300" width="500" style="     
                                            border-radius: 15px;">
                </label>
                <label>
                  <div class="ms-auto">
                    <input node-id="{{$image->id}}" class="nodecheck widgets-icons-2 ms-auto" name="image"
                      id='themes1{{$image->id}}' value="{{ asset('assets/' . $image->image) }}" type="radio"
                      style="position: relative;left: 500%; top: 25px;" @if($login->image_id==$image->id) checked
                    @endif >
                  </div>
                </label>
                <button type="submit" class="btn btn-danger ms-4"><a class='delete-btn'
                    href="{{ route('delete_login', ['id'=>$image->id]) }}" class="ms-4" style="color:white"><i
                      class="bx bxs-trash"></i>Delete</a></button>
              </div>
            </div>
            <div class="line">
              <hr>
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
    <button class="btn btn-primary"> <i class="fa"></i> Upload
    </button>
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
                <form action="{{ route('upload_image') }}" method="post" enctype='multipart/form-data'>

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
 <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script>
  $(document).ready(function () {

    $('.nodecheck').click(function () {
      console.log($(this).attr('node-id'));
      $('#image_id_target').val($(this).attr('node-id'));
    });
  }) 
</script>
 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    $('#image').change(function() {
        let count = $(this).val();
        
        if (count) {
            $.ajax({
                url: '{{ route('admin_Images') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    count: count
                },
                success: function(response) {
                    console.log(response[0]['number']);
                    let container = $('#image-container');
                    let hidedata = $('#hidedata');
                    container.empty(); // Clear previous images
                    hidedata.hide();
                    
               if(response[0]['number']=='1'){
                   container.empty(); // Clear previous images
                    hidedata.show();
               }else if(response[0]['number']=='2'){
                    // Check if response is an array and contains data
                    if (Array.isArray(response) && response.length) {
                        response.forEach(function(image) {
                            const updateUrl = `{{ url('super-admin/login_background') }}/${image.id}`;
                            const deleteUrl = `{{ url('super-admin/delete-login') }}/${image.id}`;
                            container.append(`
                            
                                         <div class="col-md-6">
                                            <div class="card" style="background-color:#ffe5e5";>
                                                <label for="themes1${image.id}">
                                                    <!-- Displaying each image dynamically -->
                                                    <img src="{{ asset('assets/') }}/${image.image}" class="card-img-top" alt="${image.image}" height="200" width="200" style="border-radius: 15px;">
                                                </label>
                                                <a class='delete-btn' href="${deleteUrl}" style="color:white">
                                                    <button type="submit" class="btn btn-danger ms-4">
                                                            <i class="bx bxs-trash"></i>Delete
                                                    </button>
                                                </a>
                                                <div class="ms-auto">
                                                <input type="hidden" name="image_id" value="${image.id}"> 
                                                    <input node-id="{{$image->id}}" value="{{ asset('assets/') }}/${image.image}" class="nodecheck widgets-icons-2 ms-auto" name="image"
                                                        type="radio" >
                                                  </div>
                                            </div>
                                        </div>
                                 
                            `);
                        });
                    } else {
                        container.append('<p>No images found.</p>');
                    }
                 }else if(response[0]['number']=='3'){
                    // Check if response is an array and contains data
                      if (Array.isArray(response) && response.length) {
                        response.forEach(function(image) {
                            const updateUrl = `{{ url('super-admin/login_background') }}/${image.id}`;
                            const deleteUrl = `{{ url('super-admin/delete-login') }}/${image.id}`;
                            container.append(`
                            
                                        <div class="col-md-4">
                                            <div class="card">
                                                <label for="themes1${image.id}">
                                                    <!-- Displaying each image dynamically -->
                                                    <img src="{{ asset('assets/') }}/${image.image}" class="card-img-top" alt="${image.image}" height="200" width="200">
                                                </label>
                                                <a class='delete-btn' href="${deleteUrl}" style="color:white">
                                                    <button type="submit" class="btn btn-danger ms-4">
                                                            <i class="bx bxs-trash"></i>Delete
                                                    </button>
                                                </a>
                                                <div class="ms-auto">
                                                <input type="hidden" name="image_id" value="${image.id}"> 
                                                    <input node-id="{{$image->id}}" value="{{ asset('assets/') }}/${image.image}" class="nodecheck widgets-icons-2 ms-auto" name="image"
                                                        type="radio" >
                                                  </div>
                                            </div>
                                        </div>
                                 
                            `);
                        });
                    } else {
                        container.append('<p>No images found.</p>');
                    }
                 }
                },
                error: function(xhr) {
                    console.error('AJAX Error:', xhr.responseText);
                    // Optionally, display an error message to the user
                }
            });
        }
    });
});
</script>


<!--end page wrapper -->
@endsection