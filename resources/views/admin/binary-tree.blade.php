@extends('admin.layouts.main')
@section('mains') 
<link href="{{asset($tree_setting->theme)}}" rel="stylesheet"> 
<script src="https://code.jquery.com/jquery-1.12.4.min.js"> 
</script> 
<script src="{{asset('tree-assets/js/jquery-ui-1.10.4.custom.min.js')}}"></script>
<link href="{{asset('tree-assets/CSS/jHTree.css')}}"  rel="stylesheet"> 
<script src="{{asset('tree-assets/js/jQuery.jHTree.js')}}"></script> 
<style> 
/* button{ 
 color: white !important;
}
  button:hover{
    color:black !important;
  } */
  </style>
  <style> 
/* button{ 
 color: white !important;
}
  button:hover{
    color:black !important;
  } */
  .yes{
    color:white;
    /*background-color: #399ad0;*/
    border:none;
}
.btn-info {
 
    color: white!important;
    }
  </style>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content" id='page-content'>
             <h6 class="mb-0 text-uppercase alert  ">Global Star Tree  </h6>
            <hr /> 
            <div class='row justify-content-center my-3'> 
                <div class='col-md-3' align='center'>
                    <form disabled>
                     <label><b>Team</b></label>
                    <select   class='form-control' id='direct_this' name='user_id' onchange='this.form.submit();'>
                    <option selected disabled>--SELECT TEAM MEMBER--</option> 
                          @if($main_star_user->left_user>0) 
                         @php $left_user=DB::table('user')->find($main_star_user->left_user); @endphp 
                          <option value='{{$left_user->id}}'> {{$left_user->first_name}} {{$left_user->last_name}} ( {{$left_user->userid}} ) </option>
                          @endif 
                           @if($main_star_user->right_user>0)
                        @php  $right_user=DB::table('user')->find($main_star_user->right_user); @endphp
                           <option value='{{$right_user->id}}'> {{$right_user->first_name}} {{$right_user->last_name}} ( {{$right_user->userid}} ) </option>
                          @endif 
                    </select>
                    </form>
                </div>
                <div class="col-md-1">
                    <br> 
                         <div class="spinner-grow" role="status"  style='cursor:pointer;' onclick="location.assign('{{Request::url()}}');"> 
                              <span class="visually-hidden" > 
                              </span> 
						  </div> 
                </div>
            </div>
            
            
                          @php
    $leftCount = isset($left_right['left']) ? count($left_right['left']) : 0;
    $rightCount = isset($left_right['right']) ? count($left_right['right']) : 0;
@endphp

 
             <div class="row">
    <div class="col-6 d-flex justify-content-start">
    <button type="button" class="btn btn-info yes">Left Users: {{ $leftCount }}</button>
       
        
    </div>
    
    <div class="col-6 d-flex justify-content-end">
    <button type="button" class="btn btn-info yes">Right Users: {{ $rightCount }}</button>
       
    </div>
</div><br>
                 <!-- Scrollable -->
                 
                 
                 @php
                 if($max_levels['left_max_level']>$max_levels['right_max_level']){
                 $max_level=$max_levels['left_max_level']+1;
                 }elseif($max_levels['left_max_level']<$max_levels['right_max_level']){
                    $max_level=$max_levels['right_max_level']+1;
                 }else{
                 $max_level=$max_levels['left_max_level']+1;
                 }
                 
                 if($max_level<=1){
                 $tree_width=358;
                 }else{
                 
                 $tree_width=358+(($max_level-1)*2*170);
                 
                 }
                 
                  @endphp
               
            <div class="card" style='overflow:scroll;' > 
                  @if(empty($direct_upline_userids)) 
                  @else 
                   <span class='py-2 px-3' >@foreach($direct_upline_userids as $duu) <b>{!!$duu!!}</b>  >     @endforeach</span>
                @endif 
                <center>        
                  <div id="tree" class="dataTables_wrapper no-footer" style="zoom:60%; padding: 14px; width:{{1.94*$tree_width}}px;">
                      
                    </div>
            <!--/ Scrollable -->
 
            </center>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    <script>
// var myData = [
// {
//   "head": "A",
//   "id": "aa",
//   "contents": "A Contents",
//   "children": [
//     {
//       "head": "A-1",
//       "id": "a1",
//       "contents": "A-1 Contents",
//       "children": [
//         { "head": "A-1-1", "id": "a11", "contents": "A-1-1 Contents" }
//       ]
//     },
//     {
//       "head": "A-2",
//       "id": "a2",
//       "contents": "A-2 Contents",
//       "children": [
//         { "head": "A-2-1", "id": "a21", "contents": "A-2-1 Contents" },
//         { "head": "A-2-2", "id": "a22", "contents": "A-2-2 Contents" }
//       ]
//     }
//   ]
// }]
// ;  
var myData={!!$final_tree!!};
console.log(myData);
$("#tree").jHTree({
  callType: 'obj',
  structureObj: myData,
  zoomer: true,
  nodeDropComplete:function (event, data) {
    alert("Node ID: " + data.nodeId + " Parent Node ID: " + data.parentNodeId);
  }
});
$('[data-bs-toggle=tooltip]' ).on( 'mouseout', function( e ){
    $(this).tooltip('hide');
});
$('[data-bs-toggle=tooltip]' ).on( 'mouseover', function( e ){
    console.log("hjfhjhd");
    $(this).tooltip('show');
});
 dragElement(document.getElementById("tree"));
function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id)) {
    // if present, the header is where you move the DIV from:
    document.getElementById(elmnt.id).onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV:
    elmnt.onmousedown = dragMouseDown;
  }
  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }
  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }
  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
        </script>
@endsection
