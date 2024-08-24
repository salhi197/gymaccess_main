<?php

namespace App\Http\Controllers;

use App\Fournisseur;
use App\Commune;
use App\Versement;
use App\Membre;
use App\Abonnement;

use App\Wilaya;
use App\Sub;
use App\inscription;
use App\Template;
use App\User;
use Response;
use Auth;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class VersementController extends Controller
{

    public function print($versement_id)
    {
        $versement = Versement::find($versement_id);
        $dompdf = new Dompdf();
        $html = Template::Bulletin($versement);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        
        $dompdf->stream("bulletin.pdf", array("Attachment" => false));
        // return view('crenaux.view',compact('produit'));
    }


    public function getVersements(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
   
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
   
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value
   
        // Total records
        $totalRecords = Versement::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Versement::select('count(*) as allcount')
                ->where('id', 'like', '%' .$searchValue . '%')
                ->orWhere('inscription', 'like', '%' .$searchValue . '%')
                ->orWhere('montant', 'like', '%' .$searchValue . '%')
                ->orWhere('user', 'like', '%' .$searchValue . '%')

                ->orWhere('membre', 'like', '%' .$searchValue . '%')
               ->orWhere('date_versement', 'like', '%' .$searchValue . '%')
                ->count();
   
        // Fetch records
        $records = Versement::orderBy($columnName,$columnSortOrder)
                ->where('id', 'like', '%' .$searchValue . '%')
                ->orWhere('inscription', 'like', '%' .$searchValue . '%')
                ->orWhere('montant', 'like', '%' .$searchValue . '%')
                ->orWhere('user', 'like', '%' .$searchValue . '%')
                ->orWhere('membre', 'like', '%' .$searchValue . '%')
               ->orWhere('date_versement', 'like', '%' .$searchValue . '%')
            ->select('versements.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();
   
        $data_arr = array();
        foreach($records as $record){
            $user = User::find($record->user);
            if(is_null($user)){
                $user = "";
            }else{
                $user = $user['email'];//.' '.$user['prenom'];
            }

            $membre = Membre::find($record->membre);
            if(is_null($membre)){
                $membre = "";
            }else{
                $membre = $membre['nom'].' '.$membre['prenom'];
            }

            $inscription = inscription::find($record->inscription);
            if(is_null($inscription)){
                $abonnement = "";
            }else{
                $abonnement = Abonnement::find($inscription->abonnement);
                if(is_null($abonnement)){
                    $abonnement = "";
                }else{
                    $abonnement = $abonnement['label'];//.' '.$membre['prenom'];
                }
            }

              $data_arr[] = array(
                "id"=>$record->id,
                "membre"=>$membre,
                "montant"=>$record->montant,
                "inscription"=>$abonnement,
                "user"=>$user,                   
                "date_versement"=>$record->date_versement
           );
        }
   
        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );
        echo json_encode($response);
        exit;
      }
 
    public function index()
    {
        $versements = Versement::all();
        $users = User::all();
        $_abonnement = "";
        $_user = "";
        // dd($users);
        return view('versements.index',compact('versements','_user','users'));
    }

    public function store(Request $request)
    {
        $versement = new Versement([
            'montant' => $request['montant'],
            'date_versement' => $request['date_versement'], 
            'inscription' => $request['inscription3'], 
            'membre' => $request['membre3'],
            'user' => Auth::user()->id
        ]);
        $versement->save();    
        $inscription = inscription::find($request['inscription3']);
        $inscription->versement = $inscription->versement+$request['montant']; 
        $inscription->save();
        return redirect()->back()->with('success', 'inserted successfuly ! ');
    }
    public function destroy($id_ver)
    {
        $versement = Versement::find($id_ver);
        $versement->delete();
        return redirect()->route('versement.index')
            ->with('success', 'Element supprimé  !');
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



   public function filter(Request $request)
   {
        $date_fin="";
        $date_debut="";
        $_user = $request['user'];
        $users = User::all();

        $result = Versement::query();


        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('date_versement', '>=', $request['date_debut']);
        }

        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('date_versement', '<=', $request['date_fin']);
        }


        if (!empty($request['user'])) {
            $result = $result->where('user', '=', $request['user']);            
        }
        $versements = $result->get();

        return view('versements.filter',compact('versements',
            'date_debut',
            'date_fin',
            'users',
            '_user'
        ));


   }
}
