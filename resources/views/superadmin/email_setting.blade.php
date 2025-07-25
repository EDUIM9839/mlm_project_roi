 @extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')
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
                            <li class="breadcrumb-item active" aria-current="page">Email Theme</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            
            <!--end breadcrumb-->
            <!--  -->
            <div class="card">
                   @if (session()->has('success'))
                                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
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
                                        <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                        </div>
                                        <div class="ms-3">
                                             
                                            <div class="text-white">{!!session()->get('error')!!}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                                @endif
                                
                                    
             <div class="card-body d-flex" style="justify-content: center;">
            <div class="col-md-6">
             <div class="card mb-4">
               <div class="card-body">
                   <div class="row">
                       <div class="col-sm-2"></div>
                       <div class="col-sm-8" id="error_amount">
                            
                       </div>
                       <div class="col-sm-2"></div>
                   </div>
                     
                <h4 class="fw-bold py-3 mb-4">
                    <span class="text-muted fw-light"></span>
                 </h4>
               
                <form action="{{route('email')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                     @php
                                    $i = 1;
                                @endphp
                                @foreach ($email_setting as $par) 
                           
                     <input type="hidden" value=" " name="id" id="id">
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Email</label>
                         <div class="input-group"> <span class="input-group-text bg-transparent"> <i
                                                class='bx bxs-user'></i></span>
                        <input type="email" class="form-control" name="email" id="email" value="{{$par->email}}"placeholder="enter your email" required>
                   </div>
                   </div>
                     <div>
                        <label for="defaultFormControlInput" class="form-label">Contact</label>
                         <div class="input-group"> <span class="input-group-text bg-transparent"> <i
                                                class='bx bxs-user'></i></span>
                        <input type="contact" class="form-control" name="contact" id="contact" value="{{$par->contact}}"placeholder="enter your contact" required>
                   </div>
                   </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Quote</label>
                         <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                        <textarea name="quote" id="quote" class="form-control">{{$par->quote}}</textarea>
 
                   </div>
                   </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Header</label>
                         <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                        <textarea name="header" id="header" class="form-control">{{$par->header}}</textarea>

                        
                   </div>
                   </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Footer</label>
                         <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                        <textarea name="footer" id="footer" class="form-control">{{$par->footer}}</textarea>

                       
                   </div>
                   </div>

                     <!--<div>-->
                     <!--    <label for="defaultFormControlInput" class="form-label">Pay To User Id: </label> <span class="useridlabel" style="color:green" ></span><span class="useriderror" style="color:red" ></span>-->
                     <!--      <div class="input-group"> <span class="input-group-text bg-transparent"><i-->
                     <!--                           class='bx bxs-coin'></i></span>-->
                     <!--    <input type="text" oninput="getUser()" class="form-control" id='receiver_id' required>-->
                     <!--    <input type="hidden"  class="form-control" name="receiver_id" id='receiver_id1'>-->
                                       
                     <!--    </div>-->
                     <!--</div>-->
                     <div>
                         <label for="defaultFormControlInput" class="form-label">Subject</label>
                         <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                         <textarea name="message" id="message" class="form-control">{{$par->message}}</textarea>
                     </div>
                      </div>                                                   
                       <div> 
                           <button type="submit" class="btn btn-primary my-3" id="btnx">Update</button>
                       </div> 
                        @endforeach
                      </form>
                          </div>
                      </div>
                              </div>                       
                                                              
                          </div>
                      </div>
 
                     
                            </div>
                        </div>