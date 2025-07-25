@php
$website_theme=DB::table('website_setting')->first();
@endphp
<html lang="en" class="{{$website_theme->header_color}} {{$website_theme->sidebar_color}}">
 
 @php
    $business=DB::table('business_setup')->get();
    
    @endphp
    

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
      <link rel="icon" href="{{ Storage::url('app/logo/').$business[0]->fav_icon}}" type="image/png" />


	<!--plugins-->
     <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
	<link href="{{asset('assets/plugins/notifications/css/lobibox.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{asset('assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/dark-theme.css')}}" />
	<link rel="stylesheet" href="{{asset('assets/css/semi-dark.css')}}" />
	<link rel="stylesheet" href="{{asset('assets/css/header-colors.css')}}" />
 	<link rel="stylesheet" href="{{asset('assets/css/jsconfirmation.css')}}" />
    	
    <!--sweet alert cdn here-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{asset('/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
 
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" >
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
   
    <script src="{{asset('assets/js/jsconfirmation.js')}}"></script>
   
    
    
 
    <title>@yield('pageTitle',$business[0]->business_name)</title>
</head>
@php
    $data = Auth::user();
   
@endphp
<style>
.logo-icon1 {
    width: 45px;
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
</style>
<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
	 <div class="sidebar-wrapper" data-simplebar="true" style="background: #01142b !important;">
            <div class="sidebar-header">
                    <img style="height: 81px; width: 130px; margin-left: 58px; margin-top: -1px;"   src="{{ Storage::url('app/logo/').DB::table('business_setup')->first()->logo}}" class="logo-icon1" alt="logo icon">
                    
				<div>
					<!--<h4 class="logo-text">Dashboard</h4>-->
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
				</div>
			 </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{route('dashboard')}}">
                        <div class="parent-icon"><i class='bx bx-home-alt'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                
                
                
      <!--          <li>-->
      <!--          <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
                    
                    
      <!--              <div class="parent-icon"><i class='bx bx-user-circle'></i>-->
						<!--</div>-->
						<!--<div class="menu-title">E-commerce</div>-->
      <!--              </a>-->
      <!--              <ul>-->
                        
      <!--              <li>-->
                        
      <!--                  <li>-->
      <!--                      <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
      <!--                          <div class="parent-icon"><i class='bx bx-radio-circle'></i></div>-->
      <!--                          <div class="menu-title"> Franchise</div>-->
      <!--                      </a>-->
                            
      <!--                      <ul>-->
      <!--                          <li><a   href="{{ route('add-franchise') }}"> <i class='bx bx-radio-circle'></i> Add Franchise</a></li>-->
      <!--                          <li><a   href="{{route('franchise-list')}}"><i class='bx bx-radio-circle'></i>Franchise List</a></li>-->
      <!--                      </ul>-->
                        
      <!--                  </li>-->
                        
      <!--                  <li>-->
      <!--                      <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
      <!--                          <div class="parent-icon"><i class='bx bx-grid-horizontal'></i></div>-->
      <!--                          <div class="menu-title"> Category</div>-->
      <!--                      </a>-->
      <!--                      <ul>-->
      <!--                      <li><a   href="{{ route('add-category') }}"> <i class='bx bx-radio-circle'></i>Add Category</a></li>-->
      <!--                      <li><a   href="{{ route('category-list') }}"><i class='bx bx-radio-circle'></i> Category List</a></li>-->
                            
      <!--                      </ul>-->
                            
      <!--                  </li>-->
                        
      <!--                  <li>-->
      <!--                      <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
      <!--                      <div class="parent-icon"><i class='bx bx-grid-small'></i>-->
      <!--                      </div>-->
      <!--                      <div class="menu-title"> Sub-Category</div>-->
      <!--                      </a>-->
      <!--                      <ul>-->
      <!--                      <li><a   href="{{ route('add-subcategory') }}"> <i class='bx bx-radio-circle'></i>Add  Sub Category</a></li>-->
      <!--                      <li><a   href="{{ route('subcategory-list') }}"><i class='bx bx-radio-circle'></i> SubCategory List</a></li>-->
      <!--                      </ul>-->
      <!--                  </li>-->
                        
      <!--                  <li>-->
                            
      <!--                      <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
      <!--                          <div class="parent-icon"><i class='lni lni-producthunt'></i>-->
      <!--                          </div>-->
      <!--                          <div class="menu-title"> Product</div>-->
      <!--                      </a>-->
                            
      <!--                      <ul>-->
      <!--                          <li><a   href="{{ route('add-product') }}"> <i class='bx bx-radio-circle'></i>Add Product</a></li>-->
      <!--                          <li><a   href="{{ route('product-list') }}"><i class='bx bx-radio-circle'></i>Product List</a></li>-->
      <!--                      </ul>-->
                        
      <!--                  </li>-->
                        
      <!--                  <li>-->
      <!--                      <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
      <!--                      <div class="parent-icon"><i class='bx bx-grid-small'></i>-->
      <!--                      </div>-->
      <!--                      <div class="menu-title">Purchase</div>-->
      <!--                      </a>-->
      <!--                      <ul>-->
      <!--                      <li><a   href="{{ route('create_repurchase_order') }}"> <i class='bx bx-radio-circle'></i>New Purchase</a></li>-->
      <!--                      </ul>-->
                            
      <!--                  </li>-->

      <!--                   <li>-->
      <!--                      <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
      <!--                      <div class="parent-icon"><i class='bx bx-grid-small'></i>-->
      <!--                      </div>-->
      <!--                      <div class="menu-title">Stock</div>-->
      <!--                      </a>-->
      <!--                      <ul>-->
      <!--                  <li>-->
      <!--                      <a href="{{route('stock_transfer')}}">-->
      <!--                      <div class="parent-icon"> <i class='bx bx-radio-circle'></i>-->
      <!--                      </div>-->
      <!--                      <div class="menu-title">Stock Transfer</div>-->
      <!--                      </a>-->
      <!--                  </li>-->
      <!--                  <li>-->
      <!--                      <a href="{{route('Stock_Transfer_List')}}">-->
      <!--                      <div class="parent-icon"> <i class='bx bx-radio-circle'></i>-->
      <!--                      </div>-->
      <!--                      <div class="menu-title">Stock&nbsp;Transfer&nbsp;List</div>-->
      <!--                      </a>-->
      <!--                  </li>-->
      <!--                      </ul>-->
                            
      <!--                  </li> -->
                        

      <!--              </li>-->
                    
                
                  
                    
      <!--              </ul>-->
				 
      <!--          </li>-->
      
      <li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-user"></i>
						</div>
						<div class="menu-title">Users</div>
					</a>
					<ul>
						<li>
                    <a href="{{route('user-list')}}">
                        <div class="parent-icon"><i class='bx bx-user'></i>
                        </div>
                        <div class="menu-title">All Users</div>
                    </a>
                   </li>
						<!--</li>-->
					<li>
                    <a href="{{route('activate_user_by_admin')}}">
                        <div class="parent-icon"><i class="bx bx-check"></i>
                        </div>
                        <div class="menu-title">Active User</div>
                    </a>
                </li>
                <li><a   href="{{ route('inactive_user_list') }}">
                    <div class="parent-icon"> <i class='bx bx-user-x'></i>
                    </div>
                    <div class="menu-title">Inactive Users</div>
                    </a>
                    </li>
                 
					</ul>
				</li>
                
                
                <li>
                    <a href="{{route('awards')}}">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-trophy"></i>
                        </div>
                        <div class="menu-title">User Rewards</div>
                    </a>
                </li>
               
                <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-gift"></i>
						</div>
						<div class="menu-title">Lucky draw</div>
					</a>
					<ul>
    					<li> <a href="{{route('lottery_pending')}}"><i class='bx bx-radio-circle'></i>Lucky draw List</a></li>
    					<li> <a href="{{route('lottery_result')}}"><i class='bx bx-radio-circle'></i>Winner History</a></li>
    					<li> <a href="{{route('percent')}}"><i class='bx bx-radio-circle'></i>Percent Decide</a></li>
					</ul>
				</li>
                <!--<li>-->
                <!--    <a href="{{route('user-list')}}">-->
                <!--        <div class="parent-icon"><i class='bx bx-user'></i>-->
                <!--        </div>-->
                <!--        <div class="menu-title">All Users</div>-->
                <!--    </a>-->
                <!--</li>-->
                 <li>
                    <a href="{{route('admin_invest_amount')}}">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-dollar-circle"></i>
                        </div>
                        <div class="menu-title">Activate User</div>
                    </a>
                </li>
                 
                 <li>
                    <a href="{{route('inactivate_user')}}">
                        <div class="parent-icon"><i class="lni lni-cross-circle"></i>
                        </div>
                        <div class="menu-title">Inactivate User</div>
                    </a>
                </li>
                     <li><a   href="{{ route('active_user_list') }}"><div class="parent-icon"><i class='bx bx-user-check'></i></div><div class="menu-title">Invest  History</div> </a></li>
                     
                    <li><a   href="{{ route('pending_users') }}"><div class="parent-icon"><i class='bx bx-user-check'></i></div><div class="menu-title">Pending Invest</div> </a></li>
                    
                 
                 
               {{--  <li><a   href="{{ route('global_star_user_list') }}"><div class="parent-icon"> <i class='fadeIn animated bx bx-star'></i></div><div class="menu-title">Global Star Users</div></a></li> --}}
                 <!--<li><a   href="{{ route('suspended_user_list') }}"><div class="parent-icon"><i class='lni lni-ban'></i></div>   <div class="menu-title">Suspended Users</div></a></li>-->
                <li>
                    <a href="{{route('total_collection')}}">
                        <div class="parent-icon"><i class='bx bx-user'></i>
                        </div>
                        <div class="menu-title">Total Collection List</div>
                    </a>
                </li>
                {{--
                 <li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="lni lni-wallet"></i>
						</div>
						<div class="menu-title">Fund Request</div>
					</a>
					<ul>
						<li> <a href="{{route('fund_request')}}"><i class='bx bx-radio-circle'></i>Paid List</a>
						</li>
						<li> <a href="{{route('pending_fund_request')}}"><i class='bx bx-radio-circle'></i>Pending List</a>
						</li>
					</ul>
				</li>
				--}}
				{{--
                <li>
                    <a href="{{route('fund_request')}}">
                        <div class="parent-icon"><i class='bx bx-user'></i>
                        </div>
                        <div class="menu-title">Fund Request</div>
                    </a>
                </li>
                --}}
      <!--            <li>-->
      <!--          <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
                    
                    
      <!--              <div class="parent-icon"><i class='bx bx-user'></i>-->
						<!--</div>-->
						<!--<div class="menu-title"> Franchise</div>-->
                  
                    
      <!--              </a>-->
      <!--              <ul>-->
      <!--              <li><a   href="{{ route('add-franchise') }}"> <i class='bx bx-radio-circle'></i> Add Franchise</a></li>-->
      <!--              <li><a   href="{{route('franchise-list')}}"><i class='bx bx-radio-circle'></i>Franchise List</a></li>-->
                    
      <!--              </ul>-->
				 
      <!--          </li>-->
                
      <!--              <li>-->
      <!--          <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
                    
                    
      <!--              <div class="parent-icon"><i class='bx bx-grid-horizontal'></i>-->
						<!--</div>-->
						<!--<div class="menu-title"> Category</div>-->
                  
                    
      <!--              </a>-->
      <!--              <ul>-->
      <!--              <li><a   href="{{ route('add-category') }}"> <i class='bx bx-radio-circle'></i>Add Category</a></li>-->
      <!--              <li><a   href="{{ route('category-list') }}"><i class='bx bx-radio-circle'></i> Category List</a></li>-->
                    
      <!--              </ul>-->
				 
      <!--          </li>-->
         
                 
                
      <!--           <li>-->
      <!--          <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
                    
                    
      <!--              <div class="parent-icon"><i class='bx bx-grid-small'></i>-->
						<!--</div>-->
						<!--<div class="menu-title"> Sub-Category</div>-->
                  
                    
      <!--              </a>-->
      <!--              <ul>-->
      <!--              <li><a   href="{{ route('add-subcategory') }}"> <i class='bx bx-radio-circle'></i>Add  Sub Category</a></li>-->
      <!--              <li><a   href="{{ route('subcategory-list') }}"><i class='bx bx-radio-circle'></i> SubCategory List</a></li>-->
                    
      <!--              </ul>-->
				 
      <!--          </li>-->
                
                
      <!--            <li>-->
      <!--          <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
                    
                    
      <!--              <div class="parent-icon"><i class='bx bx-grid-small'></i>-->
						<!--</div>-->
						<!--<div class="menu-title">Purchase</div>-->
                  
                    
      <!--              </a>-->
      <!--              <ul>-->
      <!--              <li><a   href="{{ route('create_repurchase_order') }}"> <i class='bx bx-radio-circle'></i>New Purchase</a></li>-->
                  
                    
      <!--              </ul>-->
				 
      <!--          </li>-->
               
                 
                 
                   
      <!--           <li>-->
      <!--          <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
                    
                    
      <!--              <div class="parent-icon"><i class='lni lni-producthunt'></i>-->
						<!--</div>-->
						<!--<div class="menu-title"> Product</div>-->
                  
                    
      <!--              </a>-->
      <!--              <ul>-->
      <!--              <li><a   href="{{ route('add-product') }}"> <i class='bx bx-radio-circle'></i>Add Product</a></li>-->
      <!--              <li><a   href="{{ route('product-list') }}"><i class='bx bx-radio-circle'></i>Product List</a></li>-->
                    
      <!--              </ul>-->
				 
      <!--          </li>-->
         
                 
                 
                     
      <!--           <li>-->
      <!--          <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
                    
                    
      <!--              <div class="parent-icon"><i class='bx bx-shopping-bag'></i>-->
						<!--</div>-->
						<!--<div class="menu-title"> Order History</div>-->
                  
                    
      <!--              </a>-->
      <!--              <ul>-->
      <!--              <li><a   href="{{ route('first_order_list') }}"> <i class='bx bx-radio-circle'></i>First Order</a></li>-->
      <!--              <li><a   href="{{ route('repurchase_order_list') }}"><i class='bx bx-radio-circle'></i>Repurchase Order</a></li>-->
                    
      <!--              </ul>-->
				 
      <!--          </li>-->
         
                 
                  
                
               
          
              {{--  <li>
                  
                  
                  
                  
                    <a href="{{route('withdrawl_history1')}}">
                        <div class="parent-icon"><i class="bx bx-wallet-alt"></i>
                        </div>
                        <div class="menu-title">Withdrawl History</div>
                    </a>
                </li>
                
               
                 <li>
                    <a href="javascript:;" class="has-arrow" aria-expanded="false">
                    
                    
                    <div class="parent-icon"><i class='bx bx-shopping-bag'></i>
						</div>
						<div class="menu-title"> Sales</div>
                  
                    
                    </a>
                    <ul>
                    <li><a   href="{{ route('create_invoice') }}"> <i class='bx bx-radio-circle'></i>  Create Invoice</a></li>
                    <li><a   href="#"><i class='bx bx-radio-circle'></i> Manage Invoice</a></li>
                    
                    </ul>
				 
                </li> --}}
                 <li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="lni lni-wallet"></i>
						</div>
						<div class="menu-title">Add On</div>
					</a>
					<ul>
						<li> <a href="{{route('joining_date_update')}}"><i class='bx bx-radio-circle'></i>Joining Date Update</a>	</li>
					
						<li> <a href="{{route('tree_swap')}}"><i class='bx bx-radio-circle'></i>Tree Swap Update</a> </li>
					</ul>
				</li>
                
                <li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="lni lni-wallet"></i>
						</div>
						<div class="menu-title">Payout</div>
					</a>
					<ul>
					    {{--	<li> <a href="{{route('withdrawal_request_manually_by_admin')}}"><i class='bx bx-radio-circle'></i>Withdrawl Manually</a>	</li> --}}
						<li> <a href="{{route('withdrawl_requests')}}"><i class='bx bx-radio-circle'></i>Withdrawl Request</a>	</li>
					
						<li> <a href="{{route('withdrawl_history1')}}"><i class='bx bx-radio-circle'></i>Withdrawl History</a>
						</li>
					</ul>
				</li>
				
				
				
				<li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-group"></i>
                        </div>
                        <div class="menu-title">Groups</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('add-group') }}"><i class='bx bx-radio-circle'></i>Add Percentage</a>
                        </li>
                        <li> <a href="{{ route('group_wise') }}"><i class='bx bx-radio-circle'></i>Group Percentage</a>
                        </li>
                    </ul>
                </li>
				
                
            <!--<li>-->
            <!--        <a href="{{route('active-user-list')}}">-->
            <!--            <div class="parent-icon"><i class="bx bx-list-ul"></i>-->
            <!--            </div>-->
            <!--            <div class="menu-title">Active User List</div>-->
            <!--        </a>-->
            <!--    </li>-->
                <!--<li>-->
                <!--    <a href="{{route('joining_percentage')}}">-->
                <!--        <div class="parent-icon"><i class="bx bx-user"></i>-->
                <!--        </div>-->
                <!--        <div class="menu-title">Joining Percentage</div>-->
                <!--    </a>-->
                <!--</li>-->
               
                <li>
                    <a href="{{route('p_to_p')}}">
                        <div class="parent-icon"><i class="bx bx-dollar"></i>
                        </div>
                        <div class="menu-title">P 2 P Transfer</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('block_user')}}">
                       <div class="parent-icon"><i class="lni lni-cross-circle"></i>
                        </div>
                        <div class="menu-title">Block User</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('self_fund')}}">
                        <div class="parent-icon"><i class="bx bx-dollar"></i>
                        </div>
                        <div class="menu-title">Add Fund Self</div>
                    </a>
                </li>
              <li>
                    <a href="{{route('admin.dapp_settings.index')}}">
                        <div class="parent-icon"><i class="bx bx-cog"></i>
                        </div>
                        <div class="menu-title"> Dapp Settings </div>
                    </a>
                </li>
              
                {{--
              
                <li>
                    <a href="{{route('withdrawl_requests')}}">
                        <div class="parent-icon"><i class="bx bx-dollar-circle"></i>
                        </div>
                        <div class="menu-title">Withdrawl Request</div>
                    </a>
                </li>
                
                --}}
               
                <!--<li>-->
                <!--    <a href="{{route('package_list')}}">-->
                <!--        <div class="parent-icon"><i class="bx bx-briefcase"></i>-->
                <!--        </div>-->
                <!--        <div class="menu-title">Packages</div>-->
                <!--    </a>-->
                <!--</li>-->
                <!--<li>-->
                <!--    <a href="{{route('purchase_package')}}">-->
                <!--        <div class="parent-icon"><i class="bx bx-briefcase-alt"></i>-->
                <!--        </div>-->
                <!--        <div class="menu-title">Purchased Packages</div>-->
                <!--    </a>-->
                <!--</li>-->
                
                {{--
                
                <li>
                    <a href="{{route('fund_request')}}">
                        <div class="parent-icon"><i class="bx bx-wallet-alt"></i>
                        </div>
                        <div class="menu-title">Fund Request</div>
                    </a>
                </li>
                
               
                
                --}}
                
                
             
                <li>
                    <a href="{{route('change_roi_percent')}}">
                        <div class="parent-icon">%
                        </div>
                        <div class="menu-title">Change ROI Percent</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('roi_on_off')}}">
                        <div class="parent-icon"><i class='bx bx-user-check'></i>
                        </div>
                        <div class="menu-title"> ROI ON OFF</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('change_password')}}">
                        <div class="parent-icon"><i class="bx bx-dialpad-alt"></i>
                        </div>
                        <div class="menu-title">Change Password</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('change_password_transaction')}}">
                        <div class="parent-icon"><i class="bx bx-dialpad-alt"></i>
                        </div>
                        <div class="menu-title">Change Transaction Password</div>
                    </a>
                </li>
                
                 <li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-message"></i>
						</div>
						<div class="menu-title">Message</div>
					</a>
					<ul>
						<li> <a href="{{route('user_message')}}"><i class='bx bx-radio-circle'></i>Messages</a>
						</li>
						<!--<li> <a href="{{route('withdrawl_history1')}}"><i class='bx bx-radio-circle'></i>Withdrawl History</a>-->
						<!--</li>-->
					</ul>
				</li>
               
               {{-- <li>
                    <a href="{{route('notification')}}">
                        <div class="parent-icon"><i class="bx bx-bell"></i>
                        </div>
                        <div class="menu-title">Notification</div>
                    </a>
                </li> --}}
                <li>
                    <a href="{{route('add_banner')}}">
                        <div class="parent-icon"><i class="bx bx-image"></i>
                        </div>
                        <div class="menu-title">Add Banner</div>
                    </a>
                </li> 
                
     <!--           <li>-->
     <!--           <a href="javascript:;" class="has-arrow" aria-expanded="false">-->
                    
                    
     <!--               <div class="parent-icon"><i class='bx bx-street-view'></i>-->
					<!--	</div>-->
					<!--	<div class="menu-title"> Business Settings</div>-->
                  
                    
     <!--               </a>-->
     <!--               <ul>-->
     <!--               <li><a   href="{{route('business_setup')}}"> <i class='bx bx-radio-circle'></i> Business Setup</a></li>-->
     <!--               <li><a   href="{{route('social_media')}}"><i class='bx bx-radio-circle'></i>  Social Media</a></li>-->
     <!--               <li><a   href="{{route('payment_config')}}"> <i class='bx bx-radio-circle'></i>  Payment Methods</a></li>-->
     <!--               <li><a   href="{{route('mail_config')}}"> <i class='bx bx-radio-circle'></i> Mail Config</a></li>-->
     <!--               <li><a   href="#"> <i class='bx bx-radio-circle'></i> Notification Setting</a></li>-->
     <!--               <li><a   href="{{route('sms_config')}}"> <i class='bx bx-radio-circle'></i> SMS System Module</a></li>-->
     <!--               </ul>-->
     <!--               <ul>-->
					<!--	<li> <a href="ecommerce-products.html"><i class='bx bx-radio-circle'></i>Products</a>-->
					<!--	</li>-->
					<!--	<li> <a href="ecommerce-products-details.html"><i class='bx bx-radio-circle'></i>Product Details</a>-->
					<!--	</li>-->
					<!--	<li> <a href="ecommerce-add-new-products.html"><i class='bx bx-radio-circle'></i>Add New Products</a>-->
					<!--	</li>-->
					<!--	<li> <a href="ecommerce-orders.html"><i class='bx bx-radio-circle'></i>Orders</a>-->
					<!--	</li>-->
					<!--</ul>-->
     <!--           </li>-->
     <!--              <li>-->
     <!--               <a href="{{route('plan_setting')}}">-->
     <!--                   <div class="parent-icon"><i class="bx bx-shape-circle"></i>-->
     <!--                   </div>-->
     <!--                   <div class="menu-title">Plan</div>-->
     <!--               </a>-->
     <!--             </li>-->
             
                 <!--<li>-->
                 <!--   <a href="{{route('stock_transfer')}}">-->
                 <!--       <div class="parent-icon"><i class="bx bx-shape-circle"></i>-->
                 <!--       </div>-->
                 <!--       <div class="menu-title">Stock Transfer</div>-->
                 <!--   </a>-->
                 <!-- </li>-->
                 <!--  <li>-->
                 <!--   <a href="{{route('Stock_Transfer_List')}}">-->
                 <!--       <div class="parent-icon"><i class="bx bx-shape-circle"></i>-->
                 <!--       </div>-->
                 <!--       <div class="menu-title">Stock Transfer List</div>-->
                 <!--   </a>-->
                 <!-- </li>-->
                 <li>
                    <a href="{{ route('logout') }}">
                        <div class="parent-icon"><i class="bx bx-power-off"></i>
                        </div>
                        <div class="menu-title">Logout</div>
                    </a>
                </li>
                 
                {{-- <li class="menu-label">UI Elements</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-cart'></i>
                        </div>
                        <div class="menu-title">eCommerce</div>
                    </a>
                    <ul>
                        <li> <a href="ecommerce-products.html"><i class='bx bx-radio-circle'></i>Products</a>
                        </li>
                        <li> <a href="ecommerce-products-details.html"><i class='bx bx-radio-circle'></i>Product
                                Details</a>
                        </li>
                        <li> <a href="ecommerce-add-new-products.html"><i class='bx bx-radio-circle'></i>Add New
                                Products</a>
                        </li>
                        <li> <a href="ecommerce-orders.html"><i class='bx bx-radio-circle'></i>Orders</a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
            <!--end navigation-->
        </div>
		<!--end sidebar wrapper -->
		<!--start header -->
	<header style='display:none;'>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand gap-3">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>

					  <div class="position-relative search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
						<input class="form-control px-5" disabled type="search" placeholder="Search">
						<span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-5"><i class='bx bx-search'></i></span>
					  </div>


					  <div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							<li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
								<a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
								</a>
							</li>
							<li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;" data-bs-toggle="dropdown"><img src="assets/images/county/02.png" width="22" alt="">
								</a>
								<ul class="dropdown-menu dropdown-menu-end">
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/01.png" width="20" alt=""><span class="ms-2">English</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/02.png" width="20" alt=""><span class="ms-2">Catalan</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/03.png" width="20" alt=""><span class="ms-2">French</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/04.png" width="20" alt=""><span class="ms-2">Belize</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/05.png" width="20" alt=""><span class="ms-2">Colombia</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/06.png" width="20" alt=""><span class="ms-2">Spanish</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/07.png" width="20" alt=""><span class="ms-2">Georgian</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/08.png" width="20" alt=""><span class="ms-2">Hindi</span></a>
									</li>
								</ul>
							</li>
							<li class="nav-item dark-mode d-none d-sm-flex">
								<a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
								</a>
							</li>

							<li class="nav-item dropdown dropdown-app">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" href="javascript:;"><i class='bx bx-grid-alt'></i></a>
								<div class="dropdown-menu dropdown-menu-end p-0">
									<div class="app-container p-2 my-2">
									  <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/slack.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Slack</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/behance.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Behance</p>
											  </div>
											  </div>
										  </a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												<img src="assets/images/app/google-drive.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Dribble</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/outlook.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Outlook</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/github.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">GitHub</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/stack-overflow.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Stack</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/figma.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Stack</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/twitter.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Twitter</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/google-calendar.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Calendar</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/spotify.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Spotify</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/google-photos.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Photos</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/pinterest.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Photos</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/linkedin.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">linkedin</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/dribble.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Dribble</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/youtube.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">YouTube</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/google.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">News</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/envato.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Envato</p>
											  </div>
											  </div>
											</a>
										 </div>
										 <div class="col">
										  <a href="javascript:;">
											<div class="app-box text-center">
											  <div class="app-icon">
												  <img src="assets/images/app/safari.png" width="30" alt="">
											  </div>
											  <div class="app-name">
												  <p class="mb-0 mt-1">Safari</p>
											  </div>
											  </div>
											</a>
										 </div>
				
									  </div><!--end row-->
				
									</div>
								</div>
							</li>

							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" data-bs-toggle="dropdown"><span class="alert-count">7</span>
									<i class='bx bx-bell'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Notifications</p>
											<p class="msg-header-badge">8 New</p>
										</div>
									</a>
									<div class="header-notifications-list">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-1.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Daisy Anderson<span class="msg-time float-end">5 sec
												ago</span></h6>
													<p class="msg-info">The standard chunk of lorem</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-danger text-danger">dc
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
												ago</span></h6>
													<p class="msg-info">You have recived new orders</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-2.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
												sec ago</span></h6>
													<p class="msg-info">Many desktop publishing packages</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success">
													<img src="assets/images/app/outlook.png" width="25" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Account Created<span class="msg-time float-end">28 min
												ago</span></h6>
													<p class="msg-info">Successfully created new email</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-info text-info">Ss
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Product Approved <span
												class="msg-time float-end">2 hrs ago</span></h6>
													<p class="msg-info">Your new product has approved</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-4.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15
												min ago</span></h6>
													<p class="msg-info">Making this the first true generator</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success"><i class='bx bx-check-square'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
												ago</span></h6>
													<p class="msg-info">Successfully shipped your item</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary">
													<img src="assets/images/app/github.png" width="25" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
												ago</span></h6>
													<p class="msg-info">24 new authors joined last week</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-8.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6 hrs
												ago</span></h6>
													<p class="msg-info">It was popularised in the 1960s</p>
												</div>
											</div>
										</a>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">
											<button class="btn btn-primary w-100">View All Notifications</button>
										</div>
									</a>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
									<i class='bx bx-shopping-bag'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">My Cart</p>
											<p class="msg-header-badge">10 Items</p>
										</div>
									</a>
									<div class="header-message-list">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="assets/images/products/11.png" class="" alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="assets/images/products/02.png" class="" alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="assets/images/products/03.png" class="" alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="assets/images/products/04.png" class="" alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="assets/images/products/05.png" class="" alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="assets/images/products/06.png" class="" alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="assets/images/products/07.png" class="" alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="assets/images/products/08.png" class="" alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center gap-3">
												<div class="position-relative">
													<div class="cart-product rounded-circle bg-light">
														<img src="assets/images/products/09.png" class="" alt="product image">
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
													<p class="cart-product-price mb-0">1 X $29.00</p>
												</div>
												<div class="">
													<p class="cart-price mb-0">$250</p>
												</div>
												<div class="cart-product-cancel"><i class="bx bx-x"></i>
												</div>
											</div>
										</a>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">
											<div class="d-flex align-items-center justify-content-between mb-3">
												<h5 class="mb-0">Total</h5>
												<h5 class="mb-0 ms-auto">$489.00</h5>
											</div>
											<button class="btn btn-primary w-100">Checkout</button>
										</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown px-3">
						<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
							<div class="user-info">
								<p class="user-name mb-0">Pauline Seitz</p>
								<p class="designattion mb-0">Web Designer</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-cog fs-5"></i><span>Settings</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-dollar-circle fs-5"></i><span>Earnings</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-download fs-5"></i><span>Downloads</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
	
	        <header>
            <div class="topbar d-flex align-items-center" style="background: #01142b !important;">
                <nav class="navbar navbar-expand gap-3">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>

                  
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center gap-1">
                            <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal"
                                data-bs-target="#SearchModal">
                                <a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('/assets/images/avatars/avatar-2.png')}}" class="user-img" alt="user avatar">
                            <div class="user-info">
                                <p class="user-name mb-0">{{ $data->first_name }} {{ $data->last_name }}</p>
                                @if ($data->role == 'admin')
                                    <p class="designattion mb-0">Admin</p>
                                @else
                                    <p class="designattion mb-0">User</p>
                                @endif
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <!--<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i-->
                            <!--            class="bx bx-user fs-5"></i><span>Profile</span></a>        -->
                            <!--</li>-->
                         
                            <li><a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"><i
                                        class="bx bx-log-out-circle"></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        
