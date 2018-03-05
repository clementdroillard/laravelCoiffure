<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coiffeurs;

class coiffeurController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Coiffeurs::all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coiffeur = new Coiffeurs();
        $coiffeur->salon_id = $request->salon_id;
        $coiffeur->nom = $request->nom;
        $coiffeur->prenom = $request->prenom;
        $coiffeur->specialite = $request->specialite;
        $coiffeur->validate = $request->validate;
        $coiffeur->save();
        return Coiffeurs::find($coiffeur->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	return $coiffeur = Coiffeurs::find($id);
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
    	$coiffeur = Coiffeurs::find($id);
        $coiffeur->salon_id = $request->salon_id;
        $coiffeur->nom = $request->nom;
        $coiffeur->prenom = $request->prenom;
        $coiffeur->specialite = $request->specialite;
        $coiffeur->validate = $request->validate;
        $coiffeur->save();
        return $coiffeur;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Coiffeurs::destroy($id);
    }

    public function coiffeurBySalon($idSalon)
    {
        return Coiffeurs::where("salon_id",$idSalon)->where("validate",true)->get();
    }

    public function coiffeurBySalonAll($idSalon)
    {
        return Coiffeurs::where("salon_id",$idSalon)->get();
    }

    public function changeValidate(Request $request)
    {
        if(Coiffeurs::where("salon_id",$request->salon_id)->where('id',$request->id)->count() > 0)
        {
            $coiffeur = Coiffeurs::find($request->id);
            $coiffeur->validate = 1-$coiffeur->validate;
            $coiffeur->save();
            return $coiffeur;
        }
        else
        {
            return abort(400, 'Coiffeur innexistant pour le salon.');
        }
    }
}
