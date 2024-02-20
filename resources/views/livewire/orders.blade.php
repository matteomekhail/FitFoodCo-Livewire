<div>
    @foreach($orders as $order)
        <div>
            <p>Order ID: {{ $order->id }}</p>
            <p>Product ID: {{ $order->product_id }}</p>
            <p>Quantity: {{ $order->quantity }}</p>
            <!-- Aggiungi qui altri campi se necessario -->
        </div>
    @endforeach
</div>
