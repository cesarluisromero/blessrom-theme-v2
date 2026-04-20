{{-- resources/views/woocommerce/myaccount/orders.blade.php --}}
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
          <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">{{ __('Mis Pedidos', 'woocommerce') }}</h1>
          <p class="text-sm text-slate-500 mt-1">Gestiona tus compras recientes y descarga tus facturas.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            @php
                do_action( 'woocommerce_before_account_orders', $has_orders ); 
            @endphp

            @if ($has_orders)
                <div
                    x-data="{ scrolled: false }"
                    @scroll.window="if ($el.scrollLeft > 0) scrolled = true"
                    class="relative w-full overflow-x-auto"
                >             
                    <div
                        x-show="!scrolled"
                        class="pointer-events-none absolute right-0 top-0 h-full w-16 bg-gradient-to-l from-white to-transparent flex items-center justify-end pr-2"
                    >
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">
                            Desliza →
                        </span>
                    </div>                                  
                    <table class="w-full text-left woocommerce-orders-table shop_table shop_table_responsive my_account_orders account-orders-table">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                @foreach ( wc_get_account_orders_columns() as $column_id => $column_name )
                                    <th
                                        scope="col"
                                        class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider"
                                    >
                                        {{ esc_html($column_name) }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($customer_orders->orders as $customer_order)
                                @php
                                    $order      = wc_get_order($customer_order);
                                    $item_count = $order->get_item_count() - $order->get_item_count_refunded();
                                    $status     = $order->get_status();
                                    
                                    $status_classes = [
                                        'completed'  => 'bg-green-100 text-green-700',
                                        'processing' => 'bg-blue-100 text-blue-700',
                                        'on-hold'    => 'bg-amber-100 text-amber-700',
                                        'cancelled'  => 'bg-red-100 text-red-700',
                                        'failed'     => 'bg-red-100 text-red-700',
                                        'pending'    => 'bg-slate-100 text-slate-700',
                                    ];
                                    $status_class = $status_classes[$status] ?? 'bg-slate-100 text-slate-700';
                                @endphp

                                <tr class="hover:bg-slate-50/50 transition-colors order">
                                    @foreach (wc_get_account_orders_columns() as $column_id => $column_name)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600" data-title="{{ esc_attr($column_name) }}">
                                            
                                            @if ($column_id === 'order-number')
                                                <a href="{{ esc_url($order->get_view_order_url()) }}" class="font-bold text-primary hover:underline">
                                                    #{{ $order->get_order_number() }}
                                                </a>

                                            @elseif ($column_id === 'order-date')
                                                <time datetime="{{ esc_attr($order->get_date_created()->date('c')) }}" class="font-medium">
                                                    {{ wc_format_datetime($order->get_date_created()) }}
                                                </time>

                                            @elseif ($column_id === 'order-status')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $status_class }}">
                                                    {{ wc_get_order_status_name($status) }}
                                                </span>

                                            @elseif ($column_id === 'order-total')
                                                <div class="font-bold text-slate-900">
                                                    {!! $order->get_formatted_order_total() !!}
                                                </div>
                                                <div class="text-[10px] text-slate-400 uppercase tracking-tighter">
                                                    {{ sprintf(_n('%s artículo', '%s artículos', $item_count, 'woocommerce'), $item_count) }}
                                                </div>

                                            @elseif ($column_id === 'order-actions')
                                                @php $actions = wc_get_account_orders_actions($order); @endphp
                                                <div class="flex gap-2">
                                                    @foreach ($actions as $key => $action)
                                                        <a href="{{ esc_url($action['url']) }}"
                                                           class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold transition-all
                                                                  {{ $key === 'view' ? 'bg-indigo-50 text-indigo-600 hover:bg-indigo-100' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                                                        >
                                                            {{ $action['name'] }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif

                                            @php
                                                do_action("woocommerce_my_account_my_orders_column_{$column_id}", $order);
                                            @endphp
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($customer_orders->max_num_pages > 1)
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                        @if ($current_page !== 1)
                            <a href="{{ esc_url(wc_get_endpoint_url('orders', $current_page - 1)) }}" class="text-sm font-bold text-primary hover:underline flex items-center">
                                ← {{ __('Anterior', 'woocommerce') }}
                            </a>
                        @else
                            <span></span>
                        @endif

                        @if ((int) $customer_orders->max_num_pages !== $current_page)
                            <a href="{{ esc_url(wc_get_endpoint_url('orders', $current_page + 1)) }}" class="text-sm font-bold text-primary hover:underline flex items-center">
                                {{ __('Siguiente', 'woocommerce') }} →
                            </a>
                        @endif
                    </div>
                @endif

            @else
                <div class="p-12 text-center">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-slate-100 text-slate-400 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Aún no tienes pedidos</h3>
                    <p class="text-slate-500 mb-6 text-sm">Explora nuestra tienda y descubre las últimas tendencias en moda.</p>
                    <a href="{{ esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))) }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all text-sm">
                        {{ __('Ir a la Tienda', 'woocommerce') }}
                    </a>
                </div>
            @endif
            
            @php do_action('woocommerce_after_account_orders', $has_orders); @endphp
        </div>
      </main>

    </div>
  </div>
</div>
@endsection