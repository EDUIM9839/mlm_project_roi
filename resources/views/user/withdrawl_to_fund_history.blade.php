@extends('user.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">P2P Convert History</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-list-ul"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
         
            <!-- Scrollable -->
            <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example"  aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width: 46.9844px;">Sr.No.</th>
                        
                        <th class="sorting" tabindex="0" aria-controls="example"   aria-label="User: activate to sort column ascending" style="width: 209.875px;">Transfer Amount</th>
                        <th class="sorting" tabindex="0" aria-controls="example"  aria-label="User: activate to sort column ascending" style="width: 209.875px;">From Wallet</th>
                        <th class="sorting" tabindex="0" aria-controls="example"  aria-label="User: activate to sort column ascending" style="width: 209.875px;">To Wallet</th>
                        <th class="sorting" tabindex="0" aria-controls="example"  aria-label="User: activate to sort column ascending" style="width: 209.875px;">Recieved Amount</th>
                        <th class="sorting" tabindex="0" aria-controls="example"  aria-label="Income Type: activate to sort column ascending" style="width: 144.797px;"  >Transfer At</th>
                        <th class="sorting" tabindex="0" aria-controls="example"  aria-label="Income Type: activate to sort column ascending" style="width: 144.797px;"  ></th>
                </tr>
                    </thead>
             <tbody>
                 @php
                 $total_incentive_wallet=0;
                 $total_club_wallet=0;
                 $total_withdrawl_wallet=0;
                 $withdrawal_to_fund=DB::table('transaction')->where('from_id',Auth::user()->id)->where('transaction_type','withdrawl_to_fund')->get();
                 @endphp
                 @foreach($withdrawal_to_fund as $wf)
                
                 <tr>
                     <td>
                        {{$loop->iteration}}
                     </td>
                    
                     <td>
                        {{Helper::get_currency()}} {{$wf->amount}}
                     </td>
                     <td>
                         @if($wf->wallet_type=="incentive_wallet")
                            Incentive Wallet
                             @php
                                $total_incentive_wallet+=$wf->amount;
                             @endphp
                         @elseif($wf->wallet_type=="club_wallet")
                         Club Wallet
                          @php
                         $total_club_wallet+=$wf->amount;
                         @endphp
                         @elseif($wf->wallet_type=="saving_wallet")
                         Activation
                          
                          @php
                            $total_withdrawl_wallet+=$wf->amount;
                         @endphp
                         
                         @elseif($wf->wallet_type=="withdrawl_wallet")
                         Withdrawal
                          @php
                         $total_withdrawl_wallet+=$wf->amount;
                         @endphp
                         @endif
                      
                     </td>
                     <td>
                        @if($wf->to_wallet=="saving_wallet")
                        Activation
                        
                        @elseif($wf->to_wallet=="withdrawl_wallet")
                         Withdrawal
                        
                        @endif
                     </td>
                     <td>
                         {{Helper::get_currency()}}  {{$wf->recieve_amount}}
                     </td>
                     <td >
                         {{Helper::formatted_date($wf->created_at)}}
                     </td>
                     <td></td>
                       
                 </tr>
            @endforeach
             </tbody>
             {{-- <footer>
                 <tr>
                     <th>Incentive wallet</th>
                     <th>{{Helper::get_currency()}} {{$total_incentive_wallet}}</th>
                     <th>ROI Wallet</th>
                      <th>{{Helper::get_currency()}} {{$total_withdrawl_wallet}}</th>
                     <th>Club Wallet</th>
                      <th>{{Helper::get_currency()}} {{$total_club_wallet}}</th>
                 </tr>
             </footer>
             --}}
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
