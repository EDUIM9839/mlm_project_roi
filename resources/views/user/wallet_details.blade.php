@extends('user.layouts.main')
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
                            <li class="breadcrumb-item active" aria-current="page">Wallet Details</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
         
            <!-- Scrollable -->
            <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr class="table-dark">
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width: 46.9844px;">Sr.No.</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 76.1562px;">Amount Deduct</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 209.875px;">TXN Type</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Income Type: activate to sort column ascending" style="width: 144.797px;">Status</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Transaction type: activate to sort column ascending" style="width: 165.172px;">Date</th>
                        <!--<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Delivery Status</th>-->
                        <!--<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Order Date</th>-->
                        <!--<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Action</th>-->
                </tr>
                    </thead>
             <tbody>
                 
                 <tr>
                     <td>
                        
                     </td>
                     <td>
                        
                     </td>
                     <td>
                          
                     </td>
                     <td>
                         
                     </td>
                     <td>
                         
                     </td>
                 </tr>

             </tbody>
                        </table>
                
            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection
