<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Carts as Cart;
use App\Models\Product;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class SidebarCart extends Component
{
    public $isOpen = false;
    protected $listeners = ['toggleSidebar' => 'toggleCartSidebar', 'updateQuantity' => 'refreshItem'];

    public function getCartItems()
    {
        if (auth()->check()) {
            $userId = auth()->id();
            return Cart::with('product')->where('user_id', $userId)->get();
        } else {
            $guestCart = session()->get('guest_cart', []);
            $cartItems = [];
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
            return $cartItems;
        }
    }
    public function refreshItem()
    {
        $this->cartItems = $this->getCartItems();
    }
    public function toggleCartSidebar()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function checkout()
    {
        if (!auth()->check()) {
            $this->dispatch('show-modal');
            return;
        }

        // Configurare Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        // Creare un array per contenere le linee di prodotto
        $line_items = [];

        // Ottenere gli articoli nel carrello
        $cartItems = $this->getCartItems();



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
            'allow_promotion_codes' => true,
        ]);
        return redirect()->away('https://checkout.stripe.com/pay/' . $session->id);

    }

    public function render()
    {
        $cartItems = $this->getCartItems();
        return view('livewire.sidebar-cart', ['cartItems' => $cartItems]);
    }
}
