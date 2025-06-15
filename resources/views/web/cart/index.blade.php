@extends('layouts.app')

@section('title', 'Mi Carrito')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Mi Carrito</h2>
    @livewire('cart-component')
@endsection
