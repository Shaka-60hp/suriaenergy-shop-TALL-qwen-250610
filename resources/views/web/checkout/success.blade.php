@extends('layouts.app')

@section('title', 'Pedido realizado')

@section('content')
    <div class="py-10">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md text-center">
            <div class="mb-6">
                <svg class="w-16 h-16 mx-auto text-green-600" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-green-600 mb-4">¡Pedido realizado!</h2>
            <p class="mb-6">Gracias por tu compra. Hemos enviado los detalles a tu correo.</p>

            <div class="bg-gray-50 border border-gray-200 p-4 rounded-md mb-6">
                @if (session('order'))
                    <p><strong>ID de Pedido:</strong> {{ session('order')->id }}</p>
                    <p><strong>Total:</strong> ${{ number_format(session('order')->order_total, 2) }}</p>
                @else
                    <p class="text-red-600">No se pudo recuperar el detalle del pedido.</p>
                @endif
            </div>
            <a href="{{ route('home') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition duration-200">
                Volver al inicio
            </a>
        </div>
    </div>
@endsection
