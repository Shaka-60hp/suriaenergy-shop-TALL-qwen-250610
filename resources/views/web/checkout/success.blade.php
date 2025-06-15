@extends('layouts.app')

@section('title', 'Pedido realizado')

@section('content')
    <div class="py-10">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow-md text-center">
            <h2 class="text-2xl font-bold text-green-600 mb-4">¡Pedido realizado!</h2>
            <p class="mb-4">Gracias por tu pedido. Hemos enviado los detalles a tu correo electrónico.</p>

            <p><strong>ID de Orden:</strong> {{ session('order')->id }}</p>
            <p><strong>Total:</strong> ${{ number_format(session('order')->order_total, 2) }}</p>

            <div class="mt-6">
                <a href="{{ route('home') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
@endsection
