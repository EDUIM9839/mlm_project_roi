@extends('admin.layouts.main')
@section('pageTitle', 'Rewards')
@section('mains')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
#label{
        font-weight:500;
    }
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 4px;
}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  background-color: white;
  color: black;
}
td,th,tr,tbody{
text-align:center;
}
#edit{
    /* text-align:left !important; */
    width: 20% !important;
}

.pen body {
	padding-top:50px;
}

/* MODAL FADE LEFT RIGHT BOTTOM */

.modal.fade:not(.in).right .modal-dialog {
	-webkit-transform: translate3d(25%, 0, 0);
	transform: translate3d(25%, 0, 0);
}
.modal.fade:not(.in).bottom .modal-dialog {
	-webkit-transform: translate3d(0, 25%, 0);
	transform: translate3d(0, 25%, 0);
}

.modal.right .modal-dialog {
	position:absolute;
	top:0;
	right:0;
	margin:0;
}

.modal-content, .modal.right .modal-content {
	min-height:50vh;
	border:0;
}
.btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    border-radius: 35px;
    font-size: 24px;
    line-height: 1.33;
}

.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}

</style>

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Rewards</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
             <!-- nav -->
             
             <div class="row">
    <div class="col-xl-12">
        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('plan_setting')}}" id="commission">
                    <span class=""><i class="fas fa-percent"></i></span>
                    <span class="">Plan Setting</span>
                </a>
            </li>
            
            
                        <li class="nav-item ">
                <a class="nav-link " href="{{route('payout')}}" role="tab" id="payout">
                    <span class=""><i class="fas fa-chart-line"></i></span>
                    <span class="">Payout</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('payment')}}" role="tab" id="payment">
                    <span class=""><i class="far fa-money-bill-alt"></i></span>
                    <span class="">Payment</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " href="{{route('sign_up')}}" role="tab" id="signup">
                    <span class=""><i class="far fa-user-circle"></i></span>
                    <span class="">Signup</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  " href="{{route('mail_config')}}" role="tab" id="mail">
                    <span class=""><i class="far fa-envelope"></i></span>
                    <span class="">Mail</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('sms_config')}}" role="tab" id="api">
                    <span class=""><i class="fas fa-key"></i></span>
                    <span class="">SMS Module</span>
                </a>
            </li>
                    </ul>
    </div>
</div>
&nbsp;
            <!-- nav end -->
            <!-- page start -->
            <div class="card">
 <div class="card-body p-4">
 <div class="form-body ">
 <div class="row"> <div class="col-md-12"><?php echo Session::get('msg'); ?></div></div>
 <form action="{{route('store_commission')}}" method="POST" enctype="multipart/form-data">
 @csrf
 <!-- <h6 class="card-title pb-2"> Rank Commission</h6> -->
 <!-- <hr/> -->
 <div class="border p-4 rounded">
 
        <div class="col-md-12">
            <label for="inputLastName1" class="form-label">Rank Calculation Period</label>
                <input type="hidden" class="form-control" style="border-color:#afa7a7;" 
                    value="" name="commission_calc" id="commission_calc">
            <div class="input-group">
                <div class="form-group col-md-12">
                        <select  id="commission-dropdown" name="commission_calc" class="form-control">
                            <option value="">-- Select --</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                            <option value="instant">Instant</option>
                        </select>
                </div>
            </div>
        </div>
            <button name="submit" type="submit" class="btn btn-info">Save</button>
 
 <div align="right" class="btn-container justify-content-end mt-2">
 <!-- <button type="button" data-target="#add_rank" data-id="#add_rank" href="#add_rank" class="btn btn-outline-info">Add Rank &nbsp;+</button> -->

 <a  data-id="#add_rank" data-target="#add_rank" data-toggle="modal"  class="btn btn-outline-info">Add Rank &nbsp;+</a>

</div>
</div>
</form>
</div>
</div>
 </div>
 <!-- page end -->
 <!-- Gif start -->
 <div class="container">
 <!-- <div align="center">
<a href="{{route('rank_achivers')}}"> <img src="../assets/images/rank_achivers.gif" width="250px" height="38px" style="align:right"></a>
</div> -->

</div>
<!-- Gif end -->
 <!-- Rank Table -->
 <div class="card">
 <div class="card-body p-4">
    <table id="customers">
        <tbody>
            <tr>
                <th>
                    Sr.No
                </th>
                <th>
                    Rank Name
                </th>
                <th>
                    Target
                </th>
                <th>
                    Percentage
                </th>
                <th>
                    Medals
                </th>
                <th>
                    Edit
                </th>
            </tr>
           
        </tbody>
    </table>
</div>
</div>

<!-- Rank Achivers -->
<div class="" align="center">
    <h5 style="color:red"> &nbsp; View Rank Achivers List <a href="{{route('rank_achivers')}}" style="color:red"  &nbsp;>>>></a></h5>
</div>

<!-- Rank Achivers -->
 <!-- Rank Table end -->
        </div>
    </div>
   <!--  -->
   <!-- Modal Add Rank -->
   <div class="modal fade center" id="add_rank" tabindex="-1" role="dialog">
