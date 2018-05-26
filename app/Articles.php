<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
     protected $fillable = ['salon_id','libelle','codeBarre','prix','stock'];
}
