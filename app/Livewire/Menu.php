<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Carts as Cart;
use Session;
use Image;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;


class Menu extends Component
{
    public $productQuantities = [];
    protected $listeners = ['updateQuantity' => 'updateQuantity'];


    public function mount()
    {
        if (auth()->check()) {
            // Utente autenticato: ottieni quantità dal database
            $userId = auth()->id();
            $cartItems = Cart::where('user_id', $userId)->get();

            foreach ($cartItems as $cartItem) {
                $this->productQuantities[$cartItem->product_id] = $cartItem->quantity;
            }
        } else {
            // Utente guest: ottieni quantità dalla sessione
            $guestCart = session()->get('guest_cart', []);

            foreach ($guestCart as $productId => $quantity) {
                $this->productQuantities[$productId] = $quantity;
            }
        }
    }
    public function updateQuantity($productId, $change)
    {
        if (auth()->check()) {
            $this->updateAuthenticatedUserCart($productId, $change);
            // Aggiorna la quantità per gli utenti autenticati
            $cartItem = Cart::where('user_id', auth()->id())->where('product_id', $productId)->first();
            $this->productQuantities[$productId] = $cartItem ? $cartItem->quantity : 0;
        } else {
            $this->updateGuestUserCart($productId, $change);
            // Aggiorna la quantità per gli utenti guest
            $guestCart = session()->get('guest_cart', []);
            $this->productQuantities[$productId] = $guestCart[$productId] ?? 0;
        }
        $this->dispatch('cartUpdated');
    }

    private function updateAuthenticatedUserCart($productId, $change)
    {
        $userId = auth()->id();
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity += $change;
            $cartItem->quantity > 0 ? $cartItem->save() : $cartItem->delete();
        } else if ($change > 0) {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }
    }

    private function updateGuestUserCart($productId, $change)
    {
        $guestCart = session()->get('guest_cart', []);
        $currentQuantity = $guestCart[$productId] ?? 0;
        $newQuantity = max($currentQuantity + $change, 0);

        if ($newQuantity > 0) {
            $guestCart[$productId] = $newQuantity;
        } else {
            unset($guestCart[$productId]);
        }

        session()->put('guest_cart', $guestCart);
    }

    public function render()
    {
        return view('livewire.menu', [
            // ...

            'products' => Cache::remember('products', 60, function () {
                return Product::paginate(12);
            }),
        ]);
    }

}
