{{--
  Template Name: Garantía Premium
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <div class="garantia-page-container bg-slate-50 min-h-screen">
      <!-- Hero Header -->
      <div class="relative overflow-hidden bg-white pb-24 pt-16 sm:pb-32 sm:pt-24 shadow-sm border-b border-slate-100">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.blue.50),white)]"></div>
        
        <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center sm:text-left">
          <div class="flex items-center gap-2 text-blue-600 font-semibold mb-4 justify-center sm:justify-start">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
            </svg>
            <span>Compromiso Blessrom</span>
          </div>
          <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-6xl bg-gradient-to-r from-slate-900 to-blue-700 bg-clip-text text-transparent">
            Garantía de Entrega Total
          </h1>
          <p class="mt-6 text-lg leading-8 text-slate-600 max-w-2xl">
            En Blessrom, no solo vendemos moda, entregamos confianza. Nuestra garantía asegura <strong>envíos rápidos a todo el país</strong>, asegurando que tu pedido llegue a tus manos en perfectas condiciones y en el tiempo acordado.
          </p>
        </div>
      </div>

      <!-- Warranty Pillars -->
      <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
          <!-- Pillar 1 -->
          <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="h-12 w-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mb-6">
              <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25c0-4.446-3.542-7.875-8.25-7.875H9.75M12 4.5v15.75m12-7.5h-3.375a1.125 1.125 0 01-1.125-1.125V4.333c0-.62-.511-1.125-1.125-1.125h-5.25A1.125 1.125 0 0013.875 4.5V11.25c0 .621.504 1.125 1.125 1.125h3.375" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">Envío Protegido</h3>
            <p class="text-slate-600 leading-relaxed">
              Trabajamos con las mejores agencias de envío. Tu paquete está asegurado ante cualquier eventualidad durante el tránsito.
            </p>
          </div>

          <!-- Pillar 2 -->
          <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="h-12 w-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600 mb-6">
              <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">Plazos Cumplidos</h3>
            <p class="text-slate-600 leading-relaxed">
              Garantizamos <strong>envíos rápidos a todo el país</strong> con los mejores plazos de cumplimiento del mercado. Si hay un retraso inesperado, te compensamos.
            </p>
          </div>

          <!-- Pillar 3 -->
          <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="h-12 w-12 bg-yellow-50 rounded-xl flex items-center justify-center text-yellow-600 mb-6">
              <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">Rastreo en Vivo</h3>
            <p class="text-slate-600 leading-relaxed">
              Desde que sale de nuestro almacén hasta tu puerta, siempre sabrás exactamente dónde está tu pedido.
            </p>
          </div>

          <!-- Pillar 4 -->
          <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="h-12 w-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 mb-6">
              <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">Calidad Verificada</h3>
            <p class="text-slate-600 leading-relaxed">
              Cada prenda pasa por un control de calidad riguroso antes de ser empacada para asegurar que llega impecable.
            </p>
          </div>
        </div>

        <!-- Detailed Info -->
        <div class="mt-24 max-w-4xl mx-auto">
          <div class="bg-blue-600 rounded-3xl p-10 text-white shadow-xl relative overflow-hidden">
            <svg class="absolute right-0 bottom-0 h-64 w-64 text-blue-500 opacity-20 -mr-20 -mb-20" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm3 7h-3V6a1 1 0 10-2 0v3H5a1 1 0 100 2h3v3a1 1 0 102 0v-3h3a1 1 0 100-2z" />
            </svg>
            <div class="relative z-10">
              <h2 class="text-3xl font-bold mb-6">¿Qué pasa si ocurre un imprevisto?</h2>
              <div class="space-y-6 text-blue-50">
                <div class="flex gap-4">
                  <div class="bg-blue-500/50 rounded-lg p-2 h-fit">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                  </div>
                  <div>
                    <p class="font-bold text-white text-lg">Pérdida o Daño</p>
                    <p>Si la agencia de envíos confirma que el paquete se perdió o llegó dañado, Blessrom te enviará un reemplazo sin costo adicional o procesará el reembolso total.</p>
                  </div>
                </div>
                <div class="flex gap-4">
                  <div class="bg-blue-500/50 rounded-lg p-2 h-fit">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                  </div>
                  <div>
                    <p class="font-bold text-white text-lg">Demoras Extremas</p>
                    <p>Si tu pedido supera el plazo máximo estipulado por causas imputables a Blessrom, nos pondremos en contacto contigo para ofrecerte una compensación especial.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endwhile
@endsection
