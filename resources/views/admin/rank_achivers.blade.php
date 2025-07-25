@extends('admin.layouts.main')
@section('mains')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<style>
   thead{
    align:center;
   }
#label{
        font-weight:500;
    }
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 4px;
}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  background-color: white;
  color: black;
}
td,th,tr,tbody{
text-align:center;
}
#edit{
    /* text-align:left !important; */
    width: 20% !important;
}

.pen body {
	padding-top:50px;
}

/* MODAL FADE LEFT RIGHT BOTTOM */

.modal.fade:not(.in).right .modal-dialog {
	-webkit-transform: translate3d(25%, 0, 0);
	transform: translate3d(25%, 0, 0);
}
.modal.fade:not(.in).bottom .modal-dialog {
	-webkit-transform: translate3d(0, 25%, 0);
	transform: translate3d(0, 25%, 0);
}

.modal.right .modal-dialog {
	position:absolute;
	top:0;
	right:0;
	margin:0;
}

.modal-content, .modal.right .modal-content {
	min-height:10vh;
	border:0;
}
.btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    border-radius: 35px;
    font-size: 24px;
    line-height: 1.33;
}

.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}
</style>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Rank Achivers</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User List</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->
            <!--  -->
            <div class="content-wrapper">

          <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Scrollable -->
        <div class="card">
            <div class="table-responsive text-nowrap">
                <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px";>
                    
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                       
                        <thead>
                                    <tr class="table-dark">
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column descending" style="width: 46.9844px;">Id</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Userid: activate to sort column ascending" style="width: 76.1562px;">Userid</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 76.1562px;">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Reward Name: activate to sort column ascending" style="width: 209.875px;">Reward Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Achieved Date: activate to sort column ascending" style="width: 144.797px;">Achieved Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Joining Date: activate to sort column ascending" style="width: 165.172px;">Joining Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Profile Pic: activate to sort column ascending" style="width: 94.0156px;">Profile Pic</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending"  >Send Wishes</th>
                                    </tr>
                                </thead>
                                <tbody>
                             @foreach($data as $item)
                          <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->userid}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->rank_name}}</td>
                                <td>{{$item->achived_date}}</td>
                                <td>{{$item->joining_date}}</td>
                                <td><img src="{{ Storage::url('app/profileupload/').$item->profile_pic}}" style="height: 50px;width:70px;"></td>
                                <td>
                                   <div>
                                        <a  data-id="#messagemodal" href="" data-bs-target="#messagemodal" data-bs-toggle="modal">
                                            <b  onclick="openSendwishes('<?php echo $item->userid; ?>');">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-chat-text-fill" viewBox="0 0 16 16"> 
                                        <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z"/></svg>
    </a>
                                    </div>               
                                </td>
</tr>
@endforeach
                            </tbody> 
                        </table>
            </div>
            <!--/ Scrollable -->

          </div>
          <!-- / Content -->

          <div class="content-backdrop fade"></div>
         </div>
            <!--  -->
<!-- The Modal -->
<div class="modal fade centered" id="myModal">

      <!-- Modal Header --> 
      <input type='hidden' id='wishesh'>
</div>
        </div>
    </div>   
    <!--  -->
