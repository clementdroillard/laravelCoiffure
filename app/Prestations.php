<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestations extends Model
{
    protected $fillable = ['salon_id', 'libelle','prix','duree','validate'];
    protected $casts = ['validate' => 'boolean'];
}
