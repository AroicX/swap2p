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
                        <li class="breadcrumb-item active" aria-current="page">To Receive Next</li>
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




            <h5>To Receive Next</h5>
            <hr>

            @if(!$mergeToReceive->isEmpty())
            @foreach($mergeToReceive as $merging)
            @php
            $stage = \App\Models\Stage::where('sid', $merging->stage)->first();
            $record = \App\Models\Record::where('user_id', $merging->user->user_id)->first();
            @endphp
            <div class="col-md-6">

                @if ($record->stage === $merging->stage)
                <div class="card radius-5">

                    <div class="card-body text-center">
                        <div class="user__profile" style="background: {{"#".substr(rand(),0,6)}};">
                            <div class="pt-4">
                                {{ strtoupper(substr($merging->user->firstname,0,1).substr($merging->user->lastname,0,1)) }}
                            </div>
                        </div>
                        <h5 class="mb-0 mt-4 text-white">
                            {{ strtoupper($merging->user->firstname." ".$merging->user->lastname) }}
                        </h5>
                        <hr>

                    </div>
                </div>
                @endif


            </div>

            @endforeach
            @else
            <li class="list-group-item">No mergings yet</li>
            @endif







        </div>
    </div>
</div>
<!--end page-content-wrapper-->

@endsection
