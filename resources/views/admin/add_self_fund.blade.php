@extends('admin.layouts.main')
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
                            <li class="breadcrumb-item active" aria-current="page">Add Fund To Self</li>
                            
                            
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
                            <form action="{{route('add_self_fund')}}" method="POST" id="withdraw-form" enctype="multipart/form-data">
                                @csrf 
                                
                                @php 
                                $admin_id=DB::table('user')->where('role','admin')->first();
                                
                                $add_fund=DB::table('admin_fund_self')->sum('amount');
                                $ptop=DB::table('ptop_transefer')->where('sender_id',$admin_id->id)->sum('total_amount');
                                @endphp
                              <div class="card">            
                <div class="card-body p-4 "> 
                    <div  style ="margin:auto;">
                                   <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                  
					<div class="border p-4 rounded">
					      
					   
					    <h6 style="color:green">Add Fund <br><br><span><div id="balance-info"  class="badge rounded-pill text-black bg-warning p-2 text-uppercase px-3"><i class='bx   align-middle me-1'></i><span id="current-balance">Add Fund:- {{Helper::get_currency()}}{{$add_fund}}</span></div></span> 
					    <span><div id="balance-info"  class="badge rounded-pill text-white bg-danger p-2 text-uppercase px-3 "><i class='bx   align-middle me-1'></i><span id="current-balance">P2P:- {{Helper::get_currency()}}{{$ptop}}</span></div></span>
					    <span><div id="balance-info"  class="badge rounded-pill text-white bg-success p-2 text-uppercase px-3"><i class='bx   align-middle me-1'></i><span id="current-balance">Wallet Balance:- {{Helper::get_currency()}}{{Auth::user()->saving_wallet}}</span></div></span>
					    
					    </h6>   
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
                                                                <!--<label>UserId</label><br>-->
                                                                <!--  <small style="color:red;">@error('amount')-->
                                                                <!--        {{$message}}-->
                                                                <!--      @enderror-->
                                                                <!--    </small>-->
                                                         
                                                                <!--<input type="text" name="userid" id="userid"  value="{{Auth::user()->userid}}" class="form-control mb-2" readonly>-->
                                                               
                                                                   
                                                            </div>
                              
                               	<div class="row g-3" id="id3"> 
                                <!-- Office End -->
                                <div align="center" class="btn-container justify-content-end mt-2"
                                    style="padding: 2px; left:20px;">
                                 <button style="weight:5px;margin: 4%; font-size:15px;" class="btn btn-success btn-lg" type="submit">Add Fund</button>
                                </div>
							</div>
							</div> 
                                <br> 
							</form>
							
							
							<div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr>
                     <th>Sr No.</th>
                     <th>Amount</th>
                     <th>Date</th>
             </tr>
            </thead>
            <tbody> 
            @php
            $fund_history=DB::table('admin_fund_self')->get();
            @endphp
            @foreach($fund_history as $fh)
                <tr> 
                <td>{{$loop->iteration}}</td>
                <td>${{$fh->amount}}</td>
                
                <td>{{Helper::formatted_date($fh->created_at)}}</td>
                
                </tr>
              @endforeach
            </tbody>
                        </table>
                
            </div>
            <!--/ Scrollable -->

          </div>

						 </div>
					</div>
                        
                       
               
            </div>   
                    </div>
                </div>           
            <!-- Scrollable -->
           
        
    <!--end page wrapper -->
     
@endsection
