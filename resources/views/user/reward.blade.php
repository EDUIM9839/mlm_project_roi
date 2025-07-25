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
                            <li class="breadcrumb-item active" aria-current="page">Reward Income</li>
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
                                 
                                    <th>Rank Name</th>
                                    <th>Target Business</th>
                                    <th> Reward Name</th>
                                    <th>Status</th>
                                    <th>Delivery Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($reward as $d)
                                @php
                                $bouns = DB::table('reward_achieved_user')->where('level_no',$d->id)->where('user_id',Auth::user()->id)->first();
                                @endphp
                                
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                
                                        <td>{{ ucfirst($d->rank_name) }}
                                        </td>
                                        <td>
                                           {{Helper::get_currency()}} {{$d->target_business}}
                                        </td>
                                        
                                        <td>{{$d->reward_name}}</td>
                                       
                                        <td>@if(!empty($bouns)) <span class=" badge bg-gradient-ohhappiness text-white shadow-sm w-100">Achieved</span> @else  <span class=" badge bg-gradient-burning text-white shadow-sm w-100">Pending</span>@endif</td>
                                        <td>@if(!empty($bouns))@if($bouns->delivery_status=="delivered") <span class=" badge bg-gradient-ohhappiness text-white shadow-sm w-100">Delivered</span> @else  <span class=" badge bg-gradient-burning text-white shadow-sm w-100">Pending</span>@endif @else <span class=" badge bg-gradient-burning text-white shadow-sm w-100">Pending</span> @endif</td>
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
