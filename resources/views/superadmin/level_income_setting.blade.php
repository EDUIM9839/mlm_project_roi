@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
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
                              <label for="inputLastName1" class="form-label">Type</label>
                       
 <div class="form-group col-md-12">
      <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                        <select  id="commission-dropdown"  name="type" value="{{$data[0]->type}}" class="form-control" onchange="changevalue(this.value)">
                            <option value="">-- Select Type --</option>
                            <option value="flat">Flat</option>
                            <option value="percentage">Percentage</option>
                        </select>
                        
                    </div>
  </div>
 
  <div class="form-group col-md-12">
 <!--   <label for="inputLastName1" class="form-label">Commission Criteria</label>-->
 <!--    <div class="input-group"> <span class="input-group-text bg-transparent"><i-->
 <!--                                               class='bx bxs-user'></i></span>-->

 <!--<input type="text" class="form-control " value="" name="type"-->
 <!--value="" id="type"-->
 <!--placeholder="Enter Commission Criteria"/>-->
 <!--   </div>-->
    </div><br>
    
   <div class="form-group col-md-12">
<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-coin'></i></span>
 <!-- <input type="" class="form-control " name=""/> -->
 <input name="level" id="level" class="form-control" type="number" value="" cols="5"  placeholder="Enter Level " >
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
                                    <th>Delete|Update</th>
                                        <th>Serial<br>No</th>
                                        <th style="word-wrap: break-word;paddng:0px;pargin:0px;">Level<br> Commission</th>
                                        <th style="word-wrap: break-word;paddng:0px;pargin:0px;">Required<br>Directs</th>
                                        <th style="word-wrap: break-word;paddng:0px;pargin:0px;">Minimum<br>Business</th>
                                    
                                </tr>
                            </thead>
                          
                                        <tbody>
                                @foreach($data as $d)
                                    <tr>
                                    <td><a href="{{route('level-delete',['id'=>$d->id])}}" onclick="alert('Are you want to delete!!');"><i><span class="bx bx-trash"></a>
                                  
                                     <a href="javascript:void(0)" onclick="changeLevelvalue('<?php echo $d->id; ?>');"><i><span class="bx bx-edit"></a>
                                     </td>
                                  
                                    <td>{{$loop->iteration}}</td>
                                
                                    <td class="id" style="width:20px;">
                                         
                                        <input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" id="level<?php echo $d->id; ?>" type="text" value="{{$d->level_first}}">
                                       
                                    </td>
                                   
                                     <td class="id" style="width:20px;">
                                        <input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" id="direct_required<?php echo $d->id; ?>" type="text" value="{{$d->direct_required}}">
                                    </td>
                                     <td class="id" style="width:20px;">
                                        <input style="border:none;border-bottom:thin solid gray;width:100%;background:transparent;" id="minimum_business<?php echo $d->id; ?>" type="text" value="{{$d->minimum_business}}">
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
         
        var directs=$("#direct_required"+id).val();
        
        var mbsiness=$("#minimum_business"+id).val();
          $.ajax({
            url : '{{route("updatelevel")}}',
            data: {"level_first":level , "id":id , "minimum_business":mbsiness , "direct_required":directs , "_token":"{{csrf_token()}}"},
            type: "POST",
            success : function(response) {
             window.location.href = "{{route('level_income_setting')}}";
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