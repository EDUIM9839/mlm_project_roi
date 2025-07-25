@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')



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


.upper-div{

    background:url({{asset('tree-assets/Themes/trontastic/images/ui-bg_gloss-wave_55_000000_500x100.png')}}) ;
  
}

input[type=radio] {
    border: 0px;
    width: 100%;
    height: 1.6em;
}
</style>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
          






   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tree Setting</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="lni lni-vector"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"></li>
            </ol>
        </nav>
    </div>
     
</div>
<!--end breadcrumb-->



            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Tree Themes</h5>


                    @if (session()->has('success'))
                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
                            </div>
                            <div class="ms-3">
                                 
                                <div class="text-white">{!!session()->get('success')!!}</div>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session()->has('error'))
               
                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                    <div class=" "  >
                        <div class="font-20 text-white"><i class='bx bxs-message-square-x' style='display:contents; !important' ></i><span style='font-size:16px;'>&nbsp;{!!session()->get('error')!!}</span>
                        </div>
                         
                             
                          
                               
                             
                        
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

              
                @endif


 
                    <form method='post' action="{{route('tree-setting-update')}}">
                        @csrf
                         
                        <div class="row my-5 mx-auto justify-content-center"   >
                            <b class='col-sm-2'> Trontastic</b>

                            <label for="theme1" class="btn p-0 col-sm-6"  style='border:1px solid black;      box-shadow: 5px 5px 5px #888; '> 
                                <div class='col-sm-12 m-0 p-0' style='background:#9fda58 url({{asset('tree-assets/Themes/trontastic/images/ui-bg_gloss-wave_85_9fda58_500x100.png')}}) 50% 50% repeat-x ; border-bottom:1px solid black;   color:#222; font-weight:bold;'> TREE001 </div>
                                
                                <div class='col-sm-12' style="background:#000 url({{asset('tree-assets/Themes/trontastic/images/ui-bg_gloss-wave_55_000000_500x100.png')}}) ;    color:#fff; font-weight:bold;"   > NAME </div>
                            </label>
                            <div class='col-sm-1 my-2'>
                            <input name='theme' id='theme1'  @if($tree->theme=="tree-assets/Themes/trontastic/jquery-ui-1.10.4.custom.min.css")  checked @endif value='tree-assets/Themes/trontastic/jquery-ui-1.10.4.custom.min.css' type='radio'>
                            </div>

                            
                        </div>



              
                        <div class="row my-5 mx-auto justify-content-center"   >
                            <b class='col-sm-2'> Smoothness</b>
                            <label for="theme2" class="btn p-0 col-sm-6"  style='border:1px solid black;     box-shadow: 5px 5px 5px #888;'> 

                             
                                <div class='col-sm-12 m-0 p-0' style='background:#ccc url({{asset('tree-assets/Themes/smoothness/images/ui-bg_highlight-soft_75_cccccc_1x100.png')}}) 50% 50% repeat-x ; border-bottom:1px solid black;   color:#222; font-weight:bold;'> TREE001 </div>
                                
                                <div class='col-sm-12' style="background:#fff url({{asset('tree-assets/Themes/smoothness/images/ui-bg_flat_75_ffffff_40x100.png')}}) ;    color:#222; font-weight:bold;"   > NAME </div>
                            </label>
                            <div class='col-sm-1 my-2'>
                            <input name='theme' id='theme2'  @if($tree->theme=="tree-assets/Themes/smoothness/jquery-ui-1.10.4.custom.min.css")  checked @endif  value='tree-assets/Themes/smoothness/jquery-ui-1.10.4.custom.min.css' type='radio'>
                            </div>

                            
                        </div>

                        <div class="row my-5 mx-auto justify-content-center"   >

                            <b class='col-sm-2'> Black Tie</b>
                            <label for="theme3" class="btn p-0 col-sm-6"  style='border:1px solid black;     box-shadow: 5px 5px 5px #888;'> 
                                <div class='col-sm-12 m-0 p-0' style='background:url({{asset('tree-assets/Themes/black-tie/images/ui-bg_diagonals-thick_8_333333_40x40.png')}}) 50% 50% repeat-x ; border-bottom:1px solid black;   color:#fff; font-weight:bold;'> TREE001 </div>
                                
                                <div class='col-sm-12' style="background:#f9f9f9 url({{asset('tree-assets/Themes/black-tie/images/ui-bg_highlight-hard_100_f9f9f9_1x100.png')}}) ;    color:#222; font-weight:bold;"   > NAME </div>
                            </label>
                            <div class='col-sm-1 my-2'>
                            <input name='theme'  id="theme3" @if($tree->theme=="tree-assets/Themes/black-tie/jquery-ui-1.10.4.custom.min.css")  checked @endif   value='tree-assets/Themes/black-tie/jquery-ui-1.10.4.custom.min.css' type='radio'>
                            </div>

                            
                        </div>

                        <div class="row my-5 mx-auto justify-content-center"   >
                            <b class='col-sm-2'> South Street</b>
                            <label for="theme4" class="btn p-0 col-sm-6"  style='border:1px solid black;     box-shadow: 5px 5px 5px #888;'> 
                                <div class='col-sm-12 m-0 p-0' style='background:#ece8da  url({{asset('tree-assets/Themes/south-street/images/ui-bg_gloss-wave_100_ece8da_500x100.png')}}) 50% 50% repeat-x ; border-bottom:1px solid black;   color:#433f38; font-weight:bold;'> TREE001 </div>
                                
                                <div class='col-sm-12' style="background:#312e25 url({{asset('tree-assets/Themes/south-street/images/ui-bg_highlight-hard_100_f5f3e5_1x100.png')}}) ;    color:#222; font-weight:bold;"   > NAME </div>
                            </label>
                            <div class='col-sm-1 my-2'>
                            <input name='theme' id='theme4'  @if($tree->theme=="tree-assets/Themes/south-street/jquery-ui-1.10.4.custom.min.css")  checked @endif  value='tree-assets/Themes/south-street/jquery-ui-1.10.4.custom.min.css' type='radio'>
                            </div>

                            
                        </div>

                        <div class="row my-5 mx-auto justify-content-center"   >
                            <b class='col-sm-2'> Mint Choc</b>
                            <label for="theme5" class="btn p-0 col-sm-6"  style='border:1px solid black;     box-shadow: 5px 5px 5px #888; '> 
                                <div class='col-sm-12 m-0 p-0' style='background:#453326 url({{asset('tree-assets/Themes/mint-choc/images/ui-bg_gloss-wave_25_453326_500x100.png')}}) 50% 50% repeat-x ; border-bottom:1px solid #695649;   color:#e3ddc9; font-weight:bold;'> TREE001 </div>
                                
                                <div class='col-sm-12' style="background:#201913  url({{asset('tree-assets/Themes/mint-choc/images/ui-bg_inset-soft_10_201913_1x100.png')}}) ;    color:#fff; font-weight:bold;"   > NAME </div>
                            </label>
                            <div class='col-sm-1 my-2'>
                            <input name='theme' id="theme5" @if($tree->theme=="tree-assets/Themes/mint-choc/jquery-ui-1.10.4.custom.min.css")  checked @endif  value='tree-assets/Themes/mint-choc/jquery-ui-1.10.4.custom.min.css' type='radio'>
                            </div>

                            
                        </div>

                        <div class="row my-5 mx-auto justify-content-center"   >
                            <b class='col-sm-2'> Dot Luv</b>
                            <label for="theme6" class="btn p-0 col-sm-6"  style='border:1px solid black;     box-shadow: 5px 5px 5px #888;'> 
                                <div class='col-sm-12 m-0 p-0' 
                                style='background:#0b3e6f  url({{asset('tree-assets/Themes/dot-luv/images/ui-bg_diagonals-thick_15_0b3e6f_40x40.png')}}) 50% 50% repeat-x ; border-bottom:1px solid #0b3e6f;   color:#f6f6f6; font-weight:bold;'> TREE001 </div>
                                
                                <div class='col-sm-12' style="background:#111 url({{asset('tree-assets/Themes/dot-luv/images/ui-bg_gloss-wave_20_111111_500x100.png')}}) ;    color:#d9d9d9; font-weight:bold;"   > NAME </div>
                            </label>
                            <div class='col-sm-1 my-2'>
                            <input name='theme' id='theme6' @if($tree->theme=="tree-assets/Themes/dot-luv/jquery-ui-1.10.4.custom.min.css")  checked @endif  value='tree-assets/Themes/dot-luv/jquery-ui-1.10.4.custom.min.css' type='radio'>
                            </div>

                            
                        </div>
                        <div class="row my-5 mx-auto justify-content-center"   >
                            <b class='col-sm-2'>Humanity</b>
                            <label for="theme7" class="btn p-0 col-sm-6"  style='border:1px solid black;     box-shadow: 5px 5px 5px #888;'> 
                                <div class='col-sm-12 m-0 p-0' style='background:#cb842e  url({{asset('tree-assets/Themes/humanity/images/ui-bg_glass_25_cb842e_1x400.png')}}) 50% 50% repeat-x ; border-bottom:1px solid #d49768;   color:#fff; font-weight:bold;'> TREE001 </div>
                                
                                <div class='col-sm-12' style="background:#f4f0ec  url({{asset('tree-assets/Themes/humanity/images/ui-bg_inset-soft_100_f4f0ec_1x100.png')}}) ;    color:#1e1b1d; font-weight:bold;"   > NAME </div>
                            </label>
                            <div class='col-sm-1 my-2'>
                            <input name='theme' id='theme7' @if($tree->theme=="tree-assets/Themes/humanity/jquery-ui-1.10.4.custom.min.css")  checked @endif   value='tree-assets/Themes/humanity/jquery-ui-1.10.4.custom.min.css' type='radio'>
                            </div>

                            
                        </div>
                        <div class="row my-5 mx-auto justify-content-center"   >
                            <b class='col-sm-2'>Cupertino</b>
                            <label for="theme8" class="btn p-0 col-sm-6"  style='border:1px solid black;    box-shadow: 5px 5px 5px #888;'> 
                                <div class='col-sm-12 m-0 p-0' style='background:rgb(222, 237, 247) url({{asset('tree-assets/Themes/cupertino/images/ui-bg_highlight-soft_100_deedf7_1x100.png')}}) 50% 50% repeat-x ; border-bottom:1px solid rgb(174, 208, 234);   color:rgb(34, 34, 34); font-weight:bold;'> TREE001 </div>
                                
                                <div class='col-sm-12' style="background:rgb(242, 245, 247) url({{asset('tree-assets/Themes/cupertino/images/ui-bg_highlight-hard_100_f2f5f7_1x100.png')}}) ;    color:rgb(54, 43, 54); font-weight:bold;"   > NAME </div>
                            </label>
                            <div class='col-sm-1 my-2'>
                            <input name='theme' id='theme8'  @if($tree->theme=="tree-assets/Themes/cupertino/jquery-ui-1.10.4.custom.min.css")  checked @endif  value='tree-assets/Themes/cupertino/jquery-ui-1.10.4.custom.min.css' type='radio'>
                            </div>

                            
                        </div>


                        <div class="row my-5 mx-auto justify-content-center" >
                            <b class='col-sm-2'>Le Frog</b>
                            <label for="theme9" class="btn p-0 col-sm-6"  style='border:1px solid black;    box-shadow: 5px 5px 5px #888;'> 
                                <div class='col-sm-12 m-0 p-0' style='background:#3a8104   url({{asset('tree-assets/Themes/le-frog/images/ui-bg_highlight-soft_33_3a8104_1x100.png')}}) 50% 50% repeat-x ; border-bottom:1px solid #72b42d;   color:#fff; font-weight:bold;'> TREE001 </div>
                                
                                <div class='col-sm-12' style="background:#285c00 url({{asset('tree-assets/Themes/le-frog/images/ui-bg_inset-soft_10_285c00_1x100.png')}}) ;    color:#fff; font-weight:bold;"   > NAME </div>
                            </label>
                            <div class='col-sm-1 my-2'>
                            <input name='theme' id='theme9' @if($tree->theme=="tree-assets/Themes/le-frog/jquery-ui-1.10.4.custom.min.css")  checked @endif   value='tree-assets/Themes/le-frog/jquery-ui-1.10.4.custom.min.css' type='radio'>
                            </div>

                            
                        </div>

                        <div class="row my-5 mx-auto justify-content-center"   >
                            <b class='col-sm-2'>Swanky Purse</b>
                            <label for="theme10" class="btn p-0 col-sm-6"  style='border:1px solid black;    box-shadow: 5px 5px 5px #888;'> 
                                <div class='col-sm-12 m-0 p-0' style='background:#261803  url({{asset('tree-assets/Themes/swanky-purse/images/ui-bg_diamond_8_261803_10x8.png')}}) 50% 50% repeat-x ; border-bottom:1px solid #efec9f;   color:#eacd86; font-weight:bold;'> TREE001 </div>
                                
                                <div class='col-sm-12' style="background:#443113 url({{asset('tree-assets/Themes/swanky-purse/images/ui-bg_diamond_8_443113_10x8.png')}}) ;    color:#efec9f; font-weight:bold;"   > NAME </div>
                            </label>
                            <div class='col-sm-1 my-2'>
                            <input name='theme' id='theme10' @if($tree->theme=="tree-assets/Themes/swanky-purse/jquery-ui-1.10.4.custom.min.css")  checked @endif  value='tree-assets/Themes/swanky-purse/jquery-ui-1.10.4.custom.min.css'  type='radio'>
                            </div>

                            
                        </div>
                     
                        
                        <div class="row justify-content-center">
                             
                            <div class="col-sm-2">
                                 
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                                  
                               
                            </div>
                        </div>


                    </form>
                    </div>
                </div>  





        </div>
    </div>
    <!--end page wrapper -->



<script>

 
</script>

@endsection
