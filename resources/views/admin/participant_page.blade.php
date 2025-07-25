@extends('admin.layouts.main')

@section('mains')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Participants - Week {{ $week_year }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card p-3">
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
            
            <form action="{{ route('select_winner', $week_year) }}" method="POST" id="selectedFormSubmition">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered align-middle" id="example" >
                        <thead class="table-dark">
                            <tr>
                                <th>Sr</th>
                                <th>Choose</th>
                                <th>User Name</th>
                                <th>User ID</th>
                                <th>Lucky Draw Amount</th>
                                <th>Winning Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participants as $index => $participant)
                                @php
                                    $user = $users[$participant->user_id] ?? null;
                                    $isWinner = in_array($participant->id, $result_winners);
                                    $isLoser = in_array($participant->id, $result_losers);
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
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
                                                <input type="checkbox" name="items[]" data-userid="{{ $user->userid }}" value="{{ $participant->id }}">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endif
                                    </td>
                                    <td>{{ $user->first_name ?? 'N/A' }}</td>
                                    <td>{{ $user->userid ?? 'N/A' }}</td>
                                    <td>{{ Helper::get_currency() }} {{ number_format($participant->investment_amount, 2) }}</td>
                                    <td>{{ Helper::get_currency() }} {{ number_format($participant->winning_amount ?? 0, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        
                <div class="mt-3">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    @if(!$result)
                        <button type="submit" class="btn btn-primary">Declare Winners</button>
                    @else
                        <span class="text-success fw-bold">Winners already selected</span>
                    @endif
                </div>
            </form>
        </div>
        <!--end breadcrumb-->
        
    </div>
</div>


{{-- JavaScript for 10-winner selection --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    
    
  const checkboxes = document.querySelectorAll('input[name="items[]"]');
  let order = [];
    localStorage.setItem("items", []);
  checkboxes.forEach(cb => {
    cb.addEventListener('change', function() {
      const userId = this.value;
      if (this.checked) {
        if (order.length < 10) { 
          order.push(userId);
          addBadge(this, order.length);
           localStorage.setItem("items", JSON.stringify(order));
        } else {
          this.checked = false;
          alert('Only 10 winners allowed');
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
    // Show 1st, 2nd, 3rd... and so on up to 10th
    badge.textContent = getRankText(pos);
    cb.parentNode.append(badge);
  }

  function removeBadge(cb) {
    const span = cb.parentNode.querySelector('.badge-position');
    if (span) span.remove();
  }

  function updateBadges() {
    document.querySelectorAll('.badge-position').forEach(b => b.remove());
    order.forEach((uid, idx) => {
      const cb = document.querySelector(`input[name="items[]"][value="${uid}"]`);
      if (cb) addBadge(cb, idx + 1);
    });
    
     localStorage.setItem("items", JSON.stringify(order));
  }
  
  

  // Function to return rank text (1st, 2nd, 3rd, ... 10th)
  function getRankText(pos) {
    switch (pos) {
      case 1: return '1st';
      case 2: return '2nd';
      case 3: return '3rd';
      case 4: return '4th';
      case 5: return '5th';
      case 6: return '6th';
      case 7: return '7th';
      case 8: return '8th';
      case 9: return '9th';
      case 10: return '10th';
      default: return `${pos}th`;
    }
  }
  
  
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        removeItemsFromForm();
        beforeSubmit();
    });
    function beforeSubmit(){
      const form = document.querySelector("#selectedFormSubmition");
      
      form.addEventListener('submit', function(e){
          e.preventDefault();
          removeItemsFromForm();
          
          const items = JSON.parse(localStorage.getItem("items") ? localStorage.getItem("items") : []);
        
          
          items.forEach(item => {
              let newInput = document.createElement('input');
              newInput.classList.add('newlyCreatedInput');
              newInput.name = "winner[]";
              newInput.type = "hidden";
              newInput.value = item;
              form.appendChild(newInput);
            });
          form.submit();
          
      });
  }
  
    function removeItemsFromForm(){
        const inputs = document.querySelectorAll("input.newlyCreatedInput");
        
        inputs.forEach(input => {
            input.remove();
        });
    }
</script>

@endsection
