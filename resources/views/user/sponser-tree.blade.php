@extends('user.layouts.main')
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
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content" id='page-content'>
             <h6 class="mb-0 text-uppercase alert  ">Sponser Tree  </h6>
            <hr />
            <div class='row justify-content-center my-3'>
                <div class='col-md-3' align='center'>
                    <form>
                     <label><b>Directs</b></label>
                    <select class='form-control' id='direct_this' name='user_id' onchange='this.form.submit();'>
                    <option selected disabled>--SELECT DIRECTS--</option>
                        @php
                        if(empty($direct_this_id)){
                        $main_userid=Auth::user()->userid;
                        }else{
                         $main_userid= DB::table('user')->find($direct_this_id)->userid;
                        }
                        $direct_this=DB::table('user')->where('referal',$main_userid)->get();
                        @endphp
                        @foreach($direct_this as $dt)
                        <option value='{{$dt->id}}' >{{$dt->first_name}} {{$dt->last_name}} ({{$dt->userid}})</option>
                        @endforeach
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
                
                 <!-- Scrollable -->
            <div class="card" >
                  @if(empty($direct_upline_userids))
                  @else
                   <span class='py-2 px-3' >@foreach($direct_upline_userids as $duu) <b>{!!$duu!!}</b>  >     @endforeach</span>
                  @endif
                <center>
                  <div id="tree" class="dataTables_wrapper no-footer" style="padding: 14px; ";>
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
