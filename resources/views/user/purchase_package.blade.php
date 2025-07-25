@extends('layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Income Booster</div>
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
            <!-- page start -->
            <div class="content-wrapper">

          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">


            <h4 class="fw-bold py-3 mb-4">
              <span class="text-muted fw-light">Dashboard /</span> Purchased Packages
            </h4>

            <!-- Scrollable -->
            <div class="card" style="padding:20px">
              <div class="table-responsive text-nowrap">
                <table id="example" class="table table-striped dataTable">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>User</th>
                      <th>User ID</th>
                      <th>Package</th>
                      <th>Payment Type</th>
                      <th>Image</th>
                      <th>Date</th>
                      <th>Status</th>

                    </tr>
                  </thead>
                    <tbody>
                                          <tr>
                        <td>1</td>
                        <td>Bharat </td>
                        <td>AP49364</td>
                        <td>Silver $60</td>
                        <td>wallet</td>
                        <td><a href="#"><img src="" alt="" style="height:50px;"></a></td>
                        <td>2023-09-18 16:45:41</td>

                        <td><button class="btn btn-warning">Disapprove</button></td>
                        <td><a href="#?id=1&amp;tbname="><button class="btn btn-warning">Delete</button></a></td>
                      </tr>
                    </tbody>
</table>
</div>
</div>

            <!-- page end -->
           
           

         
          <!-- Footer -->
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

</footer>̵
          <!-- / Footer -->


          <div class="content-backdrop fade"></div>
        </div>
            <!--  -->
        </div>
    </div>      
@endsection
