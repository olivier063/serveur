<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonces extends Model

//les annonces se creeront et se mettrons a jour sur ce modele
{
    use HasFactory;

    // const UPDATED_AT = 'nouveauNom';

    protected $fillable = ['user_id', 'description', 'titre', 'auteur', 'prix', 'nombre de like', 'image'];


    //permet de lier les annonces à 1 user
    function user(){
        return $this->belongsTo(User::class);
    }

    function myLikeAnnonce(){
        return $this->hasMany(LikeAnnonce::class, 'annonce_id');
    }

    function myMessaging(){
        return $this->hasMany(Messaging::class);
    }

    function myImage(){
        return $this->hasOne(Image::class, 'annonce_id');
    }
}

//belongs to categorie... a mettre pour les categories