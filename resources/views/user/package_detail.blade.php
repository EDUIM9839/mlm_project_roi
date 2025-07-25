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
                            <span class="text-muted fw-light">Dashboard /</span> Packages
                        </h4>

                        <!-- Scrollable -->
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <div style="padding: 25px; border:1px solid grey; margin: 25px 0 25px 0; border-radius:7px;">
                                        <form action="#" method="post">
                                            <div class="form-group">
                                                <label for="email">Package Name:</label>
                                                <input type="text" name="name" class="form-control" placeholder="Enter package name">
                                            </div>
                                            <div class="form-group" style="margin-top: 10px;">
                                                <label for="pwd">Package Cost (in dollar):</label>
                                                <input type="number" name="cost" class="form-control" placeholder="Enter package cost">
                                            </div>

                                            <input type="hidden" name="tbname" value="package">
                                            <input type="hidden" name="user_id" value="57">
                                            <input type="hidden" name="api_key" value="$2y$10$bI775ulbifwv0BkRg6WML.l69x2dcrKFaW8MaFojGhkDa9Dmzw61G">

                                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div>
                                                        
            <script>
            $(document).ready(function () {
                $("#myInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
        <div class="table-responsive table--no-card">
            <table id="order-table" class="table table-sm table-hover table-striped table-bordered">
                <thead><tr class="sticky-top">                   
                     <th></th>
                    <th></th>
                <th style="word-wrap: break-word;paddng:0px;pargin:0px;">Id</th>
                <th style="word-wrap: break-word;paddng:0px;pargin:0px;">Name</th>
                <th style="word-wrap: break-word;paddng:0px;pargin:0px;">Cost</th>
            </tr>
        </thead>
        <tbody>
                
         </tbody>
    <tfoot>
<tr>
    <th></th>
    <th></th>
    <th style="word-wrap: break-word;paddng:0px;pargin:0px;">Id</th>
    <th style="word-wrap: break-word;paddng:0px;pargin:0px;">Name</th>
    <th style="word-wrap: break-word;paddng:0px;pargin:0px;">Cost</th>
</tr>
</tfoot>
<tbody>                    
                
</tbody>
</table>
                </div>
            </div>
            <!--  -->
            <!--  -->
        <div class="modal fade" id="updatemodel" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Update data</h4>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div><div class="modal fade" id="deletemodel" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <p id="deleteinfo">Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>                            </div>
                        </div>
                        <!--/ Scrollable -->

                    </div>
            <!-- page end -->
           

         
          <!-- Footer -->
          <footer class="layout-navbar navbar-detached" style="top:auto; bottom: 0px!important;">
    <div style="display: flex; justify-content: space-around;">
        <div style="  display: flex;flex-direction: column; justify-content: center; align-items: center;">
            <a href="index.php" class="text-primary">
                <i class="bx bx-home-alt" style="font-size: 30px;"></i>
            </a>
            <a href="#" class="text-primary">
                Home
            </a>
        </div>
        <div style="display: flex;flex-direction: column; justify-content: center; align-items: center;">
            <a href="change-password.php" class="text-primary">
                <i class="bx bx-lock-open" style="font-size: 30px;"></i>
            </a>
            <a href="#" class="text-primary">
                Change Password
            </a>
        </div>
        <div style="  display: flex;flex-direction: column; justify-content: center; align-items: center;">
            <a href="profile.php" class="text-primary">
                <i class="bx bx-user" style="font-size: 30px;"></i>
            </a>
            <a href="#" class="text-primary">
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
