@extends('superadmin.layouts.main')
@section('pageTitle', 'Level')
@section('mains')
  

<style>
        .swa {
    background: linear-gradient( 45deg , #200d3ac2, #473946ab)!important;
}
        .swaso{
           background: linear-gradient( to right, #f37335, #f37335 )!important;
               background: linear-gradient( to right, #ab609e, #ab609e )!important;
               background: linear-gradient( to right, #40243b, #40243b )!important;
               background: linear-gradient( to right, #000000,#000000 )!important;
        }
        .input-group-text {
    margin-bottom: 0;
}
</style>
 
    
    
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Level</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User List</li>
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
                   

<div class="row">
        <div class="col-md-6">
            <div class="card radius-10">
              
                <div class="card-body">
                    <div class="table-responsive">
                        <!--<table  class="table table-striped table-bordered" style="width:100%">-->
                          <form action="{{route('store_level')}}" method="POST">
                @csrf 
                <div class="border p-4 rounded">
                              <label for="inputLastName1" class="form-label">Type of commission</label>
                       
 <div class="form-group col-md-12">
      <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                        <select  id="commission-dropdown"  name="commission" value="{{$data[0]->commission}}" class="form-control" onchange="changevalue(this.value)">
                            <option value="">-- Select Commission --</option>
                            <option value="flat">Flat</option>
                            <option value="percentage">Percentage</option>
                        </select>
                    </div>
  </div>
 
  <div class="form-group col-md-12">
    <label for="inputLastName1" class="form-label">Commission Criteria</label>
     <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>

 <input type="text" class="form-control " value="{{$data[0]->commission_criteria}}" name="commission_criteria"
 value="" id="commission_criteria"
 placeholder="Enter Commission Criteria"/>
    </div>
    </div><br>
    
   <div class="form-group col-md-12">
<div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-coin'></i></span>
 <!-- <input type="" class="form-control " name=""/> -->
 <input name="level" id="level" class="form-control" type="number" value="" cols="5"  placeholder="Enter Level Commission" >
<input name="changesignn" id="changesignn" class="form-control"  type="hidden" >
 
 
    </div>
    </div>
      &nbsp;
    <legend>
    <span class="fieldset-legend">
        Levels
</span>
 </legend>
 &nbsp;
 <div> 
   <div id="inputs"></div>
    </div>
   <a href="{{route('store_level')}}"><button class="btn btn-info" style="margin:10px;">Update</button></a>
   </div> </br>
  </div>
</form>
                       
                </div>
            </div>
        </div>

                         <div class="col-md-6">
            <div class="card radius-10">
                 
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Edit</th>
                                        <th>Id</th>
                                        <th style="word-wrap: break-word;paddng:0px;pargin:0px;">Levels</th>
                                    
                                </tr>
                            </thead>
                          
                                        <tbody>
                                @foreach($data as $d)
                                    <tr>
                                    <td><a href="{{route('level-delete',['id'=>$d->id])}}" onclick="alert('Are you want to delete!!');"><i><span class="bx bx-trash"></a>
                                  
                                     <a href="javascript:void(0)" onclick="changeLevelvalue('<?php echo $d->id; ?>');"><i><span class="bx bx-edit"></a>
                                     </td>
                                  
                                    <td>{{$loop->iteration}}</td>
                                    <!--<td type='text'>{{$d->level_first}}</td>-->
                                    <td class="id" style="width:20px;">
                                        <input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" id="level{{$d->id}}" type="text" value="{{$d->level_no}}">
</td>
                                    </tr>
                                @endforeach
                                    </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>

        </div>
    </div>
    

    <!--end page wrapper -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <script type="text/javascript">
            $('#level').change(function(){
                var svalue=$("#changesignn").val();
                if(svalue=='flat'){
                  
                        $('#inputs').html('');
                        for (var i = 0; i < $('#level').val(); i++) {  
                        
                        $('#inputs').append('<div class="input-group"> <span class="input-group-text bg-transparent" id="changesignn"><i>$</i></span><input type="text" class="form-control " name="level_first[]" value="" id="level_first" placeholder="Enter First Level % Commission"/></div><br>');
                        }
                        

                }
                if(svalue=='percentage'){
                  
                    $('#inputs').html('');
                    for (var i = 0; i < $('#level').val(); i++) {  
                    $('#inputs').append('<div class="input-group"> <span class="input-group-text bg-transparent" id="changesignn"><i>%</i></span><input type="text" class="form-control " name="level_first[]" value="" id="level_first" placeholder="Enter First Level % Commission"/></div><br>');
                    }

                }
            });
               
            </script>
  <script>
    function changeLevelvalue(id){
        
          var level=$("#level"+id).val();
        
          $.ajax({
            url : '{{route("updatelevel")}}',
            data: {"level":level , "id":id , "_token":"{{csrf_token()}}"},
            type: "POST",
            success : function(response) {
             window.location.href = "{{route('level')}}";
             },
            }); 
        
    }
    
    
function changevalue(value){
  
        if(value=='flat'){
            $("#changesignn").val(value);
        }
        if(value=='percentage'){
            $("#changesignn").val(value);
        }
}
     </script>
@endsection