{{-- resources/views/woocommerce/myaccount/form-edit-account.blade.php --}}
@extends('woocommerce.myaccount.account-layout')

@section('page_title', 'Detalles de la Cuenta')
@section('page_subtitle', 'Mantén tu información personal y contraseña al día.')

@section('account_content')
    @php
        do_action('woocommerce_before_edit_account_form');
    @endphp

    <form class="woocommerce-EditAccountForm edit-account bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden max-w-4xl" action="" method="post" {!! PHP_VERSION_ID >= 70000 ? 'enctype="multipart/form-data"' : '' !!}>
        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100">
            <h3 class="text-xl font-bold text-slate-900">Configuración del Perfil</h3>
        </div>

        <div class="p-8 space-y-8">
            @php do_action('woocommerce_edit_account_form_start'); @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col">
                    <label for="account_first_name" class="form-label-primary">{{ esc_html__('First name', 'woocommerce') }} <span class="required">*</span></label>
                    <input type="text" class="form-input-premium" name="account_first_name" id="account_first_name" autocomplete="given-name" value="{{ esc_attr($user->first_name) }}" />
                    <span class="form-label-sub">Como apareces en facturas</span>
                </div>
                <div class="flex flex-col">
                    <label for="account_last_name" class="form-label-primary">{{ esc_html__('Last name', 'woocommerce') }} <span class="required">*</span></label>
                    <input type="text" class="form-input-premium" name="account_last_name" id="account_last_name" autocomplete="family-name" value="{{ esc_attr($user->last_name) }}" />
                    <span class="form-label-sub">Tus apellidos</span>
                </div>
            </div>

            <div class="flex flex-col">
                <label for="account_display_name" class="form-label-primary">{{ esc_html__('Display name', 'woocommerce') }} <span class="required">*</span></label>
                <input type="text" class="form-input-premium" name="account_display_name" id="account_display_name" value="{{ esc_attr($user->display_name) }}" />
                <span class="form-label-sub">Este será tu nombre público</span>
            </div>

            <div class="flex flex-col">
                <label for="account_email" class="form-label-primary">{{ esc_html__('Email address', 'woocommerce') }} <span class="required">*</span></label>
                <input type="email" class="form-input-premium" name="account_email" id="account_email" autocomplete="email" value="{{ esc_attr($user->user_email) }}" />
                <span class="form-label-sub">Para recibir confirmaciones de compra</span>
            </div>

            <fieldset class="pt-8 border-t border-slate-100">
                <legend class="text-xl font-bold text-slate-800 mb-6">Cambio de Contraseña</legend>
                <div class="space-y-6">
                    <div class="flex flex-col">
                        <label for="password_current" class="form-label-primary">Contraseña actual (deja en blanco si no vas a cambiarla)</label>
                        <input type="password" class="form-input-premium" name="password_current" id="password_current" autocomplete="off" />
                    </div>
                    <div class="flex flex-col">
                        <label for="password_1" class="form-label-primary">Nueva contraseña</label>
                        <input type="password" class="form-input-premium" name="password_1" id="password_1" autocomplete="off" />
                    </div>
                    <div class="flex flex-col">
                        <label for="password_2" class="form-label-primary">Confirma nueva contraseña</label>
                        <input type="password" class="form-input-premium" name="password_2" id="password_2" autocomplete="off" />
                    </div>
                </div>
            </fieldset>

            @php do_action('woocommerce_edit_account_form'); @endphp

            <div class="mt-10 pt-6 border-t border-slate-100 flex justify-end">
                @php wp_nonce_field('save_account_details', 'save-account-details-nonce'); @endphp
                <button type="submit" class="btn-blue-premium" name="save_account_details" value="{{ esc_attr__('Save changes', 'woocommerce') }}">
                    Guardar Cambios
                </button>
                <input type="hidden" name="action" value="save_account_details" />
            </div>

            @php do_action('woocommerce_edit_account_form_end'); @endphp
        </div>
    </form>

    @php
        do_action('woocommerce_after_edit_account_form');
    @endphp
@endsection
