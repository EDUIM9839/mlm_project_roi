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
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                   <div class='col-md-6'>
                       <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{route('subcategory-list')}}" class='badge bg-info'>SubCategory List</a></h6>
                </div>
                </div>
            </div>
            <!--end breadcrumb-->
            
              <div  class="card">
                <div class="card-body p-4">
                    <div class="form-body ">
             <div class="row"> <div class="col-md-12"><?php echo Session::get('message'); ?></div></div>
                    <?php if(!empty($data['0']->id)){?>
                      <form  action="{{route('update_subcategory')}}" method="post" enctype="multipart/form-data">    
                    <?php } else { ?>
                      <form  action="{{route('save_subcategory')}}" method="post" enctype="multipart/form-data">
                    <?php } ?>
                        @csrf
               <div class="border p-4 rounded">
						<div class="row g-6">
                                <div class="col-md-12">
                        <?php if(!empty($data['0']->id)){?>
                                    <label class="form-label">Image:</label>
                                    <input type="file" class="form-control"  name="image"  placeholder="Select Image" id="image">
                                    <input type="hidden" class="form-control" style="border-color:#afa7a7;" value="<?php echo $data['0']->image; ?>" name="oldimage"  id="oldimage">
                                    @error('image')
                                        <small style="color:red;font-size:15px">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        <?php } else { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Image:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-inbox'></i></span>
                                    <input type="file" class="form-control"  name="image"  placeholder="Select Image" id="image">
                                    @error('image')
                                        <small style="color:red;font-size:15px">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php } ?>
                          <?php if(!empty($data['0']->id)){?>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                    <select class='form-control' name='category_id' >
                                        <option value=''>--Select Category--</option>
                                        <?php foreach($categories as $row){?>
                                        <option value='{{$row->id}}'  <?php if($row->id==$data[0]->category_id) { ?>selected<?php } ?>><?php echo $row->category_name ?></option>
                                        
                                        <?php } ?>
                                    </select>
                                    @error('category_id')
                                        <small style="color:red;font-size:15px">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                           <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                    <select class='form-control' name='category_id' >
                                        <option value=''>--Select Category--</option>
                                        <?php foreach($categories as $row){?>
                                        <option value='{{$row->id}}'><?php echo $row->category_name ?></option>
                                        <?php } ?>
                                    </select>
                                   @error('category_id')
                                        <small style="color:red;font-size:15px">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php } ?>
                        <?php if(!empty($data['0']->id)){ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control"  value="<?php echo $data['0']->id; ?>" name="id">
                                <div class="mb-3">
                                    <label class="form-label">SubCategory Name:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                    <input type="text" class="form-control"  name="subcategory_name" value="<?php echo $data['0']->subcategory_name; ?>">
                                    @error('subcategory_name')
                                        <small style="color:red;font-size:15px">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                          <div class="row">
                            <div class="col-md-12">
                                <!--<input type="hidden" class="form-control" style="border-color:#afa7a7;" value="" name="id">-->
                                <div class="mb-3">
                                    <label class="form-label">SubCategory Name:</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='bx bxs-user'></i></span>
                                    <input type="text" class="form-control"  name="subcategory_name" placeholder="">
                                    @error('subcategory_name')
                                        <small style="color:red;font-size:15px">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>    
                        <?php } ?>

 
                        <?php if(!empty($data['0']->id)){ ?>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-danger" style="float: right;background: black;border-color: black;" >Update</button>
                        </div>
                        <?php } else { ?>
                           <div class="mb-3">
                             <button type="submit" class="btn btn-danger" style="float: right;background: green;border-color: green;" >Submit</button>
                        </div>
                        <?php } ?>
                    </form>
                     </div>
            </div>
        </div>
    </div>
                
       
    </div>
@endsection
