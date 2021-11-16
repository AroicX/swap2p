@extends('layouts.app')

@section('css')

{{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> --}}
@endsection

@section('content')


<style>
    .dataTables_paginate {
        display: flex;
        justify-content: space-around;
    }

</style>

<!--page-content-wrapper-->
<div class="page-content-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="breadcrumb-title pr-3">All Mergings</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class='bx bx-home-alt'></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Administrator</li>
                        <li class="breadcrumb-item active" aria-current="page">Mergings</li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto">
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12">
                <div class="merge-profile-page">
                    <div class="card radius-5">
                        <div class="card-header">
                            <h5>All Mergings</h5>
                        </div>
                        <div class="card-body pt-5 mx-3">

                            <div class="table-responsive">
                                <table class="table table-condensed table-bordered table-hover" id="myTable">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>id</th>
                                            <th>Upline</th>
                                            <th>Down</th>
                                            <th>Stage</th>
                                            <th>Status</th>
                                            <th>Countdown</th>
                                            <th>Time Ago</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                        @if(!$merges->isEmpty())
                                        @foreach($merges as $key => $merge)
                                        <tr>
                                            {{-- @php
                                                dd($merge->getUpline)
                                            @endphp --}}
                                            <td>{{$key + 1 }}</td>
                                            <td>{{ $merge->getUpline->firstname." ".$merge->getUpline->lastname }}</td>
                                            <td>{{ $merge->getDownline->firstname." ".$merge->getDownline->lastname }}
                                            </td>
                                            <td>Level {{ $merge->stage}}</td>

                                            <td>
                                                @if (intval($merge->status) === 1)
                                                <span class="badge badge-success px-2 py-2">Completed</span>
                                                @else
                                                <span class="badge badge-primary px-2 py-2">Pending</span>

                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                $countdown = \App\Http\Controllers\AdministratorController::countdown($merge->created_at);

                                                @endphp

                                                @if ($countdown >= 24 && intval($merge->status) === 1)
                                                <span class="badge badge-success px-2 py-2">Merged</span>
                                                @elseif($countdown >= 24 && intval($merge->status) === 0)
                                                <span class="badge badge-danger px-2 py-2">Expired</span>
                                                @elseif($countdown <= 24 && intval($merge->status) === 1)
                                                    <span class="badge badge-success px-2 py-2">Merged</span>
                                                    @else
                                                    <span class="badge badge-primary px-2 py-2">{{$countdown}}hrs
                                                        Left</span>
                                                    @endif


                                            </td>
                                            <td>{{$merge->created_at->diffForhumans()}}</td>
                                            <td>{{ $merge->created_at ? $merge->created_at->isoFormat('ddd MMM D YYYY h:m:s') : '' }}
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4">No merges yet</td>
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

@section('js')

<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
       
        // $('#myTable').DataTable({
        //     "order": [
        //         [0, "asc"]
        //     ]
        // });
    });

</script>
@endsection
