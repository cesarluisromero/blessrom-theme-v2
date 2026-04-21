
      {{-- Íconos --}}
      <div class="flex items-center space-x-3">
        {{--<a href="#" class="hover:underline">Registrate</a>--}}
        <div class="flex flex-col items-end">
          <a href="https://blessrom.com/mi-cuenta/" class="hover:underline font-bold">Mi cuenta</a>
          <a href="https://wa.me/51926940715" target="_blank" class="text-[10px] text-gray-300 hover:text-white transition-colors">Consulta a Botbless: +51926940715</a>
        </div>
        <a href="https://blessrom.com/carrito/" class="relative hover:underline widget_shopping_cart_content bg-white text-white p-2 rounded-full">
          🛒
          <span id="cart-count" class="absolute -top-2 -right-2 bg-[#FFB816] text-white text-xs font-bold rounded-full px-1.5">
            {{ WC()->cart->get_cart_contents_count() }}
          </span>
        </a>
      </div>

      