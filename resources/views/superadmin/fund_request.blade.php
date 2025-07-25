@extends('admin.layouts.main')
@section('mains')
<style>
.modal-footer {
justify-content: center;
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
                            <li class="breadcrumb-item active" aria-current="page"> Fund History</li>
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
                 <tr class='table-dark'>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width: 46.9844px;">Sr.No.</th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width: 46.9844px;">Name</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 76.1562px;">User Id</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 76.1562px;">Amount</th>
                       
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Transaction type: activate to sort column ascending" style="width: 76.172px;">Proof of Payment</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Status</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Action</th>
                        <!--<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Join Date</th>-->
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
                         {{$d->first_name}} {{$d->last_name}}
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
                    <td id="edit">
                    @if($d->status=="approved")
                   
                  <p  class="badge bg-gradient-quepal text-white shadow-sm w-50"">Paid</p>
                     @else
                     <a onclick="geteditid({{$d->id}});"   class="badge bg-gradient-quepal text-white shadow-sm w-50 "btn btn-primary"   data-bs-toggle="modal" data-bs-target="#exampleModal">Pay</a>
                 @endif
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
    <!-- Button trigger modal -->

<!-- Modal -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pay to User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('fundrequest')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden"  name="id" id="editid"/>
          <input type="hidden" name="unique_id" id="unique_id"/>
        <div class="modal-body">
                <div class="border p-4 rounded">
					
                                <div class="col-md-12">
                                    <label for="inputLastName1" class="form-label">User ID</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                        <input type="text" class="form-control" name="user_id"
                                            value="" id="user_ids"
                                            placeholder="User Id" readonly/>
                                           
                                    </div>
                                </div>
                                
                                 <div class="col-md-12">
                                    <label for="inputLastName1" class="form-label">Amount</label>
                                    <div class="input-group"><span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                        <input type="text" class="form-control" name="amount"
                                            value="" id="amounts"
                                            placeholder="Enter Amount"/>
                                    </div>
                                </div>
                </div>
        </div>
                                  <div class="modal-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Pay</button>
      </div>
             </form>
    </div>
  </div>
</div>
   <script>
    $ (document).ready (function () {
	$ (".modal a").not (".dropdown-toggle").on ("click", function () {
		$ (".modal").modal ("hide");
	});
});
function geteditid(id){
  
    $("#editid").val(id);

                $.ajax({
                    url : '{{URL::route("getEditfund")}}',
                    data: {"editid":id,   "_token": "{{ csrf_token() }}"},
                    type: "POST",
                    success : function(response) {
                     
                       var obj=JSON.parse(response);
                     
                       $("#user_ids").val(obj.user_id);
                       $("#unique_id").val(obj.unique_id);
                    
                   }
                 });
}
</script>
@endsection
