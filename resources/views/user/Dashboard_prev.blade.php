@extends('user.layouts.main')
@section('mains')

<!--start page wrapper -->
<style>
    
    .password-span {
    display: block;  
    word-wrap: break-word; 
    font-size: 16px;  
    padding: 10px;
    background-color: #f9f9f9;
     border: 2px dotted #00acee;
         
    color: black;
    border-radius: 5px;
    margin: 10px 0;
    overflow: hidden;
}

@media (max-width: 600px) {
    .password-span {
        font-size: 14px;  
        padding: 8px;
    }
}

@media (max-width: 400px) {
    .password-span {
        font-size: 12px;  
        padding: 6px;
    }
}

</style>
<style>
    
  

.bg-purple{
    background: #7469e3;
}

.border-purple{
    border-color: #7469e3;
}
.card-text-green{
    color: #7469e3;
}

.bg-green{
    background-color: #5dcf5dad;
}
.card-text-green{
    color: black;
}

.card_bg_1{
    background: #5dcf5dad;
}
.card_bg_2{
    background: #b5afff;
}
.card_bg_3{
    background: #ffa50099;
}
.card_bg_4{
    background: #72eaff7a;
}
.card_bg_5{
    background: #ff70298a;
}
.card_bg_6{
    background: #9cd1ffb5;
}
.small{
    font-size: 18px;
}
 #imageModal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;  /* Center vertically and horizontally */
        }

        #imageModal .modal-content {
            position: relative;
            padding: 0;
            background-color: transparent;
            border: none;
            width: 80%;
            max-width: 500px; /* Maximum width to prevent it from getting too large */
        }

        #imageModal img {
            max-width: 100%;
            height: auto;
            display: block;
            border-radius: 8px; /* Add slight rounding to the image */
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: white;
            font-size: 24px;
            font-weight: bold;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1001;
        }

        .close:hover, .close:focus {
            color: red;
            text-decoration: none;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            #imageModal .modal-content {
                width: 90%; /* Increase width slightly on small screens */
            }

            .close {
                font-size: 20px;
                top: 5px;
                right: 5px;
            }
        }
