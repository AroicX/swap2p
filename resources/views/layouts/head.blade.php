<!DOCTYPE html>
<html lang="en" class="dark-theme">
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
        <!--favicon-->
        <link
            rel="icon"
            href="{{ asset('assets/images/favicon-32x32.png') }}"
            type="image/png') }}"
        />
        <!-- Vector CSS -->
        <link
            href="{{
                asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')
            }}"
            rel="stylesheet"
        />
        <!--plugins-->
        <link
            href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}"
            rel="stylesheet"
        />
        <link
            href="{{
                asset(
                    'assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css'
                )
            }}"
            rel="stylesheet"
        />
        <link
            href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}"
            rel="stylesheet"
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
            href="{{ asset('assets/css/dark-sidebar.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('assets/css/dark-theme.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('assets/plugins/select2/css/select2.min.css') }}"
        />

        <link
            href="{{
                asset('assets/plugins/select2/css/select2-bootstrap4.css')
            }}"
            rel="stylesheet"
        />

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        />
        @yield('css')
    </head>

    <body></body>
</html>
