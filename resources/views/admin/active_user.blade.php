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
                            <li class="breadcrumb-item active" aria-current="page">Active User List</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!--end breadcrumb-->
            <!--  -->
            <!--<h6 class="mb-0 text-uppercase">Active User List</h6>-->
            <!--<hr />-->
           <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        
                        <div class="container mt-3 mb-4">
                            
                            
                            <div class="my-2" style="display: none;">
                                <h5> Filter </h5>
                              <div class="form-check form-check-inline">
                                  
                                  <label class="form-check-label" for="inlineRadio1" >
                                      <input class="form-check-input dateRange" type="radio" name="dateRange" id="alldateRangesRadioBtn" value="option1" checked>All</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  
                                  <label class="form-check-label" for="dateRangeRadioBtn">
                                      <input class="form-check-input dateRange" type="radio" name="dateRange" id="dateRangeRadioBtn" value="option2">
                                      
                                      Date Range</label>
                                </div>
                            </div>
                            
                            <div id="date-pick-zone" style="display:none;">
                                 <div class="row g-3">
                                  <div class="input-group flex-nowrap col">
                                      <span class="input-group-text" id="addon-wrapping">From</span>
                                      <input type="date" class="form-control datePickerFrom" max="{{ date("Y-m-d") }}" placeholder="from">
                                    </div>
                                      <div class="input-group flex-nowrap col">
                                      <span class="input-group-text " id="addon-wrapping" >&nbsp;&nbsp;To&nbsp;&nbsp;</span>
                                      <input type="date" class="form-control datePickerTo" max="{{ date("Y-m-d") }}" placeholder="to">
                                    </div>
                                </div>
                                
                            </div>
                        
                        </div>
                    
                    
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>User Id</th>
                                    <th>Amount</th>
                                    <th>Payment Type</th>
                                    <th>Proof of Payment</th>
                                    <th>Status</th>
                                     <th>Date</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($data as $au)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$au->first_name}} {{$au->last_name}}</td>
                                        <td><span
                                            class="badge bg-gradient-ohhappiness text-white shadow-sm w-100">{{ $au->userid }}</span></td>
                                       <td>{{Helper::get_currency()}}{{ $au->amount}}</td>
                                          <td>{{ ucfirst($au->payment_type)}}</td>
                                           <td>@if($au->payment_type=="barcode")<a href="{{ Storage::url('app/proof_of_payment/').$au->proof_image}}" target="_blank"><img src="{{ Storage::url('app/proof_of_payment/').$au->proof_image}}" style="width: 80px; height: 80px;"></a>@endif</td>
                                        <td style="color:green"> <b>{{ucfirst($au->status)}} </b> </td>
                                             <td>{{Helper::formatted_date($au->activated_date)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
     
      
       
      
      
        let dateRange = document.querySelectorAll(".dateRange");
        
        
        dateRange.forEach(element => {
            element.addEventListener("change", (e)=>{
                $("#date-pick-zone").slideToggle(200);
                    document.querySelector(".datePickerFrom").value="";
                    document.querySelector(".datePickerTo").value="";
            });
        });
        
        document.querySelector("#alldateRangesRadioBtn").addEventListener('change', function(e){
            if(this.checked){
                var table = $('#example').DataTable();
                $.fn.dataTable.ext.search = [];
                table.draw();
            }
            
        });
        
        let from = document.querySelector(".datePickerFrom");
        let to = document.querySelector(".datePickerTo");

        from.addEventListener('change', (e)=>{
            to.setAttribute('min' , from.value);
            updateTheTable();
        });
        to.addEventListener('change', (e)=>{
            from.setAttribute('max', to.value);
            updateTheTable();
        });
        
       function updateTheTable() {
            var table = $('#example').DataTable();
        
            let fromTime = new Date(document.querySelector(".datePickerFrom").value).getTime();
            let toTime = new Date(document.querySelector(".datePickerTo").value).getTime();
        
            $.fn.dataTable.ext.search = [];
        
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var joinedDate = data[4];
                    var joinedTime = getTimeFromDate(joinedDate);
                    var activatedDate = data[5];
                    var activatedTime = getTimeFromDate(activatedDate);
        
                    if (isNaN(fromTime)) fromTime = -Infinity;
                    if (isNaN(toTime)) toTime = Infinity;
        
                    if ((!joinedTime && !activatedTime) ||
                        (((fromTime - 86400000) <= joinedTime) && !toTime) ||
                        (!fromTime && (toTime >= activatedTime)) ||
                        (((fromTime - 86400000) <= joinedTime) && (toTime >= activatedTime))) {
                        return true;
                    } else {
                       return false;
                    }
                }
            );
        
            table.draw();
        }

        function getTimeFromDate(d) {
            var dateParts = d.split("-");
            var day = parseInt(dateParts[0], 10);
            var month = new Date(dateParts[1] + " 1, 2024").getMonth();
            var year = parseInt(dateParts[2], 10);
            var parsedDate = new Date(year, month, day);
            return isNaN(parsedDate.getTime()) ? null : parsedDate.getTime();
        }


        
    </script>
    
    
@endsection
