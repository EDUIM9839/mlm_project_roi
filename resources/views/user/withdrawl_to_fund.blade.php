@extends('user.layouts.main')
@section('mains')
<style>
	input{
		border-width: 1px !important;
	}

	.input-group-text{

		border-width: 1px !important;

	}
	.totalAmountCard{
	        background: #d4ffd4 !important;
            color: green;
            border: 2px solid #0080002e !important;
            box-shadow: none !important;
            width: fit-content;
	}
</style>

    <!--start page wrapper -->     
    
      <div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <h6 class="mb-0 text-uppercase alert">P2P Convert</h6>
        <hr/>
        <div class="card mx-auto" style="max-width: 90%;">
            <div class="card-body p-4">
                @if (session()->has('success'))
                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="font-35 text-white"><i class='bx bxs-message-square-check'></i></div>
                        <div class="ms-3">
                            <div class="text-white">{!!session()->get('success')!!}</div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif(session()->has('error'))
                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i></div>
                        <div class="ms-3">
                            <div class="text-white">{!!session()->get('error')!!}</div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="form-body">
                    <form   id="target1" action="{{ route('add_withdrawal_to_fund') }}" method="POST" enctype="multipart/form-data"> 
                    {{--    <form   id="target1" action="https://google.com" method="POST" enctype="multipart/form-data" onsubmit="onsubmitForm()" >--}}
                        @csrf
                        <input type="hidden" value="transaction" name="tbname"/>
                        <!--<h7 class="card-title pb-2">Widthdrawl wallet balance: {{Auth::user()->withdrawl_wallet}}</h7></br>-->
                       {{-- <h6 style="color:green">Widthdrawl wallet balance: ${{round(Auth::user()->withdrawl_wallet,2)}}</h6>  --}}
                        <span id="error_amount"></span>
                        
                        <div class="d-flex  my-3" style="flex-wrap: wrap">
                            <div class="card me-2 p-2 px-3 d-flex flex-row me-1 mb-2 totalAmountCard" >
                                  <strong> Withdrawal Wallet : </strong> 
                                      <div>&nbsp; {{Helper::get_currency()}} {{ Auth::user()->withdrawl_wallet }} </div>
                              </div>
                            <div class="card p-2 px-3 d-flex flex-row me-1 mb-2 totalAmountCard" >
                                  <strong> Activation Wallet : </strong> 
                                  <div>&nbsp; {{Helper::get_currency()}} {{ Auth::user()->saving_wallet }} </div>
                              </div>
                        </div>
                        <div class="border p-4 rounded">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="inputConfirmPassword" class="form-label">Amount to be Transfer:</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent"><i class='bx bx-dollar'></i></span>
                                        <input type="number" class="form-control" name="amount" id="amount" placeholder="" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label for="inputConfirmPassword" class="form-label">Select From Wallet:</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent"><i class="lni lni-question-circle"></i></span>
                                        <select class="form-control"  name="from_wallet" id="select_from_wallet" required>
                                            <option value="" selected disabled>--Select--</option>
                                            <option value="withdrawl_wallet">Withdrawal Wallet</option>
                                            <option value="saving_wallet">Activation Wallet</option>
                                            <!--<option value="club_wallet">Club Wallet</option>-->
                                            <!--<option value="reward_wallet">Reward Wallet</option>-->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputConfirmPassword" class="form-label">Select To Wallet:</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent"><i class="lni lni-question-circle"></i></span>
                                        <select class="form-control"  name="to_wallet" id="select_to_wallet" required>
                                            <option value="" selected disabled>--Select--</option>
                                            <option value="withdrawl_wallet">Withdrawal Wallet</option>
                                            <option value="saving_wallet">Activation Wallet</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-2">
                                <div class="col-md-12">
                                    <label for="inputConfirmPassword" class="form-label">Enter Transaction Password:</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent"><i class="lni lni-eye"></i></span>
                                        <input type="password" class="form-control" name="password"  required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 mt-3">
                                   <h6 style="color:green"><span id="show_wallet_amount"></span></h6> 
                            </div>
                        </div>
                        <br/>
                        <div>
                            <input type="hidden" value="withdrawl_to_fund" name="transaction_type" id="transaction_type">
                            <input type="hidden" value="withdrawl to fund" name="description" id="description">
                            <input type="hidden" value="{{Auth::user()->id}}"  name="user_id">
                            <button type="submit"   id="btnx" class="btn btn-success">Convert</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
            
          <script>
              function SelectWallet(){
                  $("#show_wallet_amount").empty();
                  var wallet=$("#select_wallet").val();
                  console.log(wallet);
                //   if(wallet=="withdrawl_wallet"){
                //      $("#show_wallet_amount").html("withdrawl_wallet Wallet balance: ${{round(Auth::user()->incentive_wallet,2)}}")
                //   }else if(wallet=="club_wallet"){
                //       $("#show_wallet_amount").html("Club Wallet balance: ${{round(Auth::user()->club_wallet,2)}}")
                //   }else if(wallet=="withdrawl_wallet"){
                //       $("#show_wallet_amount").html("ROI Wallet balance: ${{round(Auth::user()->withdrawl_wallet,2)}}")
                //   }else if(wallet=="reward_wallet"){
                //       $("#show_wallet_amount").html("Reward Wallet balance: ${{round(Auth::user()->reward_wallet,2)}}")
                //   }
                
                   
                
              }
              
              const selectFromWallet = document.querySelector("#select_from_wallet");
              const selectToWallet = document.querySelector("#select_to_wallet");
              
              selectFromWallet.addEventListener('change', function(){
                  
                  
                  if(selectFromWallet.value == "withdrawl_wallet"){
                      selectToWallet.value = "saving_wallet";
                  }else if(selectFromWallet.value == "saving_wallet"){
                      selectToWallet.value = "withdrawl_wallet";
                  }
              });
              selectToWallet.addEventListener('change', function(){
                  
                  
                  if(selectToWallet.value == "withdrawl_wallet"){
                      selectFromWallet.value = "saving_wallet";
                  }else if(selectToWallet.value == "saving_wallet"){
                      selectFromWallet.value = "withdrawl_wallet";
                  }
              });
              
            
              
          </script>
           <script>
                    function onsubmitForm(){
                                 $("#error_amount").empty();
                                 event.preventDefault(); 
                                  console.log($("#amount").val());
                                 
                                 
                                //  alert("hello");
                                    $.ajax({
                                            type: "POST",
                                             url: "{{ route('check_amount_transfer') }}",
                                             data: {
                                       
                                         sender_id:$("#sender_id").val(),
                                         amount:$("#amount").val(),
                                         wallet:$("#select_from_wallet").val(),
                                          _token: '{{ csrf_token() }}'
                                       
                                        },
                                         success: function(dataResult)
                                                 {
                                                     console.log(dataResult);
                                                     if(dataResult.status==201){
                                                        //  alert(dataResult.result);
                                                         $("#error_amount").append('<div class="ms-3" style="background-color: red; border-radius: 10px;"><div class="text-white" style="padding: 7px; text-align: center;">'+  dataResult.result +'</div></div>');
                                                     }
                                                     else
                                                     {
                                                         document.getElementById("target1").submit(); 
                                                  
                                                    
                                                     }
                                                  }
                                           });
                                
                            }
                        </script>
       
    <!--end page wrapper -->
@endsection
