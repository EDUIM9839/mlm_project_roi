@extends('superadmin.layouts.main')
@section('pageTitle', 'Payout')
@section('mains')


 
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <h6 class="mb-0 text-uppercase alert  "> </h6>
           
 <hr/>
            <!--end breadcrumb-->
            <!-- nav -->
             
            <div class="row">
    <div class="col-xl-12">
        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link" href="{{route('plan_setting')}}" id="commission">
                    <span class=""><i class="fas fa-percent"></i></span>
                    <span class="">Plan Setting</span>
                </a>
            </li>
            
            
                        <li class="nav-item ">
                <a class="nav-link active " href="{{route('payout')}}" role="tab" id="payout">
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

&nbsp;
            <!-- nav end -->
           
        </div>
    </div>
@endsection
