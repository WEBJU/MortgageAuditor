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
    @yield('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/master.css') }}">
</head>
<body class="p-0 d-flex flex-column">
    <img src="{{ asset('/assets/images/img/clock-background.png') }}" class="creative-bg">

    <div id="app">
        @yield('content')
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
    <script src="{{ asset('/assets/vendor/momentjs/moment.js') }}"></script>
    <script src="{{ asset('/assets/vendor/momentjs/moment-with-locales.js') }}"></script>
    <script src="{{ asset('/assets/vendor/momentjs/moment-timezone-with-data.js') }}"></script>
    @yield('scripts')
</body>
</html>
