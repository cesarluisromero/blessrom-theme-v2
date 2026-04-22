<section class="hidden md:block full-bleed text-center py-2 px-4">
  <div class="bg-white">
    <div class="swiper banner-vestidos-swiper min-h-[400px] lg:min-h-[600px]">
      <div class="swiper-wrapper">
        @forelse($slides_desktop as $index => $slide)
          <div class="swiper-slide">
            <img
              src="{{ esc_url($slide['imagen']['url'] ?? $slide['imagen'] ?? '') }}"
              alt="{{ esc_attr($slide['alt'] ?? '') }}"
              class="w-full h-full object-cover"
              {{ $index === 0 ? 'fetchpriority="high"' : 'loading="lazy"' }} 
              decoding="async">
          </div>
        @empty
          <div class="swiper-slide">
            <img
              src="{{ esc_url('https://blessrom.com/wp-content/uploads/2025/09/Beige-Brown-Clean-Aesthetic-Fashion-Collection-Medium-Banner-scaled.png') }}"
              alt="Banner"
              class="w-full h-full object-cover"
              fetchpriority="high" decoding="async">
          </div>
        @endforelse
      </div>

      <!-- Botones -->
      <div class="swiper-button-prev banner-vestidos-swiper-button-prev !hidden md:!flex text-white absolute left-0 top-1/2 -translate-y-1/2 z-10 w-10 h-10 items-center justify-center bg-transparent rounded-full"></div>
      <div class="swiper-button-next banner-vestidos-swiper-button-next !hidden md:!flex text-white absolute right-0 top-1/2 -translate-y-1/2 z-10 w-10 h-10 items-center justify-center bg-transparent rounded-full"></div>
      
      <!-- Paginación -->
      <div class="swiper-pagination banner-vestidos-swiper-pagination"></div>
    </div>

    @if($button_url)
    <div class="mt-6 mb-10 flex justify-center">
      <a href="{{ esc_url($button_url) }}"
        class="inline-flex items-center gap-2 rounded-full bg-[#FFB816] px-6 py-3 text-white font-semibold shadow hover:bg-yellow-500">
        {{ esc_html($button_text) }}
      </a>
    </div>
    @endif
  </div>
</section>

<section class="block md:hidden full-bleed text-center py-6 overflow-x-clip">
  <div class="bg-white">
    <div class="swiper banner-vestidos-swiper rounded-none min-h-[250px]" aria-label="Banner vestidos móvil">
      <div class="swiper-wrapper">
        @forelse($slides_mobile as $index => $slide)
          <div class="swiper-slide">
            <img
              src="{{ esc_url($slide['imagen']['url'] ?? $slide['imagen'] ?? '') }}"
              alt="{{ esc_attr($slide['alt'] ?? '') }}"
              class="w-full h-auto block"
              {{ $index === 0 ? 'fetchpriority="high"' : 'loading="lazy"' }} 
              decoding="async">
          </div>
        @empty
          <div class="swiper-slide">
            <img
              src="{{ esc_url('https://blessrom.com/wp-content/uploads/2025/09/1.png') }}"
              alt="Banner"
              class="w-full h-auto block"
              fetchpriority="high" decoding="async">
          </div>
        @endforelse
      </div>

      <div class="swiper-button-prev banner-vestidos-swiper-button-prev !hidden"></div>
      <div class="swiper-button-next banner-vestidos-swiper-button-next !hidden"></div>
      
      <!-- Paginación móvil -->
      <div class="swiper-pagination banner-vestidos-swiper-pagination !bottom-0"></div>
    </div>

    @if($button_url)
    <div class="mt-6 mb-10 flex justify-center">
      <a href="{{ esc_url($button_url) }}"
        class="inline-flex items-center gap-2 rounded-full bg-[#FFB816] px-6 py-3 text-white font-semibold shadow hover:bg-yellow-500">
        {{ esc_html($button_text) }}
      </a>
    </div>
    @endif
  </div>
</section>



