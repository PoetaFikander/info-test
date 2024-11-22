<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- other -->
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    <!-- my -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


</head>
<body>
<div id="app">
    {{--    <!-- overlay-spinner -->--}}
    <div id="overlay-spinner">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <nav class="navbar navbar-expand-xl shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            <div class="collapse navbar-collapse" id="navbar-content">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}"><i class="bi bi-house"></i></a>
                        </li>

                        @canany(['show-mif-full','show-mif-limited'])
                            {{-- <!-- menu raporty  --> --}}
                            @include('layouts.navbars.reports')
                        @endcanany

                        {{-- <!-- menu serwis  --> --}}
                        @include('layouts.navbars.service')


                    @if (Auth::user()->hasRole('Super Admin'))
                            {{-- <!-- menu konfiguracja  --> --}}
                            @include('layouts.navbars.configuration')
                        @endif

                        {{-- <!-- testy --> --}}
                        {{-- @include('layouts.navbars.nav-test') --}}
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    @include('layouts.navbars.authentication-links')
                </ul>

            </div>
        </div>
    </nav>
    <main class="py-1">
        <div class="container">
            <div class="row justify-content-center mt-1">
                <div class="col-xl-12 p-0">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success text-center" role="alert">{{ $message }}</div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</div>

{{--<!-- =========================================================================================== -->--}}
{{--<!-- js other -->--}}
{{--<script src="{{ asset('DataTables/jquery.dataTables.min.js') }}" type="module"></script>--}}
{{--<script src="{{ asset('DataTables/dataTables.bootstrap5.min.js') }}" type="module"></script>--}}
{{--<script src="{{ asset('DataTables/dataTables.select.min.js') }}" type="module"></script>--}}
{{--<script src="{{ asset('Datepicker/bootstrap-datepicker.min.js') }}" type="module"></script>--}}
{{--<!-- js my global -->--}}
<script src="{{ asset('js/init.js') }}" type="module"></script>
{{--<!-- js for module -->--}}
@hasSection('js')
    @yield('js')
@endif
{{--<!-- js my post -->--}}
{{--<script src="{{ asset('js/post.js') }}" type="module"></script>--}}
{{--<!-- =========================================================================================== -->--}}

</body>
</html>
