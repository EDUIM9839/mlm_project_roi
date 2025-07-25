@extends('admin.layouts.main')
@section('mains')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet">


<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                    </ol>
                </nav>
            </div>


        </div>
        <!--end breadcrumb-->
        <!--<h6 class="mb-0 text-uppercase alert  ">All User List</h6>-->
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
                    <div class="font-35 text-white"><i class='bx bxs-message-square-check-x'></i>
                    </div>
                    <div class="ms-3">

                        <div class="text-white">{!!session()->get('error')!!}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-dark">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">{{$title}} List</h5>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs reward-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link {{request('status') == 'active' ? '' : 'active'}} {{ empty(request('status')) ? 'active' : ''  }}"
                            id="home-tab" data-bs-toggle="tab" data-url="pending" data-bs-target="#home-tab-pane"
                            type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Pending Rewards
                            (<span class="text-danger">{{count($pendingRewardCount)}}</span>)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{request('status') == 'active' ? 'active' : ''}}" id="profile-tab"
                            data-bs-toggle="tab" data-url="active" data-bs-target="#profile-tab-pane" type="button"
                            role="tab" aria-controls="profile-tab-pane" aria-selected="false">Approved Rewards</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade  {{request('status') == 'pending' ? 'active show' : ''}} {{ empty(request('status')) ? 'active show' : ''  }}"
                        id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="border-dark table-responsive text-nowrap">

                            <div id="example_wrapper" class="dataTables_wrapper no-footer mt-3" style="padding:5px" ;>

                                <table class="table dataTable no-footer" id="example" aria-describedby="example_info">
                                    <thead>
                                        <tr class='table-dark fw-medium'>
                                            <th>#</th>
                                            <th class="text-center">User</th>
                                            <th class="">Level No.</th>
                                            <th class="">Reward Amount</th>
                                            <th class="">Reward Name</th>
                                            <th class="">Delivery Status</th>
                                            <th class="">Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($pendingRewards as $k => $users)
                                        @php
                                            $rewardParts = explode('/', $users->reward_name ); // Split the string into an array
                                            $userData = DB::table('user')->where('id', $users->user_id)->select('userid','first_name','last_name')->first();
                                        @endphp
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td>
                                                    <span class="badge bg-gradient-ohhappiness text-white shadow-sm">
                                                    {{ $userData->userid }}  {{ $users->user_id }} {{ $users->id }}  
                                                </span>
                                                <br>    
                                                <span class="text-capitalize " style="font-size: 14px;">
                                                        {{ $userData->first_name }} {{ $userData->last_name }}
                                                </span>
                                                </td>
                                                <td>{{ $users->level_no }}</td>
                                               
                                                <td>{{ $rewardParts[0] }}</td> 
                                                <td>{{ $rewardParts[1] }}</td>
                                                <td>
                                                    <span class="badge bg-warning text-black shadow-sm text-capitalize">{{ $users->delivery_status }}</span> 
                                                </td>
                                                <td>{{ $users->date_time }}</td>
                                                
                                                <td>
                                                    {{-- <a href="{{ route('kys_pending_status', ['id' => $users->id, 'status' => 'verify']) }}"
                                                        onclick="return confirm('Are you Sure!')"
                                                        class="btn btn-success btn-sm">
                                                        Verify</a>--}}
                                                    <a href="{{route('reward.approve', ['id' => $users->id])}}"
                                                        onclick="return confirm('Are you Sure!')"
                                                        class="btn btn-success btn-sm">
                                                        Approve</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                              
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{request('status') == 'active' ? 'active show' : ''}}"
                        id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="border-dark table-responsive text-nowrap">

                            <div id="example_wrapper" class="dataTables_wrapper no-footer mt-3" style="padding:5px" ;>

                                <table class="table dataTable no-footer" id="example3" aria-describedby="example_info">
                                    <thead>
                                    <tr class='table-dark fw-medium'>
                                            <th>#</th>
                                            <th class="text-center">User</th>
                                            <th class="">Level No.</th>
                                            <th class="">Reward Amount</th>
                                            <th class="">Reward Name</th>
                                            <th class="">Delivery Status</th>
                                            <th class="">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($user as $k => $users)
                                        @php
                                            $rewardParts = explode('/', $users->reward_name ); // Split the string into an array
                                            $userData = DB::table('user')->where('id', $users->user_id)->select('userid','first_name','last_name')->first();
                                        @endphp
                                        <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td>
                                                    <span class="badge bg-gradient-ohhappiness text-white shadow-sm">
                                                    {{ $userData->userid }} 
                                                </span>
                                                <br>    
                                                <span class="text-capitalize " style="font-size: 14px;">
                                                        {{ $userData->first_name }} {{ $userData->last_name }}
                                                </span>
                                                </td>
                                                <td>{{ $users->level_no }}</td>
                                              
                                                <td>{{ $rewardParts[0] }}</td> 
                                                <td>{{ $rewardParts[1] }}</td>
                                                <td>
                                                    <span class="badge bg-success text-white shadow-sm text-capitalize">{{ $users->delivery_status }} </span>   
                                                    </td>
                                                <td>{{ $users->date_time }}</td>
                                               
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $user->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js" defer>  </script>

<script>
    document.querySelectorAll('.nav-link').forEach(element => {
        console.log('Nav link clicked!');
        element.addEventListener('click', () => {
            // element.getAttribute('data-url');
            Utility.setUrlParam('status', element.getAttribute('data-url'));
        });
    });
</script>
@endsection