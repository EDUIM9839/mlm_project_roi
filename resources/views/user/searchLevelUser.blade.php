@extends('user.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            
             <h6 class="mb-0 text-uppercase alert  ">Level User List</h6>
           
         <hr/>
          
            <div class="card">
                
                <div class="color-sidebar sidebarcolor8 color-header headercolor2">
                                <div class="card p-3 m-4" style="text-align:center; color:white;">
                                <h3 style="color:black!important" class="p-0 text-light">Total Downline: On Going</h3>
                                <!-- <div class="row">
                                    <div class="col-sm-6">Total Left: 0</div>
                                    <div class="col-sm-6">Total Right: 0</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Today left business: 0</div>
                                    <div class="col-sm-6">Today right business: 0</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">Total left business: 0</div>
                                    <div class="col-sm-6">Total right business: 0</div>
                                </div>
                                <div class="row">


                                </div> -->
                            </div>
                            <!--<div class="col-md-2 reload-button" style="top:105px;position:absolute;left:20px;">-->
                            <!--    <button class="btn btn-success" onclick="location.reload()">Reload</button>-->
                            <!--</div>-->
                            <div id="orgChartContainer">
                                <div id="orgChart"></div>
                                </div></br>
            </div>
            <div class="table-responsive text-nowrap">
            <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
            <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                <thead>
                    <tr class="table-dark">
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width: 46.9844px;">Sr.No.</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 76.1562px;">User Id</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 209.875px;">Name</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 94.0156px;">Status</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 94.0156px;">Join Date</th>
                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Downline: activate to sort column ascending" style="width: 94.0156px;">Downline</th>
                    </tr>
                </thead>
             <tbody>
                <?php
                 
                 if(count($userid)>0){
                     
                
                ?> 
                @php
                $i=1;
                @endphp
                <?php 
                    
                      foreach($userid as $row){
                          
                         $res=DB::table('user')->where('userid', $row)->get();      
                        
                
                
                 ?>
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$res['0']->userid}}</td>
                        <td>{{$res['0']->first_name}} {{$res['0']->last_name}}</td>
                        <td>{!!Helper::check_active_inactive($res['0']->id,true) !!}</td>
                        <td>{{ Helper::formatted_date($res['0']->created_at)}}</td>
                        <td><a href="{{route('downline').'?userid='.$res['0']->userid}}">Downline</a></td>
                    </tr>
                <?php } ?>
                <?php } else { ?>
                @php
                $i=1;
                @endphp
                @foreach($referal as $value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$value->userid}}</td>
                        <td>{{$value->first_name}} {{$value->last_name}}</td>
                        <td>{!!Helper::check_active_inactive($value->id,true) !!}</td>
                        <td>{{ Helper::formatted_date($value->created_at)}}</td>
                        <td><a href="{{route('downline').'?userid='.$value->userid}}">Downline</a></td>
                    </tr>
                @endforeach
                
                <?php } ?>
             </tbody>
            </table>
                
            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content --> 
        </div>
            <!--  -->
        </div>
    </div>      
@endsection
