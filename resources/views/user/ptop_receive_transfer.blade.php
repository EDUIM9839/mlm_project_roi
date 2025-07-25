@extends('user.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
               <h6 class="mb-0 text-uppercase alert  ">P2P  received History</h6>
       <hr/>
         
            <!-- Scrollable -->
            <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr class="table-dark">
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width: 46.9844px;">Sr.No.</th>
                        <!--<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 76.1562px;">Recieve User ID </th>-->
                        <!--<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 76.1562px;">Recieve Name</th>-->
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 76.1562px;">Sender User Id </th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 209.875px;">Sender Name</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Income Type: activate to sort column ascending" style="width: 144.797px;">Amount</th>
                        
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Date Time</th>
                </tr>
                    </thead>
             <tbody>
                 
                                     @php
                                    $i = 1;
                                @endphp
                                @foreach ($ptop_transeferr as $ptop)
                                    <tr>
                                        <td>{{ $i++ }}</td> 
                                         <!--<td>{{Auth::user()->userid}}</td>-->
                                         <!--<td>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</td>-->
                                        <td>{{$ptop->userid}}</td>
                                        <td>{{$ptop->first_name}} {{$ptop->last_name}}</td>
                                        <td>$ {{ $ptop->total_amount }}</td> 
                                       
                                        <td>{{ Helper::formatted_date($ptop->date)}}</td>
                                       
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
