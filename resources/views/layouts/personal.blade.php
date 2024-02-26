<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/assets/images/img/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/images/img/favicon-32x32.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/images/img/favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/fontawesome/css/solid.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/datatables/datatables.min.css') }}">
    @yield('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/master.css') }}">
</head>
<body class="pt-5">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-white bg-white fixed-top shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/personal/attendance') }}">
                    <h4 class="text-primary font-weight-bolder mb-0">Employee Attrition Prediction</h4>
                </a> 
               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto top-nav-menu">
                        <li class="nav-item">
                            <a class="nav-link text-dark @if(Route::currentRouteName() == 'personal-attendance') active @endif" href="{{ url('/personal/attendance') }}">
                                <i class="text-secondary fas fa-clock"></i><span class="text-with-icon">{{ __("My Attendance") }}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark @if(Route::currentRouteName() == 'personal-schedule') active @endif" href="{{ url('/personal/schedule') }}">
                                <i class="text-secondary fas fa-calendar-alt"></i><span class="text-with-icon">{{ __("My Schedule") }}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark @if(Route::currentRouteName() == 'personal-leave') active @endif" href="{{ url('/personal/leave') }}">
                                <i class="text-secondary fas fa-calendar-day"></i><span class="text-with-icon">{{ __("My Leave") }}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ url('/webclock') }}" target="_blank">
                                <i class="text-secondary fas fa-user-clock"></i><span class="text-with-icon">{{ __("Web Clock") }}</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto main-nav-top navmenu">
                        <!-- User Navigation Links -->
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="text-secondary fas fa-globe"></i><span class="text-with-icon text-uppercase">{{ env('APP_LOCALE', 'en') }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right nav-link-menu" aria-labelledby="navbarDropdown">
                                    <ul class="nav-list">
                                        <li><a href="{{ url('lang/en') }}" class="dropdown-item"><i class="flag-icon flag-icon-us mr-2"></i>English</a></li>
                                        <li><a href="{{ url('lang/es') }}" class="dropdown-item"><i class="flag-icon flag-icon-es mr-2"></i>Kiswahili</a></li>
                                            </ul>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="text-secondary fas fa-user-circle"></i><span class="text-with-icon">{{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right nav-link-menu" aria-labelledby="navbarDropdown">
                                    <ul class="nav-list">
                                        <li>
                                            <a class="dropdown-item" href="{{ url('/personal/profile') }}">
                                            <i class="text-secondary fas fa-id-badge"></i><span class="text-with-icon">{{ __("My Profile") }}</span>
                                            </a>
                                        </li>

                                        
                                        <li>
                                            <a class="dropdown-item" href="{{ url('/personal/settings') }}">
                                            <i class="text-secondary fas fa-user-cog"></i><span class="text-with-icon">{{ __("Settings") }}</span>
                                            </a>
                                        </li>

                                        <div class="line"></div>

                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="text-secondary fas fa-sign-out-alt"></i><span class="text-with-icon">{{ __("Log out") }}</span>
                                            </a>
                                        </li>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- message alert -->
    <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
        @if ($success = Session::get('success'))
        <div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="6000" data-autohide="true">
            <div class="toast-header bg-success text-light">
              <strong class="mr-auto">{{ __("Success") }}</strong> 
              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="toast-body">
              {{ $success }}
            </div>
        </div>
        @endif

         @if ($error = Session::get('error'))
        <div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="6000" data-autohide="true">
          <div class="toast-header bg-danger text-light">
            <strong class="mr-auto">{{ __("Error") }}</strong> 
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="toast-body">
            {{ $error }}
          </div>
        </div>
        @endif
    </div>

    <script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/datatables/datatables.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
