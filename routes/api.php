<?php



use Illuminate\Http\Request;



/*

|--------------------------------------------------------------------------

| API Routes

|--------------------------------------------------------------------------

|

| Here is where you can register API routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| is assigned the "api" middleware group. Enjoy building your API!

|

*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'static', 'as' => 'static.'], function () {
    Route::get('/communes/{wilaya}', 'Api\StaticDataController@communes')->name('communes');
});
Route::post('/membre/verifier', 'ApiController@verifier');
Route::post('/ouverture', 'ApiController@ouverture');
Route::post('/insert/presence', 'ApiController@insertPresence');

Route::post('/presense/create', 'ApiController@createPresence');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

