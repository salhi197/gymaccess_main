<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crenau extends Model
{
    protected $fillable = [
        'jour',
        'type',
        'debut',
        'fin',
        'plage',
    ];

    
}
