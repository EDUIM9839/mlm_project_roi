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
            <!--  -->
            <div class="content-wrapper">

          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">


            <h4 class="fw-bold py-3 mb-4">
              <span class="text-muted fw-light">Dashboard /</span> Income Booster
            </h4>

            <!-- Scrollable -->
            <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width: 46.9844px;">Id</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 76.1562px;">User</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 209.875px;">Amount</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Income Type: activate to sort column ascending" style="width: 144.797px;">Left User</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Transaction type: activate to sort column ascending" style="width: 165.172px;">Right User</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Date</th>
                </tr>
                    </thead>
             <tbody>

             </tbody>
                        </table>
                
            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->




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
