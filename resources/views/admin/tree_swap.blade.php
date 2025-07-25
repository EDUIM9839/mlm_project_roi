@extends('admin.layouts.main')
<link>
<!-- CSRF Token in <head> -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>


    .text-success {
        color: green;
    }
    .text-danger {
        color: red;
    }

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
                            <li class="breadcrumb-item active" aria-current="page">Update Tree Swap</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    
                </div>
            </div>
            <!--end breadcrumb-->
            
          
            <!-- Scrollable -->
            
            
            <div class="card">
              

        @php $referal = request()->query('referal');  @endphp
      

        <form action="{{ route('updatereferal') }}" method="POST" class="p-4 shadow rounded bg-white">
                @csrf
            
                
               <div class="row">
                    <div class="col-md-5">
                    <label for="referalId" class="form-label text-muted">User ID</label>
                    <input type="text" name="referal" class="form-control" id="referalId"
                           placeholder="Enter User ID"
                           value="{{ old('referal') ? old('referal') : (isset($referal) ? $referal : '') }}">
                    @error('referal') 
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <small id="show_name" class="mt-1 d-block"></small>
                </div>
            
                <div class="col-md-5">
                    <label for="updatereferal" class="form-label text-muted">Update Referal</label>
                    <input type="text" name="updatereferal" class="form-control" id="updatereferal"
                           value="{{ old('updatereferal') }}">
                    @error('updatereferal') 
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <small id="joingreferal" class="mt-1 d-block"></small>
                </div>
            
                <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-warning btn-sm w-100">Update Tree</button>
            </div>


                   </div>
            </form>

                   
                   
                   
                
              </div>
              
              
              <div class="card border-dark p-2">
              <div class="border-dark table-responsive text-nowrap">
                  
                     <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding:5px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
    <thead>
        <tr class='table-dark'>
            <th>Sr.No</th>
            <th>User Id</th>
            <th>Old Referral</th>
            <th>New Referral</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @php
            use Illuminate\Support\Facades\DB;
            use Carbon\Carbon;

            $data = DB::table('tree_swap_history as tsh')
                ->join('user as u', 'u.id', '=', 'tsh.userid')
                ->leftJoin('user as old_r', DB::raw("CONVERT(old_r.userid USING utf8mb4) COLLATE utf8mb4_unicode_ci"), '=', 'tsh.old_referal')
                ->leftJoin('user as new_r', DB::raw("CONVERT(new_r.userid USING utf8mb4) COLLATE utf8mb4_unicode_ci"), '=', 'tsh.new_referal')

                ->select(
                    'tsh.old_referal',
                    'tsh.new_referal',
                    'tsh.created_at',
                    'u.userid as user_code',
                    'u.first_name',
                    'u.last_name',
                    'old_r.first_name as old_first',
                    'old_r.last_name as old_last',
                    'new_r.first_name as new_first',
                    'new_r.last_name as new_last'
                )
                ->orderBy('tsh.created_at', 'desc')
                ->get();
        @endphp

        @foreach ($data as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $row->user_code }} - {{ $row->first_name }} {{ $row->last_name }}</td>
                <td>
                    {{ $row->old_referal }}
                    @if($row->old_first || $row->old_last)
                        - {{ $row->old_first }} {{ $row->old_last }}
                    @endif
                </td>
                <td>
                    {{ $row->new_referal }}
                    @if($row->new_first || $row->new_last)
                        - {{ $row->new_first }} {{ $row->new_last }}
                    @endif
                </td>
                <td>{{ Carbon::parse($row->created_at)->format('Y-m-d') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

                    </div>
                </div>
            </div>
            
            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->

    
    
    


<!--<script>-->
<!--    $(document).ready(function() {-->
<!--        $("#withdrawal_request").DataTable();-->
<!--    });-->
<!--</script>-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {

      
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       
        const referralIdFromQuery = @json($referal);
        if (referralIdFromQuery) {
            validateReferral(referralIdFromQuery);
        }

     
        $('#referalId').on('keyup', function () {
            const inputVal = $(this).val().trim();
            $('#show_name').empty();

            if (inputVal.length > 0) {
                validateReferral(inputVal);
            } else {
                $('#form-area').slideUp();
            }
        });

       
        $('#referalId').on('keydown', function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
            }
        });

       
        $('input').on('keyup', function () {
            $('.invalid-text').hide();
        });

        
        function validateReferral(referralId) {
            $.ajax({
                url: '{{ route('get-referer-user') }}',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    referralId: referralId
                }),
                success: function (response) {
                    console.log('Referral check response:', response);

                    if (response.status === 'success') {
                        $('#show_name').text(response.user).addClass('text-success');
                        $('#joingreferal').text(response.referal).addClass('text-success');
             
                        $('#form-area').slideDown();
                    } else if (response.status === 'warning') {
                        $('#show_name').text(response.message).addClass('text-danger');
                        $('#form-area').slideUp();
                    } else {
                        $('#show_name').text(response.message);
                        $('#form-area').slideUp();
                    }
                },
                error: function (xhr) {
                    console.error('Referral validation failed:', xhr);
                    $('#show_name').text('Server error or invalid response.');
                    $('#form-area').slideUp();
                }
            });
        }

    });
</script>

@endsection
