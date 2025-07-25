<!doctype html>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@php

$website_theme=DB::table('website_setting')->first();
 

@endphp
<html lang="en" class="{{$website_theme->header_color}} {{$website_theme->sidebar_color}}">

 
    @php
    $business=DB::table('business_setup')->get();
    $data = Auth::user();
    $id=$data->id;
    $user_package=DB::table('user_package')->where('user_id',$id)->where('status',"=",'approved')->exists();
    //$user_product=DB::table('cart_items')->where('user_id',$id)->get();
    $user_product=0;
    //$size=count($user_product);
    $bs=$business[0]->pending_user_all_page_access;
    @endphp
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
      <link rel="icon" href="{{ Storage::url('app/logo/').$business[0]->fav_icon}}" type="image/png" />
	<!--plugins-->
		<link href="{{asset('assets/plugins/notifications/css/lobibox.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
	<link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet"/>
	<!-- loader-->
	<link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet"/>
	<script src="{{asset('assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/dark-theme.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets/css/semi-dark.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets/css/header-colors.css')}}"/>
	<!--sweet alert cdn here-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>@yield('pageTitle',$business[0]->business_name)</title>
</head>

<style>
.logo-icon1 {
    width: 80px;
}
body{
background-color:#f2f2f2;
}

.sidebar-header {
    background-color: transparent;
    border-right: 1px solid #e4e4e400;
    border-bottom: 1px solid rgb(255 255 255 / 15%);
    position: absolute;
}
.sidebar-header {
    width: 250px;
    height: 92px;
    display: flex
;
    align-items: center;
    position: fixed;
    top: 0;
    bottom: 0;
    padding: 0 15px;
    z-index: 5;
    padding-left: 3px;
    background: #fff;
    background-clip: padding-box;
    border-bottom: 1px solid #e4e4e4;
}

.sidebar-wrapper .metismenu {

    margin-top: 82px !important;
    ;
    
}
/* nav menu start  */

    .bottom-navBar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background:#01142B;
            padding: 0px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }
        .nav-linkMenu {
            color: white;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 5px 0;
            transition: 0.3s;
            text-decoration: none;
            font-weight: 500;
          
        }
        .nav-linkMenu i {
            font-size: 25px;
            font-weight: bold;
            margin-bottom:0px;
        }
        .nav-linkMenu:hover, .nav-linkMenu.active {
            color: #ffe5b4;
        }
        /* Cart Badge */
        
        /* Hide on Desktop (Above 1024px) */
        @media (min-width: 1024px) {
            .bottom-navBar {
                display: none !important;
            }
        }
        /* Show Only on Tablet & Mobile */
        @media (max-width: 1023px) {
            .bottom-navBar {
                display: flex;
            }
            .progressView{
                display: none !important;
            }
        }
  .disabled-link {
        pointer-events: none;
        opacity: 0.5;
        color: gray;
    }
  
</style>


