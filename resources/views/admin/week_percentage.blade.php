    @extends('admin.layouts.main')
@section('mains')
<style>
	input{
		border-width: 1px !important;
	}
	.input-group-text{
		border-width: 1px !important;
	}
</style>    
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Week Percentage</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card p-3">
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
                                    <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                    </div>
                                    <div class="ms-3">
                                         
                                        <div class="text-white">{!!session()->get('error')!!}</div>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="form-body">
                            @php
                                $isEdit = isset($editData);
                            @endphp
                            <form action="{{ $isEdit ? route('update.week.submit', $editData->id) : route('weekly.save') }}" method="POST">
                                @csrf
                                <h4>{{ $isEdit ? 'Update Weekly Distribution' : 'Weekly Distribution' }}</h4>
                            
                                <div class="mb-3">
                                    <label>Week</label>
                                    <input type="week" name="week" class="form-control"
                                        value="{{ $isEdit ? \Carbon\Carbon::create()->setISODate(...explode('-', $editData->week_year))->format('Y-\WW') : '' }}"
                                        {{ $isEdit ? 'readonly' : '' }} required>
                                </div>
                            
                                <div class="mb-3">
                                    <label>1st Winner %</label>
                                    <input type="number" name="first_percent" class="form-control" step="0.01"
                                        value="{{ $isEdit ? $editData->first_winner_percent : '' }}" required>
                                </div>
                            
                                <div class="mb-3">
                                    <label>2nd Winner %</label>
                                    <input type="number" name="second_percent" class="form-control" step="0.01"
                                        value="{{ $isEdit ? $editData->second_winner_percent : '' }}" required>
                                </div>
                            
                                <div class="mb-3">
                                    <label>3rd Winner %</label>
                                    <input type="number" name="third_percent" class="form-control" step="0.01"
                                        value="{{ $isEdit ? $editData->third_winner_percent : '' }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>4th Winner %</label>
                                    <input type="number" name="fourth_percent" class="form-control" step="0.01"
                                        value="{{ $isEdit ? $editData->fourth_winner_percent : '' }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>5th Winner %</label>
                                    <input type="number" name="fifth_percent" class="form-control" step="0.01"
                                        value="{{ $isEdit ? $editData->fifth_winner_percent : '' }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>6th Winner %</label>
                                    <input type="number" name="sixth_percent" class="form-control" step="0.01"
                                        value="{{ $isEdit ? $editData->sixth_winner_percent : '' }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>7th Winner %</label>
                                    <input type="number" name="seventh_percent" class="form-control" step="0.01"
                                        value="{{ $isEdit ? $editData->seventh_winner_percent : '' }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>8th Winner %</label>
                                    <input type="number" name="eighth_percent" class="form-control" step="0.01"
                                        value="{{ $isEdit ? $editData->eighth_winner_percent : '' }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>9th Winner %</label>
                                    <input type="number" name="ninth_percent" class="form-control" step="0.01"
                                        value="{{ $isEdit ? $editData->ninth_winner_percent : '' }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>10th Winner %</label>
                                    <input type="number" name="tenth_percent" class="form-control" step="0.01"
                                        value="{{ $isEdit ? $editData->tenth_winner_percent : '' }}" required>
                                </div>
                                <button type="submit" class="btn btn-{{ $isEdit ? 'warning' : 'primary' }}">
                                    {{ $isEdit ? 'Update Distribution' : 'Save Distribution' }}
                                </button>
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
                                    <th>Percentage</th>
                                    
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($distributions as $key => $row)
                                    @php
                                        [$year, $week] = explode('-', $row->week_year);
                                        $startOfWeek = new DateTime();
                                        $startOfWeek->setISODate($year, $week); 
                                        $endOfWeek = clone $startOfWeek;
                                        $endOfWeek->modify('+6 days');
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $row->week_year }}<br>
                                            <small>{{ $startOfWeek->format('d M Y') }} - {{ $endOfWeek->format('d M Y') }}</small>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#viewParticipantsModal{{ $row->week_year }}">
                                                <i class="bi bi-eye me-1"></i>View
                                            </button>
                                            <div class="modal fade" id="viewParticipantsModal{{ $row->week_year }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Week {{ $row->week_year }} - Percentage</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table table-bordered text-center">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Rank</th>
                                                                            <th>Percentage</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody >
                                                                        <tr>
                                                                            <td>1st</td>
                                                                            <td>{{ $row->first_winner_percent }}%</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2nd</td>
                                                                            <td>{{ $row->second_winner_percent }}%</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>3rd</td>
                                                                            <td>{{ $row->third_winner_percent }}%</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>4th</td>
                                                                            <td>{{ $row->fourth_winner_percent }}%</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>5th</td>
                                                                            <td>{{ $row->fifth_winner_percent }}%</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>6th</td>
                                                                            <td>{{ $row->sixth_winner_percent }}%</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>7th</td>
                                                                            <td>{{ $row->seventh_winner_percent }}%</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>8th</td>
                                                                            <td>{{ $row->eighth_winner_percent }}%</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>9th</td>
                                                                            <td>{{ $row->ninth_winner_percent }}%</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10th</td>
                                                                            <td>{{ $row->tenth_winner_percent }}%</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge 
                                                @if($row->status == 'distributed') bg-success
                                                @elseif($row->status == 'running') bg-warning
                                                @else bg-primary
                                                @endif">
                                                {{ ucfirst($row->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($row->status == 'pending')
                                                <a href="{{ route('update.week', $row->id) }}" class="btn btn-sm btn-outline-dark">Edit</a>
                                            @else
                                                <span class="text-muted">~</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
       </div>
    </div>
@endsection
