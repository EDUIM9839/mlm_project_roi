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
                            <li class="breadcrumb-item active" aria-current="page">Club Achiever</li>
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
                                    <th>Club Name</th>
                                    <th>Target Business</th>
                                    <th>Total Achiever</th>
                                    <th>Total Distribution Amount</th>
                                    <th>View Achiever</th>
                                </tr>
                            </thead>
                             <tbody>
                                 @php
                                 $i=1;
                                 @endphp
                                 
                                 @foreach($club_level as $cl)
                                 @php
                                 $total_club_income=DB::table("income_history")->where("type","club_income")->where("level_no",$cl->id)->where("credit_debit","credit")->sum("amount");
                                 $totalAchivers=DB::table("club_achiver_user")->where("level_no",$cl->id)->count();
                                 @endphp
                                 <tr>
                                     <td>{{$i++}}</td>
                                     <td>{{$cl->club_name}}</td>
                                     <td>{{Helper::get_currency()}} {{$cl->target_business}}</td>
                                     <td>{{$totalAchivers}}</td>
                                     <td>{{Helper::get_currency()}} {{$total_club_income}}</td>
                                       <td>
										<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal{{$cl->id}}">View</button>
										<!-- Modal -->
										<div class="modal fade" id="exampleScrollableModal{{$cl->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
											<div class="modal-dialog modal-lg modal-dialog-scrollable">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">Club Achiever</h5>
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
														                   <th>Club Name</th>
														                   <th>Achieved Date</th>
														               </tr>
														           </thead>
														         <tbody>
														             @php
														             $ii=1;
														            $club_achiver_user=DB::table("club_achiver_user")->where("level_no",$cl->id)->get();
														             @endphp
														             @foreach($club_achiver_user as $cau)
														             @php
														             $user_tbl=DB::table("user")->where("id",$cau->user_id)->first();
														             @endphp
														             <tr>
														                 
														                 <td>{{$ii++}}</td>
														                 <td>{{$user_tbl->first_name}} {{$user_tbl->last_name}}</td>
														                 <td>{{$user_tbl->userid}}</td>
														                  <td>{{$cau->club_name}}</td>
                                                                           <td>{{date("d-M-Y",strtotime($cau->created_at))}}</td>
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
										</div>
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
