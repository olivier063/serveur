<?php

namespace App\Http\Controllers;

use App\Models\Annonces;
use App\Models\LikeAnnonce;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeAnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function showAllUserLike(Request $request, $user)
    {
        //on cree la variable likeAnnonce qui va chercher dans la table User l'id user 
        //puis va chercher la relation 'myLikeAnnonce' qui est dans le model user pour recuperer tous les likes
        //foreach est utilisée pour parcourir les résultats de la requête. À chaque itération, la méthode trouve l'annonce correspondante dans la table "Annonces" 
        //en utilisant l'ID de l'annonce stocké dans la table "likeAnnonces". Ensuite, les champs "titre" et "image" de la ligne de la table "likeAnnonces" sont mis à jour avec les valeurs correspondantes de l'annonce trouvée.
       $likeAnnonces = User::find($user)->myLikeAnnonce()->orderBy('created_at', 'desc')->get();
       foreach ($likeAnnonces as $likeAnnonce) {
        $ann = Annonces::find($likeAnnonce->annonce_id);
        # code...
        $likeAnnonce->titre = $ann->titre;
        $likeAnnonce->image = "";
       }
       //en dessous c'est l'ancienne requete SQL je l'ai remplacé par celle du dessus
        //$likeAnnonce = LikeAnnonce::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return response()->json($likeAnnonces);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request, string $user, string $annonce)
    {
        // $arrays = [
        //     "key"=>'value',
        //     "value2"
        // ];
        // foreach($arrays as $key=>$value){
        //     $value;
        // }
        //securite
        $currentUser = $request->user();
        if ($currentUser->id != $user) {
            return response()->json(['message' => "L' utilisateur ne possede pas les droits"], 403);
        }
        //securite
        $likeAnnonce =  LikeAnnonce::where('annonce_id', $annonce)->where('user_id', $user)
            ->first();
        if (!is_null($likeAnnonce)) {
            $likeAnnonce->delete();
        } else {
            try {
                LikeAnnonce::create([
                    "user_id" => $user,
                    "annonce_id" => $annonce
                ]);
            } catch (Exception $e) {
                return response()->json([
                    "request" => $request,
                    "message" => $e->getMessage()
                ], 421);
            }
        }
        $count =  LikeAnnonce::where('annonce_id', $annonce)
            ->select(DB::raw('count(id) as total_like'))
            ->groupBy('annonce_id')
            ->first();
        return response()->json(
            $count ?? ['total_like' => 0]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LikeAnnonce  $likeAnnonce
     * @return \Illuminate\Http\Response
     */
    public function show(LikeAnnonce $likeAnnonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LikeAnnonce  $likeAnnonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LikeAnnonce $likeAnnonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LikeAnnonce  $likeAnnonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(LikeAnnonce $likeAnnonce)
    {
        //
    }
}
