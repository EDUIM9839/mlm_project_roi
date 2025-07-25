@extends('user.layouts.main')

@section('mains')
<style>
    input {
        border-width: 1px !important;
    }
    .input-group-text {
        border-width: 1px !important;
    }
    
    .full-screen-cover {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgb(0 0 0 / 44%);
        text-align: center;
        z-index: 1000;
    }
    
    .full-screen-cover .inner-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 100%;
    }
    
    .full-screen-cover .inner-content .message {
        font-size: 21px;
        color: #ffffff;
        font-weight: 500;
    }
    
    .full-screen-cover .inner-content .message-wait {
        font-size: 16px;
        color: #ffffff;
        font-weight: 400;
    }

    .loader {
        width: 148px;
        aspect-ratio: 2;
        --_g: no-repeat radial-gradient(circle closest-side, #ffffff 90%, #38353500);
        background: var(--_g) 0% 50%, var(--_g) 50% 50%, var(--_g) 100% 50%;
        background-size: calc(100% / 3) 50%;
        animation: l3 1s infinite linear;
        margin-bottom: 22px;
    }
    
    @keyframes l3 {
        20%{background-position:0%   0%, 50%  50%,100%  50%}
        40%{background-position:0% 100%, 50%   0%,100%  50%}
        60%{background-position:0%  50%, 50% 100%,100%   0%}
        80%{background-position:0%  50%, 50%  50%,100% 100%}
    }

    .totalAmountCard {
        background: #d4ffd4 !important;
        color: green;
        border: 2px solid #0080002e !important;
        box-shadow: none !important;
        width: fit-content;
    }
</style>
<!-- Start page wrapper -->     
<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Lucky draw Amount</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End breadcrumb -->
        
        <div id="pleaseWaitPopup" class="full-screen-cover">
            <div class="inner-content">
                <div class="loader"></div>
                <div class="message">Transaction is under process </div>
                <div class="message-wait">Please Wait...</div>
                <small class="text-light">Please do not leave or refresh this page while the transaction is in progress.</small>
            </div>
        </div>
        <div class="row g-3">
                <div class="col-md-4">
                    <div class="card p-3">
                        @if (session()->has('success'))
                            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-white"><i class='bx bxs-message-square-check'></i></div>
                                    <div class="ms-3">
                                        <div class="text-white">{!! session()->get('success') !!}</div>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif (session()->has('error'))
                            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i></div>
                                    <div class="ms-3">
                                        <div class="text-white">{!! session()->get('error') !!}</div>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="form-body">
                            <form action="{{ route('lottery_amount') }}" method="POST" id="target">
                                @csrf
                               
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Enter Amount</label>
                                    <span class="badge bg-success">{{ Helper::get_currency() }} {{ Auth::user()->saving_wallet }}</span>
                                    <input type="number" name="investment_amount" id="amount" min="5" step="0.01" class="form-control" placeholder="Enter Amount" required>
                                    @error('investment_amount')
                                        <br><span class='text text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary my-3 me-3 d-flex align-items-center justify-content-center" value="saving_wallet" name="wallet" id="btnInvest"><i class='bx bx-dollar-circle me-1'></i> From Fund</button>
                                    <button type="submit" class="btn btn-warning my-3 d-flex align-items-center justify-content-center" value="withdrawl_wallet"  name="wallet" ><i class='bx bx-wallet-alt me-1'></i> From Wallet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card p-2 overflow-auto">
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">  
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>Week</th>
                                    <th>Amount</th>
                                    <th>Entered On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @forelse($entries as $week => $weekEntries)
                                    @php
                                        $entryCount = count($weekEntries);
                                        $totalAmount = $weekEntries->sum('investment_amount');
                                        $lastEntryDate = $weekEntries->max('created_at');
                                        $firstEntry = $weekEntries->first();
                                    @endphp
                                
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $week }}</td>
                                        <td>{{ $totalAmount }}</td>
                                        <td>{{ date('d M Y', strtotime($lastEntryDate)) }}</td>
                                        <td>
                                            @if($entryCount == 1)
                                                @if($firstEntry->status == 'winner')
                                                    <span class="badge bg-success">Winner</span>
                                                @elseif($firstEntry->status == 'loser')
                                                    <span class="badge bg-danger">Loser</span>
                                                @else
                                                    <span class="badge bg-secondary">Pending</span>
                                                @endif
                                            @else
                                                <span class="badge bg-info">Multiple Entries</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($entryCount > 1)
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $week }}">
                                                    View
                                                </button>
                                            @else
                                                @if($firstEntry->status == 'winner')
                                                    <span>🏆 You won {{ $firstEntry->winning_amount ?? 'N/A' }}!</span>
                                                @elseif($firstEntry->status == 'loser')
                                                    <span>🙁 Better luck next time</span>
                                                @else
                                                    <span>⌛ Waiting for results</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No entries found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
    </div>
</div>
@foreach($entries as $week => $weekEntries)
    @if(count($weekEntries) > 1)
        <div class="modal fade" id="viewModal-{{ $week }}" tabindex="-1" aria-labelledby="viewModalLabel-{{ $week }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Lottery for Week {{ $week }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Entered On</th>
                                    <th>Status</th>
                                    <th>Winning Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($weekEntries as $entry)
                                    <tr>
                                        <td>{{ $entry->investment_amount }}</td>
                                        <td>{{ date('d M Y H:i', strtotime($entry->created_at)) }}</td>
                                        <td>
                                            @if($entry->status == 'winner')
                                                <span class="badge bg-success">Winner</span>
                                            @elseif($entry->status == 'loser')
                                                <span class="badge bg-danger">Loser</span>
                                            @else
                                                <span class="badge bg-secondary">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{ $entry->winning_amount ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.3.0/dist/web3.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<script>
    $(document).ready(function() {
        $('#btnInvest').click(function() {
            var amount = $('#amount').val();
            var walletBalance = {{ Auth::user()->saving_wallet }};
            
            if(amount > walletBalance) {
                toastr.error('Insufficient balance in wallet.');
                return;
            }

            $('#pleaseWaitPopup').show();
            $('#target').submit();  
        });
    });

    @if(session('success'))
        toastr.success('{{ session('success') }}');
    @elseif(session('error'))
        toastr.error('{{ session('error') }}');
    @endif
</script>

@endsection
