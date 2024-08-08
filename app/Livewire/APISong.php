<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class APISong extends Component
{

    public $secondsTotal;
    public $elapsed;
    public $remaining;
    public $title;
    public $artist;

    public $cachedData = [];

    public function mount()
    {
        $this->fetchSongData();
    }

    public function fetchSongData()
    {
        try {
            $response = Http::get('http://138.197.88.112/api/proc/s/currently_playing')->json();

            $data = $response['song'];

            $this->secondsTotal = $data['seconds_total'];
            $this->elapsed = $data['seconds_elapsed'];
            $this->remaining = $data['seconds_remaining'];
            $this->title = $data['title'];
            $this->artist = $data['artist'];

            $this->cachedData = $data;

            Cache::put('songData', $data);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.a-p-i-song');
    }
}
