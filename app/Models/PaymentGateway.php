<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentGateway extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'user_id',
        'stripe_active',
        'stripe_secret',
        'stripe_public',
        'razorpay_active',
        'razorpay_key',
        'razorpay_secret'
    ];
}