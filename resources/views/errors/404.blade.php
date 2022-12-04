<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('404 Page') }}</title>

    <!-- FONTS -->
    <link href="//fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Raleway&display=swap" rel="stylesheet">

    <!-- STYLES -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/404.css') }}" rel="stylesheet">

</head>

<body>

    <div class="center-elements">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <x-icon name="404" />
                </div>
                <div class="col-md-6 align-self-center">
                    <h1>404</h1>
                    <h2>{{ __('content.oops') }}</h2>
                    <p class="error-text">{{ __('content.page_not_found') }}</p>
                    <a class="btn green text-uppercase" href="{{ url('/') }}">
                        @if (file_exists(storage_path('installed')))
                        {{ __('content.go_to_homepage') }}</a>
                        @else
                        {{ __('content.install') }}</a>
                        @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JS LIBRARIES -->
    <script src="{{ asset('assets/admin/js/gsap.min.js') }}" defer></script>
    <script src="{{ asset('assets/admin/js/404_animation.js') }}" defer></script>

</body>

</html>
