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
                            <li class="breadcrumb-item active" aria-current="page">Payout History</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    
                </div>
            </div>
            <!--end breadcrumb-->
            
          
            <!-- Scrollable -->
            @php
    $check_user=DB::table('withdrawl_request')->where('status','pending')->get();
    @endphp
    @if(count($check_user)>0)
    
            <div class="card">
              <h class="card-header "> 

              <div class="table-responsive text-nowrap">
                <table id="withdrawal_request" class="table display nowrap dataTable" style="width:100%">
                  <thead>
                    <tr >
                       <th>Id</th>
                       <th>Name</th>
                       <th>Amount</th>
                     <th>Paying Amount</th>
                     
                     <th>Status</th>
                     <th>Request Date</th>
                     <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                          @php
                                    $i = 1;
                                @endphp
                                @foreach ($pending_users as $da)
                         <tr>
                         <td>{{$i++}}</td>
                         @php
                         $user_name=DB::table('user')->where('id',$da->user_id)->first();
                         @endphp
                         <td>{{$user_name->first_name}}</td>
                           <td>{{Helper::get_currency()}}{{$da->amount}}</td>
                        <!--<td></td>-->
                        <td>{{$da->paying_amount}}</td>
                        @if($da->status=='pending')
                        <td><span class="badge bg-danger">Pending</span>
                        </td>
                        @else
                         <td><span class="badge bg-success">Approved</span>
                        </td>
                           @endif
                     <td><?php echo date('d-M-Y  h:i:s a ', strtotime($da->created_at));?></td>
                     
                     <td>{{$user_name->bank_name}}</td>

                        <td>
                       @if($da->status=='pending')
                    <a href="{{route('change_status',['id'=> $da->id])}}"  type="button" class="btn btn-primary submit-btn" onclick="myFunc()">Pay</a>
                    @else
                    
                    <a   type="button" class="badge btn-success " onclick="myFunc()"><i style="font-size:12px" class="fa">&#xf058;</i>Paid</a> 
                    </td>
                    @endif

                    </div>
                            <!--<a href="# &amp;tbname=withdrawl_request"><button class="btn btn-danger"> n mnbDelete</button></a>-->
                            </td>
                      </tr>
                       @endforeach
                    </tbody>
                </table>
              </div>
              
              @else
<style>

.no-data-container {
    text-align: center;
    color: #333;
}

.no-data-icon {
    font-size: 48px;
    color: #777;
    margin-bottom: 20px;
}

.no-data-message {
    font-size: 24px;
    font-weight: bold;
}

</style>

     <div class="no-data-container" style="margin-top: 10%;">
        <div class="no-data-icon">
             <img src="{{ Storage::url('app/gif/2XZrEOmlKy.gif')}}" alt="Not Found" class="gif">
            <!-- You can use an icon from a library like FontAwesome, or use an SVG -->
            
        </div>
        <div class="no-data-message">
            No Data Found
        </div>
    </div>



            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->


@endif


          <div class="content-backdrop fade"></div>
        </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->

        </div>
            <!--  -->
        </div>
    </div> 
    
<script>
    $(".submit-btn").on( 'click', function(e){
        // some implementation
        // Now showing the alert
        var url=$(this).attr('href');
        // console.log(url);
        e.preventDefault();
        
        jQuery.getScript('https://cdn.jsdelivr.net/npm/sweetalert2@11', function() {
        
        Swal.fire({
          title: 'Are you sure to paid ?',
          text: "",
          icon: 'success',
          showCancelButton: true,
          confirmButtonColor: '#C64EB2',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
        }).then((result) => {
          if (result.isConfirmed) {
             
             console.log(url);
             location.assign(url);
           
          } else {
            console.log('clicked cancel');
          }
        })
        
        })
       
    });
    </script>
@endsection
