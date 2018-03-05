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

    public function prestationBySalon($idSalon)
    {
        return Prestations::where("salon_id",$idSalon)->where('validate',1)->get();
    }
}