<!-- message modal -->
<!-- The Modal -->
<div class="modal fade centered" id="messagemodal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm-9" role="document">
    <div class="modal-content">
      <!-- Modal Header --> 
      <div class="modal-header">
      <h4 class="modal-title" style="margin-left:30%;" ><svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--emojione" preserveAspectRatio="xMidYMid meet" fill="#000000" style="height: 30px;"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#f7b600" d="M2 61l8.6-3l-6.5-3z"> </path> <path fill="#ffdd7d" d="M26.9 36.4L14.8 24.2l-2 5.6z"> </path> <path fill="#f7b600" d="M12.8 29.8l-2.2 6.3l26.8 12.5l1.3-.4l-11.8-11.8z"> </path> <path fill="#ffdd7d" d="M8.5 42.4l20 9.3l8.9-3.1l-26.8-12.5z"> </path> <path fill="#f7b600" d="M6.3 48.7l13.2 6.2l9-3.2l-20-9.3z"> </path> <path fill="#ffdd7d" d="M6.3 48.7L4.1 55l6.5 3l8.9-3.1z"> </path> <path d="M31.9 31.2c6.7 6.6 10.2 14 7.8 16.4c-2.5 2.4-9.9-1-16.7-7.7c-6.7-6.6-10.2-14-7.8-16.4c2.5-2.4 9.9 1.1 16.7 7.7" fill="#493816"> </path> <path d="M23.5 14.5c-1.6-2.3.1-3.3 2.3-2.9c-2.1-2.5-.8-4.3 2.5-3.6c1 .2-.4 1.9-1.3 1.9c2.7 2 1.2 4.2-1.7 3.7c2.6 3.5-1.8 2.6-3.8 2.8C21 19 24 22 23 22c-2.2 0-5.8-8.3.5-7.5" fill="#42ade2"> </path> <path d="M44.5 19.3c-1.5.7-5.7-5.9-.5-6c-3-2.7-2.6-4 1.4-4.1c-4.6-4.6 2.7-6.2 3.4-3.8c.2.7-2.2-.6-3 .7c-.9 1.5 5.6 5.4-1.1 5.1c2.5 2.5 2.6 3.7-1.3 4.1c.5.8 2.1 3.6 1.1 4" fill="#ff8736"> </path> <path d="M46.2 34.9l1.5-1.3s1.4 2.1 2.4 2.9c.8-3.6.6-5.7 4.7-3.3c-2.3-6.2 1.5-3.9 5.2-2.2c-.2-1.6 0-1.4 1.6-1.9c1.4 5.3-2.4 3.7-5.4 2c1.8 4.8-.1 4.5-3.9 2.9c-.1 2-.7 4.3-1.9 4.5c-1.4.4-4.2-3.6-4.2-3.6" fill="#ed4c5c"> </path> <path d="M35 20.1c-1.8 2.4-4.7 3.7-6.8 5.8c-2.2 2.2-3.5 8.2-3.5 8.2s.8-6.3 2.9-8.7c1.9-2.2 4.7-3.8 6.2-6.3c2.6-4.6.2-10.6-3.2-14.1c.7-.6 1.7-1.4 2.2-2c3.3 4.1 6.1 12 2.2 17.1" fill="#c28fef"> </path> <path d="M38.1 25.2c-2.6 1.9-4.5 4.7-6.3 7.3c-1.6 2.3-6.7 5.2-6.7 5.2s4.8-3.3 6.3-5.7c1.8-3 3.6-6.1 6.4-8.3c5.6-4.3 13.7-3.9 20-1.6c-.4.9-1.1 2.8-1.1 2.8s-13.3-3.6-18.6.3" fill="#ff8736"> </path> <g fill="#42ade2"> <path d="M49.2 24.7c-1.7 2.2-2.5 4.9-3.8 7.4c-1.2 2.3-2.8 4.5-5.1 5.7c-2.6 1.3-8.3.9-8.3.9s5.7-.1 8.1-1.7c2.4-1.6 3.7-4.4 4.6-7c1.8-5 4-10.4 9.2-12.6c.3.9 1 2.8 1 2.8s-2.9.8-5.7 4.5"> </path> <path d="M3.21 14.325l2.828-2.829l2.829 2.828l-2.828 2.83z"> </path> </g> <path fill="#ff8736" d="M7.173 23.197L10 20.369l2.828 2.828L10 26.025z"> </path> <path fill="#ed4c5c" d="M14.358 9.822l2.828-2.828l2.828 2.828l-2.828 2.828z"> </path> <path fill="#c28fef" d="M45.205 43.696l2.828-2.829l2.828 2.829l-2.828 2.828z"> </path> <path fill="#ed4c5c" d="M38.903 53.39l2.828-2.828l2.829 2.829l-2.829 2.828z"> </path> <path fill="#ff8736" d="M51.279 55.607l2.828-2.829l2.828 2.829l-2.828 2.828z"> </path> <g fill="#42ade2"> <path d="M54.078 42.731l2.828-2.828l2.828 2.828l-2.828 2.829z"> </path> <path d="M49.356 12.823l2.828-2.829l2.829 2.829l-2.828 2.828z"> </path> </g> <path fill="#ed4c5c"
       d="M19.044 29.792l2.829-2.828l2.828 2.828l-2.828 2.829z"> </path> </g></svg>Send Wishes</h4>
<button type="button" data-dismiss="modal" class="btn btn-danger btn-circle"><i class="bx bx-times"></i>X&nbsp;</button>
      </div>
<!-- modal body -->
<div class="modal-body">
<form action="{{route('sendwishes')}}" method="POST" enctype="multipart/form-data">
 @csrf
 <input type="hidden"  name="id" id="editid"/>
  
<div class="border p-4 rounded">
 <div class="col-md-12">
 <label for="email" class="form-label" id="label">To</label>
 <div class="input-group">
 <input type="text" class="form-control" name="emails" value="" id="emails" readonly>
 </div>
 </div>
 <div class="col-md-12">
 <label for="message" class="form-label" id="label">Message</label>
 <div class="input-group">
 <textarea class="form-control " name="message" id="message" value ="" placeholder="Type your message...">Hi Dear...</textarea>
 </div>
 </div>
  <input type="hidden" id="name" name="name">
 <div align="center">
 <button type="submit" class="btn btn-info" style="margin-top:10px">Send</button>
</div>
 </div>
</form>
</div>

<!--end modal body  -->
    </div>
  </div>
</div>
        </div>
    </div>  
<!-- end message modal -->
<script>
$ (document).ready (function () {
	$ (".modal a").not (".dropdown-toggle").on ("click", function () {
		$ (".modal").modal ("hide");
	});
});


function openSendwishes(userid){
      
    $("#wishesh").val(userid);
  var id=  $("#wishesh").val();
   
   $.ajax({
                  url : '{{route("achivers_message")}}',
                  data: {"id":id, "_token": "{{ csrf_token() }}"},
                  type: "POST",
                  success : function(response) {
                    $("#emails").val(response);
                   
                 }
               });
}
    </script>
    
@endsection