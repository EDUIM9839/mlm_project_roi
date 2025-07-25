@extends('user.layouts.main')
<style>
    .gradient-blue{
        background: linear-gradient(45deg, #4272e6, #00b5be) !important;
    }

</style>
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
               <h6 class="mb-0 text-uppercase alert  ">P2P History</h6>
       <hr/>
         
            <!-- Scrollable -->
            <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr class="table-dark">
                        <th>Sr.No.</th>
                        <th>Sender</th>
                        <th>Reciever</th>
                        <th>Paying Amount</th>
                        <!--<th>Recieved Amount</th>-->
                        <!--<th>Deduct Amount</th>-->
                        <!--<th>Description</th>-->
                        <th>Date Time</th>
                </tr>
                    </thead>
             <tbody>
                 
                                     @php
                                    $i = 1;
                                @endphp
                                @foreach ($ptop_transeferr as $ptop)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td class='textcenter'>  {{$ptop->sfirst_name}} {{$ptop->slast_name}}<br>
                                        @if($ptop->suserid == Auth::user()->userid)
                                         <span class="badge gradient-blue text-white shadow-sm w-80">{{$ptop->suserid}}  </span>
                                        @else
                                        <span class="badge bg-gradient-quepal text-white shadow-sm w-80">{{$ptop->suserid}}  </span>
                                        @endif
                                        </td>
                                      
                                        <td class='textcenter'>  
                                        {{$ptop->rfirst_name}} {{$ptop->rlast_name}}<br>
                                        
                                         @if($ptop->ruserid == Auth::user()->userid)                                        
                                        <span class="badge gradient-blue text-white shadow-sm w-40">{{$ptop->ruserid}} </span>
                                        @else
                                        
                                        <span class="badge bg-gradient-quepal text-white shadow-sm w-40">{{$ptop->ruserid}} </span>
                                        @endif
                                        
                                        </td>
                                        <td>{{Helper::get_currency()}}{{ $ptop->total_amount }}</td> 
                                        <!--<td>{{Helper::get_currency()}}{{ $ptop->amount }}</td>-->
                                        <!--<td>{{Helper::get_currency()}}{{ $ptop->deduction_amount }}</td>-->
                                         <!--<td>{{ $ptop->description }}</td> -->
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
