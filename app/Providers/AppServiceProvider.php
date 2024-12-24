<?php



namespace App\Providers;

use App\Inscription;
use App\Membre;
use Config;

use Dompdf\Dompdf;
use Carbon\Carbon;
use DateTime;

use App\Traduction;

use Illuminate\Support\ServiceProvider;

use Illuminate\Database\Schema\Builder; // Import Builder where defaultStringLength method is defined



class AppServiceProvider extends ServiceProvider

{

    /**

     * Register any application services.

     *

     * @return void

     */

    public function register()

    {

        //

    }



    /**

     * Bootstrap any application services.

     *

     * @return void

     */

    public function boot()
    {
        Inscription::where('fin','=',Carbon::now()->format('Y/m/d'))
                    ->orWhere('fin','<',Carbon::now()->format('Y/m/d'))
                    ->orWhere('reste','=', 0)
                    ->update(['etat'=>0]);
        $matricules = Membre::all('matricule');
        
        Config::set('matricules', $matricules);
        Builder::defaultStringLength(191); // Update defaultStringLength

        app()->singleton('lang',function (){
            if (auth()->user()) {
                if (empty(auth()->user()->lang)) {
                    return 'en';
                }else{
                    return auth()->user()->lang;
                }
            }else{
                if (session()->has('lang')) {
                    return session()->get('lang');
                }else{
                    return 'en';
                }
            }
        });

    }

}

