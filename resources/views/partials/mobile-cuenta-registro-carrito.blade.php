<div class="flex items-center gap-3">
      <div class="flex flex-col items-end">
        <a href="https://blessrom.com/mi-cuenta/" class="hover:underline text-sm font-bold">Mi cuenta</a>
        <a href="https://wa.me/51926940715" target="_blank" class="text-[9px] text-gray-300 hover:text-white transition-colors">Botbless: +51926940715</a>
      </div>
      <a href="https://blessrom.com/carrito/" class="relative">
        🛒
        <span id="cart-count" class="absolute -top-2 -right-2 bg-[#FFB816] text-white text-xs font-bold rounded-full px-1.5">
          {{ WC()->cart->get_cart_contents_count() }}
        </span>
      </a>
</div>