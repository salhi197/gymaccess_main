<?php


use Illuminate\Support\Facades\Auth;
Route::get('/code', function(){
    dd(Hash::make('labo'));
});

Route::post('/write', 'HomeController@write')->middleware('auth')->name('write');
Route::get('/clear/records', 'HomeController@clear')->middleware('auth')->name('clear.records');
Route::get('/open', 'SettingController@open')->middleware('auth')->name('open');
Route::get('/error', 'HomeController@format')->middleware('auth')->name('format');
Route::post('/write2', 'HomeController@write2')->name('write2');
Route::post('/write3', 'HomeController@write3')->name('write3');
Route::post('/check/port', 'SettingController@check');

Route::get('/api/script1/{rfid}', 'ApiController@script1');
Route::get('/api/close/script1/{rfid}', 'ApiController@script1Close');


Route::get('/api/script2/{rfid}', 'ApiController@script2');
Route::get('/api/close/script2/{rfid}', 'ApiController@script2Close');

Route::get('/api/script3/{rfid}', 'ApiController@script3');
Route::get('/api/close/script3/{rfid}', 'ApiController@script3Close');

Route::post('/pos', 'CommandeController@store')->name('pos');


Route::get('/test', function(){
    dd(date('H'));
});


Route::group(['prefix' => 'produit','middleware' =>['lang','auth'], 'as' => 'produit'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'ProduitController@index']);
    Route::get('/pos', ['as' => '.pos', 'uses' => 'ProduitController@pos']);
    Route::get('/create',['as'=>'.create', 'uses' => 'ProduitController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'ProduitController@store']);
    Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'ProduitController@destroy']); 
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'ProduitController@edit']);
    Route::post('/update/{produit}', ['as' => '.update', 'uses' => 'ProduitController@update']);    
});


Route::group(['prefix' => 'commande','middleware' =>['lang','auth'], 'as' => 'commande'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'CommandeController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'CommandeController@create']);
    Route::post('/store', ['as' => '.store', 'uses' => 'CommandeController@store']);
    Route::post('/filter', ['as' => '.filter', 'uses' => 'CommandeController@filter']);
    Route::post('/update/{commande_id}', ['as' => '.update', 'uses' => 'CommandeController@update']);
    Route::get('/destroy/{commande_id}', ['as' => '.destroy', 'uses' => 'CommandeController@destroy']);    
    Route::get('/edit/{commande_id}', ['as' => '.edit', 'uses' => 'CommandeController@edit']);
        Route::get('/print/{commande_id}', ['as' => '.print', 'uses' => 'CommandeController@print']);
});

Route::group(['prefix' => 'produit','middleware' =>['lang','auth'], 'as' => 'produit'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'ProduitController@index']);
    Route::get('/create',['as'=>'.create', 'uses' => 'ProduitController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'ProduitController@store']);
    Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'ProduitController@destroy']); 
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'ProduitController@edit']);
    Route::post('/update/{produit}', ['as' => '.update', 'uses' => 'ProduitController@update']);    
});

Route::group(['prefix' => 'setting','middleware' =>['lang','auth'], 'as' => 'setting'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'SettingController@index']);
    Route::get('/create',['as'=>'.create', 'uses' => 'SettingController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'SettingController@store']);
    Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'SettingController@destroy']); 
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'SettingController@edit']);
    Route::post('/update/{setting}', ['as' => '.update', 'uses' => 'SettingController@update']);    
});



Route::group(['prefix' => 'presence','middleware' =>['lang','auth'], 'as' => 'presence'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'PresenceController@index']);
    Route::get('/create',['as'=>'.create', 'uses' => 'PresenceController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'PresenceController@store']);
    Route::post('/entrer', ['as' => '.entrer', 'uses' => 'PresenceController@entrer']);

    Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'PresenceController@destroy']); 
    Route::get('/stock/{id_demande}', ['as' => '.stock', 'uses' => 'PresenceController@stock']); 
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'PresenceController@edit']);
    Route::get('/print/{cd_presence}', ['as' => '.print', 'uses' => 'PresenceController@print']);
    Route::post('/update/{presence}', ['as' => '.update', 'uses' => 'PresenceController@update']);    
    Route::post('/filter/{membre}', ['as' => '.filter', 'uses' => 'PresenceController@filter']);    
    Route::post('/filter2', ['as' => '.filter2', 'uses' => 'PresenceController@filter2']);    
});


