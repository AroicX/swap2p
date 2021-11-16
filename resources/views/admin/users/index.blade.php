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
            <div class="breadcrumb-title pr-3">All Users</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class='bx bx-home-alt'></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Administrator</li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto">
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12">
                <div class="user-profile-page">
                    <div class="card radius-5">
                        <div class="card-header">
                            <h5>All Users</h5>
                        </div>
                        <div class="card-body pt-5 mx-3">

                            <div class="table-responsive">
                                <table class="table table-condensed table-bordered table-hover" id="myTable">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Id</th>
                                            <th>User Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Bank Name</th>
                                            <th>Account Name</th>
                                            <th>Account Number</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                        @if(!$users->isEmpty())
                                        @foreach($users as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user->user_id }}</td>
                                            <td>{{ $user->firstname." ".$user->lastname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->bank_id ? $user->bank->name : 'None Provided'}}</td>
                                            <td>{{ $user->account_name ? $user->account_name : 'None Provided'}}</td>
                                            <td>{{ $user->account_number ? $user->account_number : 'None Provided'}}
                                            </td>
                                            <td>
                                                @if ($user->status === 'active')
                                                <span
                                                    class="badge badge-success px-2 py-2">{{strtoupper($user->status)}}</span>
                                                @elseif($user->status === 'pending')
                                                <span
                                                    class="badge badge-warning px-2 py-2">{{strtoupper($user->status)}}</span>
                                                @elseif($user->status === 'dormant')
                                                <span
                                                    class="badge badge-primary px-2 py-2">{{strtoupper($user->status)}}</span>
                                                @elseif($user->status === 'block')
                                                <span
                                                    class="badge badge-danger px-2 py-2">{{strtoupper($user->status)}}</span>
                                                @else
                                                {{strtoupper($user->status)}}
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at ? $user->created_at->isoFormat('ddd MMM D YYYY h:m:s') : '' }}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Actions</button>
                                                    <div class="dropdown-menu" style="">
                                                        {{-- <a class="dropdown-item" href={{route('admin.delete_user',$user->user_id)}}>Delete</a>
                                                        --}}
                                                        {{-- <a class="dropdown-item" href={{route('admin.deleteMerings',$user->user_id)}}>Delete
                                                        Mergings</a> --}}
                                                        <a class="dropdown-item" href="#">Deactivate</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4">No users yet</td>
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
    });

</script>
@endsection
