<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

#[Lazy(isolate: false)]
class LastPlayed extends Component
{
    public $lastThreeSongs = [];
    public $loading = true;
    public $error = '';
    public $elementToShow = 'lastThreeSongs';

    public function render()
    {
        return view('livewire.last-played');
    }

    public function mount(): void
    {
        $cachedData = Cache::get('last_three_songs', []);

        if (!empty($cachedData)) {
            $this->lastThreeSongs = $cachedData;
            $this->loading = false;
        } else {
            $this->fetchPreviousSongData();
        }
    }

    public function placeholder()
    {
        if ($this->loading) {
            return view('skeletons.skeleton-lastPlayed');
        } else {
            return view('livewire.last-played', ['lastThreeSongs' => $this->lastThreeSongs, 'error' => $this->error]);
        }
    }

    public function fetchPreviousSongData()
    {
        try {
            $response = Http::timeout(2)->get('http://138.197.88.112/api/proc/s/song_history');

            if (!$response->successful()) {
                throw new \Exception('Failed to fetch previous songs data.');
            }

            $data = $response->json();
            $this->lastThreeSongs = array_slice($data['songs'], 0, 3);
            $this->loading = false;

            // Cache the data
            Cache::put('last_three_songs', $this->lastThreeSongs, now()->addMinutes(2));

        } catch (\Throwable $th) {
            $this->handleFetchError();
        }
    }

    private function handleFetchError()
    {
        $this->error = 'Something went wrong. Please try again later.';
        $this->lastThreeSongs = [];
        $this->loading = false;

        // Cache the error state
        Cache::put('last_three_songs', [], now()->addMinutes(2));
    }
}
