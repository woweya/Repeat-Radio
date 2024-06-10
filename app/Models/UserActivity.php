<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'hours_online', 'hours_played'];

    protected $casts = [
        'hours_played' => 'integer',
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }


}
