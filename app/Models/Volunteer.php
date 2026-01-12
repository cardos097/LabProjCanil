<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Volunteer
 *
 * Volunteer profile linked to a user, stores availability and skills.
 */
class Volunteer extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'availability',
        'skills',
        'notes',
        'status',
    ];

    public function user(){
        // Owner of this volunteer profile
        return $this->belongsTo(\App\Models\User::class);
    }
}
