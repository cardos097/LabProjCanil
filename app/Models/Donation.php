<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Donation
 *
 * Records a donation made through Stripe (basic fields + stripe session id).
 */
class Donation extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'amount',
        'currency',
        'status',
        'stripe_session_id',
    ];

}
