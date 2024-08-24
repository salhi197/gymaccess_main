<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{
    protected $table = 'versements';
    protected $fillable  = ['montant','date_versement','inscription','membre','user'];


    public function getMembre()
    {
        $membre = Membre::find($this->membre);
        return $membre;
    }
    public function getUser()
    {
        $user = User::find($this->user);
        return $user;
    }

    public function getAbonnement()
    {
        $inscription = Inscription::find($this->inscription);
        if(is_null($inscription)){
            return '';
        }
        $abonnement = Abonnement::find($inscription->abonnement);
        return $abonnement ?? '';
    }
}
