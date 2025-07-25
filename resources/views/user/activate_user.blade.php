@extends('user.layouts.main')
@section('mains')
<style>
    input {
        border-width: 1px !important;
    }
    .input-group-text {
        border-width: 1px !important;
    }
    
    
       	.full-screen-cover{
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgb(0 0 0 / 44%);
        text-align: center;
        z-index: 1000;
    }
    
   	.full-screen-cover .inner-content{
   	    position: absolute;
   	    top: 50%;
   	    left: 50%;
   	    transform: translate(-50%, -50%);
   	    padding: 20px;
   	    display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 100%;
       
   	}
   	.full-screen-cover .inner-content .message{
   	       font-size: 21px;
    color: #ffffff;
    font-weight: 500;
   	}
   	.full-screen-cover .inner-content .message-wait{
   	      font-size: 16px;
        color: #ffffff;
        font-weight: 400;
   	}

    .loader {
      width: 148px;
    aspect-ratio: 2;
    --_g: no-repeat radial-gradient(circle closest-side, #ffffff 90%, #38353500);
    background: var(--_g) 0% 50%, var(--_g) 50% 50%, var(--_g) 100% 50%;
    background-size: calc(100% / 3) 50%;
    animation: l3 1s infinite linear;
    margin-bottom: 22px;
    }
    @keyframes l3 {
        20%{background-position:0%   0%, 50%  50%,100%  50%}
        40%{background-position:0% 100%, 50%   0%,100%  50%}
        60%{background-position:0%  50%, 50% 100%,100%   0%}
        80%{background-position:0%  50%, 50%  50%,100% 100%}
}


	.totalAmountCard{
	        background: #d4ffd4 !important;
            color: green;
            border: 2px solid #0080002e !important;
            box-shadow: none !important;
            width: fit-content;
	}
</style>

<!-- Start page wrapper -->     
<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Invest Amount</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End breadcrumb -->

        
            <div id="pleaseWaitPopup" class="full-screen-cover">
                <div class="inner-content">
                    <div class="loader"></div>
                    <div class="message">Transaction is under process </div>
                    <div class="message-wait">Please Wait...</div>
                    <small class="text-light">Please do not leave or refresh this page while the transaction is in progress.</small>
                </div>
            </div>


        <div class="card" style="background: transparent; box-shadow: none">
            <div class="card-body p-4">
                @if (session()->has('success'))
                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div class="font-35 text-white"><i class='bx bxs-message-square-check'></i></div>
                            <div class="ms-3">
                                <div class="text-white">{!! session()->get('success') !!}</div>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i></div>
                            <div class="ms-3">
                                <div class="text-white">{!! session()->get('error') !!}</div>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="form-body">
                    <form action="{{ route('activate_user_by_user') }}" method="POST" id="target">
                       @csrf   
                    
                        <!--<hr/> -->
                        <div class="row g-6">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 card p-3 shadow">
                               <div class="d-flex flex-column flex-md-row justify-content-between">
                                   
                                    <div class="fs-4 fw-bold flex-sm-col"> Investment</div>
                                    
                                    <div class="card p-2 px-3 d-flex flex-row me-1 totalAmountCard" >
                                          <strong> Activation Wallet : </strong> 
                                          <div>&nbsp; {{Helper::get_currency()}} {{ Auth::user()->saving_wallet }} </div>
                                      </div>
                               </div>
                                
                                <div class='row mb-3'>
								 <label for="defaultFormControlInput" class="form-label">Investment Amount</label> 
									<select class="form-select select-amount-to-pay" id="single-select-field" data-placeholder="Choose Amount" name='amount'>
										<option ></option>
										 {{--	<option value="1">{{Helper::get_currency()}}1</option> --}}
										@php
										$package=DB::table("package")->get();
										$num=10000;
										@endphp
										@foreach($package as $packages)
										  	<option value="{{$packages->cost}}">{{Helper::get_currency()}}{{$packages->cost}}</option>
										@endforeach
										
									</select>
                                   
                                  
                                     @error('amount')
                                        <br><span class='text text-danger'>{{ $message }}</span>
                                    @enderror
                                </div> 


                               
                                <div class="d-flex justify-content-center">
                                    <!--<button type="submit"  class="btn btn-success my-3 me-2">Fund Wallet</button>-->
                                    <button type="button"  class="btn btn-primary my-3 me-3" id="investBtn">From Wallet</button>
                                    <button type="submit"  class="btn btn-danger my-3">From Fund</button>
                                  
                                 {{--  <button type="button" onclick="testing(this)" class="btn btn-warning my-3" id="investBtn" >Testing</button> --}} 
                                  
                                  @if(request()->has('testing'))
                                    
                                    <button type="button"  class="btn btn-dark my-3 ms-3" onclick="testing(this)">Testing....</button>
                                    @endif
                                  
                                </div>

                                <div class="text-center" id="show_wallet"></div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Scrollable -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


		    
<script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.3.0/dist/web3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script>
    
    document.querySelector('#investBtn').addEventListener('click', async function(){
        
        let value = document.querySelector('.select-amount-to-pay').value;
        console.log(value);
        if(value > 0){
            console.log("buying...");
            
            await buyPackage(value);
           
        }else{
             toastr.error("Amount must be greater than zero.");
        }
        
    });
    
    
    async function buyPackage(packageAmount) {
        var tokenAmount = packageAmount;
        if (!packageAmount) {
            toastr.error('Please enter the package amount and token values.');
            return;
        }
    
        pleaseWaitPopup.style.display = 'block';
          console.log("waiting displayed.");
        let web3;
    
        if (typeof window.ethereum !== 'undefined') {
            web3 = new Web3(window.ethereum);
            try {
                await window.ethereum.enable();
            } catch (error) {
                console.error('User denied wallet access:', error);
                toastr.error('Wallet access denied.');
                pleaseWaitPopup.style.display = 'none';
                return;
            }
        } else if (typeof window.web3 !== 'undefined') {
            web3 = new Web3(window.web3.currentProvider);
        } else {
            alert("No wallet detected. Please use a compatible Ethereum wallet.");
            pleaseWaitPopup.style.display = 'none';
            return;
        }
    
        const chainId = await web3.eth.getChainId();
        if (chainId !== 56) {
            toastr.error('Please switch to the Binance Smart Chain network.');
            pleaseWaitPopup.style.display = 'none';
            return;
        }
       console.log("chain id : " + chainId);
        try {
            const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
            const userWalletAddress = accounts[0];
            //const formWalletAddress = $("#wallet_address_input").val();
            const formWalletAddress = userWalletAddress;
            console.log("userWalletAddress : " + userWalletAddress);
         
            if (userWalletAddress.toLowerCase() !== formWalletAddress.toLowerCase()) {
                toastr.error("Wallet address does not match.");
                pleaseWaitPopup.style.display = 'none';
                return;
            }
    
           const tokenContractAddress = '0x55d398326f99059fF775485246999027B3197955';
           
          const recipientAddress = {!! json_encode($receiverAddress ?? '') !!}; 
          
           
           
           const tokenABI = [{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}];
    
            const contract = new web3.eth.Contract(tokenABI, tokenContractAddress);
    
            tokenAmount = tokenAmount + "";
            const tokenAmountInWei = web3.utils.toWei(tokenAmount, 'ether');
            const gasLimit = await contract.methods.transfer(recipientAddress, tokenAmountInWei).estimateGas({ from: userWalletAddress });
            const gasPrice = await web3.eth.getGasPrice();  // You can adjust this dynamically
    
         console.log("gasLimit : " + gasLimit);
         console.log("gasPrice : " + gasPrice);
            
            const receipt = await contract.methods.transfer(recipientAddress, tokenAmountInWei)
            .send({
                from: userWalletAddress,
                gasPrice: gasPrice, 
                gas: gasLimit  
            });
            var formdata = new FormData();
    
            const transactionHash = receipt.transactionHash;
            
            formdata.append('package_amount', packageAmount);
            formdata.append('payment_type', "wallet");
            formdata.append('wallet_address', formWalletAddress.toLowerCase());
            formdata.append('ert_token', tokenAmount);
            formdata.append('type', 'user_update');
            formdata.append('transaction_hash', transactionHash);
    
             console.log("transaction success : saving...");
            fetch('{{ route("activate_user_crypto") }}', {
                method: 'POST',
                headers: {
                    'x-csrf-token': "{{ csrf_token() }}"
                },
                body: formdata
            })
            .then(response => response.json())
            .then(data => {
        
                toastr.success("Transaction successful with reduced gas fees! wait for redirect!");
                pleaseWaitPopup.style.display = 'none';
              
               console.log("saved");
               console.log(data);
               setTimeout(function(){
            	    location.href = "/user/dashboard";
                }, 1300);
    
    
            })
            .catch(error => {
                console.error('Error:', error);
            });
    
            
    
        } catch (error) {
            console.error('Transaction failed with error:', error);
            toastr.error("Transaction failed: " + error.message);
        } finally {
            pleaseWaitPopup.style.display = 'none';
        }
    }
    
    
   
    
 </script>                       
    
 @if(request()->has('testing') && false)

 <script>
     
      function testing(obj){
        //   alert(123);
        //   return;
       var formdata = new FormData();
       
            formdata.append('package_amount', "100");
            formdata.append('payment_type', "wallet");
            formdata.append('wallet_address', "0x000000000000000000000000000");
            formdata.append('ert_token', 100);
            formdata.append('type', 'user_update');
            formdata.append('transaction_hash', "0x00000000000000000000000000");
    
            console.log("transaction success : saving...");
            fetch('{{ route("activate_user_crypto") }}', {
                method: 'POST',
                headers: {
                    'x-csrf-token': "{{ csrf_token() }}"
                },
                body: formdata
            })
            .then(response => response.json())
            .then(data => {
        
                toastr.success("Transaction successful with reduced gas fees! wait for redirect!");
                pleaseWaitPopup.style.display = 'none';
              
               console.log("saved");
               console.log(data);
               setTimeout(function(){
            	    location.href = "/user/dashboard";
                }, 1300);
    
    
            })
            .catch(error => {
                console.error('Error:', error);
            });
            
            
    }
 </script>
 @endif
                        
@endsection

