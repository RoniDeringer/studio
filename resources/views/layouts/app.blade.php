<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com) & UPDIVISION (https://www.updivision.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by www.creative-tim.com & www.updivision.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <title>
        Studio
    </title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

        <!-- Nucleo Icons -->
    <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/theme/css/material-dashboard-admin.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('css/style.css') }}" rel="stylesheet" />

    @yield('style')

</head>
<body class="g-sidenav-show bg-gray-200">
    
    {{-- MENU --}}
    <x-menu></x-menu>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        {{-- HEADER --}}
        {{-- <x-header></x-header> --}}

        {{-- CONTENT --}}
        <x-nav titlePage="Tables"></x-nav>
        <div class="container-fluid py-4" style="min-height: calc(100vh - 148px);">

            <div class="py-3">
                {{-- Retorno dos controllers --}}
                @if(session()->get('message') && session()->get('type') )
                    <div class="alert {{ session()->get('type') }} alert-dismissible fade show text-white" role="alert">
                        <span class="alert-text">{!! session()->get('message')!!}</span>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Erros retornados pelas validações de request --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            @yield('content')
        </div>
        <x-footer></x-footer>
    </main>
    <x-plugins></x-plugins>

    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('js/theme/core/bootstrap.min.js') }}"></script>
    <script src="{{asset('js/theme/plugins/chartjs.min.js')}}"></script>
    {{-- <script src="{{ asset('assets') }}/js/core/bootstrap.mdataTablesin.js"></script> --}}
    {{-- <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script> --}}
    <script src="{{ asset('assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
    {{-- @stack('js') --}}
    {{-- <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

    </script> --}}
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    {{-- <script src="{{ asset('assets') }}/js/material-dashboard.min.js?v=3.0.0"></script> --}}

    {{-- jquery --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('js/theme/material-dashboard.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
