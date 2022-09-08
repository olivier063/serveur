<?php

namespace App\Http\Controllers;

use App\Models\Annonces;
use Illuminate\Http\Request;

class AnnoncesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //permet d'afficher toutes les annonces
        return response()->json(Annonces::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //permet de creer les annonces

        $request->validate([

            'description' => 'required|unique:annonces',
            'titre' => 'required|unique:annnonces',
            'auteur' => 'required|unique:annonces',
            'prix' => 'required|unique:annonces'

            
        ]);

        Annonces::create($request->all());

        return response(
            Annonces::query()->orderBy('id', 'desc')->first()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Annonces  $annonces
     * @return \Illuminate\Http\Response
     */
    public function show(Annonces $annonce)
    {
        return response()->json($annonce);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Annonces  $annonces
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Ma variable est un objet de type Question : il contient l'id, la description et l'image
        $updatedAnnonces = Annonces::findOrFail($id);

        //Prends cette question d'un ID particulier et mets le a jour d'apres le formulaire ($request->all()) envoye via postman
        $updatedAnnonces->update($request->all());

        return response(['message' => 'Annonce updated',
                        'description requetee ' => $request['description'],
                        'auteur requetee ' => $request['auteur'],
                        'MAJ' => $updatedAnnonces,
                        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Annonces  $annonces
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Annonces::findOrFail($id)->delete();
        return response()->json(
            "annonce {$id} supprimee"
        );
    }
}
