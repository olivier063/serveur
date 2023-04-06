<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'annonce_id', 'content', 'created_at'];

    function annonce(){
        return $this->belongsTo(Annonces::class);
    }

}
