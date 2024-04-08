<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class LastPlayed extends Component
{

    public $songTitle;
    public $songArtist;
    public $songImage;
    public $elementToShow;
    public $lastThreeSongs;

    public function render()
    {
        return view('livewire.last-played', ['lastThreeSongs' => $this->lastThreeSongs]);
    }

    public function mount()
    {
        $this->fetchPreviousSongData();
    }

    public function fetchPreviousSongData()
    {
        $response = Http::get('http://api.sailorradio.com/api/v1/songs/previous');
        $data = $response->json();

         $this->lastThreeSongs = array_slice($data['songs'], 0, 3);


        return $this->lastThreeSongs;

    }
}
