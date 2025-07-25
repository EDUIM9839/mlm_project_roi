@extends('admin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    <style>
        .textcenter{
            /*text-align:center!important;*/
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
               
            </div>
            <!--end breadcrumb-->
           
            
            <div class="card">
                <div class="card-body">
                    <div class="row"> <div class="col-md-12"><?php echo Session::get('message'); ?></div></div>
                    <div class="table-responsive">
                        <table id="example" class="table dataTable">
                  <thead>
                    <tr class='table-dark'>
                      <th class='textcenter'>S.No.</th>
                      <th class='textcenter'>Package Image</th>
                      <th class='textcenter'>Payment Proof Image</th>
                      <th class='textcenter'>User</th>
                      <th class='textcenter'>User ID</th>
                      <th class='textcenter'>Package</th>
                      <th class='textcenter'>Payment Type</th>
                      <th class='textcenter'>Created Date</th>
                      <th class='textcenter'>Activated Date</th>
                      <th class='textcenter'>Status</th>
                     
                    </tr>
                  </thead>
                    <tbody>
                    <?php 
                        $i=1;
                        foreach($packages as $row){
                           $user=DB::table('user')->where('id', $row->user_id)->get();
                           $userPackage=DB::table('user_package')->where('user_id', $user['0']->id)->get();
                           $Package=DB::table('package')->where('id', $userPackage['0']->package_id)->get();
                           $business_setup=DB::table('business_setup')->get();
                    ?>        
                    <tr>
                        <td class='textcenter'>{{$i++}}</td>
                        <td class='textcenter'><a href="<?php echo asset('assets/packageImages/'.$Package['0']->img)?>" target='_blank'><img src="<?php echo asset('assets/packageImages/'.$Package['0']->img)?>" alt="" style="height:50px;"></a></td>
                         <td class='textcenter'><a href='<?php echo asset('assets/paymentproofImages/'.$userPackage['0']->proof_image)?>' target='_blank'><img src="<?php echo asset('assets/paymentproofImages/'.$userPackage['0']->proof_image)?>" alt="" style="height:50px;"></a></td>
                        <td class='textcenter'><?php echo $user['0']->first_name; ?></td>
                        <td class='textcenter'><?php echo $user['0']->userid;?></td>
                        <td class='textcenter'><?php echo $Package['0']->name; ?><br><small style='color:red'> {{$business_setup['0']->currency_symbol}} {{$Package['0']->cost}}</small></td>
                        <td class='textcenter'> {{$userPackage['0']->payment_type}}</td>
                        <td>{{ Helper::formatted_date($userPackage['0']->created_at)}}</td>
                      <td>{{ Helper::formatted_date($userPackage['0']->activated_date)}}</td>
                       
                        <?php if($userPackage['0']->status=='approved'){ ?>
                          <td class='textcenter' ><button<span class="badge bg-gradient-quepal text-white shadow-sm w-100">Approved</span></button></td>
                        <?php } else if($userPackage['0']->status=='pending'){ ?>
                          <td class='textcenter' ><a class="badge bg-danger" href='{{route("approvedPackage", ['id'=>$userPackage['0']->id])}}' style='font-size: 15px;'>Pending</a></td>
                        <?php } ?>
                      
                    </tr>
                    <?php } ?>
                    </tbody>
                    
</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
