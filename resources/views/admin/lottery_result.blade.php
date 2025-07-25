@extends('admin.layouts.main')
@section('mains')

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.0/dist/css/tom-select.css" rel="stylesheet">
    <style>
        .circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 17px;
        }

        .num {
            text-shadow: 2px 2px 6px #000000;
        }

        th {
            font-size: 13px;
        }

        td {
            font-size: 13px;
        }

        .card-header {
            background-color: #f8f9fa;
            font-weight: bold;
            border-bottom: 1px solid #e0e0e0;
        }

        .card-body {
            padding: 2rem;
        }

        .filter-btn {
            background: linear-gradient(90deg, rgba(181,4,136,1) 2%, rgba(2,44,182,1) 100%);
            color: #fff;
            border: none;
            border-radius: 0.5rem;
        }

        .filter-btn:hover {
            background: linear-gradient(90deg, rgba(133,5,100,1) 0%, rgba(4,31,121,1) 100%);
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .text-win {
            color: #198754;
        }

        .text-lose {
            color: #dc3545;
        }

        .form-control,
        .form-select {
            border-radius: 0.75rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .filter-input {
            border-radius: 1rem;
        }

        .filter-icon {
            font-size: 1.3rem;
            margin-right: 8px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }

        .form-label {
            font-size: 0.9rem;
            color: #495057;
        }

        .filter-icon {
            font-size: 1.3rem;
        }

        .filter-container {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
        }

        .form-select,
        .form-control {
            border-radius: 1.25rem;
        }

        .ts-control {
            border: none !important;
            /* Remove the border */
            box-shadow: none !important;
            /* Remove any box shadows */
            padding: 3px !important;
            font-size: 15px !important;
        }
        .page-wrapper::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url({{ asset('assets/colorbg.jpg') }}) no-repeat center center;
            background-size: cover;
            z-index: -1;
            opacity: 0.1;
            /*  */
        }
    </style>
    <!-- Start page wrapper -->
    <div class="page-wrapper P-1">
        <div class="page-content p-md-2 p-0 ">
            <!-- Breadcrumb -->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Lucky Draw Results</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- End breadcrumb -->
            <div class="row">
                <!-- Filter Card -->
                <div class="col-md-12 ">
                    <div class="card shadow-sm filter-container">
                        <div class="card-header d-flex justify-content-between align-items-center bg-dark">
                            <h6 class="mb-0 text-white"><i class="bi bi-sliders pe-1"></i> Filter Lottery</h6>
                        </div>
                        <div class="card-body py-2">
                            <form class="row">
                                <!-- User ID Filter -->
                                <div class="col-md-3 col-sm-6">
                                    <label for="userName" class="form-label">User Name</label>
                                    <select name="user_id" class="form-select filter-input text-capitalize" id="userName">
                                        <option value="">All User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->userid }}"
                                                {{ request('user_id') == $user->userid ? 'selected' : '' }}>
                                                {{ $user->userid }} → {{ $user->first_name }} {{ $user->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Week Name Filter (Dropdown) -->
                                <div class="col-md-3 col-sm-6">
                                    <label for="gameName" class="form-label">Week</label>
                                    <select class="form-select filter-input text-capitalize" id="gameName" name="game_id">
                                        <option value="">All Weeks</option>
                                        @foreach ($weeks as $w)
                                            <option value="{{ $w->week_year }}" {{ request('game_id', $week) == $w->week_year ? 'selected' : '' }}>
                                                {{ $w->week_year }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                <!-- Game Date Filter -->
                                {{-- <div class="col-md-2 col-sm-6">
                                    <label for="gameDate" class="form-label">Game Date</label>
                                    <input type="date" class="form-control filter-input" id="gameDate" name="game_date"
                                        value="{{ request('game_date') ?: now()->toDateString() }}">
                                </div>--}}

                                <!-- Game Result Filter -->
                                <div class="col-md-2 col-sm-6">
                                    <label for="gameResult" class="form-label">Result</label>
                                    <select class="form-select filter-input" id="gameResult" name="result">
                                        <option value="">All</option>
                                        <option value="winner" {{ request('result') == 'winner' ? 'selected' : '' }}>Winer
                                        </option>
                                        <option value="loser" {{ request('result') == 'loser' ? 'selected' : '' }}>Loser
                                        </option>
                                    </select>
                                </div>

                                <!-- Filter Button -->
                                <div class="col-md-2 d-flex align-items-end col-sm-12 mt-2">
                                    <button type="submit" class="btn filter-btn w-100 btn-dark mt-sm-2">
                                        <i class="bi bi-funnel"></i> Filter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card shadow-sm ">
                        <div class="card-header bg-dark">
                            <h6 class="text-white mb-0">Filtered Lucky Draw Results</h6>
                        </div>
                        <div class="card-body p-0">
                            <!-- Table to show filtered data --> 
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">User ID</th>
                                            <th class="text-center">Week</th>
                                            <th class="text-center">Invest Amount</th>
                                            <th class="text-center">Win Amount</th>
                                            
                                            <th class="text-center">Results</th>
                                            <th class="text-center">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Results will be dynamically added here -->
                                        {{-- @if (!$gameTime->isEmpty())--}}
                                            @foreach ($lotteryEntries as $k => $v)
                                                <tr>
                                                    <td class="text-center">{{ $k + 1 }}</td>
                                                    <td class="text-center">
                                                        <span class="badge rounded-pill px-4 text-capitalize fw-medium" style="font-size: 12px; background: linear-gradient(90deg, rgba(181,4,136,1) 2%, rgba(2,44,182,1) 100%);">{{ $v->user_id }}</span><br>
                                                        <span style="font-size: 13px;" class="text-capitalize">
                                                            {{ $v->first_name }} {{ $v->last_name }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center"><span class="text-capitalize">{{ $v->week_year }}</span></td>
                                                    <td class="text-center">
                                                        <span class="badge px-3 py-1 fw-medium" style="background:#00b33c; font-size:12px;">
                                                            {{ $v->investment_amount ? Helper::get_currency() . $v->investment_amount : '-' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge px-3 py-1 fw-medium" style="background:#6c757d; font-size:12px;">
                                                            {{ $v->winning_amount ? Helper::get_currency() . $v->winning_amount : '-' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge {{ $v->status == 'winner' ? 'text-bg-success' : 'text-bg-danger' }} rounded-pill px-3 text-capitalize fw-medium" style="font-size: 11px;">{{ $v->status }}</span>
                                                    </td>
                                                    <td class="text-center">{{ \Carbon\Carbon::parse($v->created_at)->format('d-M-Y') }}</td>
                                                </tr>
                                            @endforeach

                                        {{-- @else
                                            <tr>
                                                <td colspan="10" class="text-center">
                                                    <span>Data Not Found!</span>
                                                </td>
                                            </tr>
                                        @endif--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer pb-0">
                           {{ $lotteryEntries->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


   

@endsection