Route::group(['prefix' => 'assurance','middleware' =>['lang','auth'], 'as' => 'assurance'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'AssuranceController@index']);
    Route::get('/create',['as'=>'.create', 'uses' => 'AssuranceController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'AssuranceController@store']);
    Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'AssuranceController@destroy']); 
    Route::get('/stock/{id_demande}', ['as' => '.stock', 'uses' => 'AssuranceController@stock']); 
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'AssuranceController@edit']);
    Route::get('/print/{assurance}', ['as' => '.print', 'uses' => 'AssuranceController@print']);
    Route::post('/update/{assurance}', ['as' => '.update', 'uses' => 'AssuranceController@update']);    
});


Route::group(['prefix' => 'puce','middleware' =>['lang','auth'], 'as' => 'puce'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'PuceController@index']);
    Route::get('/create',['as'=>'.create', 'uses' => 'PuceController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'PuceController@store']);
    Route::get('/destroy/{puce}', ['as' => '.destroy', 'uses' => 'PuceController@destroy']); 
    Route::get('/stock/{puce}', ['as' => '.stock', 'uses' => 'PuceController@stock']); 
    Route::get('/edit/{puce}', ['as' => '.edit', 'uses' => 'PuceController@edit']);
    Route::get('/print/{puce}', ['as' => '.print', 'uses' => 'PuceController@print']);
    Route::post('/update/{puce}', ['as' => '.update', 'uses' => 'PuceController@update']);    
});


Route::group(['prefix' => 'crenau','middleware' =>['lang','auth'], 'as' => 'crenau'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'CrenauController@index']);
    Route::get('/create',['as'=>'.create', 'uses' => 'CrenauController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'CrenauController@store']);
    Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'CrenauController@destroy']); 
    Route::get('/stock/{id_demande}', ['as' => '.stock', 'uses' => 'CrenauController@stock']); 
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'CrenauController@edit']);
    Route::get('/print/{cd_Crenau}', ['as' => '.print', 'uses' => 'CrenauController@print']);
    Route::post('/update/{crenau}', ['as' => '.update', 'uses' => 'CrenauController@update']);    
});


Route::group(['prefix' => 'activitie','middleware' =>['lang','auth'], 'as' => 'activitie'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'ActivitieController@index']);
    Route::get('/create',['as'=>'.create', 'uses' => 'ActivitieController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'ActivitieController@store']);
    Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'ActivitieController@destroy']); 
    Route::get('/stock/{id_demande}', ['as' => '.stock', 'uses' => 'ActivitieController@stock']); 
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'ActivitieController@edit']);
    Route::get('/print/{cd_activitie}', ['as' => '.print', 'uses' => 'ActivitieController@print']);
    Route::post('/update/{activitie}', ['as' => '.update', 'uses' => 'ActivitieController@update']);    
});

// Route::group(['prefix' => 'rapport','middleware' =>['lang','auth'], 'as' => 'rapport'], function () {
//     Route::get('/', ['as' => '.index', 'uses' => 'RapportController@index']);
//     Route::get('/create',['as'=>'.create', 'uses' => 'RapportController@create']);
//     Route::post('/create', ['as' => '.store', 'uses' => 'RapportController@store']);
//     Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'RapportController@destroy']); 
//     Route::get('/stock/{id_demande}', ['as' => '.stock', 'uses' => 'RapportController@stock']); 
//     Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'RapportController@edit']);
//     Route::get('/print/{cd_rapport}', ['as' => '.print', 'uses' => 'RapportController@print']);
//     Route::post('/update/{rapport}', ['as' => '.update', 'uses' => 'RapportController@update']);    
// });

Route::group(['prefix' => 'stock','middleware' =>['lang','auth'], 'as' => 'stock'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'StockController@index']);
    Route::get('/create',['as'=>'.create', 'uses' => 'StockController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'StockController@store']);
    Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'StockController@destroy']); 
    Route::get('/stock/{id_demande}', ['as' => '.stock', 'uses' => 'StockController@stock']); 
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'StockController@edit']);
    Route::get('/print/{id_analyse}', ['as' => '.print', 'uses' => 'StockController@print']);
    Route::post('/update/{stock}', ['as' => '.update', 'uses' => 'StockController@update']);    
});


