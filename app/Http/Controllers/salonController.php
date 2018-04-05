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
        if((Salons::where('adresseMail',$request->adresseMail)->count()) > 0 )
        {
            //mail deja utilisé
            return abort(400, 'Ce mail est déja utilisé.');
        }
        else
        {
        $salon = new Salons();
        $salon->libelle = $request->libelle;
        $salon->adresse = $request->adresse;
        $salon->ville = $request->ville;
        $salon->CP = $request->CP;
        $salon->motDePasse = $request->motDePasse;
        $salon->adresseMail = $request->adresseMail;
        $salon->telephone = $request->telephone;
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
        $salon->adresseMail = $request->adresseMail;
        $salon->telephone = $request->telephone;
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
        return Salons::where('adresseMail',$request->adresseMail)->where('motDePasse',$request->motDePasse)->firstOrFail();
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

    //on verifie le mot de passe pour l'id salon
    public function updateWithConfirmPass(Request $request,$id)
    {
        $client = Salons::where('id',$id)->where('motDePasse',$request->oldMotDePasse)->count();
        if( $client == 0)
        {
            //mot de passe faux
            return abort(400, 'Mot de passe incorrect.');
        }
        else 
        {
             if((Salons::where('adresseMail',$request->adresseMail)->count()) > 0 && $request->adresseMail != $request->adresseMailOld)
            {
                //mail deja utilisé
                return abort(401, 'Ce mail est déja utilisé.');
            }
            else
            {
                $salon = Salons::find($id);
                $salon->libelle = $request->libelle;
                $salon->adresse = $request->adresse;
                $salon->ville = $request->ville;
                $salon->CP = $request->CP;
                $salon->motDePasse = $request->newMotDePasse;
                $salon->adresseMail = $request->adresseMail;
                $salon->telephone = $request->telephone;
                $salon->save();
                return $salon;
            }
        }
    } 

}
