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
                            <li class="breadcrumb-item active" aria-current="page">My Downline</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
            <!-- Scrollable -->
            
            
          
                
                
            <div class="card" style="width: 40%;left: 30%;">
							<div class="card-body">
							    <h6 style="color:green">Downline</h6></span>
								<hr/>
								<form action='{{route("FindAllReferalUserUnderAuser")}}'>
								    <div class='row'>
								        
								            <div class="mb-3">
                                                <label class="form-label">Level:</label>
                                                     <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                                                <input type="text" class="form-control" name='level' id='level' placeholder='Enter Level'>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">User Id:</label>
                                                 <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                                <input type="text" class="form-control" name='userid' id='userid' placeholder='Enter User Id'>
                                            </div><br>
                                            <div class="d-flex justify-content-center">
                                               <button type="submit" class="btn btn-success">Search</button>
                                            </div><br>
								        </div>
								        
								        
								       </div>
						
								    </div>
								</form>
							  
						</div> 
						</div> 
            <div class="card">
                
                <div class="color-sidebar sidebarcolor8 color-header headercolor2">
                                <div class="card p-3 m-4" style="text-align:center;">
                                <h3 style="color:black!important" class="p-0 text-light">Total Downline: {{$total_downline}}</h3>
                                 <div class="row">
                                    <div class="col-sm-6">Total Left: {{$count_left}}</div>
                                    <div class="col-sm-6">Total Right: {{$count_right}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Today left business: {{$today_total_left_business}}</div>
                                    <div class="col-sm-6">Today right business: {{$today_total_right_business}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Total left business: {{$total_left_business}}</div>
                                    <div class="col-sm-6">Total right business: {{$total_right_business}}</div>
                                </div>
                                <div class="row">


                                </div>
                            </div>
                            
                            <div id="orgChartContainer">
                                <div id="orgChart"></div>
                                </div></br>
            </div>
            
            <div class="table-responsive text-nowrap">
            <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
            <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                <thead>
                    <tr class="table-dark">
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width: 46.9844px;">Sr.No.</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 76.1562px;">User Id</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 209.875px;">Name</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 94.0156px;">Status</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Join Date</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Downline: activate to sort column ascending" style="width: 94.0156px;">Downline</th>
                    </tr>
                </thead>
             <tbody>
                 
                @php
                $i=1;
                @endphp
                @foreach($referal as $value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$value->userid}}</td>
                        <td>{{$value->first_name}} {{$value->last_name}}</td>
                        <td>{!!Helper::check_active_inactive($value->id,true) !!}</td>
                        <td>{{ Helper::formatted_date($value->created_at)}}</td>
                        <td><a href="{{route('downline').'?userid='.$value->userid}}">Downline</a></td>
                    </tr>
                @endforeach
             </tbody>
            </table>
                
            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content --> 
        </div>
            <!--  -->
        </div>
         
@endsection
