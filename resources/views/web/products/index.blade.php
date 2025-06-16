@extends('layouts.app')

@section('title', 'Catálogo de Productos')

@section('content')
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Catálogo de Productos</h2>

            <!-- Componente de búsqueda y filtros -->
            @livewire('product-filter')
        </div>
    </div>
@endsection