<div class="modal-dialog modal-sm-9" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" style="margin-left:30%;">Add New Rank</h4>
<button type="button" data-dismiss="modal" class="btn btn-danger btn-circle"><i class="bx bx-times"></i>X&nbsp;</button>
</div>
<div class="modal-body">
<form action="{{route('rank_store')}}"  method="POST" enctype="multipart/form-data">
 @csrf
 
 <div class="border p-4 rounded">
 <div class="col-md-12">
 <label for="inputLastName1" class="form-label" id="label">Rank Name</label>
 <div class="input-group">
 <input type="text" class="form-control " name="name"
 value="" id="name"
 placeholder=" Enter Rank Name" />
 </div>
 </div>
 <div class="col-md-12">
 <label for="inputLastName1" class="form-label" id="label">Target</label>
 <div class="input-group">
 <input type="text" class="form-control " name="target"
 value="" id="target"
 placeholder=" Enter Target"/>
 </div>
 </div>
 <div class="col-md-12">
 <label for="inputLastName1" class="form-label" id="label">Percentage</label>
 <div class="input-group">
 <input type="text" class="form-control " name="percent"
 value="" id="percentage"
 placeholder=" Enter Percentage" />
 </div>
 </div>
 <div class="col-md-12">
 <label for="inputLastName1" class="form-label" id="label">Upload Icon</label>
 <div class="input-group">
 <input type="file" class="form-control " name="rank_image"
  id="rank_image" />
 </div>
 </div>
<div align="center">
 <button type="submit" class="btn btn-info" style="margin-top:10px">Save</button>
</div>
 </div>
</form>
</div>
<!-- modal body end -->
</div>
<!-- modal content end -->
</div>
<!-- modal dialog sm end -->
</div>
<!-- modal fade end -->
   <!-- Modal End Rank -->
        
   <!-- Edit Rank Modal  -->
 <div class="modal fade center" id="sidebar-right" tabindex="-1" role="dialog">
<div class="modal-dialog modal-sm-9" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" style="margin-left:30%;">Edit Rank</h4>
<button type="button" data-dismiss="modal" class="btn btn-danger btn-circle"><i class="bx bx-times"></i>X&nbsp;</button>
</div>
<div class="modal-body">
<form action="{{route('update_rank')}}" method="POST" enctype="multipart/form-data">
 @csrf
 <input type="hidden"  name="id" id="editid"/>
 <input type="hidden" class="form-control" style="border-color:#afa7a7;" 
 value="<?php if(!empty($data['0']->id)){?>{{ $data['0']->rank_image }}<?php } ?>" name="rank_oldimage"  id="rank_oldimage">
 <div class="border p-4 rounded">
 <div class="col-md-12" align="center">
    <label for='myfile'><img src=" " id="icons" name="rank_image" style="height: 60px;width:70px; border-style:outset">
</label>

<input type="file" hidden id='myfile' class="form-control" name="rank_image">
</div>
 <div class="col-md-12">
 <label for="name" class="form-label" id="label">Rank Name</label>
 <div class="input-group">
 <input type="text" class="form-control" name="name"
   id="names" placeholder=" Enter Rank Name"/>
 </div>
 </div>
 <div class="col-md-12">
 <label for="target" class="form-label" id="label">Target</label>
 <div class="input-group">
 <input type="text" class="form-control " name="target"
   id="targets" placeholder="Enter Target"/>
 </div>
 </div>
 <div class="col-md-12">
 <label for="percent" class="form-label" id="label">Percentage</label>
 <div class="input-group">
 <input type="text" class="form-control " name="percent"
  id="percents"
 placeholder=" Enter Percentage" />
 </div>
 </div>
 <div align="center">
 <button type="submit" class="btn btn-info" style="margin-top:10px">Save</button>
</div>
 <!-- <button type="submit" class="btn btn-info" style="margin-top:10px">Save</button> -->
 </div>
</form>
</div>
<!-- modal body end -->
</div>
<!-- modal content end -->
</div>
<!-- modal dialog sm end -->
</div>
<!-- modal fade end -->
<!-- End Modal Rank -->


<!--  -->

<!--  -->
<script>
    $ (document).ready (function () {
	$ (".modal a").not (".dropdown-toggle").on ("click", function () {
		$ (".modal").modal ("hide");
	});
});

function geteditid(id){
  
    $("#editid").val(id);

                $.ajax({
                    url : '{{URL::route("getEditData")}}',
                    data: {"editid":id,   "_token": "{{ csrf_token() }}"},
                    type: "POST",
                    success : function(response) {
                       
                       var obj=JSON.parse(response);
                     
                       $("#names").val(obj.name);
                       $("#targets").val(obj.target);
                       $("#percents").val(obj.percent);
                       $("#rank_oldimage").val(obj.rank_image);
                       var imgPath='{{asset('assets/rankImages/')}}'+"/"+obj.rank_image; 
                     
                       $("#icons").attr('src',imgPath);
                   }
                 });
}
    </script>

    <!--  -->
@endsection
