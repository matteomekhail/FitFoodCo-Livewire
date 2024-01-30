<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Carts as Cart;
use App\Models\Product;
use Livewire\Volt\Compilers\Mount;

class SidebarCart extends Component
{
    public $isOpen = false;

    protected $listeners = ['toggleSidebar' => 'toggleCartSidebar'];
    public function toggleCartSidebar()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function checkout()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $total = collect($this->cartItems)->reduce(function ($carry, $item) {
            return $carry + $item->product->price * $item->quantity;
        }, 0);

        // Crea una sessione di checkout
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Carrello',
                        ],
                        'unit_amount' => $total * 100, // Stripe richiede l'importo in centesimi
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);
        return redirect($session->url);
    }

    public function render()
    {
        $cartItems = [];

        if (auth()->check()) {
            $userId = auth()->id();
            $cartItems = Cart::where('user_id', $userId)->get();
        } else {
            $guestCart = session()->get('guest_cart', []);
            foreach ($guestCart as $productId => $quantity) {
                $product = Product::find($productId);
                if ($product) {
                    $cartItems[] = (object) [
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'product' => $product,
                    ];
                }
            }
        }
        return view('livewire.sidebar-cart', ['cartItems' => $cartItems]);
    }
}
