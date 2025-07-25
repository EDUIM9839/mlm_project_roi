@extends('admin.layouts.main')
@section('mains')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Suspended Users</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->
            <!--<h6 class="mb-0 text-uppercase alert  ">All User List</h6>-->
           
            <hr />
           <div class="card border-dark p-2">
              <div class="border-dark table-responsive text-nowrap">
                  
                     <div id="table-div" class="dataTables_wrapper no-footer" style="padding:5px";>
                    
                        <table  id='example' class="table table-bordered table-striped" >  
                            <thead>
                                <tr>
                                    <th  class='text-center' >S.no</th>
                                    <th  class='text-center'  >User</th>
                                    <th  class='text-center'  >Status</th>
                                     <th  class='text-center'  >Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($suspended_user as $su)
                                    <tr>
                                        <td align="center" style="vertical-align: middle;" > {{$loop->iteration}}</td>
                                        <td align="center" style="vertical-align: middle;" >
                                            
                                            <img src="{{ Storage::url('app/profileupload/').$su->image}}" alt="user" class="rounded-circle p-1 bg-primary" width="60" >
                                            <br>
                                            {{ucwords($su->first_name)}} {{ucwords($su->last_name)}} <br> 
                                        
                                        
                                        <span class="badge bg-gradient-ohhappiness text-white shadow-sm">{{$su->userid}}</span>
                                        </td>
                                        <td align="center" style="vertical-align: middle;">
                                         <i class="fa-solid fa-ban text text-danger" style='font-size:50px;'></i><br>
                                         <b class='text text-danger'>Suspended</b>
                                          
                                         
                                            
                                          
                                            
                                            
                                        </td>
                                        <td align="center" style="vertical-align: middle;">  <button class='btn btn-secondary' onclick="activate_user({{$su->id}});">   Activate </button> </td>
                                       
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
        
     
        
     
       
   
        
        
           function activate_user(id) {
            
            
               jQuery.getScript('https://cdn.jsdelivr.net/npm/sweetalert2@11', function() {
        
        Swal.fire({
          title: 'Are you sure to activate this User?',
          text: "",
          icon: 'success',
          showCancelButton: true,
          confirmButtonColor: '#C64EB2',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
        }).then((result) => {
          if (result.isConfirmed) {
             
                var url='{{ route("activate_suspend_user", ["id" => "/"]) }}/' + id;
               var xhr = new XMLHttpRequest();
               xhr.open('GET',url, true);
               xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // const jsonData = JSON.stringify(xhr.responseText);
                     
                     
                     
                    console.log(xhr.responseText);
                  document.getElementById('table-div').innerHTML=xhr.responseText;
                     $('#example').DataTable();
                    
                }
            };
             xhr.send();
          } else {
            
          }
        })
        
        });
            
          
            
            
            
        }
        
        
        
        
    </script>
    
@endsection
