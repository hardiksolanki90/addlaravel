<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @if (count($css_files))
      @foreach ($css_files as $css)
        <link type="text/css" href="{{ $css }}" rel="stylesheet">
      @endforeach
    @endif
</head>
<body>
    <div id="app">
      <nav class="navbar navbar-expand-md navbar-light navbar-adlara">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="{{ media('logo2.png') }}">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Left Side Of Navbar -->
                  <ul class="navbar-nav mr-auto">
                      <li><a class="nav-link" href="#">{{ $page['title'] }}</a></li>
                      <li>
                        <a class="nav-link _vl" href="{{ url('') }}" target="_balnk">
                          Visit Site
                          <i class="ion-ios-redo-outline"></i>
                        </a>
                      </li>
                  </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ml-auto dropdown _lll">
                    @if (count($page['action_links']))
                      @foreach ($page['action_links'] as $link)
                        <li>
                          <a href="{{ $link['slug'] }}" class="{{ (isset($link['class']) ? $link['class'] : '') }}">
                            @if ($link['icon'])
                              {!! $link['icon'] !!}
                            @endif
                            {{ $link['text'] }}
                          </a>
                        </li>
                      @endforeach
                    @endif
                    <li class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Jigesh
                    </li>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="{{ route('employee.logout') }}">Logout</a>
                    </div>
                  </ul>
              </div>
          </div>
      </nav>
      <div class="flex wr">
        @include('_partials.sidebar')
        <main class="py-4 main-app">
          @yield('content')
        </main>
      </div>
    </div>

    <!-- Scripts -->
    @if (count($js_files))
      @foreach ($js_files as $js)
        <script src="{{ $js }}"></script>
      @endforeach
    @endif
    @yield('footer_script')
</body>
</html>
