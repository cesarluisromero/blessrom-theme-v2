<div 
  x-data="{ 
    open: false, 
    loading: false, 
    product: {},
    fetchProduct(id) {
      this.loading = true;
      this.open = true;
      fetch(`<?php echo admin_url('admin-ajax.php'); ?>?action=custom_quick_view&product_id=${id}`)
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            this.product = data.data;
          }
          this.loading = false;
        });
    }
  }"
  @open-quick-view.window="fetchProduct($event.detail.product_id)"
  x-show="open"
  x-cloak
  class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black bg-opacity-70"
  @keydown.escape.window="open = false"
>
  <div 
    class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden flex flex-col md:flex-row relative"
    @click.away="open = false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
  >
    <!-- Close Button -->
    <button @click="open = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-10">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>

    <template x-if="loading">
      <div class="flex-grow flex items-center justify-center p-20">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
      </div>
    </template>

    <template x-if="!loading && product.id">
      <div class="flex flex-col md:flex-row w-full">
        <!-- Image Area -->
        <div class="md:w-1/2 p-6 bg-gray-50 flex items-center justify-center">
          <img :src="product.image" :alt="product.name" class="max-w-full h-auto rounded-lg shadow-sm">
        </div>

        <!-- Details Area -->
        <div class="md:w-1/2 p-8 flex flex-col">
          <h2 class="text-2xl font-bold text-gray-900 mb-2" x-text="product.name"></h2>
          <div class="text-xl font-semibold text-blue-600 mb-4" x-html="product.price_html"></div>
          
          <div class="text-sm text-gray-600 mb-6 flex-grow overflow-y-auto max-h-[200px]" x-html="product.description"></div>

          <div class="mt-auto space-y-4">
            <a :href="product.permalink" class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg font-bold hover:bg-blue-700 transition">
              Ver detalles completos
            </a>
            <button 
              class="block w-full bg-[#FFB816] text-white text-center py-3 rounded-lg font-bold hover:bg-yellow-500 transition"
              @click="window.location.href = product.permalink"
            >
              Comprar ahora
            </button>
          </div>
        </div>
      </div>
    </template>
  </div>
</div>