Route::group(['prefix' => 'operateur','middleware' =>['lang','auth'], 'as' => 'operateur'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'OperateurController@index']);
    Route::get('/create',['as'=>'.create', 'uses' => 'OperateurController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'OperateurController@store']);
    Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'OperateurController@destroy']); 
    Route::get('/stock/{id_demande}', ['as' => '.stock', 'uses' => 'OperateurController@stock']); 
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'OperateurController@edit']);
    Route::get('/show/{id_operateur}', ['as' => '.show', 'uses' => 'OperateurController@show']);
    Route::post('/update/{operateur}', ['as' => '.update', 'uses' => 'OperateurController@update']);    
});

Route::group(['prefix' => 'setting','middleware' =>['lang','auth'], 'as' => 'setting'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'SettingController@index']);
    Route::get('/create',['as'=>'.create', 'uses' => 'SettingController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'SettingController@store']);
    Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'SettingController@destroy']); 
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'SettingController@edit']);
    Route::get('/show/{id_setting}', ['as' => '.show', 'uses' => 'SettingController@show']);
    Route::post('/update/{setting}', ['as' => '.update', 'uses' => 'SettingController@update']);    
});

Route::group(['prefix' => 'inscription','middleware' =>['lang','auth'], 'as' => 'inscription'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'InscriptionController@index']);
    Route::get('/today', ['as' => '.today', 'uses' => 'InscriptionController@today']);
    
    Route::get('/excel', ['as' => '.excel', 'uses' => 'InscriptionController@excel']);
    Route::post('/filter/excel', ['as' => '.filter.excel', 'uses' => 'InscriptionController@filterExcel']);
    Route::get('/expirer', ['as' => '.expirer', 'uses' => 'InscriptionController@expirer']);
    Route::get('/presence/{inscription}', ['as' => '.presence', 'uses' => 'InscriptionController@presence']);

    Route::get('/create',['as'=>'.create', 'uses' => 'InscriptionController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'InscriptionController@store']);
    Route::get('/destroy/{id_inscription}', ['as' => '.destroy', 'uses' => 'InscriptionController@destroy']); 
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'InscriptionController@edit']);
    Route::post('/update/{inscription}', ['as' => '.update', 'uses' => 'InscriptionController@update']);    
    Route::post('/filter', ['as' => '.filter', 'uses' => 'InscriptionController@filter']);    
});
Route::get('/members/getMembers/','MembreController@getMembers')->middleware('auth')->name('members.getMembers');

Route::group(['prefix' => 'membre','middleware' =>['lang','auth'], 'as' => 'membre'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'MembreController@index']);
    Route::get('/actifs', ['as' => '.actifs', 'uses' => 'MembreController@actifs']);
    Route::get('/expirer', ['as' => '.expirer', 'uses' => 'MembreController@expirer']);
    Route::get('/credits', ['as' => '.credits', 'uses' => 'MembreController@credits']);
    Route::get('/inscriptions/{membre}', ['as' => '.inscriptions', 'uses' => 'MembreController@inscriptions']);
    Route::get('/create',['as'=>'.create', 'uses' => 'MembreController@create']);
    Route::post('/create', ['as' => '.store', 'uses' => 'MembreController@store']);
    Route::get('/destroy/{id_membre}', ['as' => '.destroy', 'uses' => 'MembreController@destroy']); 
    Route::get('/state/{id_membre}', ['as' => '.state', 'uses' => 'MembreController@state']); 
    Route::get('/facture/{id_membre}', ['as' => '.facture', 'uses' => 'MembreController@facture']); 
    Route::get('/edit/{id_membre}', ['as' => '.edit', 'uses' => 'MembreController@edit']);
    Route::get('/membre/{id_membre}', ['as' => '.membre', 'uses' => 'MembreController@membre']);
    Route::get('/deja/{id_membre}', ['as' => '.deja', 'uses' => 'MembreController@deja']);
    // Route::get('/deja', ['as' => '.deja', 'uses' => 'MembreController@deja']);
    Route::get('/plus/{id_membre}', ['as' => '.plus', 'uses' => 'MembreController@plus']);
    Route::get('/minus/{id_membre}', ['as' => '.minus', 'uses' => 'MembreController@minus']);
    Route::get('/compte/{id_membre}', ['as' => '.compte', 'uses' => 'MembreController@compte']);
    Route::get('/oublier/{id_membre}', ['as' => '.oublier', 'uses' => 'MembreController@oublier']);
    Route::get('/presence/{id_membre}/{inscription}', ['as' => '.presence', 'uses' => 'MembreController@presence']);
    Route::get('/versements/{inscription}', ['as' => '.versements', 'uses' => 'MembreController@versements']);
    Route::post('/update/{membre}', ['as' => '.update', 'uses' => 'MembreController@update']);    
    Route::post('/filter', ['as' => '.filter', 'uses' => 'MembreController@filter']);    
    Route::get('/profile/{membre}', ['as' => '.profile', 'uses' => 'MembreController@profile']);
    Route::get('/default', ['as' => '.default', 'uses' => 'MembreController@default']);
    Route::get('/default2', ['as' => '.default2', 'uses' => 'MembreController@default2']);
    



    // Route::get('/verifier/{id_membre}', ['as' => '.edit', 'uses' => 'MembreController@verifier']);

    
});


