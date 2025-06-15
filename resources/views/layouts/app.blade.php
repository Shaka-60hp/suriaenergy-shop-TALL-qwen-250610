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

    <!-- Estilos personalizados (si los usas) -->
    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">SuriaEnergy Shop</h1>
            <nav>
                <a href="{{ route('home') }}" class="mr-4 hover:underline">Inicio</a>
                <a href="{{ route('cart.index') }}" class="hover:underline relative">
                    Carrito
                    @if (session('cart') && count(session('cart')))
                        <span
                            class="absolute -top-2 -right-3 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
            </nav>
        </div>

        <!-- Componente global del carrito -->
        <div class="hidden">
            @livewire('cart-component', key('cart-global'))
        </div>
    </header>

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

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Notificaciones globales con Livewire -->
    <script>
        document.addEventListener('livewire:init', function() {
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
