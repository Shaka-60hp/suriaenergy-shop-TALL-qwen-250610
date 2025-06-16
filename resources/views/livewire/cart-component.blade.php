<div>
    @if (count($cartItems) > 0)
        <ul class="space-y-4">
            @foreach ($cartItems as $id => $item)
                <li class="flex items-center justify-between bg-gray-50 p-3 rounded-md shadow-sm">
                    <div class="flex items-center space-x-3">
                        @if (!empty($item['image']))
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                class="w-12 h-12 object-cover rounded">
                        @else
                            <div
                                class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-500">
                                Sin imagen
                            </div>
                        @endif

                        <div class="text-left">
                            <p class="font-medium">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-500">SKU: {{ $item['sku'] ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="text-right">
                        <p class="font-semibold">${{ number_format($item['price'], 2) }}</p>
                        <p class="text-sm text-gray-600">x{{ $item['quantity'] }}</p>
                    </div>
                </li>
            @endforeach
        </ul>

        <!-- Total -->
        <div class="mt-4 pt-4 border-t border-gray-200">
            <div class="flex justify-between text-lg font-bold">
                <span>Total:</span>
                <span>${{ number_format($total ?? 0, 2) }}</span>
            </div>
        </div>

        <!-- Botón Finalizar Compra -->
        <div class="mt-6">
            <a href="{{ route('cart.checkout') }}"
                class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-md transition duration-200">
                Finalizar compra
            </a>
        </div>
    @else
        <p class="text-gray-500">Tu carrito está vacío.</p>
    @endif
</div>
