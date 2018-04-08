<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="meta_title" content="{{ $page['meta_title'] }}">
    <meta name="meta_description" content="{{ $page['meta_description'] }}">
    <meta name="meta_keywords" content="{{ $page['meta_keywords'] }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page['meta_title'] }}</title>

    <!-- Styles -->
    @if (count($css_files))
      @foreach ($css_files as $css)
        <link href="{{ $css }}" rel="stylesheet">
      @endforeach
    @endif
</head>
<body>
    <div id="app">
      <div class="flex space-around logo2">
        <img src="{{ media('logo2.png') }}">
      </div>

      <main class="">
          @yield('content')
      </main>
    </div>

    <!-- Scripts -->
    @if (count($js_files))
      @foreach ($js_files as $js)
        <script src="{{ $js }}"></script>
      @endforeach
    @endif
</body>
</html>
