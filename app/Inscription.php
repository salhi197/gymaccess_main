<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = [
        'debut',
        'fin',
        'reste',
        'nbrseance',
        'membre',
        'activities',
        'remarque',
        'abonnement',
        'assurance',
        'etat',
        'active',
        'type',
        'total',
        'remise',
        'nbrmois',
        'versement'
    ];

    public function agent()
    {
        $user = USer::find($this->user);
        return $user['name'] ?? '';

    }

    public function getAbonnement()
    {
        return Abonnement::find($this->abonnement)['label'] ?? 'Error';
    }

    public function isActive()
    {
        
    }
    public function getMembre()
    {
        return Membre::find($this->membre);
    }

}
