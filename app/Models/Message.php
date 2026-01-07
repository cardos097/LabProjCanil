<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Message
 *
 * Contact messages sent by users (stored for admin review).
 */
class Message extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'email',
        'name',
    ];

    public function user()
    {
        // Sender (optional, if the message was created by a logged-in user)
        return $this->belongsTo(User::class);
    }
}
