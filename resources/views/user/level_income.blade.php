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
                            <li class="breadcrumb-item active" aria-current="page">Level Income</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
           
                 
                <div class="card">
              <div class="table-responsive text-nowrap">
                        <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                        <table class="table dataTable no-footer" id=" " aria-describedby="example_info">  
                            <thead>
                                <tr class="table-dark">
                                    <th>Sr No</th>
                                    
                                    <th>Level No</th>
                                    <th>Direct Required</th>
                                    <th>Current Direct</th>
                                    <th>Total Amount</th>
                                    <th>View Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($level as $d)
                                @php
                           $total_amount = DB::table('income_history')->where('level_no', $d->id)->where('type', 'level')->where('received_user',Auth::user()->id)->where('credit_debit', 'credit')->sum('amount');
                           $lpstotal_amount = DB::table('income_history')->where('level_no', $d->id)->where('type', 'level')->where('received_user',Auth::user()->id)->sum('laps_amount');
                                @endphp
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                       
                                         <td> {{$d->id}}</td>
                                       
                                           
                                       
                                            <td>{{$d->direct}}</td>
                                         <td>
                                          @if($d->direct <= $total_direct) 
                                      <span class="badge bg-gradient-quepal text-white shadow-sm w-90"> {{$total_direct}}</span>
                        
                                             @else
                                         <span class="badge bg-gradient-burning text-white shadow-sm w-90">---</span>
                                          @endif
                                          
                                        </td>
                                        <td>@if($total_amount+$lpstotal_amount>0){{Helper::get_currency()}} <span style="color:green">{{ number_format($total_amount, 2, '.', '') }}</span>/<span style="color:red">{{ number_format($lpstotal_amount, 2, '.', '') }}</span> @else NA @endif</td>
                                        <td>
                                         @if($total_amount+$lpstotal_amount>0) 
										<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal{{$d->id}}">View</button>
										<!-- Modal -->
										<div class="modal fade" id="exampleScrollableModal{{$d->id}}" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog modal-lg modal-dialog-scrollable">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">Level Income Summary</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														 <div class="table-responsive text-nowrap">
                                                           <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                                                           <table class="table dataTable no-footer" id=" " aria-describedby="example_info">  
                                                               <thead>
                                                                   <th>Sr</th>
                                                                   <th>Joind User Name</th>
                                                                   <th>Joind Id</th>
                                                                   <th>Level No</th>
                                                                   <th>Total Amount</th>
                                                                   <th>Lapse Amount</th>
                                                                   <th>Received Amount</th>
                                                                   <th>Date</th>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                    $level_income=DB::table('income_history')->where('level_no', $d->id)->where('type', 'level')->where('received_user',Auth::user()->id)->get();
                                                                    $ii=1;
                                                                    @endphp
                                                                    @foreach($level_income as $level_incomes)
                                                                    @php
                                                                   $joind_user=DB::table("user")->where("id",$level_incomes->joined_user)->first();
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{$ii++}}</td>
                                                                        <td>{{$joind_user->first_name}}</td>
                                                                        <td>{{$joind_user->userid}}</td>
                                                                        <td>{{$level_incomes->level_no}}</td>
                                                                        <td style="color:#cba400">{{Helper::get_currency()}} {{ number_format($level_incomes->amount+$level_incomes->laps_amount, 2, '.', '')}}</td>
                                                                        <td style="color:red">{{Helper::get_currency()}} {{ number_format($level_incomes->laps_amount, 2, '.', '')}}</td>
                                                                        <td style="color:green">{{Helper::get_currency()}} {{ number_format($level_incomes->amount, 2, '.', '')}}</td>
                                                                        <td>{{date("d-m-Y",strtotime($level_incomes->date_time))}}</td>
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
										@else 	<button type="button" class="btn btn-primary" disabled>View</button> @endif
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
