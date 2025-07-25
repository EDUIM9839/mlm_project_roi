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
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Active User List</li>
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
                        <!--<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"-->
                        <!--        href="javascript:;">Action</a>-->
                        <!--    <a class="dropdown-item" href="javascript:;">Another action</a>-->
                        <!--    <a class="dropdown-item" href="javascript:;">Something else here</a>-->
                        <!--    <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated-->
                        <!--        link</a>-->
                        <!--</div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
            <!--end breadcrumb-->
            <!--<h6 class="mb-0 text-uppercase">Active User List</h6>-->
            <!--<hr />-->
           <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>User Id</th>
                                    <th>Package</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php   $i = 1;   @endphp
                                @foreach ($active_user as $au)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$au->first_name}} {{$au->last_name}}</td>
                                        <td><span
                                            class="badge bg-gradient-ohhappiness text-white shadow-sm w-100">{{ $au->userid }}</span></td>
                                        <td>{{Helper::get_currency()}} {{ $au->cost }}</td>
                                        <td>
                                            @if($au->status=="approved")
                                                 {!!'<span style="color:green">Approved</span>'!!}
                                                 @else
                                                 {!!'<span style="color:red">Pending</span>'!!}
                                                  @endif
                                            </td>
                                        
                                            <td>{{ Helper::formatted_date($au->created_at)}}</td>
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
