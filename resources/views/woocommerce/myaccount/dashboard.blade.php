{{-- resources/views/woocommerce/myaccount/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
  @php
    $user = wp_get_current_user();
    $logout_url = esc_url(wc_logout_url());
    $orders_url = wc_get_endpoint_url('orders');
    $edit_account_url = wc_get_endpoint_url('edit-account');
    $edit_address_url = wc_get_endpoint_url('edit-address');
    $address = wc_get_account_formatted_address('billing');
    $order_count = wc_get_customer_order_count($user->ID);
  @endphp

<div class="bg-slate-50 min-h-screen pt-8 pb-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="flex flex-col md:flex-row gap-8">
      
      {{-- Sidebar --}}
      <aside class="w-full md:w-64 lg:w-72 flex-shrink-0">
        <div class="sticky top-8">
          <div class="mb-6 px-4 py-6 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div class="overflow-hidden">
              <p class="text-xs text-slate-400 font-bold uppercase tracking-wider truncate">Bienvenido,</p>
              <p class="text-sm font-bold text-slate-800 truncate">{{ $user->display_name }}</p>
            </div>
          </div>
          
          @include('woocommerce.myaccount.navigation')
        </div>
      </aside>

      {{-- Main Content --}}
      <main class="flex-1">
        <div class="mb-8 flex items-center justify-between">
          <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Mi Panel de Control</h1>
          <a href="{{ $logout_url }}" class="text-sm font-bold text-red-500 hover:text-red-600 transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Cerrar Sesión
          </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
          
          {{-- Card: Pedidos --}}
          <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 text-primary/5 group-hover:scale-110 transition-transform duration-500">
               <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div class="relative z-10">
              <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Pedidos Realizados</div>
              <div class="text-3xl font-black text-slate-900">{{ $order_count }}</div>
              <a href="{{ $orders_url }}" class="mt-4 inline-flex items-center text-sm font-bold text-primary group-hover:gap-2 transition-all">
                Ver historial <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
              </a>
            </div>
          </div>

          {{-- Card: Dirección --}}
          <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow group relative overflow-hidden lg:col-span-1">
            <div class="absolute -right-4 -top-4 text-primary/5 group-hover:scale-110 transition-transform duration-500">
               <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <div class="relative z-10">
              <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Dirección de Envío</div>
              <p class="text-sm text-slate-600 leading-relaxed min-h-[40px]">
                {!! $address ? str_replace(['<br/>', '<br>', '<br />'], ', ', $address) : '<span class="italic text-slate-400 text-xs">No has configurado una dirección aún.</span>' !!}
              </p>
              <a href="{{ $edit_address_url }}" class="mt-4 inline-flex items-center text-sm font-bold text-primary group-hover:gap-2 transition-all">
                Editar dirección <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
              </a>
            </div>
          </div>

          {{-- Card: Usuario --}}
          <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 text-primary/5 group-hover:scale-110 transition-transform duration-500">
               <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div class="relative z-10">
              <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Detalles de la Cuenta</div>
              <p class="text-sm text-slate-800 font-bold truncate">{{ $user->user_email }}</p>
              <p class="text-xs text-slate-500 mb-2">Miembro desde {{ date('M Y', strtotime($user->user_registered)) }}</p>
              <a href="{{ $edit_account_url }}" class="mt-4 inline-flex items-center text-sm font-bold text-primary group-hover:gap-2 transition-all">
                Ajustes de cuenta <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
              </a>
            </div>
          </div>

        </div>

        <div class="bg-indigo-600 rounded-3xl p-8 text-white relative overflow-hidden shadow-xl shadow-indigo-200">
          <div class="absolute right-0 top-0 h-full w-1/2 bg-gradient-to-l from-white/10 to-transparent"></div>
          <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
              <h3 class="text-xl font-bold mb-2 text-white">¿Necesitas ayuda con tus pedidos?</h3>
              <p class="text-indigo-100 text-sm max-w-md">Nuestro equipo de soporte está disponible para ayudarte con cualquier duda sobre envíos, devoluciones o productos.</p>
            </div>
            <a href="/contacto" class="inline-flex items-center justify-center px-6 py-3 border-2 border-white rounded-xl font-bold text-white hover:bg-white hover:text-indigo-600 transition-all shadow-sm">
              Contactar Soporte
            </a>
          </div>
        </div>

        <div class="mt-12 text-sm text-slate-400 leading-relaxed border-t border-slate-200 pt-8 italic">
          @php
            do_action('woocommerce_account_dashboard');
            do_action('woocommerce_before_my_account');
            do_action('woocommerce_after_my_account');
          @endphp
        </div>
      </main>

    </div>
  </div>
</div>

@endsection

