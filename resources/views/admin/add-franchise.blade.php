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
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class='col-md-6'>
                       <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{route('franchise-list')}}" class='badge bg-info'>Franchise List</a></h6>
                </div>
                </div>
            </div>
            <!--end breadcrumb-->
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
                <div class="card-body p-4">
                   
                    <div class="form-body ">
             <!--<div class="row"> <div class="col-md-12"><?php echo Session::get('message'); ?></div>-->
                    <form action="<?php if(!empty($data['0']->id)){?>{{ route('update_franchise') }}<?php } else{ ?>{{ route('save_franchise') }} <?php } ?>" method="post">
            @csrf
        <!--    <h6 class="card-title pb-2"> Add Franchise</h6>-->
								<!--<hr/>-->
             	<div class="border p-4 rounded">
						<div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Distributor / Franchise Business Name:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ $data['0']->first_name }}" name="first_name" placeholder="Enter Franchise Name" id="first_name">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" name="first_name"  value="{{ old('first_name') }}" placeholder="Enter Franchise Name" id="first_name">
                                    <?php } ?>   
                                    
                                
                                </div>
                                    @error('first_name')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="col-md-12">
                                <!--<input type="hidden" class="form-control" value="" name="referal"  id="referal">-->
                                
                                <?php if(!empty($data['0']->id)){?>
                                    <input type="hidden" class="form-control" value="{{ $data['0']->id }}" name="id"  id="id">
                                <?php } ?>
                               
                                <div class="mb-3">
                                    <label class="form-label">Owner Name:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ $data['0']->name }}" name="name" placeholder="Enter Owner Name" id="name">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Enter Owner Name" id="name">   
                                    <?php } ?>    
                                    </div>
                                    @error('name')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                
                            </div>
                            
                      
                          
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Parent Franchise:</label>
                                     <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                    <?php 
                                         $allfranchise=DB::table('user')->where('role', 'franchise')->get();
                                         if(!empty($data['0']->id)){
                                         ?>

                                     <input type="text" class="form-control" readonly='readonly' value="{{  $data['0']->first_name }}" name="pfranchise"  id="pfranchise">
                                       
                                    <?php } else{ ?>
                                        <select class="form-control" id="pfranchise" name="pfranchise" >
                                            <option value="RCK001">--Select--</option>
                                             @foreach($allfranchise as $franchises)
                                                 <option value="{{ $franchises->userid }}">{{ $franchises->first_name }}</option>
                                             @endforeach
                                        </select>
                                       
                                        <?php } ?>   
                                          </div>
                                        @error('pfranchise')
                                        <small style="color:red">{{ $message }}</small>
                                        @enderror
                                  
                                </div>
                            </div>
                        </div>

                        <?php if(!empty($bussiness_setup['0']->franchise_commission)) {?>

                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Commission (%):</label>
                                    <div class="col-sm-12">


                                      
                                    <?php if(!empty($data['0']->id)){?>
                                        <select class="form-control" name="franchise_discount"  id="franchise_discount">
                                            <option value="">--Select Commission--</option>
                                           @for ($i = 1; $i <= 25; $i++)
                                            <option value="{{ $i }}" <?php if($i==$data['0']->franchise_discount){ echo 'selected';}?>><?php echo $i;?></option>
                                            @endfor
                                        </select>
                                    <?php } else{ ?>
                                        <select class="form-control" name="franchise_discount"  value="{{ old('franchise_discount') }}" id="franchise_discount">
                                            <option value="">--Select Commission--</option>
                                              @for ($i = 1; $i <= 25; $i++)
                                              <option value="{{ $i }}"><?php echo $i;?></option>
                                              @endfor
                                        </select>
                                    <?php } ?>   
                                        </div>
                                        @error('franchise_discount')
                                        <small style="color:red">{{ $message }}</small>
                                        @enderror
                                     
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Mobile:</label>
                                   <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-phone'></i></span>
                                    
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ $data['0']->contact }}" name="contact"  id="contact">
                                    <?php } else{ ?>
                                        <input type="tel" class="form-control" name="contact"  value="{{ old('contact') }}" id="contact" placeholder="Enter Mobile Number">
                                    <?php } ?> 
                                    </div>
                                    @error('contact')
                                        <small style="color:red">{{ $message }}</small>
                                     @enderror
                                
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Gender:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <select class="form-control" name="gender"  value="{{ old('gender') }}" id="gender">
                                            <option value="">--Select Gender--</option>
                                            <option value="male" <?php if('male'==$data['0']->gender){ echo 'selected';}?>>Male</option>
                                            <option value="female" <?php if('female'==$data['0']->gender){ echo 'selected';}?>>Female</option>
                                        </select>
                                    <?php } else{ ?>
                                        
                                      <select class="form-control" name="gender"  value="{{ old('gender') }}" id="gender">
                                        <option value="">--Select Gender--</option>
                                        <option value="male" <?php if('male'==old('gender')){ echo 'selected';}?>>Male</option>
                                        <option value="female" <?php if('female'==old('gender')){ echo 'selected';}?>>Female</option>
                                      </select>
                                    <?php } ?> 


