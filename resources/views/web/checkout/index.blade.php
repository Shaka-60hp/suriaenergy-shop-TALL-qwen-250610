@extends('layouts.app')

@section('title', 'Finalizar Compra')

@section('content')
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Finalizar Compra</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Columna izquierda: Formulario -->
                <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md">
                    @if (!auth()->check())
                        <!-- Opción de login/register -->
                        <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 rounded">
                            <h3 class="font-semibold text-lg">¿Ya tienes cuenta?</h3>
                            <p class="mt-1 text-sm">Inicia sesión o regístrate para guardar tus datos.</p>
                            <div class="mt-3 flex space-x-3">
                                <a href="{{ route('login') }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                    Iniciar sesión
                                </a>
                                <a href="{{ route('register') }}"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm">
                                    Registrarse
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Formulario real -->
                    @livewire('checkout-form')
                </div>

                <!-- Columna derecha: Carrito -->
                <div class="bg-white p-6 rounded-lg shadow-md h-fit sticky top-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Tu carrito</h3>
                    @livewire('cart-component')
                </div>
            </div>
        </div>
    </div>
@endsection
