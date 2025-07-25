@extends('admin.layouts.main')
@section('mains')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--end breadcrumb-->
            <div class='row'>
                <div class='col-md-6'>
                       <h6 class="mb-0 text-uppercase"> {{ $title }}</h6>
                </div>
                <div class='col-md-6'>
                       <h6 class="mb-0 text-uppercase"> 
                         <a class='badge bg-info' data-bs-toggle="modal" onclick="getpId('<?php echo $id; ?>')" data-bs-target="#myModal-1" style="float:right">Upload Bulk Image</a>
                       </h6>
                </div>
            </div>
            
            <hr />
            <div class="card" style="text-align: center">
                <div class="card-body">
                    
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
                                        <div class="font-35 text-white"><i class='bx bxs-message-square-check-x'></i>
                                        </div>
                                        <div class="ms-3">
                                            <div class="text-white">{!!session()->get('error')!!}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                    
                <div class="container">
                    <div id="" class="row p-2">
                        <?php  $rows = DB::table('product_images')->where('pid', $id)->get(); if(!empty($rows['0']->id)){ foreach($rows as $row){?>
                        <div class="col-md-3 mb-4 "> 
                            <div class="border" style='padding: 10px;'>
                            <a data-bs-toggle="modal" data-bs-target="#myModal" onclick="getId('<?php echo $row->id; ?>','<?php echo $row->image; ?>')">
                               <img class="rounded-3" src="{{ asset('productImages') }}{{ '/' }}{{ $row->image }}" alt="loading..." width="150" height="150"/>
                               </a>
                               <div class='row mt-4'>
                                   <div class='col-md-6'>
                                       <a class='badge bg-success'  style="float:right;font-size:15px" data-bs-toggle="modal" data-bs-target="#myModal" onclick="getId('<?php echo $row->id; ?>' , '<?php echo $row->image; ?>')">Update</a>
                                   </div>          
                                   @php $data=count($rows);@endphp
                                   @if($data>='2')
                                   <div class='col-md-6'>
                                       <a  class='badge bg-danger delete-btn' style="float:left;font-size:15px" href="{{ route('deleteProductImage', ['id'=>$row->id]) }}">Delete</a>
                                    </div>
                                    @endif
                               </div>  
                            </div>
                         </div>
                         <?php }} else{ ?>
                            <div class="col-md-12" >
                                <p style="text-align: center">Image not found</p>
                            </div>     
                         <?php } ?> 
                    </div>
                </div>
                
      <!-- Button to Open the Modal -->
  
      <!-- The Modal -->
                          <div class="modal fade" id="myModal">
                          <div class="modal-dialog">
                          <div class="modal-content">
                      
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Upload Multiple Image</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('updateImage') }}" method="post" enctype="multipart/form-data"> 
                                @csrf 
                            <!-- Modal body -->
                            <div class="modal-body">
                                   @error('image')
                                    <small style="color:red">{{ $message }}</small>
                                    @enderror
                              <input type="hidden" id="imageid"  name="imageid" class="form-control" >
                              <input type="hidden" class="form-control" name="oldimage" id="oldimage" >  
                               <input type="file" class="form-control" name="image" Required>
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success">Update</button>
                            </div>
                           </form>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    
     <div class="modal fade" id="myModal-1">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Update Product Image</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('uploadBulkImage') }}" method="post" enctype="multipart/form-data"> 
                @csrf 
            <!-- Modal body -->
                @error('image')
                <small style="color:red">{{ $message }}</small>
                @enderror
            <div class="modal-body">
              <input type="hidden" id="pid"  name="pid" class="form-control" >
               <input type="file" class="form-control" name="image[]" multiple required>
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Update</button>
            </div>
           </form>
          </div>
        </div>
      </div>
      <script>
        function getpId(id , img){
             $('#pid').val(id);
        }
    </script> 
    <script>
        function getId(id , img){
             $('#imageid').val(id);
             $('#oldimage').val(img);
        }
    </script>

@endsection
