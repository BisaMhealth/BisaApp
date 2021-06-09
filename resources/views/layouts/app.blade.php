<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="iimage/x-icon+" href="{{ asset('images/logo.png') }}"/>
        <meta name="csrf-token" content="{!! csrf_token() !!}">
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-reboot.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('css/linear-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/pace-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ripple.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">

        @yield('stylesheet')
        <title>{{config('app.name', 'Bisa GH')}}</title>
    </head>
    <body>
        <div class="pre-loader"></div>
        @yield('content')

        <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
        <script src="{{ asset('js/modernizr.js') }}"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="{{ asset('js/pace.min.js') }}"></script>
        <script src="{{ asset('js/config.js') }}"></script>
        <script src="{{ asset('js/index.js') }}"></script>
        <script src="{{ asset('js/dataTables.min.js') }}"></script>

        @yield('javascript')

        <footer class="site-footer fixed-bottom">
            <div class="text-center">
                <small>Copyright &copy; <?php echo date('Y');  ?> Amazing Mobile Health Limited. All Right Reserved</small>
            </div>
        </footer>
    </body>
</html>
