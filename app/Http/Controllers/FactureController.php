<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Item;
use App\Produit;
use App\Operateur;
use Response;
use Dompdf\Dompdf;
use Redirect;
use App\Client;
use App\Facture;
use App\Template;
use Hash;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\StoreProduit;
use App\Analyse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class FactureController extends Controller
{


    public function index()
    {
        $factures = Facture::all();
        return view('factures.index',compact('factures'));
    }

    public function calculer(Request $request)
    {
        $total = 0;
        $tva=0;
        foreach ($request['data']['dynamic_form[dynamic_form'] as $array) {
            $sous_total = ($array['prix']*$array['quantite']);
            $total = $sous_total+$total;
        }    
        $tva = $total*0.19;
        $ttc = $total+$tva;
        return Response::json(['total'=>$total,'tva'=>$tva,'ttc'=>$ttc]);
    }

    public function create()
    {
        $produits = Produit::all();
        $clients = Client::all();
        $categories = Categorie::all();
        return view('factures.create',compact('produits','categories','clients'));
    }

    
    public function store(Request $request)
    {
        $facture = new Facture(); 
        $facture->client = $request['client'];
        $facture->date = $request['date'];
        $facture->numero = $request['numero'];
        $facture->numerobc = $request['numerobc'];
        $facture->convention = $request['convention'];
        $facture->type = $request['type'];
        $facture->total = 0;
        $facture->ttc = 0;
        
        try {
            $facture->save();
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with('error', $th->getMessage());        
        }
        $total =0;
        $sous_total = 0;
        foreach ($request['dynamic_form']['dynamic_form'] as $array) {
            $item = new Item();
            $sous_total = ($array['prix']*$array['quantite']);
            $total = $sous_total+$total;
            $item->designation = $array['designation'];
            $item->quantite = $array['quantite'];
            $item->prix = $array['prix'];
            $item->montant = $array['prix']*$array['quantite'];  
            $item->facture = $facture->id;          
            try {
                $item->save();
            } catch (\Throwable $th) {
                return Redirect::back()->withInput()->with('error', $th->getMessage());        
            }    
        } 

        /**
         * update khfife
         */
        if($request->type == 'timbre'){
            DB::table('factures')
            ->where('id',$facture->id)
            ->update(['total' => $total,'ttc'=>$total+5]);            
        }else{
            $tva = $total*0.19;
            $ttc = $total+$tva;    
            DB::table('factures')
            ->where('id',$facture->id)
            ->update(['total' => $total,'ttc'=>$ttc]);            
        }
        return redirect()->route('facture.index')->with('success', ' insertion efféctué ');        
    }

    public function print($id_analyse)
    {
        $facture = Facture::find($id_analyse);
        $dompdf = new Dompdf();
        $html = Template::Facture($facture);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
        return view('factures.view',compact('produit'));
    }

    public function edit($id_analyse)
    {
        $produits = Produit::all();
        $clients = Client::all();
        $categories = Categorie::all();
        $facture = Facture::find($id_analyse);  
        $items = Item::where('facture',$facture->id)->get();
        return view('factures.edit',compact('items','facture','produits','categories','clients'));
    }

    public function update(Request $request,$facture_id)
    {
        dd('fonction en developement');
    }

    public function destroy($id_analyse)
    {
        $facture = Facture::find($id_analyse);
        Item::where('facture',$id_analyse)->delete();
        $facture->delete();
        return redirect()->route('facture.index')->with('success', 'supprission terminé');        
    }




}
