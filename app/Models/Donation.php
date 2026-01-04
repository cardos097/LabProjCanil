<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
  'user_id','amount','currency','status','stripe_session_id'
];

}
