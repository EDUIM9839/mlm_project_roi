@extends('admin.layouts.main')
<link><>
<style>
    
    @media(max-width: 600px){
     .totalAmountCard{
         width: 100%;
         display: flex;
         align-items: center;
         justify-content: center;
         margin-top: 0 !important;
         margin-bottom: 5px !important;
     }
     .nav-pills{
         margin-bottom: 0 !important;
     }
     .totalAmountCardParent{
         margin-top: 0 !important;
     }
     
    }
    
     .nav-pills .nav-link.active{
             background-color: #36a817 !important;
     }
     .nav-pills .nav-link.inactive{
         color: #ffffff !important;
        background: #df0c0c;
     }
     .totalAmountCard{
             background: #d4ffd4 !important;
            color: green ;
            border: 2px solid #0080002e !important;
            box-shadow: none !important;
     }
     
</style>
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
                            <li class="breadcrumb-item active" aria-current="page">Payout Request</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    
                </div>
            </div>
            <!--end breadcrumb-->
            
          
            <!-- Scrollable -->
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
           
          @php $lastotpinsert = DB::table('admin_otp_codes')
                ->where('type', 'enter_withdrawal_update')
                ->where('is_used', 1)
                ->orderBy('id', 'DESC')
                ->first();
                $otpCreatedAt = date('Y-m-d H:i:s');
                $otpExpiry = \Carbon\Carbon::parse($lastotpinsert->created_at)->addMinutes(10);
                
                if (strtotime($otpCreatedAt) > strtotime($otpExpiry)) {
                        DB::table('admin_otp_codes') 
                            ->where('id', $lastotpinsert->id)
                            ->update([
                                'enable_disable' => 0,
                            ]);
                    }

                @endphp
               
        @if($lastotpinsert->enable_disable == 1)
                
            <div class="card">
            <div class="card-header">
                <h6 class="withdrawal-text">Payout Request</h6> 
              

            </div>
              <div class="card-body">
                  
                  @include('admin.partials.withdrawal_requests_table')
                  
              </div>
            </div>
            @else
              @include('admin.partials.verify_otp_form')
            @endif
            </div>

          </div>
          <!-- / Content -->






          <div class="content-backdrop fade"></div>
        </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->

        </div>
            <!--  -->
        </div>
    </div> 
    
    

    
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<!--<script>-->
<!--    $(document).ready(function() {-->
<!--        $("#withdrawal_request").DataTable();-->
<!--    });-->
<!--</script>-->
<script>
        $(document).ready(function() {
    $('#withdrawal_request').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5'
        ]
    } );
} );
    </script>
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
