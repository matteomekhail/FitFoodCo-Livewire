<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Carts as Cart;

class Navbar extends Component
{
    public $cartItemCount;
    protected $listeners = ['cartUpdated' => 'updateCartItemCount'];

    public function updateCartItemCount()
    {
        if (auth()->check()) {
            // Utente autenticato: ottieni quantità dal database
            $userId = auth()->id();
            $cartItems = Cart::where('user_id', $userId)->get();
            $this->cartItemCount = $cartItems->sum('quantity');
        } else {
            // Utente guest: ottieni quantità dalla sessione
            $guestCart = session()->get('guest_cart', []);
            $this->cartItemCount = array_sum($guestCart);
        }
    }
    public function mount()
    {
        if (auth()->check()) {
            // Utente autenticato: ottieni quantità dal database
            $userId = auth()->id();
            $cartItems = Cart::where('user_id', $userId)->get();
            $this->cartItemCount = $cartItems->sum('quantity');
        } else {
            // Utente guest: ottieni quantità dalla sessione
            $guestCart = session()->get('guest_cart', []);
            $this->cartItemCount = array_sum($guestCart);
        }
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
