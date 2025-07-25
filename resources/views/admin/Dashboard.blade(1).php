@extends('admin.layouts.main')
@section('pageTitle', 'DASHBOARD')
@section('mains')



<style>
        .swa {
    background: linear-gradient( 45deg , #200d3ac2, #473946ab)!important;
}
        .swaso{
           background: linear-gradient( to right, #f37335, #f37335 )!important;
               background: linear-gradient( to right, #ab609e, #ab609e )!important;
               background: linear-gradient( to right, #40243b, #40243b )!important;
               background: linear-gradient( to right, #000000,#000000 )!important;
        }
</style>
 
    
    
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            
            <div class="page-breadcrumb mb-3">
                <!--<div class="breadcrumb-title pe-3">Dashboard</div>-->
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"> Dashboard</i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>
                    </nav>
                </div>
                    <!--<div class="ms-auto">-->
                    <!--    <div class="btn-group">-->
                    <!--        <button type="button" class="btn btn-primary">Settings</button>-->
                    <!--        <button type="button"-->
                    <!--            class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"-->
                    <!--            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>-->
                    <!--        </button>-->
                    <!--        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"-->
                    <!--                href="javascript:;">Action</a>-->
                    <!--            <a class="dropdown-item" href="javascript:;">Another action</a>-->
                    <!--            <a class="dropdown-item" href="javascript:;">Something else here</a>-->
                    <!--            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated-->
                    <!--                link</a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
            </div>
            
            
           <div class="row ">
               
               <!--gy-4-->
                <div class="col-xxl-3 col-sm-6">
                    <div class="card bg--primary overflow-hidden box--shadow2 swaso" >
                        <a href="{{ route('user-list') }}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white swa"><i class="bx bxs-group"></i>
                                    </div>
                                </div>
                                    <div class="col-8 text-end">
                                    
                                    <h2 class="text-white"> {{ Helper::no_of_record('user')}}</h2>
                                    <span class="text-white text--small">Total Users</span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
            </div>
                
        <div class="col-xxl-3 col-sm-6">
                    <div class="card bg--primary overflow-hidden box--shadow2 swaso" >
                         <a href="{{ route('active-user-list') }}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <!--style="background: linear-gradient( 45deg , #1cfc1a, #f7b733)!important;-->
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white swa" ><i class="bx bxs-group"></i>
                                    </div>
                                </div>
                                    <div class="col-8 text-end">
                                   
                                    <h2 class="text-white">{{ count(Helper::active_inactive_users('active'))}}</h2>
                                     <span class="text-white text--small">Total Active Users</span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
            </div>
                
                  <div class="col-xxl-3 col-sm-6">
                    <div class="card bg--primary overflow-hidden box--shadow2 swaso">
                        <a href="{{ route('user-list') }}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <!--style='background: linear-gradient( 45deg , #ff0018, #740000)!important;-->
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white swa" ><i class="bx bxs-user-x"></i>
                                    </div>
                                </div>
                                    <div class="col-8 text-end">
                                   
                                    <h2 class="text-white">{{ count(Helper::active_inactive_users('inactive'))}}</h2>
                                     <span class="text-white text--small">Total Inactive Users</span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
            </div>
                      
                        <div class="col-xxl-3 col-sm-6">
                    <div class="card bg--primary overflow-hidden box--shadow2 swaso" >
                        <a href="{{ route('user-list') }}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4"> 
                                 <!--style='background-color: #ea5455 !important;;color:white'-->
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white swa" ><i class="bx bxs-cart"> </i>
                                    </div>
                                </div>
                                    <div class="col-8 text-end">
                                 
                                    <h2 class="text-white">{{ count(Helper::active_inactive_users('inactive'))}}</h2>
                                       <span class="text-white text--small">Total Inactive Users</span>
                                </div>
                            </div>
                            
                        </div>
                        
                        </a>
                        
                    </div>
                    
            </div>
                
         
    </div>
  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
              
                <!--<div class="col">-->

                    
                <!--    <div class="card radius-10 border-start border-0 border-4 border-danger">-->
                <!--        <div class="card-body">-->
                <!--            <div class="d-flex align-items-center">-->
                <!--                <div>-->
                <!--                    <p class="mb-0 text-secondary">Total Distribution</p>-->
                <!--                    <h4 class="my-1 text-danger">{{Helper::get_currency()}}{{Helper::total_distribution()}} </h4>-->
                <!--                    <p class="mb-0 font-13 text-primary">+{{Helper::get_currency()}}{{Helper::total_distribution('last7days')}} from last week</p>-->
                <!--                </div>-->
                <!--                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i-->
                <!--                        class='bx bxs-wallet'></i>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col">-->
                <!--    <div class="card radius-10 border-start border-0 border-4 border-success">-->
                <!--        <div class="card-body">-->
                <!--            <div class="d-flex align-items-center">-->
                <!--                <div>-->
                <!--                    <p class="mb-0 text-secondary">Company Profit</p>-->
                <!--                    <h4 class="my-1 text-success">  {{Helper::get_currency()}} @if((Helper::total_collection()- Helper::total_distribution())>0){{Helper::total_collection()- Helper::total_distribution()}} @else {{'0'}} @endif </h4>-->
                <!--                    <p class="mb-0 font-13 text-primary">+{{Helper::get_currency()}}{{Helper::total_collection('last7days')}} collection last week</p>-->
                <!--                </div>-->
                <!--                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i-->
                <!--                        class='bx bxs-bar-chart-alt-2'></i>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col">-->
                <!--    <div class="card radius-10 border-start border-0 border-4 border-danger">-->
                <!--        <div class="card-body">-->
                <!--            <div class="d-flex align-items-center">-->
                <!--                <div>-->
                <!--                    <p class="mb-0 text-secondary">Fund Request</p>-->
                <!--                    <h4 class="my-1 text-danger">{{  Helper::fund_request()}}</h4>-->
                <!--                    <p class="mb-0 font-13 text-primary">+{{  Helper::fund_request('last7days')}} from last week</p>-->
                <!--                </div>-->
                <!--                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i-->
                <!--                    class='bx bx-rupee'></i>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->


                <!--<div class="col">-->
                <!--    <div class="card radius-10 border-start border-0 border-4 border-danger">-->
                <!--        <div class="card-body">-->
                <!--            <div class="d-flex align-items-center">-->
                <!--                <div>-->
                <!--                    <p class="mb-0 text-secondary">Pending Withdrawl</p>-->
                <!--                    <h4 class="my-1 text-danger"> {{  Helper::withdrawl_request()}}</h4>-->
                <!--                    <p class="mb-0 font-13 text-primary">+ {{  Helper::withdrawl_request('last7days')}} from last week</p>-->
                <!--                </div>-->
                <!--                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i-->
                <!--                        class='bx bx-time'></i>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div><!--end row-->
            
            
            
 <div class="row ">
               
               <!--gy-4-->
                <div class="col-xxl-3 col-sm-6">
                    <div class="card bg--primary overflow-hidden box--shadow2 swaso">
                        <a href="{{ route('user-list') }}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white swa"><i class="bx bxs-group"></i>
                                    </div>
                                </div>
                                    <div class="col-8 text-end">
                                    <h2 class="text-white"> {{ Helper::no_of_record('user')}}</h2>
                                     <span class="text-white text--small">Users Total Bv Cut</span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
            </div>
                
        <div class="col-xxl-3 col-sm-6">
                    <div class="card bg--primary overflow-hidden box--shadow2  swaso">
                         <a href="{{ route('active-user-list') }}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white swa" ><i class="bx bxs-group"></i>
                                    </div>
                                </div>
                                    <div class="col-8 text-end">
                                    <h2 class="text-white">{{ count(Helper::active_inactive_users('active'))}}</h2>
                                     <span class="text-white text--small">Users Total BV</span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
            </div>
                
                  <div class="col-xxl-3 col-sm-6">
                    <div class="card bg--primary overflow-hidden box--shadow2  swaso">
                        <a href="{{ route('user-list') }}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white swa "><i class="bx bxs-user-x"></i>
                                    </div>
                                </div>
                                    <div class="col-8 text-end">
                                   
                                    <h2 class="text-white">{{ count(Helper::active_inactive_users('inactive'))}}</h2>
                                     <span class="text-white text--small">Users Left BV</span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
            </div>
                        <div class="col-xxl-3 col-sm-6">
                    <div class="card bg--primary overflow-hidden box--shadow2  swaso">
                        <a href="{{ route('user-list') }}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white swa"  ><i class="bx bxs-cart"> </i>
                                    </div>
                                </div>
                                    <div class="col-8 text-end">
                                   
                                    <h2 class="text-white">{{ count(Helper::active_inactive_users('inactive'))}}</h2>
                                     <span class="text-white text--small">Users Right BV</span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
            </div>
                
         
    </div>

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

