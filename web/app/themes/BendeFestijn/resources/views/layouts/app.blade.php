<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php(do_action('get_header'))
    @php(wp_head())

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @stack('styles')
  </head>

  <body @php(body_class())>
    @php(wp_body_open())

    <div class="background">
      <img src="{{ Vite::asset('resources/images/background.webp') }}" alt="background">
    </div>

    <div id="app">
      {{-- <img src="{{ Vite::asset('resources/images/backgroundripple.webp') }}" alt=""> --}}

      @include('sections.header')

      <main id="main" class="main">
        @yield('content')
      </main>

      @hasSection('sidebar')
        <aside class="sidebar">
          @yield('sidebar')
        </aside>
      @endif

      @include('sections.footer')
    </div>

    @stack('scripts')
  </body>
</html>
