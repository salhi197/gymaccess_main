<?php



namespace App\Http\Controllers;

use App\Presence;
use App\Membre;
use App\Abonnement;
use App\Assurance;
use App\Decharge;
use App\Inscription;
use App\Versement;
use App\Ouverture;
use App\Commande;
use App\Puce;

use App\Item;
use DB;
use Carbon\Carbon;

use Storage;
use App\Setting;

use App\Entre;
use App\Sortie;
use App\Produit;
use App\User;
use Illuminate\Http\Request;
use Response;

class HomeController extends Controller
{

    public function index()
    {
        $presences = Presence::whereDate('created_at', Carbon::today())->get();
        $inscrit = Inscription::where('created_at', Carbon::today())->get();
        $inscrit = count($inscrit);
        $count_presences = count($presences);
        $inscriptions = Inscription::whereDate('created_at', Carbon::today())->get();

        $membres = Membre::whereDate('created_at', Carbon::today())->get();
        $ouvertures = Ouverture::whereDate('created_at', Carbon::today())->get()->count();
        $libres = Presence::where('type',1)->whereDate('created_at', Carbon::today())->where('membre',null)->get();
        $entres = Entre::whereDate('created_at', Carbon::today())->count();
        $sorties = Sortie::whereDate('created_at', Carbon::today())->count();
        // dd($entres,$sorties);
        $actuel = $entres-$sorties;
              
        return view('home',compact('presences','membres','inscrit','presences','count_presences','inscriptions','ouvertures','libres','actuel'));    
    }

    /**
     * RAPPORT LIBRES
     */
    public function libres()
    {
        $benefice = Presence::where('type',1)->sum('prix');
        $libres = Presence::where('membre',null)->get();
        $presences = Presence::all();
        return view('libres',compact('benefice','libres','presences'));
    }

