<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articles;

class articleController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Articles::all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Articles();
        $article->salon_id = $request->salon_id;
        $article->libelle = $request->libelle;
        $article->codeBarre = $request->codeBarre;
        $article->prix = $request->prix;
        $article->stock = $request->stock;
        $article->save();
        return Articles::find($article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	return Articles::find($id);
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
    	$article = Articles::find($id);
    	$article->salon_id = $request->salon_id;
        $article->libelle = $request->libelle;
        $article->codeBarre = $request->codeBarre;
        $article->prix = $request->prix;
        $article->stock = $request->stock;
        $article->save();
        return $article;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Articles::destroy($id);
    }

    //les articles pour le salon
    public function articleBySalon($idSalon)
    {
        return Articles::where("salon_id",$idSalon)->get();
    }

     //change le statut de la prestation
    public function updateStock(Request $request)
    {
        if(Articles::where("salon_id",$request->salon_id)->where('id',$request->id)->count() > 0)
        {
            $article = Articles::find($request->id);
            $article->stock = $request->stock;
            $article->save();
            return $article;
        }
        else
        {
            return abort(400, 'Article innexistant pour le salon.');
        }
    }

}
