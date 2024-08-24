<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presence;
use App\Abonnement;
use App\Inscription;
use App\Versement;
use App\Membre;
use Auth;
use Carbon\Carbon;
use App\User;

class InscriptionController extends Controller
{


    public function destroy($id_inscription)
    {
        $inscription = Inscription::find($id_inscription);
        // dd($inscription);
        $inscription->delete();
        return redirect()->route('inscription.index')->with('success', ' Inséré avec succés ');          

    }
    public function today()
    {
        $abonnements = Abonnement::all();        
        $inscriptions = Inscription::whereDate('created_at', Carbon::today())->get();        
        $coachs = User::all();
        $_abonnement = "";
        $_coach = "";
        return view('inscriptions.index',compact('inscriptions','abonnements','coachs',
            '_abonnement',
            '_coach'
        ));
    }



    public function getInscriptions(Request $request)
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
        $totalRecords = Inscription::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Inscription::select('count(*) as allcount')
                ->where('id', 'like', '%' .$searchValue . '%')
                ->orWhere('debut', 'like', '%' .$searchValue . '%')
                ->orWhere('fin', 'like', '%' .$searchValue . '%')
                ->orWhere('reste', 'like', '%' .$searchValue . '%')
                ->orWhere('nbsseance', 'like', '%' .$searchValue . '%')
                ->orWhere('membre', 'like', '%' .$searchValue . '%')
                ->orWhere('abonnement', 'like', '%' .$searchValue . '%')
                ->orWhere('etat', 'like', '%' .$searchValue . '%')
                ->orWhere('total', 'like', '%' .$searchValue . '%')
                ->orWhere('remise', 'like', '%' .$searchValue . '%')
                ->orWhere('nbrmois', 'like', '%' .$searchValue . '%')
                ->orWhere('versement', 'like', '%' .$searchValue . '%')
                ->count();
   

        $records = Inscription::orderBy($columnName,$columnSortOrder)
                ->where('id', 'like', '%' .$searchValue . '%')
                ->orWhere('debut', 'like', '%' .$searchValue . '%')
                ->orWhere('fin', 'like', '%' .$searchValue . '%')
                ->orWhere('reste', 'like', '%' .$searchValue . '%')
                ->orWhere('nbsseance', 'like', '%' .$searchValue . '%')
                ->orWhere('membre', 'like', '%' .$searchValue . '%')
                ->orWhere('abonnement', 'like', '%' .$searchValue . '%')
                ->orWhere('etat', 'like', '%' .$searchValue . '%')
                ->orWhere('total', 'like', '%' .$searchValue . '%')
                ->orWhere('remise', 'like', '%' .$searchValue . '%')
                ->orWhere('nbrmois', 'like', '%' .$searchValue . '%')
                ->orWhere('versement', 'like', '%' .$searchValue . '%')
            ->select('inscriptions.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();
   
        $data_arr = array();
        foreach($records as $record){
                $etat = "<span class='badge badge-info'>Active</span>";
            if ($record->etat==0) {
                $etat = "<span class='badge badge-info'>Non Active</span>";                
            }
            $membre = Membre::find($record->membre);
            if(is_null($membre)){
                $membre = "";
            }else{
                $membre = $membre['nom'].' '.$membre['prenom'];
            }

            $abonnement = Abonnement::find($record->abonnement);
            if(is_null($abonnement)){
                $abonnement = "";
            }else{
                $abonnement = $abonnement['label'];//.' '.$membre['prenom'];
            }

              $data_arr[] = array(
                "debut"=>$record->debut,
                "id"=>$record->id,
                "fin"=>$record->fin,
                "reste"=>$record->reste,
                "nbsseance"=>$record->nbsseance,
                "membre"=>$membre,
                "abonnement"=>$abonnement,
                "etat"=>$etat,
                "total"=>$record->total." DA",
                "remise"=>$record->remise." DA",
                "nbrmois"=>$record->nbrmois,
                "versement"=>$record->versement." DA"
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
        $users = User::all();        
        $abonnements = Abonnement::all();        
        $_abonnement = "";

        $_user = "";
        return view('inscriptions.index',compact('users',
            '_abonnement',
            'abonnements',
            '_user'
        ));
    }
    public function excel()
    {
        $abonnements = Abonnement::all();        
        $inscriptions = Inscription::all();        
        $coachs = User::all();
        $_abonnement = "";
        $_coach = "";
        return view('inscriptions.excel',compact('inscriptions','abonnements','coachs',
            '_abonnement',
            '_coach'
        ));
    }

    public function filter(Request $request)
    {
        $users = User::where('isadmin',2)->get();        

        $result = Inscription::query();
        $result2 = Presence::query();
        $result3 = Membre::query();
        $date_fin="";
        $date_debut="";
        $_user="";
        // $membres = Membre::whereYear('naissance', '<=', $yearmax)
        //                 ->whereYear('naissance', '=>', $yearmin)
        //                 ->get();

        $_abonnement= $request['abonnement'];
        $_coach= $request['coach'];

        if (!empty($request['agemin'])) {
            $yearmax = Date('Y')-$request['agemin'];//2014
            $resul3 = $resul3->whereYear('naissance', '<=', $request['date_debut']);
        }
        if (!empty($request['agemax'])) {
            $yearmin = Date('Y')-$request['agemax'];//2009
            $resul3 = $resul3->whereYear('naissance', '>=', $request['date_debut']);
        }


        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
            $result2 = $result2->whereDate('created_at', '>=', $request['date_debut']);
        }

        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
            $result2 = $result2->whereDate('created_at', '<=', $request['date_debut']);   
        }

        if (!empty($request['coach'])) {
            
            $result = $result->where('coach', '=', $request['coach']);            
        } 


        if (!empty($request['abonnement'])) {
            
            $result = $result->where('abonnement', '=', $request['abonnement']);            
        } 
        $abonnements = Abonnement::all();        
        $coachs = User::where('grade',3)->get();


        $inscriptions = $result->get();

        $libres = $result2->get();
        $benefice = $result->get()->sum('total');
        $nombreInscriptions = count($inscriptions);
        $assurance = Membre::where('assurance',1)->get()->count();
        $assurance = $nombreInscriptions*1000;
        
        return view('inscriptions.index',compact('inscriptions',
            'date_debut',
            'abonnements',
            'coachs',
            'assurance',
            'libres',
            'date_fin',
            'benefice',
            '_user',
            'users',
            'nombreInscriptions',
            '_coach','_abonnement',
        ));

    }


