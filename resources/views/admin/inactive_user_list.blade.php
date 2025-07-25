@extends('admin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Inactive User List</h6>
            <hr />
           <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>User Id</th>
                                   
                                    <th>Status</th>
                                    <th>Date</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($inactive_user as $au)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$au->first_name}} {{$au->last_name}}</td>
                                        <td><span
                                            class="badge bg-gradient-ohhappiness text-white shadow-sm w-100">{{ $au->userid }}</span></td>
                                            @php
                                            $check_status=DB::table('user_package')->where('status','approved')->where('user_id',$au->id)->first();
                                            @endphp
                                         @if(empty($check_status))
                                    <td style="color:red"><b>Inactive</b></td>
                                @endif
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
