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
use Response;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\StoreProduit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class StockController extends Controller
{


    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index',compact('stocks'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produits = Produit::all();        
        return view('stocks.create',compact('produits'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produit'=>'required',
            'fournisseur'=>'required',
            'prix'=>'required',
            'quantite'=>'required',
        ]);  
        $stock = new Stock();   
        $stock->produit = $request['produit'];
        $stock->fournisseur = $request['fournisseur'];
        $stock->prix = $request['prix'];
        $stock->quantite = $request['quantite'];
//        $stock->date_stock = $request['date_stock'];
        $stock->save();
        return redirect()->route('stock.index')->with('success', ' inséré avec succés ');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produit  $stock
     * @return \Illuminate\Http\Response
     */
    public function show($id_client)
    {
        $stock = Stock::find($id_client);

        return view('stocks.view',compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id_client)
    {
        $produits = Produit::all();        
        $stock = Stock::find($id_client);
        return view('stocks.edit',compact('produits','stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$client_id)
    {
        $stock = Stock::find($client_id);  
        $validated = $request->validate([
            'produit'=>'required',
            'fournisseur'=>'required',
            'prix'=>'required',
            'quantite'=>'required',
        ]);  
        $stock->produit = $request['produit'];
        $stock->fournisseur = $request['fournisseur'];
        $stock->prix = $request['prix'];
        $stock->quantite = $request['quantite'];
//        $stock->date_stock = $request['date_stock'];
        $stock->save();
        return redirect()->route('stock.index')->with('success', ' inséré avec succés ');        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_client)
    {
        $stock = Stock::find($id_client);
        $stock->delete();
        return redirect()->route('stock.index')->with('success', 'le Produit a été supprimé ');        
    }

    public function stock($id_client)
    {
        $stock = Stock::find($id_client);
        $stocks = Stock::where('produit_id',$stock->id)->orderBy('id','desc')->get();
        $stocks = Stock::all();
        $fournisseurs =Fournisseur::all();
        $communes = Commune::all();
        $wilayas =Wilaya::all();
        return view('stocks.index',compact('produits','stocks','produits','fournisseurs','communes','wilayas'));
    }


    public function printStock($id_client)
    {
        dd('on est entrain de construire cette page ...');
    }


}
