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

        <title>Swap2p - Create Account</title>
        <!--favicon-->
        <link
            rel="icon"
            href="{{ asset('assets/images/favicon-32x32.png') }}"
            type="image/png"
        />
        <!-- loader-->
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

    <body class="bg-register">
        <!-- wrapper -->
        <div class="wrapper">
            <div
                class="
                    section-authentication-register
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
                                                Create an Account
                                            </h3>
                                        </div>
                                        @if ($errors->any())
                                        <div class="alert alert-warning">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </div>
                                        @endif
                                        <form
                                            method="post"
                                            action="{{ route('register') }}"
                                        >
                                            @csrf
                                            <div class="form-group mt-4">
                                                <label>Email Address</label>
                                                <input
                                                    required
                                                    type="email"
                                                    name="email"
                                                    class="form-control"
                                                />
                                            </div>
                                            <div class="form-group mt-4">
                                                <label>Username</label>
                                                <input
                                                    required
                                                    type="text"
                                                    name="username"
                                                    class="form-control"
                                                />
                                            </div>
                                            <div class="form-row">
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label>Firstname</label>
                                                    <input
                                                        required
                                                        type="text"
                                                        name="firstname"
                                                        class="form-control"
                                                    />
                                                </div>
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label>Lastname</label>
                                                    <input
                                                        required
                                                        type="text"
                                                        name="lastname"
                                                        class="form-control"
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <div
                                                    class="input-group"
                                                    id="show_hide_password"
                                                >
                                                    <input
                                                        required
                                                        class="
                                                            form-control
                                                            border-right-0
                                                        "
                                                        type="password"
                                                        name="password"
                                                    />
                                                    <div
                                                        class="
                                                            input-group-append
                                                        "
                                                    >
                                                        <a
                                                            href="javascript:;"
                                                            class="
                                                                input-group-text
                                                                bg-transparent
                                                                border-left-0
                                                            "
                                                            ><i
                                                                class="
                                                                    bx bx-hide
                                                                "
                                                            ></i
                                                        ></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Password Again</label>
                                                <div class="input-group">
                                                    <input
                                                        required
                                                        class="
                                                            form-control
                                                            border-right-0
                                                        "
                                                        type="password"
                                                        name="password_confirmation"
                                                    />
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label>Referral Code</label>
                                                    <input required
                                                    @if(isset($_GET['ref']))
                                                    value="{{ $_GET["ref"] }}"
                                                    @endif type="text"
                                                    class="form-control"
                                                    name="referral_code" />
                                                </div>
                                                <div
                                                    class="form-group col-md-6"
                                                >
                                                    <label>Phone Number</label>
                                                    <input
                                                        required
                                                        type="number"
                                                        class="form-control"
                                                        name="phone"
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div
                                                    class="
                                                        custom-control
                                                        custom-checkbox
                                                    "
                                                >
                                                    <input
                                                        type="checkbox"
                                                        class="
                                                            custom-control-input
                                                        "
                                                        id="customCheck1"
                                                    />
                                                    <label
                                                        class="
                                                            custom-control-label
                                                        "
                                                        for="customCheck1"
                                                        required
                                                        >I read and agree to
                                                        Terms &
                                                        Conditions</label
                                                    >
                                                </div>
                                            </div>
                                            <div class="btn-group mt-3 w-100">
                                                <button
                                                    type="submit"
                                                    class="
                                                        btn
                                                        btn-primary
                                                        btn-block
                                                    "
                                                >
                                                    Register
                                                </button>
                                                <button
                                                    type="submit"
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
                                        <div class="text-center mt-4">
                                            <p class="mb-0">
                                                Already have an account?
                                                <a href="{{ route('login') }}"
                                                    >Login</a
                                                >
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <img
                                        src="{{
                                            asset(
                                                'assets/images/login-images/register-frent-img.jpg'
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
        <!-- JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!--Password show & hide js -->
        <script>
            $(document).ready(function () {
                $("#show_hide_password a").on("click", function (event) {
                    event.preventDefault();
                    if ($("#show_hide_password input").attr("type") == "text") {
                        $("#show_hide_password input").attr("type", "password");
                        $("#show_hide_password i").addClass("bx-hide");
                        $("#show_hide_password i").removeClass("bx-show");
                    } else if (
                        $("#show_hide_password input").attr("type") ==
                        "password"
                    ) {
                        $("#show_hide_password input").attr("type", "text");
                        $("#show_hide_password i").removeClass("bx-hide");
                        $("#show_hide_password i").addClass("bx-show");
                    }
                });
            });
        </script>
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
