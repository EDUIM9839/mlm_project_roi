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
                            <li class="breadcrumb-item active" aria-current="page">Block User</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div  class="card">
                <div class="card-body p-4">
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
                    <div class="form-body ">
                        <form action="{{ route('blockUser') }}" method="POST" enctype="multipart/form-data"id="target">
                            @csrf
							<h6 style="color:green">Block Users</h6>
							<hr/>
					        <div class="border p-4 rounded">
						        <div class="row g-6">
                                    <div class="col-md-12">
                                        <label for="inputConfirmPassword" class="form-label">User ID</label>
                                        <input type="hidden" class="form-control" name="user_status" value="block">
                                        <div class="input-group">
                                            <input type="test" class="form-control" name="user_id" id="user_id" placeholder="BULL000">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success my-3" id="btnx">Block</button>
                                </div>
    					    </div>
				        </form>
					</div>
				</div>
                <div class="table-responsive text-nowrap">
                    <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                        <h4>Blocked User List</h4>
                        <hr>
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>UserId</th>
                                    <th>User Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($blockUser as $user)
                                <tr> 
                                    <td>{{$i++}}</td>
                                    <td>{{$user->userid}}</td>
                                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                                    <td>{{$user->user_status}}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        <!--<button class="btn btn-danger" onclick="openStatusModel(1, 'block')">Unblock</button>-->
                                        <!-- Unblock Button -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" data-userid="{{$user->userid}}">Unblock</button>
                                        <!-- Modal -->
                                        <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                            <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Unblock User</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                              <div class="modal-body">
                                <!-- Form for User Unblock -->
                                <form action="{{ route('blockUser') }}" method="POST">
                                  @csrf
                                  <div class="col-md-12">
                                    <label for="inputConfirmPassword" class="form-label">User ID</label>
                                    <input type="hidden" name="user_status" value="unblock">
                                    <div class="input-group">
                                      <input type="text" class="form-control" name="user_id" id="user_id" placeholder="BULL000">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <!-- Submit Button to Unblock -->
                                    <button type="submit" class="btn btn-danger">Unblock</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>



                    </td>
                
                </tr>
                @endforeach
            </tbody>
        </table>
                
            </div>
            <!--/ Scrollable -->

          </div>
                </div>
            </div>
                                    
            <!-- Scrollable -->
           
       </div>
       </div>
    
    <!-- Bootstrap CSS -->
<!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">-->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // When the unblock button is clicked
        $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var userId = button.data('userid'); // Extract the user_id from the data-userid attribute
    
            // Set the value of the input field to the user_id
            var modal = $(this);
            modal.find('#user_id').val(userId);
        });
    </script>
@endsection
