<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients;
use App\SalonClients;

class clientController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Clients::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if((Clients::where('adresseMail',$request->adresseMail)->count()) > 0 )
        {
            //mail deja utilisé
            return abort(400, 'Ce mail est déja utilisé.');
        }
        else
        {
            $client = new Clients();
            $client->nom = $request->nom;
            $client->prenom = $request->prenom;
            $client->adresseMail = $request->adresseMail;
            $client->motDePasse = $request->motDePasse;
            $client->telephone = $request->telephone;
            $client->save();
            return Clients::find($client->id);
        }       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	return Clients::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$client = Clients::find($id);
    	$client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->adresseMail = $request->adresseMail;
        $client->motDePasse = $request->motDePasse;
        $client->telephone = $request->telephone;
        $client->save();
        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Clients::destroy($id);
    }


    //authentification du client
    public function auth(Request $request)
    {
        return Clients::where('adresseMail',$request->adresseMail)->where('motDePasse',$request->motDePasse)->firstOrFail();
    }

    //fonction qui retourne les clients du salon
    public function clientBySalon($idSalon)
    {
        $salonClients = SalonClients::where('salon_id',$idSalon)->where('validate',1)->get();
        if($salonClients != "")
        {
            foreach ($salonClients as $salonClient) {
                $client[] = Clients::find($salonClient->client_id);
            }
        }
        return $client;      
    }

}
