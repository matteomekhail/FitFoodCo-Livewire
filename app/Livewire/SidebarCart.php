<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Carts as Cart;
use App\Models\Product;
use Livewire\Volt\Compilers\Mount;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class SidebarCart extends Component
{
    public $isOpen = false;

    protected $listeners = ['toggleSidebar' => 'toggleCartSidebar', 'updateQuantity' => 'refreshItem'];

    public function refreshItem()
    {
        if (auth()->check()) {
            $userId = auth()->id();
            $this->cartItems = Cart::where('user_id', $userId)->get();
        } else {
            $guestCart = session()->get('guest_cart', []);
            $this->cartItems = [];
            foreach ($guestCart as $productId => $quantity) {
                $product = Product::find($productId);
                if ($product) {
                    $this->cartItems[] = (object) [
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'product' => $product,
                    ];
                }
            }
        }
    }
    public function toggleCartSidebar()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function checkout()
    {
        // Configurare Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Creare un array per contenere le linee di prodotto
        $line_items = [];

        // Ottenere gli articoli nel carrello
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

        // Aggiungere ogni articolo nel carrello come una linea di prodotto
        foreach ($cartItems as $item) {
            $product = $item->product;

            $line_items[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100, // Stripe richiede l'importo in centesimi
                ],
                'quantity' => $item->quantity,
            ];
        }

        // Creare la sessione di checkout
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => url('/'),
            'cancel_url' => url('/'),
        ]);

        // Reindirizzare l'utente alla pagina di checkout
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
