<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OrderProduct;

class Orders extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = OrderProduct::all();
    }

    public function render()
    {
        return view('livewire.orders');
    }
}
