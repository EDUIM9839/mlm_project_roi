
 @extends('user.layouts.main')
 
 
<style>
    
    @media(max-width: 600px){
     .totalAmountCard{
         width: 100%;
         display: flex;
         align-items: center;
         justify-content: center;
         margin-top: 0 !important;
         margin-bottom: 5px !important;
     }
     .nav-pills{
         margin-bottom: 0 !important;
     }
     .totalAmountCardParent{
         margin-top: 0 !important;
     }
     
    }
    
     .nav-pills .nav-link.active{
             background-color: #36a817 !important;
     }
     .nav-pills .nav-link.inactive{
         color: #ffffff !important;
        background: #df0c0c;
     }
     .totalAmountCard{
             background: #d4ffd4 !important;
            color: green ;
            border: 2px solid #0080002e !important;
            box-shadow: none !important;
     }
     
</style>
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
               <h6 class="mb-0 text-uppercase alert  ">Withdrawl History</h6>
       <hr/>
         
            <!-- Scrollable -->
            <div class="card">
                
                   <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 g-3 align-items-center d-flex px-2">
                      
                      <div class="col">
                          <ul class="nav nav-pills my-3 ms-2 ">
                            <li class="nav-item">
                              <a class="nav-link {{ $currency == 'dollar' ? 'active'  : 'inactive' }}" href="?currency=dollar">Dollar ($)</a>
                            </li>
                            {{--<li class="nav-item ms-2">
                              <a class="nav-link {{ $currency == 'inr' ? 'active'  : 'inactive' }}" href="?currency=inr">Rupee (₹)</a>
                            </li>
                            --}}
                      
                          </ul>
                      </div>
                      <div class="col d-flex align-items-center totalAmountCardParent">
                          <div class='card ms-auto mt-3 p-2 px-3 d-flex flex-row me-1 totalAmountCard'>
                              <strong>
                                  Total Amount : </strong> <div>&nbsp; {{ $currency == 'dollar' ? '$ ' . $totalDollarPaid : '₹ ' . $totalInrPaid}} </div>
                          </div>
                      </div>
                      
                </div>             
                   
                
                
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr class="table-dark">
                     <th>Sr no.</th>
                     <!--<th>Currency Type</th>-->
                     <!--<th>Wallet Type</th>-->
                     <th>Total Amount</th>
                     <th>Charge </th>
                     <th>Received Amount</th>
                     @if($currency == 'dollar')
                      <th> Transaction Status</th>
                     @endif
                     <th>Request Date</th>
                     <th>Status</th>
                </tr>
                    </thead>
             <tbody>
                               @php
                                    $i = 1;
                                    
                                   
                                @endphp
                                @foreach ($transaction as $da)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                         {{--  <td>@if($da->currency_type=="inr") INR @else Dollor @endif</td>
                                           <td>@if($da->wallet_type=="club_wallet") Club Wallet @elseif($da->wallet_type=="roi_wallet") ROI Wallet @else Incentive Wallet @endif</td>
                                           --}}
                                           
                                           
                                         <td>@if($da->currency_type=="inr") ₹{{$da->amount_inr}} @else {{Helper::get_currency()}}{{$da->amount}} @endif </td> 
                                           <td>@if($da->currency_type=="inr") ₹{{$da->amount_inr*10/100}} @else {{Helper::get_currency()}}{{$da->amount*10/100}} @endif </td> 
                                           <td>@if($da->currency_type=="inr") ₹{{$da->paying_amount_inr}} @else {{Helper::get_currency()}}{{$da->paying_amount_dollor}} @endif </td>  
                                          
                                          @if($currency == 'dollar')
                                            <td>
                                                @if(!empty($da->transaction_hash) && $da->message == '')
                                                <a href="https://bscscan.com/tx/{{ $da->transaction_hash }}" target='_blank' class="btn btn-info btn-sm text-light"> View Transaction Details </a>
                                                @elseif(empty($da->transaction_hash) && $da->message == '')
                                                  <a href="#"  class="btn btn-info btn-sm text-light timer" disabled data-timesup="{{ (new \DateTime($da->created_at))->modify('+29 hours +30 minutes')->format('Y-m-d H:i:s') }}"> 
                                                        00 : 00 : 00
                                                  </a>
                                                @elseif( $da->message == 'Default Payment')
                                                    <a href="#" class="btn btn-info btn-sm text-light"> Payment Successfully Done </a>
                                                @endif
                                             
                                          </td>
                                         @endif
                        
                                         <td><?php echo date('d-M-Y h:i:s a', strtotime($da->created_at . ' +5 hours 30 minutes')); ?></td>
                                            <td>
                                                @if($da->status=='pending')
                                                    <span class="badge bg-danger">Pending</span>  
                                                @elseif($da->status=='canceled')
                                                    <span class="badge bg-danger">Canceled</span> 
                                                @elseif($da->status=='processing')
                                                    <span class="badge bg-danger">Processing</span>
                                                @else
                                                    <span class="badge bg-success">Approved</span> 
                                                @endif
                                            </td>
                                       
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
    
    <script>
        
        document.querySelectorAll('.timer').forEach(element => {
        const date = new Date(element.getAttribute('data-timesup')).getTime();
    
        const countdown = setInterval(() => {
            const now = new Date().getTime();
            const distance = date - now;
    
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
            const paddedHours = String(hours).padStart(2, '0');
            const paddedMinutes = String(minutes).padStart(2, '0');
            const paddedSeconds = String(seconds).padStart(2, '0');
    
            element.innerHTML = `${paddedHours}h ${paddedMinutes}m ${paddedSeconds}s`;

            if (distance < 0) {
                clearInterval(countdown);
                element.innerHTML = "⏱ Times Up...";
                // location.reload();
            }
        }, 1000);
    });


        
    </script>
    
    
    <!--end page wrapper -->
@endsection
