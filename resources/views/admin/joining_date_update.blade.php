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
                            <li class="breadcrumb-item active" aria-current="page">Update User Joining Date</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    
                </div>
            </div>
            <!--end breadcrumb-->
            
          
            <!-- Scrollable -->
            
            
            <div class="card">
              <h class="card-header "> 

        @php $referal = request()->query('referal');  @endphp
      

        <form action="{{ route('update-joining-date') }}" method="POST" class="p-4 shadow rounded bg-white" style="max-width: 500px; margin: auto;">
                @csrf
            
                
                <div class="mb-3">
                    <label for="referalId" class="form-label text-muted">User ID</label>
                    <input type="text" name="referal" class="form-control" id="referalId"
                           placeholder="Enter User ID"
                           value="{{ old('referal') ? old('referal') : (isset($referal) ? $referal : '') }}">
                    @error('referal') 
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <small id="show_name" class="mt-1 d-block"></small>
                </div>
            
                <div class="mb-3">
                    <label for="joiningDate" class="form-label text-muted">Joining Date</label>
                    <input type="date" name="joiningDate" class="form-control" id="joiningDate"
                           value="{{ old('joiningDate') }}">
                    @error('joiningDate') 
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <small id="joingDate" class="mt-1 d-block"></small>
                </div>
            
                <div class="text-center">
                    <button type="submit" class="btn btn-warning px-4">Update Joining Date</button>
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
                                    <th>Perious Date</th>
                                    <th>Updated Date</th>
                                    <th>Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    use Illuminate\Support\Facades\DB;
                                    use Carbon\Carbon;
                            
                                    $data = DB::table('joining_date_history as jdh')
                                        ->join('user as u', 'u.id', '=', 'jdh.userid')
                                        ->select(
                                            'jdh.beforeDate',
                                            'jdh.updateDate',
                                            'jdh.created_at',
                                            'u.userid as user_code',
                                            'u.first_name',
                                            'u.last_name'
                                        )
                                        ->orderBy('jdh.created_at', 'desc')
                                        ->get();
                                @endphp
                            
                                @foreach ($data as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row->user_code }} - {{ $row->first_name }} {{ $row->last_name }}</td>
                                        <td>{{ Carbon::parse($row->beforeDate)->format('Y-m-d') }}</td>
                                        <td>{{ Carbon::parse($row->updateDate)->format('Y-m-d') }}</td>
                                        <td>{{ Carbon::parse($row->created_at)->format('Y-m-d H:i:s') }}</td>
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
                        $('#joingDate').text(response.date).addClass('text-success');
             
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
