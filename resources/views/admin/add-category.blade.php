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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class='col-md-6'>
                        <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{ route('category-list') }}"
                                class='badge bg-info'>Category List</a></h6></br><br>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <hr />

            <div class="card">
                <div class="card-body p-4">

                    <div class="form-body ">
                        
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
                                
                        <form <?php if(!empty($data['0']->id)){?> action="{{ route('update_category') }}" <?php } else{?>
                            action="{{ route('save_category') }}" <?php }?> method="post"
                            enctype="multipart/form-data">
                            @csrf


                            <div class="border p-4 rounded">
                                <div class="row g-6">
                                  <div class="row ">
                                    <div class="col-md-12">
                                        <label class="form-label">Image:</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='bx bxs-inbox'></i></span>
                                            <input type="file" class="form-control" 
                                                name="category_image" placeholder="Enter Category Image"
                                                id="category_image">
                                            <input type="hidden" class="form-control" 
                                                value="<?php if(!empty($data['0']->id)){?>{{ $data['0']->category_image }}<?php } ?>"
                                                name="category_oldimage" id="category_oldimage"></br>
                                        </div>
                                            @error('category_image')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
                                            @enderror
                                    </div>
                                  </div>

                                   
                            
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control" 
                                                value="<?php if(!empty($data['0']->id)){?>{{ $data['0']->id }}<?php } ?>"
                                                name="id">
                                            <div class="mb-3">
                                                <label class="form-label mt-3">Name:</label>
                                                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                            class='bx bxs-user'></i></span>
                                                    <input type="text" class="form-control" 
                                                        value="<?php if(!empty($data['0']->id)){?>{{ $data['0']->category_name }}<?php } ?>{{ old('category_name') }}"
                                                        name="category_name" placeholder="Enter Category Name"
                                                        id="category_name">
                                                </div>
                                                    @error('category_name')
                                                        <small style="color:red;font-size:15px">{{ $message }}</small>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <?php if(!empty($bussiness_setup['0']->category_commission)){?>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Commission (%):</label>
                                            <input type="text" class="form-control" 
                                                name="category_commission"
                                                value="<?php if(!empty($data['0']->id)){?>{{ $data['0']->category_commission }}<?php } ?>{{ old('category_commission') }}"
                                                placeholder="Enter Category Commission" id="category_commission">
                                            @error('category_commission')
                                                <small style="color:red;font-size:15px">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="mb-5">
                                    <button type="submit" class="btn btn-primary"
                                        style="float: right;margin-right:25px;">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
  
@endsection
