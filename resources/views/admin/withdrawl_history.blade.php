@extends('admin.layouts.main')

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
        
              <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Payout History</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    
                </div>
            </div>
            <!--end breadcrumb-->
            
          
            <!-- Scrollable -->
            
            
            <div class="card">
              <h class="card-header "> 
            
                        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 g-3 align-items-center d-flex">
                    
                    <div class="col">
                        <ul class="nav  nav-pills my-3 ms-2 ">
                          <li class="nav-item">
                            <a class="nav-link px-4 py-2 {{ $currency == 'dollar' ? 'active'  : 'inactive' }}" href="?currency=dollar">Dollar ($)</a>
                          </li>
                          
                          {{--
                          <li class="nav-item ms-2">
                            <a class="nav-link  px-4 py-2 {{ $currency == 'inr' ? 'active'  : 'inactive' }}" href="?currency=inr">Rupee (₹)</a>
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
              
              
              
              <br>

              <div class="table-responsive text-nowrap">
                  
                   @if (session()->has('success'))
                                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                            </div>
                                            <div class="ms-3">
                                                 
                                                <div class="text-white">{!!session()->get('success')!!}</div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @elseif(session()->has('error'))

                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                        </div>
                                        <div class="ms-3">
                                             
                                            <div class="text-white">{!!session()->get('error')!!}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                                @endif 
                                
                 
                                
                                
                <table id="withdrawal_request" class="table display nowrap dataTable"  style="width:100%">
                  <thead>
                    <tr class="table-dark" >
                        <th>Id</th>
                        <th>Name</th>
                        <th>User Id</th>
                        <th>Currency Type</th>
                        <th>Wallet Type</th>
                        <th>Amount</th>
                        <th>Charges Amount</th>
                        <th>Paying Amount</th>
                        <th>Status</th>
                        <th>Request Date</th>
                        <th>Account Details</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                          @php
                                    $i = 1;
                                @endphp
                                @foreach ($transaction as $da)
                        <tr>
                            <td>{{$i++}}</td>
                            @php
                                $user_name=DB::table('user')->where('id',$da->user_id)->first();
                            @endphp
                            <td>{{$user_name->first_name}}</td>
                            <td>{{$user_name->userid}}</td>
                            <td>@if($da->currency_type=="inr") INR @else Dollor @endif</td>
                            <td>@if($da->wallet_type=="club_wallet") Club Wallet @elseif ($da->wallet_type=="roi_wallet") ROI Wallet @else Incentive Wallet @endif</td>
                            <td>@if($da->currency_type=="inr") ₹{{$da->amount_inr}} @else {{Helper::get_currency()}}{{$da->amount}} @endif </td> 
                            <td>@if($da->currency_type=="inr") ₹{{$da->amount_inr*10/100}} @else {{Helper::get_currency()}}{{$da->amount*10/100}} @endif </td> 
                            <td>@if($da->currency_type=="inr") ₹{{$da->paying_amount_inr}} @else {{Helper::get_currency()}}{{$da->paying_amount_dollor}} @endif </td>
                            <td>@if($da->status=='pending')
                                    <span class="badge bg-danger">Pending</span> 
                                @elseif($da->status=='canceled')
                                    <span class="badge bg-danger">Canceled</span>
                                @elseif($da->status=='processing')
                                    <span class="badge bg-warning">Processing</span>
                                @elseif($da->status=='failed')
                                    <span class="badge bg-danger">Failed</span>
                                @else
                                    <span class="badge bg-success">Approved</span>  
                                @endif
                            </td>
                            <td class="{{$da->created_at}}"><?php echo (new \DateTime($da->created_at))->modify(' +5 hours 30 minutes')->format("d M Y h:i a"); ?></td>
                     
                                  <td>
										<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal{{$da->id}}">View Payment</button>
										<!-- Modal -->
										<div class="modal fade" id="exampleScrollableModal{{$da->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
											<div class="modal-dialog modal-lg modal-dialog-scrollable">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">@if($da->currency_type=="inr") Bank Details @else	USDT Address @endif</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														@if($da->currency_type=="inr")
														  <div class="table-responsive text-nowrap">
														       <table id="withdrawal_request" class="table display nowrap dataTable account-details" style="width:100%">
														         <tbody>
														             <tr>
														                 <th>Account Holder Name</th><td>{{$user_name->account_holder_name}}</td>
														                 <th>Branch Name</th><td>{{$user_name->bank_name}}</td>
														              </tr>
														             <tr>
														                 <th>IFC Code</th><td>{{$user_name->ifsc_code}}</td>
														                 <th>Account No.</th><td>{{$user_name->account_no}}</td>
														              </tr>
														         </tbody>  
                                                                </table>
                                                          </div>
														
														@else
														<div class="table-responsive text-nowrap">
														       <table id="withdrawal_request" class="table display nowrap dataTable account-details" style="width:100%">
														         <tbody>
														             <tr>
														                 <th>USDT Address </th>
														                 <td>{{$user_name->tron_address}}</td>
														              </tr>
														             <tr>
														                 <th>Transaction Hash </th>
														                 <td>{{$da->transaction_hash ?? "-"}}</td>
														              </tr>
														              
														              @if($da->transaction_hash)
    														             <tr>
    														                 <th>Payment Status</th>
    														                 <td><a herf="https://bscscan.com/tx/{{ $da->transaction_hash }}" target='_blank' class="btn btn-info btn-sm text-light"> View Transaction Details </a></td>
    														              </tr>
														             @endif
    														             <tr>
														                 <th>Paid Status </th>
														                 
														                 <td> 
														                    @if($da->status == "Approved")
														                        <span class="badge bg-success p-2">
														                           {{ ucfirst($da->status)  }}
														                        </span>
														                    @elseif($da->status == "pending")
														                        <span class="badge bg-warning p-2">
														                            {{ ucfirst($da->status)  }}
														                        </span>
														                    @elseif($da->status == "canceled")
														                     <span class="badge bg-danger p-2">
														                            {{ ucfirst($da->status)  }}
														                     </span>
														                    @endif
														                 
														              </td>
														              </tr>
														         </tbody>  
                                                                </table>
                                                          </div>
														@endif
														
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
										</td>

                        <td>
                       @if($da->status=='pending')
                    <a href="{{route('change_status',['id'=> $da->id])}}"  type="button" class="btn btn-primary submit-btn" onclick="myFunc()">Pay</a>
                    
                    @elseif($da->status=='canceled')
                         <span class="badge bg-danger">Canceled</span>
                        
                    @else
                
                    <a   type="button" class="badge btn-success " onclick="myFunc()"><i style="font-size:12px" class="fa">&#xf058;</i>Paid</a> 
                    </td>
                    @endif

                    </div>
                            <!--<a href="# &amp;tbname=withdrawl_request"><button class="btn btn-danger"> n mnbDelete</button></a>-->
                            </td>
                      </tr>
                       @endforeach
                    </tbody>
                </table>
              </div>
            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->






          <div class="content-backdrop fade"></div>
        </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->

        </div>
            <!--  -->
        </div>
    </div> 
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
    // $(document).ready(function() {
    //     $("#withdrawal_request").DataTable();
    // });
</script>

  <script>
$(document).ready(function() {
    $('#withdrawal_request').DataTable({
        dom: 'Bfrtip',
        buttons: [
             'copy',
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible',
                    format: {
                        body: function(data, row, column, node) {
                            let tempDiv = document.createElement("div");
                            tempDiv.innerHTML = data;

                            let textContent;

                            if(column == 10){
                                let textContent = '';
                                
                                const rows = node.querySelectorAll('.account-details tr');
                                
                                rows.forEach(ele => {
                                    
                                    let heading = ele.querySelector('th').textContent.trim();
                                    let val = ele.querySelector('td').textContent.trim();
                                    
                                    textContent += heading + " : " + val + "\n";
                                    
                                });
                                
                                // const divs = tempDiv.querySelectorAll('div');
                                // divs.forEach(function(div, index){
                                //         textContent += div.textContent.trim() + '\n';
                                // });
                                return textContent;
                            }
                            
                            textContent = tempDiv.textContent.trim();
                            return textContent;
                        }
                    }
                },
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('col', sheet).each(function(index, col) {
                        if (index === 5) {
                            $(col).attr('width', 25);
                        }
                        
                         $('row c', sheet).each(function(index, cell) {
                            $(this).attr('s', '55');
                        });
                        
                    });
                }
            },
            'csvHtml5',
           
        ]
    });
});
</script>
    
<script>
    $(".submit-btn").on( 'click', function(e){
        // some implementation
        // Now showing the alert
        var url=$(this).attr('href');
        // console.log(url);
        e.preventDefault();
        
        jQuery.getScript('https://cdn.jsdelivr.net/npm/sweetalert2@11', function() {
        
        Swal.fire({
          title: 'Are you sure to paid ?',
          text: "",
          icon: 'success',
          showCancelButton: true,
          confirmButtonColor: '#C64EB2',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
        }).then((result) => {
          if (result.isConfirmed) {
             
             console.log(url);
             location.assign(url);
           
          } else {
            console.log('clicked cancel');
          }
        })
        
        })
       
    });
    </script>
@endsection
