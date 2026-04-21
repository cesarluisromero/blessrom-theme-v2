{{--
  Template Name: Contacto Premium
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <div class="contacto-page-container bg-slate-50 min-h-screen">
      <!-- Minimal Header -->
      <div class="bg-white border-b border-slate-100 py-12 md:py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center text-slate-900">
          <h1 class="text-3xl font-extrabold tracking-tight sm:text-5xl">Contacto Premium</h1>
          <p class="mt-4 text-base text-slate-500 max-w-xl mx-auto italic">Estamos aquí para resolver tus dudas sobre envíos, pedidos o productos.</p>
        </div>
      </div>

      <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
        <div class="grid grid-cols-1 gap-x-12 gap-y-12 lg:grid-cols-2">
          
          <!-- Contact Info Column (Refined) -->
          <div class="space-y-8">
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-3">
              <span class="h-6 w-1 bg-blue-600 rounded-full"></span>
              Atención Directa
            </h2>
            
            <div class="grid grid-cols-1 gap-4">
              <!-- WhatsApp Card -->
              <a href="https://wa.me/51900000000" target="_blank" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-green-100 transition-all flex items-center gap-6">
                <div class="h-12 w-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors flex-shrink-0">
                  <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                </div>
                <div>
                  <h3 class="font-bold text-slate-900 group-hover:text-green-600 transition-colors">WhatsApp Directo</h3>
                  <p class="text-sm text-slate-500">Respuesta inmediata: +51 900 000 000</p>
                </div>
              </a>

              <!-- Email Card -->
              <a href="mailto:contacto@blessrom.com" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all flex items-center gap-6">
                <div class="h-12 w-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors flex-shrink-0">
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
                <div>
                  <h3 class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors">contacto@blessrom.com</h3>
                  <p class="text-sm text-slate-500">Escríbenos para temas comerciales o pedidos</p>
                </div>
              </a>
            </div>

            <!-- Redes Social Section (Refined) -->
            <div class="bg-slate-900 rounded-3xl p-8 text-white relative overflow-hidden shadow-2xl">
              <div class="relative z-10">
                <h3 class="text-lg font-bold mb-4">Comunidad Blessrom</h3>
                <p class="text-slate-400 text-sm mb-6 max-w-xs">Síguenos para enterarte de los nuevos lanzamientos y ofertas exclusivas.</p>
                <div class="flex gap-4">
                  <a href="#" class="h-12 w-12 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white hover:text-slate-900 transition-all">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.248h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                  </a>
                  <a href="#" class="h-12 w-12 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white hover:text-slate-900 transition-all text-xs font-bold uppercase tracking-widest">
                    IG
                  </a>
                </div>
              </div>
              <div class="absolute -right-8 -bottom-8 h-32 w-32 bg-blue-500/10 rounded-full blur-3xl"></div>
            </div>
          </div>

          <!-- Form Column (Premium IMAGE Design) -->
          <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-2xl shadow-slate-200/60 border border-slate-100">
            <div class="flex items-center justify-between mb-10 border-b border-slate-50 pb-6">
                <h3 class="text-2xl font-black text-slate-900 uppercase tracking-tighter">Envíanos un mensaje</h3>
                <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-md uppercase tracking-widest">Soporte 24/7</span>
            </div>

            <div class="space-y-8">
              <!-- Fila 1: Nombre (3 columnas exactas a la referencia) -->
              <div>
                <label class="form-label-primary">Nombre del Remitente</label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                  <div class="flex flex-col">
                    <input type="text" placeholder="" class="form-input-premium">
                    <span class="form-label-sub">Nombre</span>
                  </div>
                  <div class="flex flex-col">
                    <input type="text" placeholder="" class="form-input-premium">
                    <span class="form-label-sub">Segundo Nombre</span>
                  </div>
                  <div class="flex flex-col">
                    <input type="text" placeholder="" class="form-input-premium">
                    <span class="form-label-sub">Apellido</span>
                  </div>
                </div>
              </div>

              <!-- Fila 2: Correo y Asunto -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="flex flex-col">
                  <label class="form-label-primary">Correo de Respuesta</label>
                  <input type="email" placeholder="esteban@ejemplo.com" class="form-input-premium">
                  <span class="form-label-sub">Tu email principal</span>
                </div>
                <div class="flex flex-col">
                  <label class="form-label-primary">Asunto del Contacto</label>
                  <input type="text" placeholder="Duda sobre mi pedido" class="form-input-premium">
                  <span class="form-label-sub">Propósito de tu mensaje</span>
                </div>
              </div>

              <!-- Fila 3: Mensaje -->
              <div class="flex flex-col">
                <label class="form-label-primary">Mensaje o Detalle</label>
                <textarea rows="4" placeholder="Escribe aquí tu consulta..." class="form-input-premium resize-none"></textarea>
                <span class="form-label-sub">Describe tu caso lo más detallado posible</span>
              </div>

              <div class="pt-6">
                <button class="btn-blue-premium w-full shadow-2xl hover:scale-[1.02] active:scale-[0.98] transition-all">
                  Enviar Mensaje Ahora
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  @endwhile
@endsection
