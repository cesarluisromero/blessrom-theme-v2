{{-- resources/views/woocommerce/myaccount/my-address.blade.php --}}
@extends('woocommerce.myaccount.account-layout')

@section('page_title', 'Tus Direcciones')
@section('page_subtitle', 'Gestiona tus lugares de entrega y datos de facturación.')

@section('account_content')
  @php
    do_action('woocommerce_before_edit_account_address_form');
    
    // Fallback logic to get addresses if Sage doesn't pass them
    if (!isset($get_addresses) || empty($get_addresses)) {
        $customer_id = get_current_user_id();
        $get_addresses = apply_filters(
            'woocommerce_my_account_get_addresses',
            array(
                'billing'  => __( 'Billing address', 'woocommerce' ),
                'shipping' => __( 'Shipping address', 'woocommerce' ),
            ),
            $customer_id
        );
    }
  @endphp

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    @foreach ($get_addresses as $name => $address_title)
      @php
        $address = wc_get_account_formatted_address($name);
        $edit_url = wc_get_endpoint_url('edit-address', $name);
      @endphp

      <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 hover:shadow-md transition-all relative overflow-hidden group">
        <div class="absolute right-0 top-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            @if($name == 'billing')
                <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"></path></svg>
            @else
                <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M19 8l-7 5-7-5V6l7 5 7-5v2zm0-4H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2z"></path></svg>
            @endif
        </div>

        <div class="relative z-10">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-slate-800">
              {{ $address_title }}
            </h3>
            <a href="{{ esc_url($edit_url) }}" class="h-10 w-10 bg-slate-50 rounded-xl flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            </a>
          </div>

          <div class="text-sm text-slate-600 leading-relaxed min-h-[80px]">
            @if ($address)
              {!! str_replace('<br />', '<br>', $address) !!}
            @else
              <p class="italic text-slate-400 text-xs">Aún no has configurado esta dirección.</p>
            @endif
          </div>

          <div class="mt-6 pt-6 border-t border-slate-50">
            <a href="{{ esc_url($edit_url) }}" class="text-xs font-black text-primary uppercase tracking-widest hover:tracking-[0.1em] transition-all flex items-center gap-2">
                {{ $address ? 'Actualizar datos' : 'Configurar ahora' }}
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  @php
    do_action('woocommerce_after_edit_account_address_form');
  @endphp
@endsection