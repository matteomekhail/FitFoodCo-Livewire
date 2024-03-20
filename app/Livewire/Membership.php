<?php

namespace App\Livewire;

use Livewire\Component;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class Membership extends Component
{
    public function render()
    {
        return view('livewire.membership');
    }

    public function checkout($plan)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $this->getPlanName($plan),
                    ],
                    'unit_amount' => $this->getPlanPrice($plan),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/success'), // Make sure this URL conforms to your routing and application logic needs
            'cancel_url' => Url('/'), // Assicurati di sostituire 'cancel' con il nome della tua route di cancellazione
        ]);

        return redirect($session->url, 303);
    }

    private function getPlanName($plan)
    {
        $plans = [
            'gourmet' => 'Gourmet Membership',
            'premium' => 'Premium Membership',
            'deluxe' => 'Deluxe Membership',
        ];

        return $plans[$plan] ?? 'Unknown Plan';
    }

    private function getPlanPrice($plan)
    {
        $prices = [
            'gourmet' => 5000, // Prezzo in centesimi, es: $50.00
            'premium' => 7500, // Prezzo in centesimi, es: $75.00
            'deluxe' => 10000, // Prezzo in centesimi, es: $100.00
        ];

        return $prices[$plan] ?? 0;
    }
}
