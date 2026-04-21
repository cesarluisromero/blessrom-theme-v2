{{-- resources/views/woocommerce/myaccount/dashboard.blade.php --}}
@extends('woocommerce.myaccount.account-layout')

@section('page_title', 'Mi Panel de Control')
@section('page_subtitle', 'Gestiona tus pedidos recientes y edita tu perfil.')

@section('account_content')
  @php
    $user = wp_get_current_user();
    $orders_url = wc_get_endpoint_url('orders');
    $edit_account_url = wc_get_endpoint_url('edit-account');
    $edit_address_url = wc_get_endpoint_url('edit-address');
    $address = wc_get_account_formatted_address('billing');
    $order_count = wc_get_customer_order_count($user->ID);
  @endphp

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
    {{-- Card: Pedidos --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow group relative overflow-hidden">
      <div class="absolute -right-4 -top-4 text-primary/5 group-hover:scale-110 transition-transform duration-500">
          <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
      </div>
      <div class="relative z-10">
        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Pedidos Realizados</div>
        <div class="text-3xl font-black text-slate-900">{{ $order_count }}</div>
        <a href="{{ $orders_url }}" class="mt-4 inline-flex items-center text-sm font-bold text-primary group-hover:gap-2 transition-all">
          Ver historial <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
      </div>
    </div>

    {{-- Card: Dirección --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow group relative overflow-hidden">
      <div class="absolute -right-4 -top-4 text-primary/5 group-hover:scale-110 transition-transform duration-500">
          <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
      </div>
      <div class="relative z-10">
        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Dirección Dominante</div>
        <p class="text-xs text-slate-600 leading-relaxed min-h-[40px] line-clamp-2">
          {!! $address ? str_replace(['<br/>', '<br>', '<br />'], ', ', $address) : '<span class="italic text-slate-400">No has configurado una dirección aún.</span>' !!}
        </p>
        <a href="{{ $edit_address_url }}" class="mt-4 inline-flex items-center text-sm font-bold text-primary group-hover:gap-2 transition-all">
          Editar <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
      </div>
    </div>

    {{-- Card: Usuario --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow group relative overflow-hidden">
      <div class="absolute -right-4 -top-4 text-primary/5 group-hover:scale-110 transition-transform duration-500">
          <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
      </div>
      <div class="relative z-10">
        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Correo Registrado</div>
        <p class="text-sm text-slate-800 font-bold truncate">{{ $user->user_email }}</p>
        <a href="{{ $edit_account_url }}" class="mt-4 inline-flex items-center text-sm font-bold text-primary group-hover:gap-2 transition-all">
          Perfil <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
      </div>
    </div>
  </div>

  <div class="italic text-xs text-slate-400">
    @php
      do_action('woocommerce_account_dashboard');
      do_action('woocommerce_before_my_account');
      do_action('woocommerce_after_my_account');
    @endphp
  </div>
@endsection
