@extends('admin.layouts.main')
@section('mains')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--start page wrapper -->
    <style>
        .textcenter{
            text-align:center!important;
            vertical-align: middle!important;
        }
    </style>
    <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                       <h6 class="mb-0 text-uppercase" style='float:right;'> <a href="{{route('add-category')}}" class='badge bg-info'>Add Category</a></h6>
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
                   <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table  no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                              <tr class='table-dark'>
                                    <th class='textcenter'>Sr.No</th>
                                    <th class='textcenter'>Category Image</th>
                                    <th class='textcenter'>Category Name</th>
                                    @if($bussiness_setup[0]->category_commission==1)
                                    <th class='textcenter'>Category Commission</th>
                                    @endif
                                    <th class='textcenter'>Created At</th>
                                    <th class='textcenter'>Status</th>
                                    <th class='textcenter'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($data as $da)
                                    <tr>
                                        <td class='textcenter'>{{ $i++ }}</td>
                                        <td class='textcenter'><img src="{{ asset('assets/categoryImages') }}{{'/'}}{{ $da->category_image }}" class="border" style='padding: 10px;' width="100" height="100" /></td>
                                        <td class='textcenter'>{{ $da->category_name }}</td>
                                        @if($bussiness_setup[0]->category_commission==1)
                                        <td class='textcenter'>{{ $da->category_commission }}</td>
                                        @endif
                                        <td  class='textcenter'>{{ Helper::formatted_date($da->created_at)}}</td>
                                        <!--<td class='textcenter'>{{ $da->created_at }}</td>-->
                                       <td class='textcenter'>
                                           <?php if( $da->status==1){?>
                                              <a href="{{route('changeStatus', ['id'=>$da->id, 'status'=>$da->status, 'table'=>'categories', 'redirectUrl'=>'category-list'])}}">  
                                                   <img src="{{ asset('assets/categoryImages') }}{{'/'}}{{ 'open.jpg' }}"  width="50" height="" />
                                              </a>
                                           <?php } else { ?>
                                               <a href="{{route('changeStatus', ['id'=>$da->id, 'status'=>$da->status, 'table'=>'categories', 'redirectUrl'=>'category-list'])}}">  
                                                   <img src="{{ asset('assets/categoryImages') }}{{'/'}}{{ 'close.jpg' }}" width="50" height="" />
                                              </a>
                                           <?php } ?>
                                       </td>
                                    <!--<td><input data-id="{{$da->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $da->status ? 'checked' : '' }}></td>-->
                                    
                                        <td class='textcenter'>
                                            
                                              <div class="d-flex order-actions">
												<a href="{{ route('edit_category', ['id'=>$da->id]) }}" class=""><i class="bx bxs-edit" ></i></a>
                                            
                                            
                                            <!--<a href="{{ route('edit_category', ['id'=>$da->id]) }}">-->
                                            <!--<i class="fadeIn animated bx bx-pencil" title="Edit" style="font-size:35px"></i></a>-->
                                            <!--<a href="{{ route('delete_category', ['id'=>$da->id]) }}">-->
                                            <!--<i class="fadeIn animated bx bx-trash-alt" title="Delete" style="font-size:25px"></i></a>-->
                                        </td>
                                        
                                        <!--<td>-->
                                        <!--    <input data-id=" " class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="active" data-off="inactive" >-->
                                        <!--</td>-->
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
       $(document).ready(function(){
          $("#d").DataTable() 
       });
       $(function(){
           $('.toggle-class').change(function(){
           var status = $(this).prop('checked') == true ? 1 :0;
           var id = $(this).data('id');
           console.log(id);
           $.ajax({
          type: "GET",
          dataType: "json",
          url: '/changeStatus',
          data: {'status': status, 'id': id},
          success: function(data){
            console.log(data.success)
          }
       });
       });
    </script>





 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 

@endsection
