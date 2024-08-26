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

class DashboardController extends Controller
{

    public function dashboard()
    {
        $abonnementData = DB::table('inscriptions')
            ->select('abonnement', DB::raw('count(*) as total'))
            ->groupBy('abonnement')
            ->get();

        // Query for monthly chart data
        $monthlyData = DB::table('inscriptions')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Query for active and expired inscriptions per month
        $statusData = DB::table('inscriptions')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), 
                DB::raw('SUM(CASE WHEN etat = 1 THEN 1 ELSE 0 END) as active'),
                DB::raw('SUM(CASE WHEN etat = 0 THEN 1 ELSE 0 END) as expired'))
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $versementsData = DB::table('versements')
            ->select(DB::raw('MONTH(date_versement) as month'), DB::raw('YEAR(date_versement) as year'), DB::raw('SUM(montant) as total_amount'))
            ->groupBy(DB::raw('YEAR(date_versement)'), DB::raw('MONTH(date_versement)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $inscriptionsTotals = DB::table('inscriptions')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('SUM(total) as total_amount'))
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $differenceData = $inscriptionsTotals->map(function ($item) use ($versementsData) {
            $versement = $versementsData->firstWhere('month', $item->month)->total_amount ?? 0;
            return [
                'month' => "{$item->month}/{$item->year}",
                'difference' => $item->total_amount - $versement
            ];
        });

        return view('dashboard', [
            'abonnementData' => $abonnementData,
            'monthlyData' => $monthlyData,
            'statusData' => $statusData,
            'versementsData' => $versementsData,
            'differenceData' => $differenceData
        ]);
    
        
            
    }

    public function monthlyInscriptions()
    {
    
        return view('monthly-inscriptions', ['data' => $data]);
    }

}

