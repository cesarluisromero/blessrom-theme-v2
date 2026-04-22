<section x-data="productRecommendations()" 
         x-init="fetchRecommendations()" 
         class="max-w-6xl mx-auto px-2 md:px-4 lg:px-6 mt-12 mb-20"
         x-show="recommendations.length > 0 || loading">
    
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-xl md:text-2xl font-bold flex items-center gap-2">
            Te puede interesar
            <span class="text-[10px] bg-black text-white px-2 py-0.5 rounded-full uppercase tracking-widest font-bold">Smart IA</span>
        </h2>
        <div class="h-[1px] flex-grow bg-gray-100 ml-6 hidden md:block"></div>
    </div>

    <!-- Skeleton Loader -->
    <template x-if="loading">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <template x-for="i in 4">
                <div class="animate-pulse">
                    <div class="bg-gray-200 aspect-[3/4] rounded-2xl mb-4"></div>
                    <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                </div>
            </template>
        </div>
    </template>

    <!-- Grid de Recomendaciones -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6" x-show="!loading">
        <template x-for="product in recommendations" :key="product.id">
            <div class="group relative bg-white border border-transparent hover:border-gray-100 rounded-2xl p-2 transition-all duration-300 hover:shadow-xl">
                <!-- Imagen -->
                <div class="relative aspect-[3/4] overflow-hidden rounded-xl mb-4">
                    <img :src="product.imageUrl" :alt="product.name" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300"></div>
                    
                    <!-- Botón rápido -->
                    <div class="absolute bottom-3 left-3 right-3 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                        <button @click="addToCart(product.id)" 
                                class="w-full bg-white/90 backdrop-blur-md text-black py-2.5 rounded-xl text-xs font-bold shadow-lg hover:bg-black hover:text-white transition-colors duration-300 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            Agregar al carrito
                        </button>
                    </div>
                </div>

                <!-- Info -->
                <div class="px-1 pb-2 text-center">
                    <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1" x-text="'Similitud IA: ' + Math.round(product.score * 100) + '%'"></h3>
                    <a :href="product.url" class="block font-bold text-sm text-gray-900 mb-2 truncate hover:text-yellow-600 transition" x-text="product.name"></a>
                    <div class="text-lg font-black text-black" x-html="product.priceHtml"></div>
                </div>
            </div>
        </template>
    </div>
</section>

<script>
function productRecommendations() {
    return {
        loading: true,
        recommendations: [],
        productId: '{{ $seedProductId ?? ($product ? $product->get_id() : "") }}',
        
        async fetchRecommendations() {
            if (!this.productId) return;
            try {
                // Rango de precio: ±S/50 del precio actual para filtrar recomendaciones
                const currentPrice = {{ $seedProductPrice ?? ($product ? $product->get_price() : 0) ?: 0 }};
                const priceRange = 50; 

                const response = await fetch(`{{ admin_url('admin-ajax.php') }}?action=product_recommendations&product_id=${this.productId}&limit=4&price_range=${priceRange}`);
                const data = await response.json();
                
                if (data.success) {
                    this.recommendations = data.data;
                }
            } catch (error) {
                console.error('Error fetching recommendations:', error);
            } finally {
                this.loading = false;
            }
        },

        addToCart(productId) {
            const formData = new FormData();
            formData.append('action', 'add_product_to_cart');
            formData.append('add-to-cart', productId);
            formData.append('quantity', 1);

            fetch('{{ admin_url('admin-ajax.php') }}', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.body.dispatchEvent(new CustomEvent('added_to_cart', { detail: data }));
                    alert('¡Producto añadido!');
                }
            });
        }
    }
}
</script>
