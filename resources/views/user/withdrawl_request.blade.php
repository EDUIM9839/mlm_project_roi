@extends('layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Withdrawl Request</div>
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
            

            <!-- Scrollable -->
            <div class="content-wrapper">

          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">


            <h4 class="fw-bold py-3 mb-4">
              <span class="text-muted fw-light">Dashboard /</span> Withdrawl Request
            </h4>

            <!-- Scrollable -->
            <div class="card">
              <h5 class="card-header "></h5>

              <div class="table-responsive text-nowrap">
                <table id="withdrawal_request" class="table display nowrap dataTable" style="width:100%">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>User</th>
                      <th>User ID</th>
                      <th>Amount</th>
                      <th>Admin Charge</th>
                      <th>Net Amount</th>
                      
                      <th>Payable Amount</th>
                      <!--<th>Wallet type</th>-->
                      
                      
                      <th>Pay IN</th>
                      <th>Description</th>
                      <th>Date</th>
                      <th>Status</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>1</td>
                        <td>PATEL</td>
                        <td>AP90554</td>
                        <td>44</td>
                         <td>4.4</td>
                          <td>39.6</td>
                           <td>19.8</td>
                        <!--<td></td>-->
                        <td>Tron: TMJ5dLcSYroSgzVeh4ZwdPHrtXG4E8LRUL </td>
                        <td>Pp</td>
                        <td>2023-11-09 18:10:25</td>
                        <td>
                          <!-- Button trigger modal -->
                        <span class="badge  bg-success">Paid</span>
                        </td>
                        <td><a href="# &amp;tbname=withdrawl_request"><button class="btn btn-warning">Delete</button></a></td>
                      </tr>
                    </tbody>
                </table>
              </div>
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
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->

        </div>
            <!--  -->
        </div>
    </div>      
@endsection
