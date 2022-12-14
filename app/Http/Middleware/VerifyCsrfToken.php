<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/customer/invoices/test/*',
        '/landing/*/stripe/payment-intent/*',
        '/landing/*/razorpay/success',
        '/invoices/payment/*/*/*/razorpay/success',
    ];
}
