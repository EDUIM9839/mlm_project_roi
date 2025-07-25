@extends('user.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase alert  ">P TO P Fund</h6>
       <hr/>
         
            <!-- Scrollable -->
            <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr class="table-dark">
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width: 46.9844px;">Sr.No.</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 76.1562px;">User Id</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 76.875px;">Amount</th>
                        
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Transaction type: activate to sort column ascending" style="width: 65.172px;">Proof of Payment</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Status</th>
                        
                </tr>
                    </thead>
             <tbody>
                 @php
                 $i=1;
                 @endphp
                 @foreach($data as $d)
                 
                 <tr>
                     <td>
                         {{$i++}}
                     </td>
                      <td>
                         {{$d->user_id}}
                     </td>
                    
                     <td>
                         {{$d->amount}}
                     </td>
                    
                     <td>
                       <a href="{{ Storage::url('app/profileupload/').$d->proof_of_payment}}"> <img id="img"  src="{{ Storage::url('app/profileupload/').$d->proof_of_payment}}" style= "border:1px outset; width: 50px; height: 50px; position: relative;"></a>
                     </td>
                     <td>
                         {{$d->status}}
                     </td>
                   
                 </tr>
@endforeach
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
