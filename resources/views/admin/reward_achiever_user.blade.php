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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Reward Achiever</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->
            <!--<h6 class="mb-0 text-uppercase alert  ">All User List</h6>-->
           
            <hr />
           <div class="card border-dark p-2">
              <div class="border-dark table-responsive text-nowrap">
                  
                     <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding:5px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>Rank Name</th>
                                    <th>Reward Name</th>
                                    <th>Target Business</th>
                                    <th>Total Achiever</th>
                                    <th>View Achiever</th>
                                </tr>
                            </thead>
                             <tbody>
                                 @php
                                 $i=1;
                                 @endphp
                                 
                                 @foreach($reward_vip as $rv)
                                 @php
                                 $totalAchivers=DB::table("reward_achieved_user")->where("level_no",$rv->id)->count();
                                 @endphp
                                 <tr>
                                     <td>{{$i++}}</td>
                                     <td>{{ucfirst($rv->rank_name)}}</td>
                                     <td>{{$rv->reward_name}}</td>
                                     <td>{{Helper::get_currency()}} {{$rv->target_business}}</td>
                                     <td>{{$totalAchivers}}</td>
                                       <td>
                                           <a href="{{route('view_reward_achiver_user_list',['id'=>$rv->id])}}"><button type="button" class="btn btn-primary" >View User List</button></a>
										<!-- Button trigger modal -->
									{{--	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal{{$rv->id}}">View</button>
										<!-- Modal -->
										<div class="modal fade" id="exampleScrollableModal{{$rv->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
											<div class="modal-dialog modal-lg modal-dialog-scrollable">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title"> {{$rv->rank_name}} Rewrad Achiever</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
													
														  <div class="table-responsive text-nowrap">
														       <table id="withdrawal_request" class="table display nowrap dataTable" style="width:100%">
														           <thead>
														               <tr>
														                   <th>Sr no.</th>
														                   <th>User Name</th>
														                   <th>User Id</th>
														                   <th>Rank Name</th>
														                   <th>Reward Name</th>
														                   <th>Achieved Date</th>
														               </tr>
														           </thead>
														         <tbody>
														             @php
														             $ii=1;
														            $reward_achieved_user=DB::table("reward_achieved_user")->where("level_no",$rv->id)->get();
														             @endphp
														             @foreach($reward_achieved_user as $rau)
														             @php
														             $user_tbl=DB::table("user")->where("id",$rau->user_id)->first();
														             @endphp
														             <tr>
														                 
														                 <td>{{$ii++}}</td>
														                 <td>{{$user_tbl->first_name}} {{$user_tbl->last_name}}</td>
														                 <td>{{$user_tbl->userid}}</td>
														                  <td>{{$rv->rank_name}}</td>
                                                                           <td>{{$rv->reward_name}}</td>
                                                                           <td>{{date("d-M-Y",strtotime($rau->date_time))}}</td>
														             </tr>
														             @endforeach
														         </tbody>  
                                                                </table>
                                                          </div>
														
													
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>--}}
										</td>
                                 </tr>
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
