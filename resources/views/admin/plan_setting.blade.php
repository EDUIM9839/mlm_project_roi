@extends('admin.layouts.main')
@section('pageTitle', 'Plan Setting')
@section('mains')

   <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
  
   
   <style>
.switch input
{
  display: none;
}

.switch 
{
  display: inline-block;
  width: 50px; /*=w*/
  height: 20px; /*=h*/
  margin: 4px;
  transform: translateY(50%);
  position: relative;
}

.slider
{
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  border-radius: 10px;
  box-shadow: 0 0 0 2px #cf0606, 0 0 4px #c90909;
  cursor: pointer;
  border: 4px solid transparent;
  overflow: hidden;
  transition: 0.2s;
}

.slider:before
{
  position: absolute;
  content: "";
  width: 100%;
  height: 100%;
  background-color: #a80606;
  border-radius: 30px;
  transform: translateX(-30px); /*translateX(-(w-h))*/
  transition: 0.2s;
}

input:checked + .slider:before
{
  transform: translateX(30px); /*translateX(w-h)*/
  background-color: limeGreen;
}

input:checked + .slider
{
  box-shadow: 0 0 0 2px limeGreen, 0 0 2px limeGreen;
}

.switch200 .slider:before
{
  width: 200%;
  transform: translateX(-82px); /*translateX(-(w-h))*/
}

.switch200 input:checked + .slider:before
{
  background-color: red;
}

