<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Indisponibilites;

class indisponibiliteController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Indisponibilites::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $indisponibilite = new Indisponibilites();
        $indisponibilite->coiffeur_id = $request->coiffeur_id;
        $indisponibilite->dateDebut = $request->dateDebut;
        $indisponibilite->dateFin = $request->dateFin;
        $indisponibilite->save();
        return Indisponibilites::find($indisponibilite->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$indisponibilite = Indisponibilites::find($id);
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
    	$indisponibilite = Indisponibilites::find($id);
        $indisponibilite->coiffeur_id = $request->coiffeur_id;
        $indisponibilite->dateDebut = $request->dateDebut;
        $indisponibilite->dateFin = $request->dateFin;
        $indisponibilite->save();
        return $indisponibilite;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Indisponibilites::destroy($id);
    }

    public function indisponibiliteByCoiffeur($idCoiffeur,$dateDebut,$dateFin)
    {
        return Indisponibilites::where("coiffeur_id",$idCoiffeur)->where('dateDebut','<',$dateFin)->where('dateFin','>',$dateDebut)->get();
    }

}
