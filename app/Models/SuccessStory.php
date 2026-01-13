<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * SuccessStory
 *
 * Represents a published success story linked to an animal and a user.
 */
class SuccessStory extends Model
{
    use SoftDeletes;
    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'photo',
        'published',
        'animal_id',
    ];

    public function user()
    {
        // Author of the success story
        return $this->belongsTo(User::class);
    }

    public function animal()
    {
        // Related animal
        return $this->belongsTo(Animal::class);
    }
}
