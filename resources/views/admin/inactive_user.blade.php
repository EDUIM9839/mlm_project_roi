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
                            <li class="breadcrumb-item active" aria-current="page">Inactive User List</li>
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
                                    <th>Name</th>
                                    <th>UserId</th>
                                    <th>Mobile No.</th>
                                     
                                    <th>Sponser</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                     <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                 @php
                                    $i = 1;
                                    
                                @endphp
                                @foreach ($data as $datas)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$datas->first_name}} {{$datas->last_name}}</td>
                                        <td>
                                            <span class="badge bg-gradient-ohhappiness text-white shadow-sm w-100">{{$datas->userid}}</span>
                                        </td>
                                        <td>{{$datas->contact}}</td>
 
                                        <td>{{$datas->referal}}</td>
                                         <td>{{ Helper::formatted_date($datas->created_at) }}</td>
                                          <td>{!! Helper::check_active_inactive($datas->id,'colorful') !!} </td>
                                          
                                        <td>
                                             <div class="d-flex order-actions">
												<a href="{{ route('user-edit', ['id' => $datas->id]) }}"class=""><i class="bx bxs-edit"></i></a>
											 
												 
										
                                            
                                            <!--<a href="{{ route('user-edit', ['id' => $datas->id]) }}"> <i class='bx bxs-edit' style="font-size: 20px;position: relative;font-weight: bold;color: red;"></i></a>-->
                                            
                                            &nbsp;&nbsp;
                                       <a href="{{ route('user-details', ['id' => $datas->id]) }}" > 
                                       <svg   !important;" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye "><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                       </a>
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
