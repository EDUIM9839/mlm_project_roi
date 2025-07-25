@extends('superadmin.layouts.main')
@section('pageTitle', 'SUPER ADMIN')
@section('mains')

<style>
    .header-colors-indigators .indigator {
    width: 130px!important;
    height: 130px!important;
   
    border-radius: 20px!important;
    cursor: pointer;
}
 .sidebarcolor1 {
    background-image:url({{asset('assets/images/theme/pa1.png')}})!important;
}
  .sidebarcolor2 {
    background-image:url({{asset('assets/images/theme/pa2.png')}})!important;
}
 .sidebarcolor3 {
    background-image:url({{asset('assets/images/theme/pa3.png')}})!important;
}
 .sidebarcolor4 {
    background-image:url({{asset('assets/images/theme/pa4.png')}})!important;
}
 .sidebarcolor5 {
    background-image:url({{asset('assets/images/theme/pa5.png')}})!important;
}
  .sidebarcolor6 {
    background-image:url({{asset('assets/images/theme/pa6.png')}})!important;
}
  .sidebarcolor7 {
    background-image:url({{asset('assets/images/theme/pa7.png')}})!important;
}
 .sidebarcolor8 {
    background-image:url({{asset('assets/images/theme/pa8.png')}})!important;
}

 .sidebarcolor9 {
    background:white!important;
}

 .headercolor9 {
    background:white!important;
    border:2px solid black;
}



        input[type=radio]#header_color1 {
            accent-color: #0727d7 ;
        }
         input[type=radio]#header_color2 {
            accent-color: #23282c;
        }
         input[type=radio]#header_color3 {
            accent-color: #e10a1f ;
        } 
        input[type=radio]#header_color4 {
            accent-color: #157d4c;
        } 
        input[type=radio]#header_color5 {
            accent-color: #673ab7 ;
        } 
        input[type=radio]#header_color6 {
            accent-color: #795548 ;
        } 
        input[type=radio]#header_color7 {
            accent-color: #d3094e ;
        } 
         input[type=radio]#header_color8 {
            accent-color:  #ff9800 ;
        } 
         input[type=radio]#sidebarcolor1 {
            accent-color: #717eee;
        } 
        
         input[type=radio]#sidebarcolor2 {
            accent-color: #5d757f;
        } 
        
         input[type=radio]#sidebarcolor3 {
            accent-color: #498f55;
        } 
        
         input[type=radio]#sidebarcolor4 {
            accent-color:#361435;
        } 
        
         input[type=radio]#sidebarcolor5 {
            accent-color: #9a478b;
        } 
         input[type=radio]#sidebarcolor6 {
            accent-color: #ae4553;
        } 
          input[type=radio]#sidebarcolor7 {
            accent-color: #b45b16;
        } 
          input[type=radio]#sidebarcolor8 {
            accent-color: #1f0c39;
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
                            <li class="breadcrumb-item active" aria-current="page">Website Theme</li>
                        </ol>
                    </nav>
                </div> 
            </div>
            
             	@if (session()->has('success'))
				<div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
					<div class="d-flex align-items-center">
						<div class="font-35 text-white"><i class='bx bxs-message-square-check'></i>
						</div>
						<div class="ms-3"> 
							<div class="text-white">{!!session()->get('success')!!}</div>
						</div>
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				</div>
				@elseif(session()->has('error'))
				<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
					<div class=" ">
						<div class="font-20 text-white"><i class='bx bxs-message-square-x'
								style='display:contents; !important'></i><span
								style='font-size:16px;'>&nbsp;{!!session()->get('error')!!}</span>
						</div>
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div> @endif
            <!--end breadcrumb-->

            <form action="{{route('website_setting_save')}}" method="post" enctype="multipart/form-data">
					@csrf  
					<div class="card"> 
					<div  class="content pb-4" >
                    <div class="row g-3">
                    <div class="col-sm-1"></div> 
                    <div class="row g-3 ">
                    <div class="switcher-body">
			  
			<h2 class="mb-0">Header Colors</h2>
			<hr/>
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					     
					     
					     
						@if(($website_setting[0]->header_color)=='color-header headercolor1') 
						<div class="col">
			<label for="header_color1">
				<div class="indigator headercolor1" id="headercolor1">
					<input class="headercolor1"  name="header_color" id='header_color1'  value='color-header headercolor1' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked >
				</div> 
			</div>  
						@else
						<div class="col">
						    <label for="header_color1">
						<div class="indigator headercolor1" id="headercolor1" >
					<input class="headercolor1" name="header_color" id='header_color1'  value='color-header headercolor1' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;">
					 </div>
					 
							</div>
						@endif
				
					@if(($website_setting[0]->header_color)=='color-header headercolor2') 
					<div class="col">
					    	<label for="header_color2">
						<div class="indigator headercolor2" id="headercolor2" >
						<input class=" headercolor2" name="header_color" id='header_color2'  value='color-header headercolor2' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked>
					
						</div>
						</label>
						</div>
						@else
						<div class="col">
						    	<label for="header_color2"> 
						<div class="indigator headercolor2" id="headercolor2" >
						<input class=" headercolor2" name="header_color" id='header_color2'  value='color-header headercolor2' type='radio'  style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
					
						</div>
						</label>
						</div>
						@endif
					
					@if(($website_setting[0]->header_color)=='color-header headercolor3') 
						<div class="col"> 
						<label for="header_color3">
						<div class="indigator headercolor3" id="headercolor3" >
					<input class="headercolor1" name="header_color" id='header_color3'  value='color-header headercolor3' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked >
					 	</div>
						</label>
					</div>
					@else
						<div class="col"> 
						<label for="header_color3">
						<div class="indigator headercolor3" id="headercolor3"  >
					<input class="headercolor1" name="header_color" id='header_color3'  value='color-header headercolor3' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
					 	</div>
						</label>
					</div>
					@endif
					@if(($website_setting[0]->header_color)=='color-header headercolor4') 
					<div class="col">
					    <label for="header_color4"> 
						<div class="indigator headercolor4" id="headercolor4" >
						<input class=" headercolor4" name="header_color" id='header_color4'  value='color-header headercolor4' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked>
					 </div>
						</label>
					</div>
					@else
					
					<div class="col">
					    	<label for="header_color4"> 
						<div class="indigator headercolor4" id="headercolor4" >
						<input class=" headercolor4" name="header_color" id='header_color4'  value='color-header headercolor4' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
					 </div>
						</label>
					</div>
					@endif
					@if(($website_setting[0]->header_color)=='color-header headercolor5') 
					<div class="col">
					    <label for="header_color5"> 
						<div class="indigator headercolor5" id="headercolor5" >
						<input class="headercolor5"  name="header_color" id='header_color5' value='color-header headercolor5'  type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked >
					 </div>
						</label>
					
					</div>
					@else
						<div class="col">
						    	<label for="header_color5"> 
						<div class="indigator headercolor5" id="headercolor5" >
						<input class="headercolor5" name="header_color" id='header_color5' value='color-header headercolor5' type='radio'  style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
						
						</div>
						</label>
					</div>
					@endif
					@if(($website_setting[0]->header_color)=='color-header headercolor6') 
					<div class="col">
					    	<label for="header_color6"> 
						<div class="indigator headercolor6" id="headercolor6"  >
						<input class="  headercolor6" name="header_color" id='header_color6'  value='color-header headercolor6' type='radio'  style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked >
						
						</div>
						</label>
					</div>
					@else
					<div class="col">
					    <label for="header_color6">
						<div class="indigator headercolor6" id="headercolor6" >
						<input class="  headercolor6" name="header_color" id='header_color6'  value='color-header headercolor6' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
							 
						</div>
						</label>
					</div>
					@endif
					@if(($website_setting[0]->header_color)=='color-header headercolor7') 
					<div class="col">
					    <label for="header_color7"> 
						<div class="indigator headercolor7" id="headercolor7" >
						<input class="headercolor7" name="header_color" id='header_color7'  value='color-header headercolor7' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;"checked >
							
						</div>
						</label>
					</div>
					@else
					<div class="col">
					    <label for="header_color7">
						<div class="indigator headercolor7" id="headercolor7" >
						<input class="headercolor7" name="header_color" id='header_color7'  value='color-header headercolor7' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
							 
						</div>
						</label>
					</div>
					@endif
				
					    @if(($website_setting[0]->header_color)=='color-header headercolor8')
					    	<div class="col">
					    	    <label for="header_color8">
						<div class="indigator headercolor8" id="headercolor8" >
						<input class="headercolor8" name="header_color" id='header_color8'  value='color-header headercolor8' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked>
							 
						</div>
						</label>
					</div>
					@else
					<div class="col">
					    <label for="header_color8">
						<div class="indigator headercolor8" id="headercolor8" >
						<input class="headercolor8" name="header_color" id='header_color8' value='color-header headercolor8'  type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
							 
						</div>
						</label>
					</div>
					@endif
					
					 @if(($website_setting[0]->header_color)=='color-header headercolor9') 
					    	<div class="col">
					    	    <label for="header_color9">
						<div class="indigator headercolor9" id="headercolor9" >
						<input class="headercolor9" name="header_color" id='headercolor9'  value=' color-header headercolor9'type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked>
							 
						</div>
						</label>
					</div>
					@else
					<div class="col">
					    <label for="header_color9">
						<div class="indigator headercolor9" id="headercolor9" >
						<input class="headercolor9" name="header_color" id='header_color9'  value='color-header headercolor9 ' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
							 
						</div>
						</label>
					</div>
					@endif
				</div>
			</div>
			<hr/>
			<h2 class="mb-0">Sidebar Colors</h2>
			<hr/> 
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
				 @if(($website_setting[0]->sidebar_color)=='color-sidebar sidebarcolor1')  
					<div class="col">
					    <label for="sidebarcolor1">
						<div class="indigator sidebarcolor1" >
						<input class="sidebarcolor1" name="sidebar_color" id='sidebarcolor1'  value='color-sidebar sidebarcolor1' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked >
						 
                    </div>
                    </label>
					</div>
					 	@else
					 	<div class="col">
					 	    <label for="sidebarcolor1">
						<div class="indigator sidebarcolor1" >
						<input class=" sidebarcolor1"  name="sidebar_color" id='sidebarcolor1'  value='color-sidebar sidebarcolor1' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;">
						 
                    </div>
                    </label>
					</div>
					 		@endif
				 @if(($website_setting[0]->sidebar_color)=='color-sidebar sidebarcolor2')  
					 		
					<div class="col">
					    <label for="sidebarcolor2">
						<div class="indigator sidebarcolor2" >
						<input class="sidebarcolor2" name="sidebar_color" id='sidebarcolor2'  value='color-sidebar sidebarcolor2' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked>
						 
                    </div>
                    </label>
					</div>
					@else
					<div class="col">
					    <label for="sidebarcolor2">
						<div class="indigator sidebarcolor2" >
						<input class="sidebarcolor2" name="sidebar_color" id='sidebarcolor2'  value='color-sidebar sidebarcolor2' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
						 
                    </div>
                    </label>
					</div>
					@endif
					 @if(($website_setting[0]->sidebar_color)=='color-sidebar sidebarcolor3') 
					<div class="col">
					    <label for="sidebarcolor3">
						<div class="indigator sidebarcolor3" >
					<input class="  sidebarcolor3" name="sidebar_color" id='sidebarcolor3'   value='color-sidebar sidebarcolor3' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked >
					 
						</div>
						</label>
					</div>
					@else
						<div class="col">
						    <label for="sidebarcolor3"> 
						<div class="indigator sidebarcolor3" >
					<input class="  sidebarcolor3" name="sidebar_color" id='sidebarcolor3' value='color-sidebar sidebarcolor3' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
					
						</div>
						</label>
						
					</div>
					@endif
					 @if(($website_setting[0]->sidebar_color)=='color-sidebar sidebarcolor4') 
					<div class="col">
					    <label for="sidebarcolor4">
						<div class="indigator sidebarcolor4" >
					<input class="sidebarcolor4" name="sidebar_color" id='sidebarcolor4' value='color-sidebar sidebarcolor4' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;"checked >
					 	</div>
					</div>
					@else
					<div class="col">
					    <label for="sidebarcolor4">
						<div class="indigator sidebarcolor4" >
					<input class="  sidebarcolor4" name="sidebar_color" id='sidebarcolor4'  value='color-sidebar sidebarcolor4' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
					 
						</div>
						</label>
					</div>
					@endif
					 @if(($website_setting[0]->sidebar_color)=='color-sidebar sidebarcolor5') 
					<div class="col">
					    <label for="sidebarcolor5">
						<div class="indigator sidebarcolor5" >
					<input class="sidebarcolor5"name="sidebar_color" id='sidebarcolor5'value='color-sidebar sidebarcolor5'type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked >
					 
						</div>
					</div>
						@else
						<div class="col">
						    <label for="sidebarcolor5">
						<div class="indigator sidebarcolor5" >
					<input class="sidebarcolor5" name="sidebar_color" id='sidebarcolor5'  value='color-sidebar sidebarcolor5' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
					 
						</div>
						</label>
					</div>
						@endif
						 @if(($website_setting[0]->sidebar_color)=='color-sidebar sidebarcolor6') 
					<div class="col">
					    <label for="sidebarcolor6">
						<div class="indigator sidebarcolor6" >
					<input class="sidebarcolor6" name="sidebar_color" id='sidebarcolor6'  value='color-sidebar sidebarcolor6' type='radio'  style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked >
					 
						</div>
						</label>
					</div>
						@else
						<div class="col">
						    <label for="sidebarcolor6">
						<div class="indigator sidebarcolor6" >
					<input class="sidebarcolor6" name="sidebar_color" id='sidebarcolor6'  value='color-sidebar sidebarcolor6' type='radio'  style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
					 
						</div>
						</label>
					</div>
							@endif
							 @if(($website_setting[0]->sidebar_color)=='color-sidebar sidebarcolor7') 
					<div class="col">
					    <label for="sidebarcolor7">
						<div class="indigator sidebarcolor7" >
					<input class=" sidebarcolor7" name="sidebar_color" id='sidebarcolor7' value='color-sidebar sidebarcolor7' type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked >
					 
						</div>
						</label>
					</div>
						@else
						<div class="col">
						    <label for="sidebarcolor7">
						<div class="indigator sidebarcolor7" >
					<input class=" sidebarcolor7" name="sidebar_color" id='sidebarcolor7'  value='color-sidebar sidebarcolor7'  type='radio'  style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
					 
						</div>
						</label>
					</div>
							@endif
			 @if(($website_setting[0]->sidebar_color)=='color-sidebar sidebarcolor8') 				
					<div class="col">
					    <label for="sidebarcolor8"> 
						<div class="indigator sidebarcolor8" >
					<input class="sidebarcolor8"name="sidebar_color" id='sidebarcolor8' value='color-sidebar sidebarcolor8'  type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked>
					
						</div>
						</label>
					</div>
						@else
						<div class="col">
						    <label for="sidebarcolor8">
						<div class="indigator sidebarcolor8" >
					<input class="sidebarcolor8"name="sidebar_color" id='sidebarcolor8' value='color-sidebar sidebarcolor8'  type='radio' style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" >
					 
						</div>
						</label>
					</div>
							@endif
							
							
							
					 @if(($website_setting[0]->sidebar_color)=='color-sidebar sidebarcolor9') 				
					<div class="col">
					    <label for="sidebarcolor9">
						<div class="indigator sidebarcolor9"  style='border:2px solid black;'>
					<input class="sidebarcolor9"name="sidebar_color" id='sidebarcolor9'  value='color-sidebar sidebarcolor9'type='radio'  style=" height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle;" checked>
					 
						</div>
						</label>
					</div>
						@else
						<div class="col">
						    <label for="sidebarcolor9">
						<div class="indigator sidebarcolor9"  style='border:2px solid black;'>
					<input class="sidebarcolor9" name="sidebar_color" id='sidebarcolor9'  value='color-sidebar sidebarcolor9' type='radio' style="  height:80px; width:80px; margin-left:25px; margin-top:25px; vertical-align: middle; accent-color:white;" >
					 
						</div>
						</label>
					</div>
							@endif		
							
							
							
				    </div>
				    </div>
			        </div>
	        	    </div>
                    </div>
                                
                    <div class="py-4" align="center">
			        <button class="btn btn-primary"> <i class="fa"></i> Upload</button>
	            	</div>
	            	</div> 
                    </form> 
		            </div> 
                	</div>
                	</div>
                	 
                	
                	
                	
                	
@endsection      	
                	
                	
                	
                	
                	
                	
                	
                	
                	