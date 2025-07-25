@extends('admin.layouts.main')
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
                            <li class="breadcrumb-item active" aria-current="page">Person to Person Transefer</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            
            <!--end breadcrumb-->
            <!--  -->
            <div class="card">
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
                                
                                    
             <div class="card-body d-flex" style="justify-content: center;">
            <div class="col-md-6">
             <div class="card mb-4">
               <div class="card-body">
                   <div class="row">
                       <div class="col-sm-2"></div>
                       <div class="col-sm-8" id="error_amount">
                            
                       </div>
                       <div class="col-sm-2"></div>
                   </div>
                     
                <h4 class="fw-bold py-3 mb-4">
                    <span class="text-muted fw-light"></span>
                 </h4>
                 
                <form action="{{route('ptop_trancefer')}}" method="POST" enctype="multipart/form-data" onsubmit="onsubmitForm()" id="target">
                    @csrf
                    
                    <h6 style="color:green">Current Fund Amount: {{Auth::user()->saving_wallet}}</h6>
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Amount</label>
                         <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="0.0" required>
                   </div>
                   </div>

                     <div>
                         <label for="defaultFormControlInput" class="form-label">Pay To User Id: </label> <span class="useridlabel" style="color:green" ></span><span class="useriderror" style="color:red" ></span>
                           <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-coin'></i></span>
                         <input type="text" oninput="getUser()" class="form-control" id='receiver_id' required>
                         <input type="hidden"  class="form-control" name="receiver_id" id='receiver_id1'>
                          <script>
                                     function getUser(){
                                       $("#btnx").attr("disabled", "disabled");
                                      $(".useriderror").empty();
                                      $(".useridlabel").empty();
                                         var userid=$("#receiver_id").val();
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
                                                             $("#btnx").removeAttr("disabled");
                                                            $(".useridlabel").html(result['0'].first_name+" "+result['0'].last_name);
                                                            $("#receiver_id1").val(result['0'].id);
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
                     <div>
                         <label for="defaultFormControlInput" class="form-label">Description</label>
                         <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                         <textarea name="description" class="form-control"></textarea>
                     </div>
                      </div>
                                                                               
                       <div>
                           <input type="hidden" value="{{Auth::user()->id}}" name="sender_id" id="sender_id">
                           <input type="hidden" value="{{Auth::user()->saving_wallet}}" id="saving_wallet">
                           <input type="hidden" value="ptop_transefer"  name="tbname">
                           <button type="submit" class="btn btn-primary my-3" id="btnx">Transefer</button>
                       </div>

                      </form>
                          </div>
                      </div>
                              </div>
                                                              
                                                              
                          </div>
                      </div>
<!--  -->
                    <!--Table start -->
                    <div class="card" style="margin-top:20px; magin-bottom:50px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped">
                                    <thead>
                                       <tr class='table-dark'>
                                        <th>S.No.</th>
                                        <th>Sender User ID</th>
                                        <th>Receiver User Id</th>
                                        <th>Receiver Name</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                     @php
                                    $i = 1;
                                @endphp
                                @foreach ($ptop_transefer as $ptop)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{Auth::user()->userid}}</td>
                                        <td>{{ $ptop->userid }}</td>
                                        <td>{{$ptop->first_name}} {{$ptop->last_name}}</td>
                                        <td>₹ {{ $ptop->amount }}</td>
                                        <td>{{ $ptop->description }}</td>
                                        <td>{{ date('d-m-Y',strtotime($ptop->date)) }}</td>
                                    </tr>
                                @endforeach
                    
                                    </tbody>
                                    </table>
                                </div>
                             </div>
                        </div>
                    </div>
                                <!-- table end -->
                            </div>
                        </div>
                        
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
                        </script>
@endsection
