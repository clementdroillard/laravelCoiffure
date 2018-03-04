<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalonClients;
use App\Clients;

class salonClientController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SalonClients::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salonClients = new SalonClients();
        $salonClients->salon_id = $request->salon_id;
        $salonClients->client_id = $request->client_id;
        $salonClients->code = $request->code;
        $salonClients->validate = $request->validate;
        $salonClients->save();
        return SalonClients::find($salonClients->id);
    }

    //ajouter un client au salon en fonction de son mail.
    public function storeForSalon(Request $request,$mail)
    {
        $client = json_decode(Clients::where('adresseMail',$mail)->first());
        //on verifie si le mail du client existe 
        if(isset($client->id))
        {
            //verifie si il n'est pas deja client du salon
            if(SalonClients::where('salon_id',$request->salon_id)->where('client_id',$client->id)->count() == 0)
            {
                $salonClients = new SalonClients();
                $salonClients->salon_id = $request->salon_id;
                $salonClients->client_id = $client->id;
                $salonClients->code = '';
                $salonClients->validate = 1;
                $salonClients->save();
                return SalonClients::find($salonClients->id);
            }
            else
            {
                return abort(401, 'Il est deja client.');
            }

        }
        else
        {
            return abort(400, 'Le mail existe pas.');
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
    	return SalonClients::find($id);
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
    	$salonClients = SalonClients::find($id);
        $salonClients->salon_id = $request->salon_id;
        $salonClients->client_id = $request->client_id;
        $salonClients->code = $request->code;
        $salonClients->validate = $request->validate;
        $salonClients->save();
        return $salonClients;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return SalonClients::destroy($id);
    }

}
