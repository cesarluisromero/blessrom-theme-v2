{{--
  Template Name: Contacto Premium
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <div class="contacto-page-container bg-white min-h-screen">
      <!-- Minimal Header -->
      <div class="bg-white border-b border-slate-50 py-12 md:py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center text-slate-900">
          <h1 class="text-3xl font-black tracking-tight sm:text-5xl uppercase">Formulario de Contacto</h1>
          <p class="mt-4 text-base text-slate-400 max-w-xl mx-auto italic">Por favor complete todos los campos requeridos.</p>
        </div>
      </div>

      <div class="mx-auto max-w-4xl px-6 py-12 lg:px-8">
        <div class="bg-white p-2">
            
            <div class="space-y-10">
              <!-- Grid 1: Email y Teléfono -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-8">
                <div class="flex flex-col">
                  <label class="form-label-primary font-bold text-slate-700 mb-2">Email</label>
                  <input type="email" placeholder="" class="form-input-premium border-slate-200 focus:border-blue-400 rounded-md">
                  <span class="text-xs text-slate-400 mt-1.5 ml-1">ejemplo@ejemplo.com</span>
                </div>
                <div class="flex flex-col">
                  <label class="form-label-primary font-bold text-slate-700 mb-2">Número de teléfono</label>
                  <input type="tel" placeholder="" class="form-input-premium border-slate-200 focus:border-blue-400 rounded-md">
                  <span class="text-xs text-slate-400 mt-1.5 ml-1">Favor ingrese un número de teléfono válido.</span>
                </div>
              </div>

              <!-- Radio Buttons: Cursos -->
              <div class="flex flex-col">
                <label class="form-label-primary font-bold text-slate-700 mb-4 text-lg">¿Ha recibido otros cursos Anteriormente?</label>
                <div class="flex items-center gap-12">
                   <label class="flex items-center gap-3 cursor-pointer group">
                      <div class="relative flex items-center justify-center">
                        <input type="radio" name="cursos_previos" class="peer appearance-none h-6 w-6 border-2 border-slate-200 rounded-full checked:border-blue-600 transition-all">
                        <div class="absolute h-3 w-3 bg-blue-600 rounded-full scale-0 peer-checked:scale-100 transition-transform"></div>
                      </div>
                      <span class="text-slate-700 font-medium group-hover:text-blue-600 transition-colors">Si</span>
                   </label>
                   <label class="flex items-center gap-3 cursor-pointer group">
                      <div class="relative flex items-center justify-center">
                        <input type="radio" name="cursos_previos" class="peer appearance-none h-6 w-6 border-2 border-slate-200 rounded-full checked:border-blue-600 transition-all">
                        <div class="absolute h-3 w-3 bg-blue-600 rounded-full scale-0 peer-checked:scale-100 transition-transform"></div>
                      </div>
                      <span class="text-slate-700 font-medium group-hover:text-blue-600 transition-colors">No</span>
                   </label>
                </div>
              </div>

              <!-- Grid 2: Empresa y Cursos -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-8">
                <div class="flex flex-col">
                  <label class="form-label-primary font-bold text-slate-700 mb-2">Empresa</label>
                  <input type="text" placeholder="" class="form-input-premium border-slate-200 focus:border-blue-400 rounded-md">
                </div>
                <div class="flex flex-col">
                  <label class="form-label-primary font-bold text-slate-700 mb-2">Cursos</label>
                  <div class="relative">
                    <select class="form-input-premium border-slate-200 focus:border-blue-400 rounded-md appearance-none w-full bg-white pr-10">
                        <option value="">Please Select</option>
                        <option value="curso1">Curso 01</option>
                        <option value="curso2">Curso 02</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Fila Full: Comentarios -->
              <div class="flex flex-col pt-4">
                <label class="form-label-primary font-bold text-slate-700 mb-4 text-lg">Comentarios adicionales</label>
                <textarea rows="8" placeholder="" class="form-input-premium border-slate-200 focus:border-blue-400 rounded-md resize-none w-full"></textarea>
              </div>

              <!-- Button Center -->
              <div class="pt-12 flex justify-center border-t border-slate-50">
                <button class="bg-[#2ecc71] hover:bg-[#27ae60] text-white font-bold py-4 px-16 rounded-md shadow-lg shadow-green-100 transition-all uppercase tracking-widest text-lg">
                  Enviar
                </button>
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
