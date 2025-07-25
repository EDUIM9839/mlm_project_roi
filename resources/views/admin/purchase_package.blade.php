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
                            <li class="breadcrumb-item active" aria-current="page">Purchased Packages</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->
            <!-- page start -->
            <div class="content-wrapper">

          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">

 

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
                        <td>2023-Nov-18 16:45:41</td>

                        <td><button class="btn btn-warning">Disapprove</button></td>
                        <td><a href="#?id=1&amp;tbname="><button class="btn btn-warning">Delete</button></a></td>
                      </tr>
                    </tbody>
</table>
</div>
</div>

            <!-- page end -->
           
           



          <div class="content-backdrop fade"></div>
        </div>
            <!--  -->
        </div>
    </div>      
@endsection
