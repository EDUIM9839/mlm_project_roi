@extends('user.layouts.main')

@section('mains')

<style>
    .rank-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        position: relative;
        width: 300px;
        margin: 20px auto;
    }

    .rank-indicator {
        position: absolute;
        top: -15px;
        background: gold;
        color: black;
        padding: 5px 15px;
        font-weight: bold;
        border-radius: 20px;
    }

    .rank-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background-position: center;
        background-size: contain;
        margin-top: 20px;
        background-repeat: no-repeat;
    }

    .details {
        margin-top: 15px;
        text-align: center;
    }

    .name span {
        font-weight: bold;
        font-size: 20px;
    }

    .city-amt {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        font-size: 16px;
        color: #333;
    }

    .city-amt div {
        flex: 1;
        text-align: center;
    }

    .no-data {
        text-align: center;
        font-size: 18px;
        margin-top: 50px;
        color: #999;
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Winner Of The Week</li>
                    </ol>
                </nav>
            </div>
        </div>

        @if(count($topEarners) > 0)
            <div class="row justify-content-center">
               
                @foreach($topEarners as $index => $earner)
                    <div class="card rank-card">
                        <div class="rank-indicator">
                            @if($index == 0) 1st
                            @elseif($index == 1) 2nd
                            @elseif($index == 2) 3rd
                            @else {{ $index + 1 }}th @endif
                        </div>
                        <div class="rank-img" style="background-image: url('{{ $earner->image ? Storage::url('app/profileupload/' . $earner->image) : url('/public/assets/images/theme/ranks/' . ($index + 1) . 's.png') }}');"></div>
                        <div class="details">
                            <div class="name"><span>{{ ucfirst(strtolower($earner->first_name)) }} {{ ucfirst(strtolower($earner->last_name)) }}</span></div>
                            <div class="city-amt">
                                <div class="city">{{ ucfirst(strtolower($earner->userid)) }}</div>
                                <!--<div class="amount">-->
                                    
                                <!--</div>-->
                            </div>
                                    <p style=""> Amount: {{ Helper::get_currency() . ($earner->winning_amount ?? '0') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-data">No winners for last week.</div>
        @endif
    </div>
</div>

@endsection
