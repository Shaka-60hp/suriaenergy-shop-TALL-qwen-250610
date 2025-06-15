@extends('layouts.app')

@section('title', 'Finalizar Compra')

@section('content')
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Finalizar Compra</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Formulario -->
                <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Datos de envío</h3>

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nombre -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre
                                    completo</label>
                                <input type="text" name="name" id="name"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo
                                    electrónico</label>
                                <input type="email" name="email" id="email"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>

                            <!-- Dirección -->
                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
                                <input type="text" name="address" id="address"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>

                            <!-- Ciudad -->
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">Ciudad</label>
                                <input type="text" name="city" id="city"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>

                            <!-- Código postal -->
                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700">Código
                                    postal</label>
                                <input type="text" name="postal_code" id="postal_code"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>
                        </div>

                        <!-- Botón de submit -->
                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md shadow transition duration-200">
                                Finalizar compra
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Carrito resumen -->
                <div class="bg-white p-6 rounded-lg shadow-md h-fit sticky top-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Tu carrito</h3>

                    @livewire('cart-component')
                </div>
            </div>
        </div>
    </div>
@endsection
