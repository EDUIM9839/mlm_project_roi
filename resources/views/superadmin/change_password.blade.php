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
                            <li class="breadcrumb-item active" aria-current="page"> Change Password</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->
         
            <!-- page start -->
            
    <!-- Scrollable -->
    <div class="card">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div style="padding: 25px; border:1px solid grey; margin: 25px 0 25px 0; border-radius:7px;">
                    
                    
                    
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
                    
                    
                    
                    
                    <form action="{{route('change_password')}}" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="email">User ID:</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                            <input type="text" name="user_id" class="form-control" Required>
                        </div>

                        <div class="form-group">
                            <label for="email">Password:</label>
                            <input type="password" name="password" class="form-control" Required>
                            <span color="red">Minimum 6 character</span>
                        </div>

                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;" name="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
    <!--/ Scrollable -->

</div>
<!-- / Content -->




<div class="content-backdrop fade"></div>
</div>
            <!-- page end -->
        </div>
    </div>
@endsection
