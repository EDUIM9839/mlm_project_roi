@extends('admin.layouts.main')
@section('mains')
<head>
<link rel="stylesheet" href="/assets/css/buttons.css" />
<style>
    hr{
     margin: 0.5rem 0; 
     color: inherit; 
     border: 0!important; 
     border-top: var(--bs-border-width) solid; 
     opacity: .25; 
}
</style>
</head>
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
                            <li class="breadcrumb-item active" aria-current="page">Payment Gateway Setup</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class='col-md-6'>
                       <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{route('add-product')}}" class='badge bg-info'>Add Product</a></h6>
                </div>
                </div>
            </div>
            <!--end breadcrumb-->
<!--  -->
<div class="card border-top border-0 border-4 border-white">
							<div class="card-body p-2">
                                <div class="card-header border-0 pb-0 pt-4">
                        <h5 class="d-flex justify-content-between">
                            <span>Instamojo</span>
                            <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                        </h5>
                    </div>
					
                   
								
								
								         
            <div style="width:600px;left:350px;" class="card">
                <div class="card-body p-4">
                   
                    <div class="form-body ">
                         
                            <form     action="{{ route('update_social') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="payment--gateway-img" style="margin-left:auto; width: 63%;">
                            <img src="../assets/images/factor.png" style="width:30%;" alt="public">
                        </div>
							 
								<hr/>

					<div class="border p-4 rounded">
						<div class="row g-6">
                                <div class="col-md-12">
                                 
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                        <input type="text" class="form-control  " name="store_id"
                                             placeholder="Instamojo Key" value=""/>
                                    </div></br>
                                    <div class="col-md-12">
                                  
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                                        <input type="text" class="form-control "
                                            name="store_password" placeholder="Instamojo Secret" value=""/>
                                    </div>
                                </div></br>
                              
                                   <button type="submit" onclick="" style="margin: 8px;" class="btn btn-info">Save</button>
                              

							</form>
					</div>
                        </div>
                    </div>
                </div>
            </div>
                       

          </div>
<!--  -->
<!-- end third  -->

        </div>
    </div>
@endsection
