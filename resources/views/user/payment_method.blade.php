@extends('layouts.main')
@section('mains')
<head>
<link rel="stylesheet" href="/assets/css/buttons.css" />
</head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Payment Gateway Setup</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User List</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button"
                            class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                                href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                                link</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <!-- Form Start1 -->
            <!-- <div class="row g-3">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header border-0 pb-0 pt-4">
                        <h6 class="card-title">
                            <span>Payment Method</span>
                        </h6>
                    </div>
                    <div class="card-body pt-3">
                         <form action="" method="post">
                            <h6 class="text-capitalize mb-3">Cash on delivery</h6>
                            <div class="d-flex flex-wrap p-0">
                                <label class="form-check form--check mr-2 mr-md-4">
                                    <input class="form-check-input" type="radio" name="status" value="1" checked="">
                                    <span class="form-check-label">Active</span>
                                </label>
                                &nbsp;&nbsp; &nbsp;&nbsp;
                                <label class="form-check form--check">
                                    <input class="form-check-input" type="radio" name="status" value="0">
                                    <span class="form-check-label">Inactive</span>
                                </label>
                            </div>
                            <div align="right" class="btn-container justify-content-end mt-2" >
                                <button type="submit" onclick="" style="margin: 8px;" class="btn btn-info">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
            <!-- Form end1 -->
            <!-- Second Form  -->
            <!-- <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header border-0 pb-0 pt-4">
                        <h6 class="card-title">
                            <span>Payment Method</span>
                        </h6>
                    </div>
                    <div class="card-body pt-3">
                         <form action="" method="post">
                            <h6 class="text-capitalize mb-3">Digital Payment</h6>
                            <div class="d-flex flex-wrap p-0">
                                <label class="form-check form--check mr-2 mr-md-4">
                                    <input class="form-check-input" type="radio" name="status" value="1" checked="">
                                    <span class="form-check-label">Active</span>
                                </label>
                                &nbsp;&nbsp; &nbsp;&nbsp;
                                <label class="form-check form--check">
                                    <input class="form-check-input" type="radio" name="status" value="0">
                                    <span class="form-check-label">Inactive</span>
                                </label>
                            </div>
                            
                            <div align="right" class="btn-container justify-content-end mt-2" >
                                <button type="submit" onclick="" style="margin: 8px;" class="btn btn-info">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
            <!-- end second -->
<!-- </div> -->
<!-- end first two form div row 3 tag -->
<!-- third form start -->

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
					
                    <form class="row g-3" action="{{route('update_social')}}" method="POST">
						@csrf	
                        <div class="payment--gateway-img" style="margin-left:auto; width: 63%;">
                            <img src="../assets/images/instamojo.png" style="width:30%;" alt="public">
                        </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" name="store_id" placeholder="Instamojo Key" value="">
                            </div>
                            <div class="form-group mb-4">
                                <input class="form-control" type="text" name="store_password" placeholder="Instamojo Secret" value="">
                            </div>
                    <div align="right" class="btn-container justify-content-end mt-2" >
                                <button type="submit" onclick="" style="margin: 8px;" class="btn btn-info">Save</button>
                            </div>

								</form>
<!--  -->
<!-- end third  -->

        </div>
    </div>
@endsection
