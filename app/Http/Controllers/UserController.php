<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Hash;
use App\Commune;
use App\Http\Requests\StoreUser;
use App\Wilaya;

class UserController extends Controller
{

    public function coachs()
    {
        $users =User::where('grade',3)->get();
        return view('users.coachs',compact('users'));
    }


    public function index()
    {
        // user sginife commercial
        $users =User::all();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $communes = Commune::all();
        $wilayas = Wilaya::all();
        return view('users.create',compact('wilayas','communes'));
    }

    public function store(Request $request)
    {

        $user = User::where('email','=',$request->get('name'))->get();
        if($user->count()>0){
            return redirect()->route('user.index')->with('error', 'Email Deja Utilisé ');
        }


        $user = new User();
        $user->name = $request->get('name');
        $user->isadmin = $request->get('grade');
        $user->email = $request->get('name');
        $user->genre = $request->get('genre');

        $user->password = Hash::make($request->get('password'));
        $user->password_text = $request->get('password');
        $user->lang = "en";

        try {
            $user->save();
            
        } catch (Exception $e) {
            
        return redirect()->back()->with('error', 'saz');
        }
        return redirect()->route('user.index')->with('success', 'un nouveau commercial a été inséré avec succés ');
    }  

    public function storeCoach(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('name');
        $user->telephone = $request->get('telephone');
        // $user->activity = $request->get('activity');
        $user->grade = 3;
        $user->password = Hash::make($request->get('password'));
        $user->password_text = $request->get('password');
        try {
            $user->save();
            
        } catch (Exception $e) {
            dd('ezeze');
        }
        return redirect()->route('user.coachs')->with('success', 'un nouveau commercial a été inséré avec succés ');
    }  




    public function edit($id_user)
    {
        $communes = Commune::all();
        $wilayas = Wilaya::all();
        $user = User::find($id_user);
        return view('users.edit',compact('user','wilayas','communes'));
    }

    public function update(Request $request,$id_user)
    {
        $user = User::where('email','=',$request->get('name'))->where('id','<>',$id_user)->get();
        if($user->count()>0){
            return redirect()->route('user.index')->with('error', 'Email Deja Utilisé ');
        }

        $user = User::find($id_user);
        $user->name = $request->get('name');
        $user->isadmin = $request->get('grade');
        $user->genre = $request->get('genre');

        $user->email = $request->get('name');
        $user->password = Hash::make($request->get('password'));
        $user->password_text = $request->get('password');
        // $user->activity = $request->get('activity');

        $user->save();
        return redirect()->back()->with('success', ' ');

    }

    
    public function destroy($id_user)
    {
        $user = User::find($id_user);
        $user->delete();    
        return redirect()->route('user.index')->with('success', 'le  commercial a été supprimé ');
    }

}
