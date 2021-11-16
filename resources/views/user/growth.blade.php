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
                        <li class="breadcrumb-item active" aria-current="page">Growth</li>
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





            <hr>


            @if(!$mergeToReceive->isEmpty())
            <h5>Total of <span class="badge">{{count($mergeToReceive)}}</span> need help.</h5>
            <hr>
            @foreach($mergeToReceive as $merging)
            @php
            $stage = \App\Models\Stage::where('sid', $merging->stage)->first();
            // $record = \App\Models\Record::where('user_id', $merging->user->user_id)->first();
            @endphp
            @if ($merging->user)

            <div class="col-md-6">
                <div class="card radius-5">
                    <div class="card-header">Id: {{$merging->id}}</div>
                    <div class="card-body text-center">
                        <div class="user__profile" style="background: {{"#".substr(rand(),0,6)}};">
                            <div class="pt-4">
                                {{ strtoupper(substr($merging->user->firstname,0,1).substr($merging->user->lastname,0,1)) }}
                            </div>
                        </div>
                        <h5 class="mb-0 mt-4 text-white">
                            {{ strtoupper($merging->user->firstname." ".$merging->user->lastname) }}
                        </h5>

                        <p class="mb-0 text-white">Level {{$stage->sid}}</p>
                        <hr>
                        <div class="list-inline contacts-social mt-3"> 
                            Share on whatsapp
                            <a href="https://whatsapp.com/send?text=<?php echo 'Join Swap2p using '.strtoupper($merging->user->firstname." ".$merging->user->lastname).' referral code .'?>
                            {{ config('app.url')}}signup/{{ $merging->user->user_id }}"
                              target="_blank"
                                class="list-inline-item text-facebook"><i class='bx bxl-whatsapp'></i></a>

                         
                        </div>
                        <h5 class="mb-0 mt-4">Break down:</h5>
                        <p class="mb-0 text-secondary">Downlines Brought: {{$merging->downline_brought}}</p>
                        <p class="mb-0 text-secondary">Downlines Left: {{$merging->downline_left}}</p>
                    </div>

                </div>
            </div>
            @endif

            @endforeach
            @else
            <li class="list-group-item">No mergings yet</li>
            @endif






        </div>
    </div>
</div>
<!--end page-content-wrapper-->

@endsection
