<section class="py-8 lg:pt-72 lg:pb-20" id="home">
    <div class="container">
        @foreach ($orders as $order)
            <div class="card mb-4 shadow-sm">
                <div class="card-header text-2xl py-3 text-black"
                    style="background-image: linear-gradient(to bottom, #FACB01 0%, #FAD961 100%);">
                    <h4 class="my-0 fw-normal text-center">Order #{{ $order->id }}</h4>
                </div>
                <div class="card-body">
                    @if ($order->user)
                        <h5 class="card-title"><strong>Customer Name:</strong> {{ $order->user->first_name }}
                            {{ $order->user->last_name }}</h5>
                    @else
                        <h5 class="card-title"><strong>Customer Name:</strong> Information not available</h5>
                    @endif
                    <p class="card-text"><strong>Order Date:</strong> {{ $order->created_at->toFormattedDateString() }}
                    </p>
                    @if ($order->address)
                        <p class="card-text"><strong>Address:</strong> {{ $order->address->street }}, {{ $order->address->city }}, {{ $order->address->state }}, {{ $order->address->zip }}</p>
                    @else
                        <p class="card-text"><strong>Address:</strong> Not available</p>
                    @endif
                    <p class="card-text"><strong>Products:</strong></p>
                    <div class="flex flex-wrap space-x-4">
                        @foreach ($order->orderProducts as $orderProduct)
                            <div class="card m-2" style="width: 18rem;">
                                <img src="{{ $orderProduct->product->image }}" class="card-img-top"
                                    alt="{{ $orderProduct->product->name }}">
                                <div class="card-body flex flex-col">
                                    <h5 class="card-title mb-auto">{{ $orderProduct->product->name }}</h5>
                                    <p class="card-text">Quantity: {{ $orderProduct->quantity }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
