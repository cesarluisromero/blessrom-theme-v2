<!doctype html>
<html class="m-0 p-0" @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <style>
      html, body {
        margin: 0 !important;
        padding: 0 !important;
      }
    </style>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     @vite([
      'resources/scripts/app.js',
    ])
    @stack('styles')
    @php(wp_head()) 
  </head>

  <body class="m-0 p-0 bg-[#f0f0f0]" @php(body_class()) data-product-id="{{ is_product() ? get_the_ID() : '' }}">
    @php(wp_body_open())

    <div id="app" class="w-full">
      <a class="sr-only focus:not-sr-only" href="#main">
        {{ __('Skip to content', 'sage') }}
      </a>

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
      @include('partials.quick-view-modal')
      @include('partials.chat-widget')
    </div>
    @php(do_action('get_footer'))    
    
    @stack('scripts') 
    
    @php(wp_footer())    
  </body>
</html>
