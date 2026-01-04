<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;

class DonationController extends Controller
{
    public function form()
    {
        return view('donations.form');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'amount_eur' => ['required', 'numeric', 'min:1'],
        ]);

        $amount = (int) round($request->amount_eur * 100);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = CheckoutSession::create([
            'mode' => 'payment',
            'success_url' => 'http://127.0.0.1:8000/doar/sucesso',
            'cancel_url'  => 'http://127.0.0.1:8000/doar/cancelado',
            'line_items' => [[
                'quantity' => 1,
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $amount,
                    'product_data' => ['name' => 'Doação ao Canil'],
                ],
            ]],
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        return view('donations.success');
    }

    public function cancel()
    {
        return view('donations.cancel');
    }
}

