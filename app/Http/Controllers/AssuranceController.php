<?php

namespace App\Http\Controllers;

use App\Assurance;
use Illuminate\Http\Request;
use Redirect;
use Auth;

use App\Puce;

class AssuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $assurance = new Assurance();
        $assurance->prix = $request['prix'];        
        // $assurance->telephone = $request['telephone'];        
        // $assurance->nom_prenom = $request['nom_prenom'];        
        $assurance->membre = $request['membre4'];        
        $assurance->user=Auth::user()->id;
        $assurance->save();
        
        return Redirect::back();       

    }

    public function show(Presence $presence)
    {
    }

    public function edit(Presence $presence)
    {
    }

    public function update(Request $request, Presence $presence)
    {
    }

    public function destroy($id_assurance)
    {
        $assurance = Assurance::find($id_assurance);
        $assurance->delete();
    }
}
