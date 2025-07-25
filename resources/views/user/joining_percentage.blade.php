@extends('layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Joining Percentage</div>
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
            <div class="container-xxl flex-grow-1 container-p-y">

                        <h4 class="fw-bold py-3 mb-4">
                            <span class="text-muted fw-light">Dashboard /</span> Joining Percentage
                        </h4>

                        <!-- Scrollable -->
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <div style="padding: 25px; border:1px solid grey; margin: 25px 0 25px 0; border-radius:7px;">
                                        <form action="{{route('update_joining_percentage')}}" method="post">
@csrf
                                            <div class="form-group">
                                                <label for="star_percentage">Star Joining Percentage:</label>
                                                <input type="number" name="star_joining_pkg" class="form-control" value="{{$jp->star_joining_pkg}}" placeholder="Enter star joining percentage" style="margin-top: 7px;">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="joining_percentage">Normal Joining Percentage:</label>
                                                <input type="number" name="joining_percentage" class="form-control" value="{{$jp->joining_percentage}}" placeholder="Enter joining percentage" style="margin-top: 7px;">
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Status:</label>
                                                <select class="form-control" value="" name="status" style="margin-top: 7px;">
                                                    <option value="active" selected="">Active</option>
                                                    <option value="inactive" >Inactive</option>
                                                </select>
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
            <!--  -->
            <!-- footer -->
            <footer class="layout-navbar navbar-detached" style="top:auto; bottom: 0px!important;">
    <div style="display: flex; justify-content: space-around;">
        <div style="  display: flex;flex-direction: column; justify-content: center; align-items: center;">
            <a href="index.php" class="text-primary">
                <i class="bx bx-home-alt" style="font-size: 30px;"></i>
            </a>
            <a href="index.php" class="text-primary">
                Home
            </a>
        </div>
        <div style="display: flex;flex-direction: column; justify-content: center; align-items: center;">
            <a href="change-password.php" class="text-primary">
                <i class="bx bx-lock-open" style="font-size: 30px;"></i>
            </a>
            <a href="change-password.php" class="text-primary">
                Change Password
            </a>
        </div>
        <div style="  display: flex;flex-direction: column; justify-content: center; align-items: center;">
            <a href="profile.php" class="text-primary">
                <i class="bx bx-user" style="font-size: 30px;"></i>
            </a>
            <a href="profile.php" class="text-primary">
                Profile
            </a>
        </div>

    </div>

</footer>
        </div>
    </div>
@endsection
