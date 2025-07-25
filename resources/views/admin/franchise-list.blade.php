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
                       <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{route('add-franchise')}}" class='badge bg-info'>Add Franchise</a></h6>
                </div>
                </div>
            </div>
            <!--end breadcrumb-->
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
          
            <div class="card">
              <div class="table-responsive text-nowrap">
                    <!--<div class="row"> <div class="col-md-12"><?php echo Session::get('message'); ?></div></div>-->
                     <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                               <tr class='table-dark'>
                                    <th style="text-align: center;vertical-align: middle;">Sr.No</th>
                                    <th style="text-align: center;vertical-align: middle;" >Owner Name</th>
                                    <th style="text-align: center;vertical-align: middle;">Franchise Name</th>
                                    <th style="text-align: center;vertical-align: middle;">Mobile/Email</th>
                                    <th style="text-align: center;vertical-align: middle;">Wallet</th>
                                    <th style="text-align: center;vertical-align: middle;">Created At</th>
                                    <th style="text-align: center;vertical-align: middle;">Status</th>
                                    <th style="text-align: center;vertical-align: middle;">Stock Transferable Status</th> 
                                    <th style="text-align: center;vertical-align: middle;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($data as $d)
                                    <tr>
                                        <td style="text-align: center;vertical-align: middle;">{{ $i++ }}</td>
                                        <td style="text-align: center;vertical-align: middle;">{{ $d->first_name }}<br>
                                            <a href="{{ route('FranchiseListOfFranchise', ['referal'=>$d->userid]) }}" 
                                              <span class="badge bg-gradient-quepal text-white shadow-sm w-100">{{ $d->userid }}</span>
                                            </a>
                                        </td>
                                        <td style="text-align: center;vertical-align: middle;">{{ $d->name }}</td>
                                        <td style="text-align: center;vertical-align: middle;">{{ $d->contact }} / {{ $d->email }}</td>
                                      
                                        <td style="text-align: center;vertical-align: middle;">{{ $d->saving_wallet }}</td>
                                        <!--<td style="text-align: center;vertical-align: middle;">{{ $d->created_at }}</td>-->
                                        <td style="text-align: center;vertical-align: middle;">{{ Helper::formatted_date($d->created_at)}}</td>
                                        
                                        <td class='textcenter'>
                                           <?php if($d->status==1){?>
                                              <a href="{{route('changeStatus', ['id'=>$d->id, 'status'=>$d->status, 'table'=>'user', 'redirectUrl'=>'franchise-list'])}}">  
                                                   <img src="{{ asset('assets/categoryImages') }}{{'/'}}{{ 'open.jpg' }}"  width="50" height="" />
                                              </a>
                                           <?php } else { ?>
                                               <a href="{{route('changeStatus', ['id'=>$d->id, 'status'=>$d->status, 'table'=>'user', 'redirectUrl'=>'franchise-list'])}}">  
                                                   <img src="{{ asset('assets/categoryImages') }}{{'/'}}{{ 'close.jpg' }}" width="50" height="" />
                                              </a>
                                           <?php } ?>
                                        </td>
                                        <td style="text-align: center;vertical-align: middle;">
                                              <?php if($d->stock_transferable_status==1){?>
                                              <a href="{{route('changeStatuss', ['id'=>$d->id, 'stock_transferable_status'=>$d->stock_transferable_status, 'table'=>'user', 'redirectUrl'=>'franchise-list'])}}">  
                                                   <img src="{{ asset('assets/categoryImages') }}{{'/'}}{{ 'open.jpg' }}"  width="50" height="" />
                                              </a>
                                           <?php } else { ?>
                                               <a href="{{route('changeStatuss', ['id'=>$d->id, 'stock_transferable_status'=>$d->stock_transferable_status, 'table'=>'user', 'redirectUrl'=>'franchise-list'])}}">  
                                                   <img src="{{ asset('assets/categoryImages') }}{{'/'}}{{ 'close.jpg' }}" width="50" height="" />
                                              </a>
                                           <?php } ?>
                                        </td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            
                                            
                                            <div class="d-flex order-actions">
												<a href="{{ route('edit-franchise', ['id'=>$d->id]) }}" class=""><i class="bx bxs-edit"></i></a>
												&nbsp;&nbsp;
												<a class='delete-btn' href="{{ route('delete-franchise', ['id'=>$d->id]) }}" class="ms-3"><i class="bx bxs-trash"></i></a>
											</div>
											
											
                                             
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
