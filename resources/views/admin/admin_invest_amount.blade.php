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
                            <li class="breadcrumb-item active" aria-current="page">Activate User</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
			
            <div class="card">
                <!--<div class="card-body p-4">-->
                     @if (session()->has('success'))
                                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class='bx bxs-message-square-check'></i>
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
                         
                            <form action="{{route('activate_user_invest')}}" method="POST" enctype="multipart/form-data"    id="target">
                                @csrf
					<div class="border p-4 rounded">
						<div class="row g-6">
                             
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <label for="inputConfirmPassword" class="form-label">Activate User Id</label> <span class="useridlabel" style="color:green" ></span><span class="useriderror" style="color:red" ></span>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='lni lni-user'></i></span>
                                    <input type="text" name="user_id" oninput="getUser()" class="form-control"  placeholder="Enter User ID"  id='receiver_id' required >
                                    @error('activation_id')
                                    <br><span class='text text-danger'>{{$message}}</span>
                                    @enderror
                                    <input type="hidden"  class="form-control" name="activation_id" id='receiver_id1'>
                                         <script>
                                     function getUser(){
                                         
                                      $("#btnx").attr("disabled", "disabled");
                                      $("#error_amount").empty();
                                      $(".useriderror").empty();
                                      $(".useridlabel").empty();
                                         var userid=$("#receiver_id").val();
                                         console.log(userid);
                                              $.ajax({
                                                    url: "{{ route('ptop_userrs') }}",
                                                     type: "POST",
                                                     data: {
                                                         userid: userid,
                                                         _token: '{{ csrf_token() }}'
                                                     },
                                                     dataType: 'json',
                                                     success: function(result) {
                                                         
                                                     
                                                         if (result.length > 0) {
                                                                     if(sender_id==result['0'].id){
                                                                          $(".useridlabel").empty();
                                                                      $("#btnx").attr("disabled", "disabled");
                                                                      $(".useridlabel").html('<b class="text text-danger">!Sorry You are admin</b>');
                                                                     }else{
                                                                          $("#btnx").removeAttr("disabled");
                                                                    $(".useridlabel").html('<b class="text text-success">'+result['0'].first_name+" "+result['0'].last_name+'</b>');
                                                                    $("#receiver_id1").val(result['0'].id);
                                                                     }
                                                                   
                                                                    if(result=='false'){
                                                                         $(".useridlabel").empty();
                                                                      $("#btnx").attr("disabled", "disabled");
                                                                      $(".useridlabel").html('<b class="text text-danger"> User Id not found </b>');
                                                                  }
                                                          }
                                                        }
                                                    });
                                     }                                             
                        //  Js Code here
                       </script>
                          <br>
                           <div class="input-group mt-3">
                            <label for="defaultFormControlInput" class="form-label">Enter Amount</label>
                            </div>
                                 <div class="input-group">
                                      <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-dollar-circle"></i></span>
                                      <select class="form-control" name='package_id' required >
                                          <option value="">--Select--</option>
                                          @php
                                          $package=DB::table("package")->get();
                                          @endphp
                                          @foreach($package as $packages)
                                          <option value="{{$packages->id}}">{{$packages->cost}}</option>
                                          @endforeach
                                      </select>
                             </div>
                           <input type="hidden" value="{{Auth::user()->id}}" name="activated_by" id="sender_id">
                           <input type="hidden" value="{{Auth::user()->saving_wallet}}" id="saving_wallet">
                           <input type="hidden" value="user_package"  name="tbname">
                           <div class="d-flex justify-content-center">
                               <button type="submit" class="btn btn-success my-3" id="btnx">Activate</button>
                         
                     </div>
                                    </div>
                                </div>
                               
                           <div class="col-md-3"></div>
							</div>
						</div>
						  
							</form>
						 
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
