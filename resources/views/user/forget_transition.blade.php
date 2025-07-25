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
                            <li class="breadcrumb-item active" aria-current="page">Forget Transaction Password</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
			
            <div style="margin-bottom:4%;"class="card">
                <div class="card-body p-4">
                     @if (session()->has('success'))
                                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                            </div>
                                            <div class="ms-3">
                                                 
                                                <div class="text-white">{!!session()->get('success')!!}</div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @elseif(session()->has('error'))

                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                        </div>
                                        <div class="ms-3">
                                             
                                            <div class="text-white">{!!session()->get('error')!!}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                                @endif
                   
                    <div class="form-body ">
                         
                          
							
								 
                
					<div class="border p-4 rounded">
						<div class="row g-6">
                                <div class="col-md-12">
                                      <div class="d-flex justify-content-center">
                             <form action='{{route("send_transaction_password")}}' method="post">
                                 @csrf
                               <button  onclick='return confirm("Are you sure to send transaction password on your email??")' type="submit" class="btn btn-success my-3" id="btnx">Click To Send Transaction Password On Registered Email</button>
                             </form>
                           </div>
                                </div>  
                                </div> 
                     </div> 
							</div>
						 
						  
						 
						 
					</div>
                       
                </div>
            </div>
                                    
            <!-- Scrollable -->
           
       </div>
       </div>
    
     
@endsection
