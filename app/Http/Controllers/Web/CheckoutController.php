<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;

class CheckoutController extends Controller
{
    public function index()
    {
        // Opcional: Guardar URL intencionada manualmente
        session(['url.intended' => url()->current()]);

        return view('web.checkout.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        // Obtener carrito desde sesión
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->withErrors(['error' => 'Tu carrito está vacío.']);
        }

        // Crear orden
        $order = Order::create([
            'contact_id' => auth()->id(), // null si no está logueado
            'seller_id' => 1,
            'order_type' => 0,
            'currency_id' => 1,
            'order_total' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
            'date' => now(),
            'delivery_date' => now()->addDays(5),
        ]);

        // Guardar ítems del pedido
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

        // Enviar correo solo si existe email válido
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Mail::to($request->email)->send(new OrderPlaced($order, $cart, $request->all()));
            Mail::to('admin@suriaenergy.com')->send(new OrderPlaced($order, $cart, $request->all(), true));
        }

        // Limpiar carrito
        session()->forget('cart');

        // Guardar orden temporalmente para mostrar éxito
        session(['order' => $order]);

        // Redirigir con orden en sesión
        return redirect()->route('checkout.success')->with('order', $order);
    }
}
