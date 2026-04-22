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
  if (!container) return;
  const { default: Swiper } = await import('swiper');
  const { Navigation, Pagination, Autoplay, Scrollbar } = await import('swiper');
  
  const defaultOptions = {
    modules: [Navigation, Pagination, Autoplay, Scrollbar].filter(Boolean),
    observer: true,
    observeParents: true,
  };
  return new Swiper(container, { ...defaultOptions, ...options });
};

// --- ALPINE COMPONENTS ---

window.alpineCart = function() {
    return {
        selected_pa_talla: '',
        selected_pa_color: '',
        quantity: 1,
        maxQty: 0,
        errorMessage: '',
        availableVariations: [],
        cartQuantities: {},
        currentVariationId: 0,

        init() {
            this.availableVariations = JSON.parse(this.$root.dataset.product_variations || '[]');
            this.cartQuantities = JSON.parse(this.$root.dataset.cart_quantities || '{}');
            this.$watch('selected_pa_color', color => {
              const talla = this.selected_pa_talla;
              if (!color || !talla) return;
              const variation = this.availableVariations.find(v =>
                  v.attributes['attribute_pa_talla'] === talla &&
                  v.attributes['attribute_pa_color'] === color
              );
              if (variation) {
                  const url = Alpine.store('product')?.colorImages?.[color];
                  if (url) Alpine.store('product').slideToImage(url);
              }
          });
        },

        updateMaxQty() {
            const match = this.availableVariations.find(v => {
                return Object.entries(v.attributes).every(([key, val]) => {
                    const attr = key.replace('attribute_', '');
                    return this['selected_' + attr] === val;
                });
            });

            if (match) {
                const vid = match.variation_id;
                const stock = parseInt(match.max_qty) || 0;
                const inCart = this.cartQuantities?.[vid] ?? 0;
                this.maxQty = stock - inCart;
                this.currentVariationId = vid;
                this.errorMessage = inCart >= stock ? "Ya tienes toda la cantidad disponible." : "";
                this.quantity = inCart >= stock ? 0 : 1;
                this.$refs.variationId.value = vid;
                this.$refs.maxQty.value = this.maxQty;
            }
        },

        async addToCartAjax(form) {
          let formData = new FormData(form);
          formData.append('action', 'add_to_cart_custom');
          formData.append('product_id', form.dataset.product_id);
          
          try {
            const response = await fetch(wc_add_to_cart_params.ajax_url, {
              method: 'POST',
              credentials: 'same-origin',
              body: formData,
            });
            window.location.href = response.redirected ? response.url : wc_add_to_cart_params.cart_url;
          } catch (err) {
            this.errorMessage = "Error al agregar al carrito.";
          }
        }
    }
};

window.productGallery = function () {
  return {
    swiper: null,
    async init() {
      const { default: Swiper } = await import('swiper');
      const { Navigation, Pagination } = await import('swiper/modules');

      const slideCount = this.$root.querySelectorAll('.swiper-slide').length;

      this.swiper = new Swiper(this.$root, {
        modules: [Navigation, Pagination],
        loop: slideCount > 1,
        watchOverflow: true,
        observer: true,
        observeParents: true,
        pagination: {
          el: this.$root.querySelector('.swiper-pagination'),
          clickable: true,
        },
      });

      const normalizarUrlImagen = (url) => {
          if (!url) return '';
          let base = url.split('#')[0].split('?')[0];
          const idx = base.indexOf('/uploads/');
          if (idx !== -1) base = base.substring(idx);
          return decodeURIComponent(base).toLowerCase().replace(/\.(jpe?g|png|webp|avif)$/i, '');
      };
      
      Alpine.store('product').slideToImage = (targetUrl) => {
        if (!this.swiper || !targetUrl) return;
        const objetivo = normalizarUrlImagen(targetUrl);
        let foundIndex = -1;
        const slides = this.swiper.slides;

        for (let i = 0; i < slides.length; i++) {
          const img = slides[i].querySelector('img');
          if (img && normalizarUrlImagen(img.currentSrc || img.src) === objetivo) {
            foundIndex = i;
            break;
          }
        }

        if (foundIndex >= 0) {
          this.swiper.slideTo(foundIndex);
        } else {
          const active = this.swiper.slides[this.swiper.activeIndex];
          const img = active && active.querySelector('img');
          if (img) {
            img.src = targetUrl;
            this.swiper.update();
          }
        }
      };
    },
  };
};

// --- NO-UI-SLIDER (Lazy Load) ---
const initPriceSlider = async () => {
  const slider = document.getElementById('price-slider');
  const minInput = document.getElementById('min_price');
  const maxInput = document.getElementById('max_price');
  if (!slider || !minInput || !maxInput) return;

  const { default: noUiSlider } = await import('nouislider');
  import('nouislider/dist/nouislider.css');

  noUiSlider.create(slider, {
    start: [parseFloat(minInput.value || 5), parseFloat(maxInput.value || 500)],
    connect: true,
    range: { 'min': 5, 'max': 500 },
    format: { to: v => Math.round(v), from: v => parseFloat(v) }
  });

  slider.noUiSlider.on('update', (values) => {
    const [min, max] = values.map(v => Math.round(v));
    minInput.value = min;
    maxInput.value = max;
    const minLabel = document.getElementById('price-min-label');
    const maxLabel = document.getElementById('price-max-label');
    if (minLabel) minLabel.innerText = `S/${min}`;
    if (maxLabel) maxLabel.innerText = `S/${max}`;
  });
};

