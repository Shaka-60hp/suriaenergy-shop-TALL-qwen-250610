@extends('layouts.app')

@section('title', 'Mi cuenta')

@section('content')
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Mi cuenta</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Menú lateral -->
                <div class="md:col-span-1 bg-white p-6 rounded-lg shadow-md">
                    <ul class="space-y-4">
                        <li><a href="{{ route('dashboard') }}" class="font-medium hover:text-blue-600">Historial de
                                pedidos</a></li>
                        <li><a href="#" class="hover:text-blue-600">Datos personales</a></li>
                        <li><a href="#" class="hover:text-blue-600">Direcciones</a></li>
                        <li><a href="{{ route('logout') }}" class="text-red-600 hover:text-red-800">Cerrar sesión</a></li>
                    </ul>
                </div>

                <!-- Contenido principal -->
                <div class="md:col-span-3">
                    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Historial de pedidos</h3>

                        @if ($orders->count())
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ID Pedido</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Fecha</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Total</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($orders as $order)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-4 text-sm">{{ $order->id }}</td>
                                            <td class="px-4 py-4 text-sm">{{ $order->date->format('d/m/Y') }}</td>
                                            <td class="px-4 py-4 text-sm">${{ number_format($order->order_total, 2) }}</td>
                                            <td class="px-4 py-4 text-sm">
                                                <span
                                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Completado
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-6">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <p class="text-gray-500">Aún no tienes ningún pedido.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
