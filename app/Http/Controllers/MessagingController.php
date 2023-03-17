<?php

namespace App\Http\Controllers;

use App\Models\Messaging;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class MessagingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($annonce)
    {
        $messagings = Messaging::where('annonce_id', $annonce)->orderBy('created_at', 'desc')->get();
            return response()->json($messagings);
    }

    public function showAllMyMessage(Request $request, $user)
    {
      
        $messagings = Messaging::where('user_id', $user)->orderBy('created_at', 'desc')->get();
            return response()->json($messagings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user, $annonce)
    {
         //securite
         $currentUser = $request->user();
         if ($currentUser->id != $user){
             return response()->json(['message' => "L' utilisateur ne possede pas les droits"], 403);
         }
         //permet de creer les messages       
         try {
            $request->validate([

                'message' => 'required',
                
            ]);

            $data = $request->all();
            $data['user_id'] = $request->user()->id;
            $data['annonce_id'] = $annonce;

            Messaging::create($data);
        } catch (Exception $e) {
            return response()->json([
                "request" => $request,
                "message" => $e->getMessage()
            ], 421);
        }

        return response()->json(
            Messaging::query()->orderBy('id', 'desc')->first()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Messaging  $messaging
     * @return \Illuminate\Http\Response
     */

     public function showMyMessage(Request $request, User $user)
    {
        $messagings = $user->myMessagings;
        return response()->json($messagings);
    }

    public function show(Messaging $messaging)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Messaging  $messaging
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Messaging $messaging)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Messaging  $messaging
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $messagings = Messaging::findOrFail($id);
        if (is_null($messagings)) {
            return response()->json(['message' => "Message non existante"], 404);
        }
        if ($messagings->user_id !== $user->id) {
            return response()->json(['message' => "L' utilisateur ne possede pas les droits"], 403);
        }

        $messagings->delete();

        return response()->json(
            "message {$id} supprimee"
        );
    }
}
