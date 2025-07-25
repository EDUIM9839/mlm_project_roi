@extends('user.layouts.main')
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
                            <li class="breadcrumb-item active" aria-current="page">Debit Autopool Income</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                                @php
                                    $i = 1;
                                @endphp
                                @if(!empty($direct_income[0]))
                                @foreach ($direct_income as $d)
                                @php
                                $user=DB::table("user")->where('id',$d->received_user)->first();
                                 $login_user=DB::table('user')->where('id',Auth::user()->id)->first();
                                @endphp
					<div class="col">
						<div class="card radius-15">
							<div class="card-body text-center">
								<div class="pt-2 border radius-15">
								     @if($d->proof_image==null)
								     	<img src="{{asset('assets/user_payment_barcode/nophoto.jpg')}}" style='width: 249px;height: 140px;' class=" shadow" alt="">
								     @else
								     	<img src="{{asset('assets/user_payment_barcode/').'/'.$d->proof_image}}" style='width: 249px;height: 140px;' class=" shadow" alt="">
								     @endif
								
									 <div id="example_wrapper" class="dataTables_wrapper no-footer my-2" style="padding: 14px";>
                                     <table class="table table-bordered">
                                         <tr>
                                             <th>Name</th>
                                             <td>{{$user->first_name}} {{$user->last_name}}</br><b>{{$user->userid}}</b></td>
                                             <th>Amount</th>
                                             <td>{{Helper::get_currency()}}{{$d->amount}}</td>
                                         </tr>
                                         <tr>
                                             <th>Pay Status</th>
                                             <td>
                                                 @if($d->credit_status=="pending")
                                                 <span style='color:red'>Pending</span>
                                                 @else
                                                  <span style='color:green'>Paid</span>
                                                 @endif
                                             </td>
                                             <th>Pay Date</th>
                                             <td>
                                                 @if($d->credit_status=="pending")
                                                  
                                                 @php 
                                                 $counter_date=date("M d, Y H:i:s",strtotime('+1 days',strtotime($d->created_at)))
                                                 @endphp
                                                 <p id="demo{{$d->id}}"></p>

                                               <script>
                                               // Set the date we're counting down to
                                               var countDownDate{{$d->id}} = new Date("{{$counter_date}}").getTime();
                                               
                                               // Update the count down every 1 second
                                               var x{{$d->id}} = setInterval(function() {
                                               
                                                 // Get today's date and time
                                                 var now = new Date().getTime();
                                                   
                                                 // Find the distance between now and the count down date
                                                 var distance{{$d->id}} = countDownDate{{$d->id}} - now;
                                                   
                                                 // Time calculations for days, hours, minutes and seconds
                                                 var days{{$d->id}} = Math.floor(distance{{$d->id}} / (1000 * 60 * 60 * 24));
                                                 var hours{{$d->id}} = Math.floor((distance{{$d->id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                 var minutes{{$d->id}} = (Math.floor((distance{{$d->id}} % (1000 * 60 * 60)) / (1000 * 60)));
                                                 var seconds{{$d->id}} = Math.floor((distance{{$d->id}} % (1000 * 60)) / 1000);
                                                   
                                                 // Output the result in an element with id="demo"
                                                 document.getElementById("demo{{$d->id}}").innerHTML = hours{{$d->id}} + "h "
                                                 + minutes{{$d->id}} + "m " + seconds{{$d->id}} + "s ";
                                                   
                                                 // If the count down is over, write some text 
                                                 if (distance{{$d->id}} < 0) {
                                                   clearInterval(x{{$d->id}});
                                                   document.getElementById("demo{{$d->id}}").innerHTML = "<span style='color:red;'>Suspend</span>";
                                                 }
                                               }, 1000);
                                               </script>
                                               
                                               @else
                                               {{date("d-M-Y H:i:s",strtotime($d->credit_date))}}
                                               @endif
                                              </td>
                                         </tr>
                                         <tr>
                                              <th>Confirm Status</th>
                                             <td>
                                                 @if($d->status=="pending")
                                                 <span style='color:red'>Pending</span>
                                                 @else
                                                  <span style='color:green'>Paid</span>
                                                 @endif
                                             </td>
                                             <th>Confirm Date</th>
                                             <!--<td>{{date("d-M-Y H:i:s",strtotime($d->date_time))}}</td>-->
                                             <td>
                                                @if($d->credit_status=="pending")
                                                 {{"dd-mm-YYYY"}}
                                                @elseif($d->status=="paid")
                                                {{date("d-M-Y",strtotime($d->confirm_date))}}
                                                @else
                                                @if($user->company_role=="yes")
                                                 {{"dd-mm-YYYY"}}
                                                 @else
                                                  @php 
                                                 $counter_date2=date("M d, Y H:i:s",strtotime('+1 days',strtotime($d->credit_date)))
                                                 @endphp
                                                 <p id="demo_{{$d->id}}"></p>
                                               <script>
                                               // Set the date we're counting down to
                                               var countDownDate_{{$d->id}} = new Date("{{$counter_date2}}").getTime();
                                               
                                               // Update the count down every 1 second
                                               var x_{{$d->id}} = setInterval(function() {
                                               
                                                 // Get today's date and time
                                                 var now = new Date().getTime();
                                                   
                                                 // Find the distance between now and the count down date
                                                 var distance_{{$d->id}} = countDownDate_{{$d->id}} - now;
                                                   
                                                 // Time calculations for days, hours, minutes and seconds
                                                 var days_{{$d->id}} = Math.floor(distance_{{$d->id}} / (1000 * 60 * 60 * 24));
                                                 var hours_{{$d->id}} = (Math.floor((distance_{{$d->id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
                                                 var minutes_{{$d->id}} = (Math.floor((distance_{{$d->id}} % (1000 * 60 * 60)) / (1000 * 60)));
                                                 var seconds_{{$d->id}} = Math.floor((distance_{{$d->id}} % (1000 * 60)) / 1000);
                                                   
                                                 // Output the result in an element with id="demo"
                                                 document.getElementById("demo_{{$d->id}}").innerHTML = hours_{{$d->id}} + "h "
                                                 + minutes_{{$d->id}} + "m " + seconds_{{$d->id}} + "s ";
                                                   
                                                 // If the count down is over, write some text 
                                                 if (distance_{{$d->id}} < 0) {
                                                   clearInterval(x_{{$d->id}});
                                                   document.getElementById("demo_{{$d->id}}").innerHTML = "<span style='color:red;'>Suspend</span>";
                                                   
                                                 }
                                               }, 1000);
                                               </script>
                                               @endif
                                                 @endif
                                                 
                                             </td>
                                         </tr>
                                     </table>
                                      </div> 
                                      @if($login_user->suspend_status=="suspend" && $login_user->company_role=="no")
                                     
                                      @else
                                     
                                     
                                               @if($d->credit_status=="pending")
                                                	<button type="button" class="btn btn-outline-success px-5 mb-1" onclick="show_payment({{$d->id}})">Pay</button>
                                                	<!-- Button trigger modal -->
                                                  <script>
                                                      function show_payment(id){
                                                          
                                                          $("#form"+id).show();
                                                      }
                                                  </script>
                                                 @else
                                               	<button type="button" class="btn btn-success px-5 mb-1 w-100">Paid</button>
                                               	@endif
                                                 @endif
								
									</div>
								</div>
							</div>
						</div>
						<div class="col" style='display:none;' id="form{{$d->id}}">
						<div class="card radius-15">
							<div class="card-body">
								<div class="p-4 border radius-15">
								    <form method="post" action="{{route('pay_autopool_income')}}" enctype='multipart/form-data'>
								        @csrf
								        <lable for='upi_usdt'>Select UPI/USDT</lable>
								        <select class="form-control" name='upi_usdt' id='upi_usdts' onchange='select_usdt_upi({{$user->id}})' required>
								            <option value=''>--Select--</option>
								            <option value='upi'>UPI</option>
								            <option value='usdt'>USDT</option>
								        </select>
								        <script>
								            function select_usdt_upi(id){
								                $("#barcode_show").show();
								               var upi_usdts= $("#upi_usdts").val();
								                $.ajax({
                                                   url:"{{route('get_user_usdt_upi')}}",    //the page containing php script
                                                   type: "post", 
                                                   data: {id: id,upi_usdt:upi_usdts,_token: "{{ csrf_token() }}"},
                                                   success:function(result){
                                                    //   console.log(result);
                                                    if(result.usdt_upi !=""){
                                                        $("#data").show();
                                                        $("#data2").hide();
                                                        $("#ustd_upi").html(result.usdt_upi);
                                                      $("#address").html(result.address);
                                                      var path="user_self_payment_barcode/";
                                                      $("#img").html('<img style="width:150px; height:150px" src="{{asset('user_self_payment_barcode')}}/'+result.image+'" />');
                                                    }else{
                                                         $("#data2").show();
                                                        $("#data2").html("<span style='color:red'>Plase Select UPI/USDT</span>");
                                                        $("#data").hide();
                                                    }
                                                      
                                                   }
                                               });
								            }
								        </script>
								        <div id='barcode_show' style='display:none'>
								           <div class="row mt-2">
								               <div class="col-sm-12 text-center" id="data">
								                   <h5><span id="ustd_upi"></span> Address: <span id='address'></span> </h5>
								                   <span id="img"></span>
								               </div>
								                <div class="col-sm-12 text-center" id="data2">
								                </div>
								             
								           </div>
								        </div>
								        <lable>Proof Of Image</lable>
								       <input name='proof_of_image' type='file' class='form-control' required>
								       <input name='id' type='hidden' class='form-control' value='{{$d->id}}'>
								       <br><br>
								      	<button type="submit" class="btn btn-outline-success px-5 mb-1">Submit</button>
								    </form>
								</div>
								</div>
							</div>
						</div>
					@endforeach
					 @else
                        <div class="col">
						<div class="card radius-15">
							<div class="card-body text-center">
								<div class="p-2 border radius-15">
									<img src="{{asset('assets/user_payment_barcode/coming_soon.png')}}" width="160" height="160" class=" shadow" alt="">
									<h5 class="mb-0 mt-5"></h5>
									<p class="mb-3"></p>
									<button type="button" class="btn btn-outline-danger px-5 rounded-0">Coming Soon</button>
									</div>
								</div>
							</div>
						</div>
                   @endif
				</div>
             
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection
