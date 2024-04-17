<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

#[Lazy]
class TitleSong extends Component
{

    public string $songTitle;
    public string $songArtist;
    public string $songImage;
    public int $secondsTotal;
    public int $secondsElapsed;
    public $elementToShow;
    public int $remainingTime;

    public function render()
    {
        return view('livewire.title-song');
    }

    public function mount(): void
    {
        $cachedData = Cache::get('song_data');
        if($cachedData) {
            $this->secondsElapsed = $cachedData['elapsed_seconds'];
            $this->secondsTotal = $cachedData['total_seconds'];
            $this->songArtist = $cachedData['artist'];
            $this->songTitle = $cachedData['title'];
            $this->songImage = $cachedData['image'];
        }else{
            $this->fetchSongData();
        }
    }


    #[On('fetchSongData')]
    public function fetchSongData()
    {
            try{

        Cache::flush();

        $response = Http::get('http://api.sailorradio.com/api/v1/songs/current');

        $data = $response->json();

        $data = $data['song'];

         $this->songArtist = $data['artist'];
        $this->secondsElapsed = $data['seconds_elapsed'];
        $this->secondsTotal = $data['seconds_total'];
        $this->songImage = $data['art'];
         $this->songTitle = $data['title'];

        $remainingTime = $this->secondsTotal - $this->secondsElapsed;
        $this->remainingTime = $remainingTime;

        Cache::put('song_data', [
            'title' => $this->songTitle,
            'artist' => $this->songArtist,
            'image' => $this->songImage,
            'total_seconds' => $this->secondsTotal,
            'elapsed_seconds' => $this->secondsElapsed,
        ]);

    }
    catch (\Throwable $th) {
        dd($th->getMessage());
    }
    }

}


