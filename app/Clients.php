<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = ['nom', 'prenom','adresseMail','motDePasse','telephone'];
}
