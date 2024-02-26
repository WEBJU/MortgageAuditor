<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/fontawesome/css/solid.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendor/datatables/datatables.min.css') }}">
    @yield('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/master.css') }}">
</head>
<body>
    <div class="wrapper">
        <!-- sidebar navigation component -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <a class="navbar-brand" href="{{ url('/admin/dashboard') }}">
                    <h4 class="text-white font-weight-bolder">Mortgage Auditor</h3>
                </a> 
            </div>
            <ul class="list-unstyled components ">
                <li>
                    <a class="nav-link" href="{{ url('/admin/dashboard') }}">
                        <i class="text-secondary fas fa-poll"></i><span class="text-with-icon">{{ __("Dashboard") }}</span>
                    </a>
                </li>
                
                <li>
                    <a class="nav-link" href="{{ url('/admin/default') }}">
                        <i class="text-secondary fas fa-clock"></i><span class="text-with-icon">{{ __("Prediction Engine") }}</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ url('/admin/default/upload') }}">
                        <i class="text-secondary fas fa-upload"></i><span class="text-with-icon">{{ __("Batch Prediction") }}</span>
                    </a>
                </li>
                
                
                <li>
                    <a class="nav-link" href="{{ url('/admin/reports') }}">
                        <i class="text-secondary fas fa-chart-pie"></i><span class="text-with-icon">{{ __("Reports") }}</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ url('/admin/users') }}">
                        <i class="text-secondary fas fa-users"></i><span class="text-with-icon">{{ __("Users") }}</span>
                    </a>
                </li>
                
            </ul>
        </nav>
        <!-- end of sidebar component -->

        <div id="body" class="active">
            <!-- navbar navigation component -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                {{-- <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="text-secondary fas fa-bars"></i><span></span>
                </button> --}}

                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <i class="text-secondary fas fa-angle-down align-middle"></i><span></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto main-nav-top navmenu">
                        <!-- User Navigation Links -->
                       
                       

                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="text-secondary fas fa-user-circle"></i><span class="text-with-icon">{{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right nav-link-menu" aria-labelledby="navbarDropdown">
                                    <ul class="nav-list">
                                        <li>
                                            <a class="dropdown-item" href="{{ url('/admin/account') }}">
                                            <i class="text-secondary fas fa-user-tie"></i><span class="text-with-icon">{{ __("My Account") }}</span>
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
            </nav>
            <!-- end of navbar navigation -->

            <main class="py-4">
                @yield('content')
            </main>
        </div>
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
    <script src="{{ asset('/assets/js/sidebar.js') }}"></script>
    <script src="{{ asset('/assets/vendor/datatables/datatables.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
