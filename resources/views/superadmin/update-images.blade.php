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
                          <a class='badge bg-info'  data-bs-toggle="modal" onclick="getpId('<?php echo $id; ?>')" data-bs-target="#myModal-1" style="float:right">Upload Bulk Image</a>
                       </h6>
                </div>
            </div>
          
           
            <hr />
            <div class="card" style="text-align: center">
                <div class="card-body">
                <div class="row"> <div class="col-md-12"><?php echo Session::get('message'); ?></div></div>
                    
                <div class="container">
                    
                    <div id="" class="row p-2">
                        <?php  $rows = DB::table('product_images')->where('pid', $id)->get(); if(!empty($rows['0']->id)){ foreach($rows as $row){?>
                        <div class="col-md-3 mb-4 " > 
                            <div class="border" style='padding: 10px;'>
                               <img class="rounded-3" src="{{ asset('productImages') }}{{ '/' }}{{ $row->image }}" alt="" width="150" height="150" />
                               <div class='row mt-4'>
                                   <div class='col-md-6'>
                                       <a class='badge bg-success'  style="float:right;font-size:15px" data-bs-toggle="modal" data-bs-target="#myModal" onclick="getId('<?php echo $row->id; ?>' , '<?php echo $row->image; ?>')">Update</a>
                                   </div>
                                   <div class='col-md-6'>
                                       <a  class='badge bg-danger'  style="float:left;font-size:15px" href="{{ route('deleteProductImage', ['id'=>$row->id]) }}">Delete</a>
                                    </div>
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
          <h4 class="modal-title">Select Image</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('updateImage') }}" method="post" enctype="multipart/form-data"> 
            @csrf 
        <!-- Modal body -->
        <div class="modal-body">
        
          <input type="hidden" id="imageid"  name="imageid" class="form-control" >
          <input type="hidden" class="form-control" name="oldimage" id="oldimage" >  
           <input type="file" class="form-control" name="image" >
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
              <h4 class="modal-title">Select Image</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('uploadBulkImage') }}" method="post" enctype="multipart/form-data"> 
                @csrf 
            <!-- Modal body -->
            <div class="modal-body">
            
              <input type="hidden" id="pid"  name="pid" class="form-control" >
             
               <input type="file" class="form-control" name="image[]" multiple >
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
