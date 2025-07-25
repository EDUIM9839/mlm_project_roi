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
         @if (session()->has('success'))
                                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class='bx bxs-message-square-check'></i>
                                            </div>
                                            <div class="ms-3">
                                                 
                                                <div class="text-white">{!!session()->get('success')!!}</div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @elseif(session()->has('error'))
                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-white"><i class='bx bxs-message-square-check-x'></i>
                                        </div>
                                        <div class="ms-3">
                                            <div class="text-white">{!!session()->get('error')!!}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
          
            <div class="card">
                <form action="{{route('save_direct_income_setting')}}" method="post" >
					@csrf 
                <div class="card-body p-4">
                         @php
                                    $i = 1;
                                    
                                @endphp
                                
                    <h5 class="mb-4">Direct Income Setting</h5>
                        <div class="row mb-3">
                            <label for="input53" class="col-sm-3 col-form-label">Income Type</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class='bx bx-flag'></i></span>
                                     
                                    <select class="form-select" id="income_type" name='income_type'>
                                      
                                        <option value="{{$direct_income_data->income_type}}">{{$direct_income_data->income_type}}</option>
                                        <option value="Fixed">Fixed</option>
                                        <option value="Percentage">Percentage</option>
                                       
                                    </select>
                                     
                                  </div>
                            </div>
                        </div>
                        <div class="row mb-3" id='amount-div'>
                            <label for="input50" class="col-sm-3 col-form-label">Fixed Amount</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text"> 
                                        <i class="fadeIn animated bx bx-dollar-circle"></i>
                                    </span>
                                    <input type="text" name="fixed_amount" id="fixed_amount" value="{{$direct_income_data->fixed_amount}}" class="form-control" id="fixed_amount" placeholder="Enter Fixed Amount">
                                  </div>
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <label for="input51" class="col-sm-3 col-form-label">Percentage</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                    <input type="text" class="form-control" id="input51" placeholder="Enter Percentage ">
                                  </div>
                            </div>
                        </div> --}}
                        
                         
                                         
            
                        
                        @if($direct_income_data->status == '1')  
                    <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                     <div class="input-group"> 
                                    <label class="switch">
                                        <input type="checkbox" name="status" value="1" checked>
                                        <span class="slider round"></span>
                                    </label> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span style="text-transform:uppercase; font-size:20px; "></span> 
                                  </div> 
                                </div>
                            </div>
                        </div>
                        @elseif($direct_income_data->status == '0')
                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                     <div class="input-group">  
                                    <label class="switch">
                                        <input type="checkbox" name="status" value="0">
                                        <span class="slider round"></span>
                                    </label> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span style="text-transform:uppercase; font-size:20px; "></span> 
                                  </div> 
                                </div>
                            </div>
                        </div>
                        @endif
                        <br>
                       
                        
                      <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="Submit" class="btn btn-primary px-4">Submit</button>
                                    <button type="button" class="btn btn-light px-4">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    </form>
                </div>  
        </div>
    </div>
    <style>
     .ha {
    position: relative;
   
    left: 50%;
}
    </style>
    <!--end page wrapper --> 
<script> 
$(document).ready(function(){ 
    $('#income-type').change(function(){ 
        let income_type=$(this).val();
        if(income_type=='fixed'){
            $('#amount-div').html("<label for='input50' class='col-sm-3 col-form-label'>Fixed Amount</label><div class='col-sm-9'><div class='input-group'><span class='input-group-text'> <i class='fadeIn animated bx bx-dollar-circle'></i></span><input type='text' class='form-control' id='input50' placeholder='Enter Fixed Amount'></div></div>");
 }else{
            $('#amount-div').html("<label for='input50' class='col-sm-3 col-form-label'>Percentage</label><div class='col-sm-9'><div class='input-group'><span class='input-group-text'> <i class='fadeIn animated bx bx-dollar-circle'></i></span><input type='text' class='form-control' id='input50' placeholder='Enter Percentage'></div></div>");
  }

       // alert(test); 
    });
});
</script> 
     <script>
       $(document).ready(function(){
          $("#d").DataTable() 
       });
       $(function(){
           $('.toggle-class').change(function(){
           var status = $(this).prop('checked') == true ? 1 :0;
           var id = $(this).data('id');
           console.log(id);
           $.ajax({
          type: "GET",
          dataType: "json",
          url: '/changeStatuses',
          data: {'status': status, 'id': id},
          success: function(data){
            console.log(data.success)
          }
       });
       });
    </script>
@endsection
