@extends('admin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <style>
        .textcenter{
            text-align:center!important;
            vertical-align: middle!important;
        }
    </style>
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
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                        </ol>
                    </nav>
                </div>
              
            </div>
            <!--end breadcrumb-->
             
               <div class="card">
              <div class="table-responsive text-nowrap">
                    <div class="row"> <div class="col-md-12"><?php echo Session::flash('message'); ?></div></div>
                     <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                              <tr class='table-dark'>
                                    <th class='textcenter' >Sr.No</th>
                                    <th class='textcenter'>Product Image</th>
                                  
                                    <th class='textcenter'>Product Name</th>
                                    <th class='textcenter'>MRP</th>
                                    <th class='textcenter'>Discount (%)</th>
                                    <th class='textcenter'>First Purchase Price</th>
                                    <th class='textcenter'>Re Purchase Price</th>
                                    <th class='textcenter'>Business Value</th>
                                    <th class='textcenter'>Created At</th>
                                    <th class='textcenter'>Updated At</th>
                                    <th class='textcenter'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <!--@php-->
                                <!--    $i = 1;-->
                                <!--@endphp-->
                                <!--@foreach ($data as $d)-->
                                   <?php   //$row=DB::table('product_images')->where('pid', $d->id)->get(); //print_r($row['0']->image );?>
                                    <tr>
                                        <td class='textcenter'></td>
                                        <td class='textcenter'></td>
                                        
                                        <td class='textcenter'></td>
                                        <td class='textcenter'></td>
                                        <td class='textcenter'></td>
                                        <td class='textcenter'></td>
                                        <td class='textcenter'></td>
                                        <td class='textcenter'></td>
                                        <td class='textcenter'></td>
                                        <td class='textcenter'></td>
                                      
                                        <td class='textcenter'><a href=""><i class="fa fa-edit" title="Edit" style="font-size:15px"></i></a>&nbsp;&nbsp;<a href=""><i class="fa fa-trash" title="Delete" style="font-size:15px"></i></a></td>
                                    </tr>
                                <!--@endforeach-->
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal-1">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Update Image</h4>
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
@endsection
