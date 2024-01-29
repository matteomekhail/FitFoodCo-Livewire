<section id="menu" class="py-5" style="background-color: #F5F5F5;">
    <div class="container mx-auto px-2 sm:px-0">
        <div class="mt-4 grid grid-cols-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-gradient-to-r from-[#262626] via-[#000000] to-[#262626] shadow-lg transform transition-all duration-500 ease-in-out hover:scale-105 rounded-xl">
                    <div class="w-full h-64 overflow-hidden relative rounded-tl-xl rounded-tr-xl">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }} image" class="w-full h-full object-cover absolute">
                    </div>
                    <div class="text-center text-white p-2">
                        <p class="capitalize my-1">
                            <strong>{{ $product['name'] }}</strong>
                        </p>
                        <span class="font-bold focus:ring-[#FAD961]">$ {{ $product['price'] }}</span>
                        <div class="mt-3">
                            <p><strong>Calories:</strong> {{ $product['calories'] }} CAL</p>
                            <p><strong>Protein:</strong> {{ $product['protein'] }} P</p>
                            <p><strong>Fats:</strong> {{ $product['fats'] }} F</p>
                            <p><strong>Carbs:</strong> {{ $product['carbs'] }} C</p>
                        </div>
                        <div class="mt-3 flex justify-center items-center focus:ring-[#FAD961]">
                            <button wire:click="updateQuantity({{ $product['id'] }}, -1)"
                                class="bg-[#FACB01] text-white hover:text-black focus:ring-[#FAD961] py-2 px-4 rounded-full shadow-lg transition-all duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 focus:outline-none">-</button>
                                <span class="mx-4 text-2xl font-bold text-white shadow-text">{{ $productQuantities[$product['id']] ?? 0 }}</span>
                                <button wire:click="updateQuantity({{ $product['id'] }}, 1)"
                                class="bg-[#FACB01] text-white hover:text-black focus:ring-[#FAD961] py-2 px-4 rounded-full shadow-lg transition-all duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 focus:outline-none">+</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
