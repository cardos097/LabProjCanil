<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\Adoption;

/**
 * Animal
 *
 * Represents an animal available in the shelter (profile, photos, status).
 */
class Animal extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'name',
        'species',
        'breed',
        'age',
        'gender',
        'description',
        'photo',
        'status',
    ];

    public function comments(){
        // Comments left by users about this animal
        return $this->hasMany(Comment::class);
    }
    public function adoptions(){
        // Adoption requests/records for this animal
        return $this->hasMany(Adoption::class);
    }
    public function adoption(){
        // Current adoption (if exist)
        return $this->hasOne(Adoption::class);
    }
}
