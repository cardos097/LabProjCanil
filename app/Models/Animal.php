<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\Adoption;

class Animal extends Model
{
    use HasFactory;

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
        return $this->hasMany(Comment::class);
    }
    public function adoptions(){
        return $this->hasMany(Adoption::class);
    }
    public function adoption(){
        return $this->hasOne(Adoption::class);
    }
}
