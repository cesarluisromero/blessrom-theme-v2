{{--
  Template Name: Legal Premium
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <div class="legal-page-container bg-slate-50 min-h-screen">
      <!-- Hero Header -->
      <div class="relative overflow-hidden bg-white pb-24 pt-16 sm:pb-32 sm:pt-24 shadow-sm">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.slate.50),white)]"></div>
        
        <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center sm:text-left">
          <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-6xl bg-gradient-to-r from-slate-900 to-slate-600 bg-clip-text text-transparent">
            {!! get_the_title() !!}
          </h1>
          <p class="mt-6 text-lg leading-8 text-slate-600 max-w-2xl">
            En Blessrom, tu satisfacción y confianza son nuestra prioridad. Aquí encontrarás los lineamientos detallados para tu seguridad.
          </p>
        </div>
      </div>

      <!-- Content Area -->
      <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-12">
          
          <!-- Sidebar Navigation -->
          <div class="hidden lg:col-span-3 lg:block">
            <nav class="sticky top-24 space-y-1">
              <div class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-4">Secciones</div>
              <ul id="legal-nav" class="space-y-2"></ul>
            </nav>
          </div>

          <!-- Main Legal Content -->
          <div class="lg:col-span-9">
            <div id="legal-content" class="prose prose-slate prose-lg max-w-none prose-headings:scroll-mt-28 prose-h2:text-2xl prose-h2:border-b prose-h2:pb-4">
              {!! get_the_content() !!}
            </div>

            <div class="mt-20 pt-10 border-t border-slate-200">
              <p class="text-sm text-slate-500 italic">
                Última actualización: @php(the_modified_date('d-m-Y'))
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const content = document.getElementById('legal-content');
        const nav = document.getElementById('legal-nav');
        if (!content || !nav) return;
        const headers = content.querySelectorAll('h2');

        headers.forEach((h2, index) => {
          const id = 'section-' + index;
          h2.id = id;
          const li = document.createElement('li');
          const a = document.createElement('a');
          a.href = '#' + id;
          a.className = 'block px-3 py-2 text-sm text-slate-600 hover:text-[#111B2E] transition-all font-medium';
          a.innerText = h2.innerText;
          li.appendChild(a);
          nav.appendChild(li);
        });
      });
    </script>
  @endwhile
@endsection
