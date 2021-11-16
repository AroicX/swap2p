@extends('layouts.app')
@section('content')

<!--page-content-wrapper-->
<div class="page-content-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="breadcrumb-title pr-3">My Downlines</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class='bx bx-home-alt'></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Downlines</li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto">
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="user-profile-page">
                    <div class="card radius-5">
                        <div class="card-body pt-5 mx-3">
                            <div class="alert alert-success p-3">
                                You can copy your referral link and share.
                                <br>
                                <div class="form-group">
                                    <p class="form-control" style="height: 60px; overflow-x: scroll"
                                        href="{{ config('app.url')}}signup/{{ Auth::user()->user_id }}" target="_blank">
                                        {{ config('app.url')}}signup/{{ Auth::user()->user_id }}
                                    </p>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-condensed table-bordered table-hover">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!$downlines->isEmpty())
                                        @foreach($downlines as $downline)
                                        <tr>
                                            <td>{{ $downline->firstname." ".$downline->lastname }}</td>
                                            <td>{{ $downline->phone }}</td>
                                            <td>{{ $downline->status }}</td>
                                            <td>{{ $downline->created_at }}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4">No downline yet</td>
                                        </tr>
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
