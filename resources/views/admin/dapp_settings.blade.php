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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Dapp Settings</li>
                    </ol>
                </nav>
            </div>


        </div>
        <!--end breadcrumb-->
        <!--<h6 class="mb-0 text-uppercase alert  ">All User List</h6>-->
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
        {{-- <div class="card">
            <div class="card-header bg-dark">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white"> Withdrawal Settings </h5>
                </div>
            </div>
            <div class="card-body">
                
                <form action="{{ route('admin.dapp_settings.withdrawal.store') }}" method="post">
                    @csrf
                  <div class="mb-3">
                    <label for="publicKey" class="form-label">Sender Address</label>
                    <input type="text" class="form-control" id="publicKey" name="sender_address" aria-describedby="emailHelp" value="{{ $dappSettings['sender_address'] ?? '' }}">
                    
                    @error('sender_address')
                        <small class="text-danger">{{ $message }}</small>
                        
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="privateKey" class="form-label">Sender Private Key</label>
                    <input type="text" class="form-control" id="privateKey" name="private_key" value="{{ $dappSettings['private_key'] ?? '' }}">
                      @error('private_key')
                        <small class="text-danger">{{ $message }}</small>
                        
                    @enderror
                  </div>
                  
                  <button type="submit" class="btn btn-dark rounded-1">Save</button>
                </form>
                
            </div>
       
        </div> --}}
        <div class="card">
            <div class="card-header bg-dark">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white"> Receiver Settings </h5>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.dapp_settings.receiver.store') }}" method="post" onsubmit="onsubmitForms(event)" id="target">
                    @csrf
                  <div class="mb-3">
                    <label for="reciever_address" class="form-label">Receiver Address</label>
                    <input type="text" class="form-control" id="reciever_address" name="reciever_address" aria-describedby="emailHelp" value="{{ $dappSettings['reciever_address'] ?? '' }}">
                         @error('reciever_address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-dark rounded-1" id="btnx">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
 <script>
    function onsubmitForms(e) {
        e.preventDefault();
        $("#btnx").attr("disabled", true);
        $.ajax({
            url: "{{ route('send_otp_emails') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: '{{ Auth::user()->id }}',
            },
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Enter OTP',
                        input: 'text',
                        inputLabel: 'OTP sent to your email',
                        inputPlaceholder: 'Enter OTP here',
                        confirmButtonText: 'Verify OTP',
                        showCancelButton: true,
                        inputAttributes: {
                            maxlength: 6,
                            autocapitalize: 'off',
                            autocorrect: 'off'
                        },
                        allowOutsideClick: () => !Swal.isLoading(),
                        didOpen: () => {
                            const confirmBtn = Swal.getConfirmButton();  
                            const input = Swal.getInput();             

                            confirmBtn.disabled = false;

                            input.addEventListener('input', () => {
                                Swal.resetValidationMessage();
                                confirmBtn.disabled = false;
                            });
                        },
                        preConfirm: (otp) => {
                            return $.ajax({
                                url: "{{ route('verify_otps') }}",
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    user_id: '{{ Auth::user()->id }}',
                                    otp: otp
                                }
                            }).then(response => {
                                if (response.status === 'success') {
                                    Swal.close();
                                    document.getElementById("target").submit();
                                } else {
                                    Swal.showValidationMessage('Invalid or expired OTP.');
                                    throw new Error('Invalid OTP');
                                }
                            }).catch(error => {
                                console.error(error);
                                Swal.showValidationMessage('Validation failed. Please try again.');
                                throw error;
                            });
                        }
                    }).then((result) => {
                        if (!result.isConfirmed) {
                            $("#btnx").removeAttr("disabled");
                        }
                    });
                } else if (response.status === 'emailError') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Email Not Found',
                        text: 'Your email ID does not exist in the database.',
                        confirmButtonColor: '#d33'
                    });
                    $("#btnx").removeAttr("disabled");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to send OTP. Try again.',
                        confirmButtonColor: '#d33'
                    });
                    $("#btnx").removeAttr("disabled");
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: 'An unexpected error occurred. Please try again later.',
                    confirmButtonColor: '#d33'
                });
                $("#btnx").removeAttr("disabled");
            }
        });
    }
</script>
@endsection