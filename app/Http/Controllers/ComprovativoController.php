<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;  // Use o DomPDF
use Stripe\Stripe;
use Stripe\PaymentIntent;

class ComprovativoController extends Controller
{
    public function gerarComprovativo($paymentId)
    {
        try {
            // Use the Stripe secret from the config (keeps behavior consistent with other controllers)
            Stripe::setApiKey(config('services.stripe.secret'));

            $paymentIntent = PaymentIntent::retrieve($paymentId);

            // Dados do pagamento
                // Safely extract charge details: charges can be null or empty depending on timing/API
                $charge = null;
                if (isset($paymentIntent->charges) && isset($paymentIntent->charges->data) && count($paymentIntent->charges->data) > 0) {
                    $charge = $paymentIntent->charges->data[0];
                }

                // Prefer billing name from the charge, then receipt_email, otherwise show placeholder
                $nome = $charge->billing_details->name ?? $paymentIntent->receipt_email ?? 'Donor';

                // Amount: prefer the charge amount, otherwise fall back to amount_received or 0
                $amountCents = $charge->amount ?? $paymentIntent->amount_received ?? 0;
                $valor = $amountCents / 100;

                // Created timestamp fallback
                $created = $paymentIntent->created ?? time();
                $data = date('d/m/Y', $created);

            // Dados para o PDF
                $dataComprovativo = [
                    'nome' => $nome,
                    'valor' => $valor,
                    'data' => $data,
                    'paymentId' => $paymentIntent->id,
                ];

            // Gera o PDF com os dados de pagamento
            $pdf = PDF::loadView('comprovativo', $dataComprovativo);

            // Retorna o PDF para o download
            return $pdf->download('comprovativo_' . $paymentId . '.pdf');

        } catch (\Exception $e) {
            // Se algo der errado, exibe o erro
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}


