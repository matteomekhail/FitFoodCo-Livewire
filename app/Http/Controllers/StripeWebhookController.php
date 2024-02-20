<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\Order;
use App\Models\Carts as Cart;
use App\Models\OrderProduct;

class StripeWebhookController extends Controller
{
    private $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->all();
        $event = $payload['type'];
        $data = $payload['data']['object'];

        if ($event === 'checkout.session.completed') {
            $this->handleCheckoutSessionCompleted($data);
        }

        return response()->json(['status' => 'success']);
    }

    protected function handleCheckoutSessionCompleted($session)
    {
        $order = new Order;
        $order->user_id = $session['client_reference_id'];
        $order->stripe_session_id = $session['id'];
        $order->total = $session['amount_total'];
        $order->save();

        $this->saveSessionLineItems($session['id'], $order->id);

        $this->clearCart($order->user_id);

    }

    protected function saveSessionLineItems($sessionId, $orderId)
    {
        $lineItems = $this->stripe->checkout->sessions->allLineItems($sessionId);

        foreach ($lineItems->autoPagingIterator() as $lineItem) {
            // Assumiamo che il nome del prodotto sia salvato nel campo 'description' dei line_items di Stripe.
            $productName = $lineItem->description;

            // Trova il product_id basato sul nome del prodotto.
            $product = \App\Models\Product::where('name', $productName)->first();

            if ($product) {
                $orderProduct = new OrderProduct;
                $orderProduct->order_id = $orderId;
                $orderProduct->product_id = $product->id;
                $orderProduct->quantity = $lineItem->quantity;
                $orderProduct->save();
            } else {
                // Gestisci il caso in cui il prodotto non viene trovato, ad esempio registrando un errore.
            }
        }
    }
    protected function clearCart($userId)
    {
        Cart::where('user_id', $userId)->delete();
    }
}
