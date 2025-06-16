<div class="relative">
    <!-- Modal de carga -->
    <div wire:loading wire:target="submit" class="fixed inset-0 bg-gray-500/30 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-sm w-full mx-auto">
            <svg class="animate-spin h-8 w-8 mx-auto mb-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"
                    fill="none"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V4M12 4v4M12 20v-4m0 0h4m-4 0H4">
                </path>
            </svg>

            <p class="font-bold">Procesando tu pedido</p>
            <p class="text-sm text-gray-600 mt-1">Por favor, no cierres esta ventana</p>
        </div>
    </div>

    <!-- Formulario -->
    <div class="space-y-6" wire:loading.class="opacity-50 pointer-events-none">
        <!-- Nombre -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
            <input id="name" type="text" wire:model="name"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Juan Pérez">
            @error('name')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
            <input id="email" type="email" wire:model="email"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="ejemplo@email.com">
            @error('email')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Dirección -->
        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Dirección de envío</label>
            <input id="address" type="text" wire:model="address"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Calle Falsa 1234">
            @error('address')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Ciudad y Código postal -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700">Ciudad</label>
                <input id="city" type="text" wire:model="city"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Buenos Aires">
                @error('city')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="postal_code" class="block text-sm font-medium text-gray-700">Código postal</label>
                <input id="postal_code" type="text" wire:model="postal_code"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="1400">
                @error('postal_code')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Botón -->
        <div class="mt-6 flex justify-end">
            <button type="submit" wire:click="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md shadow transition duration-200">
                Finalizar compra
            </button>
        </div>

        <!-- Errores generales -->
        @if ($errors->any())
            <div class="mt-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
