<section class="py-8 lg:pt-72 lg:pb-20" id="home">
    <div class="container">
        @php
            $meals = [];
        @endphp
        @foreach ($orders as $order)
            @foreach ($order->orderProducts as $orderProduct)
                @if (
                    (request('filter') == 'cooked' && $orderProduct->is_cooked) ||
                        (request('filter') == 'uncooked' && !$orderProduct->is_cooked) ||
                        (request('filter') == 'delivered' && $orderProduct->is_delivered) ||
                        (request('filter') == 'undelivered' && !$orderProduct->is_delivered) ||
                        !request('filter'))
                    @php
                        if (request('filter') == 'uncooked' && !$orderProduct->is_cooked) {
                            if (isset($meals[$orderProduct->product->name])) {
                                $meals[$orderProduct->product->name] += $orderProduct->quantity;
                            } else {
                                $meals[$orderProduct->product->name] = $orderProduct->quantity;
                            }
                        }
                    @endphp
                @endif
            @endforeach
        @endforeach
        @php
            $totalMeals = array_sum($meals);
        @endphp

        @if (request('filter') == 'uncooked' && count($meals) > 0)
            <div class=" bg-white rounded-lg shadow-lg p-6 border border-gray-200 mb-20">
                <h4 class="text-2xl font-semibold mb-4 text-gray-700">Meals to Cook: {{ $totalMeals }}</h4>
                <ul class="list-disc pl-5">
                    @foreach ($meals as $meal => $quantity)
                        <li class="text-lg mb-2">
                            <span class="font-semibold text-gray-800">{{ $meal }}:</span>
                            <span class="text-gray-600">{{ $quantity }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        @foreach ($orders as $order)
            @php
                $displayOrder = false;
                foreach ($order->orderProducts as $orderProduct) {
                    if (
                        (request('filter') == 'cooked' && $orderProduct->is_cooked) ||
                        (request('filter') == 'uncooked' && !$orderProduct->is_cooked) ||
                        (request('filter') == 'delivered' && $orderProduct->is_delivered) ||
                        (request('filter') == 'undelivered' && !$orderProduct->is_delivered) ||
                        !request('filter')
                    ) {
                        $displayOrder = true;
                        break;
                    }
                }
            @endphp
            @if ($displayOrder)
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
                        <p class="card-text"><strong>Order Date:</strong>
                            {{ $order->created_at->toFormattedDateString() }}
                        </p>
                        @if ($order->address)
                            <p class="card-text"><strong>Address:</strong> {{ $order->address->street }},
                                {{ $order->address->city }}, {{ $order->address->state }}, {{ $order->address->zip }}
                            </p>
                        @else
                            <p class="card-text"><strong>Address:</strong> Not available</p>
                        @endif
                        <p class="card-text"><strong>Products:</strong></p>
                        <div class="flex flex-wrap space-x-4">
                            @foreach ($order->orderProducts as $orderProduct)
                                @if (
                                    (request('filter') == 'cooked' && $orderProduct->is_cooked) ||
                                        (request('filter') == 'uncooked' && !$orderProduct->is_cooked) ||
                                        (request('filter') == 'delivered' && $orderProduct->is_delivered) ||
                                        (request('filter') == 'undelivered' && !$orderProduct->is_delivered) ||
                                        !request('filter'))
                                    <div class="card m-2" style="width: 18rem;">
                                        <img src="../{{ $orderProduct->product->image }}" class="card-img-top"
                                            alt="{{ $orderProduct->product->name }}">
                                        <div class="card-body flex flex-col">
                                            <h5 class="card-title mb-auto">{{ $orderProduct->product->name }}</h5>
                                            <p class="card-text">Quantity: {{ $orderProduct->quantity }}</p>
                                            <div class="flex justify-between items-center mt-4">
                                                <button class="btn btn-sm btn-outline-secondary"
                                                    wire:click="setCooked({{ $orderProduct->id }})">
                                                    {{ $orderProduct->is_cooked ? 'Cooked' : 'Not Cooked' }}
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary"
                                                    wire:click="setDelivered({{ $orderProduct->id }})">
                                                    {{ $orderProduct->is_delivered ? 'Delivered' : 'Not Delivered' }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>
