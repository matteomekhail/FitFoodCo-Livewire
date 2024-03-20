<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class Orders extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::with(['user', 'orderProducts.product'])->get();
    }

    public function render()
    {
        return view('livewire.orders', [
            'orders' => $this->orders,
        ]);
    }
}
