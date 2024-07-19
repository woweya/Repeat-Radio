<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_picture_path',
        'banner_picture_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
