@extends('admin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">C.T.O Achievers</h6>
            <hr />
           <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>User Name</th>
                                   <th>Mobile No</th>
                                    <th>User Id</th>
                                  
                                    <th>Achieved Date</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($cto as $c)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$c->first_name}} {{$c->last_name}}</td>
                                        <td>{{$c->contact}}</td>
                                        <td><span
                                            class="badge bg-gradient-ohhappiness text-white shadow-sm w-100">{{ $c->userid }}</span></td>
                                           
                                
                                            <td>{{ Helper::formatted_date($c->created_at)}}</td>
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
