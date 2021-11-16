@extends('layouts.app')
@section('content')

<!--page-content-wrapper-->
<div class="page-content-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="breadcrumb-title pr-3">Merging</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class='bx bx-home-alt'></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Viewing Proof</li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto">
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3">
                <div class="user-profile-page">
                    <div class="card radius-5">
                        <div class="card-header">
                            <h5>Approval Request</h5>
                        </div>
                        <div class="card-body pt-5 mx-3">
                            @if(!$proof->isEmpty)
                            @php
                            $merge = \App\Models\Merge::where('id', $proof->mid)->first();
                            $upline = \App\Models\User::where('user_id', $merge->upline)->first();
                            $downline = \App\Models\User::where('user_id', $merge->downline)->first();
                            $status = $proof->status == 0 ? "Unverified" : "Verified";
                            @endphp
                            <ul class="list-group">
                                <li class="list-group-item"><b>UPLINE: </b>
                                    {{ ucwords($upline->firstname." ".$upline->lastname) }}</li>

                                <li class="list-group-item"><b>DOWNLINE: </b>
                                    {{ ucwords($downline->firstname." ".$downline->lastname) }}</li>
                                <li class="list-group-item"><b>Status: </b> {{ $status }} </li>
                                <li class="list-group-item"><b>Extra Note </b><br> {{ $proof->note }} </li>
                                <li class="list-group-item">
                                    <center>
                                        <a href="{{ asset('proofs/'.$proof->file) }}" target="_blank">
                                            <img width="350" height="250" src="{{ asset('proofs/'.$proof->file) }}">
                                        </a>
                                    </center>
                                </li>
                                @if($proof->status == 0)
                                @if($upline->id == Auth::id())
                                <form method="POST" action="{{ route('verify.proof') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $proof->id }}">
                                    <button type="submit" class="mt-3 btn btn-md btn-success">Approve</button>
                                </form>
                                @endif

                                @if($downline->id == Auth::id())
                                <form method="POST" action="{{ route('delete.proof') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $proof->id }}">
                                    <button type="submit" class="mt-3 btn btn-md btn-danger">Delete</button>
                                </form>
                                @endif
                                @endif
                            </ul>
                            @else
                            <div class="alert alert-success">No proof found!</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page-content-wrapper-->

@endsection
