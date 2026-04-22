import '../styles/app.css';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/autoplay';
import AOS from 'aos';
import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';
import 'aos/dist/aos.css';

Alpine.plugin(collapse);

Swiper.use([Navigation, Pagination, Autoplay]);

document.addEventListener('alpine:init', () => {
  const map = window.BLESSROM_COLOR_IMAGE_MAP;
  if (!Alpine.store('product')) {
    Alpine.store('product', {
      colorImages: (map && Object.keys(map).length) ? map : {},
      currentImage: null,
    });
  }
});

const initSwiper = (container, options = {}) => {
  if (!container || container.swiper) return;
  
  const slides = container.querySelectorAll('.swiper-slide');
  if (slides.length <= 1) return;
  
  container.swiper = new Swiper(container, {
    observer: true,
    observeParents: true,
    watchOverflow: true,
    resizeObserver: true,
    ...options
  });
};

const initAllSwipers = () => {
  document.querySelectorAll('.product-swiper, .category-swiper, .vestidos-swiper').forEach(el => {
    initSwiper(el, {
      slidesPerView: 1,
      spaceBetween: 18,
      loop: true,
      autoplay: { delay: 3000, disableOnInteraction: false },
      pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
      navigation: {
        nextEl: el.closest('section')?.querySelector('[class*="-button-next"]'),
        prevEl: el.closest('section')?.querySelector('[class*="-button-prev"]'),
      },
      breakpoints: { 0: { slidesPerView: 1 }, 640: { slidesPerView: 3 }, 1024: { slidesPerView: 6 } }
    });
  });
  
  document.querySelectorAll('.bannervestidos-swiper, .home-banner2-swiper, .banner-vestidos-swiper').forEach(el => {
    initSwiper(el, {
      slidesPerView: 1,
      loop: true,
      autoplay: { delay: 5000, disableOnInteraction: false },
      pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
      navigation: {
        nextEl: el.querySelector('[class*="-button-next"]'),
        prevEl: el.querySelector('[class*="-button-prev"]'),
      }
    });
  });
};

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
    init() {
      const slideCount = this.$root.querySelectorAll('.swiper-slide').length;
      if (slideCount <= 1) return;

      this.swiper = new Swiper(this.$root, {
        loop: true,
        watchOverflow: true,
        observer: true,
        observeParents: true,
        pagination: { el: this.$root.querySelector('.swiper-pagination'), clickable: true },
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
        if (foundIndex >= 0) this.swiper.slideTo(foundIndex);
      };
    },
  };
};

const initPriceSlider = () => {
  const slider = document.getElementById('price-slider');
  const minInput = document.getElementById('min_price');
  const maxInput = document.getElementById('max_price');
  if (!slider || !minInput || !maxInput) return;

  const min = parseInt(minInput.value) || 5;
  const max = parseInt(maxInput.value) || 500;

  noUiSlider.create(slider, {
    start: [min, max],
    connect: true,
    step: 1,
    range: { min: 5, max: 500 },
    format: { to: v => Math.round(v), from: v => parseFloat(v) }
  });

  slider.noUiSlider.on('update', (values) => {
    const [minVal, maxVal] = values.map(v => Math.round(v));
    minInput.value = minVal;
    maxInput.value = maxVal;
    const minLabel = document.getElementById('price-min-label');
    const maxLabel = document.getElementById('price-max-label');
    if (minLabel) minLabel.innerText = `S/${minVal}`;
    if (maxLabel) maxLabel.innerText = `S/${maxVal}`;
  });
};

const setupGlobalEvents = () => {
  document.body.addEventListener('click', (e) => {
    const target = e.target;
    if (target.closest('button[class*="Vista rápida"]') || target.closest('[class*="quick-view"]')) return;
    const link = target.closest('a');
    if (link && link.href && link.classList.contains('dgwt-wcas-suggestion')) window.location.href = link.href;
  });

  window.addEventListener('load', () => {
    document.querySelectorAll('.swiper').forEach(el => { if (el.swiper) el.swiper.update(); });
  });
  
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

  let cartInitialized = false;
  const initCartCount = () => {
    if (cartInitialized) return;
    cartInitialized = true;
    document.body.addEventListener('added_to_cart', updateCartCount);
    document.body.addEventListener('wc_fragments_refreshed', updateCartCount);
    document.body.addEventListener('click', (e) => {
      if (e.target.closest('.add_to_cart_button')) updateCartCount();
    });
  };

  const cartIcon = document.querySelector('.cart-icon, .header-cart, #cart-count');
  if (cartIcon) {
    cartIcon.addEventListener('mouseenter', initCartCount, { once: true });
    cartIcon.addEventListener('click', initCartCount, { once: true });
  }
  if (document.querySelector('.woocommerce-cart, .woocommerce-checkout')) initCartCount();
};

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
  AOS.init({ once: true, duration: 800 });
  initAllSwipers();
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

window.addEventListener('load', () => {
  setTimeout(initAllSwipers, 100);
});