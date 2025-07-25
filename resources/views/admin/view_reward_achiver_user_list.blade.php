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
                            <li class="breadcrumb-item active" aria-current="page">{{ucfirst($reward_vip->rank_name)}} Achiever History</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->
            <!--<h6 class="mb-0 text-uppercase alert  ">All User List</h6>-->
           
            <hr />
           <div class="card border-dark p-2">
               @if (session()->has('success'))
                                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class='bx bxs-message-square-check'></i>
                                            </div>
                                            <div class="ms-3">
                                                 
                                                <div class="text-white">{!!session()->get('success')!!}</div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @elseif(session()->has('error'))

                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                        </div>
                                        <div class="ms-3">
                                             
                                            <div class="text-white">{!!session()->get('error')!!}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                                @endif
              <div class="border-dark table-responsive text-nowrap">
                  
                     <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding:5px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>User Name</th>
                                    <th>User Id</th>
                                    <th>Reward Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                             <tbody>
                                 @php
                                 $i=1;
                                 @endphp
                                 @foreach($reward_achieved_user as $rau)
							   @php
							   $user_tbl=DB::table("user")->where("id",$rau->user_id)->first();
							   @endphp
							   <tr>
							       
							       <td>{{$i++}}</td>
							       <td>{{$user_tbl->first_name}} {{$user_tbl->last_name}}</td>
							       <td>{{$user_tbl->userid}}</td>
                                   <td>{{$reward_vip->reward_name}}</td>
                                   <td>{{date("d-M-Y",strtotime($rau->date_time))}}</td>
                                   <td>
                                       @if($rau->delivery_status=="pending")
                                         <a href="{{route('change_reward_status',['id'=>$rau->id])}}"><span class=" badge bg-gradient-burning text-white shadow-sm w-100">Pending</span></a>
                                         
                                       @else
                                      <span class=" badge bg-gradient-ohhappiness text-white shadow-sm w-100">Delivered</span>
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
@endsection
