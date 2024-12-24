<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Produit;
class Commande extends Model
{
    protected $table = 'commandes';
    protected $fillable  = ['montant','date_versement','inscription','membre','user','remise'];


    public function membre()
    {
        $membre = Membre::find($this->membre);
        return $membre;
    }
    public function user()
    {
        $user = User::find($this->user);
        return $user;
    }

    public function net()
    {
        $net = 0;
        $items = Item::where('commande',$this->id)->get();
        foreach ($items as $item) {
            $produit = Produit::find($item->produit);
            if(is_null($produit)){
                $net +=0;
            }else{
                $net = $net + $item->qte*($item->prix-$produit->prix_achat);                
            }

         } 

         return $net;
    }



    public function montant()
    {
        $net = 0;
        $items = Item::where('commande',$this->id)->get();
        
        foreach ($items as $item) {
             $produit = Produit::find($item->produit);
             if(is_null($produit)){
                 $net +=0;
             }else{
                 $net = $net + $item->qte*$item->prix;
             }


         } 

         return $net;
    }
}
