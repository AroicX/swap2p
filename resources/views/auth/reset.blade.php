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
        <title>@yield('title', 'Swap2p')</title>
        <title>QCASH - Reset Password</title>
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

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        />
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    </head>

    <body class="bg-forgot">
        <!-- wrapper -->
        <div class="wrapper">
            <div
                class="
                    authentication-forgot
                    d-flex
                    align-items-center
                    justify-content-center
                "
            >
                <div class="card shadow-lg forgot-box">
                    <div class="card-body p-md-5">
                        <div class="text-center">
                            <img
                                src="{{
                                    asset('assets/images/icons/forgot-2.png')
                                }}"
                                width="140"
                                alt=""
                            />
                        </div>
                        <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
                        <p class="text-muted">
                            Enter your registered email address to reset the
                            password
                        </p>
                        <form method="POST">
                            @csrf
                            <div class="form-group mt-5">
                                <label>Email Address</label>
                                <input
                                    type="email"
                                    class="
                                        form-control form-control-lg
                                        radius-30
                                    "
                                    placeholder="example@user.com"
                                />
                            </div>
                            <button
                                type="submit"
                                name="submit"
                                class="
                                    btn btn-primary btn-lg btn-block
                                    radius-30
                                "
                            >
                                Send
                            </button>
                            <a
                                href="{{ route('login') }}"
                                class="btn btn-link btn-block"
                                ><i class="bx bx-arrow-back mr-1"></i>Back to
                                Login</a
                            >
                        </form>
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
