<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ trans('installer_messages.title') }}</title>
    <link href="{{ asset('assets/admin/img/favicon.png') }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
    <link href="{{ asset('assets/admin/img/favicon.png') }}" sizes="128x128" rel="shortcut icon" />

    <link href="{{ asset('assets/fonts/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito:400,900" rel="stylesheet">
    
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/admin/css/admin.css') }}" rel="stylesheet">
    @yield('style')

</head>

<body>
    <div class="installer d-flex justify-content-center align-items-center w-100">
        <div class="bg-white rounded shadow">
            <div class="header text-center px-5 py-4">
                <img src="{{ asset('assets/admin/img/blanco_logo.png') }}" class="img-fluid" />
            </div>
            <ul class="step d-flex justify-content-center align-items-center flex-row-reverse m-0 p-0">
                
                <li class="divider bg-dark"></li>
                <li class="item bg-dark text-white text-center rounded-circle {{ isActive('LaravelInstaller::final') }}">
                    <i class="fa-solid fa-rectangle-list"></i>
                </li>
                
                <li class="divider bg-dark"></li>
                <li class="item bg-dark text-white text-center rounded-circle {{ isActive('LaravelInstaller::permissions') }}">
                    <i class="fa-solid fa-key"></i>
                </li>
                
                <li class="divider bg-dark"></li>
                <li class="item bg-dark text-white text-center rounded-circle {{ isActive('LaravelInstaller::requirements') }}">
                    <i class="fa-regular fa-rectangle-list"></i>
                </li>
                
                <li class="divider bg-dark"></li>
                <li class="item bg-dark text-white text-center rounded-circle {{ isActive('LaravelInstaller::environment') }}">
                    <i class="fa-solid fa-pen"></i>
                </li>
                
                <li class="divider bg-dark"></li>
                <li class="item bg-dark text-white text-center rounded-circle {{ isActive('LaravelInstaller::welcome') }}">
                    <i class="fa-solid fa-house"></i>
                </li>
                
                <li class="divider bg-dark"></li>
            </ul>
            <div class="main px-5 py-4">
                @yield('container')
            </div>
        </div>
    </div>
</body>

@yield('scripts')

</html>