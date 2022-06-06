<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <!-- Custom Styles -->
  <link href="{{ asset('css/mediclo.css') }}" rel="stylesheet">

  <!-- Package --->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
  @livewireStyles
  @stack('styles')
</head>

<body>
  <div id="app">
    @include('includes.navbar')

    <main class="py-4">
      @yield('content')
      @include('includes.footer')
    </main>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
  @livewireScripts
  @stack('scripts')
  <script src="{{ asset('vendor/fontawesome-free/js/all.js') }}"></script>
</body>

</html>
