<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rdvs extends Model
{
    protected $fillable = ['coiffeur_id', 'client_id','prestation_id','dateDebut','dateFin'];
}
