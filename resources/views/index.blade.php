@extends('layouts.app')
@section('content')
<!--page-content-wrapper-->
<div class="page-content-wrapper">
    <div class="page-content">


        @if (Auth::user()->account_number === null)
        <div class="row">
            <div class="col-md-12">
                <h6 class="text-uppercase mb-2">Welcome {{Auth::user()->firstname.' '.Auth::user()->lastname}}</h6>
                <p>Please add your bank details to enable downline's to pay you!</p>
                <a href="{{route('bank')}}">
                    <button class="btn btn-info">Add Bank Details</button>
                </a>
                <br />
                <br />
                <br />
            </div>
        </div>
        @endif


        @if ($showCount)
        <style>
            #clockdiv {
                font-family: sans-serif;
                color: #fff;
                display: inline-block;
                font-weight: 100;
                text-align: center;
                font-size: 30px;
                font-weight: bold;

            }

            #clockdiv>div {
                padding: 15px;
                border-radius: 5px;
                background: #000;
                display: inline-block;
            }

            #clockdiv div>span {
                padding: 20px 25px;
                border-radius: 50%;
                font-weight: bold;
                background: #242424;
                display: inline-block;
            }

            .smalltext {
                padding-top: 5px;
                font-size: 16px;
            }

        </style>
        <h6 class="text-uppercase mb-0">Upgrade Countdown TIMER</h6>
        <hr />
        <div class="row pb-20">
            <div class="col-md-12">
                <div id="clockdiv">
                    <div>
                        <span class="days"></span>
                        <div class="smalltext">Days</div>
                    </div>
                    <div>
                        <span class="hours"></span>
                        <div class="smalltext">Hours</div>
                    </div>
                    <div>
                        <span class="minutes"></span>
                        <div class="smalltext">Minutes</div>
                    </div>
                    <div>
                        <span class="seconds"></span>
                        <div class="smalltext">Seconds</div>
                    </div>
                </div>

            </div>


            <div class="col-md-5">

                <div class="alert alert-warning mx-1 my-5">
                    <li>Please, pay your upline before the timer expires.</li>
                </div>
            </div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"></script>

        <script>
            let countdown = `{{$countdown}}`;
            console.log(countdown);

            console.log('Exp: ', Date.parse(countdown))
            console.log('Now: ', Date.now())

            if (Date.now() > Date.parse(countdown)) {
                console.log('exipred')
            }


            function getTimeRemaining(endtime) {
                const total = Date.parse(endtime) - Date.parse(new Date());
                const seconds = Math.floor((total / 1000) % 60);
                const minutes = Math.floor((total / 1000 / 60) % 60);
                const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
                const days = Math.floor(total / (1000 * 60 * 60 * 24))

                return {
                    total,
                    days,
                    hours,
                    minutes,
                    seconds
                };

            }

            function initializeClock(id, endtime) {
                const clock = document.getElementById(id);
                const daysSpan = clock.querySelector('.days');
                const hoursSpan = clock.querySelector('.hours');
                const minutesSpan = clock.querySelector('.minutes');
                const secondsSpan = clock.querySelector('.seconds');

                function updateClock() {
                    const t = getTimeRemaining(endtime);

                    daysSpan.innerHTML = `0${t.days}`;
                    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);


                    // console.log('checking',t.seconds);

                    if (Date.now() > Date.parse(countdown)) {
                        expired();
                    }

                    if (t.total <= 0) {
                        clearInterval(timeinterval);
                        expired();
                    }
                }
                updateClock();
                const timeinterval = setInterval(updateClock, 1000);
            }

            function expired() {
                axios.get(`/expired/acount`, {
                        headers: {
                            'Authorization': 'Bearer sk_test_57c8d08fac29b5c49b06cf06a7fa45b13cd6441e'
                        }
                    })
                    .then(response => {
                        return window.location = '/backoffice/login'
                        window.location.reload();
                    })
                    .catch((error) => {
                        return window.location = '/backoffice/login'
                        window.location.reload();
                    })
            }
            const deadline = new Date(Date.parse(new Date()) + 1 * 24 * 60 * 60 * 1000);
            initializeClock('clockdiv', countdown);

        </script>
        <br />
        <br />
        <br />
        @endif
        <h6 class="text-uppercase mb-0">Dashboard</h6>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-danger p-3">
                    You can copy your referral link and share.
                    <br>
                    <div class="form-group">
                        <p class="form-control" style="height: 60px; overflow-x: scroll"
                            href="{{ config('app.url')}}signup/{{ Auth::user()->user_id }}" target="_blank">
                            {{ config('app.url')}}signup/{{ Auth::user()->user_id }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card radius-5 bg-primary">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h4 class="mb-0 font-weight-bold text-white"> 0{{$stage->sid }}</h4>
                                <p class="mb-0 text-white">Level</p>
                            </div>
                            <div class="font-35 text-white"><i class='bx bx-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card radius-5 bg-warning">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h4 class="mb-0 font-weight-bold text-dark">&#8358;
                                    {{$stage->amount * $stage->downline}}</h4>
                                <p class="mb-0 text-dark">Expected Amount</p>
                            </div>
                            <div class="font-35 text-dark"><i class='bx bx-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card radius-5 bg-danger">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h4 class="mb-0 font-weight-bold text-white">&#8358;
                                    {{$record->downline_left > 0 ? $stage->amount *  $record->downline_left : 0 }} </h4>
                                <p class="mb-0 text-white">Pending Amount</p>
                            </div>
                            <div class="font-35 text-white"><i class='bx bx-cloud-download'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card radius-5 bg-success">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h4 class="mb-0 font-weight-bold text-white">&#8358;
                                    {{$record->downline_brought > 0 ? $stage->amount *  $record->downline_brought : 0 }}
                                </h4>
                                <p class="mb-0 text-white">Received Amount</p>
                            </div>
                            <div class="font-35 text-white"><i class='bx bx-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-info p-3">
                    View queue to know who, is in line to receive payment next.
                    <br>
                    <div class="form-group">
                        <a href={{route('queue')}}>
                            <button class="btn btn-primary">View queue</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <h6 class="text-uppercase mb-0">Payments</h6>
        <hr />
        <div class="row">
            <div class="col-12 ">
                <div class="user-profile-page">
                    <div class="card radius-5">
                        <div class="card-body">
                            <div class="card-title">
                                <h5>Recent Payments</h5>
                            </div>
                            <hr />
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Level</th>
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
                                            $user = \App\Models\User::where('user_id', $payment->downline_id)->first();
                                            @endphp
                                            <td>{{ $user->firstname." ".$user->lastname}}</td>
                                            <td> Level {{ $payment->sid }}</td>
                                            <td>&#8358; {{ $payment->amount.'.00' }}</td>
                                            <td>{{ $payment->proof->note }}</td>
                                            <td>{{ $payment->created_at }}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="3">No transactions yet</td>
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
@section('script')
@endsection
