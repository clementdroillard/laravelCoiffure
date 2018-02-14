<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonClients extends Model
{
     protected $fillable = ['salon_id', 'client_id','code','validate'];
     protected $casts = ['validate' => 'boolean'];
}
