<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coiffeurs extends Model
{
    protected $fillable = ['salon_id', 'nom','prenom','specialite'];
}
