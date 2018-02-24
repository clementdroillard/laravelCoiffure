<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rdvs;
use App\Disponibilites;
use App\Indisponibilites;

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
        //convertion des dates recus
        $jour = date('w',strtotime($request->dateDebut));
        $heureDebut = date('H:i:s',strtotime($request->dateDebut));
        $heureFin = date('H:i:s',strtotime($request->dateFin));

        //vérifie si le coiffeur travaille a cette horraire habituellement
        if((Disponibilites::where('heureDebut','<=',$heureDebut)->where('heureFin','>=',$heureFin)->where('jourSemaine',$jour)->where('coiffeur_id',$request->coiffeur_id)->count()) <= 0 )
        {
            //le coiffeur est pas dispo
            return abort(400, 'Le coiffeur est indisponible sur cette plage horraire.');
        }

        //vérifie si le coiffeur est indisponible a cette horraire
        elseif((Indisponibilites::where('dateDebut','<',$request->dateFin)->where('dateFin','>',$request->dateDebut)->where('coiffeur_id',$request->coiffeur_id)->count()) != 0 )
        {
            //le coiffeur a une indisponibilité
            return abort(400, 'Le coiffeur est indisponible sur cette plage horraire.');
        }
        //verfie si il y a deja un rdv sur cette plage horraire
        elseif((Rdvs::where('dateDebut','<',$request->dateFin)->where('dateFin','>',$request->dateDebut)->where('coiffeur_id',$request->coiffeur_id)->count()) != 0 )
        {
            //il y a deja un rdv sur cette plage horraire
            return abort(400, 'Le coiffeur est indisponible sur cette plage horraire.');
                    
        }
        else
        {
            //le rdv possible
            $rdv = new Rdvs();
            $rdv->coiffeur_id = $request->coiffeur_id;
            $rdv->client_id = $request->client_id;
            $rdv->prestation_id = $request->prestation_id;
            $rdv->dateDebut = $request->dateDebut;
            $rdv->dateFin = $request->dateFin;
            $rdv->save();
            return Rdvs::find($rdv->id).$jour;
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
