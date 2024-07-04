<?php

namespace App\Livewire;

use Log;
use Livewire\Component;
use Livewire\Attributes\Lazy;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;



class TitleSong extends Component
{




    //PROVO A PASSARE DIRETTAMENTE I DATI DI CACHE
    //DIFATTI NE HA VELOCIZZATO DI MOLTO LA RISPOSTA!!!!

    /*  public string $songTitle;
    public string $songArtist;
    public string $songImage;
    public int $secondsTotal;
    public int $secondsElapsed; */
    public $loading = true;
   /*  public $loadingElement; */
    public $elementToShow = 'songTitle';
    public array $cachedData = [];
    public int $remainingTime;
    public $error = 'Something went wrong, try again...';
    public $audioURL;

    public function render()
    {


        return view('livewire.title-song');
    }


    public function mount(): void
    {
        $this->cachedData = Cache::get('song_data', []);

        if (!empty($this->cachedData)) {
            $this->loading = false;
        } else {
            $this->fetchSongData();
        }
    }

    public function fetchSongData()
    {
        try {
            $response = Http::timeout(2)->get('http://138.197.88.112/api/proc/s/currently_playing');

            if (!$response->successful()) {
                throw new \Exception('Failed to fetch song data.');
            }

            $data = $response->json()['song'];

            $this->cachedData = [
                'title' => $data['title'],
                'artist' => $data['artist'],
                'image' => $data['art'],
                'total_seconds' => $data['seconds_total'],
                'seconds_elapsed' => $data['seconds_elapsed'],
            ];
            $this->loading = false;

            // Cache the data
            Cache::put('song_data', $this->cachedData, now()->addMinutes(10));

        } catch (\Throwable $th) {
            $this->handleFetchError();
        }
    }

    private function handleFetchError()
    {
        $this->error = 'Something went wrong. Please try again later.';
        $this->cachedData = [
            'title' => $this->error,
            'artist' => $this->error,
            'image' => '',
            'total_seconds' => 0,
            'seconds_elapsed' => 0,
        ];
        $this->loading = false;

        // Cache the error state
        Cache::put('song_data', $this->cachedData, now()->addMinutes(10));
    }

}
