@extends('user.layouts.main')
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
                            <li class="breadcrumb-item active" aria-current="page">P2P Transfer</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
			
            <div style="margin-bottom:4%;"class="card">
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
                   
                    <div class="form-body ">
                         
                            <form     action="{{ route('ptop_trancefer_user') }}" method="POST" enctype="multipart/form-data"  onsubmit="onsubmitForms(event)" id="target">
                                @csrf
									  <h6 style="color:green">Fund wallet balance: {{ number_format(floor(Auth::user()->saving_wallet * 100) / 100, 2) }}
</h6>  <span id="error_amount"></span>
								<hr/>
                
					<div class="border p-4 rounded">
						<div class="row g-6">
                                <div class="col-md-12">
                                    <label for="inputConfirmPassword" class="form-label">AMOUNT</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='lni lni-dollar'></i></span>
                                        <input type="number" class="form-control" name="amount" id="amount" placeholder="0.0" required>
                                    </div>
                                </div></br>
                               
                                 
                                <div class="col-md-12">
                                    <label for="inputConfirmPassword" class="form-label">PAY TO USER ID:</label> <span class="useridlabel" style="color:green" ></span><span class="useriderror" style="color:red" ></span>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='lni lni-user'></i></span>
                                        <!--<input type="text" class="form-control" name="currency_symbol"-->
                                        <!--     id="currency_symbol"-->
                                        <!--    placeholder="" />-->
                                        
                                        
                                    <input type="text" oninput="getUser()" class="form-control" id='receiver_id' required>
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
                                                    url: "{{ route('ptop_user') }}",
                                                     type: "POST",
                                                     data: {
                                                         userid: userid,
                                                         _token: '{{ csrf_token() }}'
                                                     },
                                                     dataType: 'json',
                                                     success: function(result) {
                                                         
                                                        //  var data =JSON.parse(result)
                                                        //  console.log(result);
                                                         if (result.length > 0) {
                                                             
                                                             if(admin_id==result['0'].id){
                                                                  $(".useridlabel").empty();
                                                              $("#btnx").attr("disabled", "disabled");
                                                              $(".useriderror").html('You can not P2P to Admin');
                                                             }else if(sender_id==result['0'].id){
                                                             
                                                                  $(".useridlabel").empty();
                                                              $("#btnx").attr("disabled", "disabled");
                                                              $(".useriderror").html('Login id Same Not Subit');
                                                             }else{
                                                                   $("#btnx").removeAttr("disabled");
                                                            $(".useridlabel").html(result['0'].first_name+" "+result['0'].last_name);
                                                            $("#receiver_id1").val(result['0'].id);
                                                             }
                                                           
                                                            if(result=='false'){
                                                                 $(".useridlabel").empty();
                                                              $("#btnx").attr("disabled", "disabled");
                                                              $(".useriderror").html('User Id not match in database');
                                                          }
                                                          }
                                                        }
                                                    });
                                     }                                             
                        //    Js Code here
                       </script>
                         
                     </div>
                                    </div>
                                     <div class="col-md-12">
                                    <label for="inputConfirmPassword" class="form-label">Enter Transaction Password</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class="lni lni-eye"></i></span>
                                        <input type="password" class="form-control" name="password" id="password"  required>
                                    </div>
                                </div></br>
                                    
                                </div>
                               
                                 
                     </div>
                            @php
                            $admin=DB::table('user')->where('role','admin')->first();
                            $admin_id=$admin->userid;
                            
                            @endphp
                           <input type="hidden" value="{{$admin_id}}" name="admin_id" id="admin_id">
                           <input type="hidden" value="{{Auth::user()->id}}" name="sender_id" id="sender_id">
                           <input type="hidden" value="{{Auth::user()->saving_wallet}}" id="saving_wallet">
                           <input type="hidden" value="ptop_transefer"  name="tbname">
                           <div class="d-flex justify-content-center">
                               <button type="submit" class="btn btn-success my-3" id="btnx">Transfer</button>
                           </div>
                           
                      
							</div>
						</div>
						  
							</form>
						 
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
                                    
            <!-- Scrollable -->
           
       </div>
       </div>
    
    {{--
      <script>
                    function onsubmitForm(){
                                 $("#error_amount").empty();
                                 event.preventDefault(); 
                                //  alert("hello");
                                    $.ajax({
                                            type: "POST",
                                             url: "{{ route('check_amount_ptop') }}",
                                             data: {
                                       
                                         sender_id:$("#sender_id").val(),
                                         amount:$("#amount").val(),
                                         saving_wallet:$("#saving_wallet").val(),
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
                                                         document.getElementById("target").submit(); 
                                                  
                                                    
                                                     }
                                                  }
                                           });
                                
                            }
                        </script> --}}
     <script>
                        function onsubmitForms(e) {
                            e.preventDefault(); 
                            $("#btnx").attr("disabled", true);
                            
                            $.ajax({
                                url: "{{ route('send_otp_email') }}",
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
                                url: "{{ route('verify_otp') }}",
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
