<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class MenuComponent extends Component
{
    public $products = []; // Assicurati di inizializzare questo con i tuoi prodotti

    public function mount()
    {
        // Carica i tuoi prodotti qui, ad esempio:
        $this->products = Product::all(); // O qualsiasi sia la tua logica per ottenere i prodotti
    }

    public function updateQuantity($productId, $change)
    {
        // Aggiorna la quantità del prodotto qui
        // Assicurati di aggiornare $this->products correttamente
    }

    public function render()
    {
        return view('livewire.menu-component');
    }
}
