<?php

namespace App;

use App\Http\Controllers\AbonnementController;
use Carbon\Carbon;
use App\Presence;
use Illuminate\Database\Eloquent\Model;
use DB;
class Membre extends Model
{
    protected $fillable = [
        'nom',
        'assurance',
        'prenom',
        'telephone',
        'adresse',
        'sexe',
        'naissance',
        'photo',
        'email',
        'matricule',
        'etat'
    ];


    public function assurance()
    {
        $assurance = Assurance::where('membre',$this->id)->orderBy('created_at','desc')->first();
        if(is_null($assurance)){
            return 'Expiré';
        }else{
            $createdat = Carbon::parse($assurance->created_at);
            $now = Carbon::now();        
            $diff = $createdat->diffInDays($now);
            if($diff<365){
                return 'Assurance Active';    
            }else{
                return 'Assurance Annuel Expirée';    
            }
        }
    }

    public function assuranceBoolean()
    {
        $assurance = Assurance::where('membre',$this->id)->orderBy('created_at','desc')->first();
        if(is_null($assurance)){
            return 0;
        }else{
            $createdat = Carbon::parse($assurance->created_at);
            $now = Carbon::now();        
            $diff = $createdat->diffInDays($now);
            if($diff<365){
                return 1; 
            }else{
                return 0;    
            }
        }
    }

    public function dejaEntre()
    {
        $membre = Membre::find($this->id);
        $entre = Entre::where('matricule',$membre->matricule)->first();
        if(!is_null($entre)){
            return 1;
        }else{
            return 0;
        }
    }

    public function getLastPresence()
    {
        $lastpresence = Presence::where('membre',$this->id)
            ->orderBy('id', 'desc')
            ->first();
            if(is_null($lastpresence)){
                return "";
            }else{
                return $lastpresence->created_at->format('Y-m-d') ?? '';
            }

    }

    public static function getActivity()
    {
    $hour = date('H');
    $planning = [];
    $dayName = date('w', strtotime('2019-11-14'));
        if($dayName == 6){
            // lundi
            $planning = [
                '12'=>'Fitness',
                '13'=>'Fitness',
                '18'=>'Strong& zumba',
                '19'=>'Strong& zumba',
            ];

        }
        if($dayName == 5){
            // dimanche
            $planning = [
                '10'=>'Cross fit',
                '11'=>'Cross fit',
                '14'=>'Circuit_training',
                '13'=>'Circuit_training',
                '18'=>'Body_sculpt',
                '19'=>'Body_sculpt',
            ];
        }
        if($dayName == 4){
    
            // samedi
            $planning = [
                '10'=>'Fitness_dance',
                '11'=>'Fitness_dance',
                '13'=>'Ventre plat',
                '14'=>'yoga',
                '18'=>'Box Musculation',
                '19'=>'Box Musculation',
                '19'=>'Box Musculation',
                '17'=>'Cross fit',
                '18'=>'Cross fit'
            ];
        }
        if($dayName == 3){
            // vendredi
            $planning = [
                '10'=>'Fitness_dance',
                '11'=>'Fitness_dance',
                '13'=>'Ventre plat',
                '14'=>'Ventre plat',
                '18'=>'Box Musculation',
                '19'=>'Box Musculation',
                '19'=>'Box Musculation',
                '17'=>'Cross fit',
                '18'=>'Cross fit'
            ];
        }
        if($dayName == 2){
            $planning = [
                '10'=>'Cross fit',
                '11'=>'Cross fit',
                '12'=>'Ventre-plat',
                '13'=>'Ventre-plat',
                '14'=>'Cardio',
                '18'=>'F_A_C',
                '19'=>'F_A_C',
            ];
        }
        if($dayName == 1){
            $planning = [
                '10'=>'Gym_douce',
                '11'=>'Gym_douce',
                '12'=>'Fitness',
                '13'=>'Fitness',
                '14'=>'Cardio',
                '18'=>'Zumba',
                '19'=>'Zumba',
            ];
        }
        if($dayName == 0){
            $planning = [
                '10'=>'Fitness_dance',
                '11'=>'Fitness_dance',
                '13'=>'Cardio',
                '14'=>'Cardio',
                '18'=>'Step',
                '19'=>'Step',
                '17'=>'Cross fit',
                '18'=>'Cross fit'
            ];
        }
        return $planning[$hour] ;
    }
    public function getInscriptions()
    {
        $inscriptions = Inscription::where('membre',$this->id)->get();
        return $inscriptions;
    }

    public function getAbonnement()
    {
        $inscription = Inscription::where(['membre'=>$this->id,'etat'=>1])->first();
        $a = $inscription['abonnement'] ?? 1; 
        $abonnement = Abonnement::find($a);
        return $abonnement;
    }

    public function hasInscription()
    {
        $inscription = Inscription::orderBy('id', 'DESC')->limit(1);
//        $inscription = Inscription::where(['membre'=>$this->id,'etat'=>1])->first();
        if ($inscription){
            return true;
        }
        return false;
    }

    public function getActiveInscription()
    {
        $inscription  = Inscription::where('membre',$this->id)->first();
        return $inscription;
    }
    public function HasActiveInscription()
    {
        $inscription  = Inscription::where(['membre'=>$this->id,'etat'=>1])->first();       
        if($inscription){
            return 1;
        }else{
            return 0;
        }

    }

    public function HasActivity($single)
    {
        $inscription = $this->getActiveInscription();
        $activities  = $inscription->activities;
        
        $res = 0;
        if($activities){
            $activities = json_decode($activities);
            foreach($activities as $activitie){
                if($activitie == $single){
                    $res = 1;
                }
            }
    
        }
        return $res;

    }


    public function isMorningAuthorised()
    {

    }

    public function isAuthorised()
    {
        $inscription  = Inscription::where(['membre'=>$this->id,'etat'=>1])->first();
        if ($inscription) {
            $fin = $inscription->fin;
            $debut = $inscription->debut;
            $reste = $inscription->reste;
            $current = date('Y-m-d');
            
            if($current>$fin or $reste==0 or $current<$debut){
                return 0;
            }else{
                if($inscription->abonnement==6){
                    $hour = date('H');
                    if($hour>12){
                        return 0;
                    }else{
                        return 1;
                    }
                }else{
                    return 1;
                }
            }
        }else{
            return 0;
        }
    }


    public function getLastInscription()
    {
        $inscription = Inscription::where('membre',$this->id)->orderBy('id', 'desc')->first();
        return $inscription;

    }
    
}
