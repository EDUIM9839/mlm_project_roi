@extends('admin.layouts.main')
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
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Joining Percentage</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
             <!-- nav -->
             
             <div class="row">
    <div class="col-xl-12">
        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('plan_setting')}}" id="commission">
                    <span class=""><i class="fas fa-percent"></i></span>
                    <span class="">Plan Setting</span>
                </a>
            </li>
            
            
                        <li class="nav-item ">
                <a class="nav-link " href="{{route('payout')}}" role="tab" id="payout">
                    <span class=""><i class="fas fa-chart-line"></i></span>
                    <span class="">Payout</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('payment')}}" role="tab" id="payment">
                    <span class=""><i class="far fa-money-bill-alt"></i></span>
                    <span class="">Payment</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " href="{{route('sign_up')}}" role="tab" id="signup">
                    <span class=""><i class="far fa-user-circle"></i></span>
                    <span class="">Signup</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  " href="{{route('mail_config')}}" role="tab" id="mail">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <span class="">Mail</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('sms_config')}}" role="tab" id="api">
                    <span class=""><i class="fas fa-key"></i></span>
                    <span class="">SMS Module</span>
                </a>
            </li>
                    </ul>
    </div>
</div>
                       

                        <!-- Scrollable -->
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <div style="padding: 25px; border:1px solid grey; margin: 25px 0 25px 0; border-radius:7px;">
                                        <form action="{{route('update_joining_percentage')}}" method="post">
@csrf
                                            <div class="form-group">
                                                <label for="star_percentage">Star Joining Percentage:</label>
                                                <input type="number" name="star_joining_pkg" class="form-control" value="{{$jp->star_joining_pkg}}" placeholder="Enter star joining percentage" style="margin-top: 7px;">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="joining_percentage">Normal Joining Percentage:</label>
                                                <input type="number" name="joining_percentage" class="form-control" value="{{$jp->joining_percentage}}" placeholder="Enter joining percentage" style="margin-top: 7px;">
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Status:</label>
                                                <select class="form-control" value="" name="status" style="margin-top: 7px;">
                                                    <option value="active" selected="">Active</option>
                                                    <option value="inactive" >Inactive</option>
                                                </select>
                                            </div>

                                            

                                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;" name="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                        </div>
                        <!--/ Scrollable -->

                    </div>
            <!--  -->
          
        </div>
    </div>
@endsection
