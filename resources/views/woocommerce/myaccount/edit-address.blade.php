{{-- resources/views/woocommerce/myaccount/edit-address.blade.php --}}
@extends('woocommerce.myaccount.account-layout')

@section('page_title', 'Mis Direcciones')
@section('page_subtitle', 'Gestiona tus direcciones de facturación y envío para un checkout más rápido.')

@section('account_content')
  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      {{-- Dirección de facturación --}}
      <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 flex flex-col hover:shadow-md transition-shadow group relative overflow-hidden">
          <div class="absolute -right-4 -top-4 text-primary/5 group-hover:scale-110 transition-transform duration-500">
                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"></path></svg>
          </div>
          <div class="relative z-10 flex flex-col h-full">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-10 w-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h2 class="text-lg font-bold text-slate-800">Facturación</h2>
            </div>

            @php
                $billing = function_exists('wc_get_account_address') ? wc_get_account_address('billing') : '';
            @endphp
            <div class="text-slate-600 text-sm leading-relaxed flex-1 min-h-[100px]">
                {!! wp_kses_post($billing ?: '<span class="italic text-slate-400 text-xs">No has configurado esta dirección aún.</span>') !!}
            </div>

            <a href="{{ esc_url(wc_get_endpoint_url('edit-address', 'billing')) }}"
               class="mt-8 inline-flex items-center justify-center p-4 rounded-xl bg-slate-50 text-xs font-bold text-slate-700 hover:bg-primary hover:text-white transition-all shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                Actualizar Facturación
            </a>
          </div>
      </div>

      {{-- Dirección de envío --}}
      <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 flex flex-col hover:shadow-md transition-shadow group relative overflow-hidden">
          <div class="absolute -right-4 -top-4 text-primary/5 group-hover:scale-110 transition-transform duration-500">
                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M19 8l-7 5-7-5V6l7 5 7-5v2zm0-4H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2z"></path></svg>
          </div>
          <div class="relative z-10 flex flex-col h-full">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-10 w-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h2 class="text-lg font-bold text-slate-800">Dirección de Envío</h2>
            </div>

            @php
                $shipping = function_exists('wc_get_account_address') ? wc_get_account_address('shipping') : '';
            @endphp
            <div class="text-slate-600 text-sm leading-relaxed flex-1 min-h-[100px]">
                {!! wp_kses_post($shipping ?: '<span class="italic text-slate-400 text-xs">No has configurado esta dirección aún.</span>') !!}
            </div>

            <a href="{{ esc_url(wc_get_endpoint_url('edit-address', 'shipping')) }}"
               class="mt-8 inline-flex items-center justify-center p-4 rounded-xl bg-slate-50 text-xs font-bold text-slate-700 hover:bg-primary hover:text-white transition-all shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                Actualizar Envío
            </a>
          </div>
      </div>
  </div>
@endsection
