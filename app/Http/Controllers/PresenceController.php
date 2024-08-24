<?php

namespace App\Http\Controllers;

use App\Presence;
use App\Membre;
use App\Inscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Auth;

class PresenceController extends Controller
{

    public function destroy($id_presence)
    {
        $presence = Presence::find($id_presence);
        $presence->delete();
        return redirect()->route('presence.index')->with('success', 'Présence Supprimé  ! ');        
    }


    public function filter2(Request $request)
    {
        $result = Presence::query();
        $date_fin="";
        $date_debut="";
        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
        }
    
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
        }

        $presences = $result->get();
        return view('presences.index',compact('presences',
            'date_debut',
            'date_fin'
        ));        
    }


    public function filter(Request $request,$membre)
    {
        $result = Presence::query();
        $date_fin="";
        $date_debut="";
        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
        }
    
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
        }

        $presences = $result->where('membre',$membre)->get();
        $membre = Membre::find($membre);
        return view('inscriptions.presences',compact('presences',
            'date_debut',
            'date_fin',
            'membre'
        ));        
    }

    public function index()
    {
        $presences = Presence::whereDate('created_at', Carbon::today())->get();
        return view('presences.index',compact('presences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $presence = new Presence();
        
        $presence->type = 1;
        $presence->prix = $request['prix'];        
        $presence->telephone = $request['telephone'];        
        $presence->nom_prenom = $request['nom_prenom'];        
        $presence->user=Auth::user()->id;
        
        $presence->save();
        return Redirect::back();       

    }

    public function entrer(Request $request)
    {
        // dd($request->membre);
        $presence = new Presence();        
        $presence->type = 1;
        $presence->membre = $request->membre;        
        $presence->inscription = $request->inscription;        
        $presence->created_at = date('Y-m-d H:i:s', strtotime($request->date_entrer));;        
        $presence->save();
        $membre = Membre::find($request->membre);
        $inscription = Inscription::where(['membre'=>$membre->id,'etat'=>1])->first();
        if($inscription->reste!=0){
            $inscription->reste = $inscription->reste - 1;
        }
        $inscription->save();

        return redirect()->route('membre.index')->with('success', 'success');        

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function show(Presence $presence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function edit(Presence $presence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presence $presence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presence  $presence
     * @return \Illuminate\Http\Response
     */

}
