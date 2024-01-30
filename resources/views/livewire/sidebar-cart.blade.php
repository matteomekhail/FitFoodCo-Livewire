<div class="{{ $isOpen ? 'fixed inset-0 z-50 transition-all duration-500 ease-in-out transform translate-x-0' : 'fixed inset-0 z-50 transition-all duration-500 ease-in-out transform translate-x-full' }}"
    wire:click="$set('isOpen', false)">
    <div class="fixed right-0 top-0 h-full w-full md:w-80 shadow-2xl p-4 z-50 flex flex-col overflow-auto"
        style="background-image: radial-gradient(at top left, #FACB01 0%, #FAD961 50%, #FACB01 100%);"a>
        <svg wire:click="$set('isOpen', false)" class="h-6 w-6 absolute top-4 right-4 cursor-pointer"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <h2 class="text-2xl text-black mb-4">Your Cart</h2>
        @if (count($cartItems) > 0)
            <div class="flex flex-col gap-4 flex-grow">
                @foreach ($cartItems as $item)
                    <div class="relative shadow-sm bg-[#fafafa] flex h-32 rounded-xl">
                        <img src="{{ $item->product->image }}" alt="Product image"
                            class="w-24 h-full object-cover rounded-l-xl">
                        <div class="pt-4 p-4 ml-4 flex-grow flex flex-col justify-between">
                            <div class="font-bold text-black text-sm">{{ $item->product->name }}</div>
                            <div class="flex justify-between">
                                <span class="text-lg text-black">{{ $item->product->price }}</span>
                                <span class="text-lg text-black">x{{ $item->quantity }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-gray-500 text-lg my-4 text-center flex justify-center items-center">
                <i class="fas fa-shopping-cart mr-2"></i>
                You have no items in your cart
            </div>
        @endif
        <div class="border-t border-black p-4">
            @if (count($cartItems) > 0)
                <div class="flex justify-between mb-4">
                    <span class="text-lg text-black font-bold">Total</span>
                    <span
                        class="text-lg text-black font-bold">${{ number_format(
                            collect($cartItems)->reduce(function ($carry, $item) {
                                return $carry + $item->product->price * $item->quantity;
                            }, 0),
                            2,
                        ) }}</span>
                </div>
                <button wire:click="checkout"
                    class="bg-white text-black w-full px-4 py-2 rounded-lg text-lg flex justify-center items-center transition-colors duration-200 ease-in-out hover:bg-black hover:text-[#FACB01]">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Checkout
                </button>
            @endif
        </div>
    </div>
</div>
