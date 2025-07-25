@extends('admin.layouts.main')
@section('mains')
<style>
	input{
		border-width: 1px !important;
	}

	.input-group-text{

		border-width: 1px !important;

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
                            <li class="breadcrumb-item active" aria-current="page">ROI ON OFF</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
			
            <div class="card">
                <!--<div class="card-body p-4">-->
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
                                        <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                        </div>
                                        <div class="ms-3">
                                             
                                            <div class="text-white">{!!session()->get('error')!!}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                                @endif
                   
 
                       
                </div>
            </div>
                                    
            <!-- Scrollable -->
            <!--<h4 align="center"> Activation History </h4>-->
        <div class="card m-3">
                       <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr class="table-dark">
                                    <th>Sr.No</th>
                                    <th>User</th> 
                                    <th>Amount</th> 
                                    <th>Status</th>
                                    <th>Activated Date</th>
                                    <th>ROI ON OFF</th>
                                </tr>
                            </thead>
                            <tbody>         
                                
                                @php
                                    $i = 1;
                                    
                                    
                                @endphp
                                @foreach ($all_user as $af)
                                
                                
                                    <tr>
                                        <td>{{ $i++ }}</td> 
                                        
                                        
                                        <td> {{$af->first_name}} {{$af->last_name}}
                                        <br> <b>{{$af->userid}}</b>
                                        </td> 
                                        <td>{{$af->amount}}</td>
                                        
                                        @if($af->status=='approved')
                                        <td><b><span style="color:green" >Active   <i class="far fa-check-circle"></i> 
                                        @else    <i class="far fa-clock fa-spin"></i>  </span></b>
                                        </td>
                                         @endif
                                        <td> {{ Helper::formatted_date($af->created_at)}}
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.roi.toggle', $af->id) }}">
                                                @csrf
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="roi_status" onchange="this.form.submit()" {{ $af->roi_status_on_off ? 'checked' : '' }}>
                                                </div>
                                            </form>
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
    
      
@endsection
