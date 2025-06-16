@extends('layouts.app')

@section('title', 'Bienvenido a SuriaEnergy Shop')

@section('content')
    <!-- Banner promocional -->
    <section class="relative bg-blue-600 text-white overflow-hidden rounded-lg mb-10">
        <div class="absolute inset-0 bg-cover bg-center opacity-20"
            style="background-image: url('{{ asset('images/banner-bg.jpg') }}');"></div>
        <div class="relative px-6 py-12 md:py-20 md:px-12 text-center max-w-4xl mx-auto">
            <h1 class="text-3xl md:text-5xl font-extrabold leading-tight">Energía Solar al Mejor Precio</h1>
            <p class="mt-4 text-lg md:text-xl">Descubre nuestros productos más vendidos y ofertas exclusivas.</p>
            <div class="mt-6 flex justify-center space-x-4">
                <a href="{{ route('products.top-selling') }}"
                    class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-2 px-4 rounded shadow hover:shadow-md transition">
                    Ver Más Vendidos
                </a>
                <a href="{{ route('products.on-sale') }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow hover:shadow-md transition">
                    Ver Ofertas
                </a>
            </div>
        </div>
    </section>

    <!-- Productos Destacados -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Destacados</h2>
        @livewire('featured-products')
    </section>
@endsection
