<?php
if(Auth::check()){
	header("Location: profile");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta
            name="description"
            content="Swap2p is a crowd funding program that is implemented for the finacial stability of communities, that on a peer to peer business logic."
        />

        <title>Swap2p - Login</title>
        <!--favicon-->
        <link
            rel="icon"
            href="{{ asset('assets/images/favicon-32x32.png') }}"
            type="image/png"
        />

        <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
        <script src="{{ asset('assets/js/pace.min.js') }}"></script>
        <!-- Bootstrap CSS -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/css/bootstrap.min.css') }}"
        />
        <!-- Icons CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}" />

        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        />
    </head>

    <body class="bg-login">
        <!-- wrapper -->
        <div class="wrapper">
            <div
                class="
                    section-authentication-login
                    d-flex
                    align-items-center
                    justify-content-center
                "
            >
                <div class="row">
                    <div class="col-12 col-lg-10 mx-auto">
                        <div class="card radius-5">
                            <div class="row no-gutters">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5">
                                        <div class="text-center">
                                            <img
                                                src="{{
                                                    asset(
                                                        'assets/images/logo-icon.png'
                                                    )
                                                }}"
                                                width="80"
                                                alt=""
                                            />
                                            <h3 class="mt-4 font-weight-bold">
                                                Welcome Back
                                            </h3>
                                        </div>
                                        <form
                                            method="POST"
                                            action="{{ route('signin') }}"
                                        >
                                            @csrf @if ($errors->any())
                                            <div class="alert alert-warning">
                                                @foreach ($errors->all() as
                                                $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </div>
                                            @endif
                                            <div class="form-group mt-4">
                                                <label>Email Address</label>
                                                <input
                                                    type="email"
                                                    name="email"
                                                    class="form-control"
                                                    placeholder="Enter your email address"
                                                    required
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input
                                                    type="password"
                                                    name="password"
                                                    class="form-control"
                                                    placeholder="Enter your password"
                                                    required
                                                />
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <div
                                                        class="
                                                            custom-control
                                                            custom-switch
                                                        "
                                                    >
                                                        <input
                                                            type="checkbox"
                                                            class="
                                                                custom-control-input
                                                            "
                                                            id="customSwitch1"
                                                            checked
                                                        />
                                                        <label
                                                            class="
                                                                custom-control-label
                                                            "
                                                            for="customSwitch1"
                                                            >Remember Me</label
                                                        >
                                                    </div>
                                                </div>
                                                <div
                                                    class="
                                                        form-group
                                                        col
                                                        text-right
                                                    "
                                                >
                                                    <a
                                                        href="{{
                                                            route('reset')
                                                        }}"
                                                        ><i
                                                            class="
                                                                bx
                                                                bxs-key
                                                                mr-2
                                                            "
                                                        ></i
                                                        >Forgot Password?</a
                                                    >
                                                </div>
                                            </div>
                                            <div class="btn-group mt-3 w-100">
                                                <button
                                                    type="subnit"
                                                    name="submit"
                                                    class="
                                                        btn
                                                        btn-primary
                                                        btn-block
                                                    "
                                                >
                                                    Log In
                                                </button>
                                                <button
                                                    type="subnit"
                                                    name="submit"
                                                    class="btn btn-primary"
                                                >
                                                    <i
                                                        class="
                                                            lni lni-arrow-right
                                                        "
                                                    ></i>
                                                </button>
                                            </div>
                                        </form>
                                        <hr />
                                        <div class="text-center">
                                            <p class="mb-0">
                                                Don't have an account?
                                                <a href="{{ route('signup') }}"
                                                    >Sign up</a
                                                >
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <img
                                        src="{{
                                            asset(
                                                'assets/images/login-images/login-frent-img.jpg'
                                            )
                                        }}"
                                        class="card-img login-img h-100"
                                        alt="..."
                                    />
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end wrapper -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";


            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
            @endif
        </script>
    </body>
</html>
