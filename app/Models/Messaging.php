<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messaging extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'annonce_id', 'created_at', 'message'];

    function user(){
        return $this->belongsTo(User::class);
    }

    
}
