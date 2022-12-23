<?php

namespace App\Services\Payment;


class StripeService {

	private $secret;
	private $public;

	public function __construct($secret, $public)
    {
    	$this->secret = $secret;
    	$this->public = $public;
    }

    public function paymentIntent($amount, $intentId='')
    {
    	// This is your test secret API key.
        \Stripe\Stripe::setApiKey($this->secret);
        $stripe = new \Stripe\StripeClient($this->secret);

        
        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            if(!empty($intentId))
            {
                $paymentIntent = $stripe->paymentIntents->update(
                  $intentId,
                  ['amount' => $amount*100]
                );

                $output = [
                    'clientSecret' => $paymentIntent->client_secret,
                ];

                echo json_encode($output);
            }
            else
            {

                // Create a PaymentIntent with amount and currency
                $paymentIntent = \Stripe\PaymentIntent::create([
                    'amount' => $amount*100,
                    'currency' => 'inr',
                    'automatic_payment_methods' => [
                        'enabled' => true,
                    ],
                ]);

                $output = [
                    'clientSecret' => $paymentIntent->client_secret,
                ];

                echo json_encode($output);
            }

            
        } catch (Error $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
        }
    }
}