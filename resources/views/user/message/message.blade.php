@extends('user.layouts.main')
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
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Message</li>
                        </ol>
                    </nav>
                </div>
      
            </div>
            <!--end breadcrumb-->
            <!--  -->
            
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

            <div class="content-wrapper">
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
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                      @foreach($allMsg as $key=> $msg)
                                                    <tr>
                                                      <th scope="row">{{++$key}}</th>
                                                      <td>{{DB::table('user')->where('id',Auth::user()->id)->value('userid')}}</td>
                                                      <td>{{$msg->message}}</td>
                                                      <td>{{$msg->created_at}}</td>
                                                    </tr>
                                                 @endforeach
                                                    </tr>
                                                  </tbody>
                                                </table>
                                                </div>
                            </div>
                        </div>


    </div>
@endsection
