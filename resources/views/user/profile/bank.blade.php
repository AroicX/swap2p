@extends('layouts.app') @section('content')

<!--page-content-wrapper-->
<div class="page-content-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="breadcrumb-title pr-3">Profile</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}"
                                ><i class="bx bx-home-alt"></i
                            ></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Bank Details
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto"></div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="user-profile-page">
                    <div class="card radius-5">
                        <div class="card-header">
                            <h5>Bank Details</h5>
                        </div>
                        <div class="card-body pt-5 mx-3">
                            <form
                                method="post"
                                action="{{ route('bank.update') }}"
                            >
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Bank Name</label>
                                        <select
                                            class="form-control single-select"
                                            name="bank_code"
                                            id="bank_code"
                                            required
                                        >
                                            <option>Select Bank</option>
                                            @foreach (\App\Models\Bank::all() as
                                            $key => $bank)
                                            <option
                                                value="{{$bank->bank_code}}"
                                            >
                                                {{$bank->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label>Account Number</label>
                                        <input
                                            type="number"
                                            id="account_number"
                                            name="account_number"
                                            class="form-control"
                                            value="{{ $user->account_number ?  $user->account_number : ' ' }}"
                                            required
                                        />
                                    </div>

                                    <style>
                                        .hide {
                                            display: none;
                                        }

                                        .show {
                                            display: block;
                                        }
                                    </style>

                                    <div
                                        id="show_acc"
                                        class="col-md-12 form-group hide"
                                    >
                                        <label>Account Name</label>
                                        <input
                                            id="account_name"
                                            name="account_name"
                                            class="form-control"
                                            disabled
                                        />
                                        <input
                                            id="acc_name"
                                            name="acc_name"
                                            hidden
                                            class="form-control"
                                        />
                                    </div>

                                    <div class="col-md-12">
                                        <div
                                            id="message"
                                            class="
                                                alert
                                                alert-danger
                                                alert-dismissible
                                                fade
                                                hide
                                            "
                                            role="alert"
                                        >
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="alert"
                                                aria-label="Close"
                                            >
                                                <span aria-hidden="true"
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <button
                                    id="verify"
                                    type="button"
                                    class="
                                        float-right
                                        btn btn-md btn-info
                                        text-white
                                    "
                                >
                                    Verify Account Number
                                </button>
                                <button
                                    id="save"
                                    type="submit"
                                    class="
                                        float-right
                                        btn btn-md btn-success
                                        text-white
                                        hide
                                    "
                                >
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page-content-wrapper-->
@endsection
