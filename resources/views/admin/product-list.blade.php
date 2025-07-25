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
                <div class="ms-auto">
                    <div class='col-md-6'>
                       <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{route('add-product')}}" class='badge bg-info'>Add Product</a></h6>
                </div>
                </div>
            </div>
            <!--end breadcrumb-->
                         @if (session()->has('success'))
                                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
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
                                    <th class='textcenter'>First Or Repurchase</th>
                                    <th class='textcenter'>Category Name</th>
                                    <th class='textcenter'>Subcategory Name</th>
                                    <th class='textcenter'>MRP</th>
                                    <th class='textcenter'>Product Price</th>
                                    <th class='textcenter'>Business Valuen(  {{Helper::get_business_unit()}})</th>
                                    <th class='textcenter'>Created At</th>
                                    <th class='textcenter'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                    $g = 0;
                                @endphp
                                @foreach ($data as $d)
                                   <?php   $row=DB::table('product_images')->where('pid', $d->id)->get(); //print_r($row['0']->image );?>
                                    <tr>
                                        <td class='textcenter'>{{ $i++ }}</td>
                                        <td class='textcenter'><?php if(!empty($row['0']->id)){?>
                                              <a href="{{ route('edit_images', ['id'=>$d->id]) }}" title="Click to show image">
                                            <img src="{{ asset('productImages') }}{{ '/' }}{{ $row['0']->image }}" class="border" style='padding: 10px;' width="100" height="100"><br>
                                              </a>
                                              <?php } else{ ?>
                                               <a href="{{ route('edit_images', ['id'=>$d->id]) }}" title="Click to show image">
                                              <img src="" alt="Image"><?php } ?>
                                              </a>
                                        </td>
                                        <td class='textcenter' style='width:20px'>{{ ucfirst($d->product_name) }}</td>
                                        <td class='textcenter'>{{ucfirst( $d->first_or_repurchase)}}</td>
                                        <td class='textcenter'>{{ucfirst( $d->category_name) }}</td>
                                        <td class='textcenter'>{{ucfirst( $d->subcategory_name) }}</td>
                                        <td class='textcenter'>{{$bussiness_setup['0']->currency_symbol}}&nbsp;{{ $d->mrp }}</td>
                                        <td class='textcenter'>{{$bussiness_setup['0']->currency_symbol}}&nbsp;{{ $d->dp }}</td>
                                        <td class='textcenter'>{{$d->business_value }}{{Helper::get_business_unit()}}</td>
                                        <td class='textcenter'>{{Helper::formatted_date($d->created_at)}}</td>
                                        <td class='textcenter'>
                                            
                                              <div class="d-flex order-actions">
												<a href="{{ route('edit_product', ['id'=>$d->id]) }}" class=""><i class="bx bxs-edit"></i></a>
												&nbsp;&nbsp;
												<a    class='delete-btn' href="{{ route('delete_product', ['id'=>$d->id]) }}" class="ms-3"><i class="bx bxs-trash"></i></a>
											</div>
											
											
											
                                            <!--<a href="{{ route('edit_product' , ['id'=>$d->id]) }}" class="btn btn-primary"><i class="fa fa-edit" title="Edit" style="font-size:15px"></i></a>&nbsp;&nbsp;-->
                                            <!--<a class="delete-btn" href="{{ route('delete_product' , ['id'=>$d->id] ) }}" class="btn btn-primary"><i class="fa fa-trash" title="Delete" style="font-size:15px"></i></a>-->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
                 
@endsection
