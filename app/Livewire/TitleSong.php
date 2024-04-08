<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TitleSong extends Component
{

    public $songTitle;
    public $songArtist;
    public $songImage;
    public $secondsTotal;
    public $secondsElapsed;
    public $elementToShow;
    public $remainingTime;

    public function render()
    {
        return view('livewire.title-song');
    }

    public function mount()
    {
        $this->fetchSongData();
    }

    public function fetchSongData()
    {
        try{
        $response = Http::get('http://api.sailorradio.com/api/v1/songs/current');
        $data = $response->json();

        $this->songArtist = $data['song']['artist'];
        $this->secondsElapsed = $data['song']['seconds_elapsed'];
        $this->secondsTotal = $data['song']['seconds_total'];
        $this->songImage = $data['song']['art'];
        $this->songTitle = $data['song']['title'];

        $this->dispatch('dataUpdated', [
            'songTitle' => $this->songTitle,
            'songArtist' => $this->songArtist,
            'secondsElapsed' => $this->secondsElapsed,
            'secondsTotal' => $this->secondsTotal,
            'songImage' => $this->songImage
        ]);

        $remainingTime = $this->secondsTotal - $this->secondsElapsed;
        $this->remainingTime = $remainingTime;
    } catch (\Throwable $th) {
        dd($th->getMessage());
    }
    }




}


