@extends('user.layouts.main')
@section('mains')
   <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            
            <h6 class="mb-0 text-uppercase alert  ">My Team</h6>
           
            <hr />
           <div class="card border-dark">
              <div class="border-dark table-responsive text-nowrap">
                   
                     <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding:5px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>UserId</th>
                                     <th>Level</th>
                                    <th>Status</th>
                                   
                                   
                                </tr>
                            </thead>
                            <tbody>
                               @php $i=1; @endphp
                            @foreach($team as $key=>$tu)
                               
                               
                               @foreach($tu as $t)
                                 <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$t->first_name}} {{$t->last_name}}</td>
                                        <td>{{$t->userid}}  </td>
                                        <td> {{$key+1}}</td>
                                        <td> 
                                        
                                        @php 
                                        if(DB::table('user_package')->where('status','approved')->where('user_id',$t->id)->exists()){
                                        
                                          echo "<span class='text text-success'>Active</span>";
                                        }else{
                                           echo "<span class='text text-danger'>Inactive </span>";
                                        }
                                        
                                        @endphp
                                        </td> 
                                         
                                        
                                    </tr>
                                    
                                    
                                @endforeach
                            @endforeach
                               
                                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