</div>
                                    @error('gender')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                
                            </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email:</label>
                                    
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ $data['0']->email }}" name="email" placeholder="Enter email" id="email">
                                    <?php } else{ ?>
                                        <input type="email" class="form-control"  value="{{ old('email') }}"  name="email" id="email" placeholder="Enter Email">
                                    <?php } ?>   
 </div>
                                    @error('email')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                               
                            </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <!--<label class="form-label">Password:</label>-->
                                    <!--<div class="input-group"> <span class="input-group-text bg-transparent"><i-->
                                    <!--            class='bx bxs-inbox'></i></span>-->
                                    <?php if(!empty($data['0']->id)){?>
                                        <!--<input type="password" readonly='readonly' class="form-control"  value="{{ $data['0']->password }}" name="password" id="password" placeholder="Enter Password"> -->
                                    <?php } else{ ?>
                                     <label class="form-label">Password:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                                        <input type="password" class="form-control"  value="{{ old('password') }}" name="password" id="password" placeholder="Enter Password"> 
                                    <?php } ?>   
                                     </div>
                                    @error('password')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       </div>
                   
                        <div class="row">
                             <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Select State:</label>
                                   <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-map'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                     <select class='form-control' name='state' id='state' onchange="changeState(this.value);">
                                         <option value="">--Select State--</option>
                                        <?php foreach($states as $row){ ?>
                                        <option value='{{$row->id}}' <?php if($row->id==$data['0']->state){?>selected<?php } ?>>{{$row->state_name}}</option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" class="form-control" value="<?php echo $data['0']->state; ?>" id="stateid">
                                    <?php } else{ ?>
                                       <select class='form-control' name='state' id='state' onchange="changeState(this.value);">
                                         <option value="">--Select State--</option>
                                        <?php foreach($states as $row){ ?>
                                         <option value='{{$row->id}}'>{{$row->state_name}}</option>
                                        <?php } ?>
                                    </select>
                                        <!--<input type="text" class="form-control" name="state"  value="{{ old('state') }}" id="state" placeholder="Enter State">-->
                                    <?php } ?>  
                                </div>
                                    @error('state')
                                        <small style="color:red">{{ $message }}</small> 
                                    @enderror
                                
                            </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Select City:</label>
                                   <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-map'></i></span>
                                      
                                    <?php if(!empty($data['0']->id)){?>
                                        <!--<input type="text" class="form-control" value="{{ old('city') }}{{ $data['0']->city }}" name="city" placeholder="Enter city" id="city">-->
                                        <select class='form-control' name='city' id='city'>
                                          <option value="<?php echo $data['0']->city; ?>"><?php echo $data['0']->city; ?></option>
                                        </select>
                                        <input type="hidden" class="form-control" value="<?php echo $data['0']->city; ?>" id="cityname">
                                    <?php } else{ ?>
                                        <!--<input type="text" class="form-control" name="city"  value="{{ old('city') }}" id="city" placeholder="Enter City">-->
                                        <select class='form-control' name='city' id='city'>
                                           <option value=''>--Select City--</option>
                                        </select>
                                    <?php } ?>  
</div>
                                    @error('city')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                
                            </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Area/Locality:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-map'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ old('area') }}{{ $data['0']->area }}" name="area" placeholder="Enter area" id="area">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" name="area"  value="{{ old('area') }}" id="area" placeholder="Enter Area">
                                    <?php } ?>
                                    </div>
                                    @error('area')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                 
                            </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Address:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-map'></i></span>
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ old('franchise_address') }}{{ $data['0']->franchise_address }}" name="franchise_address" placeholder="Enter address" id="franchise_address">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" placeholder="Enter Address"  value="{{ old('franchise_address') }}" name="franchise_address" id="franchise_address">
                                    <?php } ?>  
                                    </div>
                                    @error('franchise_address')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                           
                        </div>
                    </div>
 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Pin Code:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                                     
                                    <?php if(!empty($data['0']->id)){?>
                                        <input type="text" class="form-control" value="{{ old('zip') }}{{ $data['0']->zip }}" name="zip" placeholder="Enter zip" id="zip">
                                    <?php } else{ ?>
                                        <input type="text" class="form-control" name="zip"  placeholder="Enter Pincode" value="{{ old('zip') }}" id="zip">
                                    <?php } ?>  
                                    </div>
                                    @error('zip')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror
                                
                            </div>
                            </div>
                            
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Value Type:</label>
                                    <select class="form-control" name="valueType" id="valueType">
                                        <option value="">--Select Value Type--</option>
                                        <option value="male">BV</option>
                                        <option value="female">PV</option>
                                        <option value="female">BVP</option>
                                     </select>
                                </div>
                            </div> --}}
                          
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" style="float: right;  position:absolute;left:50px;" >Submit</button>
                        </div></br>
                    </form>
                     </div>
                </div>
            </div>
               </div>
            </div>
        </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function changeState(id){
        
         $.ajax({
            type: 'post',
            url: '{{ route("getCities") }}',
            data: {'id':id, "_token":"{{csrf_token()}}"},
            success: function (data) {
              
              $("#city").html(data);
            }
        }); 
    }
   
    </script>
@endsection
