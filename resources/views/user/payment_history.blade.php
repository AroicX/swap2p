@extends('layouts.app')
@section('content')

<!--page-content-wrapper-->
<div class="page-content-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="breadcrumb-title pr-3">My Payments</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class='bx bx-home-alt'></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Payment History</li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto">
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 ">
                <div class="user-profile-page">
                    <div class="card radius-5">
                        <div class="card-header">
                            <h5>Payment To Upline</h5>
                        </div>
                        <div class="card-body pt-5 mx-3">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr >
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$uplines->isEmpty())
                                        @foreach($uplines as $payment)
                                        <tr>
                                            @php
                                               $user = \App\Models\User::where('user_id', $payment->upline_id)->first() 
                                            @endphp
                                            <td>{{ $user->firstname." ".$user->lastname}}</td>
                                            <td>&#8358;  {{ $payment->amount.'.00' }}</td>
                                            <td>{{ $payment->proof->note }}</td>
                                            <td>{{ $payment->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="3">No transactions yet</td></tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="user-profile-page">
                    <div class="card radius-5">
                        <div class="card-header">
                            <h5>Payment Received from Downline</h5>
                        </div>
                        <div class="card-body pt-5 mx-3">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr >
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$downlines->isEmpty())
                                        @foreach($downlines as $payment)
                                        <tr>
                                            @php
                                               $user = \App\Models\User::where('user_id', $payment->downline_id)->first() 
                                            @endphp
                                            <td>{{ $user->firstname." ".$user->lastname}}</td>
                                            <td>&#8358;  {{ $payment->amount.'.00' }}</td>
                                            <td>{{ $payment->proof->note }}</td>
                                            <td>{{ $payment->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="3">No transactions yet</td></tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page-content-wrapper-->

@endsection
