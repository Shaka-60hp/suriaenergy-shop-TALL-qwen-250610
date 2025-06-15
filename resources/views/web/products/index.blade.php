@extends('layouts.app')

@section('title', 'Catálogo de Productos')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Catálogo de Productos</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="border rounded-lg overflow-hidden bg-gray-100 shadow-sm hover:shadow-md transition-shadow">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product }}"
                        class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-lg">{{ $product->product }}</h3>
                    <p class="text-sm text-gray-600">SKU: {{ $product->sku }}</p>
                    <p class="mt-2 font-bold">${{ number_format($product->price, 2) }}</p>

                    <!-- Botón para agregar al carrito -->
                    <button x-data @click="$dispatch('add-to-cart', { productId: {{ $product->id }} })"
                        class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded shadow transition duration-200">
                        Agregar al carrito
                    </button>

                    <a href="{{ route('products.show', $product) }}"
                        class="mt-2 block text-center text-blue-600 hover:underline">
                        Ver detalle
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
