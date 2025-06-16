<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SuriaEnergy Shop')</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Estilos personalizados -->
    <style>
        .product-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .pagination li {
            display: inline-block;
            margin-right: 4px;
        }

        .pagination li span,
        .pagination li a {
            @apply px-3 py-1 rounded-md text-sm hover:bg-blue-100;
        }

        .pagination .active span {
            @apply bg-blue-600 text-white hover:bg-blue-700;
        }
    </style>
    <!-- Estilos personalizados (si los usas) -->

    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-700">SuriaEnergy Shop</h1>

            <nav class="space-x-6">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition">Inicio</a>
                <a href="{{ route('products.index') }}"
                    class="text-gray-700 hover:text-blue-600 transition">Catálogo</a>
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-blue-600 transition">Carrito</a>

                <!-- Menú de usuario -->
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 transition">Mi cuenta</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600 transition">Registrarse</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Navegación rápida -->
    @if (request()->routeIs('home'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <a href="{{ route('products.top-selling') }}"
                    class="bg-gray-100 p-6 rounded-lg text-center hover:shadow-md transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800">🏆 Más Vendidos</h3>
                    <p class="mt-2 text-sm text-gray-600">Los productos más populares entre nuestros usuarios.</p>
                </a>

                <a href="{{ route('products.new') }}"
                    class="bg-gray-100 p-6 rounded-lg text-center hover:shadow-md transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800">🆕 Nuevos</h3>
                    <p class="mt-2 text-sm text-gray-600">Lo último en tecnología solar y eficiencia energética.</p>
                </a>

                <a href="{{ route('products.on-sale') }}"
                    class="bg-gray-100 p-6 rounded-lg text-center hover:shadow-md transition-shadow">
                    <h3 class="text-xl font-bold text-gray-800">💸 Ofertas</h3>
                    <p class="mt-2 text-sm text-gray-600">Descuentos especiales disponibles solo por tiempo limitado.
                    </p>
                </a>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-inner mt-12">
        <div class="max-w-7xl mx-auto px-4 py-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} SuriaEnergy - Todos los derechos reservados.
        </div>
    </footer>

    <!-- Componente global del carrito -->
    <div class="hidden">
        @livewire('cart-component')
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Notificaciones globales con Livewire -->
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('checkout-start', () => {
                processing = true;
            });

            Livewire.on('checkout-success', () => {
                processing = false;
                window.location.href = "{{ route('checkout.success') }}";
            });

            Livewire.on('notify', (data) => {

                // Accedemos a los datos reales en data[0]
                const {
                    type,
                    message
                } = data[0];

                const toast = document.createElement('div');
                toast.className =
                    `fixed top-4 right-4 px-4 py-3 rounded shadow-md bg-${data.type === 'success' ? 'green' : type === 'error' ? 'red' : 'blue'}-600 text-white transition-all duration-300 ease-in-out opacity-0 transform translate-y-4 pointer-events-none`;
                toast.innerText = message;
                document.body.appendChild(toast);

                // Animar entrada
                setTimeout(() => {
                    toast.classList.remove('opacity-0', 'translate-y-4');
                    toast.classList.add('opacity-100', 'translate-y-0');

                    // Animar salida
                    setTimeout(() => {
                        toast.classList.add('opacity-0', 'translate-y-4');
                        setTimeout(() => {
                            if (document.body.contains(toast)) {
                                document.body.removeChild(toast);
                            }
                        }, 300);
                    }, 3000);
                }, 100);
            });
        });
    </script>

    <!-- Scripts adicionales -->
    @stack('scripts')
</body>

</html>
