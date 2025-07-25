@extends('layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
           <h6 class="mb-0 text-uppercase alert  "> P to p transefers</h6>
         <hr/>
            <!--end breadcrumb-->
            <!--  -->
            <div class="card">
<div class="card-body d-flex" style="justify-content: center;">
     <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="fw-bold py-3 mb-4">
                    <span class="text-muted fw-light"></span>
                 </h4>
                 
                <form action="" method="" enctype="multipart/form-data">
                   
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Amount</label>
    <input type="number" class="form-control" name="amount" id="defaultFormControlInput" placeholder="0.0">
</div>

<div>
    <label for="defaultFormControlInput" class="form-label">Pay To USER ID</label><span class="useridlabel"></span>
    <input type="text" onkeyup="getUser()" onchange="getUser()" class="form-control" name="receiver_id">
</div>

<div>
    <label for="defaultFormControlInput" class="form-label">Password</label><span class="useridlabel"></span>
    <input type="password"  class="form-control" name="password">
</div>


<div>
    <label for="defaultFormControlInput" class="form-label">Description</label>
    <textarea name="description" class="form-control"></textarea>
</div>
<script>
                                                           
 //    Js Code here
</script>
                                                        
<div>
    <button type="submit" class="btn btn-primary my-3">Transefer</button>
</div>

</form>
    </div>
</div>
        </div>
                                        
                                        
    </div>
</div>
<!--  -->
<!--Table start -->
<div class="card" style="margin-top:20px; magin-bottom:50px;">
<div class="card-body">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>S.No.</th>
                    <th>Sender ID</th>
                    <th>Receiver ID</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                

                </tbody>
                </table>
            </div>
         </div>
    </div>
</div>
            <!-- table end -->
            <!-- footer -->
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

</footer>
        </div>
    </div>
@endsection
