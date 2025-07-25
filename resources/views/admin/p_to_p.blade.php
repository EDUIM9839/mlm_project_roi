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
                            <li class="breadcrumb-item active" aria-current="page">P2P Transfer</li>
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
                         
                            <form     action="{{ route('admin_ptop_trancefer') }}" method="POST" enctype="multipart/form-data"  onsubmit="onsubmitForm()" id="target">
                                @csrf
							
									<!--<h7 class="card-title pb-2">Fund wallet balance: 0</h7>-->
									  <h6 style="color:green">Add Fund <br><br><span><div id="balance-info"  class="badge rounded-pill text-black bg-warning p-2 text-uppercase px-3"><i class='bx   align-middle me-1'></i><span id="current-balance">Add Fund:- {{Helper::get_currency()}}{{$add_fund}}</span></div></span> 
					    <span><div id="balance-info"  class="badge rounded-pill text-white bg-danger p-2 text-uppercase px-3 "><i class='bx   align-middle me-1'></i><span id="current-balance">P2P:- {{Helper::get_currency()}}{{$ptop}}</span></div></span>
					    <span><div id="balance-info"  class="badge rounded-pill text-white bg-success p-2 text-uppercase px-3"><i class='bx   align-middle me-1'></i><span id="current-balance">Current Balance:- {{Helper::get_currency()}}{{Auth::user()->saving_wallet}}</span></div></span>
					    
					    </h6>
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
                                </div>
                               
                                 <div>
                                      {{--
                         <label for="defaultFormControlInput" class="form-label">Description</label>
                        
                         <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='lni lni-notepad'></i></span>
                         <textarea name="description" class="form-control"></textarea>
                     </div>
                     --}}
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
                      	<div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr>
                     <th>Sr No.</th>
                     <th>Amount</th>
                     <th>Reciever</th>
                     <th>Date</th>
             </tr>
            </thead>
            <tbody> 
            @php
            
            $ptop = DB::table('ptop_transefer')->where('sender_id',$admin_id->id)->get();
            
            @endphp
            @foreach($ptop as $fh)
            @php
            $reciever=DB::table('user')->where('id',$fh->receiver_id)->first();
           
            @endphp
                <tr> 
                <td>{{$loop->iteration}}</td>
                <td>${{$fh->total_amount}}</td>
                <th>{{$reciever->first_name}}</th>
                <td>{{Helper::formatted_date($fh->date)}}</td>
                
                </tr>
              @endforeach
            </tbody>
                        </table>
                
            </div>
            <!--/ Scrollable -->

          </div>
                </div>
            </div>
                                    
            <!-- Scrollable -->
           
       </div>
       </div>
    
      <script>
                    function onsubmitForm(){
                                 $("#error_amount").empty();
                                 event.preventDefault(); 
                                //  alert("hello");
                                    $.ajax({
                                            type: "POST",
                                             url: "{{ route('check_amount_ptops') }}",
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
                        </script>
@endsection
