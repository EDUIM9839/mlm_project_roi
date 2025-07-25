@extends('user.layouts.main')

@section('mains')
<!--start page wrapper -->
<style>
.btn.active {
    font-weight: bold;
    color: white;
    background-color: #0c4c9b;
    border: none;
}

a {
    color: #ffffff;
}

.yes {
    color: white;
    background-color: #399ad0;
    border: none;
}
</style>

<div class="page-wrapper">
    <div class="page-content">
        <h6 class="mb-0 text-uppercase alert">My Team</h6>
        <hr />

        <div class="row">
            <div class="col-4 d-flex justify-content-start">
                <a type="button" class="btn btn-info yes" id="activeButton" href="?status=active">Active</a>
            </div>
            <div class="col-4 d-flex justify-content-center">
                <a type="button" class="btn btn-info yes" id="allUsersButton" href="?">All Users</a>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a type="button" class="btn btn-info yes" id="inactiveButton" href="?status=inactive">Inactive</a>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="card border-dark">
                <div class="border-dark table-responsive text-nowrap">
                    <div id="example_wrapper" class="dataTables_wrapper no-footer" style="padding:5px;">
                        <table class="table dataTable no-footer" id="example" aria-describedby="example_info">
                            <thead>
                                <tr class='table-dark'>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>UserId</th>
                                    <th>Level</th>
                                    <th>Invest Amount</th>
                                    <th>Joining Date</th>
                                    <th>Activated Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($team as $key => $tu)
                                    @foreach($tu as $t)
                                        @php
                                            $package = DB::table('user_package')->where('status', 'approved')->where('user_id', $t->id)->first();
                                            $package_amount = DB::table('user_package')->where('status', 'approved')->where('user_id', $t->id)->sum('amount');
                                            $hasActivePackage = $package ? true : false;
                                            $activatedDate = $hasActivePackage ? $package->created_at : null;
                                        @endphp

                                        @if($status === 'active' && $hasActivePackage)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $t->first_name }} {{ $t->last_name }}</td>
                                                <td>{{ $t->userid }}</td>
                                                <td>{{ $key + 1 }}</td>
                                                <td> {{ Helper::get_currency()}}{{ $package_amount }}</td>
                                                <td>{{ Helper::formatted_date($t->created_at) }}</td>
                                                <td>{{ Helper::formatted_date($activatedDate) }}</td>
                                                <td><span class='text text-success'>Active</span></td>
                                            </tr>
                                        @elseif($status === 'inactive' && !$hasActivePackage)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $t->first_name }} {{ $t->last_name }}</td>
                                                <td>{{ $t->userid }}</td>
                                                <td>{{ $key + 1 }}</td>
                                                   <td>{{ Helper::get_currency()}}{{ $package_amount }}</td>
                                                 <td>{{ Helper::formatted_date($t->created_at) }}</td>
                                                <td>NA</td>
                                                <td><span class='text text-danger'>Inactive</span></td>
                                            </tr>
                                        @elseif($status === null)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $t->first_name }} {{ $t->last_name }}</td>
                                                <td>{{ $t->userid }}</td>
                                                <td>{{ $key + 1 }}</td>
                                                   <td>{{ Helper::get_currency()}}{{ $package_amount }}</td>
                                                 <td>{{ Helper::formatted_date($t->created_at) }}</td>
                                                <td>@if($activatedDate==null) NA @else {{ Helper::formatted_date($activatedDate) }} @endif</td>
                                                <td>
                                                    @if($hasActivePackage)
                                                        <span class='text text-success'>Active</span>
                                                    @else
                                                        <span class='text text-danger'>Inactive</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var activeButton = document.getElementById("activeButton");
    var allUsersButton = document.getElementById("allUsersButton");
    var inactiveButton = document.getElementById("inactiveButton");

    function handleButtonClick(event) {
        // Prevent default link behavior
        event.preventDefault();

        // Remove active class from all buttons
        activeButton.classList.remove("active");
        allUsersButton.classList.remove("active");
        inactiveButton.classList.remove("active");

        // Add active class to the clicked button
        this.classList.add("active");
        
        // Optionally, you can navigate to the URL
        window.location.href = this.href;
    }

    // Attach click event listeners to each button
    activeButton.addEventListener("click", handleButtonClick);
    allUsersButton.addEventListener("click", handleButtonClick);
    inactiveButton.addEventListener("click", handleButtonClick);

    // Check URL parameter on page load and set initial active state
    var urlParams = new URLSearchParams(window.location.search);
    var initialStatus = urlParams.get("status");

    if (initialStatus === "active") {
        activeButton.classList.add("active");
    } else if (initialStatus === "inactive") {
        inactiveButton.classList.add("active");
    } else {
        allUsersButton.classList.add("active");
    }
});
</script>
@endsection
