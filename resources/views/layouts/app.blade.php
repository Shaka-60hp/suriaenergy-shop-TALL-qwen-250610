<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SuriaEnergy')</title>

    <!-- Recursos estándar -->
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
    </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">

    <!-- Header con menú -->
    <header class="bg-white shadow-sm z-30">
        <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <!-- Logo -->
            <h1 class="text-xl font-bold text-blue-700">🔋 SuriaEnergy</h1>

            <!-- Menú Desktop -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition">Inicio</a>
                <a href="{{ route('products.index') }}"
                    class="text-gray-700 hover:text-blue-600 transition">Catálogo</a>
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-blue-600 transition">Carrito</a>

                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 transition">Mi cuenta</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">Iniciar sesión</a>
                    <a href="{{ route('register') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm transition duration-200">
                        Registrarse
                    </a>
                @endauth
            </nav>

            <!-- Menú Móvil -->
            <div x-data="{ open: false }" class="md:hidden relative">
                <button @click="open = !open" class="focus:outline-none text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Opciones del menú móvil -->
                <div x-show="open" @click.away="open = false" x-cloak
                    class="absolute right-0 top-10 bg-white shadow-lg rounded-md p-4 w-48 z-40">
                    <div class="flex flex-col space-y-3">
                        <a href="{{ route('home') }}" class="block text-gray-700 hover:text-blue-600">Inicio</a>
                        <a href="{{ route('products.index') }}"
                            class="block text-gray-700 hover:text-blue-600">Catálogo</a>
                        <a href="{{ route('cart.index') }}" class="block text-gray-700 hover:text-blue-600">Carrito</a>

                        @auth
                            <a href="{{ route('dashboard') }}" class="block text-gray-700 hover:text-blue-600">Mi
                                cuenta</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block text-red-600 hover:text-red-800 w-full text-left">
                                    Cerrar sesión
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-600">Iniciar
                                sesión</a>
                            <a href="{{ route('register') }}"
                                class="block bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded">
                                Registrarse
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-inner mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} SuriaEnergy - Todos los derechos reservados.
        </div>
    </footer>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Script global de redirección después de login -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('checkout-success', () => {
                window.location.href = "{{ route('checkout.success') }}";
            });
        });
    </script>

    <!-- Notificaciones globales -->
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('notify', (data) => {
                const [type, message] = data[0];

                const toast = document.createElement('div');
                toast.className =
                    `fixed bottom-4 right-4 px-4 py-2 rounded shadow-md bg-${type === 'success' ? 'green' : type === 'error' ? 'red' : 'blue'}-600 text-white transition-opacity duration-300 opacity-0`;
                toast.innerText = message;
                document.body.appendChild(toast);

                // Animación de entrada
                setTimeout(() => {
                    toast.style.opacity = 1;

                    // Desvanecerse
                    setTimeout(() => {
                        toast.style.opacity = 0;
                        setTimeout(() => document.body.removeChild(toast), 300);
                    }, 3000);
                }, 100);
            });
        });
    </script>
</body>

</html>
