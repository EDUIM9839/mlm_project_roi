@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Link to Font Awesome CSS -->
<link rel="stylesheet" href="styles.css">
<style>
    
.class-icon {
 
  border-radius: 50%;  
  display: flex;
  justify-content: center;
  align-items: center;
} 
 
.fa-clock {
  font-size: 1em;  
  color: green;  
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
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Update Login Image</li>
                            
                        </ol>
                    </nav>
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
                                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @elseif(session()->has('error'))
                                
                                
                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                    <div class=" "  >
                                        <div class="font-20 text-white"><i class='bx bxs-message-square-x' style='display:contents; !important' ></i><span style='font-size:16px;'>&nbsp;{!!session()->get('error')!!}</span>
                                        </div>  
                                        
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div> 
                                @endif 
                                
                                <div id="message"></div>
                            <form action="{{route('upload_image')}} " method="POST" id="withdraw-form" enctype="multipart/form-data">
                                @csrf 
                              <div class="card">            
                <div class="card-body p-4 "> 
                    <div  style ="margin:auto;">
                                   <input type="hidden" name="unique_id" id="unique_id">
                                    
					<div class="border p-4 rounded">
					      
					   
					    <h6 style="color:green">Update Image</h6>   
								<hr/> 
							                                	@php
                                                                $crypto_type=DB::table('crypto_type')->first();
                                                                @endphp
                               <div class="row" style="border: thin solid white; border-radius: 50px; margin-top: 25px;" id="id1">                        
                                                            </div>
                                                            <div class="col-sm-12" id="id2">
                                                                
                                                                 <label>  
                                                                   login Image</label><br>
                                                                     <small style="color:red;">@error('image')
                                                                        {{$message}}
                                                                      @enderror
                                                                    </small>
                                                    
                                                                    <input type="file" placeholder="upload proof of payment" name="image"  value="{{old('image')}}" class="form-control" ><br>
                                                                
                                                               
                                                            </div>
                              
                               	<div class="row g-3" id="id3"> 
                                <!-- Office End -->
                                <div align="center" class="btn-container justify-content-end mt-2"
                                    style="padding: 2px; left:20px;">
                                 <button style="weight:5px;margin: 4%; font-size:15px;" class="btn btn-success btn-lg" type="submit">Update</button>
                                </div>
							</div>
							</div> 
                                <br> 
							</form>
							

						 </div>
					</div>
                        
            </div>   
                    </div>
                </div>           
            <!-- Scrollable -->
           
        
    <!--end page wrapper -->
     


@endsection