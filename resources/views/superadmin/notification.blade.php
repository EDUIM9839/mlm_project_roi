@extends('superadmin.layouts.main')
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
                            <li class="breadcrumb-item active" aria-current="page">Notification</li>
                        </ol>
                    </nav>
                </div>
                 
            </div>
            <!--end breadcrumb-->
             

                        <!-- Scrollable -->
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <div style="padding: 25px; border:1px solid grey; margin: 25px 0 25px 0; border-radius:7px;">
                                        <form action="{{route('update_notification')}}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="email">Description:</label>
                                                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                                                <input name="description" value="{{$nt->description}}" class="form-control" placeholder="Enter description" style="margin-top: 7px;">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Status:</label>
                                                 <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-note'></i></span>
                                                <select class="form-control" name="status" style="margin-top: 7px;">
                                                    <option value="active" selected="">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>

                                            <input type="hidden" name="id" value="1">

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



 
                    <!-- / Footer -->


                    <div class="content-backdrop fade"></div>
                </div>
            <!-- page end -->
        </div>
    </div>
@endsection
