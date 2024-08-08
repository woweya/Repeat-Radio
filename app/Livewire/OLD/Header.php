<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Header extends Component
{
    public $title;
    public $artist;
    public $user_id;
    public $isLiked = false;

    public function render()
    {
        return view('livewire.header');
    }



    public function likeSong()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $songData = Cache::get('song_data');
        if (!$songData) {
            return;
        }

        $this->title = $songData['title'];
        $this->artist = $songData['artist'];
        $this->user_id = Auth::id();

        $user = Auth::user();

        if ($this->isSongLiked($user)) {

            $user->likedSong()->where('song_name', $this->title)->where('song_artist', $this->artist)->delete();
            $this->isLiked = false;
        } else {
            $like = new Like([
                'song_name' => $this->title,
                'song_artist' => $this->artist,
                'user_id' => $this->user_id,
            ]);

            $user->likedSong()->save($like);
            $this->isLiked = true;

            $response = Http::post('http://api.sailorradio.com/api/v1/songs/current', [
                'song_name' => $this->title,
                'song_artist' => $this->artist,
                'user_id' => $this->user_id,
            ]);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'API Inviato.');
            }
        }
    }

    protected function isSongLiked($user)
    {
        return $user->likedSong()
            ->where('song_name', $this->title)
            ->where('song_artist', $this->artist)
            ->exists();
    }

    protected function checkIsLiked()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->isLiked = $this->isSongLiked($user);
        }
    }
}
