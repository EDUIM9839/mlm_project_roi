@extends('user.layouts.main')
@section('mains')
<!--start page wrapper -->
<style>
    .withdrawal-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .withdrawal-text {
        color: green;
        margin: 0;
    }

    #error_amount {
        margin-left: auto;
    }
</style>
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        
        
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>

            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php echo 'Withdrawal Request'; ?>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{route('withdrawl_request_history')}}"
                        class='badge bg-info'>Withdrawal History</a></h6>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />

        <div class="card">
            
            <div class="card-body p-4">

                <div class="form-body ">

                    @if (session()->has('success'))
                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div class="font-35 text-white"><i class='bx bxs-message-square-check'></i>
                            </div>
                            <div class="ms-3">

                                <div class="text-white">{!!session()->get('success')!!}</div>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @elseif(session()->has('error'))
 
                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                        <div class=" ">
                            <div class="font-20 text-white"><i class='bx bxs-message-square-x'
                                    style='display:contents; !important'></i><span
                                    style='font-size:16px;'>&nbsp;{!!session()->get('error')!!}</span>
                            </div>

                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                    @else 
                    @if(Auth::user()->block_withdrawl_wallet==1)
                    <span class="btn btn-danger mb-3">
                         
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill text-warning" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                        {{'Your withdrawal wallet is temporarily blocked by admin'}} @endif
                        
                    </span>
                    @endif
                    @php
                    $id=Auth::user()->id;
                    $total_amount=DB::table('income_history')->where('received_user',$id)->where('credit_debit','credit')->sum('amount');

                    @endphp
                    
                    <form action="{{ route('withdrawl_income1') }}" method="POST" enctype="multipart/form-data" onsubmit="onsubmitForms(event)" id="target">
                        @csrf
                        <input type="hidden" value="transaction" name="tbname" />
                        

                        <div class="withdrawal-container">
                            <h6 class="withdrawal-text">Withdrawal Request</h6>
                            <h6 class="withdrawal-text">Withdrawal Balance -
                                {{Helper::get_currency()}}&nbsp;{{ Auth::user()->withdrawl_wallet }}<span id="show_dmount"></span></h6>
                        </div>
                        <span id="error_amount"></span>

                        <hr>

                            
                        <div class="border p-4 rounded">
                            <div class="row g-6">
                                <div class="col-md-6"> 
										<label for="input9" class="form-label">Wallet</label>
										<select id="wallet-select" class="form-select" name="wallet" required>
											<!--<option value="" selected="">Choose...</option>-->
											<option value="Withdrawal_wallet" selected >Withdrawal Wallet</option>
											<!--<option value="roi_wallet">Roi Wallet</option>-->
											<!--<option value="club_wallet">Club Wallet</option>-->
										</select> 
									@error('wallet')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6"> 
										<label for="currency-select" class="form-label">Currency</label>
										<select id="currency-select" class="form-select" name="currency" required>
											<!--<option value="" selected="">Choose...</option>-->
											<!--<option value="inr"> ₹ INR  </option>-->
											<option value="dollar" selected=""> $ Dollar </option> 
										</select> 
									@error('currency')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="amount" class="form-label" style="display:flex;">Withdrawal Amount: &nbsp;<div id="total_amt"></div></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent"><i
                                                class='lni lni-dollar'></i></span>
                                        <input type="number" min="20" class="form-control" name="amount" id="amount" placeholder="ENTER AMOUNT" required />
                                    </div>
                                    @error('amount')
                                    <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                                
                                    <div class="col-md-6 mt-3" id='transaction'>
                                        <label for="transaction_password" class="form-label">Transaction Password:</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent"><i class="lni lni-eye"></i></span>
                                            <input type="password" maxlength="6" class="form-control" name="transaction_password" id="transaction_password" placeholder="ENTER TRANSACTION PASSWORD" required />
                                        </div>
                                        @error('transaction_password')
                                        <small style="color:red">{{$message}}</small>
                                        @enderror
                                  </div>

                            </div>
                        </div></br>

                        <div>
                            <input type="hidden" value="" name="status" id="status">
                            <input type="hidden" value="{{Auth::user()->id}}" name="userid">
                            <div class="d-flex" style='float:right'>
                                <button type="submit" name="submit_btn" id="btnx" class="btn btn-success">Request Now</button>
                            </div>
                            <div class="d-flex" style='float:right' id="dates">
                                 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- OTP Section (Hidden by default) -->
        <div id="otp-section" class="mt-3" style="display:none;">
            <label for="otp" class="form-label">Enter OTP sent to your email</label>
            <input type="text" class="form-control" id="otp_input" placeholder="Enter OTP">
            <span class="text-danger" id="otp-error"></span>
            <div class="d-flex justify-content-center mt-3">
                <button type="button" class="btn btn-primary" onclick="verifyOtp()">Verify OTP</button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script>
