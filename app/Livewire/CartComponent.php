<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

/**
 * CartComponent is a Livewire component that manages the shopping cart functionality.
 * It listens for 'add-to-cart' events and updates the cart stored in the session.
 */
class CartComponent extends Component
{
    public $cart = [];

    protected $listeners = ['add-to-cart' => 'addToCart'];

    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }

    public function addToCart($productId)
    {
        \Log::info("Producto agregado al carrito", ['productId' => $productId]);

        $product = Product::find($productId);

        if (!$product) {
            $this->dispatch('notify', ['type' => 'error', 'message' => 'Producto no encontrado.']);
            return;
        }
        // Lógica para agregar producto al carrito...
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity'] += 1;
        } else {
            $this->cart[$productId] = [
                'id' => $product->id,
                'sku' => $product->sku,
                'name' => $product->product,
                'price' => $product->price,
                'image' => $product->image, // <-- Asegúrate de que este campo exista en tu modelo
                'quantity' => 1,
            ];
        }
        session()->put('cart', $this->cart);
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Producto agregado al carrito'
        ]);
    }

    public function render()
    {
        $cartItems = $this->cart ?? [];

        // Calcular total
        $total = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('livewire.cart-component', [
            'cartItems' => $cartItems,
            'total' => $total, // Pasamos $total a la vista
        ]);
    }
}
