<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'country',
        'city',
        'birthday',
        'username',
        'about_me',
        'social_infos',
        'contact_infos',
        'private_profile',
        'about_me_text',
        'website_url',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public static function findByUsernameOrEmail($username): ?User
    {
        return static::where('username', $username)->orWhere('email', $username)->first();
    }

    public function image()
    {

        return $this->hasOne(\App\Models\Image::class);
    }

    public function likedSong()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'about_me' => 'boolean',
            'social_infos' => 'boolean',
            'contact_infos' => 'boolean',
            'private_profile' => 'boolean',
            'website_url'=>'string',
        ];
    }

    public function activity()
    {
        return $this->hasMany(\App\Models\UserActivity::class);
    }


    public function article()
    {

        return $this->hasMany(\App\Models\Article::class);
    }

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class);
    }

    public function comments()
    {

        return $this->hasMany(\App\Models\Comment::class);
    }


    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'follower_id')->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followed_id')->withTimestamps();
    }
}
