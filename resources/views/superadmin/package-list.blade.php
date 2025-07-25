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
                            <li class="breadcrumb-item active" aria-current="page">{{$subtitle}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class='col-md-6'>
                      <h6 class="mb-0 text-uppercase" style='float:right' ><a href="{{route('package_detail')}}" class='badge bg-info'>Add Package</a></h6>
                </div>
                </div>
            </div>
            <!--end breadcrumb-->
            
             
           <div class="card">
              <div class="table-responsive text-nowrap">
                    <div class="row"> <div class="col-md-12"><?php echo Session::get('message'); ?></div></div>
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th class='textcenter'>Sr.No</th>
                                    <th class='textcenter'>Package image</th>
                                    <th class='textcenter'>Package Name</th>
                                    <th class='textcenter'>Package Cost</th>
                                    <th class='textcenter'>Status</th>
                                    <th class='textcenter'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($packages as $d)
                                    <tr>
                                        <td class='textcenter'>{{ $i++ }}</td>
                                         <td class='textcenter'><img src="{{ asset('assets/packageImages') }}{{'/'}}{{ $d->img }}" width="100" height="100" /></td>
                                        <td class='textcenter'>{{ $d->name }}</td>
                                        
                                        <td class='textcenter'>{{ $d->cost }}</td>
                                        <td class='textcenter'>
                                            
                                          
                                            
                                            <?php if( $d->status==1){?>
                                              <a href="{{route('changeStatus', ['id'=>$d->id, 'status'=>$d->status, 'table'=>'package', 'redirectUrl'=>'package_list'])}}">  
                                                   <img src="{{ asset('assets/categoryImages') }}{{'/'}}{{ 'open.jpg' }}" width="50" height="" />
                                              </a>
                                           <?php } else { ?>
                                               <a href="{{route('changeStatus', ['id'=>$d->id, 'status'=>$d->status, 'table'=>'package', 'redirectUrl'=>'package_list'])}}">  
                                                   <img src="{{ asset('assets/categoryImages') }}{{'/'}}{{ 'close.jpg' }}" width="50" height="" />
                                              </a>
                                           <?php } ?>
                                            
                                        </td>
                                        <td class='textcenter'><a href="{{ route('edit_package', ['id'=>$d->id]) }}"><i class="fa fa-edit" title="Edit" style="font-size:15px"></i></a>&nbsp;&nbsp;<a href="{{ route('delete_package', ['id'=>$d->id]) }}"><i class="fa fa-trash" title="Delete" style="font-size:15px"></i></a></td>
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
