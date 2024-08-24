<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Wilaya;
use App\Stock;
use App\Categorie;
use Carbon\Carbon;
use App\Produit;
use App\Fournisseur;
use Hash;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\StoreProduit;
use App\Operateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class OperateurController extends Controller
{


    public function index()
    {
        $operateurs = Operateur::all();
        return view('operateurs.index',compact('operateurs'));
    }

    public function create()
    {
        return view('operateurs.create');
    }

    
    public function store(Request $request)
    {
        $operateur = new Operateur();   
        $operateur->nom =$request['nom'];
        $operateur->email =$request['email'];
        $operateur->password_text =$request['password'];
        $operateur->password =Hash::make($request['password']);
        $operateur->role =$request['role'];
        $operateur->type =$request['type'];
        $operateur->save();
        return redirect()->route('operateur.index')->with('success', ' inséré avec succés ');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produit  $operateur
     * @return \Illuminate\Http\Response
     */
    public function show($id_operateur)
    {
        $operateur = Operateur::find($id_operateur);

        return view('operateurs.view',compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $operateur
     * @return \Illuminate\Http\Response
     */
    public function edit($id_operateur)
    {
        $communes = Commune::all();
        $wilayas =Wilaya::all();
        $operateur = Operateur::find($id_operateur);
        $categories = Categorie::all();
        return view('operateurs.edit',compact('operateur','communes','wilayas','client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $operateur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$operateur_id)
    {
        $operateur = Operateur::find($operateur_id);  
        $operateur->nom =$request['nom'];
        $operateur->email =$request['email'];
        $operateur->password_text =$request['password'];
        $operateur->password =Hash::make($request['password']);
        $operateur->role =$request['role'];
        $operateur->type =$request['type'];
        $operateur->save();
        return redirect()->route('operateur.index')->with('success', 'modifié avec succés ');  
    }

    public function destroy($id_operateur)
    {
        $operateur = Operateur::find($id_operateur);
        $operateur->delete();
        return redirect()->route('operateur.index')->with('success', 'suppression effectué');        
    }

    public function stock($id_operateur)
    {
        $operateur = Operateur::find($id_operateur);
        $stocks = Stock::where('produit_id',$operateur->id)->orderBy('id','desc')->get();
        $operateurs = Operateur::all();
        $fournisseurs =Fournisseur::all();
        $communes = Commune::all();
        $wilayas =Wilaya::all();
        return view('stocks.index',compact('produits','stocks','produits','fournisseurs','communes','wilayas'));
    }


    public function printStock($id_operateur)
    {
        dd('on est entrain de construire cette page ...');
    }


}
