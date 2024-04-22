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
    public $newResponse = [];
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
        if(Auth::check()) {
        $newResponse = Cache::get('song_data');
        $this->title = $newResponse['title'];
        $this->artist = $newResponse['artist'];
        $this->user_id = User::find(Auth::user()->id);
        $user = Auth::user();
        if(!$user->likedSong()->where('song_name', $this->title)->where('song_artist', $this->artist)->exists()) {
            $like = new Like();
            $like->song_name = $this->title;
            $like->song_artist = $this->artist;
            $like->user_id = $this->user_id;
            $this->isLiked = true;
            $user->likedSong()->save($like);

        $response = Http::post('http://api.sailorradio.com/api/v1/songs/current',['song_name' => $this->title, 'song_artist' => $this->artist, 'user_id'=> $this->user_id]);
            if($response->successful()){
                return redirect()->back()->with('success','API Inviato.');
            }

        }else{
            $user->likedSong()->where('song_name', $this->title)->where('song_artist', $this->artist)->delete();
            $this->isLiked = false;
        }
        }else{
            redirect('/login');
        }

    }

    protected function checkIsLiked(){
        if(Auth::check()) {
           $user = Auth::user();
           $songName = $this->title;
           $songArtist = $this->artist;

           $user->load(['likedSong' => function ($query) use ($songName, $songArtist) {
               $query->where('song_name', $songName)->where('song_artist', $songArtist);
           }]);
           $this->isLiked = $user->likedSong->isNotEmpty();
        }
    }


}
