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



//Salon 
Route::get('/salons', 'salonController@index');
Route::get('/salon/{id}', 'salonController@show');
Route::post('/salon', 'salonController@store');
Route::put('/salon/{id}', 'salonController@update');
Route::delete('/salon/{id}', 'salonController@destroy');
Route::post('/salon/auth', 'salonController@auth');
Route::get('/salons/client/{idClient}', 'salonController@salonsByClient');

//Client
Route::get('/clients', 'clientController@index');
Route::get('/client/{id}', 'clientController@show');
Route::post('/client', 'clientController@store');
Route::put('/client/{id}', 'clientController@update');
Route::delete('/client/{id}', 'clientController@destroy');
Route::post('/client/auth', 'clientController@auth');


//Salon_Client
Route::get('/salonClients', 'salonClientController@index');
Route::get('/salonClient/{id}', 'salonClientController@show');
Route::post('/salonClient', 'salonClientController@store');
Route::put('/salonClient/{id}', 'salonClientController@update');
Route::delete('/salonClient/{id}', 'salonClientController@destroy');



//Coiffeur
Route::get('/coiffeurs', 'coiffeurController@index');
Route::get('/coiffeur/{id}', 'coiffeurController@show');
Route::post('/coiffeur', 'coiffeurController@store');
Route::put('/coiffeur/{id}', 'coiffeurController@update');
Route::delete('/coiffeur/{id}', 'coiffeurController@destroy');
Route::get('/coiffeur/salon/{idSalon}', 'coiffeurController@coiffeurBySalon');

//Prestation
Route::get('/prestations', 'prestationController@index');
Route::get('/prestation/{id}', 'prestationController@show');
Route::post('/prestation', 'prestationController@store');
Route::put('/prestation/{id}', 'prestationController@update');
Route::delete('/prestation/{id}', 'prestationController@destroy');
Route::get('/prestation/salon/{idSalon}', 'prestationController@prestationBySalon');


//RDV
Route::get('/rdvs', 'rdvController@index');
Route::get('/rdv/{id}', 'rdvController@show');
Route::post('/rdv', 'rdvController@store');
Route::post('/rdv/client', 'rdvController@storeForClient');
Route::put('/rdv/{id}', 'rdvController@update');
Route::delete('/rdv/{id}', 'rdvController@destroy');
Route::get('/rdv/coiffeur/{coiffeurId}/{dateDebut}/{dateFin}', 'rdvController@rdvByCoiffeur');



//Disponibilite
Route::get('/disponibilites', 'disponibiliteController@index');
Route::get('/disponibilite/{id}', 'disponibiliteController@show');
Route::post('/disponibilite', 'disponibiliteController@store');
Route::put('/disponibilite/{id}', 'disponibiliteController@update');
Route::delete('/disponibilite/{id}', 'disponibiliteController@destroy');
Route::get('/disponibilite/coiffeur/{coiffeurId}', 'disponibiliteController@disponibiliteByCoiffeur');

//Indisponibilité
Route::get('/indisponibilites', 'indisponibiliteController@index');
Route::get('/indisponibilite/{id}', 'indisponibiliteController@show');
Route::post('/indisponibilite', 'indisponibiliteController@store');
Route::put('/indisponibilite/{id}', 'indisponibiliteController@update');
Route::delete('/indisponibilite/{id}', 'indisponibiliteController@destroy');
Route::get('/indisponibilite/coiffeur/{coiffeurId}/{dateDebut}/{dateFin}', 'indisponibiliteController@indisponibiliteByCoiffeur');


