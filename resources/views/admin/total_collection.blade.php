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
                            <li class="breadcrumb-item active" aria-current="page">Total Collection List</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
               <div class="card">
					<div class="card-body">
					    <form action="{{route('collection_filter')}}" method='post'>
					        @csrf
    					    <div class='row'>
    							    <input type='hidden' class='form-control' value="user_package" name='tablename'  >
    							   
    							    <div class='col-md-4'>
    							         <lable>FromDate</lable>
    							        <input type='text' class='form-control datepicker'   value="{{$fromdate}}{{old('fromdate')}}" name='fromdate' placeholder='From Date' >
    							         @error('fromdate')
    							         <small style='color:red'>{{$message}}</small>
    							         @enderror
    							     </div>
    							     
    							    <div class='col-md-4'>
    							        <lable>ToDate</lable>
    							        <input type='text' class='form-control datepicker'  value="{{$todate}}{{old('todate')}}" name='todate' placeholder='To Date'>
    							        @error('todate')
    							         <small style='color:red'>{{$message}}</small>
    							         @enderror
    							     </div>
    							     
    							    <div class='col-md-2'>
    							         
    							        <button style="margin-top:20px;" type="submit"   class="btn btn-info px-5">Search</button>
    							     </div>
    							    <div class='col-md-2'> 
    							     <button style="margin-top:20px;" type="button"  id="myBtn" onclick="alluser()" class="btn btn-success px-3 ">All </button>
    							     </div>
    						</div>
						</form>
					
					</div>
				</div>
		<div style="text-align: right;">
    @if(isset($total_amount))
        <h5><b>Total Amount:</b> {{ Helper::get_currency() }}{{ $total_amount }}</h5>
    @else
        @php
            $total_collections = DB::table('user_package')->where('status', 'approved')->sum('amount');
        @endphp
        <h5><b>Total Amount:</b> {{ Helper::get_currency() }}{{ $total_collections }}</h5>
    @endif
</div>

 
				
           <div class="card">
              <div class="table-responsive text-nowrap">
               
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                       <table class="table dataTable no-footer" id="example" aria-describedby="example_info">
    @if(isset($total_collection))
        <thead>
            <tr class='table-dark'>
                <th>Sr.No</th>
                <th>Username</th>
                <th>Amount</th>
                <th>Activation Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($total_collection as $key => $au)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $au->first_name }} {{ $au->last_name }}<br>
                        <span class="badge bg-gradient-ohhappiness text-white shadow-sm w-50">{{ $au->userid }}</span>
                    </td>
                    <td>{{ Helper::get_currency() }}{{ $au->amount }}</td>
                    <td>{{ Helper::formatted_date($au->activated_date) }}</td>
                </tr>
            @endforeach
            <tr>
                <td>{{ count($total_collection) + 1 }}</td>
                <td>---</td>
                <td>
                    @if(isset($total_amount))
                        <h5><b>Total Amount:</b> {{ Helper::get_currency() }}{{ $total_amount }}</h5>
                </td>
                <td>---</td>
                @else
                <td>
                      @php 
                            $total_collections= DB::table('user_package')->where('status','approved')->sum('amount'); 
                                        @endphp
                    
                        <h5><b>Total Amount :</b> {{ Helper::get_currency() }}{{ $total_collections }}</h5>
                    @endif
                   
                </td>
            </tr>
        </tbody>
    @endif
</table>

                  
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
       <script>
function alluser() {
  location.href = "{{route('total_collection')}} ";
}
</script>   
@endsection