Route::group(['prefix' => 'user','middleware' =>['lang','auth'], 'as' => 'user'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'UserController@index']);
    Route::get('/coachs', ['as' => '.coachs', 'uses' => 'UserController@coachs']);    
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'UserController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'UserController@store']);
    Route::post('/store/coach', ['as' => '.store.coach', 'uses' => 'UserController@storeCoach']);
    Route::get('/destroy/{id_user}', ['as' => '.destroy', 'uses' => 'UserController@destroy']);    
    Route::get('/edit/{id_user}', ['as' => '.edit', 'uses' => 'UserController@edit']);
    Route::get('/show/{id_user}', ['as' => '.show', 'uses' => 'UserController@show']);
    Route::post('/update/{id_user}', ['as' => '.update', 'uses' => 'UserController@update']);    
});


Route::group(['prefix' => 'abonnement','middleware' =>['lang','auth'], 'as' => 'abonnement'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'AbonnementController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'AbonnementController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'AbonnementController@store']);
    Route::post('/update/{id_abonnement}', ['as' => '.update', 'uses' => 'AbonnementController@update']);
    Route::get('/destroy/{id_abonnement}', ['as' => '.destroy', 'uses' => 'AbonnementController@destroy']);    
    Route::get('/edit/{id_abonnement}', ['as' => '.edit', 'uses' => 'AbonnementController@edit']);
    Route::get('/profil/{id_abonnement}', ['as' => '.profil', 'uses' => 'AbonnementController@profil']);
});


Route::group(['prefix' => 'activity','middleware' =>['lang','auth'], 'as' => 'activity'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'ActivitieController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'ActivitieController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'ActivitieController@store']);
    Route::post('/update', ['as' => '.update', 'uses' => 'ActivitieController@update']);
    Route::get('/destroy/{ad_Activity}', ['as' => '.destroy', 'uses' => 'ActivitieController@destroy']);    
    Route::get('/edit/{ad_Activity}', ['as' => '.edit', 'uses' => 'ActivitieController@edit']);
});



Route::get('/', function(){
    return redirect()->guest('/login');
});

