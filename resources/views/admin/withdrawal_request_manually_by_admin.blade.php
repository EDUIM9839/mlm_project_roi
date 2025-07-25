@extends('admin.layouts.main')
@section('mains')
<style>
	input{
		border-width: 1px !important;
	}

	.input-group-text{

		border-width: 1px !important;

	}
</style>

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
                            <li class="breadcrumb-item active" aria-current="page">Withdrawal Request Manually By Admin</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
			
            <div  class="card">
                <div class="card-body p-4">
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
                                @php 
                                $admin_id=DB::table('user')->where('role','admin')->first();
                                
                                $add_fund=DB::table('admin_fund_self')->sum('amount');
                                $ptop=DB::table('ptop_transefer')->where('sender_id',$admin_id->id)->sum('total_amount');
                                @endphp
                    <div class="form-body ">
                         
                            <form     action="{{route('withdrawal_request_manually_by_admin2')}}" method="POST" enctype="multipart/form-data" >
                                @csrf
							
									<!--<h7 class="card-title pb-2">Fund wallet balance: 0</h7>-->
									<!--  <h6 style="color:green"><span><div id="balance-info"  class="badge rounded-pill text-black bg-warning p-2 text-uppercase px-3"><i class='bx   align-middle me-1'></i><span id="current-balance">Incentive Wallet:- {{Helper::get_currency()}}<span id="show_incentive_wallet">0</span></span></div></span> -->
					    <!--<span><div id="balance-info"  class="badge rounded-pill text-white bg-danger p-2 text-uppercase px-3 "><i class='bx   align-middle me-1'></i><span id="current-balance">Roi Wallet:- {{Helper::get_currency()}}<span id="show_roi_wallet">0</span></span></div></span>-->
					    <!--<span><div id="balance-info"  class="badge rounded-pill text-white bg-success p-2 text-uppercase px-3"><i class='bx   align-middle me-1'></i><span id="current-balance">Club Wallet:- {{Helper::get_currency()}}<span id="show_club_wallet">0</span></span></div></span>-->
					    
					    <!--</h6>-->
								<hr/>
								
								
                
					<div class="border p-4 rounded">
						<div class="row g-6">
                                <div class="col-md-6">
                                    <label for="inputConfirmPassword" class="form-label">PAY TO USER ID:</label> <span class="useridlabel" style="color:green" ></span><span class="useriderror" style="color:red" ></span>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='lni lni-user'></i></span>
                                        
                                    <input type="text" name="user_id" oninput="getUser()" class="form-control" id='receiver_id' required>
                                    <input type="hidden"  class="form-control" name="receiver_id" id='receiver_id1'>
                                         <script>
                                     function getUser(){
                                      $("#btnx").attr("disabled", "disabled");
                                      $("#error_amount").empty();
                                      $(".useriderror").empty();
                                      $(".useridlabel").empty();
                                         var userid=$("#receiver_id").val();
                                         var sender_id=$("#sender_id").val();
                                        //  console.log(userid);
                                               $.ajax({
                                                    url: "{{ route('ptop_userrs') }}",
                                                     type: "POST",
                                                     data: {
                                                         userid: userid,
                                                         _token: '{{ csrf_token() }}'
                                                     },
                                                     dataType: 'json',
                                                     success: function(result) {
                                                        //  var data =JSON.parse(result)
                                                        //  console.log(data);
                                                         if (result.length > 0) {
                                                             if(sender_id==result['0'].id){
                                                                  $(".useridlabel").empty();
                                                              $("#btnx").attr("disabled", "disabled");
                                                              $(".useriderror").html('Login id Same Not Subit');
                                                             }else{
                                                                   $("#btnx").removeAttr("disabled");
                                                                    $(".useridlabel").html(result['0'].first_name+" "+result['0'].last_name);
                                                                    $("#receiver_id1").val(result['0'].id);
                                                                    $("#show_incentive_wallet").html(Math.floor(result['0'].incentive_wallet));
                                                                   $("#show_roi_wallet").html(Math.floor(result['0'].withdrawl_wallet))
                                                                    $("#show_club_wallet").html(Math.floor(result['0'].club_wallet))
                                                             }
                                                           
                                                            if(result=='false'){
                                                                 $(".useridlabel").empty();
                                                                 $("#btnx").attr("disabled", "disabled");
                                                                 $(".useriderror").html('User Id not match in database');
                                                                   $("#show_incentive_wallet").html('0');
                                                                   $("#show_roi_wallet").html('0')
                                                                    $("#show_club_wallet").html('0')
                                                          }
                                                          }
                                                        }
                                                    });
                                     }                                             
                        //    Js Code here
                       </script>
                         
                     </div>
                                    </div>
                              
                                <div class="col-md-6"> 
										<label for="input9" class="form-label">Select Wallet</label>
										<select id="wallet-select" class="form-select" name="wallet" required>
											<option value="" selected="">Choose...</option>
											<option value="incentive_wallet">Incentive Wallet</option>
											<option value="roi_wallet">Roi Wallet</option>
											<option value="club_wallet">Club Wallet</option>
										</select> 
									@error('wallet')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6"> 
										<label for="currency-select" class="form-label">Select Currency</label>
										<select id="currency-select" class="form-select" name="currency" required>
											<option value="" selected="">Choose...</option>
											<option value="inr"> ₹ INR  </option>
											<option value="dollar"> $ Dollar </option> 
										</select> 
									@error('currency')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="amount" class="form-label" style="display:flex;">Withdrawal Amount: &nbsp;<div id="total_amt"></div></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent"><i
                                                class='lni lni-dollar'></i></span>
                                        <input type="number" min="10" class="form-control" name="amount" id="amount" placeholder="ENTER AMOUNT" required />
                                    </div>
                                    @error('amount')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                                 <div>
                                    
                           <input type="hidden" value="{{Auth::user()->id}}" name="sender_id" id="sender_id">
                           <div class="d-flex justify-content-center">
                               <button type="submit" class="btn btn-success my-3" id="btnx">&nbsp;&nbsp;Withdrawal&nbsp;&nbsp;</button>
                           </div>
                           
                      
							</div>
						</div>
						  
							</form>
						 
					</div>
                      	<div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                      
                
            </div>
            <!--/ Scrollable -->

          </div>
                </div>
            </div>
                                    
            <!-- Scrollable -->
           
       </div>
       </div>
@endsection
