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
                        <li class="breadcrumb-item active" aria-current="page">Upgrade</li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto">
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="user-profile-page">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div class="mb-md-0 mb-3">
                                    <div style="font-size:65px; font-weight:bolder; text-align:center;color:white;width:150px;height:150px;border-radius:50%;background: {{"#".substr(rand(),0,6)}};">
                                        <div class="pt-4">
                                            {{ strtoupper(substr(Auth::user()->firstname,0,1).substr(Auth::user()->lastname,0,1)) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-md-4 flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <h4 class="mb-0"> {{ ucwords(Auth::user()->firstname." ".Auth::user()->lastname) }}</h4>
                                    </div>
                                    <p class="text-primary"><b>Current Stage:</b> 
                                    <span class="text-danger font-weight-bold">{{ $record->stage }}</span>
                                    @if (Auth::user()->email != 'admin@yopmail.com')

                                    @if($record->isQualified === "yes")
                                        <div class="alert alert-success">
                                            <b>You are qualified for the next stage!</b>
                                        </div>
                                        <form method="post" action="{{ route('stage.upgrade') }}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}"/>
                                            <button type="submit" class="btn btn-md btn-success"><b>UPGRADE NOW</b></button>
                                        </form>
                                    @else
                                        <div class="alert alert-warning">
                                            <b>You are not qualified for the next stage!</b>
                                        </div>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <div class="row">
      
            <div class="col-12 col-lg-4">
                <div class="card radius-5 bg-warning">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h4 class="mb-0 font-weight-bold text-dark">&#8358;  {{$stage->amount * $stage->downline}}</h4>
                                <p class="mb-0 text-dark">Expected Amount</p>
                            </div>
                            <div class="font-35 text-dark"><i class='bx bx-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card radius-5 bg-danger">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h4 class="mb-0 font-weight-bold text-white">&#8358; {{$record->downline_left > 0 ? $stage->amount *  $record->downline_left : 0 }}  </h4>
                                <p class="mb-0 text-white">Pending Amount</p>
                            </div>
                            <div class="font-35 text-white"><i class='bx bx-cloud-download'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card radius-5 bg-success">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h4 class="mb-0 font-weight-bold text-white">&#8358; {{$record->downline_brought > 0 ? $stage->amount *  $record->downline_brought : 0 }}  </h4>

                                <p class="mb-0 text-white">Received Amount</p>
                            </div>
                            <div class="font-35 text-white"><i class='bx bx-group'></i>
                            </div>
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
