<div wire:init="loadCart" class="relative">
    <a href="{{ route('cart.index') }}" class="flex items-center space-x-2 group">
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-6 h-6 text-gray-700 group-hover:text-blue-600 transition">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M3 3l2 2m5 18a9 9 0 1 1 0-18 9 9 0 0 1 0 18z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>

            @if ($totalItems > 0)
                <span
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                    {{ $totalItems }}
                </span>
            @endif
        </div>

        <span class="hidden md:inline-block text-sm font-medium text-gray-700 group-hover:text-blue-600">
            ${{ number_format($totalPrice, 2) }}
        </span>
    </a>
</div>
