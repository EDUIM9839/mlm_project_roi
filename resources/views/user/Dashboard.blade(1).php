@extends('user.layouts.main')
@section('mains')
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
            max-width: 50%;
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
<style>
       .bgc-1{
        background: #827fff;
    }
    .bgc-2{
        background: #fa5d5d;
    }
    .bgc-3{
        background: #ff7c0f;
    }
    .bgc-4{
        background: #60a0ff;
    }
    .bgc-5{
        background: #313b49;
    }
    .bgc-6{
        background: #00a51c94;
    }
    
    .income-cards i.bx{
        font-size: 54px;
        color: white;
    }
    .income-cards .title{
        font-size: 22px;
        font-weight: 500;
         color : white !important;
    }
    .income-cards .value{
        font-size: 20px;
    }
    .income-cards {
        color : white !important;
    }
    .income-cards .value{
        width: 100%;
        text-align: right;
         color : white !important;
    }
     .image-container{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .image-container img.active{
        border: 4px solid  #6abf60;
    }
    .image-container img{
        height: 100px;
        width: 100px;
        border: 4px solid  #ff9f9f;
        border-radius: 50%;
    }
    
    .image-container .data .name{
        font-size: 16px;
        font-weight: 500;
        width: 100%;
        text-align: right;
        margin-bottom: 5px;
    }
    
    .id-green{
        background: #79a2ff;
    }
    .image-container .data{
        color: #8592a3;
        display: flex;
        align-items: end;
        flex-direction: column;
        justify-content: right;
    }    
    
    .image-container .data .id{
        font-size: 15px;
        font-weight: 400;
        padding: 2px 15px;
        background: #46912a;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 30px;
        color: white;
        width:  fit-content;
        
    }
    .image-container .mini {
        font-size: 15px;
        font-weight: 400;
        padding: 2px 15px;
        background: linear-gradient(45deg, #ff0000, #ff7f00);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 30px;
        color: white;
        border: none;
        width: fit-content;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    .image-container .mini:disabled, 
    .image-container .disabled-btn {
        background: green !important;
        cursor: not-allowed;
        opacity: 0.6;
    }
    
    .image-container .data .id.active{
            background-image: linear-gradient(45deg, #0baf00, #a6ffa1cc);
    }
    .image-container .data .id.inactive{
        background-image: linear-gradient(45deg, #ff0000, #ffbabacc);

    }
    .red-badge{
        background-image: linear-gradient(45deg, #ff0000, #ffbabacc);
        padding: 7px !important;
        font-size: 13px;
    }
    .green-badge{
        background-image: linear-gradient(45deg, #0baf00, #a6ffa1cc);
        padding: 7px !important;
        font-size: 13px;
    }
    
    .card .bottom-data{
        width: 100%;
        height: fit-content;
        display: flex;
    }
    .card .bottom-data .right,
    .card .bottom-data .left{
        width: 50%;
        height: 100%;
        padding: 8px 10px;
    }
    .card .bottom-data .left{
        background: #ff8d00c4;
    }
    .card .bottom-data .right{
        background: #79a2ff;
    }
    .card .bottom-data .head{
        font-size: 19px;
        font-weight: 500;
        color: white;
    }
   
    
    .card .bottom-data .text{
        font-size: 18px;
        font-weight: 600;
         color: white;
    }
    .current-position .text{
        font-size: 15px;
        font-weight: 500;
        color:#6d6d6d ;
            display: flex;
    align-items: center;
    }
    
    .current-position .badge{
        font-size: 17px;
        font-weight: 500;
        
    }
    
    .current-position a{
        cursor: default;
    }
    .referal-fiter{
        height: 50px;
    }
    .referal-fiter .link-area, .referal-fiter a{
        height: 100%;
        min-height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        
    }
    .referal-fiter .link-area{
        width: 80%;
    }
    
    @media(max-width: 500px){
        .link-area{
            font-size: 11px;
        }
    }
    .referal-fiter a{
        width: 10%;
        border-radius: 0px!important;
    }
    
    .referal-fiter .whatsapp{
        background: #24bd24;
    }
    .referal-fiter .whatsapp i{
        font-size: 26px !important;
            padding-left: 2px;
    }
    @media(max-width: 600px){
        .referal-fiter .whatsapp i{
            font-size: 22px !important;
            padding-left: 1px;
        }
    }
    
    .active-check-container i{
            position: absolute;
            left: -40px;
            font-size: 44px;
            top: -12px;
    }
    .active-check-container{
        position: relative;
    }
    
    .progress {
      height: 30px;
    }
    .progress-bar {
      line-height: 30px; /* Centers text vertically */
      color: white;
      font-weight: bold;
    }
    rest-progress-bar{
        min-height: 87%;
    }

.card-header {
    background: #bfa900  !important;
}
.card {
    
    background: #01142b !important;
.whitetd
{
    color: #fff !important;
}

    
</style>
<div class="page-wrapper">
    @php 
        $current_recived_direct=DB::table("income_history")->where("received_user",Auth::user()->id)->where("credit_debit","credit")->where("type","direct")->sum('amount');
        $current_recived_level=DB::table("income_history")->where("received_user",Auth::user()->id)->where("credit_debit","credit")->where("type","level")->sum('amount');
        $current_recived_roi=DB::table("income_history")->where("received_user",Auth::user()->id)->where("credit_debit","credit")->where("type","roi")->sum('amount');
        $current_recived_amount=$current_recived_roi;
        $total_invest_amount2=DB::table("user_package")->where("user_id",Auth::user()->id)->where("status","approved")->where("active_status",1)->sum('amount');
        $total_all_limit=$total_invest_amount2;
    @endphp
    @if($current_recived_amount>0 && $total_invest_amount2 > 0)
        @php
            $current_percent=($current_recived_amount*100)/$total_all_limit;
        @endphp
    @else
        @php
            $current_percent=0;
        @endphp
    @endif
    @php
        $banner=DB::table('settings')->where('name','welcome_image')->where('status',"active")->value('value');
    
    @endphp
    @if($banner && session()->has('login_user_id'))
        <div id="imageModal">
            <div class="modal-content"> 
                <span class="close closebtn">&times;</span>
                <img src="{{ Storage::url('app/profileupload/'.$banner)}}" alt="Poster Image" style="max-width:100%; height:auto;">
            </div>
        </div>
    @endif
    <div class="page-content"style="background: #646489 !important;">
       @if (session()->has('success'))
            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
               <div class="d-flex align-items-center">
                   <div class="font-35 text-white"><i class='bx bxs-message-square-check'></i></div>
                   <div class="ms-3">
                       <div class="text-white">{!! session()->get('success') !!}</div>
                   </div>
               </div>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
       @elseif (session()->has('error'))
           <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
               <div class="d-flex align-items-center">
                   <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i></div>
                   <div class="ms-3">
                       <div class="text-white">{!! session()->get('error') !!}</div>
                   </div>
               </div>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
       @endif
        <div class="card">
		    <div class="card-header bg-gradient-moonlit">
			    <h6 class="mb-0 text-light">Profile Details & Wallet Summary</h6>
		   </div></br>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-12 g-3 px-3">
            @php
            $data = Auth::user();
            @endphp
          	<div class="col">
				<div class="card h-90  radius-10 border-0 bg-gradient-moonlit text-white">
					<div class="card-body h-100">
					    <div class="image-container">
					        <div class="image-box mb-2 ">
					            <img class="{{  $active ? 'active' : '' }}" src="{{ Storage::url('app/profileupload/').(Auth::user()->image ?? 'default-user.png')}}" height="300px;"> </br>
					             <form action="{{ route('bfi_amount_by_user') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="amount" value="{{ $user_package_id }}">
                                
                                    <button type="submit" class="mt-3 mini {{ $alreadyClicked ? 'disabled-btn' : '' }}" 
                                        {{ $alreadyClicked ? 'disabled' : '' }}>
                                        Mine BFI
                                    </button>
                                </form>
					        </div>
				            <div class="data">
				                <div class="name text-white ">{{ $data->first_name }} {{$data->last_name}}  
        				            <!--<span style="font-size:20px;">-->
                                    <!-- @if($active)-->
                                    <!-- <i class='bx bx-check-circle text-success'></i>-->
                                    <!-- @else-->
                                    <!--<i class='bx bx-x-circle text-danger'></i>-->
                                    <!--  @endif-->
                                    <!--</span>-->
                                </div>
				                <div class="id mb-s {{ $active ? 'active' : 'inactive' }}">{{ $data->userid }} </div>
				                <div class="mt-2 small mb-1 text-white"><b>Since :</b>  {{Helper::formatted_date($data->created_at)}}</div>
        				           {{-- <div class="kyc_status"><b>KYC Status :</b> 
        				            	@if($data->document_status != 'unverified')
        				                    <span class="badge bg-success green-badge px-2 py-1" style="font-weight: 100;">Active</span>
        				                @else
        				                 <span class="badge bg-danger red-badge px-2 py-1" style="font-weight: 100;">Inactive</span>
        				                @endif
        				            </div>--}}
				                <p class="text-white  small mb-1">
                                    @php
                                    $user_package=DB::table("user_package")->where("user_id",Auth::user()->id)->where('active_status',1)->first();
                                    @endphp
                                    <b> Active on: </b> @if(!empty($user_package)){{Helper::formatted_date($user_package->created_at)}}@else <span style='color:#ff8a8a;'>dd-mm-YYYY</span> @endif
                                </p>
                                 @php
                                    $user_package_funded=DB::table("user_package")->where("user_id",Auth::user()->id)->where('active_status',0)->first();
                                    
                                    $isShow = (new \DateTime(Auth::user()->created_at))->modify('+3 days')->format('Y-m-d H:i:s') >= date('Y-m-d H:i:s') ? true : false;
 
                                    @endphp
                                @if(!empty($user_package_funded) && $isShow)
				                <p class="text-white  small mb-1">
				                    <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <span class="spinner-grow spinner-grow-sm text-danger" role="status" aria-hidden="true"></span>
                                            Please Click To Pay Funded wallet 
                                     </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pay</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                  <h5>Fund Wallet Amount: $ {{Auth::user()->saving_wallet}}</h5>
                                                <form action="{{route('pay_fundded_amount_by_user')}}" method="post">
                                                    @csrf
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                        <input type="number" class="form-control" value="100" readonly name='amount'>
                                                   </div>
                                                     <button type="submit" class="btn btn-primary">Submit</button>                                       
                                                </form>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                </p>
                                @else
                                
                                <div class="d-flex align-items-center justify-content-between">
                                        <button type="button" class="btn btn-success"> Total Investment : 
                                        @if($isShow)
                                            {{Helper::get_currency()}} {{ DB::table('user_package')->where('user_id', Auth::user()->id)->sum('amount') }}
                                        @else
                                            {{Helper::get_currency()}} {{ DB::table('user_package')->where('user_id', Auth::user()->id)->where('active_status','!=', 0)->sum('amount') }}
                                         @endif
                                        </button>
                                   
                                       
                                   </div>
                                @endif
                                
                                
				            </div>
					    </div>
					</div>
				{{-- <div class="bottom-data">
                <div class="col-12">
                    <div class=" px-2 ">
					    <div class=" w-60 text-center text-white">
                                <strong style="font-size:12px;" >Current Progress:</strong> <span id="current-percent-text">0</span>%
                                <strong  style="font-size:12px;"> / Target: 300%</strong>
                              </div>
         
                            <div class="progress mt-1   text-bg-light-danger" role="progressbar" style="max-height: 13px;" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                              <div id="current-progress-bar" class="progress-bar" style="width: 0%; max-height: 20px;background: #b5ff9dc4;color: green;"> 0%</div>
                              <div id="rest-progress-bar" class="progress-bar" style="width: 100%; max-height: 20px;background: #ff8e8e66; color: #ff3434;"> 0%</div>
                            </div>
					 </div>
                    
                    
                    
                    
                    <p class="text-secondary mb-1" style="text-align:center"><b>My Referral Link</b></p>
                    <div class="col-12 text-center">
                        <div class="d-flex align-items-center ms-4">
                            <span  class="link-area" >
                               <span class='text-light'>Referal Link -  <?php echo $_SERVER['SERVER_NAME']; ?>/register?referal=<?php echo $data->userid; ?> </span></span> 
                            </span>
                           
                                <a href="javascript:void(0)" id="cp_btn" class="btn btn-sm ml-2 px-2 text-white" style="">
                                <i class='bx bx-copy m-0' id="copy-icon" style="font-size: 25px;"></i>
                            </a>
                            
                          
                                <a class="whatsapp px-2" href="https://wa.me/?text=https://<?php echo $_SERVER['SERVER_NAME']; ?>/register?referal=<?php echo $data->userid; ?>" target='_blank'>
                                <i class="lni lni-whatsapp m-0" style='color: white;font-size: 22px;padding-left: 1px;color:green'></i>
                            </a>
                           
                        </div>
                    </div>
                </div>
            </div> --}}

				</div>
			</div>
			<div class="col">
	            <div class="card h-90 radius-10 bg-gradient-moonlit text-white">
                    <div class="card-body">
                        <div class="card-info">
                            <!--<canvas id="myChart" style="width:100%;max-width:300px"></canvas>-->
                            <div class="bottom-data">
                                <div class="col-12 p-1">
                                    
                					    <div class="w-60 text-center text-white">
                                            <strong style="font-size:14px;" >Current Progress:</strong> <span id="current-percent-text">0</span>%
                                                <strong  style="font-size:14px;"> / Target: 300%</strong>
                                        </div>
                                        <div class="progress mt-1   text-bg-light-danger" role="progressbar" style="max-height: 13px;" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                            <div id="current-progress-bar" class="progress-bar" style="width: 0%; max-height: 20px;background: #b5ff9dc4;color: green;"> 0%</div>
                                            <div id="rest-progress-bar" class="progress-bar" style="width: 100%; max-height: 20px;background: #ff8e8e66; color: #ff3434;"> 0%</div>
                                        </div>
                					
                                    <p class="text-secondary my-2 text-white"><b>My Referral Link</b></p>
                                    <div class="col-12 text-center">
                                        <div class="d-flex ">
                                           <span class="link-area">
                                                    <span class='text-light'>Referral Link -</span>  
                                                    <span id="referral-link"><?php echo $_SERVER['SERVER_NAME']; ?>/register?referal=<?php echo $data->userid; ?></span>
                                                </span>
                                           <a href="javascript:void(0)" id="cp_btn" class="btn btn-sm ml-2 text-white">
                                                    <i class='bx bx-copy mb-2' id="copy-icon" style="font-size: 25px;"></i>
                                                </a>
                                                
                                            <a class="whatsapp px-2" href="https://wa.me/?text=https://<?php echo $_SERVER['SERVER_NAME']; ?>/register?referal=<?php echo $data->userid; ?>" target='_blank'>
                                                <i class="lni lni-whatsapp m-0" style='color: white;font-size: 22px;padding-left: 1px;color:green'></i>
                                            </a>
                                        </div>
                                    </div>
                                    
                                   <div class="d-flex align-items-center justify-content-between">
                                        <button type="button" class="btn btn-outline-success"> Withdrawal Wallet : {{Helper::get_currency()}} {{ Auth::user()->withdrawl_wallet }}</button>
                                        <button type="button" class="btn btn-outline-success"> Activation Wallet : {{Helper::get_currency()}} {{ Auth::user()->saving_wallet }}</button>
                                       
                                   </div>
                                        
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
	        </div>
        </div>
        </br>
        </div>
                
				
        
    <div class="card">
		<div class="card-header bg-gradient-ibiza">
			 <h6 class="mb-0 text-light">Team Summary</h6>
		 </div></br>
		<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 px-3">

            <div class="col">
				<div class="card radius-10 bg-gradient-deepblue">
    				<a href="{{ route('direct-user') }}">   
    				    <div class="card-body">
    				        <div class="d-flex align-items-center">
    					        <div>
    					            <h6 class="mb-1 text-white">Total Direct</h6>
    						        <h5 class="mb-0 text-white">{{$total_dairect}}</h5>
    					        </div>
    						    <div class="ms-auto">
                                    <i class='bx bx-user fs-3 text-white'></i>
    						    </div>
    					    </div>
    					     
    				    </div>
    				</a>
    			</div>
			</div> 
            
           
            	<div class="col">
				<div class="card radius-10 bg-gradient-moonlit">
				    <a href="{{route('total_team')}}">
				        <div class="card-body">
					        <div class="d-flex align-items-center">
					            <div>
    					            <h6 class="mb-1 text-white">Total Team</h6>
    						        <h5 class="mb-0 text-white">{{$total_team}}</h5>
    					        </div>
						
						        <div class="ms-auto">
                                    <i class='bx bx-group fs-3 text-white'></i>
						        </div>
					        </div>
				        </div>
				    </a>
			    </div>
			</div>
            
            
            	<div class="col">
				<div class="card radius-10 bg-gradient-ohhappiness">
				        <div class="card-body">
					        <div class="d-flex align-items-center">
					            <div>
    					            <h6 class="mb-1 text-white">Active Team</h6>
    						        <h5 class="mb-0 text-white">{{$total_active}}</h5>
    					        </div>
						<div class="ms-auto">
                            <i class='bx bx-user-check fs-3 text-white'></i>
						</div>
					     </div>
				  </div>
			  </div>
			</div>
            
            
            <div class="col">
				<div class="card radius-10 bg-gradient-ibiza">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<div>
    					    <h6 class="mb-1 text-white">Inactive Team</h6>
    						 <h5 class="mb-0 text-white">{{$total_inactive}}</h5>
    					</div>
						<div class="ms-auto">
                            <i class='bx bx-user-minus fs-3 text-white'></i>
						</div>
					</div>
				</div>
			 </div>
			</div>
            </div>
        </div><!--end row-->
   
            @php
            $direct_income=DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','direct')->where("credit_debit","credit")->sum('amount');
            $lapsdirect_income=DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','direct')->sum('laps_amount');
            $trading_bonus_income=DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','trading_bonus')->where("credit_debit","credit")->sum('amount');
            $laps_trading_bonus_income=DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','trading_bonus')->sum('laps_amount');

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
            {{-- <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-success">
                    <a href="{{route('direct-income-list')}}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Direct Income</p>
                                    <h4 class="my-1 ">{{Helper::get_currency()}}<span>{{number_format($direct_income, 2, '.', '')}}</span>
                                    /<span>{{number_format($lapsdirect_income, 2, '.', '')}}</span>
                                    </h4>
                            
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
                                       
                                        <span style="color:green;"> {{Helper::get_currency()}}{{number_format($global_income,2, '.', '')}}</span>/<span style="color:red;">{{number_format($lpsglobal_income,2, '.', '')}}</span>
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
           
           
           
        </div><!--end row-->--}}
        
            <div class="card">
			<div class="card-header bg-gradient-ohhappiness">
			  <h6 class="mb-0 text-light">Income Summary</h6>
			</div></br>
        
        	<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 px-3">
        		    
		    	<div class="col">
				<div class="card radius-10 bg-gradient-ohhappiness">
				      <a href="{{route('level_income')}}">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<div>
    					   <h6 class="mb-1 text-white">Level Income</h6>
    					     <?php  
                                 $level_amount = DB::table('income_history')->where("credit_debit","credit")->where('type','level')->where('received_user', Auth::user()->id)->sum('amount');
                                 $lapslevel_amount = DB::table('income_history')->where('type','level')->where('received_user', Auth::user()->id)->sum('laps_amount');
                                                ?>
    					   <h4 class="my-1 text-white">{{Helper::get_currency()}}{{number_format($level_amount,2, '.', '')}}</h4>
    					</div>
						<div class="ms-auto">
                            <i class='bx bxs-wallet fs-3 text-white'></i>
						</div>
					</div>
					<div class="d-flex align-items-center text-white">
						<p class="mb-0 font-13 text-white">Lapsed : {{Helper::get_currency()}} {{number_format($lapslevel_amount, 2, '.', '')}}</p>
					
					</div>
				</div>
				</a>
			 </div>
			</div>
		    	<div class="col">
				<div class="card radius-10 bg-gradient-ohhappiness">
				      <a href="{{route('global_star_income')}}">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<div>
    					   <h6 class="mb-1 text-white">ROI Income</h6>
    					    
    					   <h4 class="my-1 text-white">{{Helper::get_currency()}} {{number_format($global_income,2, '.', '')}}</h4>
    					</div>
						<div class="ms-auto">
                            <i class='bx bxs-wallet fs-3 text-white'></i>
						</div>
					</div>
					<div class="d-flex align-items-center text-white">
						<p class="mb-0 font-13 text-white">Lapsed : {{Helper::get_currency()}} {{number_format($lpsglobal_income, 2, '.', '')}}</p>
					
					</div>
				</div>
				</a>
			 </div>
			</div>
			    <div class="col">
				    <div class="card radius-10 bg-gradient-ohhappiness">
				        <a href="{{route('direct-income-list')}}">
				        <div class="card-body">
					        <div class="d-flex align-items-center">
					            <div>
    					            <h6 class="mb-1 text-white">Trading Bonus Income</h6>
    					            <h4 class="my-1 text-white">{{Helper::get_currency()}}{{number_format($trading_bonus_income, 2, '.', '')}}</h4>
    					        </div>
        						<div class="ms-auto">
                                    <i class='bx bxs-wallet fs-3 text-white'></i>
        						</div>
					        </div>
        					<div class="d-flex align-items-center text-white">
        						<p class="mb-0 font-13 text-white">Lapsed : {{Helper::get_currency()}} {{number_format($laps_trading_bonus_income, 2, '.', '')}}</p>
        						<!--<p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>-->
        					</div>
				        </div>
				        </a>
			        </div>
			    </div>
			     <div class="col">
				    <div class="card radius-10 bg-gradient-ohhappiness">
				        
				        <div class="card-body">
					        <div class="d-flex align-items-center">
					            <div>
    					            <h6 class="mb-1 text-white">Mining Income</h6>
    					            <h4 class="my-1 text-white">Token {{number_format($bfi_amount, 2, '.', '')}}</h4>
    					        </div>
        						<div class="ms-auto">
                                    <i class='bx bxs-wallet fs-3 text-white'></i>
        						</div>
					        </div>
        					<div class="d-flex align-items-center text-white">
        						<p class="mb-0 font-13 text-white">BFI Percent : {{$bfi_percent}} %</p>
        					</div>
				        </div>
				        
			        </div>
			    </div>
			    
		    </div>
		    </div>
		  
		     <div class="card">
			<div class="card-header bg-gradient-deepblue">
			  <h6 class="mb-0 text-light">Income Summary & Legs</h6>
			</div></br>
        
        	 <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 px-3">
		  
		    	<div class="col">
				<div class="card radius-10 bg-gradient-deepblue">
				      <a href="{{route('royality_income')}}">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<div>
    					   <h6 class="mb-1 text-white">Royality Income</h6>
    					     @php
                            $royality_income= DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','royality')->sum('amount');
                            @endphp
    					   <h4 class="my-1 text-white">{{Helper::get_currency()}} {{round($royality_income,2)}}</h4>
    					</div>
						<div class="ms-auto">
                            <i class='bx bxs-wallet fs-3 text-white'></i>
						</div>
					</div>
					<div class="d-flex align-items-center text-white">
					
					</div>
				</div>
				</a>
			 </div>
			</div>
		    
		    
		    	<div class="col">
				<div class="card radius-10 bg-gradient-moonlit">
				      <a href="{{route('reward')}}">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<div>
    					   <h6 class="mb-1 text-white">Reward Income</h6>
    					     @php
                            $reward_income=DB::table('income_history')->where('received_user',Auth::user()->id)->where('type','reward')->sum('amount');
                            @endphp
    					   <h4 class="my-1 text-white">{{Helper::get_currency()}} {{round($reward_income,2)}}</h4>
    					</div>
						<div class="ms-auto">
                            <i class='bx bxs-wallet fs-3 text-white'></i>
						</div>
					</div>
					<div class="d-flex align-items-center text-white">
					
					</div>
				</div>
				</a>
			 </div>
			</div>
			 <div class="col">
				<div class="card radius-10 bg-gradient-ohhappiness">
				      <a href="{{ route('powerLeg') }}">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<div>
    					   <h6 class="mb-1 text-white">Power Leg</h6>
    					   
    					   <h4 class="my-1 text-white">{{Helper::get_currency()}}  {{$powerweekleg['power_leg']}}</h4>
    					</div>
						<div class="ms-auto">
                            <i class='bx bxs-wallet fs-3 text-white'></i>
						</div>
					</div>
					<div class="d-flex align-items-center text-white">
					
					</div>
				</div>
				</a>
			 </div>
			</div>
          
        
         <div class="col">
				<div class="card radius-10 bg-gradient-ibiza ">
				      <a href="{{ route('weakerLeg') }}">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<div>
    					   <h6 class="mb-1 text-white">Weaker Leg</h6>
    					   
    					   <h4 class="my-1 text-white">{{Helper::get_currency()}} {{$powerweekleg['week_leg']}}</h4>
    					</div>
						<div class="ms-auto">
                            <i class='bx bxs-wallet fs-3 text-white'></i>
						</div>
					</div>
					<div class="d-flex align-items-center text-white">
					
					</div>
				</div>
				</a>
			 </div>
			</div>
			
		   </div>
		</div>
        
        
        
          
                 {{-- <div class="card-header">
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
					<hr>--}}
		 <div class="card">
		   <div class="card-header bg-gradient-moonlit">
			 <h6 class="mb-0 text-light">Investments </h6>
		   </div></br>
		   
   @php
   
    $isShow = (new \DateTime(Auth::user()->created_at))->modify('+3 days')->format('Y-m-d H:i:s') >= date('Y-m-d H:i:s') ? true : false;
   @endphp
		    
		    	<div class="row row-cols-1 row-cols-md-{{ $isShow ? '3' : '2' }} px-3">
   
            
            <div class="col">
				<div class="card radius-10 bg-gradient-moonlit">
				      <a href="{{route('activation_fund_history')}}">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<div>
    					   <h6 class="mb-1 text-white">Self Investment</h6>
    					      @php
                                    $total_invest_amount=DB::table("user_package")->where("user_id",Auth::user()->id)->where("status","approved")->sum('amount'); 
                                   
                                    $startOfMonth = (new DateTime())->modify('first day of this month')->setTime(0, 0, 0);
                                  
                                    $total_invest_amount_monthly = DB::table("user_package")
                                    ->where("user_id", Auth::user()->id)
                                    ->where("status", "approved")
                                    ->where("activated_date", ">=", $startOfMonth)
                                    ->sum('amount');

                                   
                                    
                                    @endphp
    					   <h4 class="my-1 text-white">{{Helper::get_currency()}} {{ ($isShow ? 100 : 0) + $total_invest_amount}} 
    					  @if($isShow) <sup class="text-warning" style="font-size: 10px; position: relative; top: -14px;left: -4px;">(100 Bonus)</sup>
    					   </h4>
    					   @endif
    					   
    					</div>
						<div class="ms-auto">
                            <i class='bx bxs-wallet fs-3 text-white'></i>
						</div>
					</div>
					<div class="d-flex align-items-center text-white">
					 <p class="mb-0 font-13 text-white">{{Helper::get_currency()}}{{$total_invest_amount_monthly}} from this month </p>
					</div>
				</div>
				</a>
			 </div>
			</div>
			
			@if($isShow)
			 <div class="col">
				<div class="card radius-10 bg-gradient-moonlit">
				      <a href="{{route('activation_fund_history')}}">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<div>
    					   <h6 class="mb-1 text-white">Bonus Amount</h6>
    					      @php
                                    $total_invest_amount=DB::table("user_package")->where("user_id",Auth::user()->id)->where("status","approved")->sum('amount'); 
                                   
                                    $startOfMonth = (new DateTime())->modify('first day of this month')->setTime(0, 0, 0);
                                  
                                    $total_invest_amount_monthly = DB::table("user_package")
                                    ->where("user_id", Auth::user()->id)
                                    ->where("status", "approved")
                                    ->where("activated_date", ">=", $startOfMonth)
                                    ->sum('amount');

                                    
                                    @endphp
    					   <h4 class="my-1 text-white">{{Helper::get_currency()}} 100</h4>
    					</div>
						<div class="ms-auto">
                            <i class='bx bxs-wallet fs-3 text-white'></i>
						</div>
					</div>
					<div class="d-flex align-items-center text-white">
					 <p class="mb-0 font-13 text-white"> Bonus for 3 days </p>
					</div>
				</div>
				</a>
			 </div>
			</div>
            
            @endif  
            
            <div class="col">
				<div class="card radius-10 bg-gradient-moonlit">
				      <a href="#">
				 <div class="card-body">
					<div class="d-flex align-items-center">
						<div>
    					   <h6 class="mb-1 text-white">Team Investment</h6>
    					   
    					   <h4 class="my-1 text-white">{{Helper::get_currency()}} {{$total_team_investment}}</h4>
    					</div>
						<div class="ms-auto">
                            <i class='bx bxs-wallet fs-3 text-white'></i>
						</div>
					</div>
					<div class="d-flex align-items-center text-white">
					 <p class="mb-0 font-13 text-white" style="color: #ff6035 ;">{{Helper::get_currency()}}{{$total_team_investment_monthly}} from this month </p>
					</div>
				</div>
				</a>
			 </div>
			</div>
            
            
         
          
       </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script>
    document.getElementById("cp_btn").addEventListener("click", function() {
        
        var referralLink = document.getElementById("referral-link").innerText;

        var tempInput = document.createElement("input");
        tempInput.value = referralLink;
        document.body.appendChild(tempInput);

        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // For mobile compatibility
        document.execCommand("copy");

        document.body.removeChild(tempInput);

        var copyIcon = document.getElementById("copy-icon");
        copyIcon.classList.remove("bx-copy");
        copyIcon.classList.add("bx-check");

        setTimeout(() => {
            copyIcon.classList.remove("bx-check");
            copyIcon.classList.add("bx-copy");
        }, 2000);

        // alert("Referral link copied to clipboard!");
    });
</script>

<script>
  $(document).ready(function() {
    // Example dynamic current percentage (replace this with actual dynamic data from server or script)
    var currentPercent = {{$current_percent}};  // Dynamic value passed from server
    var targetPercent = 300;                    // Target is fixed at 300%

    // Calculate the width of the current progress bar based on the current percentage
    var currentProgressWidth = (currentPercent / targetPercent) * 100;

    // Update the current progress bar width, text, and accessibility attributes
    $("#current-progress-bar")
      .css("width", currentProgressWidth + "%")         // Set the width based on current percentage
      .text(currentPercent.toFixed(2) + "%")            // Display the current percentage inside the bar
      .attr("aria-valuenow", currentPercent.toFixed(2)); // Update aria-valuenow for accessibility
   
   var restProgressWidth = ((targetPercent - currentPercent) / targetPercent) * 100;
    $("#rest-progress-bar")
      .css("width", (restProgressWidth) + "%")         // Set the width based on current percentage
      .text((targetPercent - currentPercent).toFixed(2) + "%")            // Display the current percentage inside the bar
      .attr("aria-valuenow", (targetPercent - currentPercent).toFixed(2)); // Update aria-valuenow for accessibility

    // Update the displayed current value text (outside of the progress bar)
    $("#current-percent-text").text(currentPercent.toFixed(2));
    $("#rest-percent-text").text((targetPercent - currentPercent).toFixed(2));
  });
</script>

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
        
        document.querySelector("#copy-icon").classList.remove('bx-copy');
        document.querySelector("#copy-icon").classList.add('bx-check-circle');
        setTimeout(function () {
            $('#copy_refreal').removeClass('show');
            $('#copy_refreal').addClass('hidden');
            document.querySelector("#copy-icon").classList.remove('bx-check-circle');
            document.querySelector("#copy-icon").classList.add('bx-copy');

        }, 1000)
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