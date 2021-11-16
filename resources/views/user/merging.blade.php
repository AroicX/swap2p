@extends('layouts.app')
@section('content')

<!--page-content-wrapper-->
<div class="page-content-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="breadcrumb-title pr-3">Back Office</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class='bx bx-home-alt'></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Mergings</li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto">
            </div>
        </div>
        <!--end breadcrumb-->


        <div class="row">


            <style>
                .user__profile {
                    position: relative;
                    top: 10%;
                    left: 35%;
                    font-size: 65px;
                    font-weight: bolder;
                    text-align: center;
                    color: white;
                    width: 150px;
                    height: 150px;
                    border-radius: 50%;
                }

            </style>

            @if (Auth::user()->email != 'admin@yopmail.com')
            <div class="col-sm-12 col-md-6">
            
                <h5>Merge To Pay</h5>
                <hr>

                @if($mergeToPay)
                @php
                $upline = \App\Models\User::where('user_id', $mergeToPay->upline)->first();
                $proof = \App\Models\Proof::where('mid', $mergeToPay->id)->first();
                @endphp
                <div class="card radius-5">
                    <div class="card-body text-center">
                        <div class="user__profile" style="background: {{"#".substr(rand(),0,6)}};">
                            <div class="pt-4">
                                {{ strtoupper(substr($upline->firstname,0,1).substr($upline->lastname,0,1)) }}
                            </div>
                        </div>
                        <h5 class="mb-0 mt-4">{{$upline->firstname.' '.$upline->lastname}}</h5>
                        <p class="mb-0 text-secondary">{{$upline->phone}}</p>
                        <p class="mb-0 text-secondary">Bank:
                            {{ $upline->bank_id ? $upline->bank->name : 'None Provided' }}</p>
                        <p class="mb-0 text-secondary">Account Name: {{$upline->firstname.' '.$upline->lastname  }}</p>
                        <p class="mb-0 text-secondary">Account Number:
                            {{ $upline->account_number ? $upline->account_number : 'None Provided' }}</p>

                        <div class="list-inline contacts-social mt-3"> <a href="javascript:;"
                                class="list-inline-item text-facebook"><i class='bx bxl-facebook'></i></a>
                            <a href="javascript:;" class="list-inline-item text-twitter"><i
                                    class='bx bxl-twitter'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-phone'></i></a>
                            <a href="javascript:;" class="list-inline-item text-skype"><i class='bx bxl-skype'></i></a>
                        </div>
                        <hr>
                        <div class="float-right">

                            @if($proof != null)
                            <a href="{{ route('view.proof', $proof->pid) }}" class="btn btn-md btn-info">VIEW PROOF</a>
                            @endif
                            <a href="{{ route('upload.proof') }}" class="btn btn-md btn-success">UPLOAD
                                PROOF</a>
                        </div>
                    </div>
                </div>
                @else
                <div class="card-body">
                    <div class="alert alert-danger">
                        No merging found
                    </div>
                </div>
                @endif

            </div>


            <div class="col-sm-12 col-md-6">

                <h5>Merge To Receive</h5>
                <hr>

                @if(!$mergeToReceive->isEmpty())
                @foreach($mergeToReceive as $merging)
                @php
                $downline = \App\Models\User::where('user_id', $merging->downline)->first();
                $stage = \App\Models\Stage::where('sid', $merging->stage)->first();
                $proof = \App\Models\Proof::where('mid', $merging->id)->first();


                @endphp
                <div class="card radius-5">
                    <div class="card-body text-center">
                        <div class="user__profile" style="background: {{"#".substr(rand(),0,6)}};">
                            <div class="pt-4">
                                {{ strtoupper(substr($downline->firstname,0,1).substr($downline->lastname,0,1)) }}
                            </div>
                        </div>
                        <h5 class="mb-0 mt-4 text-white">{{ strtoupper($downline->firstname." ".$downline->lastname) }}
                        </h5>
                        <p class="mb-0 text-white">Level {{$stage->sid}}</p>

                        <hr>
                        @if($proof != null)
                        <a href="{{ route('view.proof', $proof->pid) }}" class="btn btn-sm btn-warning text-gray">Show
                            Proof</a>
                        @endif

                    </div>
                    
                </div>
                @endforeach
                @else
                <li class="list-group-item">No mergings yet</li>
                @endif

            </div>

            @endif




        </div>
    </div>
</div>
<!--end page-content-wrapper-->

@endsection
