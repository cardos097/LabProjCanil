<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        $sessionData = [
            'mode' => 'payment',
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
        ];

        if (Auth::check()) {
            $sessionData['customer_email'] = Auth::user()->email;
        }

        $session = CheckoutSession::create($sessionData);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        logger('Donation success called with session_id: ' . $request->query('session_id'));
        // Show the success page. If it succeeded Stripe provides a session_id we try to get the
        // associated PaymentIntent id and pass it to the view so the user can download
        // the comprovativo (we avoid automatic redirects here so donors see the success message).
        $sessionId = $request->query('session_id');
        $paymentIntentId = null;
        $amount = null;

        if ($sessionId) {
            try {
                Stripe::setApiKey(config('services.stripe.secret'));
                // Expand the payment_intent to make sure we get its id when available
                $session = CheckoutSession::retrieve($sessionId, ['expand' => ['payment_intent']]);

                $paymentIntent = $session->payment_intent;
                $paymentIntentId = is_object($paymentIntent) ? $paymentIntent->id : $paymentIntent;
                $amount = $session->amount_total; // Use amount_total from session in cents

                if (!$amount) {
                    logger()->error('Session amount_total is null for session: ' . $sessionId);
                    return view('donations.success', ['paymentIntentId' => null]);
                }

                // Save donation to database
                $donation = \App\Models\Donation::create([
                    'user_id' => Auth::check() ? Auth::id() : null,
                    'amount' => $amount,
                    'currency' => $session->currency,
                    'status' => $session->payment_status,
                    'stripe_session_id' => $sessionId,
                ]);

                logger('Session data: ' . json_encode($session->toArray()));

                // Send receipt email
                $donorEmail = Auth::check() ? Auth::user()->email : ($session->customer_details->email ?? $session->customer_email ?? null);
                logger('Donor email: ' . $donorEmail);
                if ($donorEmail) {
                    try {
                        Mail::to($donorEmail)->send(new \App\Mail\DonationReceipt($donation));
                        logger('Receipt email sent to: ' . $donorEmail);
                    } catch (\Exception $e) {
                        logger('Error sending email: ' . $e->getMessage());
                    }
                } else {
                    logger('No donor email found for session: ' . $sessionId);
                }
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

