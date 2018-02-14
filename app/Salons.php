<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salons extends Model
{
    protected $fillable = ['libelle', 'adresse','ville','CP','motDePasse','nomDeCompte'];
}
