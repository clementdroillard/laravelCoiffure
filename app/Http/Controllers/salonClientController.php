<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalonClients;

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
