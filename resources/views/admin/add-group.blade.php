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
                            <li class="breadcrumb-item active" aria-current="page">Percentage</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class='col-md-6'>
                        <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{route('group_wise')}}" class='badge bg-info'>Group Percentage</a></h6>
                    </div>
                   
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card p-3">
                        <!-- Success/Error Alert -->
                        @if (session()->has('success'))
                            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-white"><i class='bx bxs-message-square-check'></i></div>
                                    <div class="ms-3">
                                        <div class="text-white">{!! session()->get('success') !!}</div>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i></div>
                                    <div class="ms-3">
                                        <div class="text-white">{!! session()->get('error') !!}</div>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="form-body">
                            <form id="addGroupForm" action="{{ route('addGroup') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="group_name" class="form-label">Group Name</label>
                                    <input type="text" class="form-control" id="group_name" name="group_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="group_percentage" class="form-label">Percentage</label>
                                    <input type="number" step="any" class="form-control" id="group_percentage" name="group_percentage" required>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary" id="submitButton">Create Group</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card p-2">
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>Percentage Name</th>
                                    <th>Percentage</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                           <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($groups as $au)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$au->group_name}}</td>
                                        <td>{{ $au->group_percentage}} %</td>
                                        <td class="text-center">
                                            <div class="d-flex order-actions">
                                                <a href="javascript:void(0)" class="edit-group" data-id="{{ $au->id }}"><i class="bx bxs-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach  
                           </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scrollable -->
    </div>

<script>
    $(document).on('click', '.edit-group', function() {
        var groupId = $(this).data('id'); 
        $.ajax({
            url: '/admin/get-group-details/' + groupId,  
            method: 'GET',
            success: function(response) {
                $('#group_name').val(response.group_name);
                $('#group_percentage').val(response.group_percentage);
                $('#addGroupForm').attr('action', '/admin/update-group/' + groupId);
                $('#submitButton').text('Update Group');
                if ($('#addGroupForm input[name="_method"]').length === 0) {
                    $('#addGroupForm').append('<input type="hidden" name="_method" value="PUT">');
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred while fetching the group details.');
            }
        });
    });
    
    $(document).on('click', '.set-default', function() {
        const groupId = $(this).data('id');
    
        $.ajax({
            url: '/admin/set-default-group/' + groupId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // alert(response.message);
                location.reload(); 
            }
        });
    });

</script>

@endsection