</style>
<div class="page-wrapper">
 @php
    $banner=DB::table('settings')->where('name','welcome_image')->where('status',"active")->value('value');
    
    @endphp
    @if($banner)
     <div id="imageModal">
        <div class="modal-content"> 
            <span class="close closebtn">&times;</span>
            <img src="{{ Storage::url('app/profileupload/'.$banner)}}" alt="Poster Image" style="max-width:100%; height:auto;">
        </div>
    </div>
    @endif
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-1 row-cols-xl-12">
            @php
            $data = Auth::user();
            @endphp
            <div class="col">
                <div class="container-fluid  mb-4"
                    style=" border-radius:24px; border: 2px solid #00acee;border-radius: 20px;">
                    <div class="row">
                        <div class="col-12 col-xxl-11 mx-auto">
                            <div class="row align-items-center">
                                <div class="col-12 col-md py-1 py-md-1">
                                    <div class="">
                                        <div class="card border-0 theme-blue">
                                            <div class="row align-items-center m-0 p-2">
                                                <div class="col-2">
                                                    @if(!empty(Auth::user()->image))
                                                    <img src="{{ Storage::url('app/profileupload/').Auth::user()->image}}"
                                                        class="user-img" alt="user avatar" style="width:65px;">
                                                    @else
                                                    <img src="{{ Storage::url('app/logo/').DB::table('business_setup')->first()->logo}}"
                                                        class="user-img" alt="user avatar" style="width:65px;">
                                                    @endif
                                                </div>
                                                <div class="col-10" style="text-align: right;">
                                                    <h4 style="color: #00acee;">{{$data->userid }}</h4>
                                                    <p style="font-size: 13px;">{{$data->first_name}}
                                                        {{$data->last_name}}</p>
                                                    <p style="font-size: 13px;"></p>
                                                </div>
                                            </div>
                                            <div class="row align-items-center p-2 text-center">
                                                <div class="col-6">
                                                    <p style="color:black!important;" class="text-secondary small mb-1">
                                                        Join on {{Helper::formatted_date($data->created_at)}}</p>
                                                </div>
                                                <div class="col-6">
                                                    <p style="color:black!important;" class="text-secondary small mb-1">
                                                        @php
                                                        $user_package=DB::table("user_package")->where("user_id",Auth::user()->id)->first();
                                                        @endphp
                                                        Active on: @if(!empty($user_package)){{Helper::formatted_date($user_package->created_at)}}@else <span style='color:red;'>dd-mm-YYYY</span> @endif</p>
                                                </div>
                                            </div>
                                            <div class="row align-items-center p-2 text-center">
                                                <div class="col-12">
                                                    <p class="text-secondary small mb-1">My Referral Link :</p>
                                                </div>
                                                <div class="col-12">

                                                    <span id="pwd_spn" class="password-span">
                                                        <?php echo $_SERVER['SERVER_NAME']; ?>/register?referal=<?php echo $data->userid; ?>
                                                        
                                                    </span>
                                                    <a href="javascript:void(0)" id="cp_btn"
                                                        class="btn btn-primary mt-4">Copy Link<i
                                                            class='lni lni-link'></i></a>
                                                              	<a href="https://wa.me/?text=https://<?php echo $_SERVER['SERVER_NAME']; ?>/register?referal=<?php echo $data->userid; ?>" target='_blank'><i class="lni lni-whatsapp" style='color: green;font-size: 30px;position: relative;left: 9px; top: 10px;'></i></a>
                                                       	<!--<a href="https://t.me/share/url?url=https://<?php echo $_SERVER['SERVER_NAME']; ?>/register?referal=<?php echo $data->userid; ?>" target='_blank'><i class="lni lni-telegram-original" style='color: #269fdb;font-size: 30px;position: relative;left: 9px; top: 10px;'></i></a>-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-auto ml-auto py-3 py-md-5 align-self-center">
                                     <div class="card-header">
						<div class="d-flex align-items-center">
							<div>
							    @php
							     $current_recived_direct=DB::table("income_history")->where("received_user",Auth::user()->id)->where("credit_debit","credit")->where("type","direct")->sum('amount');
                                   $current_recived_level=DB::table("income_history")->where("received_user",Auth::user()->id)->where("credit_debit","credit")->where("type","level")->sum('amount');
                                  $current_recived_roi=DB::table("income_history")->where("received_user",Auth::user()->id)->where("credit_debit","credit")->where("type","roi")->sum('amount');
                                   $current_recived_amount=$current_recived_direct+$current_recived_level+$current_recived_roi;
							    @endphp
								<h6 class="mb-0">Total Income</h6>
							</div>
							<div class="dropdown ms-auto">
							    
								<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">{{Helper::get_currency()}}{{round($current_recived_amount,2)}}
								</a>
							</div>
						</div>
					</div>
					<hr>
                                     <div class="row mb-4 align-items-center">
                                         <div class="col">
                                          <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="col-md-6">
                                @php
                                $data = Auth::user();
                                @endphp


                                <h6 class="my-1 text-secondary">Name:-<span class="my-1 text-info">{{$data->first_name}}
                                        {{$data->last_name}}</span></h6>
                                <h6 class="my-1 text-secondary">ID:-<span class="my-1 text-info">{{$data->userid
                                        }}</span></h6>


                            </div>

                            <div class="row">
                                <img src="{{ Storage::url('app/profileupload/').Auth::user()->image}}" class="user-img"
                                    alt="user avatar" style="height: 85px; width: 87px;">
                            </div>

                            <div class="widgets text-white ms-auto">
                                <i class="bx bx-comment-check"></i>
                                @if(Auth::user()->package_status=='active')
                                <div style="margin-right:25px;margin-top:-20px; background-color:green"
                                    class="widgets-icons-2 rounded-circle color:green text-white ms-auto"><i
                                        style="font-size: 40px; padding-left: 15px; padding-right: 15px;font-weight:bold;"
                                        class="fadeIn animated bx bx-check"></i>
                                </div>

                                @else
                                <div style="margin-right:25px; margin-bottom:1px; background-color:red"
                                    class="widgets-icons-2 rounded-circle text-white ms-auto"><i
                                        style="font-size: 40px; padding-left: 15px; padding-right: 15px;font-weight:bold;"
                                        class="fadeIn animated bx bx-x"></i>
                                </div>
                                @endif
                                <p class="mb-0 text-secondary font-13">Since:- <span class="my-1 text-info">
                                        {{Helper::formatted_date($data->created_at)}}</span></p>
                            </div>
                        </div>
                    </div>

                </div>
                --}}
            </div>
        </div>
       <div class="card-header">
						<div class="d-flex align-items-center">
							<div>
								<h6 class="mb-0">Wallet Summary</h6>
							</div>
							<div class="dropdown ms-auto">
								<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
								</a>
							</div>
						</div>
					</div>
					<hr>
          <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 mb-4 align-items-center">
                                        <div class="col col-md col-lg-auto mnw-100 text-center">
                                            <i class="fadeIn animated bx bx-money rounded-circle mt-3 mb-3"
                                                style="font-size: 2.25rem; color:red!important;"></i>
                                            <h3 class="my-1 text-info mb-0" style="color:red!important;">{{Helper::get_currency()}}{{round(Auth::user()->saving_wallet,2)}}
                                            </h3>
                                      <p style="color:black!important;" class="small text-secondary"><b>Activation Wallet</b></p>
                                        </div>
                                        <div class="col col-md col-lg-auto mnw-100 text-center">

                                            <i class="fadeIn animated bx bx-wallet  text-green rounded-circle mt-3 mb-3"
                                                style="font-size: 2.25rem; color:#228305!important;"></i>
                                            <h3 class="my-1 text-info mb-0">{{Helper::get_currency()}}{{round(Auth::user()->incentive_wallet,2)}}
                                            </h3>
                                            <p style="color:black!important;" class="small text-secondary"><b>Incentive Wallet</b></p>
                                        </div>

                                        <div class="col col-md col-lg-auto mnw-100 text-center">
                                          <i class="fadeIn animated bx bx-wallet  text-green rounded-circle mt-3 mb-3"
                                                style="font-size: 2.25rem; color:#228305!important;"></i>
                                            <h3 class="my-1 text-info mb-0">{{Helper::get_currency()}}{{round(Auth::user()->withdrawl_wallet,2)}}</h3>
                                            <p style="color:black!important;" class="small text-secondary"><b>ROI
                                                    Wallet</b></p>
                                        </div>


                                        <div class="col col-md col-lg-auto mnw-100 text-center">
                                           <i class="fadeIn animated bx bx-wallet  text-green rounded-circle mt-3 mb-3"
                                                style="font-size: 2.25rem; color:#228305!important;"></i>
                                            <h3 class="my-1 text-info mb-0">{{Helper::get_currency()}}{{round(Auth::user()->club_wallet,2)}}</h3>
                                            <p style="color:black!important;" class="small text-secondary"><b>Club
                                                    Wallet</b></p>
                                        </div>
                                        @php
                               
                                        $total_income=
                                        DB::table('income_history')->where('received_user',Auth::user()->id)->sum('profit');
                                       
                                        @endphp
                                        <div class="col col-md col-lg-auto mnw-100 text-center">
                                            <i class="bx bxs-trophy avatar avatar-50 bg-green text-green rounded-circle mt-3 mb-3"
                                                style="font-size: 2.25rem; color:orange!important;"></i>
                                            <h3 class="my-1 text-info mb-0">
                                                
                                                @php
                                                $reward_achieved_user=DB::table("reward_achieved_user")->where("user_id",Auth::user()->id)->orderBy("level_no","DESC")->first();
                                                @endphp
                                                @if(!empty($reward_achieved_user))
                                                  @php 
                                                  $reward_vip=DB::table("reward_vip")->where("id",$reward_achieved_user->level_no)->first();
                                                  @endphp
                                                   <a href="{{route('reward')}}"><span style="color:green;">{{ucfirst($reward_vip->rank_name)}}</span></a>
                                                @else
                                                 <span style="color:red;">Pending</span>
                                                @endif
                                               
                                            </h3>
                                            <p style="color:black!important;" class="small text-secondary"><b>Current Reward</b></p>
                                        </div>
                                    </div>
                 <div class="card-header">
						<div class="d-flex align-items-center">
							<div>
								<h6 class="mb-0">Team Summary</h6>
							</div>
							<div class="dropdown ms-auto">
								<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
								</a>
							</div>
						</div>
					</div>
					<hr>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">


           
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <a href="{{ route('direct-user') }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>

                                    <p class="mb-0 text-secondary">Total Direct</p>
                                    <h4 class="my-1 text-info">{{$total_dairect}}</h4>
                                    <!--<p class="mb-0 font-13">+{{$last_7days_total_dairect}} from last week</p>-->
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                        class="fadeIn animated bx bx-user"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <a href="{{route('total_team')}}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Team</p>
                                    <h4 class="my-1 text-danger">{{$total_team}}</h4>
                                    <!--<p class="mb-0 font-13">+{{$total_count_left_right}}from last week</p>-->
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                        class="bx bxs-group"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
             <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-success">

                    <div class="card-body">
                        <div class="d-flex align-items-center">
                           
                            <div>

                                <p class="mb-0 text-secondary">Total Active</p>
                                <h4 class="my-1 text-success">{{$total_active}}</h4>
                            </div>

                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                    class="fadeIn animated bx bx-trophy"></i>
                            </div>
                           
                        </div>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <a href="{{route('total_team')}}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Inactive</p>
                                   
                                    <h4 class="my-1 text-danger">{{$total_inactive}}</h4>
                                  
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                                    <i class="fadeIn animated bx bx-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div><!--end row-->
                  <div class="card-header">
						<div class="d-flex align-items-center">
							<div>
								<h6 class="mb-0">Income Summary</h6>
							</div>
							<div class="dropdown ms-auto">
								<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
								</a>
							</div>
						</div>
					</div>
					<hr>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
            @php
            $direct_income=DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','direct')->where("credit_debit","credit")->sum('amount');
            $lapsdirect_income=DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','direct')->sum('laps_amount');

            $level_income_first= DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','level')->where('level_no','1')->sum('profit');
            $level_income=
            DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','level')->where('credit_debit','credit')->where('level_no','<>','1')->sum('profit');
            $turn_income=
            DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','reward')->sum('amount');
            $global_income=DB::table('income_history')->where('received_user',Auth::user()->id)->where('income_history.type','=','roi')->where('credit_debit','credit')->sum('amount');
            $lpsglobal_income=DB::table('income_history')->where('received_user',Auth::user()->id)->where('income_history.type','=','roi')->sum('laps_amount');
             
            $autopool_income=
            DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','autopool')->sum('amount');
            $matching_income=
            DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','matching')->sum('amount');
            
             $global_star_profit=
                    DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','global_star')->sum('profit');
            @endphp
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-success">
                    <a href="{{route('direct-income-list')}}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>

                                    <p class="mb-0 text-secondary">Direct Income</p>
                                    <h4 class="my-1 text-success">{{Helper::get_currency()}}<span style="color:green;">{{number_format($direct_income, 2, '.', '')}}</span>/<span style="color:red;">{{number_format($lapsdirect_income, 2, '.', '')}}</span></h4>

                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                    <i class="fadeIn animated bx bx-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-warning">
                    <a href="{{route('level_income')}}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Level Income</p>
                                    <?php  
                                 $level_amount = DB::table('income_history')->where("credit_debit","credit")->where('type','level')->where('received_user', Auth::user()->id)->sum('amount');
                                 $lapslevel_amount = DB::table('income_history')->where('type','level')->where('received_user', Auth::user()->id)->sum('laps_amount');
                                                ?>
                                    <h4 class="my-1 text-warning">{{Helper::get_currency()}}<span style="color:green;">{{number_format($level_amount,2, '.', '')}}</span>/<span style="color:red;">{{number_format($lapslevel_amount,2, '.', '')}}</span></h4>

                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                    <i class="fadeIn animated bx bx-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <a href="{{route('global_star_income')}}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>

                                    <p class="mb-0 text-secondary">ROI Income</p>
                                    <h4 class="my-1 text-info">
                                        {{Helper::get_currency()}}
                                        <span style="color:green;">{{number_format($global_income,2, '.', '')}}</span>/<span style="color:red;">{{number_format($lpsglobal_income,2, '.', '')}}</span>
                                        </h4>

                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                        class="fadeIn animated bx bx-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <a href="{{route('help_send')}}">
                         @php
                                $help_income=
                                DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','club_income')->sum('amount');
                                @endphp
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>

                                    <p class="mb-0 text-secondary">Club Income</p>
                                    <h4 class="my-1 text-danger">${{round($help_income,2)}}</h4>

                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                        class="fadeIn animated bx bx-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
             @php 
                                    $current_recived_direct=DB::table("income_history")->where("received_user",Auth::user()->id)->where("credit_debit","credit")->where("type","direct")->sum('amount');
                                   $current_recived_level=DB::table("income_history")->where("received_user",Auth::user()->id)->where("credit_debit","credit")->where("type","level")->sum('amount');
                                  $current_recived_roi=DB::table("income_history")->where("received_user",Auth::user()->id)->where("credit_debit","credit")->where("type","roi")->sum('amount');
                                   $current_recived_amount=$current_recived_direct+$current_recived_level+$current_recived_roi;
                                   $total_invest_amount2=DB::table("user_package")->where("user_id",Auth::user()->id)->where("status","approved")->sum('amount');
                                   $total_all_limit=$total_invest_amount2;
                                   
                                   @endphp
                                   @if($current_recived_amount>0)
                                   @php
                                   $current_percent=($current_recived_amount*100)/$total_all_limit;
                                   @endphp
                                   @else
                                  @php
                                   $current_percent=0;
                                   @endphp
                                   @endif
           
           
        </div><!--end row-->
                  <div class="card-header">
						<div class="d-flex align-items-center">
							<div>
								<h6 class="mb-0">Investment Summary</h6>
							</div>
							<div class="dropdown ms-auto">
								<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
								</a>
							</div>
						</div>
					</div>
					<hr>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-success">
                    <a href="{{route('activation_fund_history')}}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                   @php $total_invest_amount=DB::table("user_package")->where("user_id",Auth::user()->id)->where("status","approved")->sum('amount'); @endphp
                                    <p class="mb-0 text-secondary">Self Investment</p>
                                    <h4 class="my-1 text-success">{{Helper::get_currency()}} {{$total_invest_amount}}</h4>

                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                    <i class="fadeIn animated bx bx-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-warning">
                    <a href="#">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Team Investment</p>
                                    <h4 class="my-1 text-warning">{{Helper::get_currency()}} {{$total_team_investment}}</h4>

                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                      <i class="fadeIn animated bx bx-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <a href="#">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Power Leg</p>
                                    <h4 class="my-1 text-info">{{Helper::get_currency()}}  {{$powerweekleg['power_leg']}}</h4>

                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
                                      <i class="fadeIn animated bx bx-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <a href="#">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Weaker Leg</p>
                                    <h4 class="my-1 text-danger">{{Helper::get_currency()}} {{$powerweekleg['week_leg']}}</h4>

                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                                      <i class="fadeIn animated bx bx-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div><!--end row-->





    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
