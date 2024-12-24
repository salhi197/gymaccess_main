<?php

namespace App\Http\Controllers;

use App\Fournisseur;
use App\Commune;
use App\Categorie;
use App\Wilaya;
use App\Sub;
use Response;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
 
    public function index()
    {
        $categories = Categorie::all();
        return view('categories.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $categorie = new Categorie([
            'label' => $request['categorie'],
        ]);
        $categorie->save();    
        return redirect()->route('categorie.index')->with('success', 'inserted successfuly ! ');
    }
    public function destroy($categorie)
    {
        $categorie = Categorie::find($categorie);
        $categorie->delete();
        return redirect()->route('categorie.index')
            ->with('success', 'supprimé avec succé !');
    }
    /**
     * 
     */

     public function SousstoreAjax(Request $request)
     {
        if($request->ajax()){
            $array = $request['data'];        
            $data=  array();
            parse_str($array, $data);        
            $categorie = new Categorie([
                'label' => $data['label'],
                'categorie'=>$data['categorie']
            ]);
            $categorie->save();    
            $response = array(
                'categorie' => $data,
                'msg' => 'catégorie ajouté',
            );        
            return Response::json($response);  // <<<<<<<<< see this line    
        }
    }
    public function update(Request $request)
    {
        $categorie = Categorie::find($request['id_categorie']);
        $categorie->label = $request['categorie'];
        // $categorie->icon = $request['icon'];
        if($request->file('icon')){
            $file = $request->file('icon');// as $image){
                $icon = $file->store(
                    'categories/icon',
                    'public'
                );
                
                $categorie->icon = $icon;     
            }


        if($request->file('image')){
            $file = $request->file('image');
                $image = $file->store(
                    'categories/images',
                    'public'
                );
                $categorie->image = $image;     
        }
        $categorie->save();
        return redirect()->route('categorie.index')->with('success', 'edited  successfuly ! ');
   }
}
