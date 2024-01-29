<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class Menu extends Component
{
    public $products = []; // Assicurati di inizializzare questo con i tuoi prodotti
    public $productQuantities = [];

    public function mount()
    {
        $this->products = Product::all();
        foreach ($this->products as $product) {
            $this->productQuantities[$product->id] = 0;
        }
    }
    public function updateQuantity($productId, $change)
    {
        // Assicurati che l'utente sia autenticato
        if (!auth()->check()) {
            session()->flash('error', 'Devi essere loggato per modificare il carrello.');
            return;
        }

        // Trova o crea un carrello per l'utente
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        // Trova il prodotto nel carrello, se esiste
        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            // Aggiorna la quantità, assicurandosi che non vada sotto 1
            $cartItem->quantity = max($cartItem->quantity + $change, 1);
            $cartItem->save();
        } else {
            // Se il prodotto non è nel carrello, aggiungilo con la quantità 1
            if ($change > 0) {
                $cart->items()->create([
                    'product_id' => $productId,
                    'quantity' => 1
                ]);
            }
        }

        // Aggiorna la vista
        $this->emit('cartUpdated');
    }


    public function render()
    {
        return view('livewire.menu');
    }

}