.switch200 input:checked + .slider
{
  box-shadow: 0 0 0 2px red, 0 0 8px red;
}
/* click here button */
.btn-12{
  position: relative;
  right: 23px;
  bottom: 19px;
  border:none;
  box-shadow: none;
  width: 1%;
  /* height: 20px; */
  line-height: 40px;
  -webkit-perspective: 230px;
  perspective: 230px;
}
.btn-12 span {
  background: rgb(0,172,238);
background: linear-gradient(0deg, rgba(0,172,238,1) 0%, rgba(2,126,251,1) 100%);
  display: block;
  position: absolute;
  width: 130px;
  height: 40px;
  box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
   7px 7px 20px 0px rgba(0,0,0,.1),
   4px 4px 5px 0px rgba(0,0,0,.1);
  border-radius: 5px;
  margin:0;
  text-align: center;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-transition: all .3s;
  transition: all .3s;
}
.btn-12 span:nth-child(1) {
  box-shadow:
   -7px -7px 20px 0px #fff9,
   -4px -4px 5px 0px #fff9,
   7px 7px 20px 0px #0002,
   4px 4px 5px 0px #0001;
  -webkit-transform: rotateX(90deg);
  -moz-transform: rotateX(90deg);
  transform: rotateX(90deg);
  -webkit-transform-origin: 50% 50% -20px;
  -moz-transform-origin: 50% 50% -20px;
  transform-origin: 50% 50% -20px;
}
.btn-12 span:nth-child(2) {
  -webkit-transform: rotateX(0deg);
  -moz-transform: rotateX(0deg);
  transform: rotateX(0deg);
  -webkit-transform-origin: 50% 50% -20px;
  -moz-transform-origin: 50% 50% -20px;
  transform-origin: 50% 50% -20px;
}
.btn-12:hover span:nth-child(1) {
  box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
   7px 7px 20px 0px rgba(0,0,0,.1),
   4px 4px 5px 0px rgba(0,0,0,.1);
  -webkit-transform: rotateX(0deg);
  -moz-transform: rotateX(0deg);
  transform: rotateX(0deg);
}
.btn-12:hover span:nth-child(2) {
  box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
   7px 7px 20px 0px rgba(0,0,0,.1),
   4px 4px 5px 0px rgba(0,0,0,.1);
 color: transparent;
  -webkit-transform: rotateX(-90deg);
  -moz-transform: rotateX(-90deg);
  transform: rotateX(-90deg);
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
                            <li class="breadcrumb-item active" aria-current="page">User List</li>
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
                <a class="nav-link " href="{{route('payout')}}" role="tab" id="payment">
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
            <!-- plan page -->
            <!--  -->
            <div class="col-md-12">
            <div class="row g-3">
				<div class="col-md-6">
				<div class="card h-100">
					<div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
            <!--  -->
            <!-- <div class="card">
                <div class="card col-md-6">
            <div class="card-body settings_cnt_dv">
                <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="table-responsive"> -->
                            <table class="table  mb-0">
    <thead>
         <tr>

            <th>Type of Compensations</th>
            <th> Status </th>
            <th> Configuration </th>
        </tr>
    </thead>
    <tbody>

<tr>
<td>Matching Commission</td>
<td>
<div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
<input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" name="matching_commission" checked="" value="1" onchange="submitSingle(this)">
</div>
</td>
<td>
<a href="{{route('matching_commission')}}"><button class="custom-btn btn-12"><span>Click!</span><span>SET&nbsp;&nbsp;<i class="bx bx-cog" aria-hidden="true"></i></span></button></a>
<!-- <a href="#" class="plan_commission" title="click to check config"><i class="bx bx-cog" aria-hidden="true"></i></a> -->
</td>
</tr>


<tr>
<td>Level Commission</td>
<td>
 <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
    <input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" name="level_commission" checked="" onchange="submitSingle(this)">
</div>
</td>
<td>
<a href="{{route('level')}}"><button class="custom-btn btn-12"><span>Click!</span><span>SET&nbsp;&nbsp;<i class="bx bx-cog" aria-hidden="true"></i></span></button></a>

 <!-- <a href="#" class="sponsor_commission" title="click here to check level commision"> <i class="bx bx-cog" aria-hidden="true"></i></a> -->
</td>
</tr>
                                    
<tr>
<td>Rank Commission</td>
<td>
<div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
<input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" name="rank_commission" checked="" onchange="submitSingle(this)">
</div>
</td>
<td>
<a href="{{route('rank_commission')}}"><button class="custom-btn btn-12"><span>Click!</span><span>SET&nbsp;&nbsp;<i class="bx bx-cog" aria-hidden="true"></i></span></button></a>
<!-- <a href="#" class="rank_commission" title="click here to check rank commision"> <i class="bx bx-cog" aria-hidden="true"></i></a> -->
</td>
</tr>

<tr>
 <td>Roi Commission</td>
    <td>
<div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
<input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" name="roi_commission" checked="" onchange="submitSingle(this)">
</div>
</td>
<td>
<a href="{{route('roi_commission')}}"><button class="custom-btn btn-12"><span>Click!</span><span>SET&nbsp;&nbsp;<i class="bx bx-cog" aria-hidden="true"></i></span></button></a>

<!-- <a href="#" class="roi_commission"><i class="bx bx-cog" aria-hidden="true"></i></a> -->
</td>
</tr>

<tr>
<td>Referral Commission</td>
<td>
<div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
<input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" name="referral_commission" checked="" onchange="submitSingle(this)">
</div>

</td>
<td>
<a href="{{route('joining_percentage')}}"><button class="custom-btn btn-12"><span>Click!</span><span>SET&nbsp;&nbsp;<i class="bx bx-cog" aria-hidden="true"></i></span></button></a>
<!-- <a href="#" class="referral_commission"><i class="bx bx-cog" aria-hidden="true"></i> -->
</a>
</td>
</tr>

    <tr>
<td>Matching Bonus</td>
<td>
    
   
    
    
<div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
<input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" value="1" name="matching_bonus" checked="" onchange="submitSingle(this)">
</div>
</td>
<td>
<a href="{{route('matching_bonus')}}"><button class="custom-btn btn-12"><span>Click!</span><span>SET&nbsp;&nbsp;<i class="bx bx-cog" aria-hidden="true"></i></span></button></a>

<!-- <a href="#" class="matching_bonus" title="click to check Matching Bonus"><i class="bx bx-cog" aria-hidden="true"></i> -->
</a>
</td>
</tr>

<tr>
<td>Autopool Bonus</td>
<td>
<div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
<input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" value="1" name="autopool_bonus" checked="" onchange="submitSingle(this)">
</div>
</td>
<td>
<a href="{{route('autopool_bonus')}}"><button class="custom-btn btn-12"><span>Click!</span><span>SET&nbsp;&nbsp;<i class="bx bx-cog" aria-hidden="true"></i></span></button></a>

<!-- <a href="#" class="pool_bonus"><i class="bx bx-cog" aria-hidden="true"></i></a> -->
</td>
</tr>
<tr>
<td>Repurchase Bonus</td>
<td>
<div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
<input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" value="1" name="repurchase_bonus" checked="" onchange="submitSingle(this)">
</div>
</td>
<td>
<a href="{{route('repurchase_bonus')}}"><button class="custom-btn btn-12"><span>Click!</span><span>SET&nbsp;&nbsp;<i class="bx bx-cog" aria-hidden="true"></i></span></button></a>

<!-- <a href="#" class="fast_start_bonus"><i class="bx bx-cog" aria-hidden="true"></i></a> -->
</td>
</tr>
<tr>

<td>Rewards</td>
<td>
<div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
<input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" value="1" name="rewards" checked="" onchange="submitSingle(this)">
</div>

</td>
<td>
<a href="{{route('rewards')}}"><button class="custom-btn btn-12"><span>Click!</span><span>SET&nbsp;&nbsp;<i class="bx bx-cog" aria-hidden="true"></i></span></button></a>

<!-- <a href="#" class="performance_bonus" title="click to check Performance Bonus"> <i class="bx bx-cog" aria-hidden="true"></i></a> -->
</td>
</tr>

<tr>
<td>Level Roi Income</td>
<td>
<div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
<input class="form-check-input" type="checkbox" id="sales_Commission" value="1" name="level_roi_income" checked="" onchange="submitSingle(this)">
</div>
</td>
<td>
<a href="{{route('level_roi_income')}}"><button class="custom-btn btn-12"><span>Click!</span><span>SET&nbsp;&nbsp;<i class="bx bx-cog" aria-hidden="true"></i></span></button></a>

<!-- <a href="#" class="sales_Commission" title="click to check Performance Bonus"> <i class="bx bx-cog" aria-hidden="true"></i></a> -->
</td>
</tr>

<tr>
<td>Cashback Bonus</td>
<td>
<div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
<input class="form-check-input" type="checkbox" id="sales_Commission" value="1" name="cashback_bonus" checked="" onchange="submitSingle(this)">
</div>

</td>
<td>
<a href="{{route('cashback_bonus')}}"><button class="custom-btn btn-12"><span>Click!</span><span>SET&nbsp;&nbsp;<i class="bx bx-cog" aria-hidden="true"></i></span></button></a>

<!-- <a href="#" class="sales_Commission" title="click to check Performance Bonus"> <i class="bx bx-cog" aria-hidden="true"></i></a> -->
</td>
</tr>

<tr>
<td>Matrix Commission</td>
<td>
<div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
<input class="form-check-input" type="checkbox" id="matrix_Commission" value="1" name="matrix_Commission" checked="" onchange="submitSingle(this)">
</div>

</td>
<td>
<a href="{{route('matrix_commission')}}"><button class="custom-btn btn-12"><span>Click!</span><span>SET&nbsp;&nbsp;<i class="bx bx-cog" aria-hidden="true"></i></span></button></a>

<!-- <a href="#" class="sales_Commission" title="click to check Performance Bonus"> <i class="bx bx-cog" aria-hidden="true"></i></a> -->
</td>
</tr>
</tbody>
</table>

        </div>
            </div>
</div>


 </div>
 
 </div>
<!-- new card -->
<div class="col-md-6">
    <!-- <img src="assets/images/newblink.gif">
<p>For New updates <strong>Please</strong><a href="#">&nbsp;Click Here</a></p> -->
</div>
 <!--  -->
 
 </div>

 </div>
            <!-- plan page end -->


        </div>
    </div>
@endsection
