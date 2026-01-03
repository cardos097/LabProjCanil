<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'user_id',
        'availability',
        'skills',
        'notes',
    ];

    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }
}
