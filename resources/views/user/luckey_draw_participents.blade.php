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
                            <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Participants</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->
           
            <div class="card">
                <div class="card-header bg-dark text-white fs-6">
                    This Week Participants
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr class="table-dark">
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>UserId</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                           
                                
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($participents as $au)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$au->first_name}}{{$au->last_name}}</td>
                                        <td><span
                                            class="badge bg-gradient-ohhappiness text-white shadow-sm w-100">{{ $au->userid }}</span></td>
                                         
                                        <td><b><span style="color:green" >{{Helper::get_currency() . ucfirst($au->investment_amount) }}</span></b>
                                        </td>
                                        
                                        <td> 
                                        {{ Helper::formatted_date($au->created_at)}}
                                        <br>
                                        <small class="text-muted">{{ date('h:i:s a', strtotime($au->created_at))}}</span>
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
