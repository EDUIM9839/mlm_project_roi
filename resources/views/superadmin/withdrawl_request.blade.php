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
                            <li class="breadcrumb-item active" aria-current="page">Withdrawl Request</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class='col-md-6'>
                       <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{route('add-product')}}" class='badge bg-info'>Add Product</a></h6>
                </div>
                </div>
            </div>
            <!--end breadcrumb-->
            
          
            <!-- Scrollable -->
            <div class="card">
              <h class="card-header "> 

              <div class="table-responsive text-nowrap">
                <table id="withdrawal_request" class="table display nowrap dataTable" style="width:100%">
                  <thead>
                    <tr class="table-dark">
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
 <th>Action</th>
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
                        <td>2023-Nov-09 18:10:25</td>
                        <td>
                          <!-- Button trigger modal -->
                        <span class="badge  bg-success">Paid</span>
                        </td>
                        <td><a href="# &amp;tbname=withdrawl_request"><button class="btn btn-danger">Delete</button></a></td>
                      </tr>
                    </tbody>
                </table>
              </div>
            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->






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
