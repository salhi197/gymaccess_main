<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Wilaya;
use App\Stock;
use App\Membre;
use App\Template;
use Carbon\Carbon;
use App\Produit;
use App\User;
use App\Commande;
use App\Item;
use App\Http\Requests\StoreProduit;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use DB;
use Response;
class CommandeController extends Controller
{
    public function print($commande_id)
    {
        $commande = Commande::find($commande_id);
        $dompdf = new Dompdf();
        $html = Template::bl($commande);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();   
        $dompdf->stream("bulletin.pdf", array("Attachment" => false));
    }
   public function filter(Request $request)
   {
        $date_fin="";
        $date_debut="";
        $_user = $request['user'];
        $users = User::all();//'isadmin',2)->get();

        $result = Commande::query();


        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
        }

        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
        }


        if (!empty($request['user'])) {
            $result = $result->where('user', '=', $request['user']);            
        }
        $commandes = $result->get();

        return view('commandes.index',compact('commandes',
            'date_debut',
            'date_fin',
            'users',
            '_user'
        ));


   }



    public function destroy($id_produit)
    {
        $commande = Commande::find($id_produit);
        $commande->delete();
        return redirect()->route('commande.index')->with('success', 'la commande a été supprimé ');        
    }


     public function store(Request $request)
    {       
        // dd($request['elements']);
        $net=0;
        $total=0;
        if($request->ajax()){
            $commande = new Commande();
            $commande->membre = $request['membre'];
            // $commande->montant = $request['total'];
            $commande->user =Auth::user()->id;//$request['membre'];
            $commande->remise =$request['remise'];//$request['membre'];
            
            $commande->save();
            $elements = json_decode($request['elements']);
            $produits = array();
            foreach ($elements as $elt) {
                if($elt->qte>0){
                    $item = new Item();
                    $item->produit = $elt->numero;
                    $item->qte = $elt->qte;
                    $item->prix = $elt->prix;
                    $item->commande = $commande->id;
                    $item->save();
                    ////////////////////////
                    $produit = Produit::find($elt->numero);
                    $produit->qte =  $produit->qte - $elt->qte;
                    $produit->save();
                    $net = $net + $item->qte*($produit->prix_vente-$produit->prix_achat);
                    $total = $total + $item->qte*$produit->prix_vente;
                }
            }    
            Commande::where('id',$commande->id)->update(['net'=>$net]);
            Commande::where('id',$commande->id)->update(['montant'=>$total]);
            $prs = Produit::all();
            foreach ($prs as $pr) {
                $produit = [    
                    "numero"=>$pr->id,"name"=>$pr->nom,"prix"=>$pr->prix_vente,"qte"=> 0,"max"=>$pr->qte
                ];
                array_push($produits,$produit);


            }
            return response()->json(['msg' => "Success","produits"=>$produits]);
        }

            



        return redirect()->route('pos')->with('success', 'commande inséré avec succés ! ');
    }

    public function index()
    {
        
        $commandes = Commande::all();
        $users = User::all();
        $_abonnement = "";
        $_user = "";
        return view('commandes.index',compact('commandes','_user','users'));
    }

}