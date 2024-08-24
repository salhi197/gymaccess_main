<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Wilaya;
use App\Stock;
use App\Categorie;
use Carbon\Carbon;
use App\Produit;
use App\Operateur;
use Dompdf\Dompdf;
use Redirect;
use App\Client;
use App\Template;
use Hash;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\StoreProduit;
use App\Crenau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class CrenauController extends Controller
{


    public function index()
    {
        $crenaux = Crenau::all();
        return view('crenaux.index',compact('crenaux'));
    }

    public function create()
    {
        $operateurs1 = Operateur::where('type',"1")->get();
        $operateurs2 = Operateur::where('type',"2")->get();
        $produits = Produit::all();
        $clients = Client::all();
        $categories = Categorie::all();

        
        return view('crenaux.create',compact('operateurs1','operateurs2','produits','categories','clients'));
    }

    
    public function store(Request $request)
    {

        $validated = $request->validate([
            'type'=>'required',
            'categorie'=>'required',
            'produit'=>'required',
            'marque'=>'required',
            'fabrication'=>'required',
            'peremption'=>'required',
            'prelevement'=>'required',
            'reception'=>'required',
            'Crenau'=>'required',
            'client'=>'required',
            'lot'=>'required',
            'valeur'=>'required',
            'contenance'=>'required'
        ]);    
        $Crenau = new Crenau();   
        $Crenau->type = $request['type'];
        $Crenau->categorie = $request['categorie'];
        $Crenau->produit = $request['produit'];
        $Crenau->marque = $request['marque'];
        $Crenau->fabrication = $request['fabrication'];
        $Crenau->peremption = $request['peremption'];
        $Crenau->prelevement = $request['prelevement'];
        $Crenau->reception = $request['reception'];
        $Crenau->Crenau = $request['Crenau'];
        $Crenau->operateur1 = $request['operateur1'];
        $Crenau->operateur2 = $request['operateur2'];
        $Crenau->client = $request['client'];
        $Crenau->lot = $request['lot'];
        $Crenau->valeur = $request['valeur'];
        $Crenau->contenance = $request['contenance'];
        try {
            $Crenau->save();
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with('error', $th->getMessage());        
        }
        return redirect()->route('Crenau.index')->with('success', ' insertion efféctué ');        
    }

    public function print($id_Crenau)
    {
        $Crenau = Crenau::find($id_Crenau);
        $dompdf = new Dompdf();
        $html = Template::Bulletin($Crenau);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        
        $dompdf->stream("bulletin.pdf", array("Attachment" => false));
        return view('crenaux.view',compact('produit'));
    }

    public function edit($id_Crenau)
    {

        $operateurs1 = Operateur::where('type',"1")->get();
        $operateurs2 = Operateur::where('type',"2")->get();
        $produits = Produit::all();
        $clients = Client::all();
        $categories = Categorie::all();
        $Crenau = Crenau::find($id_Crenau);
    
        return view('crenaux.edit',compact('Crenau','operateurs1','operateurs2','produits','categories','clients'));
    }

    public function update(Request $request,$Crenau_id)
    {
        $Crenau = Crenau::find($Crenau_id);  
        $Crenau->type = $request['type'];
        $Crenau->categorie = $request['categorie'];
        $Crenau->produit = $request['produit'];
        $Crenau->marque = $request['marque'];
        $Crenau->fabrication = $request['fabrication'];
        $Crenau->peremption = $request['peremption'];
        $Crenau->prelevement = $request['prelevement'];
        $Crenau->reception = $request['reception'];
        $Crenau->Crenau = $request['Crenau'];
        $Crenau->operateur1 = $request['operateur1'];
        $Crenau->operateur2 = $request['operateur2'];
        $Crenau->client = $request['client'];
        $Crenau->lot = $request['lot'];
        $Crenau->valeur = $request['valeur'];
        $Crenau->contenance = $request['contenance'];
        try {
            $Crenau->save();
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with('error', $th->getMessage());        
        }
        return redirect()->route('Crenau.index')->with('success', ' insertion efféctué ');        
 
    }

    public function destroy($id_Crenau)
    {
        $Crenau = Crenau::find($id_Crenau);
        $Crenau->delete();
        return redirect()->route('Crenau.index')->with('success', 'supprission terminé');        
    }




}
