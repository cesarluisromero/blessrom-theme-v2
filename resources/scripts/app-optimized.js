import '../styles/app.css';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// Alpine setup
Alpine.plugin(collapse);

document.addEventListener('alpine:init', () => {
  const map = window.BLESSROM_COLOR_IMAGE_MAP;
  if (!Alpine.store('product')) {
    Alpine.store('product', {
      colorImages: (map && Object.keys(map).length) ? map : {},
      currentImage: null,
    });
  }
});

// --- SWIPER FACTORY (Lazy & Optimized) ---
const initSwiper = async (container, options = {}) => {
  // Solo cargamos Swiper si realmente hay un contenedor
  if (!container) return;

  // Importación dinámica (Code Splitting automático de Vite)
  const { default: Swiper } = await import('swiper');
  const { Navigation, Pagination, Autoplay, Scrollbar } = await import('swiper/modules');
  
  const defaultOptions = {
    modules: [Navigation, Pagination, Autoplay, Scrollbar],
    observer: true,
    observeParents: true,
  };

  return new Swiper(container, { ...defaultOptions, ...options });
};

// --- LAZY INITIALIZER ---
const lazyLoadModules = () => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(async (entry) => {
      if (entry.isIntersecting) {
        const el = entry.target;
        
        // Inicializar Swiper según clase
        if (el.classList.contains('product-swiper')) {
          initSwiper(el, {
            slidesPerView: 6,
            spaceBetween: 18,
            autoplay: { delay: 3000 },
            navigation: {
              nextEl: el.closest('section')?.querySelector('.product-swiper-button-next'),
              prevEl: el.closest('section')?.querySelector('.product-swiper-button-prev'),
            },
            breakpoints: { 0: { slidesPerView: 1 }, 640: { slidesPerView: 3 }, 1024: { slidesPerView: 6 } }
          });
        }

        // Inicializar AOS solo si es necesario
        if (el.hasAttribute('data-aos') && !window.AOS) {
          const { default: AOS } = await import('aos');
          import('aos/dist/aos.css');
          AOS.init({ once: true, duration: 800 });
          window.AOS = AOS;
        }

        observer.unobserve(el);
      }
    });
  }, { rootMargin: '100px' }); // Cargar 100px antes de que aparezca

  // Observar carruseles y elementos con AOS
  document.querySelectorAll('.product-swiper, .category-swiper, [data-aos]').forEach(el => observer.observe(el));
};

// --- AJAX OPTIMIZATION ---
const setupCartCount = () => {
  const updateCartCount = () => {
    fetch('/blessrom/?wc-ajax=get_refreshed_fragments', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
    .then(r => r.json())
    .then(data => {
      const wrapper = document.createElement('div');
      wrapper.innerHTML = data.fragments['div.widget_shopping_cart_content'];
      const updatedCart = wrapper.querySelector('#cart-count');
      const target = document.getElementById('cart-count');
      if (updatedCart && target) target.textContent = updatedCart.textContent.trim();
    });
  };

  // Solo actualizar al interactuar o al añadir al carrito, NO al cargar el DOM
  document.body.addEventListener('added_to_cart', updateCartCount);
  document.body.addEventListener('wc_fragments_refreshed', updateCartCount);
};

// Start
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
  lazyLoadModules();
  setupCartCount();
  
  // Menu Toggle (Legacy logic kept for safety)
  const toggle = document.getElementById('menu-toggle');
  const menu = document.getElementById('mobile-menu');
  if (toggle && menu) {
    toggle.addEventListener('click', () => {
      menu.classList.toggle('hidden');
      menu.classList.toggle('animate-slide-in');
    });
  }
});
