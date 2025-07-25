@extends('franchise.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <style>
        .textcenter{
            text-align:center!important;
            vertical-align: middle!important;
        }
         .st-paid{
                background-color: #5ed45e;
                text-transform: capitalize;
                color: #fff;
                padding: 4px;
                border-radius: 11px;
                font-size: 10px;
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
                            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                        </ol>
                    </nav>
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
                                    <th class='textcenter'>Sr.No</th>
                                    <th class='textcenter'>From User</th>
                                    <th class='textcenter'>To User</th>
                                    <!--<th class='textcenter'>Amount</th>-->
                                    <th class='textcenter'>Status</th>
                                    <th class='textcenter'>Payment by</th>
                                    <th class='textcenter'>Invoice No.</th>
                                    <th class='textcenter'>Invoice Date</th>
                                    <th class='textcenter'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @php
                                    $i = 1;
                                
                                @endphp
                                @foreach ($data as $d)
                                   @php  $user=DB::table('user')->where('id', $d->from_id)->get(); @endphp
                                   @php $franchise_user=DB::table('user')->where('id', $d->to_id)->get(); @endphp
                                    <tr>
                                        <td class='textcenter'>{{ $i++ }}</td>
                                        <td class='textcenter'>{{$user['0']->franchise_name}}</td>
                                        <td class='textcenter'>{{$franchise_user['0']->franchise_name}}</td>
                                        <!--<td class='textcenter'>{{Helper::get_currency()}}&nbsp;{{$d->total}}</td>-->
                                        <td class='textcenter'><span class="st-paid">Paid</span></td>
                                        <td class='textcenter'>{{$d->payment_method}}</td>
                                        <td class='textcenter'>{{$d->invoice_no}}</td>
                                        <td class='textcenter'>{{$d->invoice_date}}</td>
                                        <td class='textcenter'>
                                            <div class="btn-group">
                                                        <a  data-bs-toggle="modal" data-bs-target="#exampleLargeModal{{$d->id}}" style='font-size: 25px;' title='Show Product Transfer List'>
                                                            <i class="lni lni-eye"></i>
                                                        </a>&nbsp;&nbsp;&nbsp;
                                                       
                                                        <a href="{{route('stock_transfer_historysss', ['id'=>$d->id])}}" target="_blank" style='font-size: 25px;'>
                                                           <i class="lni lni-files"></i>
                                                        </a>
                                                    </div>
                                                    
                                                     <div class="modal fade" id="exampleLargeModal{{$d->id}}" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title btn btn-success px-5 rounded-0" >Product Transfer List</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    
                                                                    <table class="table table-bordered table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.No.</th>
                                                                            <th>Product Name</th>
                                                                            <th>Quantity</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        
                                                                        @php $j = 1;$jdata=json_decode($d->product_details, 1) @endphp
                                                                        @foreach ((array)$jdata as $row)
                                                                        <tr>
                                                                            <td>{{$j++}}</td>
                                                                            <td>{{$row['name']}}</td>
                                                                            <td>{{$row['quantity']}}</td>
                                                                        </tr>
                                                                          @endforeach
                                                                    </tbody>
                                                                </table>
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                               
                                                                </div>
                                                            </div>
                                                            </div>
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

        <!-- Modal -->
    <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur.</div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
    </div>
@endsection
