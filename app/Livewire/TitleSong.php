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
    public $loading = true;

    public $loadingElement;

    public $elementToShow;
    public $cachedData = [];
    public int $remainingTime;

    #[Lazy]
    public function render()
    {

        if ($this->elementToShow === 'songTitle') {
            $this->loadingElement = 'songTitle';
        } elseif ($this->elementToShow === 'songArtist') {
            $this->loadingElement = 'songArtist';
        } elseif ($this->elementToShow === 'songImage') {
            $this->loadingElement = 'songImage';
        }

        return view('livewire.title-song');
    }

    public function mount(): void
    {

        $this->cachedData = [];


        $cachedData= Cache::get('song_data');

        if ($cachedData) {
            $this->songTitle = $cachedData['title'];
            $this->songArtist = $cachedData['artist'];
            $this->secondsTotal = $cachedData['total_seconds'];
            $this->secondsElapsed = $cachedData['seconds_elapsed'];
            $this->songImage = $cachedData['image'];
            $this->remainingTime = $this->secondsTotal - $this->secondsElapsed;
        }


        $this->fetchSongData();

        $this->loading = false;
    }

    public function placeholder()
    {
        return view('skeletons.skeleton-header', ['elementToShow' => $this->elementToShow]);
    }

    #[On('fetchSongData')]
    public function fetchSongData()
    {
        try {


            $this->cachedData = Cache::get('song_data');
            $response = Http::get('http://138.197.88.112/api/proc/s/currently_playing');
            $data = $response->json()['song'];

                $this->songTitle = $data['title'];
                $this->songArtist = $data['artist'];
                $this->secondsTotal = $data['seconds_total'];
                $this->secondsElapsed = $data['seconds_elapsed'];
                $this->songImage = $data['art'];
                $this->remainingTime = $this->secondsTotal - $this->secondsElapsed;


                $this->cachedData = [
                    'title' => $this->songTitle,
                    'artist' => $this->songArtist,
                    'image' => $this->songImage,
                    'total_seconds' => $this->secondsTotal,
                    'seconds_elapsed' => $this->secondsElapsed
                ];


                Cache::put('song_data', $this->cachedData);






        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

}


