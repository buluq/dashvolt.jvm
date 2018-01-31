{{-- \resources\views\layouts\app.blade.php --}}

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dashvolt') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        @yield('cssinline')
        @stack('css')
        @stack('stylesheet')
    </head>

    <body>
        <div id="app">
            @if (Auth::check())
                @component('components.navbar')
                @endcomponent
            @else
                <div style="min-height: 64px;"></div>
            @endif

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @include('errors.list')
                    </div>
                </div>
            </div>

            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        @yield('jsinline')
        @stack('javascripts')
        @stack('javascript')
    </body>
</html>
