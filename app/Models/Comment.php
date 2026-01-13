<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Comment
 *
 * User comments left for animals (optionally with a rating).
 */
class Comment extends Model
{
    use HasFactory, SoftDeletes;

    // Mass assignable fields
    protected $fillable = [
        'animal_id',
        'user_id',
        'content',
        'rating',
    ];

    public function user(){
        // Author of the comment
        return $this->belongsTo(User::class);
    }

    public function animal(){
        // Animal this comment belongs to
        return $this->belongsTo(Animal::class);
    }
}
