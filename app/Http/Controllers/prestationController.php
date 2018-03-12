<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestations;

class prestationController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Prestations::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prestation = new Prestations();
        $prestation->salon_id = $request->salon_id;
        $prestation->libelle = $request->libelle;
        $prestation->prix = $request->prix;
        $prestation->duree = $request->duree;
        $prestation->validate = $request->validate;
        $prestation->save();
        return Prestations::find($prestation->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	return Prestations::find($id);
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
    	$prestation = Prestations::find($id);
        $prestation->salon_id = $request->salon_id;
        $prestation->libelle = $request->libelle;
        $prestation->prix = $request->prix;
        $prestation->duree = $request->duree;
        $prestation->validate = $request->validate;
        $prestation->save();
        return $prestation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Prestations::destroy($id);
    }

    //les presttions avec le satut validate pour le salon
    public function prestationBySalon($idSalon)
    {
        return Prestations::where("salon_id",$idSalon)->where('validate',1)->get();
    }

    //les prestations du salon 
    public function prestationBySalonAll($idSalon)
    {
        return Prestations::where("salon_id",$idSalon)->get();
    }

    //duree minimum des prestations du salon
    public function prestationBySalonMinDuree($idSalon)
    {
        return Prestations::where("salon_id",$idSalon)->min('duree');
    }

    //change le statut de la prestation
    public function changeValidate(Request $request)
    {
        if(Prestations::where("salon_id",$request->salon_id)->where('id',$request->id)->count() > 0)
        {
            $prestation = Prestations::find($request->id);
            $prestation->validate = 1-$prestation->validate;
            $prestation->save();
            return $prestation;
        }
        else
        {
            return abort(400, 'Prestation innexistant pour le salon.');
        }
    }
}
