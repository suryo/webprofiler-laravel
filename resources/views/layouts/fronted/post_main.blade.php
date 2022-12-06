<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $general->title }}</title>
    <meta name="description" content="{{ $general->description }}">
    @php
    $keywords_array = json_decode($general->keywords);
    $keywords = '';
    if (!is_null($keywords_array)){
        foreach($keywords_array as $key){
            $keywords.= $key->title;
            if( next( $keywords_array ) ) {
                $keywords.= ',';
            }
        }
    }
    @endphp
    <meta name="keywords" content="{{$keywords}}">

    <!-- CSRF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 

    <!-- FONTS -->
    <link href="{{ asset('assets/fonts/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href='//fonts.googleapis.com/css2?family={{$style->font_head}}:wght@700&display=swap' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css2?family={{$style->font_main}}:wght@400;700&display=swap' rel='stylesheet' type='text/css'>

    <!-- STYLES -->
    @include('fronted.styles')
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fronted/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/fronted/css/app.css') }}" rel="stylesheet">

    @if( !empty($general->image_favicon))
    <!-- FAVICONS -->
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ url('/') }}/uploads/img/general/favicon/apple-touch-icon-152x152-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('/') }}/uploads/img/general/favicon/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ url('/') }}/uploads/img/general/favicon/apple-touch-icon-120×120-precomposed.png	">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ url('/') }}/uploads/img/general/favicon/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ url('/') }}/uploads/img/general/favicon/apple-touch-icon-76×76-precomposed.png	">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ url('/') }}/uploads/img/general/favicon/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ url('/') }}/uploads/img/general/favicon/apple-touch-icon-57x57-precomposed.png">
    <link rel="shortcut icon" href="{{ url('/') }}/uploads/img/general/favicon/favicon.png">
    @endif

</head>
<body class="@if($general->loader == 1){{'preloader'}}@endif">
    
    @yield('content')

<!-- JS LIBRARIES -->
<script src="{{ asset('assets/fronted/js/jquery-1.11.2.min.js') }}" defer></script>
<script src="{{ asset('assets/fronted/js/jquery-ui.js') }}" defer></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
<script src="{{ asset('assets/fronted/js/transition.js') }}" defer></script>
<script src="{{ asset('assets/fronted/js/circle-progress.js') }}" defer></script>

@if ($general->cookies_enable == 1)
    <script src="{{ asset('assets/fronted/js/cookie.js') }}" defer></script>
@endif

<script src="{{ asset('assets/fronted/js/custom.js') }}" defer></script>

@if ($general->analytics_code != '')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$general->analytics_code}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{$general->analytics_code}}');
    </script>
@endif

</body>
</html>