    public function libresFilter(Request $request)
    {
        $date_debut= "";
        $date_fin= "";        
        $result = Presence::query();
        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
        }
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
        }

        $benefice = $result->get()->where('membre',null)->sum('prix');
        $libres = $result->get()->where('membre',null);

        // $presences = Presence::all();
        return view('libres',compact('benefice','libres','date_debut','date_fin'));
    }


    /**
     * RAPPORT ASSURACES
     */
    public function assurances()
    {
        $assurances = Assurance::all();
        $users = User::all();
        $_user = '';//User::where('isadmin',2)->get();

        $assurancesSolde = Assurance::sum('prix');
        return view('assurances',compact(
            'assurances',
            'assurancesSolde',
            'users',
            '_user'
        ));
    }



    public function puces()
    {
        $puces = Puce::all();
        $pucesSolde = Puce::sum('prix');
        $users = User::all();
        $_user = '';//User::where('isadmin',2)->get();

        return view('puces',compact(
            'puces',
            'users',
            '_user',
            'pucesSolde'
        ));
    }


    public function assurancesFilter(Request $request)
    {
        $date_debut= "";
        $date_fin= "";        
        $result = Assurance::query();
        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
        }
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
        }
        if (!empty($request['user'])) {
            $user=$request['user'];    
            $result = $result->where('user', '=', $request['user']);
        }

        $assurancesSolde = $result->get()->sum('prix');
        $assurances = $result->get();
        $users = User::all();
        $_user = $request['user'];
        return view('assurances',compact(
            'assurancesSolde',
            'users',
            '_user',
            'assurances',
            'date_debut',
            'date_fin'          
        ));
    }
    public function pucesFilter(Request $request)
    {
        $date_debut= "";
        $date_fin= "";        
        $result = puce::query();
        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
        }
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
        }
        if (!empty($request['user'])) {
            $user=$request['user'];    
            $result = $result->where('user', '=', $request['user']);
        }

        $pucesSolde = $result->get()->sum('prix');
        $puces = $result->get();
        $users = User::all();
        $_user = $request['user'];

        return view('puces',compact(
            'pucesSolde',
            'puces',
            'users',
            '_user',
            'date_debut',
            'date_fin'          
        ));
    }


    public function activities()
    {
        $benefice = Presence::where('type',1)->sum('prix');
        $libres = Presence::where('type',1)->get();
        $presences = Presence::all();
        
        return view('activities',compact('benefice','libres','presences'));
    }




    public function FilterActivities(Request $request)
    {

        $result = Presence::query();
        $date_fin="";
        $date_debut="";
        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '=', $request['date_debut']);
        }

        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
        }


        if (!empty($request['a'])) {
            $a=$request['a'];    
            $result = $result->where('activity', '=', $a);
        }
        $presences = $result->get();
        
        return view('activities',compact('benefice','libres','presences','date_debut'));
    }


    public function MonStats($user_id)
    {
        $presences = Presence::whereDate('created_at', Carbon::today())->get();

        $inscriptions = Inscription::where('user',$user_id)->get();//('created_at', Carbon::today())->get();
        $countInscriptions = count($inscriptions);

        $countDecharges = count(Decharge::where('user',$user_id)->get());
        $decharges = Decharge::where('user',$user_id)->get()->pluck('montant')->sum();

        $count_presences = count($presences);
        $inscriptions = Inscription::where('created_at', Carbon::today())->where('user',$user_id)->get();
        $membres = Membre::whereDate('created_at', Carbon::today())->get();
        $ouvertures = Ouverture::whereDate('created_at', Carbon::today())->get()->count();

        $libres = Presence::where('membre',null)->where('user',$user_id)->get();
        $beneficeLibres = Presence::where('membre',null)->where('user',$user_id)->sum('prix');
        $users = User::all();
        $_user = '';//User::where('isadmin',2)->get();
        $_type = '';//User::where('isadmin',2)->get();
            



        $benefice = Inscription::where('user',$user_id)->get()->sum('versement');
        
        $assurances = Assurance::where('user',$user_id)->get()->count();
        $assurancesSolde = Assurance::sum('prix');  


        $versements = Versement::where('user',$user_id)->get()->count();
        // dd($versements);
        $versementsSolde = Versement::sum('montant');

        $puces = Puce::where('user',$user_id)->get()->count();
        $pucesSolde = Puce::sum('prix');


        return view('monstats',compact(
            'assurances',
            'versements',
            'puces',
            '_user',
            '_type',
            'assurancesSolde',
            'versementsSolde',
            'pucesSolde',
            'beneficeLibres',
            'presences',
            'membres',
            'countDecharges',
            'users',
            'presences',
            'count_presences',
            'inscriptions',
            'ouvertures',
            'libres',
            'countInscriptions',
            'benefice',
            'decharges'
        ));    

    }

    public function stats()
    {
        $presences = Presence::whereDate('created_at', Carbon::today())->get();

        $inscriptions = Inscription::all();//('created_at', Carbon::today())->get();
        $countInscriptions = count($inscriptions);

        $countDecharges = count(Decharge::all());
        $decharges = Decharge::all()->pluck('montant')->sum();

        $count_presences = count($presences);
        $inscriptions = Inscription::where('created_at', Carbon::today())->get();
        $membres = Membre::whereDate('created_at', Carbon::today())->get();
        $ouvertures = Ouverture::whereDate('created_at', Carbon::today())->get()->count();

        $libres = Presence::where('membre',null)->get();
        $beneficeLibres = Presence::where('membre',null)->sum('prix');
        $users = User::all();
        $_user = '';//User::where('isadmin',2)->get();
        $_type = '';//User::where('isadmin',2)->get();
            



        $benefice = Inscription::all()->sum('total');
        
        $assurances = Assurance::get()->count();
        $assurancesSolde = Assurance::sum('prix');


        $versements = Versement::get()->count();
        // dd($versements);
        $versementsSolde = Versement::sum('montant');

        $puces = Puce::get()->count();
        $pucesSolde = Puce::sum('prix');


        return view('stats',compact(
            'assurances',
            'versements',
            'puces',
            '_user',
            '_type',
            'assurancesSolde',
            'versementsSolde',
            'pucesSolde',
            'beneficeLibres',
            'presences',
            'membres',
            'countDecharges',
            'users',
            'presences',
            'count_presences',
            'inscriptions',
            'ouvertures',
            'libres',
            'countInscriptions',
            'benefice',
            'decharges'
        ));    

    }

    public function statsFilter(Request $request)
    {
        
        $result = Inscription::query();
        $result2 = Presence::query();
        $result3 = Membre::query();
        $result4 = Assurance::query();
        $result9 = Versement::query();
        $result8 = Puce::query();
        $result5 = Decharge::query();

        $date_fin="";
        $date_debut="";

        if (!empty($request['date_debut'])) {
            $date_debut=$request['date_debut'];    
            $result = $result->whereDate('created_at', '>=', $request['date_debut']);
            $result2 = $result2->whereDate('created_at', '>=', $request['date_debut'])->where('membre',null);
            $result4 = $result4->whereDate('created_at', '>=', $request['date_debut']);
            $result9 = $result9->whereDate('created_at', '>=', $request['date_debut']);
            $result8 = $result8->whereDate('created_at', '>=', $request['date_debut']);
            $result5 = $result5->whereDate('date_decharge', '>=', $request['date_debut']);
            $result3 = $result3->whereDate('created_at', '>=', $request['date_debut']);//->where('assurance',1);
        }
        
        if (!empty($request['date_fin'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->whereDate('created_at', '<=', $request['date_fin']);
            $result4 = $result4->whereDate('created_at', '<=', $request['date_fin']);
            $result9 = $result9->whereDate('created_at', '<=', $request['date_fin']);
            $result8 = $result8->whereDate('created_at', '<=', $request['date_fin']);
            $result5 = $result5->whereDate('date_decharge', '<=', $request['date_fin']);
            $result2 = $result2->whereDate('created_at', '<=', $request['date_fin'])->where('membre',null);
            $result3 = $result3->whereDate('created_at', '<=', $request['date_fin']);//->where('assurance',1);
  
        }


        if (!empty($request['user'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->where('user', '=', $request['user']);
            $result4 = $result4->where('user', '=', $request['user']);
            $result8 = $result8->where('user', '=', $request['user']);
            $result9 = $result9->where('user', '=', $request['user']);//->where('assurance',1);
            $result2 = $result2->where('user', '=', $request['user'])->where('membre',null);
            $result5 = $result5->where('user', '=', $request['user']);


  
        }


        if (!empty($request['user'])) {
            $date_fin=$request['date_fin'];    
            $result = $result->where('user', '=', $request['user']);
            $result4 = $result4->where('user', '=', $request['user']);
            $result8 = $result8->where('user', '=', $request['user']);
            // $result3 = $result3->where('user', '=', $request['user']);//->where('assurance',1);
            $result2 = $result2->where('user', '=', $request['user'])->where('membre',null);
            $result5 = $result5->where('user', '=', $request['user']);  
        }

        $inscriptions = $result->get();
        $countInscriptions = count($inscriptions);
        $libres = $result2->get();
        $assurance = count($result3->get());

        $totalAssurance = $assurance*1000;

        $libres = $result2->get();//Presence::where('type',1)->get();
        $beneficeLibres = $result2->get()->sum('prix');
        $countLibre = count($libres);

        $benefice = $result->get()->sum('total');
        $nombreInscriptions = count($inscriptions);

        $assurancesSolde = $result4->get()->sum('prix');
        $assurances = count($result4->get());


        $versementsSolde = $result9->get()->sum('montant');
        $versements = count($result9->get());

        $pucesSolde = $result8->get()->sum('prix');
        $puces = count($result8->get());

        $countDecharges = count($result5->get());
        $decharges      = $result5->get()->sum('montant');


        $users = User::all();
        $_user = $request['user'];//User::where('isadmin',2)->get();
        $_type = $request['type'];//User::where('isadmin',2)->get();
        return view('stats',compact('inscriptions',
            'date_debut',
            'assurances',
            'versements',
            'puces',
            '_user',
            '_type',
            'users',
            'libres',
            'assurancesSolde',
            'versementsSolde',
            'pucesSolde',
            'date_fin',
            'beneficeLibres',
            'countDecharges',
            'decharges',
            'assurance',
            'countLibre',
            'totalAssurance',
            'benefice',
            'countInscriptions'
        ));

    }
    public function clear()
    {
        //Storage::put('records.txt', '');
        Entre::truncate();
        Sortie::truncate();

        return redirect()->route("setting.index")->with('success', 'success');                

    }



    public function format(Request $request)
    {

        Membre::truncate();
        Puce::truncate();
        Inscription::truncate();
        Ouverture::truncate();
        Presence::truncate();
        Produit::truncate();
        Commande::truncate();
        Item::truncate();
        
        Assurance::truncate();
        Decharge::truncate();
        Versement::truncate();
        Abonnement::where('id','<>',1)->delete();
        // Setting::truncate();
        return redirect()->route("home")->with('success', 'success');                

    }



    public function write(Request $request)
    {
        if($request->ajax()){
            Storage::put('logs.txt', '0');
            return response()->json(['error' => 0]);
        }
        
    }



    public function write2(Request $request)
    {
        if($request->ajax()){
            Storage::put('logs2.txt', '0');
            return response()->json(['error' => 0]);
        }
    }


    public function write3(Request $request)
    {
        if($request->ajax()){
            Storage::put('logs3.txt', '0');
            return response()->json(['error' => 0]);
        }
    }

    public function activity(Request $request)
    {
        $setting = Setting::where('titre','activity')->first();
        $setting->value = $request['dz'];
        $setting->save();
        return redirect()->back()->with('success', 'success');                
    }


    public function Monrapport($user_id)
    {
        $abonnements = Abonnement::all();        
        // $users = User::all();        
        $inscriptions = Inscription::where('user',$user)->get();        
        $benefice = Inscription::where('user',$user)->get()->sum('versement');
        $libres = Presence::where('type',1)->get();
        $assurance = Membre::where('assurance',1)->where()->get()->count();
        $assurance = $assurance*1000;  
        $_user = '';


        return view('rapport',compact('inscriptions','abonnements','benefice','libres','assurance','users','_user','users'));
    }


    public function rapport()
    {
        $abonnements = Abonnement::all();        
        $users = User::all();        
        $inscriptions = Inscription::all();        
        $benefice = Inscription::all()->sum('versement');
        $libres = Presence::where('type',1)->get();
        $assurance = Membre::where('assurance',1)->get()->count();
        $assurance = $assurance*1000;  
        $_user = '';


        return view('rapport',compact('inscriptions','abonnements','benefice','libres','assurance','users','_user','users'));
    }

    public function filter(Request $request)
    {
        $users = User::all();//where('isadmin',2)->get();        
        
        $abonnements = Abonnement::all();        
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

        if (!empty($request['user'])) {
            $_user=$request['user'];        
            $result = $result->where('user', '=', $request['user']);            
        } 


        if (!empty($request['abonnement'])) {
            $_abonnement  = $request['abonnement'];
            $result = $result->where('abonnement', '=', $request['abonnement']);            
        } 

        $inscriptions = $result->get();
        $libres = $result2->get();
        $benefice = $result->get()->sum('versement');
        $nombreInscriptions = count($inscriptions);
        $assurance = Membre::where('assurance',1)->get()->count();
        $assurance = $nombreInscriptions*1000;
        return view('rapport',compact('inscriptions',
        'abonnements',
            'date_debut',
            'assurance',
            '_abonnement',
            'libres',
            'date_fin',
            'benefice',
            '_user',
            'users',
            'nombreInscriptions',
            '_coach','_abonnement',
        ));

    }

    public function search(Request $request)
    {

        $wheres = "";
        $index = 0;
        $type = "";
        $debut_entre = "";
        $fin_entre ="";
        if($request['table']){
            $table = $request['table'];
            $categorie = $request['categorie'];
            
            if ($table == 'fournisseurs') {
                $sql ="select * from $table where id in (select fournisseur from categoriquements where categorie='$categorie')";
                $fournisseurs = DB::select(DB::raw($sql));        
                return view('providers',compact('fournisseurs'));                    
            }else{
                $sql ="select * from $table where categorie='$categorie'";
                $produits = DB::select(DB::raw($sql));        
                return view('providers',compact('produits'));    
            }
        }



    }



}

