<?php

namespace App\Http\Controllers;

use App\Models\Annonces;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AnnoncesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {

    //     //Pour ordonner les annonces par nombre de likes (changé pour le created_at)....
    //     $annonces = Annonces::orderBy('nombre de like', 'desc')->get();
    //     return response()->json($annonces);

    //     //permet d'afficher toutes les annonces
    //     // return response()->json(Annonces::all());
    // }

    public function index()
    {
        $annonces = Annonces::where('nombre de like', '>=', 50)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($annonces);
    }

    public function index2()
    {
        $annonces = Annonces::where('nombre de like', '<', 50)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($annonces);
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
        try {
            $request->validate([

                'description' => 'required',
                'titre' =>  'required',
                'prix' =>  'required'
            ]);

            $data = $request->all();
            $data['user_id'] = $request->user()->id;
            Annonces::create($data);
        } catch (Exception $e) {
            return response()->json([
                "request" => $request,
                "message" => $e->getMessage()
            ], 421);
        }

        return response()->json(
            Annonces::query()->orderBy('id', 'desc')->first()
        );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Annonces  $annonces
     * @return \Illuminate\Http\Response
     */


    //pour montrer que les annonces de l'utilisateur, penser à faire l'import du User pour le mettre dans les parametres de la fonction showMyAnnonce
    public function showMyAnnonce(Request $request, User $user)
    {
        $annonces = $user->myAnnonces;
        return response()->json($annonces);
    }



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
        //Ma variable est un objet de type annonce : il contient l'id, la description et l'image
        $updatedAnnonces = Annonces::findOrFail($id);

        //Prends cette annonce d'un ID particulier et mets le a jour d'apres le formulaire ($request->all()) envoye via postman
        $updatedAnnonces->update($request->all());
        return response([
            'message' => 'Annonce updated',
            'description requetee ' => $request['description'],
            'nombre de like requete ' => $request['nombre de like'],
            'prix requete ' => $request['prix'],
            'titre requete' => $request['titre'],
            'MAJ' => $updatedAnnonces,
        ]);
    }


    // public function up(Request $request, $id)
    // {
    //     //permet de creer les annonces       
    //     try {
    //         $request->validate([

    //             'description' => 'required',
    //             'titre' =>  'required',
    //             'prix' =>  'required'
    //         ]);

    //         $data = $request->all();
    //         $data['user_id'] = $request->user()->id;
    //         Annonces::create($data);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             "request" => $request,
    //             "message" => $e->getMessage()
    //         ], 421);
    //     }


    //     return response()->json(
    //         Annonces::query()->orderBy('id', 'desc')->first()
    //     );
    // }


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
