<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\MealSelection;


class Orders extends Component
{
    public $orders;

    public function mount()
    {
        $this->loadOrders();
    }

    public function setCooked($orderProductId)
    {
        $orderProduct = OrderProduct::find($orderProductId);
        $orderProduct->is_cooked = !$orderProduct->is_cooked;
        $orderProduct->save();

        $this->loadOrders(); // Ricarica gli ordini dopo la modifica
    }

    public function setDelivered($orderProductId)
    {
        $orderProduct = OrderProduct::find($orderProductId);
        $orderProduct->is_delivered = !$orderProduct->is_delivered;
        $orderProduct->save();

        $this->loadOrders(); // Ricarica gli ordini dopo la modifica
    }

    private function loadOrders()
    {
        $this->orders = Order::with(['user', 'orderProducts.product', 'address'])
            ->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.orders', [
            'orders' => $this->orders,
        ]);
    }
}

