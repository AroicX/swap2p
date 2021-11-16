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
                        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto">
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="user-profile-page">
                    <div class="card radius-5">
                        <div class="card-header">
                            <h5>Update Profile</h5>
                        </div>
                        <div class="card-body pt-5 mx-3">
                            <form method="post" action={{ route('update.profile') }}>
                                @csrf


                                <div class="d-flex align-items-center">
                                    <div
                                        style="font-size:65px; font-weight:bolder; text-align:center;color:white;width:150px;height:150px;border-radius:50%;background: {{"#".substr(rand(),0,6)}};">
                                        <div class="pt-4">
                                            {{ strtoupper(substr(Auth::user()->firstname,0,1).substr(Auth::user()->lastname,0,1)) }}
                                        </div>
                                    </div>

                                </div>

                                <br>
                                <br>
                                <br>

                                <div class="col-12 form-group">
                                    <label>Firstname</label>
                                    <input type="text" name="firstname" class="form-control"
                                        value="{{ $user->firstname }}">
                                </div>

                                <div class="col-12 form-group">
                                    <label>Lastname</label>
                                    <input type="text" name="lastname" class="form-control"
                                        value="{{ $user->lastname }}">
                                </div>
                                <div class="col-12 form-group">
                                    <label>Select gender</label>
                                    <select name="gender" class="form-control">
                                        <option @if($user->gender == "male") {{"selected"}} @endif value="male">Male
                                        </option>
                                        <option @if($user->gender == "female") {{"selected"}} @endif
                                            value="female">Female</option>
                                    </select>
                                </div>

                                <div class="col-12 form-group">
                                    <label>Phone Number</label>
                                    <input type="text"  name="phone" class="form-control"
                                        value="{{ $user->phone }}">
                                </div>

                                <button type="submit"
                                    class="float-right btn btn-md btn-success text-white">Update</button>
                            </form>


                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>


                        </div>
                    </div>
                    @if (Auth::user()->status === 'active')

                    <div class="card radius-5">
                        <div class="card-header">
                            <h5>Change Password</h5>

                        </div>
                        <div class="card-body pt-5 mx-3">
                            <form method="post" action={{ route('update.password') }}>
                                @csrf
                                <div class="col-12 form-group">
                                    <label>Old Password</label>
                                    <input type="password" name="old" class="form-control" required>
                                </div>
                                <div class="col-12 form-group">
                                    <label>New Password</label>
                                    <input type="password" name="new" class="form-control" required>
                                </div>
                                <div class="col-12 form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="c_npassword" class="form-control" required>
                                </div>
                                <button type="submit" class="float-right btn btn-md btn-success text-white">Change
                                    Password</button>
                            </form>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<!--end page-content-wrapper-->
@endsection
