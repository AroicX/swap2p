@extends('layouts.app')



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
            <div class="breadcrumb-title pr-3">Logs</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class='bx bx-home-alt'></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Administrator</li>
                        <li class="breadcrumb-item active" aria-current="page">Logs</li>
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
                            <h5>Activity Logs</h5>
                        </div>
                        <div class="card-body pt-5 mx-3">

                            <div class="table-responsive">
                                <table class="table table-condensed table-bordered table-hover" id="activites">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Id</th>
                                            <th>User Id</th>
                                            <th>User</th>
                                            <th>Action</th>
                                            <th>Time Ago</th>
                                            <th>Data</th>
                                            <th>Date</th>
                                            <th>Last Ip Used</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                        @if(!$activites->isEmpty())
                                        @foreach($activites as $key => $activity)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$activity->user_id}}</td>
                                            <td>{{$activity->user->firstname.' '.$activity->user->lastname}}</td>
                                            <td>{{$activity->message}}</td>
                                            <td>None</td>
                                            <td>{{$activity->created_at->diffForhumans()}}</td>
                                            <td>{{$activity->created_at->isoFormat('ddd MMM D YYYY h:m:s')}}</td>
                                            <td>{{$activity->user->last_ip_used}}</td>
                                            
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4">No activites yet</td>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>

                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            {{ $activites->links() }}
        </div>


    </div>
</div>
<!--end page-content-wrapper-->

@endsection
