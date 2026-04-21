@php
  do_action('woocommerce_before_edit_account_address_form');
@endphp

@if (!$load_address)
  @include('woocommerce.myaccount.my-address')
@else
  <div class="max-w-4xl mx-auto py-8">
    <form method="post" novalidate class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
      <!-- Header -->
      <div class="px-8 py-6 bg-slate-50 border-b border-slate-100">
        <h2 class="text-2xl font-bold text-slate-900">
          {!! apply_filters('woocommerce_my_account_edit_address_title', $page_title, $load_address) !!}
        </h2>
        <p class="mt-1 text-sm text-slate-500">Completa los datos para asegurar una entrega correcta y rápida.</p>
      </div>

      <div class="p-8">
        <div class="woocommerce-address-fields">
          @php do_action("woocommerce_before_edit_address_form_{$load_address}") @endphp

          <div class="woocommerce-address-fields__field-wrapper">
            @foreach ($address as $key => $field)
              @php
                // We add some extra classes to the field but keep WC logic
                $field['class'][] = 'form-row-wide'; 
                woocommerce_form_field($key, $field, wc_get_post_data_by_key($key, $field['value']));
              @endphp
            @endforeach
          </div>

          @php do_action("woocommerce_after_edit_address_form_{$load_address}") @endphp

          <div class="mt-10 pt-6 border-t border-slate-100 flex justify-end">
            <button 
              type="submit" 
              class="btn-blue-premium" 
              name="save_address" 
              value="{{ esc_attr__('Save address', 'woocommerce') }}"
            >
              {{ esc_html__('Save address', 'woocommerce') }}
            </button>
            @php wp_nonce_field('woocommerce-edit_address', 'woocommerce-edit-address-nonce') @endphp
            <input type="hidden" name="action" value="edit_address" />
          </div>
        </div>
      </div>
    </form>
  </div>
@endif

@php
  do_action('woocommerce_after_edit_account_address_form');
@endphp
