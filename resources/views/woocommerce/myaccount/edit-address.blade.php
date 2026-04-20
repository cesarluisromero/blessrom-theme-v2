{{-- resources/views/woocommerce/myaccount/edit-address.blade.php --}}
@extends('layouts.app')

@section('content')
  @php
    $user = wp_get_current_user();
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
        <div class="mb-8">
          <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Mis Direcciones</h1>
          <p class="text-sm text-slate-500 mt-1">Gestiona tus direcciones de facturación y envío para un checkout más rápido.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Dirección de facturación --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 flex flex-col hover:shadow-md transition-shadow group">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-10 w-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Dirección de facturación</h2>
                </div>

                @php
                    $billing = function_exists('wc_get_account_address') ? wc_get_account_address('billing') : '';
                @endphp
                <div class="text-slate-600 text-sm leading-relaxed flex-1 min-h-[100px]">
                    {!! wp_kses_post($billing ?: '<span class="italic text-slate-400 text-xs">No has configurado esta dirección aún.</span>') !!}
                </div>

                <a href="{{ esc_url(wc_get_endpoint_url('edit-address', 'billing')) }}"
                   class="mt-8 inline-flex items-center justify-center p-3 rounded-xl border-2 border-slate-100 text-sm font-bold text-slate-600 hover:border-primary hover:text-primary transition-all group-hover:bg-slate-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Editar Facturación
                </a>
            </div>

            {{-- Dirección de envío --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 flex flex-col hover:shadow-md transition-shadow group">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-10 w-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Dirección de envío</h2>
                </div>

                @php
                    $shipping = function_exists('wc_get_account_address') ? wc_get_account_address('shipping') : '';
                @endphp
                <div class="text-slate-600 text-sm leading-relaxed flex-1 min-h-[100px]">
                    {!! wp_kses_post($shipping ?: '<span class="italic text-slate-400 text-xs">No has configurado esta dirección aún.</span>') !!}
                </div>

                <a href="{{ esc_url(wc_get_endpoint_url('edit-address', 'shipping')) }}"
                   class="mt-8 inline-flex items-center justify-center p-3 rounded-xl border-2 border-slate-100 text-sm font-bold text-slate-600 hover:border-primary hover:text-primary transition-all group-hover:bg-slate-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Editar Envío
                </a>
            </div>
        </div>
      </main>

    </div>
  </div>
</div>
@endsection

