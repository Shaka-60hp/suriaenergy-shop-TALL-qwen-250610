<div>
    @if (isset($cartItems) && count($cartItems) > 0)
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

                        <div>
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

        <!-- Botón de Finalizar Compra -->
        <div class="mt-6">
            <a href="{{ route('cart.checkout') }}"
                class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-md transition duration-200">
                Finalizar compra
            </a>
        </div>
    @else
        <p class="text-gray-500">Tu carrito está vacío.</p>
    @endif

    <!-- Notificación Toast -->
    <script>
        document.addEventListener('livewire:load', function() {
            window.livewire.on('notify', (data) => {
                const toast = document.createElement('div');
                toast.className =
                    `fixed bottom-4 right-4 px-4 py-2 rounded shadow-md bg-${data.type === 'success' ? 'green' : data.type === 'error' ? 'red' : 'blue'}-600 text-white transition-opacity duration-300`;
                toast.innerText = data.message;
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.style.opacity = 0;
                    setTimeout(() => document.body.removeChild(toast), 300);
                }, 3000);
            });
        });
    </script>
</div>
