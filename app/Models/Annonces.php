<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonces extends Model

//les annonces se creeront et se mettrons a jour sur ce modele
{
    use HasFactory;

    protected $fillable = ['user_id', 'description', 'titre', 'auteur', 'prix', 'nombre de like', 'image'];


    //permet de lier les annonces à 1 user
    function user(){
        return $this->belongsTo(User::class);
    }

    function myLikeAnnonce(){
        return $this->hasMany(LikeAnnonce::class);
    }
}
