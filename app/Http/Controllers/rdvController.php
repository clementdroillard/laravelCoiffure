<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rdvs;

class rdvController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rdvs::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rdv = new Rdvs();
        $rdv->coiffeur_id = $request->coiffeur_id;
        $rdv->client_id = $request->client_id;
        $rdv->prestation_id = $request->prestation_id;
        $rdv->dateDebut = $request->dateDebut;
        $rdv->dateFin = $request->dateFin;
        $rdv->save();
        return Rdvs::find($rdv->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$rdv = Rdvs::find($id);
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
    	$rdv = Rdvs::find($id);
        $rdv->coiffeur_id = $request->coiffeur_id;
        $rdv->client_id = $request->client_id;
        $rdv->prestation_id = $request->prestation_id;
        $rdv->dateDebut = $request->dateDebut;
        $rdv->dateFin = $request->dateFin;
        $rdv->save();
        return $rdv;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Rdvs::destroy($id);
    }
}
