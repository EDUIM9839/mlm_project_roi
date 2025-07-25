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
                   
     <!--               <div class="form-body ">-->
                         
     <!--                       <form     action="{{route('activate_user_by_admin')}}" method="POST" enctype="multipart/form-data"    id="target">-->
     <!--                           @csrf-->
							
									<!--<h7 class="card-title pb-2">Fund wallet balance: 0</h7>-->
					<!--				  <h6 style="color:green">Fund wallet balance: {{Auth::user()->saving_wallet}}</h6>  <span id="error_amount"></span>-->
					<!--			<hr/>-->
                
					<!--<div class="border p-4 rounded">-->
					<!--	<div class="row g-6">-->
                             
     <!--                           <div class="col-md-12">-->
     <!--                               <label for="inputConfirmPassword" class="form-label">ACTIVATE USER</label> <span class="useridlabel" style="color:green" ></span><span class="useriderror" style="color:red" ></span>-->
     <!--                               <div class="input-group"> <span class="input-group-text bg-transparent"><i-->
     <!--                                           class='lni lni-user'></i></span>-->
                                        <!--<input type="text" class="form-control" name="currency_symbol"-->
                                        <!--     id="currency_symbol"-->
                                        <!--    placeholder="" />-->
                                        
                                        
     <!--                               <input type="text" oninput="getUser()" class="form-control"  placeholder="ENTER USERID"  id='receiver_id' required>-->
     <!--                               @error('activation_id')-->
     <!--                               <br><span class='text text-danger'>{{$message}}</span>-->
     <!--                               @enderror-->
     <!--                               <input type="hidden"  class="form-control" name="activation_id" id='receiver_id1'>-->
     <!--                                    <script>-->
     <!--                                function getUser(){-->
     <!--                                 $("#btnx").attr("disabled", "disabled");-->
     <!--                                 $("#error_amount").empty();-->
     <!--                                 $(".useriderror").empty();-->
     <!--                                 $(".useridlabel").empty();-->
     <!--                                    var userid=$("#receiver_id").val();-->
     <!--                                    var sender_id=$("#sender_id").val();-->
                                         <!--console.log(userid);-->
     <!--                                          $.ajax({-->
     <!--                                               url: "{{ route('ptop_userrs') }}",-->
     <!--                                                type: "POST",-->
     <!--                                                data: {-->
     <!--                                                    userid: userid,-->
     <!--                                                    _token: '{{ csrf_token() }}'-->
     <!--                                                },-->
     <!--                                                dataType: 'json',-->
     <!--                                                success: function(result) {-->
                                                         
                                                     
     <!--                                                    if (result.length > 0) {-->
     <!--                                                                if(sender_id==result['0'].id){-->
     <!--                                                                     $(".useridlabel").empty();-->
     <!--                                                                 $("#btnx").attr("disabled", "disabled");-->
     <!--                                                                 $(".useridlabel").html('<b class="text text-danger">!Sorry You are admin</b>');-->
     <!--                                                                }else{-->
     <!--                                                                      $("#btnx").removeAttr("disabled");-->
     <!--                                                               $(".useridlabel").html('<b class="text text-success">'+result['0'].first_name+" "+result['0'].last_name+'</b>');-->
     <!--                                                               $("#receiver_id1").val(result['0'].id);-->
     <!--                                                                }-->
                                                                   
     <!--                                                               if(result=='false'){-->
     <!--                                                                    $(".useridlabel").empty();-->
     <!--                                                                 $("#btnx").attr("disabled", "disabled");-->
     <!--                                                                 $(".useridlabel").html('<b class="text text-danger"> User Id not found </b>');-->
     <!--                                                             }-->
     <!--                                                     }-->
     <!--                                                   }-->
     <!--                                               });-->
     <!--                                }                                             -->
                         <!--Js Code here-->
     <!--                  </script>-->
                         
     <!--                </div>-->
     <!--                               </div>-->
     <!--                           </div>-->
                               
                     <!--            <div>-->
                     <!--    <label for="defaultFormControlInput" class="form-label">Description</label>-->
                     <!--    <div class="input-group"> <span class="input-group-text bg-transparent"><i-->
                     <!--                           class='lni lni-notepad'></i></span>-->
                     <!--    <textarea name="description" class="form-control"></textarea>-->
                     <!--</div>-->
                     
     <!--                      <input type="hidden" value="{{Auth::user()->id}}" name="activated_by" id="sender_id">-->
     <!--                      <input type="hidden" value="{{Auth::user()->saving_wallet}}" id="saving_wallet">-->
     <!--                      <input type="hidden" value="user_package"  name="tbname">-->
     <!--                      <div class="d-flex justify-content-center">-->
     <!--                          <button type="submit" class="btn btn-success my-3" id="btnx">Activate</button>-->
     <!--                      </div>-->
                           
                      
					<!--		</div>-->
					<!--	</div>-->
						  
					<!--		</form>-->
						 
					<!--</div>-->
                       
                </div>
            </div>
                                    
            <!-- Scrollable -->
            <h4 align="center"> Activation History </h4>
        <div class="card m-3">
                       <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr class="table-dark">
                                    <th>Sr.No</th>
                                    <th>User</th> 
                                    <th>Status</th>
                                    <th>Activated Date</th>
                                </tr>
                            </thead>
                            <tbody>         
                                
                                @php
                                    $i = 1;
                                    
                                    
                                @endphp
                                @foreach ($all_user as $af)
                                
                                
                                    <tr>
                                        <td>{{ $i++ }}</td> 
                                        
                                        
                                        <td> {{$af->first_name}} {{$af->last_name}}
                                        <br> <b>{{$af->userid}}</b>
                                        </td> 
                                        
                                        @if($af->status=='approved')
                                        <td><b><span style="color:green" >Active   <i class="far fa-check-circle"></i> 
                                        @else    <i class="far fa-clock fa-spin"></i>  </span></b>
                                        </td>
                                         @endif
                                        <td> {{ Helper::formatted_date($af->created_at)}}
                                        </td>
                                    </tr>
                                @endforeach 
                            </tbody> 
                        </table>
                    </div>
                </div>
        </div>
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
