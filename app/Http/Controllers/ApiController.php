<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Membre;
use App\Inscription;
use App\Setting;
use App\Ouverture;
use App\Presence;
use App\Entre;
use App\Sortie;

use Storage;
class ApiController extends Controller
{

    public function script1($rfid)
    {
        if($rfid==70000){
            $ouverture = new Ouverture();
            try {
                $ouverture->save();
            } catch (\Throwable $th) {
                return response()->json(['reponse' => $th->getMessage()]);
            }
            return response()->json(['reponse' => 1]);    
        }

        $membre=Membre::where('matricule',$rfid)->first();
        if($membre){
            $inscription  = Inscription::where('membre',$membre->id)->first();
            $entre = Entre::where('matricule',$rfid)->first();
            // dd($entre);
            
            if(is_null($entre)){

                $reponse = $membre->isAuthorised();
                
                if($reponse==1){
                    $inscription  = Inscription::where(['membre'=>$membre->id,'etat'=>1])->first();
                    $tripode = $inscription->tripode;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://192.168.0.177/open");
                    $presence = new Presence();
                    $presence->inscription = $inscription->id;
                    $presence->membre = $membre->id;
                    // $presence->activity = $setting->value;
                    //Membre::getActivity();
                    try {
                        $presence->save();
                    } catch (\Throwable $th) {
                        return response()->json(['reponse' => $th->getMessage()]);
                    }
                    $inscription->reste = $inscription->reste - 1;
                    $inscription->save();
                    if($inscription->abonnement!=1){

                        $liste = new Entre();
                        $liste->matricule = $rfid;
                        $liste->save(); 
                        Storage::put('logs2.txt', $rfid);
                        // Storage::put('logs.txt', $rfid);                           
                    }
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);     
                }else{

                        $inscription  = Inscription::where('membre','=' ,$membre->id)->orderBy('id','dsc')->first();
                        if ($inscription->abonnement==1){
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "http://192.168.0.177/open");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                $output = curl_exec($ch);
                                curl_close($ch);     
                                $presence = new Presence();
                                $presence->inscription = $inscription->id;
                                $presence->membre = $membre->id;
                                // $presence->activity = $setting->value;
                                //Membre::getActivity();
                                try {
                                        $presence->save();
                                    } catch (\Throwable $th) {
                                        return response()->json(['reponse' => $th->getMessage()]);
                                }

                        }else{
                            Storage::put('logs2.txt', $rfid);
                        }
                        return 0;
                }


            }else{  
                //dkhal deja mais admin
                $inscription  = Inscription::where('membre','=' ,$membre->id)->orderBy('id','dsc')->first();
                
                if ($inscription->abonnement==1){
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://192.168.0.177/open");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);     
                        $presence = new Presence();
                        $presence->inscription = $inscription->id;
                        $presence->membre = $membre->id;
                        // $presence->activity = $setting->value;
                        //Membre::getActivity();
                        try {
                                $presence->save();
                            } catch (\Throwable $th) {
                                return response()->json(['reponse' => $th->getMessage()]);
                        }

                }else{                     
                    // dd('sasaz');
                    // dd($rfid."d");
                    Storage::put('logs2.txt', $rfid."d");
                    // Storage::put('logs.txt', $rfid);                           

                }
            }
        }

    }


    public function script1Close($rfid)
    {
        if($rfid==70000){
            $ouverture = new Ouverture();
            try {
                $ouverture->save();
            } catch (\Throwable $th) {
                return response()->json(['reponse' => $th->getMessage()]);
            }
            return response()->json(['reponse' => 1]);    
        }

        $membre=Membre::where('matricule',$rfid)->first();
        if($membre){
            $inscription  = Inscription::where('membre',$membre->id)->first();
            $entre = Entre::where('matricule',$rfid)->first();
            $sortie = Sortie::where('matricule',$rfid)->first();
            // dd($entre);
            
            if(!is_null($entre) and is_null($sortie)){
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://192.168.0.177/close");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);     
                $liste = new Sortie();
                $liste->matricule = $rfid;
                $liste->save(); 

                

            }else{  
                //dkhal deja mais admin
                $inscription  = Inscription::where('membre','=' ,$membre->id)->orderBy('id','dsc')->first();
                
                if ($inscription->abonnement==1){
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://192.168.0.177/close");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);     
                        $presence = new Presence();
                        $presence->inscription = $inscription->id;
                        $presence->membre = $membre->id;
                        // $presence->activity = $setting->value;
                        //Membre::getActivity();
                        try {
                                $presence->save();
                            } catch (\Throwable $th) {
                                return response()->json(['reponse' => $th->getMessage()]);
                        }

                }else{                     
                    // dd('sasaz');
                    // dd($rfid."d");
                    // Storage::put('logs2.txt', $rfid."d");
                    // Storage::put('logs.txt', $rfid);                           

                }
            }
        }

    }



    public function script2($rfid)
    {
        if($rfid==70000){
            $ouverture = new Ouverture();
            try {
                $ouverture->save();
            } catch (\Throwable $th) {
                return response()->json(['reponse' => $th->getMessage()]);
            }
            return response()->json(['reponse' => 1]);    
        }

        $membre=Membre::where('matricule',$rfid)->first();
        if($membre){
            $inscription  = Inscription::where('membre',$membre->id)->first();
            $entre = Entre::where('matricule',$rfid)->first();
            // dd($entre);
            
            if(is_null($entre)){

                $reponse = $membre->isAuthorised();
                
                if($reponse==1){
                    $inscription  = Inscription::where(['membre'=>$membre->id,'etat'=>1])->first();
                    $tripode = $inscription->tripode;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://192.168.0.178/open");
                    $presence = new Presence();
                    $presence->inscription = $inscription->id;
                    $presence->membre = $membre->id;
                    // $presence->activity = $setting->value;
                    //Membre::getActivity();
                    try {
                        $presence->save();
                    } catch (\Throwable $th) {
                        return response()->json(['reponse' => $th->getMessage()]);
                    }
                    $inscription->reste = $inscription->reste - 1;
                    $inscription->save();
                    if($inscription->abonnement!=1){

                        $liste = new Entre();
                        $liste->matricule = $rfid;
                        $liste->save(); 
                        Storage::put('logs2.txt', $rfid);
                        // Storage::put('logs.txt', $rfid);                           
                    }
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);     
                }else{

                        $inscription  = Inscription::where('membre','=' ,$membre->id)->orderBy('id','dsc')->first();
                        if ($inscription->abonnement==1){
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "http://192.168.0.178/open");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                $output = curl_exec($ch);
                                curl_close($ch);     
                                $presence = new Presence();
                                $presence->inscription = $inscription->id;
                                $presence->membre = $membre->id;
                                // $presence->activity = $setting->value;
                                //Membre::getActivity();
                                try {
                                        $presence->save();
                                    } catch (\Throwable $th) {
                                        return response()->json(['reponse' => $th->getMessage()]);
                                }

                        }else{
                            Storage::put('logs2.txt', $rfid);
                        }
                        return 0;
                }


            }else{  
                //dkhal deja mais admin
                $inscription  = Inscription::where('membre','=' ,$membre->id)->orderBy('id','dsc')->first();
                
                if ($inscription->abonnement==1){
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://192.168.0.178/open");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);     
                        $presence = new Presence();
                        $presence->inscription = $inscription->id;
                        $presence->membre = $membre->id;
                        // $presence->activity = $setting->value;
                        //Membre::getActivity();
                        try {
                                $presence->save();
                            } catch (\Throwable $th) {
                                return response()->json(['reponse' => $th->getMessage()]);
                        }

                }else{                     
                    // dd('sasaz');
                    // dd($rfid."d");
                    Storage::put('logs2.txt', $rfid."d");
                    // Storage::put('logs.txt', $rfid);                           

                }
            }
        }

    }

    


    public function script2Close($rfid)
    {
        if($rfid==70000){
            $ouverture = new Ouverture();
            try {
                $ouverture->save();
            } catch (\Throwable $th) {
                return response()->json(['reponse' => $th->getMessage()]);
            }
            return response()->json(['reponse' => 1]);    
        }

        $membre=Membre::where('matricule',$rfid)->first();
        if($membre){
            $inscription  = Inscription::where('membre',$membre->id)->first();
            $entre = Entre::where('matricule',$rfid)->first();
            $sortie = Sortie::where('matricule',$rfid)->first();
            // dd($entre);
            
            if(!is_null($entre) and is_null($sortie)){
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://192.168.0.178/close");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);     
                $liste = new Sortie();
                $liste->matricule = $rfid;
                $liste->save(); 

                

            }else{  
                //dkhal deja mais admin
                $inscription  = Inscription::where('membre','=' ,$membre->id)->orderBy('id','dsc')->first();
                
                if ($inscription->abonnement==1){
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://192.168.0.178/close");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);     
                        $presence = new Presence();
                        $presence->inscription = $inscription->id;
                        $presence->membre = $membre->id;
                        // $presence->activity = $setting->value;
                        //Membre::getActivity();
                        try {
                                $presence->save();
                            } catch (\Throwable $th) {
                                return response()->json(['reponse' => $th->getMessage()]);
                        }

                }else{                     
                    // dd('sasaz');
                    // dd($rfid."d");
                    // Storage::put('logs2.txt', $rfid."d");
                    // Storage::put('logs.txt', $rfid);                           

                }
            }
        }

    }



    public function script3($rfid)
    {
        if($rfid==70000){
            $ouverture = new Ouverture();
            try {
                $ouverture->save();
            } catch (\Throwable $th) {
                return response()->json(['reponse' => $th->getMessage()]);
            }
            return response()->json(['reponse' => 1]);    
        }

        $membre=Membre::where('matricule',$rfid)->first();
        if($membre){
            $inscription  = Inscription::where('membre',$membre->id)->first();
            $entre = Entre::where('matricule',$rfid)->first();
            // dd($entre);
            
            if(is_null($entre)){

                $reponse = $membre->isAuthorised();
                
                if($reponse==1){
                    $inscription  = Inscription::where(['membre'=>$membre->id,'etat'=>1])->first();
                    $tripode = $inscription->tripode;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://192.168.0.179/open");
                    $presence = new Presence();
                    $presence->inscription = $inscription->id;
                    $presence->membre = $membre->id;
                    // $presence->activity = $setting->value;
                    //Membre::getActivity();
                    try {
                        $presence->save();
                    } catch (\Throwable $th) {
                        return response()->json(['reponse' => $th->getMessage()]);
                    }
                    $inscription->reste = $inscription->reste - 1;
                    $inscription->save();
                    if($inscription->abonnement!=1){

                        $liste = new Entre();
                        $liste->matricule = $rfid;
                        $liste->save(); 
                        Storage::put('logs2.txt', $rfid);
                        // Storage::put('logs.txt', $rfid);                           
                    }
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);     
                }else{

                        $inscription  = Inscription::where('membre','=' ,$membre->id)->orderBy('id','dsc')->first();
                        if ($inscription->abonnement==1){
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "http://192.168.0.179/open");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                $output = curl_exec($ch);
                                curl_close($ch);     
                                $presence = new Presence();
                                $presence->inscription = $inscription->id;
                                $presence->membre = $membre->id;
                                // $presence->activity = $setting->value;
                                //Membre::getActivity();
                                try {
                                        $presence->save();
                                    } catch (\Throwable $th) {
                                        return response()->json(['reponse' => $th->getMessage()]);
                                }

                        }else{
                            Storage::put('logs2.txt', $rfid);
                        }
                        return 0;
                }


            }else{  
                //dkhal deja mais admin
                $inscription  = Inscription::where('membre','=' ,$membre->id)->orderBy('id','dsc')->first();
                
                if ($inscription->abonnement==1){
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://192.168.0.179/open");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);     
                        $presence = new Presence();
                        $presence->inscription = $inscription->id;
                        $presence->membre = $membre->id;
                        // $presence->activity = $setting->value;
                        //Membre::getActivity();
                        try {
                                $presence->save();
                            } catch (\Throwable $th) {
                                return response()->json(['reponse' => $th->getMessage()]);
                        }

                }else{                     
                    // dd('sasaz');
                    // dd($rfid."d");
                    Storage::put('logs2.txt', $rfid."d");
                    // Storage::put('logs.txt', $rfid);                           

                }
            }
        }

    }


    public function script3Close($rfid)
    {
        if($rfid==70000){
            $ouverture = new Ouverture();
            try {
                $ouverture->save();
            } catch (\Throwable $th) {
                return response()->json(['reponse' => $th->getMessage()]);
            }
            return response()->json(['reponse' => 1]);    
        }

        $membre=Membre::where('matricule',$rfid)->first();
        if($membre){
            $inscription  = Inscription::where('membre',$membre->id)->first();
            $entre = Entre::where('matricule',$rfid)->first();
            $sortie = Sortie::where('matricule',$rfid)->first();
            // dd($entre);
            
            if(!is_null($entre) and is_null($sortie)){
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://192.168.0.179/close");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);     
                $liste = new Sortie();
                $liste->matricule = $rfid;
                $liste->save(); 

                

            }else{  
                //dkhal deja mais admin
                $inscription  = Inscription::where('membre','=' ,$membre->id)->orderBy('id','dsc')->first();
                
                if ($inscription->abonnement==1){
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://192.168.0.179/close");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);     
                        $presence = new Presence();
                        $presence->inscription = $inscription->id;
                        $presence->membre = $membre->id;
                        // $presence->activity = $setting->value;
                        //Membre::getActivity();
                        try {
                                $presence->save();
                            } catch (\Throwable $th) {
                                return response()->json(['reponse' => $th->getMessage()]);
                        }

                }else{                     
                    // dd('sasaz');
                    // dd($rfid."d");
                    // Storage::put('logs2.txt', $rfid."d");
                    // Storage::put('logs.txt', $rfid);                           

                }
            }
        }

    }

    public function script($carte,$rfid)
    {
        // $matricule= $request->matricule;
        // $matricule = substr($matricule, 0, -2);
        if($rfid==70000){

            $ouverture = new Ouverture();
            try {
                $ouverture->save();
            } catch (\Throwable $th) {
                return response()->json(['reponse' => $th->getMessage()]);
            }
            return response()->json(['reponse' => 1]);    

        }

        
    }

    public function ouverture()
    {
        $ouverture = new Ouverture();
        try {
            $ouverture->save();
        } catch (\Throwable $th) {
            return response()->json(['reponse' => $th->getMessage()]);
        }
        return response()->json(['reponse' => 1]);    


    } 
    public function insertPresence(Request $request)
    {
        $setting = Setting::where('titre','activity')->first();
        $matricule= $request->matricule;
        $matricule = substr($matricule, 0, -2);
        $membre=Membre::where('matricule',$matricule)->first();
        if($membre){
            $inscription  = Inscription::where(['membre'=>$membre->id,'etat'=>1])->first();
            if($inscription){
                $presence = new Presence();
                $presence->inscription = $inscription->id;
                $presence->membre = $membre->id;
                // $presence->activity = $setting->value;
                //Membre::getActivity();
                try {
                    $presence->save();
                } catch (\Throwable $th) {
                    return response()->json(['reponse' => $th->getMessage()]);
                }
                $inscription->reste = $inscription->reste - 1;
                $inscription->save();
                return response()->json(['reponse' => 1]);    
            }    
        }
        return response()->json(['reponse' => $membre]);    


    } 
    public function verifier(Request $request)
    {
    
        $matricule= $request->matricule;
        $matricule = substr($matricule, 0, -2);

        $membre=Membre::where('matricule',$matricule)->first();
        if($membre){
            $reponse = $membre->isAuthorised();
            
            return response()->json(['reponse' => $reponse]);
        }else{
            return response()->json(['reponse' => -1]);
        }
    }
    public function createPresence(Request $request)
    {
        $matricule = $request->matricule;
        $presence = new Presnce();
        try {
            $presence->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => 0]);
        }
        return response()->json(['error' => 1]);

    }
}