// --- LAZY INITIALIZER ---
const lazyLoadModules = () => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(async (entry) => {
      if (entry.isIntersecting) {
        const el = entry.target;
        if (el.dataset.initialized) return;
        el.dataset.initialized = 'true';

        // Configuración para productos y categorías
        if (el.classList.contains('product-swiper') || el.classList.contains('category-swiper') || el.classList.contains('vestidos-swiper')) {
          const slideCount = el.querySelectorAll('.swiper-slide').length;
          initSwiper(el, {
            slidesPerView: 6,
            spaceBetween: 18,
            loop: slideCount > 6,
            watchOverflow: true,
            autoplay: slideCount > 6 ? { delay: 3000, disableOnInteraction: false } : false,
            pagination: { 
              el: el.querySelector('.swiper-pagination'),
              clickable: true,
              dynamicBullets: true
            },
            navigation: {
              nextEl: el.closest('section')?.querySelector('[class*="-button-next"]'),
              prevEl: el.closest('section')?.querySelector('[class*="-button-prev"]'),
            },
            breakpoints: { 
              0: { slidesPerView: 1, loop: slideCount > 1, autoplay: slideCount > 1 }, 
              640: { slidesPerView: 3, loop: slideCount > 3 }, 
              1024: { slidesPerView: 6, pagination: { enabled: false } } 
            }
          }).catch(err => console.error('Swiper error:', err));
        } 
        // Configuración para banners principales
        else if (el.classList.contains('bannervestidos-swiper') || el.classList.contains('home-banner2-swiper') || el.classList.contains('banner-vestidos-swiper')) {
          const slideCount = el.querySelectorAll('.swiper-slide').length;
          initSwiper(el, {
            slidesPerView: 1,
            loop: slideCount > 1,
            watchOverflow: true,
            autoplay: slideCount > 1 ? { delay: 5000, disableOnInteraction: false } : false,
            pagination: { 
              el: el.querySelector('.swiper-pagination'),
              clickable: true 
            },
            navigation: {
              nextEl: el.querySelector('[class*="-button-next"]'),
              prevEl: el.querySelector('[class*="-button-prev"]'),
            }
          }).catch(err => console.error('Swiper error:', err));
        }

        if (el.hasAttribute('data-aos') && !window.AOS) {
          const { default: AOS } = await import('aos');
          import('aos/dist/aos.css');
          AOS.init({ once: true, duration: 800, offset: 50 });
          window.AOS = AOS;
        }
        observer.unobserve(el);
      }
    });
  }, { rootMargin: '0px' }); // Sin margen para carga inmediata en viewport
  
  const selectors = '.product-swiper, .category-swiper, .vestidos-swiper, .bannervestidos-swiper, .home-banner2-swiper, .banner-vestidos-swiper, [data-aos]';
  document.querySelectorAll(selectors).forEach(el => observer.observe(el));
};

// --- GLOBAL EVENTS ---
const setupGlobalEvents = () => {
  document.body.addEventListener('click', (e) => {
    const target = e.target;
    
    // Asegurar que clics en "Vista rápida" no se pierdan
    if (target.closest('button[class*="Vista rápida"]') || target.closest('[class*="quick-view"]')) {
      return; 
    }

    const link = target.closest('a');
    if (link && link.href && link.classList.contains('dgwt-wcas-suggestion')) {
      window.location.href = link.href;
    }
  });

  // Forzar actualización de Swiper cuando todo carga (imágenes de LiteSpeed, etc.)
  window.addEventListener('load', () => {
    document.querySelectorAll('.swiper').forEach(el => {
      if (el.swiper) el.swiper.update();
    });
  });
  
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
    // Lazy load: solo actualizar cuando hay interacción real con el carrito
    let cartInitialized = false;
    const initCartCount = () => {
      if (cartInitialized) return;
      cartInitialized = true;
      document.body.addEventListener('added_to_cart', updateCartCount);
      document.body.addEventListener('wc_fragments_refreshed', updateCartCount);
      // Actualizar inmediatamente al hacer click en botones de añadir al carrito
      document.body.addEventListener('click', (e) => {
        if (e.target.closest('.add_to_cart_button, [data添加到cart]')) {
          updateCartCount();
        }
      });
    };
    // Cargar bajo demanda al hacer hover en el icono del carrito o al abrir la página de checkout
    const cartIcon = document.querySelector('.cart-icon, .header-cart, #cart-count');
    if (cartIcon) {
      cartIcon.addEventListener('mouseenter', initCartCount, { once: true });
      cartIcon.addEventListener('click', initCartCount, { once: true });
    }
    // También en páginas de checkout/cart
    if (document.querySelector('.woocommerce-cart, .woocommerce-checkout')) {
      initCartCount();
    }
  };
  setupCartCount();
};

// Start
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
  lazyLoadModules();
  setupGlobalEvents();
  initPriceSlider();
  
  const toggle = document.getElementById('menu-toggle');
  const menu = document.getElementById('mobile-menu');
  if (toggle && menu) {
    toggle.addEventListener('click', () => {
      menu.classList.toggle('hidden');
      menu.classList.toggle('animate-slide-in');
    });
  }
});
