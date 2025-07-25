@extends('user.layouts.main')
@section('mains')
   <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            
            <h6 class="mb-0 text-uppercase alert  ">Total Direct User List</h6>
           
            <hr />
           <div class="card border-dark">
              <div class="border-dark table-responsive text-nowrap">
                   
                     <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding:5px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>UserId</th>
                                    <th>Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                  @php
                                    $i = 1;
                                 
                                @endphp
                                @foreach ($total_direct as $d)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                         <td>{{$d->first_name}} {{$d->last_name}}</td>
                                        <td>{{$d->userid}}</td>
                                         <td>
                                             @php
                                             $check_users=DB::table('user_package')->where('status','approved')->where('user_id',$d->id)->first();
                                             @endphp
                                             @if(empty($check_users))
                                             
                                             <span style='color:red'>Pending</span>
                                             @else
                                              <span style='color:green'>Active</span>
                                             @endif
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
