@extends('admin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Pending User List</h6>
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
                                    <th>Amount</th>
                                    <th>Payment Type</th>
                                    <th>Proof of Payment</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($user_pending as $au)
                                @php
                                $users=DB::table('user')->where('id',$au->user_id)->first();
                                @endphp
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$users->first_name}} {{$users->last_name}}</td>
                                        <td><span
                                            class="badge bg-gradient-ohhappiness text-white shadow-sm w-100">{{ $users->userid }}</span></td>
                                          <td>{{Helper::get_currency()}}{{ $au->amount}}</td>
                                          <td>{{ ucfirst($au->payment_type)}}</td>
                                           <td>@if($au->payment_type=="barcode")<a href="{{ Storage::url('app/proof_of_payment/').$au->proof_image}}" target="_blank"><img src="{{ Storage::url('app/proof_of_payment/').$au->proof_image}}" style="width: 80px; height: 80px;"></a>@endif</td>
                                    <td style="color:red"><b>{{$au->status}}</b></td>
                              
                                            <td>{{ Helper::formatted_date($au->created_at)}}</td>
                                            <td><a href="{{route('active_package',['id'=>$au->id])}}"><button  class="btn btn-success">Approve</button></a></td>
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
