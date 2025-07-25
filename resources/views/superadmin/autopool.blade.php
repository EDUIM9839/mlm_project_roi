@extends('superadmin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Autopool</div>
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
        <span class="text-muted fw-light">Dashboard /</span> Autopool
    </h4>

    <!-- Scrollable -->
    <div class="card">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div style="padding: 25px; border:1px solid grey; margin: 25px 0 25px 0; border-radius:7px;">
                    <form action="#" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Level No.:</label>
                            <input type="number" name="level_no" class="form-control" placeholder="Enter level no">
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label for="pwd">Percentage:</label>
                            <input type="text" name="percent" class="form-control" placeholder="Enter percentage">
                        </div>
                        
                        <div class="form-group" style="margin-top: 10px;">
                            <label for="pwd">Star Joining Percentage:</label>
                            <input type="text" name="star_percent_data" class="form-control" placeholder="Enter star percentage">
                        </div>

                        <!-- <input type="hidden" name="tbname" value="levels">
                        <input type="hidden" name="user_id" value="57">
                        <input type="hidden" name="api_key" value="$2y$10$bI775ulbifwv0BkRg6WML.l69x2dcrKFaW8MaFojGhkDa9Dmzw61G"> -->

                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
        <div>
                                    

<div class="table-responsive table-no-card">
<table id="order-table" class="table table-sm table-hover table-striped table-bordered">
<thead>
<tr class="sticky-top">                    
<th style="word-wrap: break-word;paddng:0px;margin:0px;">Save</th>
<th style="word-wrap: break-word;paddng:0px;margin:0px;">Delete</th>
<th style="word-wrap: break-word;paddng:0px;margin:0px;">Id</th>
<th style="word-wrap: break-word;paddng:0px;margin:0px;">Level&nbsp;no</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Bronze&nbsp;percent&nbsp;data</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Silver&nbsp;percent&nbsp;data</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Gold&nbsp;percent&nbsp;data</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Platinum&nbsp;percent&nbsp;data</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Ruby&nbsp;percent&nbsp;data</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Diamond&nbsp;percent&nbsp;data</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Kohinoor&nbsp;percent&nbsp;data</th>
</tr>
</thead>
<!--  -->
<tfoot>
<tr>
<th style="word-wrap: break-word;paddng:0px;margin:0px;">Save</th>
 <th style="word-wrap: break-word;paddng:0px;margin:0px;">Delete</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">&nbsp;Id&nbsp;</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Level&nbsp;no</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Bronze&nbsp;percent&nbsp;data</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Silver&nbsp;percent&nbsp;data</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Gold&nbsp;percent&nbsp;data</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Platinum&nbsp;percent&nbsp;data</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Ruby&nbsp;percent&nbsp;data</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Diamond&nbsp;percent&nbsp;data</th>
<th style="word-wrap: break-word;paddng:0px;pargin:0px;">Kohinoor&nbsp;percent&nbsp;data</th>
</tr>
</tfoot>
<tbody>  
    <tr>  
<td><button type="submit" class="btn btn-success btn-sm"> Save</button></td>
<td><a type="button" class="btn btn-outline-success btn-sm" onclick="return confirm('Delete this record?')" href="#?id=20&amp;table_name=levels">
<i class="bx bx-trash-alt"></i></a>
</td>                
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="20" readonly="">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="20">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="0.25">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="0.5" readonly="">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="1" readonly="">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="2" readonly="">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="4" readonly="">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="8" readonly="">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="16" readonly="">
</td>
</tr>
<tr>
<td><button type="submit" class="btn btn-success btn-sm"> Save</button></td>
<td><a type="button" class="btn btn-outline-success btn-sm" onclick="return confirm('Delete this record?')" href="#?id=20&amp;table_name=levels">
<i class="bx bx-trash-alt"></i></a>
</td>                
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="19" readonly="">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="19">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="0.25">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="0.5" readonly="">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="1" readonly="">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="2" readonly="">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="4" readonly="">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="8" readonly="">
</td>
<td class="id" style="width:20px;">
<input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" name="id" type="text" value="16" readonly="">
</td> 
</tr>

</tbody>
</table>
</div>
</div>
 

    <!--/ Scrollable -->

</div>
            <!-- -->
        </div>
    </div>
@endsection