$(document).ready(function() {
    function checkButtonVisibility() {
        var today = new Date();
        var day = today.getDate();  
        var month = today.getMonth() + 1; 
        var year = today.getFullYear();  
  
        var formattedDate = `${String(day).padStart(2, '0')}-${String(month).padStart(2, '0')}-${year}`;

        var selectedWallet = $('#wallet-select').val();
 
        if (selectedWallet === 'club_wallet' && (day < 1 || day > 2)) {
              $('#show_mount').html({{Auth::user()->club_wallet}})
            $('#btnx').hide();
            $('#dates').html(`<p style="color:red;">Today Date is ${formattedDate}.<br> You Can Withdrawl between Dates from 1-2 in Every Month.</p>`);
        } else if (selectedWallet === 'roi_wallet' && (day < 1 || day > 2)) {
              $('#show_mount').html({{Auth::user()->withdrawl_wallet}})
            $('#btnx').hide();
            $('#dates').html(`<p style="color:red;">Today Date is ${formattedDate}.<br> You Can Withdrawl between Dates 1-2 in Every Month. </p>`);
        } else {
             if (selectedWallet === 'club_wallet') {
              $('#show_mount').html({{Auth::user()->club_wallet}})
           
        } else if (selectedWallet === 'roi_wallet') {
              $('#show_mount').html({{Auth::user()->withdrawl_wallet}})
        } else {
            
            $('#show_mount').html({{Auth::user()->incentive_wallet}})
            $('#btnx').show();
            $('#dates').empty();
        }
            
        }
    }

    function updateAmountDisplay() {
        $('#amount').on('input', function() {
        var selectedCurrency = $('#currency-select').val();
       
        var amountInput = $('#amount').val();
        console.log(amountInput);
        console.log(selectedCurrency);
        if (selectedCurrency === 'dollar' ){ 
            $('#total_amt').html(`<span style="color:red;">$  ${amountInput}  Dollar</span>`); 
        } else {
            var dollar_amt=amountInput*90;
            $('#total_amt').html(`<span style="color:red;">₹ ${dollar_amt}  Inr</span>`);
        }
        
        
    });    
    }
    
    checkButtonVisibility();
    
    $('#wallet-select').change(function() {
        checkButtonVisibility();
        
    });

    $('#currency-select').change(function() {
        updateAmountDisplay();
    });
     
});
</script>

<script>
                        function onsubmitForms(e) {
                            e.preventDefault(); 
                            $("#btnx").attr("disabled", true);
                            
                            $.ajax({
                                url: "{{ route('withdrawl_otp_email') }}",
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    user_id: '{{ Auth::user()->id }}'
                                },
                                success: function(response) {
                                    if (response.status === 'success') {
                                        $('#otp-section').show();
                                    } else {
                                        alert('Failed to send OTP. Try again.');
                                        $("#btnx").removeAttr("disabled");
                                    }
                                }
                            });
                        }

                        function verifyOtp() {
                            var otp = $("#otp_input").val();
                            $.ajax({
                                url: "{{ route('withdrawl_verify_otp') }}",
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    user_id: '{{ Auth::user()->id }}',
                                    otp: otp
                                },
                                success: function(response) {
                                    if (response.status === 'success') {
                                        $("#target").off('submit'); 
                                        // $("#target").submit();   
                                        document.getElementById("target").submit();
                                    } else {
                                        $("#otp-error").text("Invalid or expired OTP.");
                                    }
                                }
                            });
                        }
                        </script>
@endsection
