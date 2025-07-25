@extends('admin.layouts.main')
@section('mains')
    <!--start page wrapper -->
    
    <style>
    /* Toggle switch styling */
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
        vertical-align: middle;
        margin-left: 10px;
    }

    .toggle-switch input {
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
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 4px;
        bottom: 2px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    /* Checked state styles */
    input:checked + .slider {
        background-color: #4CAF50;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }
    
  
.user-dropdown {
    position: relative;
    width: 100%;
}

#userSearchInput {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
}

.user-dropdown-list {
    position: absolute;
    background-color: white;
    border: 1px solid #ddd;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    z-index: 999;
    display: none;
}

.user-dropdown-list a {
    display: block;
    padding: 10px;
    cursor: pointer;
    text-decoration: none;
    color: black;
}

.user-dropdown-list a:hover {
    background-color: #f1f1f1;
}

</style>
    
    <div class="page-wrapper">
        <div class="page-content">
             <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Messages</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Messages</li>
                        </ol>
                    </nav>
                </div>
                 
            </div>
            <!--end breadcrumb-->
             

                        <!-- Scrollable -->
                     <div>
                         <!-- Button trigger modal -->
                         <div class="text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                              Add Message
                            </button>
                            </div>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Messages</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      @if (session('success'))
                                        <div class="alert alert-success" id="success-alert">
                                            {{ session('success') }}
                                        </div>
                                        <script>
                                            setTimeout(function() {
                                                document.getElementById('success-alert').style.display = 'none';
                                            }, 3000);
                                        </script>
                                    @endif

                                    <form action="{{route('message-save')}}" method="POST">
                                        @csrf
                                          {{-- <div class="mb-3">
                                            <label for="user" class="form-label">Users</label>
                                          <select name="users" id="users" class="form-select">
                                                  <option value="">Select Users</option>
                                                   <option value="all">All</option>
                                                  @foreach($allUser as $user)
                                                  <option value="{{$user->id}}">
                                                      {{$user->first_name}}  /{{$user->userid}}
                                                  </option> 
                                                  @endforeach
                                                </select>
                                          </div> --}}
                                          <div class="mb-3">
        <label for="userSearchInput" class="form-label">Users</label>
        <div class="user-dropdown">
            <input type="text" id="userSearchInput" placeholder="Search users..." autocomplete="off">
            <div id="userList" class="user-dropdown-list">
                <a href="#" onclick="selectUser('all', 'All')">All</a>
                @foreach($allUser as $user)
                    <a href="#" onclick="selectUser('{{ $user->id }}', '{{ $user->first_name }} / {{ $user->userid }}')">
                        {{ $user->first_name }} / {{ $user->userid }}
                    </a>
                @endforeach
            </div>
        </div>
        <!-- Hidden input to hold selected value -->
        <input type="hidden" name="users" id="selectedUser">
    </div>
                                          
                                          <div class="mb-3">
                                            <label for="message" class="form-label">Message</label>
                                          <textarea name="message" row="4" placeholder="Enter the message" id="message" class="form-control"></textarea>
                                          </div>
                                         
                                
                                       
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send</button>
                                  </div>
                                   </form>
                                </div>
                              </div>
                            </div>
                     </div>
                        <!--/ Scrollable -->
                      
                        
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-hover">
                                      <thead>
                                        <tr>
                                          <th scope="col">S.No</th>
                                          <th scope="col">User Name</th>
                                          <th scope="col">Message</th>
                                          <th scope="col">Date</th>
                                          <th>Action</th>
                                        
                                        </tr>
                                      </thead>
                                      <tbody>
                                          @foreach($allMsg as $key=> $msg)
                                        <tr>
                                          <th scope="row">{{++$key}}</th>
                                          <td>
                                                {{ DB::table('user')->where('id', $msg->userid)->value('userid') }}
                                            </td>
                                          <td>{{$msg->message}}</td>
                                          <td>{{$msg->created_at}}</td>
                                          <td><a  href="{{route('message-delete',['id'=>$msg->id])}}" class="btn btn-danger">Delete</button></a></td>
                                        </tr>
                                     @endforeach
                                        </tr>
                                      </tbody>
                                    </table>
                                    </div>
                            </div>
                        </div>
                        

                    </div>
                    <!-- / Content -->



 
                    <!-- / Footer -->


                    <div class="content-backdrop fade"></div>
                </div>
            <!-- page end -->
        </div>
    </div>
    <script>
const userSearchInput = document.getElementById('userSearchInput');
const userList = document.getElementById('userList');

userSearchInput.addEventListener('focus', () => {
    userList.style.display = 'block';
});

userSearchInput.addEventListener('input', () => {
    const filter = userSearchInput.value.toUpperCase();
    const links = userList.getElementsByTagName('a');

    for (let i = 0; i < links.length; i++) {
        const txtValue = links[i].textContent || links[i].innerText;
        links[i].style.display = txtValue.toUpperCase().includes(filter) ? '' : 'none';
    }
});

document.addEventListener('click', function(event) {
    if (!event.target.closest('.user-dropdown')) {
        userList.style.display = 'none';
    }
});

function selectUser(value, label) {
    document.getElementById('userSearchInput').value = label;
    document.getElementById('selectedUser').value = value;
    userList.style.display = 'none';
}
</script>

@endsection
