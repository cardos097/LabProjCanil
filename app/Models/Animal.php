<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Comment;
use App\Models\Adoption;

/**
 * Animal
 *
 * Represents an animal available in the shelter (profile, photos, status).
 */
class Animal extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'species',
        'breed',
        'age',
        'gender',
        'description',
        'photo',
        'status',
        'adopted_by',
        'adopted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'adopted_at' => 'datetime',
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
    public function adoptedBy(){
        return $this->belongsTo(User::class, 'adopted_by');
    }
}