    public function filterExcel(Request $request)
    {
        $users = User::where('isadmin',2)->get();        
        $result = Inscription::query();
        $result2 = Presence::query();
        $date_fin="";
        $date_debut="";
        $_user="";

        $_abonnement= $request['abonnement'];
        $_coach= $request['coach'];


        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
            $result2 = $result2->whereDate('created_at', '>=', $request['date_debut']);
        }

        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
            $result2 = $result2->whereDate('created_at', '<=', $request['date_debut']);   
        }

        if (!empty($request['coach'])) {
            
            $result = $result->where('coach', '=', $request['coach']);            
        } 


        if (!empty($request['abonnement'])) {
            
            $result = $result->where('abonnement', '=', $request['abonnement']);            
        } 
        $abonnements = Abonnement::all();        
        $coachs = User::where('grade',3)->get();


        $inscriptions = $result->get();

        $libres = $result2->get();
        $benefice = $result->get()->sum('total');
        $nombreInscriptions = count($inscriptions);
        $assurance = Membre::where('assurance',1)->get()->count();
        $assurance = $nombreInscriptions*1000;
        return view('inscriptions.excel',compact('inscriptions',
            'date_debut',
            'abonnements',
            'coachs',
            'assurance',
            'libres',
            'date_fin',
            'benefice',
            '_user',
            'users',
            'nombreInscriptions',
            '_coach','_abonnement',
        ));

    }

    
    public function presence($inscription_id)
    {
        // $presences = Presence::where('inscription',$inscription_id)->get();
        $presences = Presence::where('inscription',$inscription_id)->get();
        $inscription = Inscription::find($inscription_id);
        $membre = Membre::find($inscription->membre);
        return view('inscriptions.presences',compact('presences','membre'));

    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'abonnement2'=>'required',
        ]);
        $membre = Membre::find($request->membre2);
        $inscription  = $membre->getLastInscription();
        $inscription->etat = 0;
        $inscription->save();


        $inscription = new Inscription();
        $inscription->debut=$request['debut2'];
        // $inscription->remarque=$request['remarque2'];
        $inscription->type=$request['type2'];
        //$inscription->activities=$request['activity2'];
        $fin =  Carbon::parse($request['debut2'])->addMonth($request['nbrmois2'])->format('Y-m-d');
        $inscription->fin=$fin;
        
        $inscription->nbsseance=$request['nbrmois2']*4*json_decode($request['abonnement2'])->nbrsemaine;
        $inscription->reste=$request['nbrmois2']*4*json_decode($request['abonnement2'])->nbrsemaine;
        
        $inscription->membre=$membre->id;
        $inscription->abonnement=json_decode($request['abonnement2'])->id;
        $inscription->tripode=json_decode($request['abonnement2'])->tripode;
        $inscription->etat=1;
        $inscription->total=$request['total2'];
        $inscription->remise=$request['remise2'];
        $inscription->nbrmois=$request['nbrmois2'];
        $inscription->versement=$request['versement2'];
        $inscription->user=Auth::user()->id;

        

        $inscription->save();
        $versement = new Versement([
            'montant' => $request['versement2'],
            'date_versement' => date('y-m-d'), 
            'inscription' => $inscription->id, 
            'membre' => $membre->id,
            'user' => Auth::user()->id
        ]);
        $versement->save(); 
        
        return redirect()->route('membre.index')->with('success', ' inséré avec succés ');          
    }

    public function expirer()
    {
        $inscriptions = Inscription::where('reste','>',0)->whereDate('fin','>=',Carbon::today())->get();
        $abonnements = Abonnement::all();        

        return view('inscriptions.index',compact('inscriptions','abonnements'));
    }

}
