<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disponibilites;

class disponibiliteController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Disponibilites::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $disponibilite = new Disponibilites();
        $disponibilite->coiffeur_id = $request->coiffeur_id;
        $disponibilite->jourSemaine = $request->jourSemaine;
        $disponibilite->heureDebut = $request->heureDebut;
        $disponibilite->heureFin = $request->heureFin;
        $disponibilite->save();
        return Disponibilites::find($disponibilite->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$disponibilite = Disponibilites::find($id);
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
    	$disponibilite = Disponibilites::find($id);
        $disponibilite->coiffeur_id = $request->coiffeur_id;
        $disponibilite->jourSemaine = $request->jourSemaine;
        $disponibilite->heureDebut = $request->heureDebut;
        $disponibilite->heureFin = $request->heureFin;
        $disponibilite->save();
        return $disponibilite;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Disponibilites::destroy($id);
    }

    public function disponibiliteByCoiffeur($idCoiffeur)
    {
        return Disponibilites::where("coiffeur_id",$idCoiffeur)->get();
    }
}
