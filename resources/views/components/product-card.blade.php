<a href="{{ route('products.show', $product) }}"
    class="block bg-white rounded-lg shadow hover:shadow-md transition-shadow">
    <div class="relative h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product }}"
                class="object-cover w-full h-full">
        @else
            <span class="text-xs text-gray-400">Sin imagen</span>
        @endif
    </div>

    <div class="p-4">
        <h3 class="font-semibold">{{ $product->product }}</h3>
        <p class="text-sm text-gray-600 mt-1">SKU: {{ $product->sku }}</p>
        <p class="mt-2 font-bold">${{ number_format($product->price, 2) }}</p>
    </div>
</a>
