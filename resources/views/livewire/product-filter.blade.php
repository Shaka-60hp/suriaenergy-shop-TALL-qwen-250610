<div class="py-6">
    <!-- Búsqueda -->
    <div class="mb-6">
        <input wire:model.live="search" type="text" placeholder="Buscar producto..."
            class="w-full max-w-md border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Filtros laterales -->
        <div class="md:col-span-1 space-y-6">
            <!-- Familia / Categoría -->
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">Categorías</h3>
                <select wire:model.change="selectedFamily"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">Todas</option>
                    @foreach ($families as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Marca -->
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">Marcas</h3>
                <select wire:model.change="selectedBrand"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">Todas</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand }}">{{ $brand }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Precio mínimo -->
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">Precio mínimo</h3>
                <input wire:model.lazy="minPrice" type="number" step="0.01" min="0"
                    class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Precio máximo -->
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">Precio máximo</h3>
                <input wire:model.lazy="maxPrice" type="number" step="0.01" min="0"
                    class="w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        <!-- Resultados -->
        <div class="md:col-span-3">
            @if ($products->count())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <div
                            class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow duration-200">
                            <div class="relative h-48 bg-gray-200 flex items-center justify-center">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product }}"
                                        class="object-cover w-full h-full">
                                @else
                                    <span class="text-xs text-gray-400">Sin imagen</span>
                                @endif
                            </div>

                            <div class="p-4">
                                <h3 class="font-bold text-lg">{{ $product->product }}</h3>
                                <p class="text-sm text-gray-600 mt-1">SKU: {{ $product->sku }}</p>
                                <p class="mt-2 font-semibold text-xl">${{ number_format($product->price, 2) }}</p>

                                <div class="mt-2 text-sm text-gray-500">
                                    @if ($product->brand)
                                        <p><strong>Marca:</strong> {{ $product->brand }}</p>
                                    @endif
                                </div>

                                <div class="mt-4">
                                    <!-- Botón de Agregar al carrito -->
                                    <button x-data
                                        @click="$dispatch('add-to-cart', { productId: {{ $product->id }} })"
                                        class="mt-4 w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded transition">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación con estilo -->
                <div class="mt-6 flex justify-center">
                    {{ $products->links(data: ['scrollTo' => false]) }}
                </div>
            @else
                <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 p-4 rounded">
                    No se encontraron productos.
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
    <style>
        .pagination li {
            display: inline-block;
            margin-right: 4px;
        }

        .pagination li span,
        .pagination li a {
            @apply px-3 py-1 rounded-md text-sm hover:bg-blue-100;
        }

        .pagination .active span {
            @apply bg-blue-600 text-white hover:bg-blue-700;
        }
    </style>
@endpush
