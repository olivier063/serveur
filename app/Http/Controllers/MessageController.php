<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //permet d'afficher toutes les annonces
         return response()->json(Message::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'auteur' => 'required|unique:messages',
            'contenu' => 'required|unique:messages'

            
        ]);

        Message::create($request->all());

        return response(
            Message::query()->orderBy('id', 'desc')->first()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return response()->json($message); //affiche une seule annonce selon son id
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Ma variable est un objet de type Message : il contient l'id, la description et l'auteur
        $updatedMessage = Message::findOrFail($id);

        //Prends le message d'un ID particulier et mets le a jour d'apres le formulaire ($request->all()) envoye via postman
        $updatedMessage->update($request->all());

        return response(['message' => 'Message updated',
                        'contenu requetee ' => $request['contenu'],
                        'MAJ' => $updatedMessage,
                        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Message::findOrFail($id)->delete();
        return response()->json(
            "message {$id} supprimé"
        );
    }
}
