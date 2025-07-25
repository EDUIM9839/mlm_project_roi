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
                            <li class="breadcrumb-item active" aria-current="page">Withdrawal Request History</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
         
            <!-- Scrollable -->
            <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr class="table-dark">
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width: 46.9844px;">Sr.No.</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 76.1562px;"> User ID </th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Income Type: activate to sort column ascending" style="width: 144.797px;">Total Amount</th>
                             <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Income Type: activate to sort column ascending" style="width: 144.797px;">Charges </th>
                                   <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Income Type: activate to sort column ascending" style="width: 144.797px;">Net Amount </th>
                              <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Income Type: activate to sort column ascending" style="width: 144.797px;">Status</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Date Time</th>
                </tr>
                    </thead>
             <tbody>
                  
                  
                                     @php
                                    $i = 1;
                                @endphp
                                @foreach ($withdrawl_request as $drwal)
                  
                                    <tr>
                                        <td>{{ $i++ }}</td> 
                                          <td>{{Auth::user()->userid}}</td>
                                        <td>$ {{$drwal->amount}}</td> 
                                         <td>$ {{$drwal->amount*15/100}}</td>
                                         <td>$ {{$drwal->amount*85/100}}</td>
                                        <td>{{$drwal->status}}</td>
                                        <td>{{ Helper::formatted_date($drwal->created_at)}}</td>
                                       
                                    </tr>
                               @endforeach
                                
             </tbody>
                        </table>
                
            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection








