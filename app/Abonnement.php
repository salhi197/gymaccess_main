<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    protected $fillable = [
        'label',
        'activity',
        'tarif',
        'duree',
        'type',
        'nbrsemaine',
    ];


    public function total()
    {
        return Inscription::where('abonnement',$this->id)->where('etat',1)->get()->count();
    }
}
