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
use App\Activitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class ActivitieController extends Controller
{

    public function index()
    {
        $activities = Activitie::all();
        return view('activities.index',compact('activities'));
    }

    public function create()
    {        
        return view('activities.create');
    }
    
    public function store(Request $request)
    {
        $plage = array();
        $validated = $request->validate([
            'type'=>'required',
            'jour'=>'required'
        ]); 
           
        $crenau = new Crenau();   
        $crenau->type = $request['type'];
        $crenau->jour = $request['jour'];
        // foreach ($request['dynamic_form']['dynamic_form'] as $array) {
        //     array_push($plage,$array);
        // }
        // $plage = json_encode($plage);
        // $crenau->plage= $plage;
        $crenau->debut= $request['debut'];
        $crenau->fin= $request['fin'];

        try {
            $crenau->save();
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with('error', $th->getMessage());        
        }
        return redirect()->route('activitie.index')->with('success', ' insertion efféctué ');        
    }

    public function print($id_Crenau)
    {
        $crenau = Activitie::find($id_Crenau);
        $dompdf = new Dompdf();
        $html = Template::Bulletin($crenau);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        
        $dompdf->stream("bulletin.pdf", array("Attachment" => false));
        return view('activities.view',compact('produit'));
    }

    public function edit($id_Crenau)
    {
        $crenau = Activitie::find($id_Crenau);    
        return view('activities.edit',compact('crenau'));
    }

    public function update(Request $request,$crenau_id)
    {
        $crenau = Activitie::find($crenau_id);  
        $crenau->type = $request['type'];
        $crenau->categorie = $request['categorie'];
        $crenau->produit = $request['produit'];
        $crenau->marque = $request['marque'];
        $crenau->fabrication = $request['fabrication'];
        $crenau->peremption = $request['peremption'];
        $crenau->prelevement = $request['prelevement'];
        $crenau->reception = $request['reception'];
        $crenau->Crenau = $request['Crenau'];
        $crenau->operateur1 = $request['operateur1'];
        $crenau->operateur2 = $request['operateur2'];
        $crenau->client = $request['client'];
        $crenau->lot = $request['lot'];
        $crenau->valeur = $request['valeur'];
        $crenau->contenance = $request['contenance'];
        try {
            $crenau->save();
        } catch (\Throwable $th) {
            return Redirect::back()->withInput()->with('error', $th->getMessage());        
        }
        return redirect()->route('activitie.index')->with('success', ' insertion efféctué ');        
 
    }

    public function destroy($id_Crenau)
    {
        $crenau = Activitie::find($id_Crenau);
        $crenau->delete();
        return redirect()->route('activitie.index')->with('success', 'supprission terminé');        
    }




}
