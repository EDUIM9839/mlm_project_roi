@extends('user.layouts.main')
@section('mains')
    <style>
        #remaining_wallet_amount{
            margin-top: 5px;
            font-size: 15px;
            width:250px;
            color:black;
            
        }
    </style>
    
    <div class="page-wrapper">
        <div class="page-content">
            <h5 class="mb-0">Purchase Package</h5>
            <hr />
            <div class='row'>
                <div class='col-md-2'></div>
                    <div class='col-md-8'>
                       <div class="card">
                        <div class="card-body p-4">
                            <div class="form-body ">
                                <div class="row"> 
                                   <div class="col-md-12"><?php echo Session::get('message'); ?></div>
                            </div>
                            <ul class="nav nav-tabs">
                              <li class="nav-item">
                                <a class="nav-link" <?php if($tabid==1){?> style='background: green;color:white' <?php } else if($tabid==' '){ ?>style='background: green;color:white' <?php  } else{  ?> style='background: red;color:white' <?php } ?> href="{{route('payment', ['id'=>1])}}">Purchage Package By Wallet</a>
                              </li>
                              <li class="nav-item" style='margin-left: 5px '>
                                <a class="nav-link " <?php if($tabid==2){?> style='background: green;color:white' <?php }else{  ?> style='background: red;color:white' <?php } ?> href="{{route('payment', ['id'=>2])}}">Purchage Package By Upi
                                </a>
                              </li>
                            </ul>
        
         Tab panes 
        <div class="tab-content">
          <?php if($tabid==1){?>
          <div class="tab-pane container <?php if($tabid=='1'){ echo 'active'; }?>" style='margin-top:15px'>
            <form action="{{route('purchage_package_bywallet')}}" method='POST' id='sendmessage' enctype="multipart/form-data"> 
                                @csrf
                                <div class="row g-6">
                                    <div class="col-md-12 ">
                                        <label class='mb-1'><small style='color:red;font-size:20px'>*&nbsp;</small>Select Package</label> <br>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent"><i class="bx bxs-package"></i></span>
                                            <select class="form-control" name="package_id" id="package_id" style='margin-buttom:10px'>
                                            <option value=" " selected="">-- Select Package --</option>
                                            <?php foreach($package as $row){?>
                                            <option value="{{$row->id}}" <?php if(old('package_id')==$row->id){ ?>selected<?php } ?>>{{$row->name}}</option>
                                            <?php } ?>
                                        </select>
                                        
                                        </div>
                                        <small style='color:red' id='name_error'>
                                            @error('package_id')
                                            {{$message}}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                
                                <div class="row mt-3 ">
                                
                                    <div class="col-md-12">
                                  
                                        <div class="mb-3">
                                             <label  class='mb-1'><small style='color:red;font-size:20px'>*&nbsp;</small>Select Payment Type</label> <br>
                                             <div class="input-group">
                                                <span class="input-group-text bg-transparent"><i class="bx bxs-credit-card"></i></span>
                                                <select class="form-control" name="payment_type" id="payment_type" >
                                                <option value=" " selected="">-- Select Payment Type --</option>
                                                <option value="wallet">Wallet</option>
                                                
                                                </select>
                                             </div>
                                            <small style='color:red' id='payment_type_error'>
                                                @error('payment_type')
                                                {{$message}}
                                                @enderror
                                            </small>
                                               <label class='badge bg-success' id='remaining_wallet_amount' style=''>Remaining Amount : {{$bussiness_setup['0']->currency_symbol}} {{$user['0']->saving_wallet}} </label>
                                        </div>
                                    
                                    </div>
                                
                                </div>
                                
                                <div class="row" id='upi' style='display:none'>
                                   
                                    
                                </div>
                                
                               
                                <div class='row'>
                                      
                                        <input type="hidden" name="user_id" id="user_id" value="{{$user['0']->id}}">
                                        <input type="hidden" name="activated_by" id="activated_by" value="{{$user['0']->id}}">
                                </div>
                                <div class="mb-5 mt-5" id='submitbutton'>
                                <button type="submit" class="btn btn-danger" style="float: right;background: green;border-color: green;">Purchage</button>
                                </div>
                                </form>   
          </div>
          <?php } else if($tabid==2){ ?>
          
          <div class="tab-pane container <?php if($tabid=='2'){ echo 'active'; }?>" style='margin-top:15px'>
              
            <form action="{{route('purchage_package_byupi')}}" method='POST' id='sendmessage' enctype="multipart/form-data"> 
                @csrf
                    <div class="row g-6">
                        <div class="col-md-12 ">
                            <label class='mb-1'><small style='color:red;font-size:20px'>*&nbsp;</small>Select Package</label> <br>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"><i class="bx bxs-package"></i></span>
                                <select class="form-control" name="package_id" id="package_id" style='margin-buttom:10px'>
                                    <option value=" " selected="">-- Select Package --</option>
                                    <?php foreach($package as $row){?>
                                    <option value="{{$row->id}}" <?php if(old('package_id')==$row->id){ ?>selected<?php } ?>>{{$row->name}}</option>
                                    <?php } ?>
                                </select>
                                
                            </div>
                            <small style='color:red' id='name_error'>
                                @error('package_id')
                                {{$message}}
                                @enderror
                            </small>
                        </div>
                    </div>
                
                <div class="row mt-3 ">
                    
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label  class='mb-1'><small style='color:red;font-size:20px'>*&nbsp;</small>Select Payment Type</label> <br>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"><i class="bx bxs-credit-card"></i></span>
                                <select class="form-control" name="payment_type" id="payment_type">
                                    <option value=" " selected="">-- Select Payment Type --</option>
                                    <option value="bar_code">Upi</option>
                                </select>
                            </div>
                            <small style='color:red' id='payment_type_error'>
                            @error('payment_type')
                            {{$message}}
                            @enderror
                            </small>
                           
                        </div>
                        
                    </div>
                
                </div>
                
                <div class="row" id='upi'>
                    <div class="col-md-12">
                        <label class="mb-1"><small style="color:red;font-size:20px">*&nbsp;</small>UPI ID</label><br>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class="fa fa-credit-card"></i></span>
                            <input type="text" class="form-control" name="upi_id" id="upi_id" >
                        </div>
                        <small style="color:red" id="upi_id_error">@error("upi_id"){{$message}} @enderror</small></div>
                        <div class="col-md-12">
                            <label class="mb-1"><small style="color:red;font-size:20px">*&nbsp;</small>Select Qr Code Image</label><br>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"><i class="fa fa-image"></i></span>
                                <input type="file" class="form-control" name="qr_code_image" id="qr_code_image">
                            </div>
                            <small style="color:red" id="qr_code_image_error">@error("qr_code_image"){{$message}}@enderror</small>
                        </div>
                </div>
                
                
                <div class='row'>
                     <input type="hidden" name="user_id" id="user_id" value="{{$user['0']->id}}">
                     <input type="hidden" name="activated_by" id="activated_by" value="{{$user['0']->id}}">
                </div>
                <div class="mb-5 mt-5">
                    <button type="submit" class="btn btn-danger" style="float: right;background: green;border-color: green;">Purchage</button>
                </div>
            </form>
              
          </div>
          <?php }else if($tabid==' '){  ?>
          <div class="tab-pane container <?php if($tabid==' '){ echo 'active'; }?>" style='margin-top:15px'>
            <form action="{{route('purchage_package_bywallet')}}" method='POST' id='sendmessage' enctype="multipart/form-data"> 
                                @csrf
                                <div class="row g-6">
                                    <div class="col-md-12 ">
                                        <label class='mb-1'><small style='color:red;font-size:20px'>*&nbsp;</small>Select Package</label> <br>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent"><i class="bx bxs-package"></i></span>
                                            <select class="form-control" name="package_id" id="package_id" style='margin-buttom:10px'>
                                            <option value=" " selected="">-- Select Package --</option>
                                            <?php foreach($package as $row){?>
                                            <option value="{{$row->id}}" <?php if(old('package_id')==$row->id){ ?>selected<?php } ?>>{{$row->name}}</option>
                                            <?php } ?>
                                        </select>
                                        
                                        </div>
                                        <small style='color:red' id='name_error'>
                                            @error('package_id')
                                            {{$message}}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                
                                <div class="row mt-3 ">
                                
                                    <div class="col-md-12">
                                  
                                        <div class="mb-3">
                                             <label  class='mb-1'><small style='color:red;font-size:20px'>*&nbsp;</small>Select Payment Type</label> <br>
                                             <div class="input-group">
                                                <span class="input-group-text bg-transparent"><i class="bx bxs-credit-card"></i></span>
                                                <select class="form-control" name="payment_type" id="payment_type" onchange='selectval(this.value)'>
                                                <option value=" " selected="">-- Select Payment Type --</option>
                                                <option value="wallet">Wallet</option>
                                                <option value="bar_code">Upi</option>
                                                 <option value="online">Online</option>
                                                </select>
                                             </div>
                                            <small style='color:red' id='payment_type_error'>
                                                @error('payment_type')
                                                {{$message}}
                                                @enderror
                                            </small>
                                               <label class='badge bg-success' id='remaining_wallet_amount' style=''>Remaining Amount : {{$bussiness_setup['0']->currency_symbol}} {{$user['0']->saving_wallet}} </label>
                                        </div>
                                    
                                    </div>
                                
                                </div>
                                
                                <div class="row" id='upi' style='display:none'>
                                   
                                    
                                </div>
                                
                               
                                <div class='row'>
                                      
                                        <input type="hidden" name="user_id" id="user_id" value="{{$user['0']->id}}">
                                        <input type="hidden" name="activated_by" id="activated_by" value="{{$user['0']->id}}">
                                </div>
                                <div class="mb-5 mt-5" id='submitbutton'>
                                <button type="submit" class="btn btn-danger" style="float: right;background: green;border-color: green;">Purchage</button>
                                </div>
                                </form>   
          </div>
          <?php } ?>
         
        </div>
        
        
                               
                            
                            </div>
                        </div>
        </div>
                    </div>
                <div class='col-md-2'></div>
            </div>
<script>
    function selectval(val){
        var htmls=' ';
        if(val=='wallet'){
          $("#remaining_wallet_amount").css('display', 'block');
          $("#upi").css('display', 'none'); 
        }else if(val=='bar_code'){
           $("#remaining_wallet_amount").css('display', 'none'); 
           
        }
    }
    
      
    
</script>            
            
@endsection            
            
            
          