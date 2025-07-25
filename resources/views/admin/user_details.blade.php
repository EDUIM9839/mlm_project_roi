@extends('admin.layouts.main')
@section('mains')
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">User Profile</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								 <li class="breadcrumb-item active" aria-current="page"><a href="{{route('user-list')}}">User List</a></li>
								<li class="breadcrumb-item active" aria-current="page">user profile</li>
							</ol>
						</nav>
					</div>
					
				</div>
			
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-4">
                            <h6 class="text-uppercase">Profile</h6>
					        <hr>
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
										    @if(!empty($user_details['0']->image))
											<img src="{{ Storage::url('app/profileupload/').$user_details['0']->image}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110" height="110"  style="object-fit: fill;">
											 @else
                                     <img src="{{ Storage::url('app/logo/').DB::table('business_setup')->first()->logo}}" class="user-img" alt="user avatar" style="width:65px;height:65px;">
                                     @endif
											<div class="mt-3">
												<h4>{{$user_details['0']->first_name}}</h4>
											</div>
										</div>
										<hr class="my-4">
										<div class="d-flex flex-column ">
											<div class="mt-3">
											    <div class="row mb-3">
										         <div class="col-sm-12">
										               <div class="table-responsive">
                                                          <table  class="table table-striped table-bordered" style="width:100%">
                                                              
                                                              <tbody>
                                                                      <tr>
                                                                          <th>Name</th>
                                                                          <td>{{$user_details['0']->first_name }}  {{ $user_details['0']->last_name }}</td> 
                                                                      </tr>
                                                                      <tr>
                                                                          <th>User Id</th>
                                                                          <td>
                                                                              <span class="badge bg-gradient-quepal text-white shadow-sm w-100">{{ $user_details['0']->userid }}</span>
                                                                          </td>
                                                                      </tr>
                                                                      <tr>
                                                                          <th>Email</th>
                                                                          <td>{{$user_details['0']->email }}</td> 
                                                                      </tr>
                                                                      <tr>
                                                                          <th>Phone no.</th>
                                                                          <td>{{$user_details['0']->contact }}</td> 
                                                                      </tr>
                                                                      <tr>
                                                                          <th>Pan no</th>
                                                                          <td>{{$user_details['0']->pan }}</td> 
                                                                      </tr>
                                                                      <tr>
                                                                          <th>Fund Wallet</th>
                                                                          <td>{{Helper::get_currency()}} {{$user_details['0']->saving_wallet }}</td> 
                                                                      </tr>
                                                                       
                                                                      <tr>
                                                                          <th>Status</th>
                                                                          <td>{!! Helper::check_active_inactive($user_details['0']->id,'colorful') !!} </td> 
                                                                      </tr>
                                                               
                                                              </tbody>
                                                          </table>
                                                      </div>
										         </div>
										        
								            	</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<!--start stepper three--> 
					<h6 class="text-uppercase">User Information</h6>
					<hr>
					<div class="card">
						<div class="card-body">
						<div class="row">
                         <div class="col-12 col-lg-12">
                      <div class="card radius-10">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Team Summary</h6>
								</div>
								
							</div>
						  </div>
						 
						  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-0 row-group text-center border-top">
							<div class="col">
							  <div class="p-3">
								<p>Total Direct User</p>
								<h4 class="mb-0">
								    @php
								    $userid=$user_details['0']->userid;
								    $total_direct=DB::table('user')->where('referal',$userid)->count();
								    @endphp
								    {{$total_direct}}
								</h4>
							 
							  </div>
							</div>
							
							
							<div class="col">
							  <div class="p-3">
								<p>Total Team</p>
								<h4 class="mb-0">
								    
								  {{$total_team}}
								</h4>
							 
							  </div>
							</div>
							
							<div class="col">
							  <div class="p-3">
								<p>Total Active User</p>
							<?php   
                                    $totalUserCount = DB::table('user')
                                        ->leftJoin('user_package', 'user.id', '=', 'user_package.user_id')
                                        ->where('user_package.status', 'approved')
                                        ->groupBy('user_package.user_id')
                                        ->where('user.id', $user->id)
                                        ->count('user.id');
                                    ?>
								<h4 class="mb-0"> <?php echo $total_active; ?></h4>
							 
							  </div>
							</div>
							
							<div class="col">
							  <div class="p-3">
								<p>Total Inactive User</p>
								
							<?php   
                                    $totalUserInactive = DB::table('user')
                                        ->leftJoin('user_package', 'user.id', '=', 'user_package.user_id')
                                        ->where('user_package.status', 'pending')
                                        ->groupBy('user_package.user_id')
                                        ->where('user.id', $user->id)
                                        ->count('user.id');
                                    ?>
                                    
                            <h4 class="mb-0"> <?php echo $total_inactive; ?></h4>
							 
							  </div>
							</div>
							
							
							
							{{--
							
							<div class="col">
							  <div class="p-3">
								<p>Total Right User</p>
								<h4 class="mb-0">{{$total_right_user}}</h4>
								<small class="mb-0">This Week Left User <span> <i class="bx bx-up-arrow-alt align-middle"></i>0</span></small>
							  </div>
							</div>
							<div class="col">
								<div class="p-3">
									<p>Total User</p>
								  <h4 class="mb-0">{{$total_left_user+$total_right_user+$total_direct}}</h4>
								  <small class="mb-0">This Month User <span> <i class="bx bx-up-arrow-alt align-middle"></i> 0</span></small>
								</div>
							  </div>
							  --}}
						  </div>
					  </div>
				   </div>
				</div>
					{{--	<div class="row">
                         <div class="col-12 col-lg-12">
                      <div class="card radius-10">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Business Overview</h6>
								</div>
								
							</div>
						  </div>
						 
						  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-0 row-group text-center border-top">
							<div class="col">
							  <div class="p-3">
								<p>Today left business</p>
								<h4 class="mb-0"> {{$today_total_left_business}} PV</h4>
								<small class="mb-0">Today's Sales <span> <i class="bx bx-up-arrow-alt align-middle"></i> 0</span></small>
							  </div>
							</div>
							<div class="col">
							  <div class="p-3">
								<p>Today right business</p>
								<h4 class="mb-0">
						       	{{$today_total_right_business}} PV							
						       	</h4>
								<small class="mb-0">This Week Sales <span> <i class="bx bx-up-arrow-alt align-middle"></i> 0</span></small>
							  </div>
							</div>
							<div class="col">
							  <div class="p-3">
								<p>Total left business</p>
								<h4 class="mb-0">
								{{$total_left_business}} PV								
								</h4>
								<small class="mb-0">This Month Sales <span> <i class="bx bx-up-arrow-alt align-middle"></i>0</span></small>
							  </div>
							</div>
							<div class="col">
								<div class="p-3">
									<p>Total right business</p>
								  <h4 class="mb-0">
								  {{$total_right_business}} PV								 
								  </h4>
								  <small class="mb-0">This Year Sales <span> <i class="bx bx-up-arrow-alt align-middle"></i> 0</span></small>
								</div>
							  </div>
						  </div>
					  </div>
				   </div>
				</div>
				
				--}}
						</div>
						
						
						 
						
						
						<div class="card-body">
						<div class="row">
                         <div class="col-12 col-lg-12">
                      <div class="card radius-10">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Wallet Summary</h6>
								</div>
								
							</div>
						  </div>
						 
						  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 g-0 row-group text-center border-top">
							
							<div class="col">
							  <div class="p-3">
								<p>Activation Wallet</p>
								<h4 class="mb-0 ">
								   {{Helper::get_currency()}}{{ round($user->saving_wallet, 2) }}
								</h4>
							 
							  </div>
							</div>
							
							
							<div class="col">
							  <div class="p-3">
								<p>Withdrawal Wallet</p>
								<h4 class="mb-0">
								   {{Helper::get_currency()}}{{ round($user->withdrawl_wallet, 2) }}
								</h4>
							 
							  </div>
							</div>
						{{--	
							<div class="col">
							  <div class="p-3">
								<p>ROI Wallet</p>
								<h4 class="mb-0"> 
								{{Helper::get_currency()}}{{round(Auth::user()->withdrawl_wallet,2)}}</h4>
							 
							  </div>
							</div>
							
							<div class="col">
							  <div class="p-3">
								<p>Club  Wallet</p>
								<h4 class="mb-0"> 
							{{Helper::get_currency()}}{{round(Auth::user()->club_wallet,2)}}</h4>
							 
							  </div>
							</div>
						 
						 --}}
					
						</div>
					</div>
				  <!--end stepper three--> 
							</div>
						</div>
					</div>
					
						<div class="card-body">
						<div class="row">
                         <div class="col-12 col-lg-12">
                      <div class="card radius-10">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Income Summary</h6>
								</div>
								
							</div>
						  </div>
						 
						  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-0 row-group text-center border-top">
						{{--	
							<div class="col">
							  <div class="p-3">
								<p>Direct Income</p>
								<?php   $direct_income=DB::table('income_history')->where('received_user', $user->id)->where('type','direct')->where("credit_debit","credit")->sum('amount'); ?>
								<h4 class="mb-0 ">
								   {{Helper::get_currency()}}{{round($direct_income,2)}}
								</h4>
							 
							  </div>
							</div>
						--}}	
							
							<div class="col">
							  <div class="p-3">
								<p>Level Income</p>
								<?php             $level_income=
                                                DB::table('income_history')->where('received_user',$user->id)->where('type','level')->where('credit_debit', 'credit')->sum('amount'); ?>
								<h4 class="mb-0">
								   {{Helper::get_currency()}}{{round($level_income,2)}}
								</h4>
							 
							  </div>
							</div>
							
							<div class="col">
							  <div class="p-3">
								<p>ROI Income</p>
								<?php  $global_income=
            DB::table('income_history')->where('income_history.type','=','roi')->where('credit_debit','credit')->where('received_user', $user->id)->sum('amount'); ?>
								<h4 class="mb-0"> 
								{{Helper::get_currency()}}{{round($global_income,2)}}</h4>
							 
							  </div>
							</div>
							
							<div class="col">
							  <div class="p-3">
								<p>Trading Bonus</p>
								  @php
                                $help_income=
                                DB::table('income_history')->where('type', 'trading_bonus')->where('credit_debit','credit')->where('received_user', $user->id)->sum('amount');
                                @endphp
								<h4 class="mb-0"> 
							{{Helper::get_currency()}}{{round($help_income,2)}}</h4>
							 
							  </div>
							</div>
						 
						 
					
						</div>
					</div>
				  <!--end stepper three--> 
							</div>
						</div>
					</div>
					
						<div class="card-body">
						<div class="row">
                         <div class="col-12 col-lg-12">
                      <div class="card radius-10">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Investment Summary</h6>
								</div>
								
							</div>
						  </div>
						 
						  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 g-0 row-group text-center border-top">
							
							<div class="col">
							  <div class="p-3">
								<p>Self Investment</p>
							   @php $total_invest_amount=DB::table("user_package")->where("user_id", $user->id)->where("status","approved")->sum('amount'); @endphp
                                        
                                        <h4 class="mb-2">
                                           {{Helper::get_currency()}} {{$total_invest_amount}}
                                        </h4>

							 
							  </div>
							</div>
							
							
							<div class="col">
							  <div class="p-3">
								<p>Team Investment</p>
							 
								<h4 class="mb-0">
								   {{Helper::get_currency()}}  {{$total_team_investment}} 
								</h4>
							 
							  </div>
							</div>
							
							<!--<div class="col">-->
							<!--  <div class="p-3">-->
							<!--	<p>ROI Wallet</p>-->
							<!--	<h4 class="mb-0"> -->
							<!--	{{Helper::get_currency()}}{{round(Auth::user()->withdrawl_wallet,2)}}</h4>-->
							 
							<!--  </div>-->
							<!--</div>-->
							
							<!--<div class="col">-->
							<!--  <div class="p-3">-->
							<!--	<p>Club  Wallet</p>-->
							<!--	<h4 class="mb-0"> -->
							<!--{{Helper::get_currency()}}{{round(Auth::user()->club_wallet,2)}}</h4>-->
							 
							<!--  </div>-->
							<!--</div>-->
						 
						 
					
						</div>
					</div>
				  <!--end stepper three--> 
							</div>
						</div>
					</div>
				</div>
			</div>
           
		</div>

@endsection