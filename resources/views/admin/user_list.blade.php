@extends('admin.layouts.main')

<style>
    
    table th{
        min-width: max-content;
    }
</style>
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
                            <li class="breadcrumb-item active" aria-current="page">User List</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->
            <!--<h6 class="mb-0 text-uppercase alert  ">All User List</h6>-->
           
            <hr />
           <div class="card border-dark p-2">
              <div class="border-dark table-responsive text-nowrap">
                  
                     <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding:5px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>UserId</th>
                                    <th>Mobile No.</th>
                                    <th>Total Investment</th>
                                    <th style="min-width: max-content">Roi Total Recieve</th>
                                    <th>Recieve(%)</th>
                                    <!--<th>Directs</th>-->
                                    <th>Sponser</th>
                                    <th>Joining At</th>
                                    <th>Status</th>
                                     <th>Action</th>
                                     <th>block</th>
                                     
                                </tr>
                            </thead>
                            <tbody>
                                
                                  @php
                          $id = 1; 
                 $total_amount = DB::table('user')
                ->join('income_history', 'user.id', '=', 'income_history.joined_user')
                ->select('user.*', 'income_history.amount')
                ->where('user.id','=', $id)
                ->sum('income_history.amount');

                                  
                                        @endphp
                                
                                
                                 @php
                                    $i = 1;
                                    
                                @endphp
                                @foreach ($data as $datas)
                                
                                @php
                                $userids=$datas->id;
                                
                   $total_direct_recieve = DB::table('user')
                ->join('income_history', 'user.id', '=', 'income_history.received_user')
                ->select('user.*', 'income_history.amount')
                ->where('user.id','=', $userids)
                ->where("credit_debit","credit")
                ->where("type","direct")
                ->sum('income_history.amount');
                
                 $total_level_recieve = DB::table('user')
                ->join('income_history', 'user.id', '=', 'income_history.received_user')
                ->select('user.*', 'income_history.amount')
                ->where('user.id','=', $userids)
                ->where("credit_debit","credit")
                ->where("type","level")
                ->sum('income_history.amount');
                
                
                 $total_roi_recieve = DB::table('user')
                ->join('income_history', 'user.id', '=', 'income_history.received_user')
                ->select('user.*', 'income_history.amount')
                ->where('user.id','=', $userids)
                ->where("credit_debit","credit")
                ->where("type","roi")
                ->sum('income_history.amount');
                
                //$total_amount_recieve=$total_direct_recieve+$total_level_recieve+$total_roi_recieve;
                $total_amount_recieve=$total_roi_recieve;
                
                
                 $total_investment = DB::table('user')
                        ->join('user_package', 'user.id', '=', 'user_package.user_id')
                        ->select('user.*', 'user_package.amount')
                        ->where('user.id','=', $userids)
                        ->where('user_package.status','approved')
                        ->sum('user_package.amount');
                
                
               
                if($total_investment>0 && $total_amount_recieve>0){
                 
                 $earn_percent=($total_amount_recieve/$total_investment)*100;
              
                }else{
                $earn_percent=0;
                }
                
                
                
                @endphp
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$datas->first_name}} {{$datas->last_name}}</td>
                                        <td>
                                            <a href="{{ route('user-login', ['id' => $datas->userid]) }}" > <span class="badge bg-gradient-ohhappiness text-white shadow-sm w-100">{{$datas->userid}}</span></a>
                                        </td>
                                        <td>{{$datas->contact}}</td>
                                        <td>{{$total_investment}}</td>
                                        <td>
                                            {{$total_amount_recieve}}
                                        </td>
                                        <td>{{number_format($earn_percent,2)}}%</td>
                                      
                                 {{--     <td>
                                          @php
                                          
                                          
                                          echo DB::table('user')->join('user_package','user.id','=','user_package.user_id')->where('user.referal',$datas->userid)->where('user_package.status','approved')->count().'direct';
                                          
                                          @endphp
                                          
                                          
                                          
                                      </td>  --}}
                                      
                                      
                                      
                                        <td>{{$datas->referal}}</td>
                                         <td>{{ Helper::formatted_date($datas->created_at) }}</td>
                                              @php
                                $active_inactive=DB::table('user_package')->where('user_id',$datas->id)->where('status','approved')->first();
                                
                                @endphp
                                @if(empty($active_inactive))
                                    <td style="color:red"><b>Inactive</b></td>
                                @else
                                    <td style="color:green"><b>Active</b></td>
                                @endif
                                         
                                          
                                        <td>
                                             <div class="d-flex order-actions">
												<a href="{{ route('user-edit', ['id' => $datas->id]) }}"class=""><i class="bx bxs-edit"></i></a>
											
										
                                            	
                                            <!--<a href="{{ route('user-edit', ['id' => $datas->id]) }}"> <i class='bx bxs-edit' style="font-size: 20px;position: relative;font-weight: bold;color: red;"></i></a>-->
                                            
                                            &nbsp;&nbsp;
                                       <a href="{{ route('user-details', ['id' => $datas->id]) }}" > 
                                       <svg   !important; xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye "><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                       </a>
                                       	</div>
                                       	<!--<a href="" class=""><button type="button" class="btn btn-success my-3" id="btnx">Unblock</button></a>-->
                                       	
                                        </td>
                                        <td>
                                            <!--<form action="{{ route('switch-status') }}" post="post">-->
                                            <div class="form-check form-switch" data-id="{{$datas->id}}">
                                               
                                                <input class="form-check-input " type="checkbox"  role="switch" {{ $datas->block_withdrawl_wallet==1 ? 'checked' : '' }}>
                                            </div>
                                            <!--</form>-->
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
    
    <script>
        // document.querySelectorAll(".switch-checkbox").forEach(element => {
        //     element.addEventListener('change', function(){
        //         let form = element.closest('form');
        //         form.submit();
        //     });
        // });
        
$(document).on("click", ".form-switch", function() {

    var outlet_id = $(this).data('id');
 console.log(this);

    $(this).find("input[type=checkbox]").on("change",function(e) {

        var status = $(this).prop('checked');

        if(status == true) {
            status = 1;
        } else {
            status = 0;
        }

        $.ajax ({
            url: "{{ route('switch-status') }}",
            type: 'POST',              
            data: {"id": outlet_id, "block_status": status, "_token": '{{ csrf_token() }}'},
            success: function(data)
            {   
                if(data.status==true) {
                    swal("Updated", "Status updated successfully", "success");
                } else if(data.status==false) {
                    swal("Failed", "Fail to update status try again", "error");
                }
            },
            error: function(error)
            {
                swal("Failed", "Fail to update status try again", "error");
            }
        });

    });

});
        
    </script>
    
@endsection
