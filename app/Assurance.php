<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assurance extends Model
{
    public function membre()
    {
        $membre = Membre::find($this->membre);
        if(is_null($membre)){
            return "";
        }else{
            return $membre['nom'].' '.$membre['prenom'];
        }
    }
    public function agent()
    {
        $user = USer::find($this->user);
        return $user['name'] ?? '';

    }

}
