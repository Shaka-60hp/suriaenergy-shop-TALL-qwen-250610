<div class="py-10">
    <!-- Más Vendidos -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">🏆 Más Vendidos</h2>
        @if ($topSelling->count())
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach ($topSelling as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No hay productos populares disponibles.</p>
        @endif
    </section>

    <!-- Ofertas -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">💸 Ofertas Especiales</h2>
        @if ($onSale->count())
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach ($onSale as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No hay ofertas disponibles en este momento.</p>
        @endif
    </section>

    <!-- Nuevos -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">🆕 Nuevos Productos</h2>
        @if ($newest->count())
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach ($newest as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No hay nuevos productos disponibles.</p>
        @endif
    </section>
</div>
