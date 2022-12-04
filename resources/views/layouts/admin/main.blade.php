<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('content.admin_panel') }}</title>

    <!-- CSRF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">  
    <link href="{{ asset('assets/admin/img/favicon.png') }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
    <link href="{{ asset('assets/admin/img/favicon.png') }}" sizes="128x128" rel="shortcut icon" />

    <!-- FONTS -->
    <link href="{{ asset('assets/fonts/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito:400,900 rel="stylesheet">

    <!-- STYLES -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/summernote-bs4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/admin.css') }}" rel="stylesheet">

</head>
<body>
    
    <div id="wrapper">
    
        @include('admin.modules.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.modules.header')
                @yield('content')
            </div>
            @include('admin.modules.footer')
        </div>

    </div>

<!-- JS LIBRARIES -->
<script src="{{ asset('assets/js/jquery.min.js') }}" defer></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
<script src="{{ asset('assets/admin/js/sb-admin-2.min.js') }}" defer></script>
<script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('assets/admin/js/dataTables.bootstrap4.min.js') }}" defer></script>
<script src="{{ asset('assets/admin/js/jquery.magnific-popup.min.js') }}" defer></script>
<script src="{{ asset('assets/admin/js/summernote-bs4.min.js') }}" defer></script>
<script src="{{ asset('assets/admin/js/bootstrap-select.js') }}" defer></script>
<script src="{{ asset('assets/admin/js/purify.min.js') }}" defer></script>
<script src="{{ asset('assets/admin/js/scripts.js') }}" defer></script>

</body>
</html>