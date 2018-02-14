<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disponibilites extends Model
{
	protected $fillable = ['coiffeur_id','jourSemaine', 'heureDebut','heureFin'];
}
