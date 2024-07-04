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
    $this->loading = true;

    $this->cachedData = Cache::get('song_data', []);

    // If cached data is found, use it
    if (!empty($this->cachedData)) {
        $this->updateSongDataFromCache();
    } else {
        try {
            $this->fetchSongData();
        } catch (\Throwable $th) {
            $this->error = 'Something went wrong. Please try again later.';

            Cache::put('song_data', [
                'title' => $this->error,
                'artist' => $this->error,
                'image' => $this->error,
                'total_seconds' => 0,
                'seconds_elapsed' => 0
            ]);
        }
    }

    $this->loading = false;
}

    public function placeholder()
    {
        return view('skeletons.skeleton-header', ['elementToShow' => $this->elementToShow]);
    }

    private function updateSongDataFromCache(): void
    {
        $this->songTitle = $this->cachedData['title'];
        $this->songArtist = $this->cachedData['artist'];
        $this->secondsTotal = $this->cachedData['total_seconds'];
        $this->secondsElapsed = $this->cachedData['seconds_elapsed'];
        $this->songImage = $this->cachedData['image'];
        $this->audioURL = 'https://stream.repeatradio.net/';
        $this->remainingTime = $this->secondsTotal - $this->secondsElapsed;
    }

    public function fetchSongData(): void
    {
        try {
            // Attempt to retrieve data from the cache
            $cachedData = Cache::get('song_data');

            // If cached data is found, use it
            if ($cachedData) {
                $this->songTitle = $cachedData['title'];
                $this->songArtist = $cachedData['artist'];
                $this->secondsTotal = $cachedData['total_seconds'];
                $this->secondsElapsed = 0; // Assuming elapsed time is reset or managed separately
                $this->songImage = $cachedData['image'];
                $this->audioURL = 'https://stream.repeatradio.net/';
                $this->remainingTime = $this->secondsTotal - $this->secondsElapsed;
                info('Im here caching');
            } else {
                // If no cached data is found, make the HTTP request
                $response = Http::get('http://138.197.88.112/api/proc/s/currently_playing');
                $data = $response->json()['song'];
               info('Im here fetching');
               $this->songTitle = $data['title'];
                $this->songArtist = $data['artist'];
                $this->secondsTotal = $data['seconds_total'];
                $this->secondsElapsed = $data['seconds_elapsed'];
                $this->songImage = $data['art'];
                $this->audioURL = 'https://stream.repeatradio.net/';
                $this->remainingTime = $this->secondsTotal - $this->secondsElapsed;

                // Prepare the data to be cached
                $this->cachedData = [
                    'title' => $this->songTitle,
                    'artist' => $this->songArtist,
                    'image' => $this->songImage,
                    'total_seconds' => $this->secondsTotal,
                ];

                // Cache the data
                Cache::put('song_data', $this->cachedData);
            }
        } catch (\Throwable $th) {
            $this->error = 'Something went wrong';
            info('Im here handling error');
        }
    }


}
