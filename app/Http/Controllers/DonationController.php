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
            // Include the Checkout Session id so we can retrieve the PaymentIntent on success
            'success_url' => url('/doar/sucesso?session_id={CHECKOUT_SESSION_ID}'),
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

    public function success(Request $request)
    {
        // Show the success page. If it succeeded Stripe provides a session_id we try to get the
        // associated PaymentIntent id and pass it to the view so the user can download
        // the comprovativo (we avoid automatic redirects here so donors see the success message).
        $sessionId = $request->query('session_id');
        $paymentIntentId = null;

        if ($sessionId) {
            try {
                Stripe::setApiKey(config('services.stripe.secret'));
                // Expand the payment_intent to make sure we get its id when available
                $session = CheckoutSession::retrieve($sessionId, ['expand' => ['payment_intent']]);

                $paymentIntent = $session->payment_intent;
                $paymentIntentId = is_object($paymentIntent) ? $paymentIntent->id : $paymentIntent;
            } catch (\Exception $e) {
                logger()->error('Error retrieving Stripe session: ' . $e->getMessage());
            }
        }

        return view('donations.success', ['paymentIntentId' => $paymentIntentId]);
    }

    public function cancel()
    {
        return view('donations.cancel');
    }
}

