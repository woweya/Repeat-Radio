<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'commenter_id', 'body', 'is_reply', 'reply_to'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commenter()
    {
        return $this->belongsTo(User::class, 'commenter_id');
    }

    public function repliedToComment()
    {
        return $this->belongsTo(Comment::class, 'reply_to');
    }
}
