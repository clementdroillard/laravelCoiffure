<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rdvs;
use App\Disponibilites;
use App\Indisponibilites;
use App\Prestations;
use \DateInterval;
use \DateTime;


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

    public function getDateFinForRdv($prestation_id,$dateDebutRdv){
        //conversion de la duree de prestation et de la dateDEbut pour les additionner
        $TempsPrestation = json_decode(Prestations::find($prestation_id))->duree;
        $TempsPrestation = explode(":", $TempsPrestation);       
        $TempsPrestationInterval = new DateInterval('PT'.$TempsPrestation[0].'H'.$TempsPrestation[1].'M'.$TempsPrestation[2].'S');
        $dateDebut = new DateTime($dateDebutRdv);
        //on ajoute le temps de la prestation a la date du debut pour obtenir la date de fin
        return date_add($dateDebut,$TempsPrestationInterval)->format('Y-m-d H:i:s');
    }

    public function storeForClient(Request $request)
    {
        //on recupere la date de fin en fonction de la prestation et de la date de debut  
        $dateFin = $this->getDateFinForRdv($request->prestation_id,$request->dateDebut);

        //convertion des dates recus
        $jour = date('w',strtotime($request->dateDebut));
        $heureDebut = date('H:i:s',strtotime($request->dateDebut));
        $heureFin = date('H:i:s',strtotime($dateFin));

        //vérifie si le coiffeur travaille a cette horraire habituellement
        if((Disponibilites::where('heureDebut','<=',$heureDebut)->where('heureFin','>=',$heureFin)->where('jourSemaine',$jour)->where('coiffeur_id',$request->coiffeur_id)->count()) <= 0 )
        {
            //le coiffeur est pas dispo
            return abort(400, 'Le coiffeur est indisponible sur cette plage horraire.');
        }

        //vérifie si le coiffeur est indisponible a cette horraire
        elseif((Indisponibilites::where('dateDebut','<',$dateFin)->where('dateFin','>',$request->dateDebut)->where('coiffeur_id',$request->coiffeur_id)->count()) != 0 )
        {
            //le coiffeur a une indisponibilité
            return abort(400, 'Le coiffeur est indisponible sur cette plage horraire.');
        }
        //verfie si il y a deja un rdv sur cette plage horraire
        elseif((Rdvs::where('dateDebut','<',$dateFin)->where('dateFin','>',$request->dateDebut)->where('coiffeur_id',$request->coiffeur_id)->count()) != 0 )
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
            $rdv->dateFin = $dateFin;
            $rdv->save();
            return Rdvs::find($rdv->id);
        }
    }

    public function storeForSalon(Request $request)
    {
        //on recupere la date de fin en fonction de la prestation et de la date de debut  
        $dateFin = $this->getDateFinForRdv($request->prestation_id,$request->dateDebut);
        
        //convertion des dates recus
        $jour = date('w',strtotime($request->dateDebut));
        $heureDebut = date('H:i:s',strtotime($request->dateDebut));
        $heureFin = date('H:i:s',strtotime($dateFin));

        //vérifie si le coiffeur travaille a cette horraire habituellement
        if((Disponibilites::where('heureDebut','<=',$heureDebut)->where('heureFin','>=',$heureFin)->where('jourSemaine',$jour)->where('coiffeur_id',$request->coiffeur_id)->count()) <= 0 )
        {
            //le coiffeur est pas dispo
            return abort(400, 'Le coiffeur est indisponible sur cette plage horraire.');
        }

        //vérifie si le coiffeur est indisponible a cette horraire
        elseif((Indisponibilites::where('dateDebut','<',$dateFin)->where('dateFin','>',$request->dateDebut)->where('coiffeur_id',$request->coiffeur_id)->count()) != 0 )
        {
            //le coiffeur a une indisponibilité
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
            $rdv->dateFin = $dateFin;
            $rdv->save();
            return Rdvs::find($rdv->id);
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


    public function rdvByCoiffeur($idCoiffeur,$dateDebut,$dateFin)
    {
        return Rdvs::where("coiffeur_id",$idCoiffeur)->where('dateDebut','<',$dateFin)->where('dateFin','>',$dateDebut)->get();
    }
}
