<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\Order;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Configurare Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Verificare l'evento del webhook
        $event = Webhook::constructEvent(
            $request->getContent(),
            $request->header('Stripe-Signature'),
            env('STRIPE_WEBHOOK_SECRET')
        );

        // Gestire l'evento
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                // Creare un nuovo ordine nel database
                $order = new Order();
                $order->user_id = auth()->id(); // Assicurati di avere un metodo per ottenere l'ID dell'utente
                $order->stripe_session_id = $session->id;
                $order->total = $session->amount_total / 100; // Stripe restituisce l'importo in centesimi
                $order->save();

                break;
            // Aggiungere altri casi per gestire altri tipi di eventi
        }

        return response()->json(['received' => true]);
    }
}
