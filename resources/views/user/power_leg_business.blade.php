@extends('user.layouts.main')
<style>
    .gradient-blue{
        background: linear-gradient(45deg, #4272e6, #00b5be) !important;
    }

</style>
@section('mains')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
               <h6 class="mb-0 text-uppercase alert">Power Leg Business</h6>
       <hr/>
       
       @if($data['power_available'])
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 mb-3 g-3">
            <div class="col  h-100">
                <div class="card h-100 mb-0 radius-10 border-start border-0 border-4 border-success">
                    
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    
                                    @php
                                        $powerLegUser = DB::table('user')->where('id', $data['power_leg_id'])->first();
                                    @endphp
                                    <p class="mb-2 text-secondary">Power Leg Direct</p>
                                    <h4 class="my-1 text-success">${{ $data['power_self_business'] }}<span class="ms-1" style="font-size: 12px; color: grey;"> Self</span></h4>
                                        <div>
                                           <span class="fw-bold fs-6" >{{ $powerLegUser->first_name . ' ' . $powerLegUser->last_name }}</span>
                                            <span class="ms-1 badge fs-6 bg-success text-dark">{{ $powerLegUser->userid }}</span>
                                        </div>
                                </div>
                                <div class="widgets-icons-2 p-3 ms-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                   <i class='bx bxs-user'></i>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
            <div class="col  h-100">
                <div class="card mb-0 h-100 radius-10 border-start border-0 border-4" style="border-color: #ff6035 !important ;">
                    
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                      <p class="mb-2 text-secondary">Team Business</p>
                                        <h4 class="my-1 text-warning">${{ $data['power_business'] }}<span class="ms-1" style="font-size: 12px; color: grey;"> Team</span></h4>
                                        <div>
                                            
                                             <span class="fw-bold fs-6" >Team : {{ $data['team_member_count'] }} | </span>
                                            <span class="fw-bold fs-6" >Investors : {{ $data['team_with_business'] }}</span>
                                            <!--<span class="ms-1 badge fs-6 bg-warning text-dark">{{ $powerLegUser->userid }}</span>-->
                                        </div>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                    <i class='bx bxs-user-detail'></i>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

          
        </div>
       @endif
            <!-- Scrollable -->
            <div class="card">
              <div class="table-responsive text-nowrap">
                  <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                    <thead>
                 <tr class="table-dark">
                        <th>Sr.No.</th>
                        <th>User</th>
                        <th>Parent</th>
                        <th>Self Business</th>
                </tr>
                    </thead>
             <tbody>
                 
                                     @php
                                    $i = 1;
                                @endphp
                                @foreach ($data['team'] as $d)
                                    @php 
                                        $user = $d['user']; 
                                        
                                        $parent = DB::table('user')->where('userid' , $d['user']->referal)->select('first_name', 'last_name', 'userid')->first();
                                    @endphp
                                
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td class='textcenter'>  {{$user->first_name}} {{$user->last_name}}<br>
                                        @if($user->userid == Auth::user()->userid)
                                         <span class="badge gradient-blue text-white shadow-sm w-80">{{$user->userid}}  </span>
                                        @else
                                        <span class="badge bg-gradient-quepal text-white shadow-sm w-80">{{$user->userid}}  </span>
                                        @endif
                                        </td>
                                      
                                        <td class='textcenter'>  
                                        {{$parent->first_name}} {{$parent->last_name}}<br>
                                        
                                         @if($parent->userid == Auth::user()->userid)                                        
                                        <span class="badge gradient-blue text-white shadow-sm w-40">{{$parent->userid}} </span>
                                        @else
                                        
                                        <span class="badge bg-gradient-quepal text-white shadow-sm w-40">{{$parent->userid}} </span>
                                        @endif
                                        
                                        </td>
                                        <td>{{Helper::get_currency()}}{{ $d['business'] }}</td>
                                        
                                       
                                    </tr>
                                @endforeach
             </tbody>
                        </table>
                
            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection
