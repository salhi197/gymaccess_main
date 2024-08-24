<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Wilaya;
use App\Stock;
use App\Achat;
use Carbon\Carbon;
use App\Produit;
use App\Fournisseur;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\StoreProduit;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class ReservationController extends Controller
{


    public function index()
    {
        $reservations = Reservation::all();
        $state ="-1";
        $date_fin="";
        $date_debut="";
        return view('reservations.index',compact('reservations','state','date_debut','date_fin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $communes = Commune::all();
        $wilayas =Wilaya::all();
        $fournisseurs =Fournisseur::all();
        return view('reservations.create',compact('fournisseurs','communes','wilayas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        // $validated = $request->validated();
        $reservation = new Reservation();   
        $reservation->fullname = $request['fullname'];
        $reservation->phone = $request['phone'];
        $reservation->stade = $request['stade'];
        $reservation->prix = $request['prix'];
        $reservation->crenau = $request['crenau'];
        $reservation->date = $request['date'];
        $reservation->state = $request['state'];
        
        $reservation->save();
        return redirect()->route('callendar',['stade'=>$request['stade']])->with('success', 'reservation inséré avec succés ');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produit  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show($id_reservation)
    {
        $reservation = Reservation::find($id_reservation);

        return view('reservations.view',compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit($id_reservation)
    {
        $communes = Commune::all();
        $wilayas =Wilaya::all();
        $fournisseurs =Fournisseur::all();
        $reservation = Reservation::find($id_reservation);
        return view('reservations.edit',compact('fournisseurs','communes','wilayas','produit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$reservation_id)
    {
        $reservation = Reservation::find($reservation_id);

        $reservation->fullname = $request['_fullname'];
        $reservation->phone = $request['_phone'];
        $reservation->stade = $request['stade'];
        $reservation->prix = $request['_prix'];
        $reservation->crenau = $request['_crenau'];
        $reservation->date = $request['_eventdate'];
        $reservation->state = $request['_state'];
        $reservation->save();
        return redirect()->route('callendar',['stade'=>$request['stade']])->with('success', 'reservation modifié avec succés ');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_reservation)
    {
        $reservation = Reservation::find($id_reservation);
        $reservation->delete();
        return redirect()->route('reservation.index')->with('success', 'le Produit a été supprimé ');        
    }

    public function stock($id_reservation)
    {
        $reservation = Reservation::find($id_reservation);
        $stocks = Stock::where('produit_id',$reservation->id)->orderBy('id','desc')->get();
        $reservations = Reservation::all();
        $fournisseurs =Fournisseur::all();
        $communes = Commune::all();
        $wilayas =Wilaya::all();
        return view('stocks.index',compact('produits','stocks','produits','fournisseurs','communes','wilayas'));
    }


    public function printStock($id_reservation)
    {
        dd('on est entrain de construire cette page ...');
    }


}
