<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activitie extends Model
{
    protected $fillable = [
        'nom',
        'prix',
        'debut',
        'fin',
        'plage',
    ];

    
}
