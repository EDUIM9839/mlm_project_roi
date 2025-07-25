@extends('admin.layouts.main')

@section('mains')
<style>
    .custom-check {
        display: inline-block;
        position: relative;
        padding-left: 25px;
        cursor: pointer;
        font-size: 18px;
        user-select: none;
    }

    .custom-check input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .custom-check .checkmark {
        position: absolute;
        top: 2px;
        left: 0;
        height: 18px;
        width: 18px;
        background-color: #eee;
        border: 2px solid #ccc;
        border-radius: 3px;
        transition: all 0.2s;
    }

    .custom-check input:checked ~ .checkmark {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .custom-check .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .custom-check input:checked ~ .checkmark:after {
        display: block;
    }

    .custom-check .checkmark:after {
        left: 5px;
        top: 1px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
</style>

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lucky draw List</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        @if(session('success'))
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div class="toast align-items-center text-white bg-success border-0 show" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div class="toast align-items-center text-white bg-danger border-0 show" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="table-responsive text-nowrap">
                <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding: 14px;">
                    <table class="table dataTable no-footer" id="" aria-describedby="example_info">  
                        <thead>
                            <tr class="table-dark">
                                <th>Sr No</th>
                                <th>Week</th>
                                <th>Total Amount</th>
                                <th>Total Participants</th>
                                <th>View Participants</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($lottery_weeks as $week)
                                @php
                                    $result = DB::table('lottery_results')->where('week_year', $week->week_year)->first();
                                @endphp
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $week->week_year }}</td>
                                    <td>{{ Helper::get_currency() }} {{ number_format($week->total_amount, 2, '.', '') }}</td>
                                    <td>{{ $week->total_participants }}</td>
                                    <td>
                                        @php
                                            $result = DB::table('lottery_results')->where('week_year', $week->week_year)->first();
                                            $result_winners = [];
                                            if ($result && !empty($result->winners)) {
                                                $cleaned = trim($result->winners, '{}');
                                                $pairs = explode(',', $cleaned);
                                                foreach ($pairs as $pair) {
                                                    $user_id = explode(':', $pair)[0];
                                                    $result_winners[] = $user_id;
                                                }
                                            }
                                            $result_losers = $result ? explode(',', trim($result->losers, '{}')) : [];
                                        @endphp
                                        <a href="{{ route('participants', ['week_year' => $week->week_year]) }}" class="btn btn-dark btn-sm" target="_blank">
                                            <i class="bi bi-eye me-1"></i>View
                                        </a>
                                        <!--    Open on new page beacuse not open in iphone mobile  -->
                                        <!--<button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#viewParticipantsModal{{ $week->week_year }}">-->
                                        <!--    <i class="bi bi-eye me-1"></i>View-->
                                        <!--</button>-->
                                        {{--<div class="modal fade" id="viewParticipantsModal{{ $week->week_year }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Week {{ $week->week_year }} - Participants</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('select_winner', $week->week_year) }}" method="POST">
                                                            @csrf
                                                            <div class="table-responsive text-nowrap">
                                                                <table class="table dataTable no-footer">
                                                                    <thead>
                                                                        <th>Sr</th>
                                                                        <th>Choose</th>
                                                                        <th>User Name</th>
                                                                        <th>User ID</th>
                                                                        <th>Lucky draw Amount</th>
                                                                        <th>Winning Amount</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php
                                                                            $participants = DB::table('lottery_entries')
                                                                                ->select('id','user_id', 'investment_amount', 'winning_amount')
                                                                                ->where('week_year', $week->week_year)
                                                                                ->get();
                                                                            $ii = 1;
                                                                        @endphp
                                                                        
                                                                        @foreach ($participants as $participant)
                                                                            @php
                                                                                $user = DB::table('user')->where('id', $participant->user_id)->first();
                                                                                $isWinner = in_array($participant->id, $result_winners);
                                                                                $isLoser = in_array($participant->id, $result_losers);
                                                                            @endphp
                                                                            <tr>
                                                                                <td>{{ $ii++ }}</td>
                                                                                <td>
                                                                                    @if($result)
                                                                                        @if($isWinner)
                                                                                            ✅
                                                                                        @elseif($isLoser)
                                                                                            ❌
                                                                                        @else
                                                                                            -
                                                                                        @endif
                                                                                    @else
                                                                                        <label class="custom-check">
                                                                                        <input type="checkbox" name="winner[]" class="form-check-input" data-userid="{{ $user->userid }}" value="{{ $participant->id }}">
                                                                                            <span class="checkmark"></span>
                                                                                        </label>
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ $user->first_name }} </td>
                                                                                <td>{{ $user->userid }}</td>
                                                                                <td>{{ Helper::get_currency() }} {{ number_format($participant->investment_amount, 2, '.', '') }}</td>
                                                                                <td>{{ Helper::get_currency() }} {{ number_format($participant->winning_amount ?? 0, 2, '.', '' ) }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                @if(!$result)
                                                                   <button type="submit" class="btn btn-primary ">
                                                                        Winner
                                                                    </button>
                                                                @else
                                                                    <span class="text-success fw-bold">Winners already selected </span>
                                                                @endif
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>--}}
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
<!-- Percentage Allocation Modal -->
<div class="modal fade" id="percentageAllocationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <form id="percentageForm" method="POST" action="">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Allocate </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered" id="percentageTable">
            <thead>
              <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Total Investment</th>
                <th>Percentage </th>
              </tr>
            </thead>
            <tbody>
              <!-- JS will inject rows here -->
            </tbody>
          </table>
          <!--<small>Enter multiplication of winning amount for each participant (based on their investment)</small>-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Confirm Winners</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const percentageModal = new bootstrap.Modal(document.getElementById('percentageAllocationModal'));
    const percentageTableBody = document.querySelector('#percentageTable tbody');
    const percentageForm = document.getElementById('percentageForm');

    // Handle multiple winner buttons dynamically
    document.querySelectorAll('.openPercentageModalBtn').forEach(button => {
        button.addEventListener('click', function () {
            const week = button.getAttribute('data-week');
            const formAction = button.getAttribute('data-form-action');
            percentageTableBody.innerHTML = '';
            const modalContent = button.closest('.modal-content');
            const checkboxes = modalContent.querySelectorAll('input[type="checkbox"][name="winner[]"]:checked');

            if (checkboxes.length === 0) {
                alert('Please select at least one winner.');
                return;
            }
            checkboxes.forEach((checkbox, index) => {
                const tr = checkbox.closest('tr');
                const userId = checkbox.value;
                const uid = checkbox.getAttribute('data-userid');
                const userName = tr.querySelector('td:nth-child(3)').innerText.trim();
                const investmentText = tr.querySelector('td:nth-child(5)').innerText.trim();
                const investmentAmount = investmentText.replace(/[^0-9.-]+/g,"");
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${uid}<input type="hidden" name="winner[${index}][id]" value="${userId}"></td>
                    <td>${userName}</td>
                    <td>${investmentText}<input type="hidden" name="winner[${index}][investment]" value="${investmentAmount}"></td>
                    <td>
                        <input type="number" name="winner[${index}][percentage]" class="form-control" min="0" max="100" step="0.01" required>
                    </td>
                `;
                percentageTableBody.appendChild(row);
            });
            percentageForm.action = formAction;
            const currentModal = bootstrap.Modal.getInstance(button.closest('.modal'));
            currentModal.hide();
            percentageModal.show();
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const checkboxes = document.querySelectorAll('input[name="winner[]"]');
  let order = [];

  checkboxes.forEach(cb => {
    cb.addEventListener('change', function() {
      const userId = this.value;
      if (this.checked) {
        if (order.length < 3) {
          order.push(userId);
          addBadge(this, order.length);
        } else {
          this.checked = false;
          alert('Only 3 winners allowed');
        }
      } else {
        const idx = order.indexOf(userId);
        if (idx > -1) {
          order.splice(idx, 1);
          removeBadge(this);
          updateBadges();
        }
      }
    });
  });

  function addBadge(cb, pos) {
    const badge = document.createElement('span');
    badge.className = 'badge bg-info ms-1 badge-position';
    badge.textContent = `${pos}st`.replace('1st', '1st').replace('2st','2nd').replace('3st','3rd');
    cb.parentNode.append(badge);
  }

  function removeBadge(cb) {
    const span = cb.parentNode.querySelector('.badge-position');
    if (span) span.remove();
  }

  function updateBadges() {
    document.querySelectorAll('.badge-position').forEach(b=>b.remove());
    order.forEach((uid, idx) => {
      const cb = document.querySelector(`input[name="winner[]"][value="${uid}"]`);
      if (cb) addBadge(cb, idx + 1);
    });
  }
});
</script>



<!--end page wrapper -->
@endsection