Auth::routes();
Route::get('/lang/{lang}', 'LangController@setLang')->middleware('auth')->name('lang');











Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->middleware('auth')->name('login.admin');
Route::get('/login/livreur', 'Auth\LoginController@showLivreurLoginForm')->middleware('auth')->name('login.Livreur');
Route::get('/login/fournisseur', 'Auth\LoginController@showFournisseurLoginForm')->middleware('auth')->name('login.Fournisseur');
Route::get('/login/freelancer', 'Auth\LoginController@showFreelancerLoginForm')->middleware('auth')->name('login.Freelancer');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->middleware('auth')->name('register.admin');
Route::get('/register/livreur', 'Auth\RegisterController@showLivreurRegisterForm')->middleware('auth')->name('register.Livreur');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/livreur', 'Auth\LoginController@livreurLogin');
Route::post('/login/fournisseur', 'Auth\LoginController@fournisseurLogin');
Route::post('/login/freelancer', 'Auth\LoginController@freelancerLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->middleware('auth')->name('register.admin');
Route::post('/register/livreur', 'Auth\RegisterController@createLivreur')->middleware('auth')->name('register.Livreur');


Route::get('/home', 'HomeController@index')->middleware('auth')->name('home')->middleware('lang');
// Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');
Route::get('/rapport', 'HomeController@rapport')->middleware('auth')->name('rapport')->middleware('lang');
Route::get('/mon/rapport/{user}', 'HomeController@MonStats')->middleware('auth')->name('mon.rapport')->middleware('lang');
Route::get('/stats', 'HomeController@stats')->middleware('auth')->name('stats')->middleware('lang');
Route::get('/libres', 'HomeController@libres')->middleware('auth')->name('libres');
Route::get('/assurances', 'HomeController@assurances')->middleware('auth')->name('assurances');
Route::get('/puces', 'HomeController@puces')->middleware('auth')->name('puces');

Route::get('/activities', 'HomeController@activities')->middleware('auth')->name('activities');
Route::post('/activities/filter', 'HomeController@FilterActivities')->middleware('auth')->name('activities.filter');

Route::post('/rapport/filter', 'HomeController@filter')->middleware('auth')->name('rapport.filter');

Route::post('/libre/filter', 'HomeController@libresFilter')->middleware('auth')->name('libre.filter');
Route::post('/stats/filter', 'HomeController@statsFilter')->middleware('auth')->name('stats.filter');
Route::post('/assurances/filter', 'HomeController@assurancesFilter')->middleware('auth')->name('assurances.filter');
Route::post('/puces/filter', 'HomeController@pucesFilter')->middleware('auth')->name('puces.filter');

Route::post('/activity', 'HomeController@activity')->middleware('auth')->name('activity');


Route::get('/admin', 'HomeController@index')->middleware('auth')->name('home');

Route::group(['prefix' => 'decharge','middleware' =>['lang','auth'], 'as' => 'decharge'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'DechargeController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'DechargeController@create']);
    Route::get('/facture/{decharge}',['as'=>'.facture', 'uses' => 'DechargeController@facture']);
    Route::post('/create', ['as' => '.create', 'uses' => 'DechargeController@store']);
    Route::get('/destroy/{id_decharge}', ['as' => '.destroy', 'uses' => 'DechargeController@destroy']);    
    Route::get('/edit/{id_decharge}', ['as' => '.edit', 'uses' => 'DechargeController@edit']);
    Route::get('/show/{id_decharge}', ['as' => '.show', 'uses' => 'DechargeController@show']);
    Route::get('/reload', ['as' => '.reload', 'uses' => 'DechargeController@reload']);
    Route::post('/update/{id_decharge}', ['as' => '.update', 'uses' => 'DechargeController@update']);    
    Route::post('/filter', ['as' => '.filter', 'uses' => 'DechargeController@filter']);    
});



Route::group(['prefix' => 'categorie','middleware' =>['lang','auth'], 'as' => 'categorie'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'CategorieController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'CategorieController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'CategorieController@store']);
    Route::post('/update/{id_categorie}', ['as' => '.update', 'uses' => 'CategorieController@update']);
    Route::get('/destroy/{id_categorie}', ['as' => '.destroy', 'uses' => 'CategorieController@destroy']);    
    Route::get('/edit/{id_categorie}', ['as' => '.edit', 'uses' => 'CategorieController@edit']);
});

Route::group(['prefix' => 'versement','middleware' =>['lang','auth'], 'as' => 'versement'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'VersementController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'VersementController@create']);
    Route::post('/store', ['as' => '.store', 'uses' => 'VersementController@store']);
    Route::post('/filter', ['as' => '.filter', 'uses' => 'VersementController@filter']);
    Route::post('/update/{id_versement}', ['as' => '.update', 'uses' => 'VersementController@update']);
    Route::get('/destroy/{id_versement}', ['as' => '.destroy', 'uses' => 'VersementController@destroy']);    
    Route::get('/edit/{id_versement}', ['as' => '.edit', 'uses' => 'VersementController@edit']);
        Route::get('/print/{id_versement}', ['as' => '.print', 'uses' => 'VersementController@print']);
});

Route::get('/membre/ajax','MembreController@indexAjax');
Route::get('/membre/getMembres/','MembreController@getMembres')->middleware('auth')->name('membres.getMembres');


Route::get('/inscription/ajax','InscriptionController@indexAjax');
Route::get('/inscription/getInscriptions/','InscriptionController@getInscriptions')->middleware('auth')->name('inscriptions.getInscriptions');


Route::get('/versement/ajax','VersementController@indexAjax');
Route::get('/versement/getVersement/','VersementController@getVersements')->middleware('auth')->name('versement.getVersements');
