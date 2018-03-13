<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salons;
use App\SalonClients;

class salonController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Salons::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if((Salons::where('nomDeCompte',$request->nomDeCompte)->count()) > 0 )
        {
            //mail deja utilisé
            return abort(400, 'Ce nom de compte est déja utilisé.');
        }
        else
        {
        $salon = new Salons();
        $salon->libelle = $request->libelle;
        $salon->adresse = $request->adresse;
        $salon->ville = $request->ville;
        $salon->CP = $request->CP;
        $salon->motDePasse = $request->motDePasse;
        $salon->nomDeCompte = $request->nomDeCompte;
        $salon->save();
        return Salons::find($salon->id);
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
    	return Salons::find($id);
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
    	$salon = Salons::find($id);
    	$salon->libelle = $request->libelle;
        $salon->adresse = $request->adresse;
        $salon->ville = $request->ville;
        $salon->CP = $request->CP;
        $salon->motDePasse = $request->motDePasse;
        $salon->nomDeCompte = $request->nomDeCompte;
        $salon->save();
        return $salon;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Salons::destroy($id);
    }


    //authentification du salon
    public function auth(Request $request)
    {
        return Salons::where('nomDeCompte',$request->nomDeCompte)->where('motDePasse',$request->motDePasse)->firstOrFail();
    }

    //fonction qui retourne les salons du client
    public function salonsByClient($idClient)
    {
        $salons = "";
        $salonClients = SalonClients::where('client_id',$idClient)->where('validate',1)->get();
        if($salonClients != "")
        {
            foreach ($salonClients as $salonClient) {
                $salons[] = Salons::find($salonClient->salon_id);
            }
        }
        return $salons;      
    }

}
