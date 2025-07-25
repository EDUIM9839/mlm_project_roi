@extends('user.layouts.main')
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
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Club Income</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
           
                 
                <div class="card">
              <div class="table-responsive text-nowrap">
                         <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class="table-dark">
                                    <th>Sr No</th>
                                    <th>Club Name</th>
                                    <th>Target Business</th>
                                    <th>Status</th>
                                    <th>Total Amount</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                
                                @foreach ($club_level as $d)
                                @php
                               $club_achiver_user= DB::table("club_achiver_user")->where("level_no",$d->id)->where("user_id",Auth::user()->id)->count();
                               $total_club_income=DB::table('income_history')->where('level_no', $d->id)->where('type', 'club_income')->where('received_user',Auth::user()->id)->where('credit_debit', 'credit')->sum("amount");
                                @endphp
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$d->club_name}}</td>
                                        <td>{{Helper::get_currency()}} {{$d->target_business}}</td>
                                        <td>
                                            @if($club_achiver_user>0)
                                            <span style="color:green;">Achieved</span>
                                            @else
                                            <span style="color:red;">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($club_achiver_user>0)
                                            {{Helper::get_currency()}} {{$total_club_income}}
                                            @else
                                            <span style="color:red;">NA</span>
                                            @endif
                                       </td>
                                        <td>
                                            @if($club_achiver_user>0)
                                            	<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal{{$d->id}}">View</button>
										<!-- Modal -->
										<div class="modal fade" id="exampleScrollableModal{{$d->id}}" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog modal-lg modal-dialog-scrollable">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">Club Income Summary</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														 <div class="table-responsive text-nowrap">
                                                           <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                                                           <table class="table dataTable no-footer" id=" " aria-describedby="example_info">  
                                                               <thead>
                                                                   <th>Sr</th>
                                                                   <th>Amount</th>
                                                                   <th>Date</th>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                    $club_income=DB::table('income_history')->where('level_no', $d->id)->where('type', 'club_income')->where('received_user',Auth::user()->id)->where('credit_debit', 'credit')->get();
                                                                    $i=1;
                                                                    @endphp
                                                                    @foreach($club_income as $club_incomes)
                                                                   
                                                                    <tr>
                                                                        <td>{{$i++}}</td>
                                                                        <td>{{Helper::get_currency()}} {{$club_incomes->amount}}</td>
                                                                        <td>{{date("d-m-Y",strtotime($club_incomes->date_time))}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
												     	 </div>
												       	</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
                                            @else
                                           <button type="button" class="btn btn-primary" disabled>View</button>
                                            @endif
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
    <!--end page wrapper -->
@endsection
