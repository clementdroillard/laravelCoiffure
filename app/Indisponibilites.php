<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indisponibilites extends Model
{
    protected $fillable = ['coiffeur_id', 'dateDebut','dateFin'];
}
