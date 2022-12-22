<?php

namespace App\Services\Payment;

use Razorpay\Api\Api;


class RazorpayService {

	private $key;
	private $secret;

	public function __construct($key, $secret)
    {
    	$this->key = $key;
    	$this->secret = $secret;
    }

    public function createOrder($amount,$email,$payment_type)
    {

        $api = new Api($this->key, $this->secret);
        $order = $api->order->create([
            'receipt' => date('Ymd').rand(1000,9999), 
            'amount' => $amount*100, 
            'currency' => 'INR', 
            'notes'=> [
                'email'=> $email,
                'payment_type'=> ($payment_type?'One-Time':'EMI'),
            ]
        ]);
        return $order;
    }
}