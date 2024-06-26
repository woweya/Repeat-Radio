<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'song_name', 'song_artist'];

    public function userLiked(){
        return $this->belongsToMany(User::class);
    }
}
