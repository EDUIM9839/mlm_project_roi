@extends('user.layouts.main')
@section('mains')
@php $user = Auth::user(); @endphp
 
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
                            <li class="breadcrumb-item active" aria-current="page">Add Fund</li>
                            
                            
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
                      
                     @if(session()->has('success'))
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
                            <form action="{{route('addfund')}}" method="POST" id="withdraw-form" enctype="multipart/form-data">
                                @csrf 
                              <div class="card">            
                <div class="card-body p-4 "> 
                    <div  style ="margin:auto;">
                                   <input type="hidden" name="unique_id" id="unique_id">
                                    <input type="hidden" name="user_id" id="user_id">
					<div class="border p-4 rounded">
					      
					   
					    <h6 style="color:green">Add Fund <span><div id="balance-info"  class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class='bx   align-middle me-1'></i><span id="current-balance">Wallet Amount:- {{Helper::get_currency()}}{{$user->saving_wallet}}</span></div></span>  </h6>   
								<hr/> 
                               <div class="row" style="border: thin solid white; border-radius: 50px; margin-top: 25px;" id="id1">                        
                                                            </div>
                                                            <div class="col-sm-12" id="id2">
                                                                <label>Amount</label><br>
                                                                  <small style="color:red;">@error('amount')
                                                                        {{$message}}
                                                                      @enderror
                                                                    </small>
                                                         
                                                                <input type="number" name="amount" id="amount"  value="{{old('amount')}}" class="form-control mb-2" >
                                                                @php
                                                                $crypto_type=DB::table('crypto_type')->first();
                                                                @endphp
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                  <label>Barcode</label><br>
                                                                <img src="{{asset("upibarcode/".$crypto_type->image)}}" width="200" height="200" ><br>
                                                                
                                                                <label>  
                                                                </div>
                                                                 <div class="col-md-6">
                                                                  <label>Address</label><br>
                                                                <p style="color:black;"><b>{{$crypto_type->address}}</b></p>
                                                                
                                                                <label>  
                                                                </div>
                                                                </div>
                                                                
                                                                    Upload proof of payment</label><br>
                                                                     <small style="color:red;">@error('proof_of_payment')
                                                                        {{$message}}
                                                                      @enderror
                                                                    </small>
                                                    
                                                                    <input type="file" placeholder="upload proof of payment" name="proof_of_payment"  value="{{old('proof_of_payment')}}" class="form-control" >
                                                                   
                                                            </div>
                              
                               	<div class="row g-3" id="id3"> 
                                <!-- Office End -->
                                <div align="center" class="btn-container justify-content-end mt-2"
                                    style="padding: 2px; left:20px;">
                                 <a href="index.php"><button style="weight:5px;margin: 4%; font-size:15px;" class="btn btn-success btn-lg" type="submit">Done</button></a>
                                </div>
							</div>
							</div> 
                                <br> 
							</form>
							

						 </div>
					</div>
                        
                       
                        @if(DB::table('user_package')->where('user_id',Auth::user()->id)->where('status','approved')->exists())
                        
                        
                        @else
                        
                     <h4 align="center">  <a href="{{route('welcome')}}" > <button type="button" class='btn btn-primary'> Go to Activation Area </button> </a> </h4>
                     
                     
                      @endif
                     
                        <hr>
                       
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr class="table-dark">
                                    <th>Sr.No</th>
                                    <th>Amount</th> 
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>         
                                
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($get_data as $af)
                                    <tr>
                                        <td>{{ $i++ }}</td> 
                                        <td> {{Helper::get_currency()}}{{$af->amount}}</td>  
                                        <td><b><span style="color:green" >{{ucfirst($af->status) }}  @if($af->status=='approved') <i class="far fa-check-circle"></i> @else    <i class="far fa-clock fa-spin"></i>  @endif </span></b>
                                        </td> 
                                        <td> {{ Helper::formatted_date($af->date_time)}}
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
            <!-- Scrollable -->
           
        
    <!--end page wrapper -->
     
@endsection
