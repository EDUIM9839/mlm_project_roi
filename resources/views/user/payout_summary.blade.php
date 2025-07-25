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
                            <li class="breadcrumb-item active" aria-current="page">Payout Summary</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
            <div style="width: 55%;left: 22%;" class="card">
                <div class="card-body p-4">
                   
                    <div class="form-body ">
                          <h6 style="color:green">Payout</h6>
								<hr/>
                  
                            <form     action="{{ route('update_data') }}" method="POST" enctype="multipart/form-data">
                                @csrf
							

					<div class="border p-4 rounded">
						<div class="row g-6">
                                <div class="col-md-12">
                                
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                        <input type="email" class="form-control  " name="business_name"
                                              id="business_name"
                                            placeholder="" />
                                    </div></br>
                             <div class="d-flex justify-content-center">
                                 <button type="submit" name="submit" class="btn btn-success">Submit</button>
                             </div>
                                    
                              

							</form>
					</div>
                        </div>
                    </div>
                </div>
            </div>
                       

          </div>
             <!-- Scrollable -->
            <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr class="table-dark">
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width: 46.9844px;">Sr.No.</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 76.1562px;">User Name</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 209.875px;">User Id</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Income Type: activate to sort column ascending" style="width: 144.797px;">Withdrawal Amount</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Transaction type: activate to sort column ascending" style="width: 165.172px;">TDS</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Admin Charges</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Paying Amount</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Bank Details</th>
                         <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Status</th>
                </tr>
                    </thead>
             <tbody>
                 
                 <tr>
                     <td>
                         1
                     </td>
                     <td>
                         1
                     </td>
                     <td>
                         1
                     </td>
                     <td>
                         1
                     </td><td>
                         1
                     </td><td>
                         1
                     </td>
                     <td>
                         1
                     </td>
                     <td>
                         1
                     </td>
                       <td>
                         1
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
