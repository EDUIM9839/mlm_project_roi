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
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User List</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button"
                            class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                                href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                                link</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <!--  -->
            <div class="content-wrapper">

          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">


            <h4 class="fw-bold py-3 mb-4">
              <span class="text-muted fw-light">Dashboard /</span> Income History
            </h4>

            <!-- Scrollable -->
             <form action="{{route('income_history')}}" method="POST" enctype="multipart/form-data" onsubmit="onsubmitForm()" id="target">
            <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr>
                                        <th>S.No.</th>
                                        <th>Amount</th>
                                        <th>Receiver User </th>
                                        <th>Joining User </th>
                                        <th>Level</th> 
                                        <th>Type</th> 
                                        <th>Credit Debit</th>
                                        <th>Date</th>
                                        </tr>
                    </thead>
            <tbody>
                                     
                                     @php
                                    $i = 1;
                                @endphp
                                @foreach ($income_history as $in)
                                    <tr> 
                                    <td>{{ $i++ }}</td>
                                        <td>{{ $in->id}}</td>
                                        <td>{{ $in->amount }}</td>
                                        <td>{{ $in->received_user }}  
                                        <td>{{ $in->joined_user}}</td>
                                        <td>{{ $in->Level_no}}</td>
                                        <td>{{ $in->type}}</td>
                                        <td>{{ $in->credit_debit}}</td>
                                        <td>{{ date('d-m-Y',strtotime($income_history->date)) }}</td>
                                    </tr>
               @endforeach
                                    </tbody>
                        </table>
                
            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->
          
          </form>
           



          <div class="content-backdrop fade"></div>
        </div>
            <!--  -->
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
