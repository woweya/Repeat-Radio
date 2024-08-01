<?php

namespace App\Livewire;

use Log;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Isolate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


#[Lazy]
class TitleSong extends Component
{

    public $loading = true;
    public $elementToShow = '';
    public array $cachedData = [];
    public int $remainingTime;
    public int $secondsElapsed;
    public $error = 'Something went wrong, try again...';
    public $audioURL;



    public function mount(): void
    {
        $this->cachedData = Cache::get('song_data', []);

        if (!$this->cachedData) {
            $this->loading = true;
            $this->fetchSongData();
        } else {
            $this->loading = true;
            $this->remainingTime = $this->cachedData['seconds_remaining'] ?? 0;
            $this->dispatch('fetchSongData');
        }

        /*         if ($this->cachedData) {
            $this->fetchSongData();
            $this->loading = false;
            $this->remainingTime = $this->cachedData['total_seconds'] - $this->cachedData['seconds_elapsed'];
        } */
    }


    public function placeholder()
    {
        return view('skeletons.skeleton-header');
    }

    #[On('fetchSongData')]
    public function fetchSongData()
    {
        try {
            $response = Http::get('http://138.197.88.112/api/proc/s/currently_playing');

            $data = $response->json()['song'];

            $remainingTime = $data['seconds_remaining'];
            $secondsElapsed = $data['seconds_elapsed'];
            $this->remainingTime = $remainingTime;
            $this->secondsElapsed = $secondsElapsed;

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
                $this->dispatch('songUpdated', $data);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->handleFetchError();
        }
    }



    public function render()
    {

        return view('livewire.title-song');
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
            'spotifyURL' => '',
        ];
        $this->loading = false;
    }
}
