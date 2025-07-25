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
                            <li class="breadcrumb-item active" aria-current="page">Group User</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class='col-md-6'>
                        <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{ route('add-group') }}" class='badge bg-info'>Add Group</a></h6>
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
                            <form action="{{ route('assignGroup') }}" method="POST" enctype="multipart/form-data" id="target">
                                @csrf
                                <div class="border p-4 rounded">
                                    <div class="mb-3">
                                        <label for="receiver_id" class="form-label">User Id</label>
                                        <span class="useridlabel" style="color:green"></span>
                                        <span class="useriderror" style="color:red"></span>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent"><i class="lni lni-user"></i></span>
                                            <input type="text" name="user_id" onkeyup="getUser()" class="form-control text-uppercase" placeholder="ENTER USERID" id="receiver_id" value="{{ old('user_id') }}" required >
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        @php
                                            $groups = DB::table('groups')->get();
                                        @endphp
                                        <label for="group_select" class="form-label">Select Group</label>
                                        <select class="form-control" id="group_select" name="group_id" required>
                                            <option value="">Select Group</option>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id }}" {{ isset($userGroup) && $userGroup->group_id == $group->id ? 'selected' : '' }}>
                                                    {{ $group->group_name }} ({{ $group->group_percentage }}%)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success my-3" id="btnx">Set Percentage</button>
                                    </div>
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
                                    <th>User Id</th>
                                    <th>Group Name</th>
                                    <th>Group Percentage</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                           <tbody>
                               @foreach($userGroups as $index => $userGroup)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $userGroup->user_id }}</td>
                                    <td>{{ $userGroup->group_name }}</td>
                                    <td>{{ $userGroup->group_percentage }}%</td>
                                    <td>
                                        <button class="btn btn-warning edit-btn" data-id="{{ $userGroup->id }}">Edit</button>
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
    function getUser() {
        $("#btnx").attr("disabled", "disabled");
        $(".useriderror").empty();
        $(".useridlabel").empty();
        var userid = $("#receiver_id").val();

        $.ajax({
            url: "{{ route('checkUser') }}", 
            type: "POST",
            data: {
                user_id: userid,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                if (result.error) {
                    $(".useridlabel").html('<b class="text text-danger">' + result.error + '</b>');
                } else {
                    $(".useridlabel").html('<b class="text text-success">' + result.user.first_name + " " + result.user.last_name + '</b>');
                    $("#btnx").removeAttr("disabled");
                }
            }
        });
    }

     $(document).on('click', '.edit-btn', function() {
        var userGroupId = $(this).data('id'); 
        var userId = $(this).data('user_id');
        $.ajax({
            url: "/admin/get-user-group-details/" + userGroupId,
            method: 'GET',
            success: function(response) {
                $('#receiver_id').val(response.user_id);
                $("#receiver_id").attr("disabled", "disabled");
                $('#group_select').val(response.group_id); 
                $('#target').attr('action', '/admin/update-user-group/' + userGroupId);
                $('#btnx').text('Update Percentage'); 
            }
        });
    });
</script>

@endsection
