@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <a href="{{ route('user-list') }}">
                        <div class="card radius-10 border-start border-0 border-4 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total No of Users</p>
                                        <h4 class="my-1 text-warning">
                                            {{
                                              Helper::no_of_record('user')
                                            }}
                                        </h4>
                                        <p class="mb-0 font-13">+{{Helper::no_of_record('user','last7days')}} from last 7 days</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                            class='bx bxs-group'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('active-user-list') }}">
                        <div class="card radius-10 border-start border-0 border-4 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Active Users</p>
                                        <h4 class="my-1 text-warning">
                                            {{ count(Helper::active_inactive_users('active'))}}

 

                                        
                                        </h4>
                                        <p class="mb-0 font-13">+{{ count(Helper::active_inactive_users('active','last7days'))}} from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto" style="background: linear-gradient( 45deg , #1cfc1a, #f7b733)!important;"><i class='bx bxs-user-check'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('user-list') }}">
                        <div class="card radius-10 border-start border-0 border-4 border-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Inactive Users</p>
                                        <h4 class="my-1 text-warning">
                                        
                                                 {{ count(Helper::active_inactive_users('inactive'))}}
                                            
                                        </h4>
                                        <p class="mb-0 font-13">+{{ count(Helper::active_inactive_users('active','last7days'))}} active from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto" style="background: linear-gradient( 45deg , #ff0018, #740000)!important;">
                                    <i class='bx bxs-user-x'> </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-4 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Collection</p>
                                    <h4 class="my-1 text-info"> {{Helper::get_currency()}}{{Helper::total_collection()}}</h4>
                                    <p class="mb-0 font-13 text-primary">+{{Helper::get_currency()}}{{Helper::total_collection('last7days')}} from last week</p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                        class='bx bxs-cart'> </i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">

                    
                    <div class="card radius-10 border-start border-0 border-4 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Distribution</p>
                        <h4 class="my-1 text-danger">{{Helper::get_currency()}}{{round(Helper::total_distribution(),2)}} </h4>
                                    <p class="mb-0 font-13 text-primary">+{{Helper::get_currency()}}{{Helper::total_distribution('last7days')}} from last week</p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                        class='bx bxs-wallet'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-4 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Company Profit</p>
                                    <h4 class="my-1 text-success">  {{Helper::get_currency()}}{{Helper::total_collection()- Helper::total_distribution()}} </h4>
                                    <p class="mb-0 font-13 text-primary">+{{Helper::get_currency()}}{{  Helper::total_collection('last7days')-Helper::total_distribution('last7days')}} from last week</p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                        class='bx bxs-bar-chart-alt-2'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-4 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Fund Request</p>
                                    <h4 class="my-1 text-danger">{{  Helper::fund_request()}}</h4>
                                    <p class="mb-0 font-13 text-primary">+{{  Helper::fund_request('last7days')}} from last week</p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                    class='bx bx-rupee'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="card radius-10 border-start border-0 border-4 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Pending Withdrawl</p>
                                    <h4 class="my-1 text-danger"> {{  Helper::withdrawl_request()}}</h4>
                                    <p class="mb-0 font-13 text-primary">+ {{  Helper::withdrawl_request('last7days')}} from last week</p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                        class='bx bx-time'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->

<div class="row">
        <div class="col-md-6">
            <div class="card radius-10">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Top Earners 

                            <img src="{{ Storage::url('app/public/earner.gif')}}" height='30' width='30'>   
                            </h6>

                            
             

</div>
                        <div class="dropdown ms-auto">
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
                        <table  class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                   <th>User Id</th>
                                    <th>Earning </th>
                                     
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                    $top_earners=Helper::top_earners();
                                @endphp
                                @foreach ($top_earners as $d)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $d->first_name }} {{ $d->last_name }} </td>
                                        <td><span
                                            class="badge bg-gradient-quepal text-white shadow-sm w-100">{{ $d->userid }}</span>
                                    </td>
                                         <td> {{Helper::get_currency()}}{{$d->sum}}</td>
                                      
                                        {{-- <td>{{ $d->created_at->format('d-m-Y') }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card radius-10">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Recent Joiners  <i  style='font-size:25px;' class='bx bx-select-multiple'> </i></h6>
                        </div>
                        <div class="dropdown ms-auto">
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
                        <table  class="table table-striped table-bordered" style="width:100%">
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
                                @foreach ($recent_joiners as $rj)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $rj->first_name }}  {{ $rj->last_name }}</td>
                                        
                                        <td><span
                                                class="badge bg-gradient-quepal text-white shadow-sm w-100">{{ $rj->userid }}</span>
                                        </td>
                                       
                                        <td>{{ Helper::formatted_date($rj->created_at) }}</td>
                                        <td>{!! Helper::check_active_inactive($rj->id,'colorful') !!} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>





        </div>
    </div>
    <!--end page wrapper -->
@endsection
