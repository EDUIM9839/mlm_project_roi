<div class="table-responsive text-nowrap">
                    
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
                                
                <table id="withdrawal_request" class="table display nowrap dataTable" style="width:100%">
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
                     <th>View Payment Details</th>
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
                         <td>@if($da->wallet_type=="club_wallet") Club Wallet @elseif($da->wallet_type=="roi_wallet") ROI Wallet @else Incentive Wallet @endif</td>
                         <td>@if($da->currency_type=="inr") ₹{{$da->amount_inr}} @else {{Helper::get_currency()}}{{$da->amount}} @endif </td> 
                         <td>@if($da->currency_type=="inr") ₹{{$da->amount_inr*10/100}} @else {{Helper::get_currency()}}{{$da->amount*10/100}} @endif </td> 
                          <td>@if($da->currency_type=="inr") ₹{{$da->paying_amount_inr}} @else {{Helper::get_currency()}}{{$da->paying_amount_dollor}} @endif </td>
                        <td>@if($da->status=='pending')<span class="badge bg-danger">Pending</span>  @elseif($da->status=='canceled')<span class="badge bg-danger">Canceled</span>   @else<span class="badge bg-success">Approved</span>  @endif</td>
                        <td><?php echo (new \DateTime($da->created_at))->modify(' +5 hours 30 minutes')->format("d M Y h:i a"); ?></td>
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
														       <table id="withdrawal_request" class="table display nowrap dataTable" style="width:100%">
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
														       <table id="withdrawal_request" class="table display nowrap dataTable" style="width:100%">
														         <tbody>
														             <tr>
														                 <th>USDT Address </th><td>{{$user_name->tron_address}}</td>
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
                     <div class="d-flex">
                           <form action="{{route('change_status',['id'=> $da->id])}}" onsubmit="payConfirmation(event)" method="POST">
                               @csrf
                               <button type="submit" class="btn btn-success px-5 radius-30">Pay</button>
                           </form>
                            <form action="{{route('change_status_default',['id'=> $da->id])}}" class="mx-2" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-info px-3 radius-30"> Default</button>
                            </form>
                           <form class="mx-2" action="{{route('cancel_withdrawl',['id'=> $da->id])}}" onsubmit="cancelConfirmation(event)" method="POST">
                               @csrf
                               <button type="submit" class="btn btn-danger px-5 radius-30">Reject</button>
                           </form>
                         
                     </div>
                       
                    
                    
                        <!--<a href="{{route('change_status',['id'=> $da->id])}}"  type="button" class="btn btn-success px-5 radius-30" >Pay</a>-->
                        <!--<a href="{{route('cancel_withdrawl',['id'=> $da->id])}}"  type="button" class="btn btn-danger px-5 radius-30" >Cancel</a>-->
                    @elseif($da->status=='canceled')
                    
                    <button class='btn btn-danger'>Canceled</button>
                     
                    @else
                    <a   type="button" class="badge btn-success " ><i style="font-size:12px" class="fa">&#xf058;</i>Paid</a> 
                    
                    @endif
</td>
                    </div>
                            <!--<a href="# &amp;tbname=withdrawl_request"><button class="btn btn-danger"> n mnbDelete</button></a>-->
                            </td>
                      </tr>
                       @endforeach
                    </tbody>
                </table>
                    </div>