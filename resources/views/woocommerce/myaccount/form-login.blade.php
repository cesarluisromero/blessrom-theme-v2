{{-- resources/views/woocommerce/myaccount/form-login.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8 flex flex-col justify-center">
  <div class="sm:mx-auto sm:w-full sm:max-w-md mb-8 text-center">
    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
      {{ get_bloginfo('name') }}
    </h1>
    <p class="mt-2 text-sm text-gray-600">
      Tu destino de moda y estilo favorito
    </p>
  </div>

  <div 
    x-data="{ activeTab: 'login' }" 
    class="sm:mx-auto sm:w-full sm:max-w-md"
  >
    <div class="bg-white py-8 px-4 shadow-2xl rounded-3xl sm:px-10 border border-slate-100 relative overflow-hidden">
      
      {{-- Tabs --}}
      @if ($registration_enabled)
        <div class="flex border-b border-gray-100 mb-8 overflow-hidden rounded-t-lg">
          <button 
            @click="activeTab = 'login'"
            :class="activeTab === 'login' ? 'border-primary text-primary bg-slate-50/50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-slate-50/20'"
            class="w-1/2 py-4 px-1 text-center border-b-2 font-semibold text-sm transition-all duration-300 transform active:scale-95"
          >
            {{ __('Iniciar Sesión', 'woocommerce') }}
          </button>
          <button 
            @click="activeTab = 'register'"
            :class="activeTab === 'register' ? 'border-primary text-primary bg-slate-50/50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-slate-50/20'"
            class="w-1/2 py-4 px-1 text-center border-b-2 font-semibold text-sm transition-all duration-300 transform active:scale-95"
          >
            {{ __('Crear Cuenta', 'woocommerce') }}
          </button>
        </div>
      @endif

      {{-- Social Login Mockup --}}
      <div class="mb-8">
        <div class="relative">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
          </div>
          <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-400 font-medium">Ingresa rápido con</span>
          </div>
        </div>

        <div class="mt-6 grid grid-cols-2 gap-4">
          <button type="button" class="w-full inline-flex justify-center py-2.5 px-4 border border-gray-200 rounded-xl shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
            <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24">
              <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
              <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
              <path fill="#FBBC05" d="M5.84 14.1c-.22-.66-.35-1.36-.35-2.1s.13-1.44.35-2.1V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l3.66-2.84z"/>
              <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            Google
          </button>
          <button type="button" class="w-full inline-flex justify-center py-2.5 px-4 border border-gray-200 rounded-xl shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd" />
            </svg>
            Facebook
          </button>
        </div>

        <div class="mt-8 relative">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-100"></div>
          </div>
          <div class="relative flex justify-center text-xs">
            <span class="px-2 bg-white text-gray-400">o usa tu correo electrónico</span>
          </div>
        </div>
      </div>

      {{-- Login Section --}}
      <div x-show="activeTab === 'login'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
        @php do_action('woocommerce_before_customer_login_form') @endphp

        <form class="space-y-5 woocommerce-form woocommerce-form-login login" method="post">
          @php do_action('woocommerce_login_form_start') @endphp

          <div>
            <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">
              {{ __('Correo o Usuario', 'woocommerce') }}
            </label>
            <input
              type="text"
              name="username"
              id="username"
              autocomplete="username"
              required
              placeholder="nombre@ejemplo.com"
              class="block w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all sm:text-sm shadow-sm"
              value="{{ old('username') }}"
            >
          </div>

          <div x-data="{ show: false }">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
              {{ __('Contraseña', 'woocommerce') }}
            </label>
            <div class="relative">
              <input
                :type="show ? 'text' : 'password'"
                name="password"
                id="password"
                autocomplete="current-password"
                required
                placeholder="••••••••"
                class="block w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all sm:text-sm shadow-sm"
              >
              <button 
                type="button"
                @click="show = !show"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500 hover:text-primary transition-colors"
              >
                <template x-if="!show">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </template>
                <template x-if="show">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.024 10.024 0 014.123-5.323M9.172 9.172a4 4 0 105.656 5.656M15 12a3 3 0 11-6 0 3 3 0 016 0zm9 9l-3-3m-1.5-1.5L21 21m-9-9l3 3m1.5 1.5L12 12z"/></svg>
                </template>
              </button>
            </div>
          </div>

          @php do_action('woocommerce_login_form') @endphp

          <div class="flex items-center justify-between">
            <label class="flex items-center group cursor-pointer">
              <input class="h-4 w-4 text-primary border-gray-300 rounded transition-all focus:ring-primary cursor-pointer" type="checkbox" name="rememberme" id="rememberme" value="forever">
              <span class="ml-2 block text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ __('Recordarme', 'woocommerce') }}</span>
            </label>

            <a href="{{ esc_url( wp_lostpassword_url() ) }}" class="text-sm font-medium text-primary hover:text-primary-dark transition-colors">
              {{ __('¿Olvidaste tu contraseña?', 'woocommerce') }}
            </a>
          </div>

          @php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ) @endphp

          <div>
            <button
              type="submit"
              name="login"
              value="{{ __('Log in', 'woocommerce') }}"
              class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:scale-[1.02] active:scale-[0.98]"
            >
              {{ __('Ingresar ahora', 'woocommerce') }}
            </button>
          </div>

          @php do_action('woocommerce_login_form_end') @endphp
        </form>
      </div>

      {{-- Register Section --}}
      @if ($registration_enabled)
        <div x-show="activeTab === 'register'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
          <form method="post" class="space-y-5 woocommerce-form woocommerce-form-register register">
            @php do_action('woocommerce_register_form_start') @endphp

            @if (get_option('woocommerce_registration_generate_username') === 'no')
              <div>
                <label for="reg_username" class="block text-sm font-semibold text-gray-700 mb-1.5">
                  {{ __('Nombre de Usuario', 'woocommerce') }}
                </label>
                <input
                  type="text"
                  name="username"
                  id="reg_username"
                  autocomplete="username"
                  required
                  placeholder="Ej: juan_perez"
                  class="block w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all sm:text-sm shadow-sm"
                  value="{{ old('username') }}"
                >
              </div>
            @endif

            <div>
              <label for="reg_email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                {{ __('Correo Electrónico', 'woocommerce') }}
              </label>
              <input
                type="email"
                name="email"
                id="reg_email"
                autocomplete="email"
                required
                placeholder="nombre@ejemplo.com"
                class="block w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all sm:text-sm shadow-sm"
                value="{{ old('email') }}"
              >
            </div>

            @if (get_option('woocommerce_registration_generate_password') === 'no')
              <div x-data="{ show: false }">
                <label for="reg_password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                  {{ __('Nueva Contraseña', 'woocommerce') }}
                </label>
                <div class="relative">
                  <input
                    :type="show ? 'text' : 'password'"
                    name="password"
                    id="reg_password"
                    autocomplete="new-password"
                    required
                    placeholder="Mínimo 8 caracteres"
                    class="block w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all sm:text-sm shadow-sm"
                  >
                  <button 
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500 hover:text-primary transition-colors"
                  >
                    <template x-if="!show">
                      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </template>
                    <template x-if="show">
                      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.024 10.024 0 014.123-5.323M9.172 9.172a4 4 0 105.656 5.656M15 12a3 3 0 11-6 0 3 3 0 016 0zm9 9l-3-3m-1.5-1.5L21 21m-9-9l3 3m1.5 1.5L12 12z"/></svg>
                    </template>
                  </button>
                </div>
              </div>
            @else
              <p class="text-xs text-gray-500 italic bg-slate-50 p-3 rounded-lg border border-slate-100">
                {{ __('Se enviará un enlace para establecer una nueva contraseña a tu dirección de correo electrónico.', 'woocommerce') }}
              </p>
            @endif

            @php do_action('woocommerce_register_form') @endphp
            @php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce') @endphp

            <div class="pt-2">
              <button
                type="submit"
                name="register"
                value="{{ __('Register', 'woocommerce') }}"
                class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:scale-[1.02] active:scale-[0.98]"
              >
                {{ __('Crear mi cuenta', 'woocommerce') }}
              </button>
            </div>

            @php do_action('woocommerce_register_form_end') @endphp
          </form>
        </div>
      @endif
    </div>

    <p class="mt-8 text-center text-xs text-gray-500">
      Al continuar, aceptas nuestros 
      <a href="/terminos-y-condiciones" class="text-primary hover:underline">Términos de Servicio</a> 
      y nuestra 
      <a href="/politica-de-privacidad" class="text-primary hover:underline">Política de Privacidad</a>.
    </p>
  </div>
</div>

@php do_action('woocommerce_after_customer_login_form') @endphp
@endsection

