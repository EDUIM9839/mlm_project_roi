@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')

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
            <li class="breadcrumb-item active" aria-current="page">User Login Side Background Theme</li>
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
      <div class="col-sm-10" id="smallscreen">
        <h3 style="text-align:center">Login Background Image</h3>
        <div class="line">
          <hr>
        </div>

        <!-- Scrollable -->
        <form action="{{route('theme_login')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="image_id" id='image_id_target'>
          @foreach($user_theme as $image)
          <div class="content pb-4">

            <div id="welcome-letter" class="mt-2">
              <div id="welcome-letter-content">
                <!-- Displaying each image dynamically -->
                <label for="themes1{{$image->id}}">
                  <img style="width: 100%;" src="{{ asset('assets/' . $image->image) }}" id="image{{ $loop->index }}">
                </label>
                <br>
                <label>
                  <div class="ms-auto">
                    <input node-id="{{$image->id}}" class="nodecheck  widgets-icons-2 ms-auto" name="image"
                      id='themes1{{$image->id}}' value="{{ asset('assets/' . $image->image) }}" type="radio"
                      style="position: relative;left:  500%; top: 25px;" @if($login->image_id==$image->id) checked
                    @endif>
                  </div>
                </label>
                <button type="submit" class="btn btn-danger ms-3"><a class='delete-btn'
                    href="{{ route('delete_login', ['id'=>$image->id]) }}" class="ms-3" style="color:white"><i
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
    <div class="py-4" align="center">
      <button class="btn btn-primary"> <i class="fa"></i> Upload
      </button>
    </div>

  </div>
  </form>
</div>
<script>
  $(document).ready(function () {

    $('.nodecheck').click(function () {
      console.log($(this).attr('node-id'));
      $('#image_id_target').val($(this).attr('node-id'));
    });
  }) 
</script>

<!--end page wrapper -->
@endsection