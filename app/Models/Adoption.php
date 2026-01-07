<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Adoption
 *
 * Represents an adoption request/record linking a user and an animal.
 */
class Adoption extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'animal_id',
        'user_id',
        'status',
        'adoption_date',
        'notes',
    ];

    public function user(){
        // User who requested or completed the adoption
        return $this->belongsTo(User::class);
    }
    public function animal(){
        // Adopted animal
        return $this->belongsTo(Animal::class);
    }
}
