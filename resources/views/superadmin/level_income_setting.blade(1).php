@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')

<style>
    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
								<li class="breadcrumb-item"><a href="{{route('superadmin-dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page"><b>{{$title}}</b></li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<hr>

				<div class="row">
				    
                    <div class="col-lg-8 mx-auto">
                        
						<div class="card">
						
							<div class="card-body p-4">
							<div class='row'>
                            <div class='col-md-5'>
								<select class="form-select" id="input1" onchange='getvalue1(this.value)'  name="getlevel1">
									<option value=''>--Select Type--</option>
									<option value="flat">Flat</option>
									<option value="percentage">Percentage</option>
								  </select>
								  <small id='input1_error' style='color:red'></small>
								  <input type='hidden' name='ddtype' id='ddtype' >
                                </div>
                                <div class='col-md-5'>
									<select class="form-select" id="input2" onchange='getvalue2(this.value)' name="getlevel2">
										<option value=''>--Select Level--</option>
									     <?php for($i=1;$i<=10;$i++){?>
									     <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } ?>
									  </select>
									   <small id='input2_error' style='color:red'></small>
                                </div>
                            <div class='col-md-2'><button class='btn btn-success' id='addto' style='float:right'>+ ADD</button></div>
                         </div>
							<div class="row mt-3">
							    <div class='col-md-12' id='levels' style='display:none'>
							      <div class='row'><div class='col-md-6 mt-3 mb-3' >
							      <label>Level</label>
							    </div>
							    <div class='col-md-6 mt-3 mb-3'><label>Discount Type</label></div></div></div>
							    <div id='append_field'>
							    
							   </div>
							 <div style='display:none' id='submitbtn'><a style='float:right' onclick='Submitlevel()' class='btn btn-success'>Submit</a>	</div>
							</div>
							</div>
						</div>
					</div>
					
					<div class="card">
					<div class="card-body">
						<div class="table">
							<div id="example_wrapper"><div class="row"><div class="col-sm-12"><table  class="table table-striped table-bordered" style="width: 100%;" role="grid" aria-describedby="example_info">
								<thead>
									<tr role="row">
									    <th>S No.</th>
									    <th>Level</th>
									    <th>Income Type</th>
									    <th>Action</th>
									</tr>
								</thead>
								<tbody>
								@php
								 $level=DB::table('levels')->get();
								 $i=1;
								@endphp
								@foreach($level as $row)	
								    <tr role="row" class="even">
										<td class="sorting_1">{{$i++}}</td>
										<td>{{$row->level_no}}</td>
										<td>{{$row->type}}</td>
										<?php  $check_rows=DB::table('levels')->orderBy('id', 'DESC')->get(); if($check_rows['0']->id==$row->id){     ?>
									    <td><a href="{{route('delete_level_no', ['id'=>$row->id])}}" class="ms-3" ><i class="bx bxs-trash"></i></a></td>
									    <?php } else{ ?>
									    <td><a href="javascript:void(0)" class="ms-3" ><i class="bx bxs-trash"></i></a></td>
									    <?php } ?>
									</tr>
								@endforeach
								</tbody>
							
							</table></div></div></div>
						</div>
					</div>
				</div>
				</div><!--end row-->

			</div>
		</div>
    <!--end page wrapper -->
<?php
      $levelss=DB::table('levels')->orderBy('id', 'desc')->limit(1)->get();
     
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

  $("#addto").click(function(){
      
       var input1=$("#input1").val();
       var input2=$("#input2").val();
       var html="";
       if(input1==''){
          $("#input1_error").text('Level field must be required.');
       }else if(input2==''){
           $("#input2_error").text('Discount type field must be required.'); 
       }else{
           $("#levels").css('display', 'block');
           $("#submitbtn").css('display', 'block');
           for (let i = 1; i<=input2; i++) {
                    html+="<div class='row'><div class='col-md-12'><div class='row'><div class='col-md-6 mt-1 mb-1' ><input type='text' value='"+i+"' name='level[]'   class='form-control level' ></div><div class='col-md-6 mt-1 mb-1'><input type='text'  value='"+input1+"' class='form-control type' name='dtype[]'  ></div></div></div></div>";
           }
           $("#append_field").html(html);
       }
       
  });

    function Submitlevel(){
              
              var ddtype=$("#ddtype").val();
              var type="{{$levelss['0']->type}}";
             
              if(type==ddtype){
              
              var levels = $('input[name="level[]"]').map(function(){ 
                    return this.value; 
                }).get();
                var dtypes = $('input[name="dtype[]"]').map(function(){ 
                    return this.value; 
                }).get();
                  
               
                 $.ajax({
                    type: 'POST',
                    url: '{{route("uploadlevel")}}',
                    data: {'level[]': levels,'dtype[]': dtypes, "_token":"{{csrf_token()}}"},
                    success: function(data) {
                         if(data=='1'){
                            window.location.href = "https://mlmlaravel.swasoftech.in/super-admin/level_income_setting";
                         }else if(data=='0'){
                               alert('0');
                         }
                    }
                });
              }
              else{
                 $("#input1_error").text('Discount type not matched.');    
              }
      }
 function getvalue1(value){
  
     if(value!=""){
        $("#input1_error").text('');  
         $("#ddtype").val(value);  
     }
 }  
 
 function getvalue2(value){
     if(value!=""){
        $("#input2_error").text('');  
     }
 }  
</script>


@endsection