<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true" style="background: #01142b !important;">
			<div class="sidebar-header">
			    
			    	@php
                    $isActive = DB::table('user_package')->where('user_id', Auth::user()->id)->where('status','approved')->exists();
                    $blockCheck =  DB::table('user')->where('id',Auth::user()->id)->where('block_withdrawl_wallet',0)->exists();
                    @endphp
                    
                    <!--dd($blockCheck);-->
			<!--<div class="" style="height:20px;">-->
			    
                    <img style="height: 81px; width: 130px; margin-left: 58px; margin-top: -1px;"   src="{{ Storage::url('app/logo/').DB::table('business_setup')->first()->logo}}" class="logo-icon1" alt="logo icon">
				<div>
					<!--<h4 class="logo-text">Dashboard</h4>-->
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
				</div>
			 </div>
			 
			 	 @if($user_package || !$user_package)
                  	<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{route('user-dashboard')}}">
					    <div class="parent-icon"><i class="bx bx-home-alt"></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div> 
						<div class="menu-title">My Profile</div>
					</a>
					<ul>
						<!--<li> <a href="{{route('profile')}}"><i class='bx bx-radio-circle'></i>Profile Info</a>-->
						<!--</li>-->
						<li> <a href="{{route('profile_card')}}"><i class='bx bx-radio-circle'></i>Profile Info</a>
						</li>
						<li> <a href="{{route('welcome_letter')}}"><i class='bx bx-radio-circle'></i>Welcome Letter</a>
						</li>
						<li> <a href="{{route('id-card')}}"><i class='bx bx-radio-circle'></i>ID Card</a>
						</li>
					</ul>
				</li>
				<!--<li class="menu-label">UI Elements</li>-->
				
				<!--<li>-->
				<!--	<a href="#">-->
				<!--		<div class="parent-icon"><i class="lni lni-share"></i>-->
				<!--		</div>-->
				<!--		<div class="menu-title">My Level View</div>-->
				<!--	</a>-->
				<!--</li>-->
				
					<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="fadeIn animated bx bx-money"></i>
						</div>
						<div class="menu-title">Income</div>
					</a>
					<ul>
						<li> <a href="{{route('level_income')}}"><i class='bx bx-radio-circle'></i>Level Income</a>
						</li>
							<li> <a href="{{route('global_star_income')}}"><i class='bx bx-radio-circle'></i>ROI Income</a>
						</li>
						<li> <a href="{{route('direct-income-list')}}"><i class='bx bx-radio-circle'></i>Trading bonus</a>
						</li>
							<li> <a href="{{route('royality_income')}}"><i class='bx bx-radio-circle'></i>Royality Income</a>
						</li>
						<li> <a href="{{route('salary_income')}}"><i class='bx bx-radio-circle'></i>Salary Income</a>
						</li>
							<li> <a href="{{route('reward')}}"><i class='bx bx-radio-circle'></i>Rewards</a>
						</li>
					
						 
					</ul>
				</li>
				
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="lni lni-users"></i>
						</div>
						<div class="menu-title">My Team</div>
					</a>
					<ul>
					   {{-- <li> <a href="/register?referal=<?php echo Auth::user()->userid; ?>"><i class='bx bx-radio-circle'></i>New User ID</a>
						</li>--}}
						<li> <a href="{{route('direct-user')}}"><i class='bx bx-radio-circle'></i>My Direct Referal</a>
						</li>
						<li> <a href="{{route('total_team')}}"><i class='bx bx-radio-circle'></i>My Team</a>
						</li>
					{{--	<li> <a href="{{route('sponser-tree')}}"> <i class="fadeIn animated bx bx-network-chart"></i>Sponser Tree</a>
						</li> 
							<li> <a href="{{route('binary-tree')}}"> <i class="lni lni-vector"></i> Binary Tree</a>
						</li>--}}
					</ul>
				</li>
			
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-repeat"></i>
						</div>
						<div class="menu-title">Activation Area</div>
					</a>
					<ul>
					 <li> <a href="{{route('activate_user')}}"><i class='bx bx-radio-circle'></i>Activate User ID</a></li>
						<!--<li> <a href="#"><i class='bx bx-radio-circle'></i>Activate User ID</a></li>-->
						<li> <a href="{{route('activation_fund_history')}}"><i class='bx bx-radio-circle'></i>Package History</a>
						</li>
					</ul>
				</li>
			    <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-gift"></i>
						</div>
						<div class="menu-title">Lucky draw</div>
					</a>
					<ul>
					<li> <a href="{{route('invest_lottery')}}"><i class='bx bx-radio-circle'></i>Invest in Lucky draw</a></li>
					<li> <a href="{{route('lottery_winner')}}"><i class='bx bx-radio-circle'></i>Winner Of Week</a></li>
					<li> <a href="{{route('luckey.draw.participants')}}"><i class='bx bx-radio-circle'></i>Participants</a></li>
					</ul>
				</li>
			@if($isActive)	
		        <li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="fadeIn animated bx bx-dollar"></i>
						</div>
						<div class="menu-title">Fund Area</div>
					</a>
					<ul>
				<!--<li> <a href="{{route('add_fund')}}" ><i class='bx bx-radio-circle'></i>Add Fund</a>-->
						<!--</li>-->
						<li> <a href="{{$isActive && $blockCheck ? route('ptop_transefer') : '#' }}" ><i class='bx bx-radio-circle'></i>P2P Transfer</a>
						</li>
						<li> <a href="{{$isActive && $blockCheck ? route('transfer_history') : '#' }}" ><i class='bx bx-radio-circle'></i>Transefer History</a>
						</li>
						<!--<li> <a href="{{route('ptop_receive_transfer')}}"><i class='bx bx-radio-circle'></i>Recieved History</a>-->
						<!--</li>-->
						
						<!--<li> <a href="{{route('transfer_history')}}"><i class='bx bx-radio-circle'></i>PTOP Sender Transefer History</a>-->
						<!--</li>-->
						<!--<li> <a href="{{route('ptop_receive_transfer')}}"><i class='bx bx-radio-circle'></i>PTOP Receive Transefer History</a>-->
						<!--</li>-->
						<li> <a href="{{$isActive && $blockCheck ? route('withdrawl_to_fund') : '#' }} "  ><i class='bx bx-radio-circle'></i>P2P Convert</a>
						</li>
						<li> <a href=" {{$isActive && $blockCheck ? route('withdrawl_to_fund_history') : '#' }} " ><i class='bx bx-radio-circle'></i>P2P Convert History</a>
						</li>
				<!--<li> <a href="{{route('withdrawl_history')}}"><i class='bx bx-radio-circle'></i>Withdrawal History</a>-->
						<!--</li>-->
					</ul>
				</li>
			@endif	
			
				
				{{--<li>
					<a href="{{route('products')}}">
						<div class="parent-icon"><i class="lni lni-producthunt"></i>
						</div>
						<div class="menu-title">Products</div>
					</a>
				</li>--}}
				
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="lni lni-wallet"></i>
						</div>
						<div class="menu-title">Withdrawal</div>
					</a>
					<ul>
						<li>  <a href="{{ $isActive && $blockCheck ? route('withdrawl_income') : '#' }}"><i class='bx bx-radio-circle'></i>Withdrawal Request</a>
						</li>
						<li> <a href="{{ $isActive && $blockCheck ? route('withdrawl_history') : '#' }}" ><i class='bx bx-radio-circle'></i>Withdrawal History</a>
						</li>
					</ul>
				</li>
				
				
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="lni lni-wallet"></i>
						</div>
						<div class="menu-title">Messages</div>
					</a>
					<ul>
						<li> <a href="{{route('message')}}"><i class='bx bx-message'></i>My Messages</a>
						</li>
					</ul>
				</li>
				
				
				{{--<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="fadeIn animated bx bx-shopping-bag"></i>
						</div>
						<div class="menu-title">Order History</div>
					</a>
					<ul>
						<li> <a href="{{route('order_history')}}"><i class='bx bx-radio-circle'></i>Joining Order</a>
						</li>
						<li> <a href="{{route('r_order_history')}}"><i class='bx bx-radio-circle'></i>Repurchase Order</a>
						</li>
					
					</ul>
				</li>--}}
				
			{{--	<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="fadeIn animated bx bx-wallet-alt"></i>
						</div>
						<div class="menu-title">Payout</div>
					</a>
					<ul>
						<li> <a href="{{route('mywallet')}}"><i class='bx bx-radio-circle'></i>My Wallet</a>
						</li>
						<li> <a href="{{route('wallet_details')}}"><i class='bx bx-radio-circle'></i>Wallet Details</a>
						</li>
						<li> <a href="#"><i class='bx bx-radio-circle'></i>Payout Details</a>
						</li>
						<li> <a href="{{route('payout_summary')}}"><i class='bx bx-radio-circle'></i>Payout Summary</a>
						</li>
					
					</ul>
				</li>--}}
			<ul>
				<li>
					<a href="https://t.me/BULLFIN007">
						<div class="parent-icon"><i class='bx bxl-telegram'></i>
						</div>
						<div class="menu-title">Telegram Link</div>
					</a>
				</li>
				<li>
					<a href="{{route('support')}}">
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Support</div>
					</a>
				</li>
				
					<li>
					<a href="{{route('logout')}}">
						<div class="parent-icon"><i class="bx bx-log-out-circle"></i>
						</div>
						<div class="menu-title">Logout</div>
					</a>
				</li>
				
			</ul>
			<!--end navigation-->
                 @elseif($bs=='active')
                 	<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{route('user-dashboard')}}">
					    <div class="parent-icon"><i class="bx bx-home-alt"></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				
				{{--	<li>
					<a href="{{route('update_payment_details')}}">
						<div class="parent-icon"><i class="lni lni-producthunt"></i>
						</div>
						<div class="menu-title">Update Payment Details</div>
					</a>
				</li>--}}
				
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div> 
						<div class="menu-title">My Profile</div>
					</a>
					<ul>
					{{--<li> <a href="{{route('profile')}}"><i class='bx bx-radio-circle'></i>Profile Info</a>
						</li>--}}
						<li> <a href="{{route('profile_card')}}"><i class='bx bx-radio-circle'></i>Profile Info</a>
						</li>
						<li> <a href="{{route('welcome_letter')}}"><i class='bx bx-radio-circle'></i>Welcome Letter</a>
						</li>
						<li> <a href="{{route('id-card')}}"><i class='bx bx-radio-circle'></i>ID Card</a>
						</li>
					</ul>
				</li>
				<!--<li class="menu-label">UI Elements</li>-->
				
					<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="fadeIn animate bx bx-money"></i>
						</div>
						<div class="menu-title">Income History</div>
					</a>
					<ul>
						<li> <a href="{{route('direct-income-list')}}"><i class='bx bx-radio-circle'></i>Direct Income</a>
						</li>
						<li> <a href="#"><i class='bx bx-radio-circle'></i>Global Star Income</a>
						<li> <a href="# "><i class='bx bx-radio-circle'></i>C.T.O Income</a>
						</li>
					</ul>
				</li>
				
			 @php
                $user=DB::table("user")->where('id',Auth::user()->id)->first();
            @endphp
           @if($user->company_role=="no")
		 
				@endif
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="lni lni-users"></i>
						</div>
						<div class="menu-title">My Team</div>
					</a>
					<ul>
					 <!--   <li> <a href="#"><i class='bx bx-radio-circle'></i>New User ID</a>-->
						<!--</li>-->
						<li> <a href="{{route('direct-user')}}"><i class='bx bx-radio-circle'></i>My Direct Referal</a>
						</li>
						<li> <a href="{{route('downline')}}"><i class='bx bx-radio-circle'></i>My Downline</a>
						</li>
							<li> <a href="{{route('matrix-tree')}}"><i class='bx bx-radio-circle'></i>matrix-tree</a>
						</li>
					{{--	<li> <a href="{{route('sponser-tree')}}"> <i class="fadeIn animated bx bx-network-chart"></i>Sponser Tree</a>
						</li>  --}}
							 
					</ul>
				</li>
			
				<!--<li>-->
				<!--	<a href="javascript:;" class="has-arrow">-->
				<!--		<div class="parent-icon"><i class="bx bx-repeat"></i>-->
				<!--		</div>-->
				<!--		<div class="menu-title">Activation Area</div>-->
				<!--	</a>-->
				<!--	<ul>-->
				<!--		<li> <a href="{{route('activate_user')}}"><i class='bx bx-radio-circle'></i>Activate User ID</a>-->
				<!--		</li>-->
				<!--		<li> <a href="{{route('activation_fund_history')}}"><i class='bx bx-radio-circle'></i>Package History</a>-->
				<!--		</li>-->
				<!--	</ul>-->
				<!--</li>-->
				
				<!--<li>-->
				<!--	<a class="has-arrow" href="javascript:;">-->
				<!--		<div class="parent-icon"><i class="fadeIn animated bx bx-rupee"></i>-->
				<!--		</div>-->
				<!--		<div class="menu-title">Fund Area</div>-->
				<!--	</a>-->
				<!--	<ul>-->
				<!--		<li> <a href="{{route('add_fund')}}" ><i class='bx bx-radio-circle'></i>Add Fund</a>-->
				<!--		</li>-->
				<!--		<li> <a href="{{route('ptop_transefer')}}"><i class='bx bx-radio-circle'></i>PTOP Transfer</a>-->
				<!--		</li>-->
				<!--		<li> <a href="{{route('transfer_history')}}"><i class='bx bx-radio-circle'></i>PTOP Sender Transefer History</a>-->
				<!--		</li>-->
				<!--		<li> <a href="{{route('ptop_receive_transfer')}}"><i class='bx bx-radio-circle'></i>PTOP Receive Transefer History</a>-->
				<!--		</li>-->
				<!--		<li> <a href="{{route('withdrawl_to_fund')}}"><i class='bx bx-radio-circle'></i>Withdrawl To Fund</a>-->
				<!--		</li>-->
				<!--		<li> <a href="{{route('withdrawl_history')}}"><i class='bx bx-radio-circle'></i>Withdrawl To Fund History</a>-->
				<!--		</li>-->
				<!--	</ul>-->
				<!--</li>-->
				
				<!--<li>-->
				<!--	<a href="{{route('products')}}">-->
				<!--		<div class="parent-icon"><i class="lni lni-producthunt"></i>-->
				<!--		</div>-->
				<!--		<div class="menu-title">Product</div>-->
				<!--	</a>-->
				<!--</li>-->
				
				<!--<li>-->
				<!--	<a class="has-arrow" href="javascript:;">-->
				<!--		<div class="parent-icon"><i class="lni lni-wallet"></i>-->
				<!--		</div>-->
				<!--		<div class="menu-title">Password</div>-->
				<!--	</a>-->
				<!--	<ul>-->
				<!--		<li> <a href="{{route('withdrawl_income')}}"><i class='bx bx-radio-circle'></i>Withdrawl Income</a>-->
				<!--		</li>-->
				<!--		<li> <a href="{{route('withdrawl_request_history')}}"><i class='bx bx-radio-circle'></i>Withdrawl History</a>-->
				<!--		</li>-->
					
				<!--	</ul>-->
				<!--</li>-->
				
				<!--<li>-->
				<!--	<a class="has-arrow" href="javascript:;">-->
				<!--		<div class="parent-icon"><i class="fadeIn animated bx bx-shopping-bag"></i>-->
				<!--		</div>-->
				<!--		<div class="menu-title">Order History</div>-->
				<!--	</a>-->
				<!--	<ul>-->
				<!--		<li> <a href="{{route('order_history')}}"><i class='bx bx-radio-circle'></i>First Order</a>-->
				<!--		</li>-->
				<!--		<li> <a href="{{route('r_order_history')}}"><i class='bx bx-radio-circle'></i>Repurchase Order</a>-->
				<!--		</li>-->
				<!--	</ul>-->
				<!--</li>-->
				
				<!--<li>-->
				<!--	<a class="has-arrow" href="javascript:;">-->
				<!--		<div class="parent-icon"><i class="fadeIn animated bx bx-wallet-alt"></i>-->
				<!--		</div>-->
				<!--		<div class="menu-title">Payout</div>-->
				<!--	</a>-->
				<!--	<ul>-->
				<!--		<li> <a href="{{route('mywallet')}}"><i class='bx bx-radio-circle'></i>My Wallet</a>-->
				<!--		</li>-->
				<!--		<li> <a href="{{route('wallet_details')}}"><i class='bx bx-radio-circle'></i>Wallet Details</a>-->
				<!--		</li>-->
				<!--		<li> <a href="{{route('payout_summary')}}"><i class='bx bx-radio-circle'></i>Payout Summary</a>-->
				<!--		</li>-->
					
				<!--	</ul>-->
				<!--</li>-->
			
				<li>
					<a href="{{route('support')}}">
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Support</div>
					</a>
				</li>
			
				
			
			</ul>
			<!--end navigation-->
                   @else
                   
                  <ul class="metismenu" id="menu">
        			<li>
    					<a href="{{route('welcome')}}">
    						<div class="parent-icon"><i class="lni lni-producthunt"></i>
    						</div>
    						<div class="menu-title">Products</div>
    							<div role="status"> <span class="visually-hidden">Loading...</span>
								</div>
    					</a>
    				</li> 
    				  
        			<li>
        			    
    					<a href="{{route('add_fund')}}">
    						<div class="parent-icon"><i class="fadeIn animated bx bx-rupee"></i>
    						</div>
    						<div class="menu-title">Add Fund</div>
    							<div role="status"><span class="visually-hidden">Loading...</span>
								</div>
    					</a>
    				</li>
		    	</ul>
		     
                   @endif
		
		</div>
		<!--end sidebar wrapper -->
		
		<!--start header -->
	
		<header>
			<div class="topbar d-flex align-items-center" style="background: #01142b !important;">
				<nav class="navbar navbar-expand gap-3">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					@if(session()->get('admin_session'))
					@php
					$admin_tbl=DB::table("user")->where("role","admin")->first();
					@endphp
		<a href="{{ route('admins-login', ['id' => $admin_tbl->userid]) }}" ><button class="btn btn-success">Admin Dashboard</button></a>
		@endif
					  
					  <div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							<li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
								<!--<a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>-->
								<!--</a>-->
							</li>
						 
							    <!--<li class="d-sm-flex">-->
							 
									<!--<a href="{{route('user_cart')}}"><div class="icon-badge position-relative bg-dark me-lg-6"><i class="bx bx-cart align-middle font-22 text-white"></i>-->
    							{{--	@if($size)
    								<!--<span class="alert-count bg-success">{{$size}}</span></div></a>-->
    							   @else
    							   <!--<span class="alert-count bg-danger">{{$size}}</span></div></a>-->
    						 @endif--}}
							<!--</li>-->
							 
								
							<li class="nav-item dropdown dropdown-large">
							<!--<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" data-bs-toggle="dropdown"><span class="alert-count">7</span>-->
								<!--	<i class='bx bx-bell'></i>-->
								<!--</a>-->
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-notifications-list">
									
									</div>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<!--<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">-->
								<!--	<i class='bx bx-shopping-bag'></i>-->
								<!--</a>-->
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-message-list">
									    
									</div>
								</div>
							</li>
							
						</ul>
					</div>
					
					<div class="user-box dropdown px-3">
						<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						     @if(!empty(Auth::user()->image))
                       <img src="{{ Storage::url('app/profileupload/').Auth::user()->image}}" class="user-img" alt="user avatar">
                                    @else
                                     <img src="{{asset('/assets/images/avatars/singapore.png')}}" class="user-img" alt="user avatar">
                                     @endif
							<!--<img src="{{asset('/assets/images/avatars/avatar-2.png')}}" class="user-img" alt="user avatar">-->
							<div class="user-info">
                                <p class="user-name mb-0">{{ $data->first_name }} {{ $data->last_name }}</p>
                                @if ($data->role == 'admin')
                                    <p class="designattion mb-0">Admin</p>
                                @elseif($data->role == 'franchise')
                                    <p class="designattion mb-0">Franchise</p>
                                @else
                                 <p class="designattion mb-0">User</p>
                                @endif
                            </div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
						    	 @if(($bs=='active') && $user_package)
                                   
                                   <li><a href="{{route('profile')}}" class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-user fs-5"></i><span>Edit Profile</span></a>
							</li>
							<li><a href="{{route('user-dashboard')}}" class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
							</li>
						 <li><a href="{{route('forget_transition')}}" class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="fas fa-question-circle"></i><span>Forget Transaction Password</span></a></li> 
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a href="{{route('logout')}}" class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
							</li>
                                   @else
 
                                    <li><a href="{{route('profile')}}" class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-user fs-5"></i><span>Edit Profile</span></a>
                                    	<div class="dropdown-divider mb-0"></div>
							<li><a href="{{route('logout')}}" class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
							</li>
                                  @endif 
						</ul>
					</div>
				</nav>
			</div>
		</header>
		
		
		
		
		