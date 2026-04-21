{{-- resources/views/woocommerce/myaccount/account-layout.blade.php --}}
@extends('layouts.app')

@section('content')
  @php
    $user = wp_get_current_user();
    $logout_url = esc_url(wc_logout_url());
  @endphp

  <div class="bg-slate-50 min-h-screen pt-8 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="flex flex-col md:flex-row gap-8">
        
        {{-- Sidebar Compartida --}}
        <aside class="w-full md:w-64 lg:w-72 flex-shrink-0">
          <div class="sticky top-8">
            {{-- Tarjeta de Perfil Rápida --}}
            <div class="mb-6 px-4 py-6 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
              <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
              </div>
              <div class="overflow-hidden">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest truncate">Hola de nuevo,</p>
                <p class="text-sm font-bold text-slate-800 truncate">{{ $user->display_name }}</p>
              </div>
            </div>
            
            {{-- Navegación Estilizada --}}
            @include('woocommerce.myaccount.navigation')

            {{-- Botón de Salir (Móvil/Sidebar) --}}
            <div class="mt-4 md:hidden">
              <a href="{{ $logout_url }}" class="flex items-center justify-center gap-2 px-4 py-3 bg-red-50 text-red-600 rounded-xl text-sm font-bold border border-red-100">
                Salir de la cuenta
              </a>
            </div>
          </div>
        </aside>

        {{-- Contenido de la Sub-página --}}
        <main class="flex-1">
          <div class="mb-8 flex items-center justify-between">
            <div>
              <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">@yield('page_title', 'Mi Cuenta')</h1>
              @hasSection('page_subtitle')
                <p class="text-sm text-slate-500 mt-1">@yield('page_subtitle')</p>
              @endif
            </div>
            <a href="{{ $logout_url }}" class="hidden md:flex text-sm font-bold text-red-500 hover:text-red-700 transition-colors items-center gap-2">
              Cerrar Sesión
            </a>
          </div>

          <div class="account-content-area">
            @yield('account_content')
          </div>

          {{-- Banner de Ayuda (Global para cuenta) --}}
          <div class="mt-12 bg-indigo-600 rounded-3xl p-8 text-white relative overflow-hidden shadow-xl shadow-indigo-200">
            <div class="absolute right-0 top-0 h-full w-1/2 bg-gradient-to-l from-white/10 to-transparent"></div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
              <div>
                <h3 class="text-lg font-bold mb-1">¿Algún problema con tu cuenta?</h3>
                <p class="text-indigo-100 text-sm max-w-md">Nuestro soporte técnico está listo para ayudarte con tus datos o pedidos.</p>
              </div>
              <a href="/contacto" class="inline-flex items-center justify-center px-6 py-3 border-2 border-white rounded-xl font-bold text-white hover:bg-white hover:text-indigo-600 transition-all text-sm">
                Chat de Soporte
              </a>
            </div>
          </div>
        </main>

      </div>
    </div>
  </div>
@endsection
