<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'inscription',
        'membre',
        'activity'
    ];

    public function  getMembre()
    {
        $membre = Membre::find($this->membre);
        return $membre;
    } 
}
