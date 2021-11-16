@extends('layouts.app')
@section('content')

<!--page-content-wrapper-->
<div class="page-content-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="breadcrumb-title pr-3">Profile</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class='bx bx-home-alt'></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto">
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="user-profile-page">
            <div class="card radius-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-7 border-right">
                            <div class="d-md-flex align-items-center">
                                <div class="mb-md-0 mb-3">
                                    <div
                                        style="font-size:65px; font-weight:bolder; text-align:center;color:white;width:150px;height:150px;border-radius:50%;background: {{"#".substr(rand(),0,6)}};">
                                        <div class="pt-4">
                                            {{ strtoupper(substr(Auth::user()->firstname,0,1).substr(Auth::user()->lastname,0,1)) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-md-4 flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <h4 class="mb-0">
                                            {{ ucwords(Auth::user()->firstname." ".Auth::user()->lastname) }}</h4>
                                        <p class="mb-0 ml-auto font-weight-bold">
                                            {{ "@".strtolower(Auth::user()->username) }}</p>
                                    </div>
                                    <p class="text-primary"><i class='bx bx-calendar'></i>
                                        {{ Auth::user()->created_at }}</p>
                                    <a href="{{route('edit.profile')}}" class="btn btn-primary">Edit Profile</a>
                                    <a href="" class="btn btn-outline-secondary ml-2">Log Out</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <table class="table table-sm table-borderless mt-md-0 mt-3">
                                <tbody>
                                    <tr>
                                        <th>Email :</th>
                                        <td>{{ Auth::user()->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Phone No.:</th>
                                        <td>{{ Auth::user()->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender:</th>
                                        <td>{{ Auth::user()->gender }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bank:</th>
                                        <td>{{ Auth::user()->bank_id ? Auth::user()->bank->name : 'None Provided' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Account Number:</th>
                                        <td>{{ Auth::user()->account_number ? Auth::user()->account_number : 'Null' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Account Status:</th>
                                        <td>{{ Auth::user()->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page-content-wrapper-->

@endsection
