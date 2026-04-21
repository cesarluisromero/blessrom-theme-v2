{{--
  Template Name: Contacto Premium
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <div class="contacto-page-container bg-slate-50 min-h-screen">
      <!-- Hero Header -->
      <div class="relative overflow-hidden bg-white pb-24 pt-16 sm:pb-32 sm:pt-24 shadow-sm border-b border-slate-100">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.blue.50),white)]"></div>
        
        <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
          <div class="flex items-center gap-2 text-primary font-semibold mb-6 justify-center">
            <span class="h-px w-8 bg-primary/30"></span>
            <span class="uppercase tracking-widest text-xs">Ponte en contacto</span>
            <span class="h-px w-8 bg-primary/30"></span>
          </div>
          <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-6xl bg-gradient-to-r from-slate-900 to-primary bg-clip-text text-transparent">
            Estamos aquí para ayudarte
          </h1>
          <p class="mt-6 text-lg leading-8 text-slate-600 max-w-2xl mx-auto">
            ¿Tienes alguna duda sobre tu pedido, una prenda o simplemente quieres saludarnos? Nuestro equipo de atención al cliente te responderá lo antes posible.
          </p>
        </div>
      </div>

      <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="grid grid-cols-1 gap-x-12 gap-y-16 lg:grid-cols-2 lg:items-start">
          
          <!-- Contact Info Column -->
          <div class="space-y-12">
            <div>
              <h2 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                <span class="h-8 w-1 bg-primary rounded-full"></span>
                Vías de atención directa
              </h2>
              
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- WhatsApp -->
                <a href="https://wa.me/51900000000" target="_blank" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-green-100 transition-all">
                  <div class="h-10 w-10 bg-green-50 rounded-xl flex items-center justify-center text-green-600 mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                  </div>
                  <h3 class="font-bold text-slate-900 underline decoration-green-200 underline-offset-4 group-hover:decoration-green-500 transition-all">Escríbenos por WhatsApp</h3>
                  <p class="mt-2 text-sm text-slate-500">Atención inmediata de 9am - 6pm</p>
                </a>

                <!-- Email -->
                <a href="mailto:contacto@blessrom.com" class="group bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-blue-100 transition-all">
                  <div class="h-10 w-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                  </div>
                  <h3 class="font-bold text-slate-900 underline decoration-blue-200 underline-offset-4 group-hover:decoration-blue-500 transition-all">contacto@blessrom.com</h3>
                  <p class="mt-2 text-sm text-slate-500">Consultas generales y ventas</p>
                </a>
              </div>
            </div>

            <!-- Social Media -->
            <div class="bg-slate-900 rounded-3xl p-8 text-white relative overflow-hidden shadow-xl">
              <div class="relative z-10">
                <h3 class="text-xl font-bold mb-6">Síguenos en nuestras redes</h3>
                <div class="flex gap-4">
                  <a href="#" class="h-12 w-12 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-all">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.248h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                  </a>
                  <a href="#" class="h-12 w-12 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-all">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                  </a>
                </div>
              </div>
              <svg class="absolute right-0 bottom-0 h-48 w-48 text-white/5 -mr-16 -mb-16" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm3 7h-3V6a1 1 0 10-2 0v3H5a1 1 0 100 2h3v3a1 1 0 102 0v-3h3a1 1 0 100-2z" /></svg>
            </div>
          </div>

          <!-- Form Column -->
          <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50 border border-slate-100">
            <h3 class="text-2xl font-bold text-slate-900 mb-8 border-b border-slate-50 pb-4">Envíanos un mensaje</h3>
            <div class="space-y-8">
              <!-- Fila 1: Nombre (3 columnas como en la imagen) -->
              <div>
                <label class="form-label-primary">Nombre del cliente</label>
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

              <!-- Fila 2: Correo y Asunto (2 columnas) -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="flex flex-col">
                  <label class="form-label-primary">Correo electrónico</label>
                  <input type="email" placeholder="maria@ejemplo.com" class="form-input-premium">
                  <span class="form-label-sub">Tu email para responderte</span>
                </div>
                <div class="flex flex-col">
                  <label class="form-label-primary">Asunto de consulta</label>
                  <input type="text" placeholder="¿En qué podemos ayudarte?" class="form-input-premium">
                  <span class="form-label-sub">Opcional</span>
                </div>
              </div>

              <!-- Fila 3: Mensaje (Full width) -->
              <div class="flex flex-col">
                <label class="form-label-primary">Mensaje o Comentario</label>
                <textarea rows="5" placeholder="Escribe aquí tu duda..." class="form-input-premium resize-none"></textarea>
                <span class="form-label-sub">Cuéntanos los detalles</span>
              </div>

              <div class="pt-4">
                <button class="btn-blue-premium w-full sm:w-auto">
                  Enviar mensaje ahora
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  @endwhile
@endsection
