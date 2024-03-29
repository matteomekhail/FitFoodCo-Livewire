<section id="menu" class="py-5" style="background: linear-gradient(to bottom, #000 0%, #000 75%, #FACB01 100%);"
    id="menu">
    <div class="container mx-auto px-2 sm:px-0">
        <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <style>
                .mobile-image {
                    display: none;
                    object-position: center;
                    /* Posizione di default */
                    /* Default scale */
                }

                /* Media query per dispositivi con larghezza fino a 640px */
                @media (max-width: 640px) {

                    /* Nascondi l'immagine per dispositivi più grandi */
                    .desktop-image {
                        display: none;
                    }

                    /* Mostra l'immagine "cropped" per dispositivi mobili */
                    .mobile-image {
                        display: block;
                    }
                }
            </style>
            @foreach ($products as $product)
                <div
                    class="bg-gradient-to-r from-gray-300 to-white transform transition-all duration-300 ease-in-out hover:scale-105 rounded-xl">
                    <div class="w-full h-64 overflow-hidden relative rounded-tl-xl rounded-tr-xl">
                        <!-- Immagine per dispositivi più grandi -->
                        <img src="{{ $product->image }}" alt="{{ $product->name }} image"
                            class="w-full h-full object-cover absolute product-image desktop-image" loading="lazy"
                            wire:click="showProduct({{ $product->id }})">
                        <!-- Immagine cropped per dispositivi mobili -->
                        <img src="{{ Str::replaceLast('.webp', 'cropped.webp', $product->image) }}"
                            alt="{{ $product->name }} image"
                            class="w-full h-full object-cover absolute product-image mobile-image" loading="lazy"
                            wire:click="showProduct({{ $product->id }})">
                    </div>
                    <div class="text-center text-black p-2">
                        <p class="capitalize my-1">
                            <strong>{{ $product->name }}</strong>
                        </p>
                        <span class="font-bold focus:ring-[#FAD961]">$ {{ $product->price }}</span>
                        <div class="mt-3">
                            <p><strong>Calories:</strong> {{ $product->calories }} CAL</p>
                            <p><strong>Protein:</strong> {{ $product->protein }} P</p>
                            <p><strong>Fats:</strong> {{ $product->fats }} F</p>
                            <p><strong>Carbs:</strong> {{ $product->carbs }} C</p>
                        </div>
                        <div class="mt-3 flex justify-center items-center focus:ring-[#FAD961]">
                            <button wire:click="updateQuantity({{ $product->id }}, -1)"
                                class="bg-[#FACB01] text-black hover:text-white focus:ring-[#FAD961] py-2 px-4 rounded-full shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110 focus:outline-none">-</button>
                            <span
                                class="mx-4 text-2xl font-bold text-black shadow-text">{{ $productQuantities[$product->id] ?? 0 }}</span>
                            <button wire:click="updateQuantity({{ $product->id }}, 1)"
                                class="bg-[#FACB01] text-black hover:text-white focus:ring-[#FAD961] py-2 px-4 rounded-full shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110 focus:outline-none">+</button>
                        </div>
                    </div>
                </div>
            @endforeach
@if ($open)
    <div class="fixed z-10 inset-0 overflow-y-auto flex items-end justify-center sm:items-center sm:justify-center sm:mb-5"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <!-- Contenuto del modale -->
        <div
            class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition ease-out duration-300 translate-y-2 sm:translate-y-0 sm:align-middle sm:max-w-lg sm:w-full p-6 relative bottom-0 sm:bottom-auto">
            <button type="button" class="absolute right-4 top-4 text-red-500"
                wire:click="$set('open', false)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="text-center">
                <h3 class="text-2xl leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                    {{ $selectedProduct->name }}
                </h3>
            </div>
            <div class="mt-5">
                <img src="{{ Str::replaceLast('.webp', 'cropped.webp', $selectedProduct->image) }}"
                    alt="{{ $selectedProduct->name }} image"
                    class="w-full h-full object-cover rounded-lg shadow-md">
            </div>
            <div class="mt-5 text-center">
                <p class="text-sm text-gray-500">
                    {{ $selectedProduct->description }}
                </p>
            </div>
        </div>
    </div>
@endif
        </div>
</section>
