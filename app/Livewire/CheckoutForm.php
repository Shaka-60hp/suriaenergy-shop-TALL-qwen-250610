<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;

class CheckoutForm extends Component
{
    public $name = '';
    public $email = '';
    public $address = '';
    public $city = '';
    public $postal_code = '';

    public function mount()
    {
        if (auth()->check()) {
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
        }
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'address' => 'required|string',
        'city' => 'required|string',
        'postal_code' => 'required|string',
    ];

    public function submit()
    {
        // Validar datos
        $validated = $this->validate();

        // Simular demora (opcional)
        // sleep(20);
        $this->dispatch('checkout-start');

        // Obtener carrito desde sesión
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            $this->addError('general', 'Tu carrito está vacío');
            return;
        }

        // Guardar pedido
        $order = Order::create([
            'contact_id' => auth()->id(),
            'seller_id' => 1,
            'order_type' => 0,
            'currency_id' => 1,
            'order_total' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
            'date' => now(),
            'delivery_date' => now()->addDays(5),
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'sku' => $item['sku'] ?? null,
                'product' => $item['name'],
                'image' => $item['image'] ?? null,
                'qty' => $item['quantity'],
                'price' => $item['price'],
                'tax_rate' => 0,
                'tax' => 0,
                'currency_id' => 1,
                'seller_id' => 1,
                'delivery_date' => now()->addDays(5),
            ]);
        }

        // Enviar correo
        Mail::to($validated['email'])->send(new OrderPlaced($order, $cart, $validated));
        Mail::to('admin@suriaenergy.com')->send(new OrderPlaced($order, $cart, $validated, true));

        // Limpiar carrito y guardar orden temporalmente
        Session::forget('cart');
        Session::put('order', $order);

        // Disparar evento para redirigir
        $this->dispatch('checkout-success');
    }

    public function render()
    {
        return view('livewire.checkout-form');
    }
}
