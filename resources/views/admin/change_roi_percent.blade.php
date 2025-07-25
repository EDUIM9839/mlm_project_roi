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
                            <li class="breadcrumb-item active" aria-current="page"> Change ROI Percent And BFI Percent</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <!-- page start -->
    <!-- Scrollable -->
    <div class="card">
        <div class="row m-2">
            <!--<div class="col-sm-3"></div>-->
            <div class="col-sm-6">
                <div style="padding: 25px; border:1px solid grey; margin: 25px 0 25px 0; border-radius:7px;">
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
                    <form action="{{route('change_roi_percent_by_admin')}}" method="post">
                    @csrf
                        <div class="form-group">
                           @php 
                           $business_setup=DB::table("business_setup")->first();
                           @endphp
                           <h5>Current ROI Percent:{{$business_setup->roi_percent}} %</h5>
                            <div class="form-group">
                                <label for="email">Change ROI Percent:</label>
                                <input type="number" name="roi_percent" class="form-control" required step="any">
                                <div style="color:red;">{{ $errors->first('roi_percent') }}</div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <div style="padding: 25px; border:1px solid grey; margin: 25px 0 25px 0; border-radius:7px;">
                    @if (session()->has('happy'))
                        <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                            <div class="d-flex align-items-center">
                                <div class="font-35 text-white"><i class='bx bxs-message-square-check'></i>
                                </div>
                                <div class="ms-3">
                                    <div class="text-white">{!!session()->get('happy')!!}</div>
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
                    <form action="{{route('change_bfi_percent_by_admin')}}" method="post">
                    @csrf
                        <div class="form-group">
                           @php 
                           $business_setup=DB::table("business_setup")->first();
                           @endphp
                           <h5>Current BFI Percent:{{$business_setup->bfi_percent}} %</h5>
                            <div class="form-group">
                                <label for="email">Change BFI Percent:</label>
                                <input type="number" name="bfi_percent" class="form-control" required step="any">
                                <div style="color:red;">{{ $errors->first('bfi_percent') }}</div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Scrollable -->
<!-- / Content -->
<div class="content-backdrop fade"></div>
</div>
    <!-- page end -->
        </div>
    </div>
    <script>
function submitForm() {
    
    if (confirm("Are you sure to change your password?")) {
        return true;  
    } else {
        return false;  
    }
}
</script>
@endsection
