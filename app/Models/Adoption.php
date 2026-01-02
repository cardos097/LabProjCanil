<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    protected $fillable = [
        'animal_id',
        'user_id',
        'status',
        'adoption_date',
        'notes',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function animal(){
        return $this->belongsTo(Animal::class);
    }
}
