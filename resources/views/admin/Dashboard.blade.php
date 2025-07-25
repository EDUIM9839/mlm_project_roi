@extends('admin.layouts.main')
@section('pageTitle', 'DASHBOARD')
@section('mains')
<style>
    .yes {
    background: linear-gradient(to right, #c10e36, #1f1c1b)!important;
}

.card-header {
    background: #bfa900 !important;
}
.card {
    
    background: #01142b !important;
.whitetd
{
    color: #fff !important;
}


</style>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content" style="background: #646489 !important;">
            
            <div class="card">
				<div class="card-header bg-info">
				 <h6 class="mb-0 text-white">Team Summary</h6>
				</div></br>
				  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 px-3">
					  <div class="col">
					 <div class="card radius-10 bg-info">
					      <a href="{{ route('user-list') }}"> 
							<div class="card-body">
							
								  <div class="d-flex align-items-center">
									  <div>
										  <p class="mb-0 text-white">Total No of Users</p>
										  <h4 class="my-1 text-white">{{Helper::no_of_record('user')}}</h4>
										  <!--<p class="mb-0 font-13 text-dark"><i class="bx bxs-up-arrow align-middle"></i>$24 from last week</p>-->
									  </div>
									  <div class="widgets-icons bg-white text-dark ms-auto"><i class="bx bxs-group"></i>
									  </div>
								  </div>
							  </div>
							  </a>
							  </div>
							  </div>
           
				  <div class="col">
				  <div class="card radius-10 bg-success">
				       <a href="{{ route('active_user_list') }}">
							  <div class="card-body">
								 
								  <div class="d-flex align-items-center">
									  <div>
										  <p class="mb-0 text-white">Total Active Users</p>
										   @php
                                         $data2 = DB::table('user_package')->where('status','=','approved')->groupBy('user_id')->get();
                                         $data=count($data2);
                                        @endphp
										  <h4 class="my-1 text-white">{{$data}}</h4>
										  <!--<p class="mb-0 font-13 text-white"><i class="bx bxs-up-arrow align-middle"></i>$34 from last week</p>-->
									  </div>
									  <div class="widgets-icons bg-white text-black ms-auto"><i class="bx bxs-user-check"></i>
									  </div>
								  </div>
							  </div>
							  	</a>
						  </div>
						  </div>
			 
         <div class="col">
				  <div class="card radius-10 bg-danger">
				
							  <div class="card-body">
							      <a href="{{ route('inactive_user_list') }}">
								  <div class="d-flex align-items-center">
									  <div>
										  <p class="mb-0 text-white">Total Inactive Users</p>
										  <h4 class="my-1 text-white"> {{Helper::no_of_record('user')-$data}}</h4>
										  <!--<p class="mb-0 font-13 text-white"><i class="bx bxs-down-arrow align-middle"></i>$34 from last week</p>-->
									  </div>
									  <div class="widgets-icons bg-white text-black ms-auto"><i class="bx bxs-user-minus"></i>
									  </div>
								  </div>
							  </div>
							   </a>
						  </div>
						  <div>
					</div>
					  </div>
	  </div>
		  </div><!--end row--
                
			
	<!--start page wrapper -->
			 <div class="card">
		      <div class="card-header bg-info">
			   <h6 class="mb-0 text-white">Business Summary</h6>
		      </div></br>
		        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 px-3">
		            <div class="col">
                   <div class="card radius-10 bg-info">
                        <a href="{{route('total_collection')}}">
                          <div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Total Collection</p>
										   @php
                            $total_collections= DB::table('user_package')->where('status','approved')->sum('amount');
                                    @endphp
										<h4 class="my-1 text-white">{{Helper::get_currency()}}{{$total_collections}}</h4>
										<!--<p class="mb-0 font-13 text-dark"><i class="bx bxs-up-arrow align-middle"></i>$24 from last week</p>-->
									</div>
									<div class="widgets-icons bg-white text-dark ms-auto"><i class="bx bx-dollar"></i>
									</div>
								</div>
							</div>
							 </a>
							</div>
							</div>
           
              
              
          @php
          $reward_achieved_user=DB::table('reward_achieved_user')->count();
          @endphp
                						
                <div class="col">
                <div class="card radius-10 bg-success">
                    <a href="{{ route('reward_achiever_user') }}">  
							<div class="card-body">
							  
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Total Achiever Award</p>
										<h4 class="my-1 text-white">{{$reward_achieved_user}}</h4>
										<!--<p class="mb-0 font-13 text-white"><i class="bx bxs-up-arrow align-middle"></i>$34 from last week</p>-->
									</div>
									<div class="widgets-icons bg-white text-black ms-auto"><i class="bx bx-dollar"></i>
									</div>
								</div>
							</div>
							</a>
						</div>
						</div>
                
          <div class="col">
                <div class="card radius-10 bg-danger">
                      @php
                          $withdrawl_request_charge=DB::table('withdrawl_request')->where('status','Approved')->sum('amount');
                          @endphp
                   
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Withdrawl Amount Charge</p>
										<h4 class="my-1 text-white">{{Helper::get_currency()}}{{ $withdrawl_request_charge*10/100}}</h4>
										<!--<p class="mb-0 font-13 text-white"><i class="bx bxs-down-arrow align-middle"></i>$34 from last week</p>-->
									</div>
									<div class="widgets-icons bg-white text-black ms-auto"><i class="bx bx-dollar"></i>
									</div>
								</div>
							</div>
							 
						</div>
						<div>
                  </div>
                    </div>
    </div>
        </div><!--end row-->
                
            <div class="card">
		      <div class="card-header bg-info">
			   <h6 class="mb-0 text-white">Income Summary</h6>
		      </div></br>
		        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 px-3">
		            <div class="col">
                   <div class="card radius-10 bg-info">
                          <div class="card-body">
                               @php
                               $total_roi_income=DB::table('income_history')->where("type","roi")->where("credit_debit","credit")->sum('amount');
          
                          @endphp
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Total ROI Income</p>
										<h4 class="my-1 text-white">{{Helper::get_currency()}}{{ number_format($total_roi_income,2, '.' ,'')}}</h4>
										<!--<p class="mb-0 font-13 text-dark"><i class="bx bxs-up-arrow align-middle"></i>$24 from last week</p>-->
									</div>
									<div class="widgets-icons bg-white text-dark ms-auto"><i class="bx bxs-wallet"></i>
									</div>
								</div>
							</div>
							</div>
							</div>
							
                <div class="col">
                <div class="card radius-10 bg-success">
							<div class="card-body">
							     @php
                                $total_level_income=DB::table('income_history')->where("type","level")->where("credit_debit","credit")->sum('amount');
          
                          @endphp
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Total Level Income</p>
										<h4 class="my-1 text-white">{{Helper::get_currency()}}{{number_format($total_level_income,2, '.' ,'')}}</h4>
										<!--<p class="mb-0 font-13 text-white"><i class="bx bxs-up-arrow align-middle"></i>$34 from last week</p>-->
									</div>
									<div class="widgets-icons bg-white text-black ms-auto"><i class="bx bxs-wallet"></i>
									</div>
								</div>
							</div>
						</div>
						</div>
                
     <div class="col">
                <div class="card radius-10 bg-danger">
                       @php
                                  $total_club_income=DB::table('income_history')->where("type","trading_bonus")->where("credit_debit","credit")->sum('amount');
                              @endphp
                     <a href="#">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Total Trading bonus Income</p>
										<h4 class="my-1 text-white">{{Helper::get_currency()}} {{number_format($total_club_income,2, '.' ,'')}}</h4>
										<!--<p class="mb-0 font-13 text-white"><i class="bx bxs-down-arrow align-middle"></i>$34 from last week</p>-->
									</div>
									<div class="widgets-icons bg-white text-black ms-auto"><i class="bx bxs-wallet"></i>
									</div>
								</div>
							</div>
							 </a>
						</div>
						<div>
                  </div>
                    </div>
    </div>
        </div><!--end row--
                

{{--
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-4 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Pending Withdrawl</p>
                                    <h4 class="my-1 text-danger"> {{Helper::withdrawl_request()}}</h4>
                                   
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                        class='bx bx-time'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                --}}
                
           
            </div><!--end row-->

<div class="row">
        <div class="col-md-6">
            <div class="card radius-10">
                <div class="card-header bg-warning">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0 text-white">Top Earners 

                            <!--<img src="{{ Storage::url('app/public/earner.gif')}}" height='30' width='30'>   -->
                               <img src="{{route('show_product_image','earner.gif')}}" height='30' width='30'>   
                            </h6>

                            
             

</div>
                        <div class="dropdown ms-auto text-white">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-striped table-bordered text-white" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                   <th>User Id</th>
                                    <th>Income </th>
                                     
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                    $top_earners=Helper::top_earners();
                                @endphp
                                @foreach ($top_earners as $d)
                                @php
                                $id_find=DB::table('user')->where('userid',$d->userid)->first();
                                $profit=DB::table('income_history')->where('received_user',$id_find->id)->sum('profit');
                                
                                @endphp
                                @if($id_find->role=="user")
                                    <tr>
                                        <td class="whitetd">{{ $i++ }}</td>
                                        <td class="whitetd">{{ $d->first_name }} {{ $d->last_name }} </td>
                                        <td><span
                                            class="badge bg-gradient-quepal text-white shadow-sm w-100">{{ $d->userid }}</span>
                                    </td>
                                         <td class="whitetd"> {{Helper::get_currency()}}{{round($d->sum,2)}}</td>
                                      
                                        {{-- <td>{{ $d->created_at->format('d-m-Y') }}</td> --}}
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card radius-10">
                <div class="card-header bg-warning text-white">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0 text-white">Recent Joiners  <i  style='font-size:25px;' class='bx bx-select-multiple'> </i></h6>
                        </div>
                        <div class="dropdown ms-auto text-white">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                    class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-white">
                        <table  class="table table-striped table-bordered text-white" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>User Id</th>
                                    <th>Joined On</th>
                                    <th> Status</th>


                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                    $recent_joiners=Helper::recent_joiners();
                                @endphp
                                @php
                                
                                 $userData= DB::table('user')->where("role","user")->latest()->get()->take(10);
                                 
                                  
                                @endphp
                                
                                @foreach ($userData as $rj)
                                
                               
                                    <tr>
                                        <td class="whitetd">{{ $i++ }}</td>
                                        <td class="whitetd">{{ $rj->first_name }}  {{ $rj->last_name }}<br><span
                                              style="text-transform:uppercase"  class="badge bg-gradient-burning yes text-white shadow-sm w-80">{{ $rj->role }}</span></td>
                                         <td><span
                                                class="badge bg-gradient-quepal text-white shadow-sm w-100">{{ $rj->userid }}</span>
                                        </td>
                                       
                                        <td class="whitetd">{{ Helper::formatted_date($rj->created_at) }}</td>
                                         @php
                                $active_inactive=DB::table('user_package')->where('user_id',$rj->id)->where('status','approved')->first();
                                
                                @endphp
                                @if(empty($active_inactive))
                                    <td style="color:red"><b>Inactive</b></td>
                                @else
                                    <td style="color:green"><b>Active</b></td>
                                @endif
                           </tr>
                               
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>





      
    <!--end page wrapper -->
@endsection
