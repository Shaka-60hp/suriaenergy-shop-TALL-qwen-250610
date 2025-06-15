<!DOCTYPE html>
<html>

<head>
    <title>Tu pedido</title>
</head>

<body>
    <h2>{{ $isAdmin ? 'Nuevo Pedido Generado' : 'Tu Pedido Ha Sido Generado' }}</h2>

    <p><strong>ID de Orden:</strong> {{ $order->id }}</p>
    <p><strong>Fecha:</strong> {{ now() }}</p>

    <h3 class="mt-4">Detalles del pedido:</h3>
    <ul>
        @foreach ($cart as $item)
            <li>
                {{ $item['name'] }} - x{{ $item['quantity'] }} -
                ${{ number_format($item['price'] * $item['quantity'], 2) }}
            </li>
        @endforeach
    </ul>

    <p><strong>Total:</strong> ${{ number_format($order->order_total, 2) }}</p>

    <p><strong>Dirección de envío:</strong></p>
    <p>{{ $data['address'] }}, {{ $data['city'] }}, {{ $data['postal_code'] }}</p>

    <p>Gracias por tu compra.</p>
</body>

</html>
