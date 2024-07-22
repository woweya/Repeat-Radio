<?php

namespace App\Livewire;

use Log;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;



class TitleSong extends Component
{

    public $loading = true;

    public $timepolling;
    public $elementToShow = '';
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
        $this->cachedData = Cache::get('song_data', [
            'title' => '',
            'artist' => '',
            'image' => '',
            'total_seconds' => 0,
            'seconds_elapsed' => 0,
            'seconds_remaining' => 0,
            'spotifyURL' => '',
            'audioURL' => '',
        ]);

        $this->timepolling = intval($this->cachedData['seconds_remaining']);

/*         if ($this->cachedData) {
            $this->fetchSongData();
            $this->loading = false;
            $this->remainingTime = $this->cachedData['total_seconds'] - $this->cachedData['seconds_elapsed'];
        } */
    }

    public function fetchSongData()
    {
        try {
            $response = Http::get('http://138.197.88.112/api/proc/s/currently_playing');

            if (!$response->successful()) {
                throw new \Exception('Failed to fetch song data.');
            }

            $data = $response->json()['song'];

            // Update the component's state
            if ($data['title'] !== $this->cachedData['title'] || $data['artist'] !== $this->cachedData['artist']) {

                $this->cachedData = [
                    'title' => $data['title'],
                    'artist' => $data['artist'],
                    'image' => $data['art'],
                    'total_seconds' => $data['seconds_total'],
                    'seconds_elapsed' => $data['seconds_elapsed'],
                    'seconds_remaining' => $data['seconds_remaining'],
                    'spotifyURL' => $data['url'],
                    'audioURL' => 'https://stream.repeatradio.net/',
                ];

                $this->loading = false;

                // Cache the updated data
                Cache::put('song_data', $this->cachedData);
            }

            $this->remainingTime = $remainingTime;
        } catch (\Throwable $th) {
            \Log::info($th);
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
            'audioURL' => '',
            'spotifyURL'=> '',
        ];
        $this->loading = false;
    }
}
