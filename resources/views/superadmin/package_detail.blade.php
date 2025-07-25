
@extends('admin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center">
                
                <div class="ms-auto">
                    <div class="btn-group">
                      
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                                href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                                link</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class='row'>
            <div class='col-md-6'>
            <h6 class="mb-0 text-uppercase">{{$subtitle}}</h6>
            </div>
            <div class='col-md-6'>
            <h6 class="mb-0 text-uppercase" style='float:right'><a href="{{route('package_list')}}" class='badge bg-info'>Package List</a></h6>
            </div>
            </div>
            <hr />
            <div class="card">
                <div class="card-body">
                    
                    <div class="row"> 
                        <div class="col-md-12"><?php echo Session::get('message'); ?></div>
                    </div>
                    
                    <div class="row"> 
                           <?php if(!empty($data['0']->id)){ ?><form action="{{route('update_package')}}" method="post"  enctype="multipart/form-data"><?php } else { ?><form action="{{route('add_package')}}" method="post" enctype="multipart/form-data"><?php } ?>
                            @csrf
                            <div class="form-group">
                            <label for="package_name">Package Name:</label>
                            <?php if(!empty($data['0']->id)){ ?>
                              <input type="hidden" name="id" class="form-control" value="<?php echo $data['0']->id; ?>" >
                              <input type="text" name="package_name" class="form-control" value="{{$data['0']->name}}" >
                            <?php } else { ?>
                             <input type="text" name="package_name" class="form-control" value='{{old("package_name")}}' placeholder="Enter package name">
                            <?php } ?>
                           
                             @error('package_name')
                             <small style='color:red'>{{$message}}</small>
                             @enderror
                            </div>
                            
                            <br>
                            
                            <div class="form-group">
                            <label for="package_name">Package Image:</label>
                            <?php if(!empty($data['0']->id)){ ?>
                              <input type="hidden" name="oldimage" class="form-control" value="{{$data['0']->img}}" > 
                             <div class="input-group"> 
                                 <span class="input-group-text bg-transparent"><i class="bx bxs-image"></i></span>
                                 <input type="file" name="image" class="form-control">
                                
                             </div>
                            <?php } else { ?>
                             <div class="input-group"> 
                                 <span class="input-group-text bg-transparent"><i class="bx bxs-image"></i></span>
                                 <input type="file" name="image" class="form-control">
                             </div>
                            <?php } ?>
                           
                             @error('package_name')
                             <small style='color:red'>{{$message}}</small>
                             @enderror
                            </div>
                            
                            <br>
                            
                            <div class="form-group" style="margin-top: 10px;">
                            <label for="cost">Package Cost:</label>
                           
                            <?php if(!empty($data['0']->id)){ ?>
                                <input type="text" name="cost" class="form-control" value="{{$data['0']->cost}}" >
                            <?php } else { ?>
                              <input type="text" name="cost" class="form-control" value='{{old("cost")}}' placeholder="Enter package cost">
                            <?php } ?>
                            @error('cost')
                              <small style='color:red'>{{$message}}</small>
                            @enderror
                            </div>
                            <?php if(!empty($data['0']->id)){ ?>
                               <button type="submit" class="btn btn-danger" style="float: right;background: black;border-color: black;margin-top:10px">Update</button>
                            <?php } else { ?>
                               <button type="submit" class="btn btn-danger" style="float: right;background: black;border-color: black;margin-top:10px">Upload</button>
                            <?php }  ?>
                           
                        </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