var xValues = ["Target Level 300%", "Current Level "+ {{$current_percent}}.toFixed(2)+"%"];
var yValues = [300-{{$current_percent}}.toFixed(2),{{$current_percent}}.toFixed(2)];
var barColors = [
  "#b91d47",
  "#1e7145",
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: false,
      text: "World Wide Wine Production 2018"
    }
  }
});
</script>
<!--end page wrapper -->
<script>
    document.getElementById("cp_btn").addEventListener("click", copy_password);

    function copy_password() {
        var copyText = document.getElementById("pwd_spn");
        var textArea = document.createElement("textarea");
        textArea.value = copyText.textContent;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("Copy");
        textArea.remove();
        $('#copy_refreal').removeClass('hidden');
        $('#copy_refreal').addClass('show');
        setTimeout(function () {
            $('#copy_refreal').removeClass('show');
            $('#copy_refreal').addClass('hidden');

        }, 2000)
    }
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
     $(document).ready(function () {
            // Automatically open modal when page loads
            $('#imageModal').fadeIn();

            // Close Modal
            $('.closebtn').click(function () {
                console.log(123);
                $('#imageModal').fadeOut();
            });

            // Close on outside click
            $(window).click(function (e) {
                if ($(e.target).is('#imageModal')) {
                    $('#imageModal').fadeOut();
                }
            });
        });
</script>
@endsection