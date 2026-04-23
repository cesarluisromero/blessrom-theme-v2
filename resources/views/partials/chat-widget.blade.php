<div x-data="chatWidget()" 
     class="fixed bottom-6 right-6 z-[9999] flex flex-col items-end"
     x-init="initChat()"
     @click.away="open = false">
    
    <!-- Panel de Chat -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-10 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-10 scale-95"
         class="mb-4 w-[350px] sm:w-[400px] bg-white rounded-2xl shadow-2xl border border-gray-100 flex flex-col overflow-hidden max-h-[600px] h-[80vh]">
        
        <!-- Header -->
        <div class="bg-black p-4 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-yellow-400 flex items-center justify-center text-black font-bold text-xl">B</div>
                <div>
                    <h3 class="font-bold text-sm leading-tight">Asistente Blessrom</h3>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="text-[10px] text-gray-300">En línea ahora</span>
                    </div>
                </div>
            </div>
            <button @click="open = false" class="text-gray-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Área de Mensajes -->
        <div id="chat-messages" class="flex-grow overflow-y-auto p-4 space-y-4 bg-gray-50/50 scroll-smooth">
            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="msg.role === 'user' ? 'bg-black text-white rounded-t-2xl rounded-bl-2xl' : 'bg-white text-gray-800 rounded-t-2xl rounded-br-2xl border border-gray-100 shadow-sm'"
                         class="max-w-[85%] p-3 text-sm">
                        <div x-html="msg.text"></div>
                        
                        <!-- Tarjetas de Productos (si hay) -->
                        <template x-if="msg.products && msg.products.length > 0">
                            <div class="mt-3 space-y-2">
                                <template x-for="product in msg.products" :key="product.id">
                                    <div class="bg-gray-50 rounded-xl p-2 border border-gray-100 flex gap-3 group">
                                        <img :src="product.imageUrl" class="w-16 h-16 object-cover rounded-lg flex-shrink-0" alt="">
                                        <div class="flex flex-col justify-between overflow-hidden text-left">
                                            <a :href="product.permalink" class="font-bold text-xs text-black truncate hover:underline" x-text="product.name"></a>
                                            <span class="text-xs font-bold text-yellow-600" x-html="product.priceFormatted"></span>
                                            <button @click="addToCart(product.id)" 
                                                    class="bg-black text-white text-[10px] py-1 px-2 rounded-lg hover:bg-gray-800 transition flex items-center justify-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                Agregar
                                            </button>
                                        </div>
                                    </div>
                                </template>

                                <!-- Botón de Ver Todos los Resultados -->
                                <template x-if="msg.searchUrl">
                                    <a :href="msg.searchUrl" 
                                       target="_blank"
                                       class="mt-3 block w-full bg-yellow-400 text-black text-center text-xs font-bold py-2.5 rounded-xl hover:bg-yellow-500 transition shadow-sm border border-yellow-500/20 no-underline">
                                        <span x-text="msg.searchLabel"></span>
                                    </a>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
            
            <!-- Indicador de Escritura -->
            <div x-show="loading" class="flex justify-start">
                <div class="bg-white border border-gray-100 p-3 rounded-2xl shadow-sm flex gap-1 items-center">
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce [animation-delay:0.2s]"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce [animation-delay:0.4s]"></span>
                </div>
            </div>
        </div>

        <!-- Input -->
        <form @submit.prevent="sendMessage()" class="p-4 bg-white border-t border-gray-100 flex gap-2">
            <input type="text" 
                   x-model="input" 
                   placeholder="Escribe tu duda aquí..." 
                   class="flex-grow bg-gray-100 border-none rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                   :disabled="loading">
            <button type="submit" 
                    class="bg-black text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-gray-800 transition disabled:opacity-50"
                    :disabled="loading || !input.trim()">
                <svg class="w-5 h-5 translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </form>
    </div>

    <!-- Botón Burbuja -->
    <button @click="open = !open" 
            class="bg-black text-white w-16 h-16 rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition active:scale-95 group relative">
        <div class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full border-2 border-white flex items-center justify-center text-[10px] font-bold" x-show="!open && messages.length <= 1">1</div>
        <svg x-show="!open" class="w-8 h-8 group-hover:rotate-12 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        <svg x-show="open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </button>
</div>

<script>
function chatWidget() {
    return {
        open: false,
        loading: false,
        input: '',
        sessionId: '',
        messages: [],
        
        initChat() {
            this.sessionId = sessionStorage.getItem('blessrom_chat_session') || crypto.randomUUID();
            sessionStorage.setItem('blessrom_chat_session', this.sessionId);
            
            const savedHistory = sessionStorage.getItem('blessrom_chat_history');
            if (savedHistory) {
                this.messages = JSON.parse(savedHistory);
            } else {
                this.messages.push({
                    role: 'assistant',
                    text: '¡Hola! 👋 Soy tu asistente personal de **Blessrom**. ¿En qué puedo ayudarte hoy?',
                    products: []
                });
            }
            
            this.$watch('messages', () => {
                sessionStorage.setItem('blessrom_chat_history', JSON.stringify(this.messages));
                this.scrollToBottom();
            });
        },

        async sendMessage() {
            if (!this.input.trim() || this.loading) return;
            
            const userText = this.input.trim();
            this.messages.push({ role: 'user', text: userText });
            this.input = '';
            this.loading = true;
            this.scrollToBottom();

            try {
                const formData = new FormData();
                formData.append('action', 'web_chat');
                formData.append('message', userText);
                formData.append('session_id', this.sessionId);
                
                // Si estamos en una página de producto, enviamos el ID
                const prodId = document.body.dataset.productId;
                if (prodId) formData.append('product_id', prodId);

                const response = await fetch('{{ admin_url('admin-ajax.php') }}', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    this.messages.push({
                        role: 'assistant',
                        text: data.data.message,
                        products: data.data.products || [],
                        searchUrl: data.data.searchUrl || null,
                        searchLabel: data.data.searchLabel || null
                    });
                } else {
                    this.messages.push({
                        role: 'assistant',
                        text: 'Lo siento, tuve un problema de conexión. ¿Puedes repetir la pregunta?'
                    });
                }
            } catch (error) {
                console.error('Chat Error:', error);
            } finally {
                this.loading = false;
                this.scrollToBottom();
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
                    // Notificar al sistema de carrito para que se actualice
                    document.body.dispatchEvent(new CustomEvent('added_to_cart', { detail: data }));
                    alert('¡Producto añadido al carrito!');
                }
            });
        },

        scrollToBottom() {
            setTimeout(() => {
                const container = document.getElementById('chat-messages');
                if (container) container.scrollTop = container.scrollHeight;
            }, 50);
        }
    }
}
</script>
