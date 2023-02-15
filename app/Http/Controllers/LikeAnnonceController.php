<?php

namespace App\Http\Controllers;

use App\Models\LikeAnnonce;
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
         //securite
        $likeAnnonce =  LikeAnnonce::where('annonce_id', $annonce)->where('user_id', $user)
        ->first();
       // si like annonce existe on fait un delete comme dans annonce controller et on renvoi a nouveau  a partir de la ligne 53
       if (!is_null($likeAnnonce)){

       } else {
        try {
            $data = $request->all();
            $data['user_id'] = $request->user()->id;
            LikeAnnonce::create([
                "user_id"=>$user,
                "annonce_id"=>$annonce
            ]);
        } catch (Exception $e) {
            return response()->json([
                "request" => $request,
                "message" => $e->getMessage()
            ], 421);
        }
       }
        return response()->json(
            LikeAnnonce::where('annonce_id', $annonce)
            ->select(DB::raw('sum(id) as total_like'))
            ->groupBy('annonce_id')
            ->first()
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