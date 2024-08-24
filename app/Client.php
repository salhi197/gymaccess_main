<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        "categorie",
        "raison_sociale",
        "nom",
        "adresse",
        "wilaya",
        "telephone",
        "fax",
        "n_registre",
        "nif",
        "etat",
        "nis",
        "n_article",
        "email",
        "type",//bis wkda ak chyf 
        'password_text'
    ];
    public function getCategorie()
    {
        return Categorie::where('id',$this->categorie)->first();
    }

    public function create(Request $request)
    {

    } 

}
