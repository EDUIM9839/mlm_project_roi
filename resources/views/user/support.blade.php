@extends('user.layouts.main')
@section('mains')
<style>
	input{
		border-width: 1px !important;
	}

	.input-group-text{

		border-width: 1px !important;

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
                            <li class="breadcrumb-item active" aria-current="page">Support</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
			
     @foreach($result as $res)
   
    <div class="d-flex align-items-center justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                  
                <div class="card-body">
                     <h6 style="color:green">Support</h6>  <span id="error_amount"></span>
								<hr/>
                  
                   <table class="table table-bordered">
                       <tbody><tr>
                           <th style=" text-align: center;">Email</th>
                           <td style=" text-align: center;">{{$res->email}}</td>
                       </tr>
                       <!--<tr>-->
                       <!--    <th>Contact / Whatsapp</th>-->
                       <!--    <td>+91 {{$res->phone}}</td>-->
                       <!--</tr>-->
                   </tbody></table>
                </div>
            </div>
        </div>
    </div>

    @endforeach
                    </div>
                </div>
            </div>
                                    
            <!-- Scrollable -->
           
       
    <!--end page wrapper -->
@endsection
