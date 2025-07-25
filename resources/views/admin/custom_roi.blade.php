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
                            <li class="breadcrumb-item active" aria-current="page">Custom ROI Settings</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            
            
            <div class="d-flex w-100 justify-content-center px-2">
                
                
                   <div class="card w-100 p-2" style="max-width: 550px;">
                      
                     <div class="card-body">
                         <div class="fs-5 mb-4">Custom ROI</div>
                         
                         <form action="{{  }}" method="POST">
                          <div class="mb-3">
                            <label for="userid" class="form-label">User ID</label>
                            <input type="text" class="form-control"  id="userid">
                          </div>
                          <div class="mb-3">
                            <label for="roi" class="form-label">ROI (%)</label>
                            <input type="number" class="form-control" id="roi">
                          </div>
                         
                          <button type="submit" class="btn btn-primary ">Submit</button>
                        </form>
                         
                         
                     </div>
                      
                      
                    </div>    
                  
           </div>
            
        </div>
    </div>
@endsection
