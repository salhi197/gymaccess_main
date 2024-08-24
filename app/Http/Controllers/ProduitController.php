<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Wilaya;
use App\Stock;
use App\Membre;
use App\Achat;
use Carbon\Carbon;
use App\Produit;
use App\Categorie;
use App\Http\Requests\StoreProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class ProduitController extends Controller
{

    public function index()
    {
        $produits = Produit::all();
        $categories = Categorie::all();
        return view('produits.index',compact('produits','categories'));
    }


    public function pos()
    {
        $produits = Produit::all();
        $membres = Membre::all();
        return view('produits.pos',compact('produits','membres'));
    }

    public function create()
    {
        return view('produits.create');
    }

    public function store(Request $request)
    {        

        $produit = new Produit();   
        $produit->nom= $request->get('nom');
        $produit->prix_achat = $request['prix_achat'];
        $produit->prix_vente = $request['prix_vente'];
        $produit->qte = $request['qte'];
        $produit->photo = "";
        if($request->file('photo')){
            try {
                $path = $request->file('photo')->store('/produits');                
            } catch (Exception $e) {
                return Redirect::back()->withInput()->with('error', 'Images Trés grande');                
            }
            $produit->photo = $path;


        }

        $produit->save();
        return redirect()->route('produit.index')->with('success', 'Produit inséré avec succés ');        
    }


    public function show($id_produit)
    {
        $produit = Produit::find($id_produit);

        return view('produits.view',compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit($id_produit)
    {
        $communes = Commune::all();
        $wilayas =Wilaya::all();
        $fournisseurs =Fournisseur::all();
        $produit = Produit::find($id_produit);
        return view('produits.edit',compact('fournisseurs','communes','wilayas','produit'));
    }


    public function update(Request $request, $produit)
    {   
        $produit = Produit::find($produit);
        $produit->nom= $request->get('nom2');
        $produit->prix_achat = $request['prix_achat2'];
        $produit->prix_vente = $request['prix_vente2'];
        $produit->qte = $request['qte2'];
        $produit->photo = "";


        if($request->file('photoedit')){
            try {
                $path = $request->file('photoedit')->store('/produits');                
            } catch (Exception $e) {
                return Redirect::back()->withInput()->with('error', 'Images Trés grande');                
            }
            $produit->photo = $path;


        }


        $produit->save();
        return redirect()->route('produit.index')->with('success', 'Produit modifé avec succés ');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_produit)
    {
        $produit = Produit::find($id_produit);
        $produit->delete();
        return redirect()->route('produit.index')->with('success', 'le Produit a été supprimé ');        
    }

    public function stock($id_produit)
    {
        $produit = Produit::find($id_produit);
        $stocks = Stock::where('produit_id',$produit->id)->orderBy('id','desc')->get();
        $produits = Produit::all();
        $fournisseurs =Fournisseur::all();
        $communes = Commune::all();
        $wilayas =Wilaya::all();
        return view('stocks.index',compact('produits','stocks','produits','fournisseurs','communes','wilayas'));
    }


    public function printStock($id_produit)
    {
        dd('on est entrain de construire cette page ...');
    }


}