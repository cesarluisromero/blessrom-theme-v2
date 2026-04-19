{{--
  Template Name: Legal Premium
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <div class="legal-page-container bg-slate-50 min-h-screen">
      <!-- Hero Header -->
      <div class="relative overflow-hidden bg-white pb-24 pt-16 sm:pb-32 sm:pt-24 shadow-sm">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.blue.50),white)]"></div>
        <div class="absolute inset-y-0 right-1/2 -z-10 mr-16 w-[200%] origin-bottom-left skew-x-[-30deg] bg-white shadow-xl shadow-blue-600/10 ring-1 ring-blue-50 sm:mr-28 lg:mr-0 xl:mr-16 xl:origin-center"></div>
        
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto max-w-2xl lg:mx-0">
            <nav class="flex mb-8" aria-label="Breadcrumb">
              <ol role="list" class="flex items-center space-x-4">
                <li>
                  <div>
                    <a href="/" class="text-slate-400 hover:text-slate-500">
                      <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7a1 1 0 010 1.414l-7 7a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-5.293-5.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        <path d="M10.707 17.707l-7-7a1 1 0 010-1.414l7-7a1 1 0 011.414 1.414L6.414 9H18a1 1 0 110 2H6.414l5.293 5.293a1 1 0 01-1.414 1.414z" />
                      </svg>
                    </a>
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <svg class="h-5 w-5 flex-shrink-0 text-slate-300" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                    <span class="ml-4 text-sm font-medium text-slate-500">Legal</span>
                  </div>
                </li>
              </ol>
            </nav>
            <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-6xl bg-gradient-to-r from-slate-900 to-slate-600 bg-clip-text text-transparent">
              {!! get_the_title() !!}
            </h1>
            <p class="mt-6 text-lg leading-8 text-slate-600">
              En Blessrom, tu satisfacción y confianza son nuestra prioridad. Aquí encontrarás los lineamientos detallados para que tu experiencia sea totalmente segura y transparente.
            </p>
          </div>
        </div>
      </div>

      <!-- Content Area -->
      <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8 lg:py-24">
        <div class="lg:grid lg:grid-cols-12 lg:gap-12">
          
          <!-- Sidebar Navigation -->
          <div class="hidden lg:col-span-3 lg:block">
            <nav class="sticky top-24 space-y-1" aria-label="Sidebar">
              <div class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-4">Secciones</div>
              <ul id="legal-nav" class="space-y-2">
                <!-- Se llenará con JS o manualmente si es necesario -->
              </ul>
            </nav>
          </div>

          <!-- Main Legal Content -->
          <div class="lg:col-span-9">
            <div id="legal-content" class="prose prose-slate prose-lg max-w-none 
              prose-headings:scroll-mt-28 prose-headings:font-bold prose-headings:text-slate-900
              prose-h2:text-2xl prose-h2:border-b prose-h2:pb-4 prose-h2:mb-8 prose-h2:mt-16
              prose-p:text-slate-600 prose-p:leading-relaxed
              prose-li:text-slate-600
              prose-strong:text-slate-900
              [&>h2]:flex [&>h2]:items-center [&>h2]:gap-3
            ">
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

    <style>
      /* Custom Icons for Legal Sections (Simulated via Before) */
      #legal-content h2::before {
        content: '';
        display: inline-block;
        width: 1.5rem;
        height: 1.5rem;
        background-color: theme('colors.blue.600');
        mask-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>');
        mask-size: contain;
        mask-repeat: no-repeat;
      }

      /* Estilos para que las secciones se vean como tarjetas si lo deseamos */
      #legal-content h2 {
        color: #1e293b;
      }

      /* Personalización de la navegación lateral activa */
      .nav-link-active {
        background-color: theme('colors.blue.50');
        color: theme('colors.blue.700');
        font-weight: 600;
        border-right: 4px solid theme('colors.blue.600');
      }
    </style>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const content = document.getElementById('legal-content');
        const nav = document.getElementById('legal-nav');
        const headers = content.querySelectorAll('h2');

        headers.forEach((h2, index) => {
          const id = 'section-' + index;
          h2.id = id;
          
          const li = document.createElement('li');
          const a = document.createElement('a');
          a.href = '#' + id;
          a.className = 'block px-3 py-2 text-sm text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-md transition-all duration-200';
          a.innerText = h2.innerText;
          
          li.appendChild(a);
          nav.appendChild(li);
        });

        // Simple scroll spy logic
        const observerOptions = {
          root: null,
          rootMargin: '-10% 0px -80% 0px',
          threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              document.querySelectorAll('#legal-nav a').forEach(a => {
                a.classList.remove('nav-link-active', 'bg-blue-50', 'text-blue-700', 'border-r-4', 'border-blue-600');
                if (a.getAttribute('href') === '#' + entry.target.id) {
                  a.classList.add('nav-link-active', 'bg-blue-50', 'text-blue-700', 'border-r-4', 'border-blue-600');
                }
              });
            }
          });
        }, observerOptions);

        headers.forEach(h2 => observer.observe(h2));
      });
    </script>
  @endwhile
@endsection
