{{-- resources/views/woocommerce/myaccount/form-edit-account.blade.php --}}
@extends('layouts.app')

@section('content')
  @php
    $user = wp_get_current_user();
    do_action('woocommerce_before_edit_account_form');
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
          <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Editar Perfil</h1>
          <p class="text-sm text-slate-500 mt-1">Actualiza tu información personal y cambia tu contraseña.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 max-w-4xl">
            <form method="post" class="woocommerce-EditAccountForm edit-account space-y-8" action="" {!! do_action('woocommerce_edit_account_form_tag') !!}>
                @php do_action('woocommerce_edit_account_form_start'); @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="account_first_name" class="block text-sm font-bold text-slate-700 mb-2">
                             {{ __('First name', 'woocommerce') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="account_first_name" id="account_first_name" autocomplete="given-name"
                            value="{{ old('account_first_name', $user->first_name) }}"
                            class="w-full border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-sm">
                    </div>
                    <div>
                        <label for="account_last_name" class="block text-sm font-bold text-slate-700 mb-2">
                            Apellido <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="account_last_name" id="account_last_name" autocomplete="family-name"
                               value="{{ old('account_last_name', $user->last_name) }}"
                               class="w-full border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-sm">
                    </div>
                </div>

                <div>
                    <label for="account_display_name" class="block text-sm font-bold text-slate-700 mb-2">
                        Nombre público <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="account_display_name" id="account_display_name"
                           value="{{ old('account_display_name', $user->display_name) }}"
                           class="w-full border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-sm">
                    <p class="text-xs text-slate-400 mt-2 italic font-medium">Este nombre se mostrará en tu cuenta y en las reseñas de productos.</p>
                </div>

                <div>
                    <label for="account_email" class="block text-sm font-bold text-slate-700 mb-2">
                        Correo electrónico <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="account_email" id="account_email" autocomplete="email"
                           value="{{ old('account_email', $user->user_email) }}"
                           class="w-full border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-sm">
                </div>

                @php do_action('woocommerce_edit_account_form_fields'); @endphp

                <div class="pt-8 border-t border-slate-100">
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 space-y-6">
                        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Seguridad
                        </h3>

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="password_current" class="block text-sm font-bold text-slate-700 mb-2">Contraseña actual (dejar en blanco para no cambiar)</label>
                                <input type="password" name="password_current" id="password_current" autocomplete="off"
                                       class="w-full border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-sm bg-white" placeholder="••••••••">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="password_1" class="block text-sm font-bold text-slate-700 mb-2">Nueva contraseña</label>
                                    <input type="password" name="password_1" id="password_1" autocomplete="off"
                                           class="w-full border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-sm bg-white" placeholder="Nueva">
                                </div>
                                <div>
                                    <label for="password_2" class="block text-sm font-bold text-slate-700 mb-2">Confirmar</label>
                                    <input type="password" name="password_2" id="password_2" autocomplete="off"
                                           class="w-full border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-sm bg-white" placeholder="Confirmar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @php do_action('woocommerce_edit_account_form'); @endphp

                <div class="pt-6">
                    @php wp_nonce_field('save_account_details', 'save-account-details-nonce'); @endphp
                    <button type="submit"
                        class="px-8 py-4 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all"
                        name="save_account_details"
                        value="{{ esc_attr__('Save changes', 'woocommerce') }}">
                        Guardar Cambios
                    </button>
                    <input type="hidden" name="action" value="save_account_details">
                </div>

                @php do_action('woocommerce_edit_account_form_end'); @endphp
            </form>
        </div>
      </main>

    </div>
  </div>
</div>

@php do_action('woocommerce_after_edit_account_form'); @endphp
@endsection

