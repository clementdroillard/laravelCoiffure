<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients;

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
        $client = new Clients();
        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->adresseMail = $request->adresseMail;
        $client->motDePasse = $request->motDePasse;
        $client->save();
        return Clients::find($client->id);
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
}
