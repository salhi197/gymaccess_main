<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Produit;
use App\Setting;

use Carbon\Carbon;
use Hash;
use App\Reference;
use App\Categorie;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ReferenceController extends Controller
{


    public function index()
    {
        $references = Reference::all();
        return view('references.index',compact('references'));
    }

    /**
     * Show the form for creatingReference new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produits = Produit::all();
        $settings = Setting::all();
        
        return view('references.create',compact('settings','produits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reference = new Reference();   
        $reference->type = $request['type'];
        $reference->methode = $request['methode'];
        $reference->setting = $request['setting'];
        $reference->produit = $request['produit'];
        $reference->norme_m = $request['norme_m'];
        $reference->norme_mm = $request['norme_mm'];
        $reference->methode = $request['methode'];        
        $reference->save();
        return redirect()->route('reference.index')->with('success', 'Inséré avec succés ');        
    }

        public function show($id_reference)

    {
        $reference = Reference::find($id_reference);
        return view('references.view',compact('reference'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function edit($id_reference)
    {
        $produits = Produit::all();
        $settings = Setting::all();
        $reference = Reference::find($id_reference);
        return view('references.edit',compact('reference','settings','produits'));
    }

    public function update(Request $request,$reference_id)
    {
        $reference = Reference::find($reference_id);  
        $reference->type = $request['type'];
        $reference->methode = $request['methode'];
        $reference->setting = $request['setting'];
        $reference->produit = $request['produit'];
        $reference->norme_m = $request['norme_m'];
        $reference->norme_mm = $request['norme_mm'];
        $reference->methode = $request['methode'];        
        $reference->save();

        
        return redirect()->route('reference.index')->with('success', 'reservation inséré avec succés ');   
    }


    public function destroy($id_reference)
    {
        $reference = Reference::find($id_reference);
        $reference->delete();
        return redirect()->route('reference.index')->with('success', 'le Reference a été supprimé ');        
    }


}
