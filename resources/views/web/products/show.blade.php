@extends('layouts.app')

@section('title', $product->product)

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Imagen -->
            <div class="md:w-1/2">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product }}"
                        class="w-full rounded shadow-md">
                @else
                    <div class="bg-gray-200 w-full h-64 flex items-center justify-center rounded">
                        <span class="text-gray-500">Sin imagen disponible</span>
                    </div>
                @endif
            </div>

            <!-- Detalles -->
            <div class="md:w-1/2">
                <h2 class="text-2xl font-bold mb-2">{{ $product->product }}</h2>
                <p class="text-sm text-gray-600 mb-4">SKU: {{ $product->sku }} {{ $product->id }}</p>
                <p class="mb-4">{{ $product->description ?? 'Sin descripción disponible.' }}</p>
                <p class="text-xl font-semibold mb-4">${{ number_format($product->price, 2) }}</p>

                <!-- Botón de agregar al carrito -->
                <button x-data @click="$dispatch('add-to-cart', { productId: {{ $product->id }} })"
                    class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    Agregar al carrito
                </button>
                <div x-data
                    @click="$dispatch('add-to-cart', { productId: {{ $product->id }} }); console.log('Evento add-to-cart disparado', {{ $product->id }})"
                    class="cursor-pointer bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 inline-block">
                    Agregar al carrito
                </div>
            </div>
        </div>
        <button onclick="console.log('Botón clickeado')">Agregar al carrito</button>
        <div x-data="{ count: 0 }">
            <button @click="count++">Incrementar</button>
            <span x-text="count"></span>
        </div>
        <!-- Atributos personalizados -->
        @if (count($customFields))
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-3">Especificaciones técnicas</h3>
                <ul class="space-y-2">
                    @foreach ($customFields as $field => $value)
                        <li><strong>{{ $field }}:</strong> {{ $value }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
