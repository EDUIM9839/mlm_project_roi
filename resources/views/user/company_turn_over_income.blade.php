@extends('user.layouts.main')
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
                            <li class="breadcrumb-item active" aria-current="page">Company Turn Over Income</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
           
                 
                <div class="card">
              <div class="table-responsive text-nowrap">
                         <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class="table-dark">
                                    <th>Sr No</th>
                                   
                                    <th>Type</th>
                                    <th>Reward Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($company_turn_over_income as $d)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <!--<td>{{ $d->first_name }}  {{ $d->last_name }}</td>-->
                                        <!--<td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">{{ $d->userid }}</span>-->
                                        <!--</td>-->
                                         <td>{{$d->type}}</td>
                                        <td>{{Helper::get_currency()}}{{number_format($d->amount,2) }}</td>
                                       
                                        <td>{{date('d-M-Y', strtotime($d->date)); }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection
