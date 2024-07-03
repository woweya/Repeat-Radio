<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

#[Lazy(isolate: false)]
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
    public array $cachedData = [];
    public int $remainingTime;
    public $error;
    public $audioURL;

    public function render()
    {
        $this->loadingElement = $this->elementToShow;

        return view('livewire.title-song');
    }

    public function mount(): void
    {
        $this->loadingElement = 'audioURL';

        $this->cachedData = Cache::get('song_data', []);

        if (!empty($this->cachedData)) {
            $this->updateSongDataFromCache();
        } elseif (!$this->cachedData || $this->remainingTime <= 0) {

            $this->error = 'Something went wrong. Please try again later.';

            Cache::put('song_data', [
                'title' => $this->error,
                'artist' => $this->error,
                'image' => $this->error,
                'total_seconds' => 0,
                'seconds_elapsed' => 0
            ]);

            return;

        }else {
            $this->fetchSongData();
        }

        $this->loading = false;
    }

    public function placeholder()
    {
        return view('skeletons.skeleton-header', ['elementToShow' => $this->elementToShow]);
    }

    private function updateSongDataFromCache(): void
    {
                $this->fetchSongData();
    }

    public function fetchSongData(): void
    {
        try {
            $response = Http::get('http://138.197.88.112/api/proc/s/currently_playing');
            $data = $response->json()['song'];

            $this->songTitle = $data['title'];
            $this->songArtist = $data['artist'];
            $this->secondsTotal = $data['seconds_total'];
            $this->secondsElapsed = $data['seconds_elapsed'];
            $this->songImage = $data['art'];
            $this->audioURL = 'https://stream.repeatradio.net/';
            $this->remainingTime = $this->secondsTotal - $this->secondsElapsed;

            $this->cachedData = [
                'title' => $this->songTitle,
                'artist' => $this->songArtist,
                'image' => $this->songImage,
                'total_seconds' => $this->secondsTotal,
            ];

            Cache::put('song_data', $this->cachedData);
        } catch (\Throwable $th) {
            $this->error = 'Something went wrong';
        }
    }


}
